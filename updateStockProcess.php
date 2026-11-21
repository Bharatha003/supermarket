<?php
include "connection.php";
session_start();

$productId = $_POST["sp"];
$qty = $_POST["qty"];
$price = $_POST["up"];

if (empty($productId)) {
    echo ("Please select a Product Name!");
} elseif (strlen($qty) > 10) {
    echo ("Your Qty Should be less than 10 Characters!");
} elseif (empty($price) || $price == "0") {
    echo ("Please Enter Your Unit Price!");
} elseif (!is_numeric($price)) {
    echo ("Only Numbers Can Be Entered for Unit Price!");
} elseif (strlen($price) > 10) {
    echo ("Your Price Should be less than 10 Characters!");
} else {

    $rs = Database::search("SELECT * FROM `stock` WHERE `product_id` = '" . $productId . "'");
    $num = $rs->num_rows;
    $d = $rs->fetch_assoc();

    if (empty($qty) || !is_numeric($qty)) {
        $qty = 0;
    }

    if ($num == 1) {
        $newQty = $d["qty"] + $qty;
        Database::iud("UPDATE `stock` SET `qty` = '" . $newQty . "',  `price` = '" . $price . "' 
            WHERE `product_id` = '" . $productId . "'");
        echo ("Stock Updated Successfully...");
    } else {
        Database::iud("INSERT INTO `stock` (`price`, `qty`, `product_id`) 
            VALUES ('" . $price . "', '" . $qty . "', '" . $productId . "')");
        echo ("New Stock Added Successfully...");
    }
}
