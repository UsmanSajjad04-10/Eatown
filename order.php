<?php include "include/header.php" ?>
<?php include "include/navbar.php" ?>

<style>
  .placed-orders .title {
    text-align: center;
    margin-bottom: 20px;
    text-transform: uppercase;
    color: black;
    font-size: 40px;
  }

  .placed-orders .box-container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 20px;
  }

  .placed-orders .box-container .empty {
    flex: 1;
  }

  .placed-orders .box-container .box {
    flex: 1 1 400px;
    border-radius: .5rem;
    padding: 15px;
    border: 2px solid brown;
    background-color: white;
    padding: 10px 20px;
  }

  .placed-orders .box-container .box p {
    padding: 10px 0 0 0;
    font-size: 20px;
    color: gray;
  }

  .placed-orders .box-container .box p span {
    color: black;
  }
</style>


<section class="placed-orders">

  <h1 class="title">placed orders</h1>

  <div class="box-container">

    <?php
    $select_food = mysqli_query($connection, "SELECT * FROM `confirm_order`WHERE user_id = '$user_id' ORDER BY order_date DESC") or die('query failed');
    if (mysqli_num_rows($select_food) > 0) {
      while ($fetch_food = mysqli_fetch_assoc($select_food)) {
    ?>
        <div class="box">
          <p> Order Date : <span><?php echo $fetch_food['order_date']; ?></span> </p>
          <p> Order Id : <span># <?php echo $fetch_food['order_id']; ?> </p>
          <p> Name : <span><?php echo $fetch_food['name']; ?></span> </p>
          <p> Mobile Number : <span><?php echo $fetch_food['number']; ?></span> </p>
          <p> Email Id : <span><?php echo $fetch_food['email']; ?></span> </p>
          <p> Address : <span><?php echo $fetch_food['address']; ?></span> </p>
          <p> Payment Method : <span><?php echo $food['payment_method']; ?></span> </p>
          <p> Your orders : <span><?php echo $fetch_food['total_foods']; ?></span> </p>
          <p> Total price : <span>Rs <?php echo $fetch_food['total_price']; ?>/-</span> </p>
          <p> Payment status : <span style="color:<?php if ($fetch_food['payment_status'] == 'pending') {
                                                    echo 'orange';
                                                  } else {
                                                    echo 'green';
                                                  } ?>;"><?php echo $fetch_food['payment_status']; ?></span> </p>
          <p><a href="invoice.php?order_id=<?php echo $fetch_food['order_id']; ?>" target="_blank">Print Recipt</a></p>
        </div>
        <!-- <form action="" method="POST">
         <input type="hidden" name="order_id" value="<?php echo $fetch_book['order_id']; ?>">
         </form> -->
    <?php
      }
    } else {
      echo '<p class="empty">You have not placed any order yet!!!!</p>';
    }
    ?>
  </div>

</section>





<?php include "include/footer.php" ?>