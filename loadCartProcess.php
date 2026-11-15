<?php
include "connection.php";
session_start();

$user = $_SESSION["u"];
$netTotal = 0;

$rs = Database::search("SELECT cart.*,
product.id AS product_id,
product.name AS product_name,
product.img_path AS product_img_path,
stock.price AS product_price,
category.name AS category_name,
brand.name AS brand_name,
cart.id AS cart_id,
cart.qty AS cart_qty 
FROM cart 
INNER JOIN stock ON cart.stock_id = stock.id 
INNER JOIN product ON stock.product_id = product.id 
INNER JOIN category ON product.category_id = category.id
INNER JOIN brand ON product.brand_id = brand.id 
WHERE cart.user_id= '" . $user["id"] . "'");

$num = $rs->num_rows;

if ($num > 0) {
?>

    <div class="col-10 mx-auto mt-1">
        <h3 class="fw-bold mb-4">Shopping Cart</h3>
    </div>

    <?php
    for ($i = 0; $i < $num; $i++) {
        $d = $rs->fetch_assoc();

        $total = $d["product_price"] * $d["cart_qty"];
        $netTotal += $total;
    ?>

        <!--Cart Items  -->
        <div class="col-10 mx-auto border border-2 border-success bg-white rounded-4 p-3 mb-3 d-flex justify-content-between">

            <div class="d-flex align-items-center col-5">
                <a href="singleProductView.php?s=<?php echo $d["product_id"] ?>"><img src="<?php echo $d["product_img_path"] ?>" class="rounded-4" width="200px" /></a>
                <div class="col-8 ms-3">
                    <h4 class="fw-bold"><?php echo $d["product_name"] ?></h4>
                    <h6 class="col-6 bg-dark text-light text-center rounded-pill mt-2"><?php echo $d["category_name"]; ?></h6>
                    <br />
                    <h5 class="">Rs.<?php echo $d["product_price"] ?>.00</h5>
                </div>
            </div>

            <div class="col-2 d-flex align-items-center">
                <div class="input-group rounded-4">
                    <button class="btn btn-dark" type="button" onclick="decreaseCartQty(<?php echo $d['cart_id'] ?>);"><i class="bi bi-dash-circle fs-6"></i></button>
                    <input type="number" id="qty<?php echo $d['cart_id'] ?>" class="form-control border border-dark text-center" value="<?php echo $d["cart_qty"] ?>" aria-label="Example text with two button addons" disabled>
                    <button class="btn btn-dark" type="button" onclick='increaseCartQty(<?php echo $d["cart_id"] ?>);'><i class="bi bi-plus-circle fs-6"></i></button>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <h4>Total: Rs.<?php echo $total ?>.00</h4>
            </div>

            <div class="d-flex align-items-center btn btn-danger btn-lg" onclick="removeFromCart(<?php echo $d['cart_id'] ?>);" title="Remove Item">
                <i class="bi bi-trash-fill fs-5"></i>
            </div>

        </div>
        <!-- Cart Items -->

    <?php
    }
    ?>

    <div class="col-10 mx-auto mt-4">
        <hr />
    </div>

    <!-- Checkout -->
    <div class="col-11 d-flex flex-column align-items-end">
        <h5>Number of Items: <?php echo $num ?></h5>
        <h5>Delivery Fee: Rs.500.00</h5>
        <h4 class="fw-bold">Net Total: Rs.<?php echo ($netTotal + 500) ?>.00</h4>
        <button class="btn btn-success rounded-pill col-3 mt-3 mb-4" onclick="checkOut();">CHECKOUT</button>
    </div>
    <!-- Checkout -->

<?php
} else {
?>

    <!-- Empty Cart View Message -->
    <div class="col-10 bg-white shadow rounded-4 mx-auto mb-5 p-5">
        <div class="alert alert-danger border border-danger d-flex flex-column justify-content-center align-items-center rounded-4 mt-3 p-5" role="alert">
            <h4><i class="bi bi-exclamation-circle fs-4"></i> Your Cart is Empty!</h4>
            <a href="home.php" class="btn btn-success rounded-pill mt-3">Start Shopping by clicking here...</a>
        </div>
    </div>
    <!-- Empty Cart View Message -->

<?php
}
?>