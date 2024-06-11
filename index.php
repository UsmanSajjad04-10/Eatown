<?php include "include/header.php" ?>


<?php
error_reporting(0);
session_start();

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
        $food_title = $_POST['food_title'];
        $food_quantity = $_POST['food_quantity'];
        $total_price = number_format($food_price * $food_quantity);

        $select_food = $connection->query("SELECT * FROM cart WHERE food_id= $food_id AND user_id = $user_id");


        if (mysqli_num_rows($select_food)  > 0) {
            $message[] = 'This Food is already in your cart';
        } else {

            $insertQuery = "INSERT INTO cart (`food_id`,`user_id`,`name`, `food_title`,`price`, `image`, `quantity` ,`total`)
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


<!-- Navbar Start -->
<?php include "include/navbar.php"; ?>
<!-- Navbar End -->

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
<!-- Carousel Start -->
<div class="container-fluid mb-3">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#header-carousel" data-slide-to="1"></li>
                    <li data-target="#header-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item position-relative active" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="img/mai pic.png" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Fried Chicken</h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn">It's the food and groceries you love, delivered</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item position-relative" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="img/mai pic 2.jpg" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Zaika E Mehfil</h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Highlight the flavors that customers can expect from the dish. Whether it's a burst of spices, a perfect balance of sweet and savory, or a unique fusion of flavors, convey the essence of the dish.</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item position-relative" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="img/mai pic 3.jpg" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Swaad Mantra</h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Highlight the flavors that customers can expect from the dish. Whether it's a burst of spices, a perfect balance of sweet and savory, or a unique fusion of flavors, convey the essence of the dish.</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="img/offer pic 1.png" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="img/offer pic 2.jpg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->


<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Delicious Food</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Fast Delivery</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">option Return</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->

<!-- Categories End -->


<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Food Available</span></h2>
    <div class="row px-xl-5">
        <?php
        $select_food = mysqli_query($connection, "SELECT * FROM `food_details` ORDER BY RAND() LIMIT 30") or die('query failed');

        if (mysqli_num_rows($select_food) > 0) {
            while ($fetch_food = mysqli_fetch_assoc($select_food)) {
                $food_id =   $fetch_food['food_id'];
                $food_name =   $fetch_food['food_name'];
                $food_img =   $fetch_food['food_img'];
                $food_price =   $fetch_food['food_price'];
                $food_title =   $fetch_food['food_title'];
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
                                    <input class="hidden_input" type="hidden" name="food_title" value="<?php echo $food_title; ?>">
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
        } else {
            echo '<p class="empty">no products added yet!</p>';
        }
        ?>
        </form>
    </div>
</div>
<!-- Products End -->


<!-- Offer Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        <div class="col-md-6">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="img/offer pic 1.png" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="img/offer pic 2.jpg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->


<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent Products</span></h2>
    <div class="row px-xl-5">
        <?php
        $select_food = mysqli_query($connection, "SELECT * FROM `food_details` ORDER BY `food_id` DESC LIMIT 20") or die('query failed');
        if (mysqli_num_rows($select_food) > 0) {
            while ($fetch_food = mysqli_fetch_assoc($select_food)) {
                $food_id =   $fetch_food['food_id'];
                $food_name =   $fetch_food['food_name'];
                $food_img =   $fetch_food['food_img'];
                $food_price =   $fetch_food['food_price'];
                $food_title =   $fetch_food['food_title'];
        ?>

                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="foodimages/<?php echo $food_img; ?>" alt="">
                            <div class="product-action">
                                <?php echo "    <a class='btn btn-outline-dark btn-square' href='detail.php?details={$food_id}, {$food_name}'><i class='fa fa-search'></i></a>"; ?>
                                <!-- <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a> -->

                                <form action="" method="post">
                                    <a href="" class="btn btn-outline-dark btn-square"> <button id="bsa" name="add_to_cart">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button></a>
                                    <input class="hidden_input" type="hidden" name="food_quantity" value="1" min="1" max="10">
                                    <input class="hidden_input" type="hidden" name="food_name" value="<?php echo $food_name; ?>">
                                    <input class="hidden_input" type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                                    <input class="hidden_input" type="hidden" name="food_image" value="<?php echo $food_img; ?>">
                                    <input class="hidden_input" type="hidden" name="food_price" value="<?php echo $food_price; ?>">
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
                </div>


        <?php
            }
        } else {
            echo '<p class="empty">no products added yet!</p>';
        }
        ?>

    </div>
</div>
<!-- Products End -->



<!-- Footer Start -->
<?php include "include/footer.php"; ?>
<!-- Footer End -->