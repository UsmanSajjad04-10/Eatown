<?php include "include/header.php" ?>


<?php
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:login.php');
}

if (isset($_POST['checkout'])) {

  $name = mysqli_real_escape_string($connection, $_POST['firstname']);
  $number = $_POST['number'];
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $method = mysqli_real_escape_string($connection, $_POST['method']);
  $address = mysqli_real_escape_string($connection, $_POST['address']);
  $city = mysqli_real_escape_string($connection, $_POST['city']);
  $state = mysqli_real_escape_string($connection, $_POST['state']);
  $country = mysqli_real_escape_string($connection, $_POST['country']);
  $pincode = mysqli_real_escape_string($connection, $_POST['pincode']);
  $full_address = mysqli_real_escape_string($connection, $_POST['address'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pincode']);
  $placed_on = date('d-M-Y');

  $cart_total = 0;
  $cart_products[] = '';
  if (empty($name)) {
    $message[] = 'Please Enter Your Name';
  } elseif (empty($email)) {
    $message[] = 'Please Enter Email Id';
  } elseif (empty($number)) {
    $message[] = 'Please Enter Mobile Number';
  } elseif (empty($address)) {
    $message[] = 'Please Enter Address';
  } elseif (empty($city)) {
    $message[] = 'Please Enter city';
  } elseif (empty($state)) {
    $message[] = 'Please Enter state';
  } elseif (empty($country)) {
    $message[] = 'Please Enter country';
  } elseif (empty($pincode)) {
    $message[] = 'Please Enter your area pincode';
  } else {

    $cart_query = mysqli_query($connection, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_query) > 0) {
      while ($cart_item = mysqli_fetch_assoc($cart_query)) {
        $cart_products[] = $cart_item['name'] . ' #' . $cart_item['food_title'] . ', x (' . $cart_item['quantity'] . ') ';
        $quantity = $cart_item['quantity'];
        $unit_price = $cart_item['price'];
        $cart_food = $cart_item['name'];
        $food_quantity = $cart_item['food_title'];
        $sub_total = ($cart_item['price'] * $cart_item['quantity']);
        $cart_total += $sub_total;
      }
    }


    $total_food = implode(' ', $cart_products);

    $order_query = mysqli_query($connection, "SELECT * FROM `confirm_order` WHERE name = '$name' AND number = '$number' AND email = '$email' AND payment_method = '$method' AND address = '$address' AND total_foods = '$total_food' AND total_price = '$cart_total'") or die('query failed');


    if (mysqli_num_rows($order_query) > 0) {
      $message[] = 'order already placed!';
    } else {
      mysqli_query($connection, "INSERT INTO `confirm_order`(user_id, name, number, email, payment_method, address ,total_foods, total_price, order_date)
       VALUES('$user_id','$name',  '$number', '$email','$method', '$full_address', '$total_food', '$cart_total', '$placed_on')") or die('query failed');

      $conn_oid = $connection->insert_id;
      $_SESSION['id'] = $conn_oid;
      // $select_book = mysqli_query($conn, "SELECT * FROM `confirm_order`") or die('query failed');
      //   if(mysqli_num_rows($select_book) > 0){
      //     $fetch_book = mysqli_fetch_assoc($select_book);
      //     $orders_id= $fetch_book['order_id'];
      //   }

      $cart_query = mysqli_query($connection, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
          $cart_products[] = $cart_item['name'] . ' #' . $cart_item['food_title'] . ',(' . $cart_item['quantity'] . ') ';
          $quantity = $cart_item['quantity'];
          $unit_price = $cart_item['price'];
          $cart_food = $cart_item['name'];
          $food_quantity = $cart_item['food_title'];
          $sub_total = ($cart_item['price'] * $cart_item['quantity']);
          $cart_total += $sub_total;

          mysqli_query($connection, "INSERT INTO `orders`(user_id, id, address, city, state, country, pincode,book,quantity,unit_price,sub_total)
           VALUES('$user_id','$conn_oid','$address','$city','$state','$country','$pincode','$cart_food','$quantity','$unit_price','$sub_total')") or die('query failed');
        }
      }

      $message[] = 'order placed successfully!';
      mysqli_query($connection, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    }
  }
}

?>
?>


<?php include "include/navbar.php" ?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
  <div class="row px-xl-5">
    <div class="col-12">
      <nav class="breadcrumb bg-light mb-30">
        <a class="breadcrumb-item text-dark" href="index.php">Home</a>
        <a class="breadcrumb-item text-dark" href="#">Shop</a>
        <span class="breadcrumb-item active">Checkout</span>
      </nav>
      <?php
      if (isset($message)) {
        foreach ($message as $message) {
          echo '
        <div class="message mr-2" id= "messages"><h4  class="text-center" >' . $message . '</h4>
        </div>
        ';
        }
      }
      ?>
    </div>
  </div>
</div>
<!-- Breadcrumb End -->


<!-- Checkout Start -->
<div class="container-fluid">
  <div class="row px-xl-5">
    <div class="col-lg-8">
      <form action="" method="post">
        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
        <div class="bg-light p-30 mb-5">
          <div class="row">
            <div class="col-md-6 form-group">
              <label>Full Name</label>
              <input class="form-control" type="text" name="firstname" placeholder="John">
            </div>
            <!-- <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Doe">
                        </div> -->
            <div class="col-md-6 form-group">
              <label>E-mail</label>
              <input class="form-control" type="text" name="email" placeholder="example@email.com">
            </div>
            <div class="col-md-6 form-group">
              <label>Mobile No</label>
              <input class="form-control" type="text" name="number" placeholder="+123 456 789">
            </div>
            <div class="col-md-6 form-group">
              <label>Address Line 1</label>
              <input class="form-control" type="text" name="address" placeholder="123 Street">
            </div>
            <!-- <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div> -->
            <!-- <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="custom-select">
                                <option selected>United States</option>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                            </select>
                        </div> -->
            <div class="col-md-6 form-group">
              <label>Country</label>
              <input class="form-control" type="text" name="country" placeholder="pakistan">
            </div>
            <div class="col-md-6 form-group">
              <label>City</label>
              <input class="form-control" type="text" name="city" placeholder="Karachi">
            </div>
            <div class="col-md-6 form-group">
              <label>State</label>
              <input class="form-control" type="text" name="state" placeholder="sindh">
            </div>
            <div class="col-md-6 form-group">
              <label>ZIP Code</label>
              <input class="form-control" type="text" name="pincode" placeholder="123">
            </div>

          </div>
        </div>

    </div>
    <div class="col-lg-4">
      <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
      <div class="bg-light p-30 mb-5">
        <div class="border-bottom">
          <h6 class="mb-3">Products</h6>
          <?php
          $grand_total = 0;
          $select_cart = mysqli_query($connection, "SELECT * FROM `cart`") or die('query failed');
          if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
              $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
              $grand_total += $total_price;
          ?>
              <div class="d-flex justify-content-between">
                <a class=" text-decoration-none" href="detail.php?details=<?php echo $fetch_cart['food_id']; ?>"><?php echo $fetch_cart['name']; ?></a>
                <p><?php echo 'Rs ' . $fetch_cart['price'] . '/-' . ' x ' . $fetch_cart['quantity']; ?></p>
              </div>

          <?php
            }
          } else {
            echo '<p class="empty">your cart is empty</p>';
          }
          ?>

        </div>
        <div class="border-bottom pt-3 pb-2">
          <div class="d-flex justify-content-between mb-3">
            <h6>Subtotal</h6>
            <h6>Rs <b><?php echo $grand_total; ?>/-</h6>
          </div>
          <div class="d-flex justify-content-between">
            <h6 class="font-weight-medium">Delivery</h6>
            <h6 class="font-weight-medium">Rs 100/-</h6>
          </div>
        </div>
        <div class="pt-2">
          <div class="d-flex justify-content-between mt-2">
            <h5>Total</h5>
            <h5>
              Rs <b><?php
                    $devlivery = "100";
                    $comformtotal = $grand_total + $devlivery;
                    echo $comformtotal; ?>/-
            </h5>
          </div>
        </div>
      </div>
      <div class="mb-5">
        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
        <div class="bg-light p-30">
          <div class="form-group">
            <!-- <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="method" id="paypal" value="Cash On Delivery">
                                <label class="custom-control-label" for="Cash_On_Delivery">Cash On Delivery</label>
                            </div> -->
            <div class="col-md-12 form-group">

              <select name="method" class="custom-select">
                <option value="cash on delivery" selected>Cash on delivery</option>

              </select>
            </div>
          </div>

          <button type="submit" name="checkout" class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Checkout End -->


<!-- Footer Start -->

<!-- Footer End -->