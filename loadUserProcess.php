<?php
include "connection.php";

$pageno = 0;
$page = $_POST["p"];

if (0 != $page) {
    $pageno = ($pageno = $page);
} else {
    $pageno = 1;
}

$q = "SELECT user.*,
user.id AS user_id,
user.fname AS user_fname,
user.lname AS user_lname,
user.email AS user_email,
user.mobile AS user_mobile,
user.status AS user_status,
user_type.type AS user_type_type
FROM `user` 
INNER JOIN `user_type` ON `user`.`user_type_id` = `user_type`.`id` 
ORDER BY `user`.`id` ASC";

$rs = Database::search($q);
$num = $rs->num_rows;

$results_per_page = 10;
$num_of_pages = ceil($num / $results_per_page);

$page_results = ($pageno - 1) * $results_per_page;

$q2 = $q . " LIMIT $results_per_page OFFSET $page_results";
$rs2 = Database::search($q2);
$num2 = $rs2->num_rows;

if ($num2 == 0) {
?>

    <!--Empty Search Message-->
    <div class="alert alert-danger border border-danger d-flex flex-column justify-content-center align-items-center rounded-4 mt-3" role="alert">
        <h5><i class="bi bi-exclamation-circle fs-5"></i> No Users Found.</h5>
        <p>We're Sorry, We cannot find any matches for your search term...</p>
    </div>
    <!--Empty Search Message-->

<?php
} else {
?>

    <!-- User Details Table -->
    <table class="table table-hover">
        <thead class="table-success">
            <tr>
                <th scope="col">User Id</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Mobile</th>
                <th scope="col">User Type</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">

            <?php
            for ($i = 0; $i < $num2; $i++) {
                $d = $rs2->fetch_assoc();
            ?>

                <tr>
                    <td><?php echo $d["user_id"] ?></td>
                    <td><?php echo $d["user_fname"] ?></td>
                    <td><?php echo $d["user_lname"] ?></td>
                    <td><?php echo $d["user_email"] ?></td>
                    <td><?php echo $d["user_mobile"] ?></td>
                    <td><?php echo $d["user_type_type"] ?></td>
                    <td><?php echo $d["user_status"] == 1 ? "Active" : "Deactive" ?></td>
                    <?php
                    if ($d["user_status"] == 1) {
                    ?>
                        <td><span class="btn btn-danger" onclick="updateUserStatus('<?php echo $d['user_id'] ?>');">Block</span></td>
                    <?php
                    } else {
                    ?>
                        <td><span class="btn btn-success" onclick="updateUserStatus('<?php echo $d['user_id'] ?>');">Unblock</span></td>
                    <?php
                    }
                    ?>
                </tr>

            <?php
            }
            ?>

        </tbody>
    </table>
    <!-- User Details Table -->

    <!-- Pagination  -->
    <div class="d-flex justify-content-center mt-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link border-dark text-dark fw-bold" <?php

                                                                                            if ($pageno <= 1) {
                                                                                                echo ("#");
                                                                                            } else {
                                                                                            ?>onclick="loadUser(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                                            }
                                                                                                                                                ?>>◀</a></li>

                <?php
                for ($y = 1; $y <= $num_of_pages; $y++) {
                    if ($y == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link bg-dark border-dark text-light fw-bold" onclick="loadUser(<?php echo ($y) ?>);"><?php echo ($y) ?></a>
                        </li>
                    <?php

                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link border-dark text-dark fw-bold" onclick="loadUser(<?php echo ($y) ?>);"><?php echo ($y) ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item"><a class="page-link border-dark text-dark fw-bold" <?php

                                                                                            if ($pageno >= $num_of_pages) {
                                                                                                echo ("#");
                                                                                            } else {
                                                                                            ?>onclick="loadUser(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                                            }
                                                                                                                                                ?>>▶</a></li>
            </ul>
        </nav>
    </div>
    <!-- Pagination  -->

<?php
}
?>