<?php
$data = json_decode(file_get_contents('php://input'), true);
$existing = json_decode(file_get_contents('data.json'), true);
$existing['answer'] = $data['answer'];
file_put_contents('data.json', json_encode($existing));
echo 'OK';
