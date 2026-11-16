<?php
include "connection.php";
session_start();

$user = $_SESSION["u"];

if (isset($_POST["payment"])) {

    $payment = json_decode($_POST["payment"], true);

    $date = new DateTime();
    $date->setTimezone(new DateTimeZone("Asia/Colombo"));
    $time = $date->format("Y-m-d H-i-s");

    Database::iud("INSERT INTO `order_history`(`order_id`,`date`,`amount`,`user_id`) 
    VALUES('" . $payment["order_id"] . "','" . $time . "','" . $payment["amount"] . "','" . $user["id"] . "')");

    $orderHistoryId = Database::$connection->insert_id;
    error_log("Order History ID (checkout): " . $orderHistoryId);

    $rs = Database::search("SELECT cart.*,
    cart.qty AS cart_qty,
    cart.stock_id AS cart_stock_id
    FROM `cart` 
    WHERE `user_id`='" . $user["id"] . "'");

    $num = $rs->num_rows;

    for ($i = 0; $i < $num; $i++) {
        $d = $rs->fetch_assoc();

        Database::iud("INSERT INTO `order_item`(`qty`,`order_history_id`,`stock_id`) 
        VALUES('" . $d["cart_qty"] . "','" . $orderHistoryId . "','" . $d["cart_stock_id"] . "')");

        $rs2 = Database::search("SELECT stock.*,
        stock.qty AS stock_qty 
        FROM `stock` 
        WHERE `id`='" . $d["cart_stock_id"] . "'");

        $d2 = $rs2->fetch_assoc();

        $newQty = $d2["stock_qty"] - $d["cart_qty"];
        Database::iud("UPDATE `stock` SET `qty`='" . $newQty . "' WHERE `id`='" . $d["stock_stock_id"] . "'");
    }

    Database::iud("DELETE FROM `cart` WHERE `user_id`='" . $user["id"] . "'");

    $order = array();
    $order["resp"] = "Success";
    $order["order_id"] = $orderHistoryId;

    echo json_encode($order);
}
