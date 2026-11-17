<?php

include "connection.php";

$rs = Database::search("SELECT
product.id AS product_id,
product.name AS product_name, 
stock.qty AS stock_qty 
FROM `stock`  
INNER JOIN `product` ON `stock`.`product_id` = `product`.`id` 
ORDER BY `stock_qty` ASC LIMIT 10");

$num = $rs->num_rows;

$labels = array();
$data = array();

for ($i = 0; $i < $num; $i++) {
    $d = $rs->fetch_assoc();

    $labels[] = $d["product_name"];
    $data[] = $d["stock_qty"];
}

$json = array();
$json["labels"] = $labels;
$json["data"] = $data;

echo json_encode($json);
