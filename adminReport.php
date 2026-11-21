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
        <title>Supermarket | Reports</title>
        <link rel="icon" href="Resources/Img/Supermarket Icon.ico" />
    </head>

    <body class="body">

        <!-- Admin Header -->
        <?php include "adminHeader.php"; ?>
        <!-- Admin Header -->

        <div class="col-lg-4 col-md-8 mx-auto mt-3 mb-3">

            <h3 class="text-center fw-bold">Reports</h3>

            <div class="mt-3">
                <a href="adminReportStock.php"><button class="btn btn-dark col-12 rounded-pill">Stock Report</button></a>
            </div>

            <div class="mt-3">
                <a href="adminReportProduct.php"> <button class="btn btn-dark col-12 rounded-pill">Product Report</button></a>
            </div>

            <div class="mt-3">
                <a href="adminReportUser.php"> <button class="btn btn-dark col-12 rounded-pill"> User Report</button></a>
            </div>

            <div class="mt-3">
                <a href="adminReportProductSales.php"> <button class="btn btn-dark col-12 rounded-pill"> Product Sales Report</button></a>
            </div>

            <div class="mt-3">
                <a href="adminReportOrderPayment.php"> <button class="btn btn-dark col-12 rounded-pill"> Order Payment Report</button></a>
            </div>

        </div>

        <!-- Footer -->
        <?php include "footer.php"; ?>
        <!-- Footer  -->

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