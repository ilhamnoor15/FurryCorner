<?php

include "db.php";

header("Content-Type: application/json");

if(!isset($_GET['user_id'])){

    echo json_encode([
        "status" => "error",
        "message" => "User ID is required."
    ]);

    exit;
}

$user_id = intval($_GET['user_id']);


/*
    Get orders belonging ONLY to this user.
*/

$sql = "
    SELECT
        o.order_id,
        o.payment_method,
        o.total_amount,
        o.status,
        o.order_date,
        COUNT(oi.item_id) AS item_count

    FROM orders o

    LEFT JOIN order_items oi
        ON o.order_id = oi.order_id

    WHERE o.user_id = ?

    GROUP BY
        o.order_id,
        o.payment_method,
        o.total_amount,
        o.status,
        o.order_date

    ORDER BY o.order_date DESC
";


$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $user_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$orders = [];

while($row = mysqli_fetch_assoc($result)){

    $orders[] = $row;

}


echo json_encode([
    "status" => "success",
    "orders" => $orders
]);

?>