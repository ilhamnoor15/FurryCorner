<?php

include "db.php";


if($_SERVER["REQUEST_METHOD"]=="POST"){


$id = $_POST["id"];

$name = mysqli_real_escape_string($conn,$_POST["name"]);

$category = mysqli_real_escape_string($conn,$_POST["category"]);

$price = $_POST["price"];

$stock = $_POST["stock"];



$sql = "UPDATE products SET

product_name='$name',

category='$category',

price='$price',

stock='$stock'

WHERE product_id='$id'";



if(mysqli_query($conn,$sql)){

echo "success";

}else{

echo mysqli_error($conn);

}


}

?>