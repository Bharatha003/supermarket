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
        <title>Supermarket | Stock Management</title>
        <link rel="icon" href="Resources/Img/Supermarket Icon.ico" />
    </head>

    <body class="body">

        <!-- Admin Header -->
        <?php include "adminHeader.php"; ?>
        <!-- Admin Header -->

        <div class="col-lg-4 col-md-8 mx-auto mt-3 mb-3">

            <h3 class="text-center fw-bold">Stock Management</h3>

            <!-- Product Name -->
            <div class="mt-3">
                <label class="form-label fw-bold" for="selectProduct">Product Name</label>
                <select class="form-select" id="selectProduct" onchange="loadCurrentStock();">
                    <option value="0">Select Product</option>

                    <?php
                    $rs = Database::search("SELECT * FROM `product`");
                    $num = $rs->num_rows;

                    for ($i = 0; $i < $num; $i++) {
                        $d = $rs->fetch_assoc();
                    ?>
                        <option value="<?php echo $d['id']; ?>"><?php echo $d['name']; ?></option>
                    <?php
                    }
                    ?>

                </select>
            </div>
            <!-- Product Name -->

            <hr />

            <!-- Current Stock Qty -->
            <div class="alert alert-success border border-success d-flex flex-column justify-content-center align-items-center text-center rounded-4 mt-3" role="alert">
                <h6>Current Qty: <span class="fs-6" id="csq">0</span></h6>
            </div>
            <!-- Current Stock Qty -->

            <!-- Qty -->
            <div class="mt-3">
                <label class="form-label fw-bold" for="qty">Qty</label>
                <input type="text" class="form-control" id="qty" required />
            </div>
            <!-- Qty -->

            <!-- Price -->
            <div class="mt-3">
                <label class="form-label fw-bold" for="unitPrice">Unit Price(Rs)</label>
                <input type="text" class="form-control" id="unitPrice" required />
            </div>
            <!-- Price -->

            <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-success border rounded-pill col-6" onclick="updateStock();">Update Stock</button>
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
    echo ("You are not a Valid Admin!");
    header("location:home.php");
}
