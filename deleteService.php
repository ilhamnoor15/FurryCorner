<?php

include "db.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){


    $id = (int)$_POST["id"];


    $sql = "DELETE FROM services 
            WHERE service_id = $id";


    if(mysqli_query($conn,$sql)){

        echo "success";

    }else{

        echo mysqli_error($conn);

    }

}

?>