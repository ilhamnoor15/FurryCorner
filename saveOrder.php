<?php

include "db.php";

$data = json_decode(file_get_contents("php://input"), true);


$shipping = $data["shipping"];
$items = $data["items"];


$sql = "INSERT INTO orders
(
first_name,
last_name,
address,
city,
province,
postal_code,
phone,
payment_method,
subtotal,
shipping_fee,
total_amount,
status
)

VALUES
(
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
'Processing'
)";


$stmt = $conn->prepare($sql);


$stmt->bind_param(
"sssssssdddd",
$shipping["firstName"],
$shipping["lastName"],
$shipping["address"],
$shipping["city"],
$shipping["province"],
$shipping["postal"],
$shipping["phone"],
$data["payment"],
$data["subtotal"],
$data["shippingFee"],
$data["total"]
);


$stmt->execute();


$order_id = $conn->insert_id;



foreach($items as $item){

    $itemTotal = $item["price"] * $item["quantity"];


    $itemSql = "INSERT INTO order_items
    (
    order_id,
    product_id,
    product_name,
    price,
    quantity,
    item_total
    )

    VALUES
    (?,?,?,?,?,?)";


    $itemStmt = $conn->prepare($itemSql);


    $itemStmt->bind_param(
        "iisdid",
        $order_id,
        $item["id"],
        $item["name"],
        $item["price"],
        $item["quantity"],
        $itemTotal
    );


    $itemStmt->execute();

}


echo json_encode([
    "success"=>true,
    "order_id"=>$order_id
]);


?>