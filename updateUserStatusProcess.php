<?php
include "connection.php";

$userId = $_POST["userId"];

$rs = Database::search("SELECT * FROM `user` 
    WHERE `id`='" . $userId . "'");

$num = $rs->num_rows;

for ($i = 0; $i < $num; $i++) {
    $d = $rs->fetch_assoc();
}

if ($d["status"] == '1') {
    Database::iud("UPDATE `user` SET `status`='2' WHERE `id`='" . $userId . "'");
    echo ("Success");
} else {
    Database::iud("UPDATE `user` SET `status`='1' WHERE `id`='" . $userId . "'");
    echo ("Success");
}
