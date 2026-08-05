<?php

include "db.php";

$productQuery = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM products
");

$productCount =
mysqli_fetch_assoc($productQuery)["total"];


$serviceQuery = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM services
");

$serviceCount =
mysqli_fetch_assoc($serviceQuery)["total"];


$orderQuery = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM orders
");

$orderCount =
mysqli_fetch_assoc($orderQuery)["total"];


/* Low stock products */

$lowStockQuery = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM products
WHERE stock <= 5
");

$lowStockCount =
mysqli_fetch_assoc($lowStockQuery)["total"];


echo json_encode([

    "productCount"=>$productCount,

    "serviceCount"=>$serviceCount,

    "orderCount"=>$orderCount,

    "lowStockCount"=>$lowStockCount

]);

?>