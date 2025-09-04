<?php
header('Content-Type: application/json; charset=utf-8');

$room = trim($_GET['room'] ?? '');
if ($room === '') { http_response_code(400); echo json_encode(['error'=>'room required']); exit; }

$filename = __DIR__."/room_".preg_replace('/[^a-zA-Z0-9_\-]/','_',$room).".json";

$default = [
  'meta'=>['streamer_started'=>false,'streamer_id'=>null,'created_at'=>time()],
  'offers'=>new stdClass(),
  'answers'=>new stdClass(),
  'candidates'=>new stdClass()
];

if (!file_exists($filename)) file_put_contents($filename,json_encode($default,JSON_PRETTY_PRINT));
$data=json_decode(file_get_contents($filename),true);
if (!$data) $data=json_decode(json_encode($default),true);

function save_room($f,$d){ file_put_contents($f,json_encode($d,JSON_PRETTY_PRINT)); }

if ($_SERVER['REQUEST_METHOD']==='POST'){
  $type=$_POST['type']??''; $peer=$_POST['peer']??''; $payload=$_POST['payload']??'';

  if ($type==='start_streamer'){
    $data=json_decode(json_encode($default),true);
    $data['meta']['streamer_started']=true;
    $data['meta']['streamer_id']=$peer?:null;
    $data['meta']['created_at']=time();
    save_room($filename,$data);
    echo json_encode(['ok'=>true]); exit;
  }

  if ($type==='offer'){
    $data['offers'][$peer]=$payload;
    if (isset($data['answers'][$peer])) unset($data['answers'][$peer]);
  } elseif ($type==='answer'){
    $data['answers'][$peer]=$payload;   // keep until viewer consumes
  } elseif ($type==='candidate'){
    if (!isset($data['candidates'][$peer])||!is_array($data['candidates'][$peer])) $data['candidates'][$peer]=[];
    $data['candidates'][$peer][]=$payload;
  } elseif ($type==='cleanup_peer'){
    unset($data['offers'][$peer],$data['answers'][$peer],$data['candidates'][$peer]);
    if (empty($data['offers'])) $data['offers']=new stdClass();
    if (empty($data['answers'])) $data['answers']=new stdClass();
    if (empty($data['candidates'])) $data['candidates']=new stdClass();
  }
  save_room($filename,$data);
  echo json_encode(['ok'=>true]); exit;
}

// GET
$role=$_GET['role']??''; $peer=$_GET['peer']??''; $consume=($_GET['consume']??'')==='1';
$status=($_GET['status']??'')==='1';

if ($status){ echo json_encode(['meta'=>$data['meta']]); exit; }

if ($role==='streamer'){
  $offers=$data['offers']??[]; $candmap=[];
  foreach($offers as $p=>$o){ $candmap[$p]=$data['candidates'][$p]??[]; }
  $out=['offers'=>$offers,'candidates'=>$candmap];
  if ($consume){
    foreach(array_keys($offers) as $p){ unset($data['offers'][$p]); unset($data['candidates'][$p]); }
    save_room($filename,$data);
  }
  echo json_encode($out); exit;
}

if ($role==='viewer'){
  if (!$peer){ http_response_code(400); echo json_encode(['error'=>'peer required']); exit; }
  $ans=$data['answers'][$peer]??null; $cands=$data['candidates'][$peer]??[];
  $out=['answer'=>$ans,'candidates'=>$cands];
  if ($consume){ unset($data['answers'][$peer]); unset($data['candidates'][$peer]); save_room($filename,$data); }
  echo json_encode($out); exit;
}

echo json_encode($data);
