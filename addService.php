<?php

include "db.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){


    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $category = mysqli_real_escape_string($conn, $_POST["category"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $duration = mysqli_real_escape_string($conn, $_POST["duration"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);


    $sql = "INSERT INTO services
            (service_name, category, price, duration, status)

            VALUES

            ('$name',
             '$category',
             '$price',
             '$duration',
             '$status')";


    if(mysqli_query($conn,$sql)){

        echo "success";

    }else{

        echo mysqli_error($conn);

    }

}

?>