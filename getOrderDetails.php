<?php

include "db.php";

header("Content-Type: application/json");


// Get order ID
$order_id = isset($_GET['id'])
    ? intval($_GET['id'])
    : 0;


// Validate order ID
if ($order_id <= 0) {

    echo json_encode([
        "success" => false,
        "message" => "Invalid order ID."
    ]);

    exit;
}


// =========================
// GET ORDER INFORMATION
// =========================

$sql = "
    SELECT
        order_id,
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
        status,
        order_date
    FROM orders
    WHERE order_id = ?
";


$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {

    echo json_encode([
        "success" => false,
        "message" => "Database query failed."
    ]);

    exit;
}


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $order_id
);


mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);


$order = mysqli_fetch_assoc($result);


mysqli_stmt_close($stmt);


// Check if order exists
if (!$order) {

    echo json_encode([
        "success" => false,
        "message" => "Order not found."
    ]);

    exit;
}


// =========================
// GET ORDER ITEMS
// =========================

$sqlItems = "
    SELECT *
    FROM order_items
    WHERE order_id = ?
";


$stmtItems = mysqli_prepare($conn, $sqlItems);


if (!$stmtItems) {

    echo json_encode([
        "success" => false,
        "message" => "Unable to retrieve order items."
    ]);

    exit;
}


mysqli_stmt_bind_param(
    $stmtItems,
    "i",
    $order_id
);


mysqli_stmt_execute($stmtItems);


$resultItems = mysqli_stmt_get_result($stmtItems);


$items = [];


while ($row = mysqli_fetch_assoc($resultItems)) {

    $items[] = $row;

}


mysqli_stmt_close($stmtItems);


// Add items to order
$order['items'] = $items;


// =========================
// RETURN ORDER
// =========================

echo json_encode([
    "success" => true,
    "order" => $order
]);


mysqli_close($conn);

?>