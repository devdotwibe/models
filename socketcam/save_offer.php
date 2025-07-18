<?php
$data = json_decode(file_get_contents('php://input'), true);
$existing = json_decode(file_get_contents('data.json'), true);
$existing['offer'] = $data['offer'];
$existing['answer'] = null; // reset answer when new offer posted
file_put_contents('data.json', json_encode($existing));
echo 'OK';
