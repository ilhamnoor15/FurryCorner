<?php

session_start();

include "db.php";

$data = json_decode(
    file_get_contents("php://input"),
    true
);

$firstName = $data["firstName"];
$lastName  = $data["lastName"];
$email     = $data["email"];
$password  = $data["password"];


// Check existing email
$check = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE email='$email'"
);

if(mysqli_num_rows($check) > 0){

    echo json_encode([
        "success" => false,
        "message" => "Email already registered"
    ]);

    exit;
}


// Encrypt password
$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);


// Default customer role
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


if(mysqli_query($conn, $sql)){

    // Get newly created user's ID
    $userId = mysqli_insert_id($conn);


    // Create PHP session
    $_SESSION['user_id'] = $userId;
    $_SESSION['user_email'] = $email;
    $_SESSION['first_name'] = $firstName;
    $_SESSION['last_name'] = $lastName;
    $_SESSION['role'] = $role;


    // Return user information to JavaScript
    echo json_encode([

        "success" => true,

        "user_id" => $userId,

        "first_name" => $firstName,

        "last_name" => $lastName,

        "email" => $email,

        "role" => $role

    ]);

}else{

    echo json_encode([

        "success" => false,

        "message" => mysqli_error($conn)

    ]);

}

?>