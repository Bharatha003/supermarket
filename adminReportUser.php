<?php
session_start();
include "connection.php";

if (isset($_SESSION["a"])) {
    $rs =  Database::search("SELECT user.*,
    user.id AS user_id, 
    user.fname AS user_fname,  
    user.lname AS user_lname,  
    user.email AS user_email,  
    user.mobile AS user_mobile,  
    user.status AS user_status,  
    user_type.type AS user_type_name  
    FROM `user`
    INNER JOIN `user_type` ON `user`.`user_type_id` = `user_type`.`id`
    ORDER BY `user`.`id` ASC");
    $num = $rs->num_rows;
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <title>Supermarket | User Report</title>
        <link rel="icon" href="Resources/Img/Supermarket Icon.ico" />
    </head>

    <body class="bg-white">

        <div class="col-11 btn-toolbar justify-content-end mt-5">
            <a href="adminReport.php"><button class="btn btn-dark me-2"><i class="bi bi-arrow-left-circle-fill"></i> Back</button></a>
            <button class="btn btn-danger me-2" onclick="printDiv();"><i class="bi bi-printer-fill"></i> Print</button>
        </div>

        <!-- Print Area -->
        <div class="container bg-white shadow rounded-4 p-3 mt-3 mb-5" id="printArea">
            <div class="border border-3 border-success bg-white p-5 rounded-4">

                <div class="col-12 bg-success rounded-4 p-3 mb-2">
                    <div class="row">
                        <img src="Resources\img\Supermarket Logo.jpg" class="col-3 my-auto rounded-4" height="80px" alt="Supermarket Logo" />
                        <div class="col-9 text-end my-auto">
                            <h1 class="text-light">User Report</h1>
                        </div>
                    </div>
                </div>

                <!-- Stock Details -->
                <div class="mt-5">
                    <table class="table table-hover">
                        <thead class="table-success">
                            <tr>
                                <th>User Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>User Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            for ($i = 0; $i < $num; $i++) {
                                $d = $rs->fetch_assoc();
                            ?>
                                <tr>
                                    <td><?php echo $d["user_id"] ?></td>
                                    <td><?php echo $d["user_fname"] ?></td>
                                    <td><?php echo $d["user_lname"] ?></td>
                                    <td><?php echo $d["user_email"] ?></td>
                                    <td><?php echo $d["user_mobile"] ?></td>
                                    <td><?php echo $d["user_type_name"] ?></td>
                                    <td><?php if ($d["user_status"] == 1) {
                                            echo ("Active");
                                        } else {
                                            echo ("Inactive");
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Stock Details -->

            </div>
        </div>
        <!-- Print Area -->

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