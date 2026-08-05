<?php

include "db.php";


$data = json_decode(
    file_get_contents("php://input"),
    true
);


$email = $data["email"];
$password = $data["password"];



$sql = "

SELECT *
FROM users
WHERE email='$email'
AND role='customer'

";


$result = mysqli_query($conn,$sql);


if(mysqli_num_rows($result) > 0){


    $user = mysqli_fetch_assoc($result);


    if(password_verify($password,$user["password"])){


        echo json_encode([

            "status"=>"success",

            "user"=>[

                "id"=>$user["user_id"],
                "firstName"=>$user["first_name"],
                "lastName"=>$user["last_name"],
                "email"=>$user["email"]

            ]

        ]);


    }else{


        echo json_encode([

            "status"=>"error",
            "message"=>"Incorrect password"

        ]);


    }


}else{


    echo json_encode([

        "status"=>"error",
        "message"=>"Account not found"

    ]);


}


?>