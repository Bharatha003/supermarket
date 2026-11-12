<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Supermarket | Admin Sign In</title>
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
            <div class="col-lg-5 col-md-9 mx-auto my-auto adminSignIn_Box">

                <!-- Sign In Box -->
                <div class="col-12 mt-3 mb-3" id="adminSignInBox">

                    <h2 class="text-center">Admin Sign In</h2>

                    <div class="d-none mt-3" id="msgDiv3">
                        <div class="alert alert-danger" id="msg3"></div>
                    </div>

                    <div class="col-10 mx-auto mt-3">
                        <label for="form-label">Username :</label>
                        <input type="text" class="form-control" id="adminUn" />
                    </div>

                    <div class="col-10 mx-auto mt-3">
                        <div class="row">
                            <div class="col-11">
                                <label for="form-label">Password :</label>
                                <input type="password" class="form-control" id="adminPw" />
                            </div>

                            <button class="col-1 bg-success text-white border border-secondary mt-4 rounded-3" id="spbasi" onclick="showPasswordAdminSignIn();">
                                <i class="bi bi-eye-fill"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-10 mx-auto mt-5">
                        <button class="col-12 btn btn-success" onclick="adminSignIn();">Sign In</button>
                    </div>

                </div>
                <!-- Sign In Box -->

            </div>
            <!-- Login Box -->

            <div class="col-lg-1"></div>

        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>