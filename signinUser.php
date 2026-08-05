<?php

include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$email = mysqli_real_escape_string($conn, $data["email"]);
$password = $data["password"];

$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0){

    echo json_encode([
        "success" => false,
        "message" => "Email not found"
    ]);

    exit;

}

$user = mysqli_fetch_assoc($result);

if(!password_verify($password, $user["password"])){

    echo json_encode([
        "success" => false,
        "message" => "Incorrect password"
    ]);

    exit;

}

echo json_encode([

    "success" => true,

    "user_id" => $user["user_id"],

    "first_name" => $user["first_name"],

    "last_name" => $user["last_name"],

    "email" => $user["email"],

    "role" => $user["role"]

]);

?>