<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Supermarket | Sign In</title>
    <link rel="icon" href="Resources/Img/Supermarket Icon.ico" />
</head>

<body class="body">

    <div class="col-12 mt-5 mb-5">
        <div class="row">

            <!-- Image -->
            <div class="col-lg-6 signInImg">
                <img src="Resources/Img/SigninPageSideImage.svg" alt="Sign In Image" />
            </div>
            <!-- Image -->

            <!-- Login Box -->
            <div class="col-lg-5 col-md-9 mx-auto my-auto signIn_Box">

                <!-- Sign In Box -->
                <div class="col-12 mt-3 mb-3" id="signInBox">

                    <h2 class="text-center">Sign In</h2>

                    <?php

                    $username = "";
                    $password = "";

                    if (isset($_COOKIE["username"])) {
                        $username = $_COOKIE["username"];
                    }

                    if (isset($_COOKIE["password"])) {
                        $password = $_COOKIE["password"];
                    }

                    ?>

                    <div class="d-none mt-3" id="msgDiv2">
                        <div class="alert alert-danger" id="msg2"></div>
                    </div>

                    <div class="col-10 mx-auto mt-3">
                        <label for="form-label">Username :</label>
                        <input type="text" class="form-control" id="un" value="<?php echo $username ?>" />
                    </div>

                    <div class="col-10 mx-auto mt-3">
                        <div class="row">
                            <div class="col-11">
                                <label for="form-label">Password :</label>
                                <input type="password" class="form-control" id="pw" value="<?php echo $password ?>" />
                            </div>

                            <button class="col-1 bg-success text-white border border-secondary mt-4 rounded-3" id="spbsi" onclick="showPasswordSignIn();">
                                <i class="bi bi-eye-fill"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-10 mx-auto mt-3 form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked rm" checked />
                        <label class="form-check-label" for="flexSwitchCheckChecked rm">Remember me</label>
                        <h6 class="text-end"><a href="forgetPassword.php" class="link">Forget Password?</a></h6>
                    </div>

                    <div class="col-10 mx-auto mt-5">
                        <button class="col-12 btn btn-success" onclick="signIn();">Sign In</button>
                    </div>

                    <div class="col-10 mx-auto mt-3">
                        <h6 class="link" onclick="changeView();">Don't you have an Account? Sign Up here...</h6>
                    </div>

                </div>
                <!-- Sign In Box -->

                <!-- Sign Up Box -->
                <div class="col-12 mt-3 mb-3 d-none" id="signUpBox">

                    <h2 class="text-center">Sign Up</h2>

                    <div class="d-none mt-3" id="msgDiv1">
                        <div class="alert alert-danger" id="msg1"></div>
                    </div>

                    <div class="col-10 mx-auto mt-3">
                        <div class="row">
                            <div class="col-6">
                                <label for="form-label">First Name :</label>
                                <input type="text" class="form-control" id="fname" />
                            </div>

                            <div class="col-6">
                                <label for="form-label">Last Name :</label>
                                <input type="text" class="form-control" id="lname" />
                            </div>
                        </div>
                    </div>

                    <div class="col-10 mx-auto mt-3">
                        <label for="form-label">Email :</label>
                        <input type="email" class="form-control" id="email" />
                    </div>

                    <div class="col-10 mx-auto mt-3">
                        <label for="form-label">Mobile :</label>
                        <input type="text" class="form-control" id="mobile" />
                    </div>

                    <div class="col-10 mx-auto mt-3">
                        <label for="form-label">Username :</label>
                        <input type="text" class="form-control" id="username" />
                    </div>

                    <div class="col-10 mx-auto mt-3">
                        <div class="row">
                            <div class="col-11">
                                <label for="form-label">Password :</label>
                                <input type="password" class="form-control" id="password" />
                            </div>

                            <button class="col-1 bg-success text-white border border-secondary mt-4 rounded-3" id="spbsu" onclick="showPasswordSignUp();">
                                <i class="bi bi-eye-fill"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-10 mx-auto mt-5">
                        <button class="col-12 btn btn-success" onclick="signUp();">Sign Up</button>
                    </div>

                    <div class="col-10 mx-auto mt-3">
                        <h6 class="link" onclick="changeView();">Do you already have an Account? Sign In here...</h6>
                    </div>

                </div>
                <!-- Sign Up Box -->

            </div>
            <!-- Login Box -->

            <div class="col-lg-1"></div>

        </div>
    </div>

    <script src="script.js"></script>

</body>

</html>