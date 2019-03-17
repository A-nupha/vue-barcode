<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");

   $pid = "1234567891234";
   $fname = "rak";
   $lname = "rak";
   $tname = "rak";
   $bdate = "rak";
   $email = "rak";
   $tel =  " ";
   $flag_id = " ";
   $now_date = " ";
   $rcode_id = " ";
   $index1 = "rak";
   $index2 = "1234";





$servername = "localhost";
$username = "id3526601_anupha";
$password = "ok223201";
$dbname = "id3526601_projest_vue_barcode";
//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    echo "connected";
}

//chk pid

//    //  insert data
//    $query = "insert into user(pid,fname,lname,tname,bdate,email,tel, flag_id, now_date,rcode_id,index1,index2,branch_id) values($pid,"".$fname."","".$lname."","".$tname."","".$bdate."","".$email."","".$tel."", "".$flag_id."", "".$now_date."","".$rcode_id."","".$index1."","".$index2."","".$branch_id."")";
//    $result = $conn->query($query);
  



$conn->close();
?>