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

    <!-- header -->
    <?php include "header.php"; ?>
    <!-- header  -->

    <!-- basic search  -->
    <div class="container d-flex justify-content-center mt-3">
        <div class="col-8 mt-3">
            <input type="text" class="form-control border-2 border-success rounded-pill shadow-lg" placeholder="Search..." onkeyup="searchProduct(0);" id="product">
        </div>
        <button class="btn btn-danger border rounded-pill col-1 mt-3 ms-2 shadow-lg" onclick="viewFilter();">Filter</button>
    </div>
    <!-- basic search  -->

    <!-- Advance Search  -->
    <div class="d-none" id="filterId">
        <div class="border border-2 border-success rounded-4 mt-4 p-5 col-10 offset-1">
            <div class="row col-12">

                <!-- Category  -->
                <div class="col-6 ms-auto">
                    <label for="color-select" class="form-label fw-bold">Category</label>
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
                    <label for="color-select" class="form-label fw-bold">Brand</label>
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

                <!-- Dietary Preference  -->
                <div class="col-6 ms-auto">
                    <label for="color-select" class="form-label fw-bold">Dietary Preference</label>
                    <select name="color" class="form-select" id="dietarypref">
                        <option value="0">Select Dietary Preference</option>


                        <?php
                        $rs3 = Database::search("SELECT * FROM `dietary_pref`");
                        $num3 = $rs3->num_rows;
                        for ($i = 0; $i < $num3; $i++) {
                            $d3 = $rs3->fetch_assoc();
                        ?>

                            <option value="<?php echo $d3['id']; ?>"><?php echo $d3['name']; ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
                <!-- Dietary Preference  -->

                <!-- Packaging Type  -->
                <div class="col-6 ms-auto">
                    <label for="color-select" class="form-label fw-bold">Packaging Type</label>
                    <select name="color" class="form-select" id="packagingtype">
                        <option value="0">Select Packaging Type</option>


                        <?php
                        $rs4 = Database::search("SELECT * FROM `packaging_type`");
                        $num4 = $rs4->num_rows;
                        for ($i = 0; $i < $num4; $i++) {
                            $d4 = $rs4->fetch_assoc();
                        ?>

                            <option value="<?php echo $d4['id']; ?>"><?php echo $d4['name']; ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
                <!-- Packaging Type  -->

            </div>

            <div class="mt-4 row col-12">

                <!-- Min Price  -->
                <div class="col-5">
                    <input type="text" class="form-control" placeholder="Min Price" id="min" />
                </div>
                <!-- Min Price  -->

                <!-- Max Price  -->
                <div class="col-5">
                    <input type="text" class="form-control" placeholder="Max Price" id="max" />
                </div>
                <!-- Max Price  -->

                <button class="btn btn-success border rounded-pill col-2" onclick="advSearchProduct(0);">Search</button>


            </div>

        </div>

    </div>
    <!-- Advance Search -->

    <!--carousel-->
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
    <!--carousel-->

    <!-- load product  -->
    <div class="row col-10 offset-1" id="pid">

    </div>
    <!-- load product  -->

    <div class="col-11 mx-auto sticky-bottom mb-3">
        <button class="offset-11 col-1 bg-dark rounded-2 py-3 rounded-pill text-white" style="font-family: latoBold;">CHAT</button>
    </div>

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer  -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>

</body>

</html>