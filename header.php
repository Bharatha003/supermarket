<div class="col-12  shadow-lg">
    <div class="row">

        <!-- greeen bar -->
        <div class="col-12 bg-success">
            <div class="row">

                <div class="offset-1 col-7">
                    <?php
                    if (isset($_SESSION["u"])) {
                        $session_data = $_SESSION["u"];

                    ?>
                        <span class="text-lg-start text-white">Welcome
                            <a href="" class="text-decoration-none text-light" style="font-family: latoBold;"><?php echo $session_data["fname"] . " " . $session_data["lname"]; ?></a>
                            !! |
                        </span>
                        <span class="text-lg-start text-white" style="cursor: pointer; font-family: latoBold;" onclick="signOut();">Logout</span>
                    <?php

                    } else {

                    ?>
                        <span class="text-white">You have to
                            <a href="signIn.php" class="text-decoration-none text-white" style="font-family: latoBold;">
                                Sign In or Register
                            </a> to continue shopping...</span>
                    <?php

                    }
                    ?>
                </div>

                <div class="col-3 text-end">
                    <span class="text-light justify-content-end" style="font-family: latoItalic;">Better Shopping...</span>
                </div>

            </div>
        </div>
        <!-- greeen bar -->

        <!-- nav bar -->
        <nav class="col-12 navbar navbar-expand-lg bg-white">

            <div class="col-12 container bg-white">

                <a class="navbar-brand h1 mb-0" href="home.php">
                    <img class="me-3" src="Resources/Img/Supermarket Logo.jpg" height="55" />
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="d-flex justify-content-end">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-5">

                            <li class="nav-item me-5">
                                <a class="nav-link active" aria-current="page" href="profile.php"><i class="bi bi-person-circle fs-3" title="Profile"></i></a>
                            </li>

                            <li class="nav-item me-5">
                                <a class="nav-link active" aria-current="page" href="orderHistory.php"><i class="bi bi-clock fs-3" title="Order History"></i></a>
                            </li>

                            <li class="nav-item me-5">
                                <a class="nav-link active fs-5" aria-current="page" href="cart.php"><i class="bi bi-cart fs-3" title="Cart"></i></a>
                            </li>

                        </ul>

                    </div>

                </div>

            </div>
            <script src="script.js"></script>
        </nav>
        <!-- nav bar -->

    </div>
</div>