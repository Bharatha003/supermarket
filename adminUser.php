<?php
session_start();

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
        <title>Supermarket | User Management</title>
        <link rel="icon" href="Resources/Img/Supermarket Icon.ico" />
    </head>

    <body class="body" onload="loadUser(0);">

        <!-- Admin Header -->
        <?php include "adminHeader.php"; ?>
        <!-- Admin Header -->

        <div class="col-10 mx-auto mt-3">

            <h3 class="text-center fw-bold">User Management</h3>

            <!-- User Search -->
            <div class="col-8 mt-3 mx-auto">
                <input type="text" class="form-control border-2 border-success rounded-pill shadow-lg" placeholder="Search..." onkeyup="searchUser(0);" id="uid" />
            </div>
            <!-- User Search -->

            <!-- User Details -->
            <div class="mt-3" id="tb">

            </div>
            <!-- User Details -->

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
