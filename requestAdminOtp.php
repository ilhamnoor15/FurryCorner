<?php

include "db.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$email = trim($data["email"] ?? "");

if (empty($email)) {

    echo json_encode([
        "success" => false,
        "message" => "Personal email is required."
    ]);

    exit;
}

/*
    Only emails that exist in admin_emails are allowed
    to request a code. This is what stops a random
    person from typing in any email and getting in.
*/

$stmt = $conn->prepare("SELECT email FROM admin_emails WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {

    echo json_encode([
        "success" => false,
        "message" => "This email is not authorized for admin access."
    ]);

    $stmt->close();
    $conn->close();
    exit;
}

$stmt->close();

/*
    Generate a 6-digit code, store only its hash with a
    5-minute expiry, and return the plaintext code once
    so the browser can hand it to EmailJS for delivery.
*/

$otp = strval(random_int(100000, 999999));
$otpHash = password_hash($otp, PASSWORD_DEFAULT);
$expiresAt = date("Y-m-d H:i:s", time() + (5 * 60));

$del = $conn->prepare("DELETE FROM admin_otp_codes WHERE email = ?");
$del->bind_param("s", $email);
$del->execute();
$del->close();

$ins = $conn->prepare("INSERT INTO admin_otp_codes (email, otp_hash, expires_at) VALUES (?, ?, ?)");
$ins->bind_param("sss", $email, $otpHash, $expiresAt);

if ($ins->execute()) {

    echo json_encode([
        "success" => true,
        "otp" => $otp,
        "expiresInSeconds" => 300
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Failed to generate a verification code."
    ]);

}

$ins->close();
$conn->close();

?>