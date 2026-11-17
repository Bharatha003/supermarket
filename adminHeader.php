<div class="col-12  shadow-lg">
    <div class="row">

        <!-- greeen bar -->
        <div class="col-12 bg-success">
            <div class="row">

                <div class="offset-1 col-7">
                    <?php
                    if (isset($_SESSION["a"])) {
                        $session_data = $_SESSION["a"];

                    ?>
                        <span class="text-lg-start text-white">Welcome Admin
                            <a href="" class="text-decoration-none text-light" style="font-family: latoBold;"><?php echo $session_data["fname"] . " " . $session_data["lname"]; ?></a>
                            !! |
                        </span>
                        <span class="text-lg-start text-white" style="cursor: pointer; font-family: latoBold;" onclick="signOut();">Logout</span>
                    <?php

                    } else {
                        header("location:signin.php");
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

                <a class="navbar-brand h1 mb-0" href="adminDashboard.php">
                    <img class="me-3" src="Resources/Img/Supermarket Logo.jpg" height="55" />
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="d-flex justify-content-end">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-5">

                            <li class="nav-item me-5">
                                <a class="nav-link active" aria-current="page" href="adminUser.php"><i class="bi bi-person-fill-gear fs-3" title="User Management"></i></a>
                            </li>

                            <li class="nav-item me-5">
                                <a class="nav-link active" aria-current="page" href="adminProduct.php"><i class="bi bi-database-fill-gear fs-3" title="Product Management"></i></a>
                            </li>

                            <li class="nav-item me-5">
                                <a class="nav-link active fs-5" aria-current="page" href="adminStock.php"><i class="bi bi-house-gear-fill fs-3" title="Stock Management"></i></a>
                            </li>

                            <li class="nav-item me-5">
                                <a class="nav-link active fs-5" aria-current="page" href="adminReport.php"><i class="bi bi-file-earmark-bar-graph-fill fs-3" title="Reports"></i></a>
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