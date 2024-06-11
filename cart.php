<?php include "include/header.php";  ?>
<?php
// session_start();

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($connection, "DELETE FROM `cart` WHERE id='$remove_id'") or die('query failed');
    $message[] = 'Removed Successfully';
    header('location:cart.php');
}
if (isset($_POST['update'])) {
    $update_cart_id = $_POST['cart_id'];
    $food_price = $_POST['foodprice'];
    $update_quantity = $_POST['update_quantity'];
    $total_price = $food_price * $update_quantity;
    mysqli_query($connection, "UPDATE `cart` SET `quantity`='$update_quantity', `total`='$total_price' WHERE `id`='$update_cart_id'") or die('query failed');

    $message[] = '' . $user_name . ' your cart updated successfully';
}



?>

<?php include "include/navbar.php"; ?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
          <div style="text-align:center;" class="message" id= "messages"><h3>' . $message . '</h3>
        </div>
        ';
    }
}
?>

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">

                    <?php
                    $total = 0;
                    $select_food = $connection->query("SELECT id, name,price, image ,quantity,total  FROM cart Where user_id= $user_id");
                    if ($select_food->num_rows  > 0) {

                        while ($row = $select_food->fetch_assoc()) {
                            $food_name = $row['name'];
                            $food_price = $row['price'];
                            $food_quantity = $row['quantity'];
                            $cart_id =  $row['id'];
                            $totalprice =  $row['price'];
                            $foodimg = $row['image'];
                    ?>

                            <tr>
                            </tr>
                            <td class="align-middle"><img src="foodimages/<?php echo $foodimg; ?>" alt="" style="width: 50px;"> <?php echo $food_name; ?></td>
                            <td class="align-middle">Rs <?php echo $food_price; ?></td>
                            <td class="align-middle">
                                <form action="" method="post">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <!-- <button class="btn btn-sm btn-primary btn-minus" name="update_action" value="minus"> -->
                                            <!-- <i class="fa fa-minus"></i> -->
                                            </button>
                                        </div>
                                        <input type="number" name="update_quantity" class="form-control form-control-sm bg-secondary border-0 text-center" value="<?php echo $food_quantity; ?>">
                                        <div class="input-group-btn">
                                            <!-- <button class="btn btn-sm btn-primary btn-plus" name="update_action" value="plus"> -->
                                            <!-- <i class="fa fa-plus"></i> -->
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
                                    <div class="col-12 ml-6  ">

                                        <button type="submit" name="update" class="btn btn-block btn-primary font-weight-bold  my-1 py-1">Update</button>
                                    </div>
                                </form>
                            </td>


                            <td class="align-middle">Rs <?php $sub_total = $food_price * $food_quantity;
                                                        echo $subtotal = number_format($food_price * $food_quantity); ?></td>
                            <td class="align-middle"> <a href="cart.php?remove=<?php echo $cart_id; ?>"><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></a></td>
                            </form>

                    <?php
                            $total += $sub_total;
                        }
                    } else {
                        $message[] =  '<p style="text-align:center;" class="empty">There is nothing in cart yet !!!!!!!!</p>';
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <!-- <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form> -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6><?php echo $total; ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">delivery charges</h6>
                        <h6 class="font-weight-medium">Rs 100/-</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>Rs <?php
                                $deilvery = "100";
                                $conformtotal  = $total + $deilvery;
                                echo $conformtotal; ?>/-</h5>
                    </div>

                    <a href="checkout.php" class="btn btn-block btn-primary font-weight-bold my-3 py-3" style="display: <?php echo ($total > 1) ? 'inline-block' : 'none'; ?>">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->



<!-- Footer Start -->
<?php include "include/footer.php"; ?>
<!-- Footer End -->