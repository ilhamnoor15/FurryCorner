<?php
include "db.php";

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
    echo $row['product_name'] . " - ₱" . $row['price'] . "<br>";
}
?>