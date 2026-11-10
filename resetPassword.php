<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Supermarket | Reset Password</title>
    <link rel="icon" href="Resources/Img/Supermarket Icon.ico" />
</head>

<body class="body">

    <br /><br /><br /><br /><br /><br /><br /><br />
    <div class="col-lg-5 col-md-9 mx-auto my-auto signIn_Box">

        <h2 class="text-center mt-3">Reset Password</h2>

        <div class="d-none mt-3" id="resetMsgDiv">
            <div class="alert" id="resetMsg"></div>
        </div>

        <input class="col-10 mx-auto mt-3" type="hidden" id="vcode" value="<?php echo ($_GET["vcode"]); ?>" />

        <div class="col-10 mx-auto mt-3">
            <div class="row">
                <div class="col-11">
                    <label for="form-label">New Password :</label>
                    <input type="password" class="form-control" id="np" />
                </div>

                <button class="col-1 bg-success text-white border border-secondary mt-4 rounded-3" id="spbr1" onclick="showPasswordReset1();">
                    <i class="bi bi-eye-fill"></i>
                </button>
            </div>
        </div>

        <div class="col-10 mx-auto mt-3">
            <div class="row">
                <div class="col-11">
                    <label for="form-label">Retype Password :</label>
                    <input type="password" class="form-control" id="np2" />
                </div>

                <button class="col-1 bg-success text-white border border-secondary mt-4 rounded-3" id="spbr2" onclick="showPasswordReset2();">
                    <i class="bi bi-eye-fill"></i>
                </button>
            </div>
        </div>

        <div class="col-10 mx-auto mt-5 mb-3">
            <button class="btn btn-success col-12" onclick="resetPassword();">Confirm</button>
        </div>
    </div>

    <script src="script.js"></script>

</body>

</html>