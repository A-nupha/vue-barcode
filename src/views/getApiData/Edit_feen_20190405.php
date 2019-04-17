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

// Check connection



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

echo json_encode($dataItems);

$response = array();

$barcode = array();
$barcode = json_decode($_POST['dataInsert'], true);

SearchArray($dataItems,$barcode,$conn);
function SearchArray($dataItems,$barcode,$conn)
{
    echo json_encode($dataItems)."\r\n";
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else{
        echo "connected successfully";
    }
    echo "\r\n - \r\n -\r\n ------------------------into function ----------------------";
    for($i=0;$i<count($barcode);$i++)
    { 
        $barcode_item=$barcode[$i]['barcode'];
        $iterition = 0;
        $key = array_search($barcode[$i]['barcode'], array_column($dataItems, 'barcode')); // check item
        echo "\r\n\r\n".$barcode[$i]['barcode']." key =".$key."\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n";
        echo gettype($key);
        if($key==false){
            echo "\r\n\r\n\r\n\r\n if1 \r\n\r\n\r\n\r\n";
            $queryitem = "INSERT INTO `items`(`barcode`, `name`, `desc`, `cate_id`, `price`, `cost`, `remark`) VALUES ('".$barcode[$i]['barcode']."', '".$barcode[$i]['name']."', '".$barcode[$i]['desc']."', 2, ".$barcode[$i]['price'].", ".$barcode[$i]['cost'].", '".$barcode[$i]['remark']."')";
            $result1 = $conn->query($queryitem);
            if($result1)
            {
                echo "result1 Save Done.";
            }
            else
            {
                echo "Error Save [".$queryitem."]";
            }

            $querystock = "insert into stock(barcode, branch_id, quantity_in, quantity_out, date_in, remark)
            values ('".$barcode[$i]['barcode']."', '".$barcode[$i]['branch_id']."', '".$barcode[$i]['quantity_in']."', null, null, '".$barcode[$i]['remark']."')";
            $result2 = $conn->query($querystock);
            if($result2)
            {
                echo "result2 Save Done.";
            }
            else
            {
                echo "Error Save [".$querystock."]";
            }


            $querytransac = "insert into transaction_in(id, barcode, add_date, add_time, branch_id, quantity, status_id, approve_id, pid_user, pid_approve, remark)
            values (NULL,'".$barcode[$i]['barcode']."', CURRENT_DATE(), CURRENT_TIME(), '".$barcode[$i]['branch_id']."', '".$barcode[$i]['quantity_in']."', '".$barcode[$i]['status_id']."', '".$barcode[$i]['approve_id']."', '".$barcode[$i]['pid_user']."', '".$barcode[$i]['pid_approve']."', '".$barcode[$i]['remark']."')";
            $result3 = $conn->query($querytransac);
            if($result3)
            {
                echo "result3 Save Done.";
            }
            else
            {
                echo "Error Save [".$querytransac."]";
            }
            // echo "\r\n      loop '$i' data ' $barcode_item' isn't found in database naka. \r\n";
        }else{
            echo "\r\n\r\n\r\n\r\n else \r\n\r\n\r\n\r\n";
            $barcode_stock = $barcode[$i]['barcode'];
            $branch_id = $barcode[$i]['branch_id'];
            $query = "select * from stock where branch_id = ".$branch_id." and barcode = '".$barcode_stock."'";
            echo  "\r\n".$query."\r\n";
            $resultItems = $conn->query($query);
            $dataStock= array();
            $new_quantity_in = 0;
            if($resultItems)
                {
                while ($row=mysqli_fetch_assoc($resultItems))
                    {   
                    $dataStock[]=$row;
                    }
                }
                else
                {
                echo "Error";
                }



                // echo gettype($dataStock[0]['quantity_in'])."<= type of datastork \r\n";
                $quantity_old = (int)$dataStock[0]['quantity_in'];

                // echo gettype($quantity_old)."<= type of quantity_old \r\n";
                // echo gettype($barcode[$i]['quantity_in'])."<= type of barcode \r\n";

                $new_quantity_in = $quantity_old + $barcode[$i]['quantity_in'];
                echo $new_quantity_in." == new_quantity_in";

                $query = "update stock set quantity_in = '$new_quantity_in' where branch_id = '".$barcode[$i]['branch_id']."' and barcode = '".$barcode_stock."'";
                echo $query;
                $result = $conn->query($query);
                if($result)
            {
                echo " update result1 Save Done.";
            }
            else
            {
                echo "Error Save [".$query."]";
            }

            $querytransac = "insert into transaction_in(id, barcode, add_date, add_time, branch_id, quantity, status_id, approve_id, pid_user, pid_approve, remark)
            values (NULL,'".$barcode[$i]['barcode']."', CURRENT_DATE(), CURRENT_TIME(), '".$barcode[$i]['branch_id']."', '".$barcode[$i]['quantity_in']."', '".$barcode[$i]['status_id']."', '".$barcode[$i]['approve_id']."', '".$barcode[$i]['pid_user']."', '".$barcode[$i]['pid_approve']."', '".$barcode[$i]['remark']."')";
            $result3 = $conn->query($querytransac);
            if($result3)
            {
                echo "result3 Save Done.";
            }
            else
            {
                echo "Error Save [".$querytransac."]";
            }
                
        }        
    }
}

$conn->close();

?>