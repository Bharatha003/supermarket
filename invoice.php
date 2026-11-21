<?php

session_start();
include "connection.php";

$user = $_SESSION["u"];
$orderHistoryId = $_GET["orderId"];

error_log("Order History ID (invoice): " . $orderHistoryId);

$rs = Database::search("SELECT * FROM `order_history` WHERE `id` = '" . $orderHistoryId . "'");
$num = $rs->num_rows;

if ($num > 0) {
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
        <title>Supermarket | Invoice</title>
        <link rel="icon" href="Resources/Img/Supermarket Icon.ico" />
    </head>

    <body class="body">

        <div class="col-11 btn-toolbar justify-content-end mt-5">
            <a href="orderHistory.php"><button class="btn btn-dark me-2"><i class="bi bi-arrow-left-circle-fill"></i> Back</button></a>
            <button class="btn btn-danger me-2"><i class="bi bi-printer-fill" onclick="printDiv();"></i> Print</button>
        </div>

        <!-- Print Area -->
        <div class="container bg-white shadow rounded-4 p-3 mt-3 mb-5" id="printArea">
            <div class="border border-3 border-success bg-white p-5 rounded-4">

                <div class="col-12 bg-success rounded-4 px-3 mb-2">
                    <div class="row">
                        <img src="Resources\img\Supermarket Logo.jpg" class="col-3 my-auto rounded-4" height="80px" alt="Supermarket Logo" />
                        <div class="col-9 text-end my-auto">
                            <h1 class="text-light">Invoice</h1>
                            <h4 class="text-light">#<?php echo $d["order_id"] ?></h4>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- Date -->
                    <div class="col-md-6">
                        <h5><span class="fs-5 fw-bold">Date: </span><?php echo $d["date"] ?></h5>
                    </div>
                    <!-- Date -->

                    <!-- Shop Details -->
                    <div class="col-md-6 text-end">
                        <h3 class="fw-bold">Supermarket</h3>
                        <h5>Pilimathalawa,</h5>
                        <h5>Kandy,</h5>
                        <h5>Sri Lanka</h5>
                    </div>
                    <!-- Shop Details -->

                </div>

                <!-- User Details -->
                <div class="mt-5">
                    <h4 class="fw-bold">Bill To :</h4>
                    <h5><?php echo $user["fname"] ?> <?php echo $user["lname"] ?></h5>
                    <h5><?php echo $user["mobile"] ?></h5>
                    <h5><?php echo $user["line1"] ?></h5>
                    <h5><?php echo $user["line2"] ?></h5>
                </div>
                <!-- User Details -->

                <!-- Order Items Details -->
                <div class="mt-5">
                    <table class="table table-hover">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            $rs2 =  Database::search("SELECT order_item.*,
                            product.name AS product_name,
                            stock.price AS product_price,
                            category.name AS category_name,
                            brand.name AS brand_name,
                            order_item.qty AS order_item_qty
                            FROM `order_item` 
                            INNER JOIN `stock` ON `order_item`.`stock_id` = `stock`.`id` 
                            INNER JOIN `product` ON `stock`.`product_id` = `product`.`id` 
                            INNER JOIN `category` ON `product`.`category_id` = `category`.`id` 
                            INNER JOIN `brand` ON `product`.`brand_id` = `brand`.`id`   
                            WHERE `order_item`.`order_history_id` = '" . $orderHistoryId . "'");

                            if ($rs2 === false) {
                                die("Order items query failed: " . Database::$connection->error);
                            }

                            $num2 = $rs2->num_rows;
                            for ($i = 0; $i < $num2; $i++) {
                                $d2 = $rs2->fetch_assoc();
                            ?>
                                <tr>
                                    <td><?php echo $d2["product_name"] ?></td>
                                    <td><?php echo $d2["category_name"] ?></td>
                                    <td><?php echo $d2["brand_name"] ?></td>
                                    <td><?php echo $d2["order_item_qty"] ?></td>
                                    <td>Rs.<?php echo ($d2["product_price"] * $d2["order_item_qty"]) ?>.00</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Order Items Details -->

                <!-- Final Amount -->
                <div class="text-end mt-5">
                    <h4>Number of Items: <?php echo $num2 ?></h4>
                    <h4>Delivery Fee: Rs.500.00</h4>
                    <hr />
                    <h3 class="fw-bold">Net Total: Rs.<?php echo ($d["amount"]) ?>.00</h3>
                </div>
                <!-- Final Amount -->

                <div class="col-12 text-center mt-5">
                    <i class="fs-4">Thank you for your purchase!</i>
                </div>

            </div>
        </div>
        <!-- Print Area -->

        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php
} else {
    echo "No Order found for this Purchase!";
}
?>