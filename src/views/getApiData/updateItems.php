<?php
ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$dataStock = json_decode($_POST['dataStork'], true);


$servername = "localhost";
$username = "id3526601_anupha";
$password = "ok223201";
$dbname = "id3526601_projest_vue_barcode";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$=$dataStock[0]['barcode'];
$=$dataStock[0]['name'];
$=$dataStock[0]['desc'];
$=$dataStock[0][''];
$=$dataStock[0][''];
$=$dataStock[0][''];
$=$dataStock[0][''];
$=$dataStock[0][''];
$=$dataStock[0][''];
$=$dataStock[0][''];



$response = array();
$query  = "UPDATE `items` SET `barcode`='',`name`=,`desc`=,`cate_id`=,`price`=,`cost`=,`remark`= WHERE 1";
$result = $conn->query($query);
echo json_encode($result);

$conn->close();
?>