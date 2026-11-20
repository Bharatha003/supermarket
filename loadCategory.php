<?php
include "connection.php";
session_start();

$rs = Database::search("SELECT * FROM `category`");
$num = $rs->num_rows;
?>

<option value="0">Select Category</option>

<?php
for ($i = 0; $i < $num; $i++) {
    $d = $rs->fetch_assoc();
?>

    <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>

<?php
}
