<?php

include "connection.php";

$cartId = $_POST["c"];
$newQty = $_POST["q"];

$rs = Database::search("SELECT cart.*,
stock.qty AS stock_qty 
FROM cart 
INNER JOIN stock ON cart.stock_id = stock.id 
WHERE cart.id = '" . $cartId . "'");

$num = $rs->num_rows;

if ($num > 0) {
    $d = $rs->fetch_assoc();

    if ($d["stock_qty"] >= $newQty) {
        Database::iud("UPDATE cart SET qty = '" . $newQty . "' WHERE id = '" . $cartId . "' ");
        echo ("Success");
    } else {
        echo ("You have reached to the Maximum Quantity!");
    }
} else {
    echo ("Cart Item Not Found!");
}
