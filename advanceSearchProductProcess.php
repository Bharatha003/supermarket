<?php

include "connection.php";

$pageno = 0;
$page = $_POST["pg"];

$category = $_POST["cat"];
$brand = $_POST["b"];
$dietarypref = $_POST["dpref"];
$packagingtype = $_POST["ptype"];
$minPrice = $_POST["min"];
$maxPrice = $_POST["max"];

$status = 0;

if (0 != $page) {
    $pageno = $page;
} else {
    $pageno = 1;
}


$q = "SELECT * 
FROM `stock` 
INNER JOIN `product` ON `stock`.`product_id` = `product`.`id`
INNER JOIN `category` ON `product`.`category_id` = `category`.`id`
INNER JOIN `brand` ON `product`.`brand_id` = `brand`.`id`
INNER JOIN `dietary_pref` ON `product`.`dietary_pref_id` = `dietary_pref`.`id`
INNER JOIN `packaging_type` ON `product`.`packaging_type_id` = `packaging_type`.`id` ";

// Search by Category 

if ($status == 0 && $category != 0) {
    //1st time search by category (Where)
    $q .= "WHERE `category`.`id` = '" . $category . "' ";
    $status = 1;
    //2st time search by category (And)
} elseif ($status != 0 && $category  != 0) {
    $q .= "AND `category`.`id` = '" . $category . "' ";
}

//search by Brand

if ($status == 0 && $brand != 0) {
    //1st time search by brand (Where)
    $q .= "WHERE `brand`.`id` = '" . $brand . "' ";
    $status = 1;
    //2st time search by brand (And)
} elseif ($status != 0 && $brand  != 0) {
    $q .= "AND `brand`.`id` = '" . $brand . "' ";
}

//search by Dietary Preference

if ($status == 0 && $dietarypref != 0) {
    //1st time search by color (Where)
    $q .= "WHERE `dietary_pref`.`id` = '" . $dietarypref . "' ";
    $status = 1;
    //2st time search by color (And)
} elseif ($status != 0 && $dietarypref  != 0) {
    $q .= "AND `dietary_pref`.`id` = '" . $dietarypref . "' ";
}


//search by Packaging Type

if ($status == 0 && $packagingtype != 0) {
    //1st time search by size (Where)
    $q .= "WHERE `packaging_type`.`id` = '" . $packagingtype . "' ";
    $status = 1;
    //2st time search by size (And)
} elseif ($status != 0 && $packagingtype  != 0) {
    $q .= "AND `packaging_type`.`id` = '" . $packagingtype . "' ";
}

//search by Min Price

if (!empty($minPrice) && empty($maxPrice)) {
    if ($status == 0) {
        $q .= "WHERE `stock`.`price`>= '" . $minPrice . "' ORDER BY `stock`.`price` ASC ";
        $status = 1;
    } else if ($status != 0) {
        $q .= "AND `stock`.`price`>= '" . $minPrice . "' ORDER BY `stock`.`price` ASC ";
    }
}

//search by Max Price

if (!empty($maxPrice) && empty($minPrice)) {
    if ($status == 0) {
        $q .= "WHERE `stock`.`price`<= '" . $maxPrice . "' ORDER BY `stock`.`price` ASC ";
        $status = 1;
    } else if ($status != 0) {
        $q .= "AND `stock`.`price`<= '" . $maxPrice . "' ORDER BY `stock`.`price` ASC ";
    }
}

//search by  Price Range
if (!empty($minPrice) && !empty($maxPrice)) {
    if ($status == 0) {
        $q .= "WHERE `stock`.`price` BETWEEN '" . $minPrice . "' AND '" . $maxPrice . "' ORDER BY `stock`.`price` ASC ";
        $status = 1;
    } else if ($status != 0) {
        $q .= "AND `stock`.`price` BETWEEN '" . $minPrice . "' AND '" . $maxPrice . "' ORDER BY `stock`.`price` ASC ";
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
    # code...

?>
    <!-- <div class="d-flex flex-column justify-content-center mt-5 align-items-center">
        <h5>Search No Results</h5>
        <p>We're Sorry, We cannot find any matches for your search them..</p>

    </div> -->
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </svg>
        <h5>No Results Found.</h5>
    </div>

    <?php
} else {
    for ($i = 0; $i < $num2; $i++) {
        $d = $rs2->fetch_assoc();
    ?>

        <!-- card  -->
        <div class="d-flex justify-content-center col-3 mt-3">
            <div class="card" style="width: 300px">
                <a href="singleProductView.php?s=<?php echo $d["stock_id"] ?>"><img src="<?php echo $d["path"]; ?>" class="card-img-top" alt="..."></a>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $d["name"]; ?></h5>
                    <p class="card-text"><?php echo $d["description"]; ?></p>
                    <p class="card-text"><?php echo $d["price"]; ?></p>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-outline-primary">Add to Cart</button>
                        <button class="btn btn-outline-primary ms-2">Buy Now</button>
                    </div>

                </div>
            </div>
        </div>

    <?php
    }

    ?>

    <!-- pagination  -->
    <div class="d-flex justify-content-center mt-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" <?php

                                                            if ($pageno <= 1) {
                                                                echo ("#");
                                                            } else {
                                                            ?>onclick="advSearchProduct(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                    }
                                                                                                                        ?>>Previous</a></li>

                <?php
                for ($y = 1; $y <= $num_of_pages; $y++) {
                    if ($y == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="advSearchProduct(<?php echo ($y) ?>);"><?php echo ($y) ?></a>
                        </li>
                    <?php

                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="advSearchProduct(<?php echo ($y) ?>);"><?php echo ($y) ?></a>
                        </li>
                <?php
                    }
                }

                ?>





                <li class="page-item"><a class="page-link" <?php

                                                            if ($pageno >= $num_of_pages) {
                                                                echo ("#");
                                                            } else {
                                                            ?>onclick="advSearchProduct(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                    }
                                                                                                                        ?>>Next</a></li>
            </ul>
        </nav>
    </div>

<?php
}
