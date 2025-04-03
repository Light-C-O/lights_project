<?php
require_once './etc/config.php';

$data = file_get_contents('php://input');
$data = json_decode($data, true);

$author_demo = Author_Demo::findById($id);;
$author_demo->delete();

$response = [
    "status" => true,
    "data" => $data
];
$json = json_encode($response);

header("Content-Type: application/json");
echo $json;
?>