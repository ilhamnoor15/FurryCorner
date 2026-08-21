<?php

include "db.php";

header("Content-Type: application/json");

$user_id = isset($_GET['user_id'])
    ? intval($_GET['user_id'])
    : 0;

if ($user_id <= 0) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid user ID."
    ]);
    exit;
}

$sql = "
    SELECT
        order_id,
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
    WHERE user_id = ?
    ORDER BY order_date DESC
";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $user_id);

$stmt->execute();

$result = $stmt->get_result();

$orders = [];

while ($row = $result->fetch_assoc()) {

    $orders[] = $row;

}

echo json_encode([
    "success" => true,
    "orders" => $orders
]);

$stmt->close();
$conn->close();

?>