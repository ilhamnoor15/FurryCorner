<?php

include "db.php";

header("Content-Type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request data"
    ]);
    exit;
}

$firstName = trim($data["firstName"] ?? "");
$lastName  = trim($data["lastName"] ?? "");
$email     = strtolower(trim($data["email"] ?? ""));
$password  = $data["password"] ?? "";

if (
    empty($firstName) ||
    empty($lastName) ||
    empty($email) ||
    empty($password)
) {
    echo json_encode([
        "success" => false,
        "message" => "All fields are required"
    ]);
    exit;
}


// Check if email already exists

$stmt = mysqli_prepare(
    $conn,
    "SELECT user_id FROM users WHERE email = ? LIMIT 1"
);

mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {

    mysqli_stmt_close($stmt);

    echo json_encode([
        "success" => false,
        "message" => "Email already registered"
    ]);

    exit;
}

mysqli_stmt_close($stmt);


// Hash password

$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);

$role = "customer";


// Insert user

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO users
    (
        first_name,
        last_name,
        email,
        password,
        role
    )
    VALUES (?, ?, ?, ?, ?)"
);

mysqli_stmt_bind_param(
    $stmt,
    "sssss",
    $firstName,
    $lastName,
    $email,
    $hashedPassword,
    $role
);


if (mysqli_stmt_execute($stmt)) {

    $userId = mysqli_insert_id($conn);

    echo json_encode([
        "success" => true,
        "message" => "Account created successfully",

        "user_id" => $userId,
        "first_name" => $firstName,
        "last_name" => $lastName,
        "email" => $email,
        "role" => $role
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => mysqli_error($conn)
    ]);
}


mysqli_stmt_close($stmt);
mysqli_close($conn);

?>