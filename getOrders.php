<?php

include "db.php";


$sql = "

SELECT 
    o.order_id,
    CONCAT(o.first_name, ' ', o.last_name) AS customer_name,
    oi.product_name,
    oi.quantity,
    oi.item_total,
    o.payment_method,
    o.status,
    DATE_FORMAT(o.order_date, '%m-%d-%Y') AS order_date

FROM orders o

JOIN order_items oi

ON o.order_id = oi.order_id

ORDER BY o.order_id DESC

";


$result = mysqli_query($conn, $sql);


$orders = [];


while($row = mysqli_fetch_assoc($result)){

    $orders[] = [

        "id" => $row["order_id"],
        "customer" => $row["customer_name"],
        "product" => $row["product_name"],
        "quantity" => $row["quantity"],
        "total" => $row["item_total"],
        "payment" => $row["payment_method"],
        "status" => $row["status"],
        "date" => $row["order_date"]

    ];

}


echo json_encode($orders);


?>