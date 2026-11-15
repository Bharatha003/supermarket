<?php
include "connection.php";

$cartId = $_POST["c"];

Database::iud("DELETE FROM `cart` WHERE `id` = '" . $cartId . "'");

echo ("Item Removed from Cart Successfully...");
