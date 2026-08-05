<?php

include "db.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){


    $id = (int)$_POST["id"];

    $name = mysqli_real_escape_string($conn, $_POST["name"]);

    $category = mysqli_real_escape_string($conn, $_POST["category"]);

    $price = mysqli_real_escape_string($conn, $_POST["price"]);

    $duration = mysqli_real_escape_string($conn, $_POST["duration"]);

    $status = mysqli_real_escape_string($conn, $_POST["status"]);



    $sql = "UPDATE services SET

            service_name = '$name',

            category = '$category',

            price = '$price',

            duration = '$duration',

            status = '$status'


            WHERE service_id = $id";



    if(mysqli_query($conn,$sql)){


        echo "success";


    }else{


        echo mysqli_error($conn);


    }


}

?>