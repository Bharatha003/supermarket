<?php
include "connection.php";
session_start();
$user = $_SESSION["u"];

if (isset($_SESSION["u"])) {
    $rs = Database::search("SELECT * FROM `user` WHERE `id` = '" . $user["id"] . "'");
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
        <title>Supermarket | Profile Page</title>
        <link rel="icon" href="Resources/Img/Supermarket Icon.ico" />
    </head>

    <body class="body">

        <!-- Header -->
        <?php include "header.php"; ?>
        <!-- Header  -->

        <div class="container mt-3 mb-3">
            <div class="row">

                <!-- Profile Picture  -->
                <div class="col-md-4 text-center">
                    <img src="<?php

                                if (!empty($d["img_path"])) {

                                    echo $d["img_path"];
                                } else {
                                    echo ("Resources\ProfileImg\default_profile_image.jpg");
                                }

                                ?>" class="img-fluid rounded-circle" height="150px" id="pimg" alt="Profile Image">
                    <div class="mt-4">
                        <input type="file" max="1" class="form-control" id="imgUploader" />
                        <button class="btn btn-dark rounded-pill mt-4 mb-4 col-10 mx-auto" onclick="uploadProfileImg();">Upload</button>
                    </div>
                </div>
                <!-- Profile Picture  -->

                <!-- Profile Details  -->
                <div class="col-8">
                    <h2 class="text-center">Profile Details</h2>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" placeholder="First Name" value="<?php echo isset($d["fname"]) ? $d["fname"] : ''; ?>" id="fname" />
                        </div>
                        <div class="col-6">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name" value="<?php echo isset($d["lname"]) ? $d["lname"] : ''; ?>" id="lname" />
                        </div>
                        <div class="col-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Email" value="<?php echo isset($d["email"]) ? $d["email"] : ''; ?>" id="email" />
                        </div>
                        <div class="col-6">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control" placeholder="Mobile" value="<?php echo isset($d["mobile"]) ? $d["mobile"] : ''; ?>" id="mobile" />
                        </div>
                        <div class="col-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" placeholder="Username" value="<?php echo isset($d["username"]) ? $d["username"] : ''; ?>" id="username" disabled />
                        </div>

                        <div class="col-5">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Password" value="<?php echo isset($d["password"]) ? $d["password"] : ''; ?>" id="password" />
                        </div>

                        <div class="col-1 mt-2">
                            <button class="bg-success text-white border border-secondary mt-4 rounded-3 px-2 py-1" id="spbp" onclick="showPasswordProfile();">
                                <i class="bi bi-eye-fill"></i>
                            </button>
                        </div>


                        <h4 class="mt-4 fw-bold">Shipping Address</h4>

                        <div class="row mt-3">
                            <div class="col-12">
                                <label for="line1" class="form-label">Line 1</label>
                                <input type="text" class="form-control" placeholder="Line 1" value="<?php echo isset($d["line1"]) ? $d["line1"] : ''; ?>" id="line1" />
                            </div>
                            <div class="col-12 mt-3">
                                <label for="line2" class="form-label">Line 2</label>
                                <input type="text" class="form-control" placeholder="Line 2" value="<?php echo isset($d["line2"]) ? $d["line2"] : ''; ?>" id="line2" />
                            </div>
                        </div>

                        <div class="mt-3 d-flex justify-content-center">
                            <button class="btn btn-success rounded-pill mt-2 col-8 mx-auto" onclick="updateProfileData();">Update</button>
                        </div>

                    </div>
                </div>
                <!-- Profile Details  -->

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
    header("location: signin.php");
}
?>