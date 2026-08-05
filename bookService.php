<?php

include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$userId = $data["user_id"];
$serviceId = $data["service_id"];
$petName = $data["pet_name"];
$bookingDate = $data["booking_date"];
$bookingTime = $data["booking_time"];

// Get customer information
$userQuery = mysqli_query(
    $conn,
    "SELECT first_name,last_name,email
     FROM users
     WHERE user_id='$userId'"
);

if(mysqli_num_rows($userQuery) == 0){

    echo json_encode([
        "status"=>"error",
        "message"=>"Customer not found"
    ]);

    exit;

}

$user = mysqli_fetch_assoc($userQuery);

$customerName =
$user["first_name"] . " " . $user["last_name"];

$customerContact =
$user["email"];

// Save booking
$sql = "

INSERT INTO bookings
(
user_id,
service_id,
pet_name,
customer_name,
customer_contact,
booking_date,
booking_time,
status
)

VALUES
(
'$userId',
'$serviceId',
'$petName',
'$customerName',
'$customerContact',
'$bookingDate',
'$bookingTime',
'Pending'
)

";

if(mysqli_query($conn,$sql)){

    echo json_encode([
        "status"=>"success"
    ]);

}else{

    echo json_encode([
        "status"=>"error",
        "message"=>mysqli_error($conn)
    ]);

}

?>