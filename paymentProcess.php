<?php
include "connection.php";
session_start();

$user = $_SESSION["u"];
$stockList = array();
$qtyList = array();

if (isset($_POST["cart"]) && $_POST["cart"] == "true") {
    $rs = Database::search("SELECT * FROM `cart` 
    WHERE `user_id`='" . $user["id"] . "'");

    $num = $rs->num_rows;

    for ($i = 0; $i < $num; $i++) {
        $d = $rs->fetch_assoc();

        $stockList[] = $d["stock_id"];
        $qtyList[] = $d["qty"];
    }
} else {
    $stockList[] = $_POST["stockId"];
    $qtyList[] = $_POST["qty"];
}

$merchantId = "1239320";
$merchantSecret = "MjE0NzY4MDk4OTM5ODkwODg2ODk2OTQzNzkwMDc0MDczODU5Mjc3";
$items = "";
$netTotal = 0;
$currency = "LKR";
$orderId = uniqid();

for ($i = 0; $i < sizeof($stockList); $i++) {

    $rs2 = Database::search("SELECT stock.*,
    product.name AS product_name,
    stock.qty AS stock_qty,
    stock.price AS stock_price
    FROM `stock` 
    INNER JOIN `product` ON `stock`.`product_id`=`product`.`id` 
    WHERE `stock`.`id`='" . $stockList[$i] . "'");

    $d2 = $rs2->fetch_assoc();
    $stockQty = $d2["stock_qty"];

    if ($stockQty >= $qtyList[$i]) {
        $items .= $d2["product_name"];

        if ($i != sizeof($stockList) - 1) {
            $items .= ", ";
        }

        $netTotal += (intval($d2["stock_price"]) * intval($qtyList[$i]));
    } else {
        echo ("Product has no available Stock!");
    }
}

$netTotal += 500;

$hash = strtoupper(
    md5(
        $merchantId .
            $orderId .
            number_format($netTotal, 2, '.', '') .
            $currency .
            strtoupper(md5($merchantSecret))
    )
);

$payment = array();
$payment["sandbox"] = true;
$payment["merchant_id"] = $merchantId;
$payment["first_name"] = $user["fname"];
$payment["last_name"] = $user["lname"];
$payment["email"] = $user["email"];
$payment["phone"] = $user["mobile"];
$payment["address"] = $user["line1"];
$payment["city"] = $user["line2"];
$payment["country"] = "Sri Lanka";
$payment["order_id"] = $orderId;
$payment["items"] = $items;
$payment["currency"] = $currency;
$payment["amount"] = number_format($netTotal, 2, '.', '');
$payment["hash"] = $hash;
$payment["return_url"] = "";
$payment["cancel_url"] = "";
$payment["notify_url"] = "";

echo json_encode($payment);
