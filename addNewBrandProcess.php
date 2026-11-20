<?php
include "connection.php";
session_start();

$newBrand = ucwords($_POST["nb"]);
$modalCategory = $_POST["mc"];

if (empty($newBrand)) {
    echo ("Please add the Brand!");
} elseif (empty($modalCategory)) {
    echo ("Please select a Category!");
} else {

    $rs = Database::search("SELECT * FROM `brand` WHERE `name` = '" . $newBrand . "'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("This Brand is already exist!");
    } else {
        $d = $rs->fetch_assoc();

        Database::iud("INSERT INTO `brand` (`name`) VALUES ('" . $newBrand . "')");

        $rs2 = Database::search("SELECT * FROM `brand` WHERE `name` = '" . $newBrand . "'");
        $num2 = $rs2->num_rows;

        for ($i = 0; $i < $num2; $i++) {
            $d2 = $rs2->fetch_assoc();

            Database::iud("INSERT INTO `category_has_brand` (`category_id`,`brand_id`) VALUES ('" . $modalCategory . "', '" . $d2["id"] . "')");
        }

        echo ("Brand Added Successfully...");
    }
}
