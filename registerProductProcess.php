<?php
include "connection.php";
session_start();

$productName = ucwords($_POST["pn"]);
$category = $_POST["c"];
$brand = $_POST["b"];
$description = ucfirst($_POST["d"]);

// Validations
if (empty($productName)) {
    echo ("Please add the Product Name!");
} elseif (empty($_FILES["pimg"])) {
    echo ("empty");
} elseif (empty($category)) {
    echo ("Please select a Category!");
} elseif (empty($brand)) {
    echo ("Please select a Brand!");
} elseif (strlen($description) >= 100) {
    echo ("Description should have less than 100 characters!");
} else {

    $rs = Database::search("SELECT * FROM `product` 
    WHERE `name` = '" . $productName . "' AND 
    `category_id` = '" . $category . "' AND 
    `brand_id` = '" . $brand . "'");

    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("This Product is already exist!");
    } else {
        $d = $rs->fetch_assoc();

        $path = "Resources/ProductImg//" . uniqid() . ".png";
        move_uploaded_file($_FILES["pimg"]["tmp_name"], $path);

        Database::iud("INSERT INTO `product` (`name`, `description`, `img_path`, `category_id`, `brand_id`) 
        VALUES ('" . $productName . "', '" . $description . "', '" . $path . "', '" . $category . "', '" . $brand . "')");

        echo ("Product Added Successfully...");
        echo ("Success");
    }
}
