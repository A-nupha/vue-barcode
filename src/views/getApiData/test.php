<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

// $arr = [];
// $arr =  $_POST['data'];
$data = $_POST['data'];
for($i=0;$i<count($data);$i++){
    print_r(json_decode( $data[$i],true ));
 }
// echo json_encode($_POST,true);
// print_r($_POST);

?>