<?php
$response = file_get_contents('http://www.instagram.com/web/search/topsearch/?query=parth_5929');
$response1 = json_decode($response);
print_r($response1);
?>