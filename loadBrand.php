<?php
include "connection.php";
session_start();

$categoryId = $_GET["c"];

if (isset($categoryId)) {

    $rs = Database::search("SELECT * FROM `category_has_brand` WHERE `category_id`='" . $categoryId . "'");
    $num = $rs->num_rows;

    for ($i = 0; $i < $num; $i++) {
        $d = $rs->fetch_assoc();

        $rs2 = Database::search("SELECT * FROM `brand` WHERE `id`='" . $d["brand_id"] . "'");
        $d2 = $rs2->fetch_assoc();
?>

        <option value="<?php echo $d2["id"]; ?>"><?php echo $d2["name"]; ?></option>

<?php
    }
}
