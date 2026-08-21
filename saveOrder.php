<?php

include "db.php";

header("Content-Type: application/json");


$data = json_decode(
    file_get_contents("php://input"),
    true
);


if(!$data){

    echo json_encode([
        "success" => false,
        "message" => "Invalid order data."
    ]);

    exit;

}


$user_id = $data["user_id"] ?? null;

$shipping = $data["shipping"] ?? [];
$items = $data["items"] ?? [];


if(!$user_id){

    echo json_encode([
        "success" => false,
        "message" => "User ID is required."
    ]);

    exit;

}


if(empty($items)){

    echo json_encode([
        "success" => false,
        "message" => "Your cart is empty."
    ]);

    exit;

}


/* =========================
   INSERT ORDER
========================= */

$sql = "INSERT INTO orders
(
    user_id,
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
    ?,
    'Processing'
)";


$stmt = $conn->prepare($sql);


if(!$stmt){

    echo json_encode([
        "success" => false,
        "message" => "Failed to prepare order."
    ]);

    exit;

}


$stmt->bind_param(
    "issssssssddd",

    $user_id,

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


if(!$stmt->execute()){

    echo json_encode([
        "success" => false,
        "message" => "Failed to save order."
    ]);

    exit;

}


$order_id = $conn->insert_id;


/* =========================
   INSERT ORDER ITEMS
========================= */

foreach($items as $item){

    $itemTotal =
        $item["price"] *
        $item["quantity"];


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


    $itemStmt =
        $conn->prepare($itemSql);


    if(!$itemStmt){

        echo json_encode([
            "success" => false,
            "message" => "Failed to prepare order items."
        ]);

        exit;

    }


    $itemStmt->bind_param(
        "iisdid",

        $order_id,
        $item["id"],
        $item["name"],
        $item["price"],
        $item["quantity"],
        $itemTotal
    );


    if(!$itemStmt->execute()){

        echo json_encode([
            "success" => false,
            "message" => "Failed to save order items."
        ]);

        exit;

    }

}


/* =========================
   SUCCESS
========================= */

echo json_encode([

    "success" => true,

    "order_id" => $order_id

]);

?>