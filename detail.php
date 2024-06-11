<?php include "include/header.php"; ?>
<?php include "include/navbar.php";

$user_id = $_SESSION['user_id'];
if (isset($_POST['add_to_cart'])) {
    if (!isset($user_id)) {
        $message[] = 'Please Login to get your Food';
    } else {

        $food_name = $_POST['food_name'];
        $food_title = $_POST['food_title'];
        $food_id = $_POST['food_id'];
        $food_image = $_POST['food_image'];
        $food_price = $_POST['food_price'];
        $food_quantity = $_POST['food_quantity'];
        $total_price = number_format($food_price * $food_quantity);

        $select_food = $connection->query("SELECT * FROM cart WHERE food_id= $food_id AND user_id = $user_id");


        if (mysqli_num_rows($select_food)  > 0) {
            $message[] = 'This Food is already in your cart';
        } else {

            $insertQuery = "INSERT INTO cart (`food_id`,`user_id`,`name`,`food_title`, `price`, `image`, `quantity` ,`total`)
            VALUES ('{$food_id}','{$user_id}','{$food_name}', '{$food_title}','{$food_price}','{$food_image}','{$food_quantity}','{$total_price}')";


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


?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shop Detail</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <h4 style="text-align:center;" >  <div class="message" id= "messages"><span>' . $message . '</span></h4>
        </div>
        ';
    }
}
?>
<?php
if (isset($_GET['details'])) {
    $food_id = $_GET['details'];
    $get_food = mysqli_query($connection, "SELECT * FROM `food_details` WHERE food_id = '$food_id'") or die('query failed');
    if (mysqli_num_rows($get_food) > 0) {
        while ($fetch_food = mysqli_fetch_assoc($get_food)) {
            $food_id =   $fetch_food['food_id'];
            $food_name =   $fetch_food['food_name'];
            $food_img =   $fetch_food['food_img'];
            $food_price =   $fetch_food['food_price'];
            $food_title =   $fetch_food['food_title'];
            $food_desc =   $fetch_food['food_discription'];
?>
            <!-- Shop Detail Start -->
            <div class="container-fluid pb-5">
                <div class="row px-xl-5">
                    <div class="col-lg-5 mb-30">
                        <div id="product-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner bg-light">
                                <div class="carousel-item active">
                                    <img class="w-100 h-100" src="foodimages/<?php echo $food_img; ?>" alt="Image">
                                </div>
                                <!-- <div class="carousel-item">
                            <img class="w-100 h-100" src="img/product-2.jpg" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="img/product-3.jpg" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="img/product-4.jpg" alt="Image">
                        </div> -->
                            </div>
                            <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                                <i class="fa fa-2x fa-angle-left text-dark"></i>
                            </a>
                            <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                                <i class="fa fa-2x fa-angle-right text-dark"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-7 h-auto mb-30">
                        <div class="h-100 bg-light p-30">
                            <h3><?php echo $food_name; ?></h3>
                            <div class="d-flex mb-3">
                                <div class="text-primary mr-2">
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star-half-alt"></small>
                                    <small class="far fa-star"></small>
                                </div>
                                <small class="pt-1">(99 Reviews)</small>
                            </div>
                            <h3 class="font-weight-semi-bold mb-4">Rs <?php echo $food_price; ?>\-</h3>
                            <p class="mb-4"><?php echo $food_desc; ?></p>
                            <div class="d-flex mb-3">
                                <strong class="text-dark mr-3"><?php echo $food_title; ?></strong>
                                <form action="" method="post">
                                    <input class="hidden_input" type="hidden" name="food_name" value="<?php echo $food_name; ?>">
                                    <input class="hidden_input" type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                                    <input class="hidden_input" type="hidden" name="food_image" value="<?php echo $food_img; ?>">
                                    <input class="hidden_input" type="hidden" name="food_price" value="<?php echo $food_price; ?>">
                                    <input class="hidden_input" type="hidden" name="food_title" value="<?php echo $food_title; ?>">

                            </div>

                            <div class="d-flex align-items-center mb-4 pt-2">
                                <div class="input-group quantity mr-3" style="width: 130px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary btn-minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="food_quantity" class="form-control bg-secondary border-0 text-center" value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" name="add_to_cart" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                                    Cart</button>
                            </div>
                            </form>
                            <div class="d-flex pt-2">
                                <strong class="text-dark mr-2">Nice Choice</strong>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row px-xl-5">

                </div>
            </div>

            <!-- Shop Detail End -->


<?php
        }
    }
} else {
    // echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
}


?>
<!-- Products Start -->
<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                <?php
                $select_food = mysqli_query($connection, "SELECT * FROM `food_details` ORDER BY RAND() LIMIT 15") or die('query failed');
                if (mysqli_num_rows($select_food) > 0) {
                    while ($fetch_food = mysqli_fetch_assoc($select_food)) {
                        $food_id =   $fetch_food['food_id'];
                        $food_name =   $fetch_food['food_name'];
                        $food_img =   $fetch_food['food_img'];
                        $food_price =   $fetch_food['food_price'];
                        $food_title =   $fetch_food['food_title'];
                ?>
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="foodimages/<?php echo $food_img; ?>" alt="">
                                <div class="product-action">

                                    <a class="btn btn-outline-dark btn-square" href="detail.php?details=<?php echo $food_id; ?>&name=<?php echo $food_name; ?>">
                                        <i class="fa fa-search"></i>
                                    </a>

                                    <!-- Uncomment these lines if you want to include heart and sync buttons -->
                                    <!--
                <button class="btn btn-outline-dark btn-square" name="add_to_cart">
                    <i class="far fa-heart"></i>
                </button>
                
                <button class="btn btn-outline-dark btn-square" name="add_to_cart">
                    <i class="fa fa-sync-alt"></i>
                </button>
            -->


                                    <form action="" method="post">
                                        <a href="" class="btn btn-outline-dark btn-square"> <button id="bsa" name="add_to_cart">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button></a>
                                        <input type="hidden" name="food_name" value="<?php echo $food_name; ?>">
                                        <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                                        <input type="hidden" name="food_image" value="<?php echo $food_img; ?>">
                                        <input type="hidden" name="food_price" value="<?php echo $food_price; ?>">
                                        <input class="hidden_input" type="hidden" name="food_title" value="<?php echo $food_title; ?>">

                                    </form>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href=""><?php echo $food_name; ?></a>
                                <a class="h6 text-decoration-none text-truncate" href=""><?php echo $food_title; ?></a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>Rs <?php echo $food_price; ?>\-</h5>
                                    <h6 class="text-muted ml-2"><del> <?php echo $food_price; ?></del></h6>
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

                <?php
                    }
                } else {
                    echo '<p class="empty">no products added yet!</p>';
                }
                ?>



            </div>
        </div>
    </div>
</div>
<!-- Products End -->


<!-- Footer Start -->
<?php include "include/footer.php" ?>
<!-- Footer End -->