<?php

include "db.php";

if(isset($_POST['id'])){

    $id = (int)$_POST['id'];

    $sql = "DELETE FROM products WHERE product_id = $id";

    if(mysqli_query($conn, $sql)){

        echo "success";

    }else{

        echo mysqli_error($conn);

    }

}

?>