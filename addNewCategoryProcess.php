<?php
include "connection.php";
session_start();

$newCategory = ucwords($_POST["nc"]);

if (empty($newCategory)) {
    echo ("Please add the Category!");
} else {

    $rs = Database::search("SELECT * FROM `category` WHERE `name` = '" . $newCategory . "'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("This Category is already exist!");
    } else {
        $d = $rs->fetch_assoc();

        Database::iud("INSERT INTO `category` (`name`) VALUES ('" . $newCategory . "')");
        echo ("Category Added Successfully...");
    }
}
