<?php

include "db.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){


    $name = mysqli_real_escape_string($conn, $_POST["name"]);

    $category = mysqli_real_escape_string($conn, $_POST["category"]);

    $price = (float)$_POST["price"];

    $stock = (int)$_POST["stock"];


    $subcategory = "";


    $sql = "INSERT INTO products
    (product_name, category, subcategory, price, stock)

    VALUES

    ('$name','$category','$subcategory','$price','$stock')";


    if(mysqli_query($conn,$sql)){

        echo "success";

    }else{

        echo mysqli_error($conn);

    }


}

?>