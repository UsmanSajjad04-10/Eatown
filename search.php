<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>
<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
    <h4 style="text-align:center;">  <div class="message" id= "messages"><span>' . $message . '</span></h4>
    </div>
    ';
    }
}
?>



<?php

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if (isset($_POST['add_to_cart'])) {
    if (!isset($user_id)) {
        $message[] = 'Please Login to get your Food';
    } else {

        $food_name = $_POST['food_name'];
        $food_id = $_POST['food_id'];
        $food_image = $_POST['food_image'];
        $food_price = $_POST['food_price'];
        $food_quantity = $_POST['food_quantity'];
        $total_price = number_format($food_price * $food_quantity);

        $select_food = $connection->query("SELECT * FROM cart WHERE food_id= $food_id AND user_id = $user_id");


        if (mysqli_num_rows($select_food)  > 0) {
            $message[] = 'This Food is already in your cart';
        } else {

            $insertQuery = "INSERT INTO cart (`food_id`,`user_id`,`name`, `price`, `image`, `quantity` ,`total`)
            VALUES ('{$food_id}','{$user_id}','{$food_name}','{$food_price}','{$food_image}','{$food_quantity}','{$total_price}')";


            $query = mysqli_query($connection, $insertQuery);
            if ($query) {
                $message[] = 'Add to cart Sucessfully';
            } else {
                $message[] =  die("Failed" . mysqli_error($connection));
            }
        }
    }
}

if ($connection->errno) {
    echo "Query failed: " . $connection->error;
}


////////////////search query///////////////////////////////

if (isset($_POST['search_btn'])) {
    $search_box = $_POST['search_box'];

    // Sanitize the search input to prevent SQL injection
    $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);

    // Perform the database query
    $select_products = mysqli_query($connection, "SELECT * FROM `food_details` WHERE food_name LIKE '%{$search_box}%' OR food_title LIKE '%{$search_box}%' OR food_category LIKE '%{$search_box}%' OR food_discription LIKE '%{$search_box}%' ");

    // Check if the query was successful
    if ($select_products) {
        if (mysqli_num_rows($select_products) > 0) {
            // Output the results
?>
            <div class="container-fluid pt-5 pb-3">
                <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Search Result</span></h2>
                <div class="row px-xl-5">
                    <?php
                    while ($fetch_food = mysqli_fetch_assoc($select_products)) {
                        $food_id = $fetch_food['food_id'];
                        $food_name = $fetch_food['food_name'];
                        $food_img = $fetch_food['food_img'];
                        $food_price = $fetch_food['food_price'];
                        $food_title = $fetch_food['food_title'];
                    ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class='img-fluid w-100' src='foodimages/<?php echo $food_img; ?>' alt=''>
                                    <div class="product-action">
                                        <?php echo "    <a class='btn btn-outline-dark btn-square' href='detail.php?details={$food_id}, {$food_name}'><i class='fa fa-search'></i></a>"; ?>
                                        <!-- <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a> -->
                                        <!-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a> -->
                                        <form action="" method="post">
                                            <a href="" class="btn btn-outline-dark btn-square"> <button id="bsa" name="add_to_cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button></a>
                                            <input class="hidden_input" type="hidden" name="food_quantity" value="1" min="1" max="10">
                                            <input class="hidden_input" type="hidden" name="food_name" value="<?php echo $food_name; ?>">
                                            <input class="hidden_input" type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                                            <input class="hidden_input" type="hidden" name="food_image" value="<?php echo $food_img; ?>">
                                            <input class="hidden_input" type="hidden" name="food_price" value="<?php echo $food_price; ?>">
                                            <!-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a> -->
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href=""><?php echo $food_name; ?></a>
                                    <a class="h6 text-decoration-none text-truncate" href=""><?php echo $food_title; ?></a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>Rs <?php echo $food_price; ?>\-<h6 class="text-muted ml-2"><del>Rs <?php echo $food_price; ?>\-</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small>(99)</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
<?php
        } else {
            $message[] = "No results found.";
        }
    } else {
        echo "Query failed: " . mysqli_error($connection);
    }
}
?>






<?php include "include/footer.php" ?>