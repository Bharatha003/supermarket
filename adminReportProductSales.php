<?php
session_start();
include "connection.php";

if (isset($_SESSION["a"])) {
    $rs =  Database::search("SELECT
    product.id AS product_id,
    product.name AS product_name, 
    category.name AS category_name,
    stock.price AS stock_price,
    SUM(order_item.qty) AS total_sold 
    FROM `order_item`  
    INNER JOIN `stock` ON `order_item`.`stock_id` =  `stock`.`id` 
    INNER JOIN `product` ON `stock`.`product_id` = `product`.`id` 
    INNER JOIN `category` ON `product`.`category_id` = `category`.`id` 
    GROUP BY `product`.`id`, `product`.`name`, `category`.`name`, `stock`.`price` 
    ORDER BY `total_sold` DESC");
    $num = $rs->num_rows;
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <title>Supermarket | Product Sales Report</title>
        <link rel="icon" href="Resources/Img/Supermarket Icon.ico" />
    </head>

    <body class="bg-white">

        <div class="col-11 btn-toolbar justify-content-end mt-5">
            <a href="adminReport.php"><button class="btn btn-dark me-2"><i class="bi bi-arrow-left-circle-fill"></i> Back</button></a>
            <button class="btn btn-danger me-2" onclick="printDiv();"><i class="bi bi-printer-fill"></i> Print</button>
        </div>

        <!-- Print Area -->
        <div class="container bg-white shadow rounded-4 p-3 mt-3 mb-5" id="printArea">
            <div class="border border-3 border-success bg-white p-5 rounded-4">

                <div class="col-12 bg-success rounded-4 p-3 mb-2">
                    <div class="row">
                        <img src="Resources\img\Supermarket Logo.jpg" class="col-3 my-auto rounded-4" height="80px" alt="Supermarket Logo" />
                        <div class="col-9 text-end my-auto">
                            <h1 class="text-light">Product Sales Report</h1>
                        </div>
                    </div>
                </div>

                <!-- Sales Details -->
                <div class="mt-5">
                    <table class="table table-hover">
                        <thead class="table-success">
                            <tr>
                                <th>Product Id</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Unit Price</th>
                                <th>Quantity Sold</th>
                                <th>Total Revenue</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            for ($i = 0; $i < $num; $i++) {
                                $d = $rs->fetch_assoc();
                            ?>
                                <tr>
                                    <td><?php echo $d["product_id"] ?></td>
                                    <td><?php echo $d["product_name"] ?></td>
                                    <td><?php echo $d["category_name"] ?></td>
                                    <td>Rs.<?php echo $d["stock_price"] ?>.00</td>
                                    <td><?php echo $d["total_sold"] ?></td>
                                    <td>Rs.<?php echo $d["stock_price"] * $d["total_sold"] ?>.00</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Sales Details -->

            </div>
        </div>
        <!-- Print Area -->

        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php
} else {
    echo ("You are not a Valid Admin");
    header("location:home.php");
}
?>