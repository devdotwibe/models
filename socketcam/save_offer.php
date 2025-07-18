<?php
$data = json_decode(file_get_contents('php://input'), true);
file_put_contents('data.json', json_encode(['offer' => $data['offer'], 'answer' => null]));
echo 'Offer saved';
