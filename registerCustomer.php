php
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
        "message" => "Invalid request data"
    ]);
    exit;
}

$firstName = mysqli_real_escape_string(
    $conn,
    $data["firstName"] ?? ""
);

$lastName = mysqli_real_escape_string(
    $conn,
    $data["lastName"] ?? ""
);

$email = mysqli_real_escape_string(
    $conn,
    strtolower(trim($data["email"] ?? ""))
);

$password = $data["password"] ?? "";

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

$check = mysqli_query(
    $conn,
    "SELECT user_id FROM users WHERE email='$email' LIMIT 1"
);

if (mysqli_num_rows($check) > 0) {

    echo json_encode([
        "success" => false,
        "message" => "Email already registered"
    ]);

    exit;
}


// Hash password

$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);


// Default role

$role = "customer";


// Insert user

$sql = "
    INSERT INTO users
    (
        first_name,
        last_name,
        email,
        password,
        role
    )
    VALUES
    (
        '$firstName',
        '$lastName',
        '$email',
        '$hashedPassword',
        '$role'
    )
";


if (mysqli_query($conn, $sql)) {

    $userId = mysqli_insert_id($conn);

    echo json_encode([
        "success" => true,
        "message" => "Account created successfully",
        "user" => [
            "id" => $userId,
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" => $email,
            "role" => $role
        ]
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => mysqli_error($conn)
    ]);

}

?>