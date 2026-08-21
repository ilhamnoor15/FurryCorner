<?php

include "db.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$email = trim($data["email"] ?? "");
$otp = trim($data["otp"] ?? "");

if (empty($email) || empty($otp)) {

    echo json_encode([
        "success" => false,
        "message" => "Missing email or code."
    ]);

    exit;
}

$stmt = $conn->prepare(
    "SELECT id, otp_hash, expires_at
     FROM admin_otp_codes
     WHERE email = ?
     ORDER BY id DESC
     LIMIT 1"
);

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {

    echo json_encode([
        "success" => false,
        "message" => "No verification code found. Please request a new one."
    ]);

    $stmt->close();
    $conn->close();
    exit;
}

$record = $result->fetch_assoc();
$stmt->close();

if (strtotime($record["expires_at"]) < time()) {

    $del = $conn->prepare("DELETE FROM admin_otp_codes WHERE id = ?");
    $del->bind_param("i", $record["id"]);
    $del->execute();
    $del->close();

    echo json_encode([
        "success" => false,
        "message" => "Your verification code has expired. Please request a new one."
    ]);

    $conn->close();
    exit;
}

if (!password_verify($otp, $record["otp_hash"])) {

    echo json_encode([
        "success" => false,
        "message" => "Incorrect verification code."
    ]);

    $conn->close();
    exit;
}

// Correct code — consume it so it can't be reused.

$del = $conn->prepare("DELETE FROM admin_otp_codes WHERE id = ?");
$del->bind_param("i", $record["id"]);
$del->execute();
$del->close();

echo json_encode([
    "success" => true
]);

$conn->close();

?>