<?php

include "db.php";


$data = json_decode(
    file_get_contents("php://input"),
    true
);


$firstName = $data["firstName"];
$lastName  = $data["lastName"];
$email     = $data["email"];
$password  = $data["password"];


// check existing email

$check = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE email='$email'"
);


if(mysqli_num_rows($check) > 0){

    echo "Email already registered";
    exit;

}


// encrypt password

$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);


// default customer role

$role = "customer";


// insert user

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


if(mysqli_query($conn,$sql)){

    echo "success";

}else{

    echo mysqli_error($conn);

}


?>