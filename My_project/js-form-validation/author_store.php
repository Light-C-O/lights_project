<?php
$data = $_POST;
$data ["id"] = 7;

$response =[
    "status" => true,
    "data" => $_POST
];

header("Content-Type: application/json");
$json = json_encode($response);
echo $json;