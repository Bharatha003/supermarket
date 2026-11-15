<?php

include "connection.php";

$pageno = 0;
$page = $_POST["pg"];
$search = $_POST["text"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$availability = $_POST["avb"];
$sort = $_POST["sort"];
$minPrice = $_POST["min"];
$maxPrice = $_POST["max"];

$status = 0;

if (0 != $page) {
    $pageno = $page;
} else {
    $pageno = 1;
}

$q = "SELECT stock.*, 
stock.id AS stock_id, 
product.id AS product_id,
product.name AS product_name,
product.img_path AS product_img_path, 
category.name AS category_name 
FROM `stock` 
INNER JOIN `product` ON `stock`.`product_id` = `product`.`id`
INNER JOIN `category` ON `product`.`category_id` = `category`.`id`";

// Search by Search Text
if (!empty($search)) {
    $q .= " WHERE `product`.`name` LIKE '%" . $search . "%'";
    $status = 1;
}

// Search by Category 
if ($status == 0 && $category != 0) {
    $q .= "WHERE `product`.`category_id` = '" . $category . "'";
    $status = 1;
} elseif ($status != 0 && $category  != 0) {
    $q .= "AND `product`.`category_id` = '" . $category . "'";
}

//search by Brand
if ($status == 0 && $brand != 0) {
    $q .= "WHERE `product`.`brand_id` = '" . $brand . "'";
    $status = 1;
} elseif ($status != 0 && $brand  != 0) {
    $q .= "AND `product`.`brand_id` = '" . $brand . "'";
}

//search by Availability
if ($status == 0 && $availability != 0) {
    $q .= " WHERE `stock`.`status`='1'";
    $status = 1;
} elseif ($status != 0 && $availability != 0) {
    $q .= " AND `stock`.`status`='1'";
}

//search by Min Price
if (!empty($minPrice) && empty($maxPrice)) {
    if ($status == 0) {
        $q .= "WHERE `stock`.`price`>= '" . $minPrice . "'";
        $status = 1;
    } else if ($status != 0) {
        $q .= "AND `stock`.`price`>= '" . $minPrice . "'";
    }
}

//search by Max Price
if (!empty($maxPrice) && empty($minPrice)) {
    if ($status == 0) {
        $q .= "WHERE `stock`.`price`<= '" . $maxPrice . "'";
        $status = 1;
    } else if ($status != 0) {
        $q .= "AND `stock`.`price`<= '" . $maxPrice . "'";
    }
}

//search by  Price Range
if (!empty($minPrice) && !empty($maxPrice)) {
    if ($status == 0) {
        $q .= "WHERE `stock`.`price` BETWEEN '" . $minPrice . "' AND '" . $maxPrice . "'";
        $status = 1;
    } else if ($status != 0) {
        $q .= "AND `stock`.`price` BETWEEN '" . $minPrice . "' AND '" . $maxPrice . "'";
    }
}

//search by Sort
if ($sort == 1) {

    if ($status == 0) {
        $q .= " WHERE `product`.`name` LIKE '%" . $search . "%' ORDER BY `stock`.`price` ASC";
        $status = 1;
    } else if ($status != 0) {
        $q .= " AND `product`.`name` LIKE '%" . $search . "%' ORDER BY `stock`.`price` ASC";
    }
} elseif ($sort == 2) {

    if ($status == 0) {
        $q .= " WHERE `product`.`name` LIKE '%" . $search . "%' ORDER BY `stock`.`price` DESC";
        $status = 1;
    } else if ($status != 0) {
        $q .= " AND `product`.`name` LIKE '%" . $search . "%' ORDER BY `stock`.`price` DESC";
    }
} elseif ($sort == 3) {

    if ($status == 0) {
        $q .= " WHERE `product`.`name` LIKE '%" . $search . "%' ORDER BY `stock`.`qty` ASC";
        $status = 1;
    } else if ($status != 0) {
        $q .= " AND `product`.`name` LIKE '%" . $search . "%' ORDER BY `stock`.`qty` ASC";
    }
} elseif ($sort == 4) {

    if ($status == 0) {
        $q .= " WHERE `product`.`name` LIKE '%" . $search . "%' ORDER BY `stock`.`qty` DESC";
        $status = 1;
    } else if ($status != 0) {
        $q .= " AND `product`.`name` LIKE '%" . $search . "%' ORDER BY `stock`.`qty` DESC";
    }
}

$rs = Database::search($q);
$num = $rs->num_rows;

$results_per_page = 8;
$num_of_pages = ceil($num / $results_per_page);
$page_results = ($pageno - 1) * $results_per_page;

$q2 = $q . " LIMIT $results_per_page OFFSET $page_results";

$rs2 = Database::search($q2);
$num2 = $rs2->num_rows;

if ($num2 == 0) {
?>

    <!--Empty Search Message-->
    <div class="alert alert-danger border border-danger d-flex flex-column justify-content-center align-items-center rounded-4 mt-3" role="alert">
        <h5><i class="bi bi-exclamation-circle fs-5"></i> No Results Found.</h5>
        <p>We're Sorry, We cannot find any matches for your search them...</p>
    </div>
    <!--Empty Search Message-->

    <?php
} else {

    for ($i = 0; $i < $num2; $i++) {
        $d = $rs2->fetch_assoc();
    ?>

        <!-- Card  -->
        <div class="d-flex justify-content-center col-3 mt-3">
            <div class="card border border-2 border-success rounded-4" style="width: 300px">
                <a href="singleProductView.php?s=<?php echo $d["product_id"] ?>"><img src="<?php echo $d["product_img_path"]; ?>" class="card-img-top mt-2" alt="<?php echo $d["product_name"]; ?>"></a>
                <div class="card-body">
                    <h5 class="card-title fw-bold fs-4"><?php echo $d["product_name"]; ?></h5>
                    <p class="badge rounded-pill border border-dark text-dark fs-6"><?php echo $d["category_name"]; ?></p>
                    <p class="card-text fs-5">Rs.<?php echo $d["price"]; ?>.00</p>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-dark col-6" onclick="addToCartFromSearch('<?php echo $d['stock_id'] ?>');">Add to Cart</button>
                        <button class="btn btn-success col-6 ms-2">Buy Now</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card  -->

    <?php
    }

    ?>

    <!-- Pagination  -->
    <div class="d-flex justify-content-center mt-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link border-dark text-dark fw-bold" <?php

                                                                                            if ($pageno <= 1) {
                                                                                                echo ("#");
                                                                                            } else {
                                                                                            ?>onclick="advSearchProduct(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                                                    }
                                                                                                                                                        ?>>◀</a></li>

                <?php
                for ($y = 1; $y <= $num_of_pages; $y++) {
                    if ($y == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link bg-dark border-dark text-light fw-bold" onclick="advSearchProduct(<?php echo ($y) ?>);"><?php echo ($y) ?></a>
                        </li>
                    <?php

                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link border-dark text-dark fw-bold" onclick="advSearchProduct(<?php echo ($y) ?>);"><?php echo ($y) ?></a>
                        </li>
                <?php
                    }
                }

                ?>





                <li class="page-item"><a class="page-link border-dark text-dark fw-bold" <?php

                                                                                            if ($pageno >= $num_of_pages) {
                                                                                                echo ("#");
                                                                                            } else {
                                                                                            ?>onclick="advSearchProduct(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                                                    }
                                                                                                                                                        ?>>▶</a></li>
            </ul>
        </nav>
    </div>
    <!-- Pagination  -->

<?php
}
