<?php

session_start();
include "connection.php";

if (isset($_SESSION["a"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <title>Supermarket | Admin Dashboard</title>
        <link rel="icon" href="Resources/Img/Supermarket Icon.ico" />
    </head>

    <body class="body" onload="loadMostSoldChart(); loadLowStockChart();">

        <!-- Admin Header -->
        <?php include "adminHeader.php"; ?>
        <!-- Admin Header -->

        <?php
        $Total_Users = 0;
        $Total_Sellings = 0;
        $Total_Earnings = 0;

        $rs = Database::search("SELECT 
            order_item.qty AS order_item_qty, 
            order_history.amount AS order_history_amount,
            user.id AS user_id
            FROM `order_item` 
            INNER JOIN `stock` ON `order_item`.`stock_id` =  `stock`.`id` 
            INNER JOIN `order_history` ON `order_item`.`order_history_id` = `order_history`.`id`
            INNER JOIN `user` ON `order_history`.`user_id` = `user`.`id`");

        $num = $rs->num_rows;

        for ($i = 0; $i < $num; $i++) {
            $d = $rs->fetch_assoc();

            $Total_Users = $Total_Users + $d["user_id"];

            $Total_Sellings = $Total_Sellings + $d["order_item_qty"];

            $Total_Earnings = $Total_Earnings + $d["order_history_amount"];
        }
        ?>

        <!-- Status Cards -->
        <div class="row gap-3 justify-content-center my-3">
            <div class="col-3 alert alert-success border border-2 border-success rounded-4 text-center">
                <h4 class="fw-bold">Total Users</h4>
                <h5><?php echo $Total_Users ?></h5>
            </div>
            <div class="col-3 alert alert-dark border border-2 border-dark rounded-4 text-center">
                <h4 class="fw-bold">Total Sellings</h4>
                <h5><?php echo $Total_Sellings ?></h5>
            </div>
            <div class="col-3 alert alert-danger border border-2 border-danger rounded-4 text-center">
                <h4 class="fw-bold">Total Earnings</h4>
                <h5>Rs.<?php echo $Total_Earnings ?>.00</h5>
            </div>
        </div>
        <!-- Status Cards -->

        <!-- Charts  -->
        <div class="row justify-content-center gap-5 my-3">

            <!-- Most Sold Chart  -->
            <div class="col-lg-4 col-md-8 bg-white border border-2 border-success rounded-4">
                <div class="p-3">
                    <h3 class="text-center fw-bold">Most sold products</h3>
                    <hr class="col-11 mx-auto" />
                    <canvas id="msChart"></canvas>
                </div>
            </div>
            <!-- Most Sold Chart  -->

            <!-- Chart  -->
            <div class="col-lg-4 col-md-8 bg-white border border-2 border-success rounded-4">
                <div class="p-3">
                    <h3 class="text-center fw-bold">Low Stock products</h3>
                    <hr class="col-11 mx-auto" />
                    <canvas id="lsChart"></canvas>
                </div>
            </div>
            <!-- Chart  -->

        </div>
        <!-- Charts  -->

        <!-- Footer -->
        <?php include "footer.php"; ?>
        <!-- Footer  -->

        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </body>

    </html>

<?php
} else {
    echo ("You are not a Valid Admin!");
    header("location:signin.php");
}
