<?php

include "db.php";

header("Content-Type: application/json");

$user_id = $_GET["user_id"] ?? "";

if (empty($user_id)) {

    echo json_encode([
        "success" => false,
        "message" => "User ID is required."
    ]);

    exit;
}

$sql = "SELECT
            user_id,
            first_name,
            last_name,
            email,
            address,
            city,
            province,
            postal_code,
            phone,
            created_at
        FROM users
        WHERE user_id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {

    echo json_encode([
        "success" => false,
        "message" => "Failed to prepare profile query."
    ]);

    exit;
}

$stmt->bind_param("i", $user_id);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {

    echo json_encode([
        "success" => false,
        "message" => "User not found."
    ]);

    exit;
}

$user = $result->fetch_assoc();

echo json_encode([
    "success" => true,
    "user" => [
        "id" => $user["user_id"],
        "firstName" => $user["first_name"],
        "lastName" => $user["last_name"],
        "email" => $user["email"],
        "address" => $user["address"],
        "city" => $user["city"],
        "province" => $user["province"],
        "postal" => $user["postal_code"],
        "phone" => $user["phone"],
        "createdAt" => $user["created_at"]
    ]
]);

?>