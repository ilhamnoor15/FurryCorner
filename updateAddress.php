<?php

include "db.php";

header("Content-Type: application/json");

$data = json_decode(
    file_get_contents("php://input"),
    true
);

if (!$data) {

    echo json_encode([
        "success" => false,
        "message" => "Invalid data."
    ]);

    exit;
}

$user_id = $data["user_id"] ?? "";
$address = $data["address"] ?? "";
$city = $data["city"] ?? "";
$province = $data["province"] ?? "";
$postal = $data["postal"] ?? "";
$phone = $data["phone"] ?? "";


if (empty($user_id)) {

    echo json_encode([
        "success" => false,
        "message" => "User ID is required."
    ]);

    exit;
}


$sql = "UPDATE users
        SET
            address = ?,
            city = ?,
            province = ?,
            postal_code = ?,
            phone = ?
        WHERE user_id = ?";


$stmt = $conn->prepare($sql);


if (!$stmt) {

    echo json_encode([
        "success" => false,
        "message" => "Failed to prepare address update."
    ]);

    exit;
}


$stmt->bind_param(
    "sssssi",
    $address,
    $city,
    $province,
    $postal,
    $phone,
    $user_id
);


if (!$stmt->execute()) {

    echo json_encode([
        "success" => false,
        "message" => "Failed to save address."
    ]);

    exit;
}


echo json_encode([
    "success" => true,
    "message" => "Address saved successfully."
]);

?>