<?php

include "db.php";

header("Content-Type: application/json");

$user_id = isset($_GET['user_id'])
    ? intval($_GET['user_id'])
    : 0;


if($user_id <= 0){

    echo json_encode([
        "success" => false,
        "message" => "Invalid user."
    ]);

    exit;

}


/*
    Get all orders belonging to this customer.
*/

$sql = "
    SELECT
        o.order_id,
        o.user_id,
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
        o.user_id,
        o.total_amount,
        o.status,
        o.order_date

    ORDER BY o.order_date DESC
";


$stmt = mysqli_prepare($conn, $sql);


if(!$stmt){

    echo json_encode([
        "success" => false,
        "message" => "Database query failed."
    ]);

    exit;

}


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $user_id
);


mysqli_stmt_execute($stmt);


$result =
    mysqli_stmt_get_result($stmt);


$orders = [];


while($row = mysqli_fetch_assoc($result)){

    $orders[] = $row;

}


echo json_encode([
    "success" => true,
    "orders" => $orders
]);


mysqli_stmt_close($stmt);

?>