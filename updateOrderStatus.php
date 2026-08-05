<?php

include "db.php"; // your database connection

if(isset($_POST['order_id']) && isset($_POST['status'])){

    $order_id = $_POST['order_id'];
    $status = $_POST['status'];


    $sql = "UPDATE orders 
            SET status = ?
            WHERE order_id = ?";


    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "si",
        $status,
        $order_id
    );


    if(mysqli_stmt_execute($stmt)){

        echo "success";

    }else{

        echo "error";

    }


}else{

    echo "missing data";

}

?>