<?php
include "connection.php";
session_start();

$stockId = $_GET["s"];

if (isset($stockId)) {

    $q = "SELECT stock.*,
    stock.id AS stock_id, 
    product.id AS product_id,
    product.name AS product_name,
    product.description AS product_description,
    product.img_path AS product_img_path, 
    product.category_id AS category_id,
    category.name AS category_name,
    brand.name AS brand_name 
    FROM `stock` 
    INNER JOIN `product` ON `stock`.`product_id` = `product`.`id`
    INNER JOIN `category` ON `product`.`category_id` = `category`.`id`
    INNER JOIN `brand` ON `product`.`brand_id` = `brand`.`id`
    WHERE `stock`.id = '" . $stockId . "'";

    $rs = Database::search($q);
    $d = $rs->fetch_assoc();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <title><?php echo $d["product_name"]; ?> | Supermarket</title>
        <link rel="icon" href="Resources/Img/Supermarket Icon.ico" />
    </head>

    <body>

        <!-- Header -->
        <?php include "header.php"; ?>
        <!-- Header  -->

        <div class="body">

            <!-- Product View -->
            <div class="col-8 row shadow-lg p-4 bg-white rounded-4 mx-auto my-4">

                <!-- Product Image -->
                <div class="col-6">
                    <img src="<?php echo $d["product_img_path"]; ?>" class="rounded-3 shadow-lg" width="320px" alt="" srcset="">
                </div>
                <!-- Product Image -->

                <!-- Product Details -->
                <div class="col-6">
                    <h3 class="fw-bold"><?php echo $d["product_name"]; ?></h3>
                    <h6 class="col-4 bg-dark text-light text-center rounded-pill mt-2"><?php echo $d["category_name"]; ?></h6>
                    <p class="border border-2 p-3 rounded-4 mt-4"><?php echo $d["product_description"] ? $d["product_description"] : "No Description available for this Product"; ?></p>
                    <h4 class="mt-4">Rs.<?php echo $d["price"]; ?>.00</h4>
                    <div class="col-4">
                        <div class="input-group rounded-4 mt-4">
                            <button class="btn btn-dark" type="button" onclick="decreaseQty();"><i class="bi bi-dash-circle fs-5"></i></button>
                            <input type="text" class="form-control border border-dark text-center" value="1" id="qty" onkeyup='checkQtyInput(<?php echo $d["qty"]; ?>)' aria-label="Example text with two button addons">
                            <button class="btn btn-dark" type="button" onclick='increaseQty(<?php echo $d["qty"]; ?>);'><i class="bi bi-plus-circle fs-5"></i></button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <button class="btn btn-dark rounded-pill col-6" onclick="addtoCart('<?php echo $d['stock_id'] ?>');">Add To Cart</button>
                        <button class="btn btn-success rounded-pill col-6 ms-2" onclick="buyNow('<?php echo $d['stock_id'] ?>');">Buy Now</button>
                    </div>
                </div>

                <hr class="mt-4" />

                <div class="col-12">
                    <h5 class="fw-bold">About this Product</h5>
                    <h6 class="mt-3">Brand: <?php echo $d["brand_name"]; ?></h6>
                    <h6>Availability: <?php echo $d["qty"] > 0 ? $d["qty"] . " Items Available" : "Out of Stock"; ?></h6>
                </div>
                <!-- Product Details -->

            </div>
            <!-- Product View -->

            <!-- Related Products -->
            <div class="col-8 row shadow-lg p-4 bg-white rounded-4 mx-auto my-4">
                <h5 class="fw-bold">Related Products</h5>
                <hr />

                <?php
                $q2 = "SELECT stock.*, 
                    product.id AS product_id,
                    product.name AS product_name,
                    product.img_path AS product_img_path, 
                    category.name AS category_name
                    FROM `stock` 
                    INNER JOIN `product` ON `stock`.`product_id` = `product`.`id`
                    INNER JOIN `category` ON `product`.`category_id` = `category`.`id`
                    WHERE `product`.category_id = '" . $d["category_id"] . "' LIMIT 4 OFFSET 0";

                $rs2 = Database::search($q2);
                $num2 = $rs2->num_rows;

                if ($num2 == 0) {
                ?>

                    <!--Empty Related Products Message-->
                    <div class="alert alert-danger border border-danger d-flex flex-column justify-content-center align-items-center rounded-4 mt-3" role="alert">
                        <h5><i class="bi bi-exclamation-circle fs-5"></i> No Related Products Found.</h5>
                        <p>We're Sorry, We cannot find any related matches for this Product...</p>
                    </div>
                    <!--Empty Related Products Message-->

                    <?php
                } else {

                    for ($i = 0; $i < $num2; $i++) {
                        $d2 = $rs2->fetch_assoc();
                    ?>

                        <!-- Card  -->
                        <div class="d-flex justify-content-center col-3 mt-3">
                            <div class="card border border-2 border-success rounded-4" style="width: 300px">
                                <a href="singleProductView.php?s=<?php echo $d2["product_id"] ?>"><img src="<?php echo $d2["product_img_path"]; ?>" class="card-img-top mt-2" alt="<?php echo $d2["product_name"]; ?>"></a>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold fs-4"><?php echo $d2["product_name"]; ?></h5>
                                    <p class="badge rounded-pill border border-dark text-dark fs-6"><?php echo $d2["category_name"]; ?></p>
                                    <p class="card-text fs-5">Rs.<?php echo $d2["price"]; ?>.00</p>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-dark col-6">Add to Cart</button>
                                        <button class="btn btn-success col-6 ms-2">Buy Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card  -->

                <?php
                    }
                }
                ?>

            </div>
            <!-- Related Products -->

        </div>

        <!-- Footer -->
        <?php include "footer.php"; ?>
        <!-- Footer -->

        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    </body>

    </html>

<?php

} else {
    header("location:home.php");
}

?>