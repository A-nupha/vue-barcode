<?php

ini_set('display_errors', 1);

// ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');

header('Content-type: application/json');



$servername = "localhost";
$username = "id3526601_anupha";
$password = "ok223201";
$dbname = "id3526601_projest_vue_barcode";
// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "true";
// Check connection
// echo json_encode($dataItems);

$response = array();

$barcode = array();
$dataSecess = json_decode($_POST['dataSuccess'], true);
$dataError = json_decode($_POST['dataError'], true);

// echo json_encode($dataSecess)."\r\n\r\n\r\n\r\n\r\n\r\n";
// echo json_encode($dataError)."\r\n";
if($dataSecess.length != 0){
    DataSuccessInsert($dataSecess,$conn);
}
if($dataError.length != 0){
    DataSuccessInsert($dataSecess,$conn);
}

function DataSuccessInsert($data,$conn){
    $secess1 = false
    $secess2 = false
    $secess3 = false
    for($i=0;$i<count($data);$i++){
        $barcode = $data[$i]['databarcode'];
        $add_date = $data[$i]['add_date'];
        $add_time = $data[$i]['add_time'];
        $branch_id = $data[$i]['branch_id'];
        $quantity = $data[$i]['quantity'];
        $name =$data[$i]['name'];
        $status_id = $data[$i]['status_id'];
        $approve_id =$data[$i]['approve_id'];
        $pid_user =$data[$i]['pid_user'];
        $pid_approve =$data[$i]['pid_approve'];
        $detailItems =$data[$i]['detailItems'];
        $barcode_stock = $data[$i]['databarcode'];
        $dataStock= array();


        $dataPriceCost=array();
        $queryit = "select * from items where barcode = '".$barcode."'";
        $resultqueryit = $conn->query($queryit);
        if($resultqueryit)
        {
        while ($row=mysqli_fetch_assoc($resultqueryit))
            {   
            $dataPriceCost[]=$row;
            }
        }
        else
        {
            echo 'error===>select * from items'
        }
        

        $price=$dataPriceCost['price'];
        $cost=$dataPriceCost['cost'];

        $queryStock = "select * from stock where branch_id = ".$branch_id." and barcode = '".$barcode_stock."'";
        $resultItems = $conn->query($queryStock);
        if($resultItems)
        {
        while ($row=mysqli_fetch_assoc($resultItems))
            {   
            $dataStock[]=$row;
            }
        }
        else
        {

        }
        $quantity_old = (int)$dataStock[0]['quantity_stock'];
        $new_quantity_in = $quantity_old - $data[$i]['quantity'];
        $query = "update stock set quantity_stock = '$new_quantity_in' where branch_id = '".$data[$i]['branch_id']."' and barcode = '".$barcode_stock."'";
        $result = $conn->query($query);
        if($result)
        {
            //  echo "\r\n update result1 Save Done. \r\n";
            $secess1 = true
        }
        else
        {
             echo "\r\n update Error Save [".$query."] \r\n";
        }
     
        $queryInsert="INSERT INTO `transaction_out`(`id`, `barcode`, `add_date`, `add_time`, `branch_id`, `quantity`, `status_id`, `approve_id`, `pid_user`, `pid_approve`, `remark`, `price`, `cost`) 
        VALUES (null,'".$barcode."','".$add_date."','".$add_time."','".$branch_id."','".$quantity."','".$status_id."','".$approve_id."','".$pid_user."','".$pid_approve."','".$detailItems."','".$price."','".$cost."')";

        $resultInsertSuccess = $conn->query($queryInsert);
        if($resultInsertSuccess)
        {
            // echo "\r\n resultInsertSuccess Save Done. \r\n";
            $secess2 = true
        }
        else
        {
            echo "\r\n Error Save [".$queryInsert."] \r\n";
        }
    }

}

function DataErrorInsert($data,$conn){
    for($i=0;$i<count($data);$i++){
        $barcode = $data[$i]['databarcode'];
        $add_date = $data[$i]['add_date'];
        $add_time = $data[$i]['add_time'];
        $branch_id = $data[$i]['branch_id'];
        $quantity = $data[$i]['quantity'];
        $status_id = $data[$i]['status_id'];
        $dataPriceCost=array();


       $queryInsert="INSERT INTO `items_approve`(`id`, `barcode`, `add_date`, `add_time`, `branch_id`, `quantity`, `status`) 
       VALUES (null,'".$barcode."','".$add_date."','".$add_time."','".$branch_id."','".$quantity."','".$status_id."')";
    
    $resultInsertApp = $conn->query($queryInsert);
    if($resultInsertApp)
    {
        //  echo "\r\n resultInsertApprove Save Done. \r\n";
        $secess3 = true
    }
    else
    {
         echo "\r\n Error Save [".$queryInsert."] \r\n";
    }
    }

}





$conn->close();
?>