<?php

include "connection.php";
session_start();

$user = $_SESSION["u"];
$stockId = $_POST["s"];
$qty = $_POST["q"];

$rs = Database::search("SELECT * FROM `stock` WHERE `id` = '" . $stockId . "'");
$num = $rs->num_rows;

if ($num > 0) {
    $d = $rs->fetch_assoc();
    $stockQty = $d["qty"];

    $rs2 = Database::search("SELECT * FROM `cart` WHERE `user_id` = '" . $user["id"] . "' AND `stock_id` = '" . $stockId . "'");
    $num2 = $rs2->num_rows;

    if ($num2 > 0) {

        $d2 = $rs2->fetch_assoc();
        $newQty = $qty + $d2["qty"];

        if ($stockQty >= $newQty) {
            Database::iud("UPDATE `cart` SET `qty` = '" . $newQty . "' WHERE `id`= '" . $d2["id"] . "'");
            echo ("Cart Item Updated Successfully...");
        } else {
            echo ("Stock quantity has been exceeded!");
        }
    } else {

        if ($stockQty >= $qty) {
            Database::iud("INSERT INTO `cart` (`qty`, `user_id`, `stock_id`) VALUES ('" . $qty . "', '" . $user["id"] . "', '" . $stockId . "')");
            echo ("Cart Item Added Successfully...");
        } else {
            echo ("Stock quantity has been exceeded!");
        }
    }
} else {
    echo ("Your Stock is not Found!");
}
