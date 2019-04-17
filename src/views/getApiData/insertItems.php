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
$conn = new mysqli($servername, $username, $password, $dbname);
$barcode = array();
$barcode = $_POST['dataInsert'];
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT * FROM items";
$result = $conn->query($sql);
$dataItems = array();
if($result)
{
    while ($row=mysqli_fetch_assoc($result))
    {   
        $dataItems[]=$row;
    }
}
else
{
echo "Error";

}

// $response = array();
// if ($result->num_rows > 0) {
    // Array(
    // 0 => Array (
    //         "barcode"=> 0000156,
    //         "branch_id" => '2',
    //         "quantity_in" => 20,
    //         // "quantity_out" => 10,
    //         "date_in" => 25620101,
    //         "name" => 'xxx',
    //         "desc" => 'yyy',
    //         "cost" => 100,
    //         "price" => 100,
    //         "remark" => 'xxxx',
    //         "cate_id" => 1,
    //         "confirm" => 00,
    //         "pid_approve" => 1759900252871,
    //         "pid_user" => 1759900252871,
    //         "approve_id"=> 1,
    //         "status_id" => 01,
    //         "add_time"=> 120102,
    //         "add_date"=> 25620304,
    //     ),
    // 1 => Array(
    //     "barcode"=> 00000123,
    //     "branch_id" => '2',
    //     "quantity_in" => 20,
    //     // "quantity_out" => 10,
    //     "date_in" => 25620101,
    //     "name" => 'xxx',
    //     "desc" => 'yyy',
    //     "cost" => 100,
    //     "price" => 100,
    //     "remark" => 'xxxx',
    //     "cate_id" => 1,
    //     "confirm" => 00,
    //     "pid_approve" => 1759900252871,
    //     "pid_user" => 1759900252871,
    //     "approve_id"=> 1,
    //     "status_id" => 01,
    //     "add_time"=> 120102,
    //     "add_date"=> 25620304,
    //     ),
    // 2 => Array(
    //     "barcode"=> 00001667,
    //     "branch_id" => '2',
    //     "quantity_in" => 20,
    //     // "quantity_out" => 10,
    //     "date_in" => 25620101,
    //     "name" => 'xxx',
    //     "desc" => 'yyy',
    //     "cost" => 100,
    //     "price" => 100,
    //     "remark" => 'xxxx',
    //     "cate_id" => 1,
    //     "confirm" => 00,
    //     "pid_approve" => 1759900252871,
    //     "pid_user" => 1759900252871,
    //     "approve_id"=> 1,
    //     "status_id" => 01,
    //     "add_time"=> 120102,
    //     "add_date"=> 25620304,
    //     )
    // );
    function SearchArray($dataItems,$barcode)
    {
        $servername = "localhost";
        $username = "id3526601_anupha";
        $password = "ok223201";
        $dbname = "id3526601_projest_vue_barcode";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $count = '0';
        $iterition = 0;
        for($i=0;$i<count($barcode);$i++)
        { 
            $iterition = 0;
            $key = array_search($barcode[$i]['barcode'], array_column($dataItems, 'barcode')); // check item 
            if ($key !== false) {
                $iterition = 1;
            }
            if ($iterition === 0) { // no iteratio
              $query = "insert into items(barcode, name, desc, cate_id, price, cost, remark) values (".$barcode[$i]['barcode'].", '".$barcode[$i]['name']."', '".$barcode[$i]['desc']."', 2, ".$barcode[$i]['price'].", ".$barcode[$i]['cost'].", '".$barcode[$i]['remark']."')";
              $result = $conn->query($query);
            }
            $barcode_stock = $barcode[$i]['barcode'];
            $branch_id = $barcode[$i]['branch_id'];
            $query = "select * from stock where branch_id = '".$barcode[$i]['barcode']."' and barcode = '$barcode_stock'";
            $resultItems = $conn->query($query); 
            $new_quantity_in = 0;
            if (count($resultItems) == 1) {
              foreach($resultItems as $row) {
                $new_quantity_in = $row['quantity_in'] + $barcode[$i]['quantity_in'];      
              }
              // map stock validate for update
              $query = "update stock set quantity_in = '".$new_quantity_in."' where branch_id = '".$barcode[$i]['barcode']."' and barcode = '".$barcode_stock."'";
              $result = $conn->query($query);
            
            } else {
              // map stock validate for insert
              $query = "insert into stock(barcode, branch_id, quantity_in, quantity_out, date_in, remark) values ('".$barcode[$i]['barcode']."', '".$barcode[$i]['branch_id']."', '".$barcode[$i]['quantity_in']."', '".$barcode[$i]['quantity_out']."', '".$barcode[$i]['date_in']."', '".$barcode[$i]['remark']."')";
              $result = $conn->query($query);  
              
             
            }
            // map transaction validate for insert                                                                                                                                                                                                                          barcode, add_date, add_time, branch_id, quantity, status_id, approve_id, pid_user, pid_approve, remark
            $query = "INSERT INTO transaction_in(id, barcode, add_date, add_time, branch_id, quantity, status_id, approve_id, pid_user, pid_approve, remark) values (NULL,'".$barcode[$i]['barcode']."', '".$barcode[$i]['add_date']."', '".$barcode[$i]['add_time']."', '".$barcode[$i]['branch_id']."', '".$barcode[$i]['quantity_in']."', '".$barcode[$i]['status_id']."', '".$barcode[$i]['approve_id']."', '".$barcode[$i]['pid_user']."', '".$barcode[$i]['pid_approve']."', '".$barcode[$i]['remark']."')";
            $result = $conn->query($query);

    if($result)
	{
		echo "Save Done.";
	}
	else
	{
		echo "Error Save [".$query."]";
	}
            
        }
        
        // return $result;
    }
    
    echo SearchArray($dataItems,$barcode);

} else {
    echo "0 results";
}
$conn->close();
?>