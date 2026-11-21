<?php
include "connection.php";
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
        <title>Supermarket | Product Registration</title>
        <link rel="icon" href="Resources/Img/Supermarket Icon.ico" />
    </head>

    <body class="body" onload="loadCategory();">

        <!-- Admin Header -->
        <?php include "adminHeader.php"; ?>
        <!-- Admin Header -->

        <div class="col-10 mx-auto mt-3 mb-3">

            <h3 class="text-center fw-bold">Product Registration</h3>

            <div class="row mt-3">

                <!-- Product Name -->
                <div class="col-6">
                    <label class="form-label fw-bold" for="pname">Product Name</label>
                    <input id="pname" type="text" class="form-control" required>
                </div>
                <!-- Product Name -->

                <!-- Product Image -->
                <div class="col-6">
                    <label class="form-label fw-bold" for="file">Upload Image</label>
                    <input type="file" max="1" class="form-control" id="file" required>
                </div>
                <!-- Product Image -->

            </div>

            <div class="row mt-3">

                <!-- Category -->
                <div class="col-6 ms-auto">

                    <label for="category" class="form-label fw-bold">Category</label>
                    <select name="category" class="form-select" id="category" onchange="loadBrand();" required>

                    </select>

                    <!-- Category Register -->
                    <div class="input-group mt-2">
                        <input type="text" class="form-control col-8" placeholder="Add new Category" id="newcategory" />
                        <button class="btn btn-dark" type="button" onclick="addNewCategory();"><i class="bi bi-plus-circle fs-6"></i></button>
                    </div>
                    <!-- Category Register -->

                </div>
                <!-- Category -->

                <!-- Brand -->
                <div class="col-6 ms-auto">
                    <label for="brand" class="form-label fw-bold">Brand</label>
                    <select name="brand" class="form-select" id="brand" required>
                        <option value="0">Select Category First...</option>

                    </select>

                    <!-- Brand Register -->
                    <div class="input-group mt-2">
                        <input type="text" class="form-control col-8" placeholder="Add new Brand" id="newbrand" />
                        <button class="btn btn-dark" type="button" onclick="showCHBModal();"><i class="bi bi-plus-circle fs-6"></i></button>
                    </div>
                    <!-- Brand Register -->

                    <!-- Category has Brand Modal -->
                    <div class="modal fade" id="chbModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border border-3 border-success">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Select Category for this Brand</h1>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <select name="modalCategory" class="form-select" id="modalCategory" onchange="loadCategory();">

                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success rounded-pill" onclick="addNewBrand();">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Category has Brand Modal -->

                </div>
                <!-- Brand -->

            </div>

            <!-- Product Description -->
            <div class="mt-3">
                <label class="form-label fw-bold" for="desc">Description</label>
                <textarea class="form-control" rows="5" id="desc"></textarea>
            </div>
            <!-- Product Description -->

            <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-success border rounded-pill col-6" onclick="regProduct();">Register Product</button>
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