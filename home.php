<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Supermarket | Home</title>
    <link rel="icon" href="Resources/Img/Supermarket Icon.ico" />
</head>

<body class="body" onload="loadProduct(0);">

    <!-- Header -->
    <?php include "header.php"; ?>
    <!-- Header  -->

    <!-- Basic Search  -->
    <div class="container d-flex justify-content-center mt-3" id="bsb">
        <div class="col-8 mt-3">
            <input type="text" class="form-control border-2 border-success rounded-pill shadow-lg" placeholder="Search..." onkeyup="clearFilter(); searchProduct(0);" id="product">
        </div>
        <button class="btn btn-danger border rounded-pill col-1 mt-3 ms-2 shadow-lg" onclick="viewFilter(); clearFilter();">Filter</button>
    </div>
    <!-- Basic Search  -->

    <!-- Advance Search  -->
    <div class="d-none" id="filterId">
        <div class="border border-2 border-success rounded-4 mt-4 p-5 col-10 offset-1">
            <div class="row col-12">

                <!-- Advanced Search Box  -->
                <div class="container d-flex justify-content-center mt-3">
                    <div class="col-8 mt-3">
                        <input type="text" class="form-control border-2 border-success rounded-pill shadow-lg" placeholder="Search..." id="text">
                    </div>
                    <button class="btn btn-success border rounded-pill col-1 mt-3 ms-2 shadow-lg" onclick="advSearchProduct(0);">Search</button>
                </div>
                <!-- Advanced Search Box  -->

                <!-- Category  -->
                <div class="col-6 ms-auto">
                    <label for="category" class="form-label fw-bold">Category</label>
                    <select name="color" class="form-select" id="category">
                        <option value="0">Select Category</option>

                        <?php
                        $rs = Database::search("SELECT * FROM `category`");
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
                <!-- Category  -->

                <!-- Brand  -->
                <div class="col-6 ms-auto">
                    <label for="brand" class="form-label fw-bold">Brand</label>
                    <select name="color" class="form-select" id="brand">
                        <option value="0">Select Brand</option>

                        <?php
                        $rs2 = Database::search("SELECT * FROM `brand`");
                        $num2 = $rs2->num_rows;
                        for ($i = 0; $i < $num2; $i++) {
                            $d2 = $rs2->fetch_assoc();
                        ?>

                            <option value="<?php echo $d2['id']; ?>"><?php echo $d2['name']; ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
                <!-- Brand  -->

            </div>

            <div class="row col-12 mt-3">

                <!-- Availability  -->
                <div class="col-6 ms-auto">
                    <label for="availability" class="form-label fw-bold">Availability</label>
                    <select name="color" class="form-select" id="availability">
                        <option value="0">All</option>
                        <option value="1">In Stock only</option>

                    </select>
                </div>
                <!-- Availability  -->

                <!-- Sort  -->
                <div class="col-6 ms-auto">
                    <label for="sort" class="form-label fw-bold">Sort By</label>
                    <select name="color" class="form-select" id="sort">
                        <option value="0">None</option>
                        <option value="1">Price: Low to High</option>
                        <option value="2">Price: High to Low</option>
                        <option value="3">Quantity: Low to High</option>
                        <option value="4">Quantity: High to Low</option>
                    </select>
                </div>
                <!-- Sort  -->

            </div>

            <div class="mt-4 row col-12">

                <!-- Min Price  -->
                <div class="col-6">
                    <input type="number" class="form-control" placeholder="Min Price" id="min" />
                </div>
                <!-- Min Price  -->

                <!-- Max Price  -->
                <div class="col-6">
                    <input type="number" class="form-control" placeholder="Max Price" id="max" />
                </div>
                <!-- Max Price  -->

            </div>

            <div class="row col-12 mt-3 justify-content-center">
                <button class="btn btn-dark border rounded-pill col-5" onclick="viewFilter(); clearFilter(); loadProduct(0);">Go Back</button>
                <button class="btn btn-danger border rounded-pill col-5 ms-4" onclick="clearFilter();">Clear</button>
            </div>

        </div>

    </div>
    <!-- Advance Search -->

    <!--Carousel-->
    <div id="carouselExampleIndicators" class="col-9 mx-auto shadow-sm carousel carousel-dark slide mt-3 mb-3" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner rounded-2">
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="Resources/Carousal/Corousal 1.png" class="d-block w-100 h-25">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="Resources/Carousal/Corousal 2.png" class="d-block w-100 h-25">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="Resources/Carousal/Corousal 3.png" class="d-block w-100 h-25">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="Resources/Carousal/Corousal 4.png" class="d-block w-100 h-25">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!--Carousel-->

    <!-- Load Product  -->
    <div class="row col-11 mx-auto" id="pid">

    </div>
    <!-- Load Product  -->

    <!-- Chat  -->
    <div class="col-11 mx-auto sticky-bottom mb-3">
        <button class="offset-11 col-1 bg-dark rounded-2 py-3 rounded-pill text-white"><i class="bi bi-chat-right-text fs-3 fw-bold"></i></button>
    </div>
    <!-- Chat  -->

    <!-- Footer -->
    <?php include "footer.php"; ?>
    <!-- Footer  -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

</body>

</html>