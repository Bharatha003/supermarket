<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Supermarket | Forget Password</title>
    <link rel="icon" href="Resources/Img/Supermarket Icon.ico" />
</head>

<body class="body">

    <br /><br /><br /><br /><br /><br /><br /><br />
    <div class="col-lg-5 col-md-9 mx-auto my-auto signIn_Box">

        <h2 class="text-center mt-3">Forget Password Recovery</h2>

        <div class="d-none mt-3" id="forgetMsgDiv">
            <div class="alert" id="forgetMsg"></div>
        </div>

        <div class="col-10 mx-auto mt-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="e">
        </div>

        <div class="col-10 mx-auto mt-5 mb-3">
            <button class="col-12 btn btn-success" onclick="forgetPassword();">Send Email</button>
        </div>

    </div>

    <script src="script.js"></script>

</body>

</html>