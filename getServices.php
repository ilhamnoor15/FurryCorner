<?php

include "db.php";


$sql = "SELECT * FROM services ORDER BY service_id ASC";

$result = mysqli_query($conn, $sql);


$services = [];


while($row = mysqli_fetch_assoc($result)){

    $services[] = [

        "id" => (int)$row["service_id"],

        "name" => $row["service_name"],

        "category" => $row["category"],

        "price" => $row["price"],

        "duration" => $row["duration"],

        "status" => $row["status"],

        "image" => $row["image"]

    ];

}


echo json_encode($services);

?>