<?php

include "db.php";


$id = $_GET['id'];


$order = [];


$sql = "

SELECT * FROM orders
WHERE order_id='$id'

";


$result = mysqli_query($conn,$sql);

$order = mysqli_fetch_assoc($result);



$sqlItems = "

SELECT *
FROM order_items
WHERE order_id='$id'

";


$resultItems = mysqli_query($conn,$sqlItems);


$items=[];


while($row=mysqli_fetch_assoc($resultItems)){

    $items[]=$row;

}


$order['items']=$items;


echo json_encode($order);


?>