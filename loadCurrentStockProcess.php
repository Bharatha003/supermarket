<?php
include "connection.php";
session_start();

$productId = $_POST["sp"];

if (empty($productId)) {
    echo ("empty");
} else {

    $rs = Database::search("SELECT * FROM `stock` WHERE `product_id` = '" . $productId . "'");
    $num = $rs->num_rows;
    $d = $rs->fetch_assoc();

    if ($num == 1) {
        $currentStock = array();
        $currentStock["qty"] = $d["qty"];
        $currentStock["unitPrice"] = $d["price"];

        echo json_encode($currentStock);
    }
}
