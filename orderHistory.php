<?php
session_start();
include "connection.php";

$user = $_SESSION["u"];

if (isset($user)) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <title>Supermarket | Order History</title>
        <link rel="icon" href="Resources/Img/Supermarket Icon.ico" />
    </head>

    <body class="body">

        <!-- Header -->
        <?php include "header.php"; ?>
        <!-- Header  -->

        <div class="container ">
            <div class="row">

                <?php
                $rs =  Database::search("SELECT * FROM `order_history` 
                WHERE `user_id` = '" . $user["id"] . "' 
                ORDER BY `order_history`.`date` DESC");
                $num = $rs->num_rows;

                if ($num > 0) {
                ?>
                    <div class="fw-bold mb-3 mt-5">
                        <h3>Order History</h3>
                    </div>

                    <?php
                    while ($d = $rs->fetch_assoc()) {
                    ?>

                        <div class="p-3 border border-2 border-success rounded-4 bg-white mb-4">
                            <div>

                                <!-- Order Details -->
                                <div class="ps-5 mt-2 mb-3">
                                    <h4 class="fw-bold text-success">#<?php echo $d["order_id"] ?></h4>
                                    <h5>Order Date: <?php echo $d["date"] ?></h5>
                                </div>
                                <!-- Order Details -->

                                <!-- Order Items -->
                                <div class="ps-5 pe-5">
                                    <table class="table table-hover">
                                        <thead class="table-success">
                                            <tr>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">

                                            <?php
                                            $rs2 = Database::search("SELECT order_item.*,
                                            product.id AS product_id,
                                            product.name AS product_name,
                                            order_item.qty AS order_item_qty,
                                            stock.price AS product_price
                                            FROM `order_item` 
                                            INNER JOIN `stock` ON `order_item`.`stock_id` = `stock`.`id` 
                                            INNER JOIN `product` ON `stock`.`product_id` = `product`.`id` 
                                            WHERE `order_item`.`order_history_id` = '" . $d["id"] . "'");

                                            while ($d2 = $rs2->fetch_assoc()) {
                                            ?>
                                                <tr class="my-auto">

                                                    <td><?php echo $d2["product_name"] ?></td>
                                                    <td><?php echo $d2["order_item_qty"] ?></td>
                                                    <td><?php echo $d2["product_price"] * $d2["order_item_qty"] ?></td>
                                                    <td><a class="btn btn-success btn-sm" href="singleProductView.php?s=<?php echo $d2["product_id"] ?>" title="View Product"><i class="bi bi-search text-white"></i></a></td>

                                                </tr>

                                            <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- Order Items -->

                                <!-- Final Amount -->
                                <div class="text-end pe-5">
                                    <h6>Delevery free: Rs.500.00</h6>
                                    <h4>Net Total: Rs.<?php echo $d["amount"] ?>.00 </h4>
                                </div>
                                <!-- Final Amount -->

                            </div>
                        </div>

                    <?php
                    }
                    ?>

                <?php
                } else {
                ?>

                    <!-- Empty Order History View Message -->
                    <div class="col-10 bg-white shadow rounded-4 mx-auto mt-5 mb-5 p-5">
                        <div class="alert alert-danger border border-danger d-flex flex-column justify-content-center align-items-center rounded-4 mt-3 p-5" role="alert">
                            <h4><i class="bi bi-exclamation-circle fs-4"></i> You Haven't any Orders placed yet!</h4>
                            <a href="home.php" class="btn btn-success rounded-pill mt-3">Start Shopping by clicking here...</a>
                        </div>
                    </div>
                    <!-- Empty Order History View Message -->

                <?php
                }
                ?>

            </div>
        </div>

        <!-- Footer -->
        <?php include "footer.php"; ?>
        <!-- Footer  -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>

    </body>

    </html>

<?php
} else {
    header("location:signIn.php");
}
?>