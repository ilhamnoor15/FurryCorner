<?php

include "db.php";


$sql = "SELECT * FROM products ORDER BY product_id ASC";

$result = mysqli_query($conn, $sql);


$products = [];


while($row = mysqli_fetch_assoc($result)){


    $products[] = [

        "id" => (int)$row["product_id"],
        "name" => $row["product_name"],
        "category" => $row["category"],
        "subcategory" => $row["subcategory"],
        "price" => (float)$row["price"],
        "stock" => (int)$row["stock"],
        "status" => $row["stock"] > 0 
            ? "In Stock" 
            : "Out of Stock"

    ];

}


echo json_encode($products);

?>