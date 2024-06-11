<?php include "includes/header.php" ?>
<?php
include "../include/db.php";

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:login.php');
}

if (isset($_POST['add_food'])) {
  $foodname =  $_POST['food_name'];
  $foodtitle =  $_POST['food_title'];
  $foodcategory =  $_POST['foodcategory'];
  $foodprice = $_POST['food_price'];
  $fooddesc = $_POST['food_desc'];
  $img_name = $_FILES["image"]["name"];
  $img_temp_name = $_FILES["image"]["tmp_name"];
  $img_file = "../foodimages/" . $img_name;

  move_uploaded_file($img_temp_name, $img_file);

  $insertQuery = "INSERT INTO food_details (`food_name`, `food_title`, `food_price`, `food_category`, `food_discription`, `food_img`)
  VALUES('$foodname','$foodtitle','$foodprice','$foodcategory','$fooddesc','$img_name')";
  $query = mysqli_query($connection, $insertQuery);
  if ($query) {
    $message[] = 'Add Food Sucessfully';
    header("Location: food.php");
  } else {
    $message[] =  die("Failed" . mysqli_error($connection));
  }
}


?>





<?php include "includes/navbar.php" ?>






<div class="app-wrapper">

  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
          <h1 class="app-page-title mb-0"> Add New Items</h1>
        </div>
        <div class="col-auto">
          <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

              <div class="col-auto">
                <a class="btn app-btn-primary" href="food.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-reverse-fill" viewBox="0 0 16 16">
                    <path d="M0 3a2 2 0 0 1 2-2h7.08a2 2 0 0 1 1.519.698l4.843 5.651a1 1 0 0 1 0 1.302L10.6 14.3a2 2 0 0 1-1.52.7H2a2 2 0 0 1-2-2zm9.854 2.854a.5.5 0 0 0-.708-.708L7 7.293 4.854 5.146a.5.5 0 1 0-.708.708L6.293 8l-2.147 2.146a.5.5 0 0 0 .708.708L7 8.707l2.146 2.147a.5.5 0 0 0 .708-.708L7.707 8z" />
                  </svg>Go back</a>
              </div>
            </div><!--//row-->
          </div><!--//table-utilities-->
        </div>

      </div>

      <div class="container">
        <div class="row body">
          <form action="" method="post" enctype="multipart/form-data">
            <ul>

              <li>
                <div class="mb-5">

                  <label for="first_name" class="form-label">Food name</label>
                  <input type="text" class="form-control" name="food_name" placeholder="Food Name" />

                </div>
                <div class="mb-5">
                  <label for="food_Category">Food Category</label>
                  <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="foodcategory" id="" required class="text_field">
                    <?php getAllCategories(); ?>
                  </select style="width:100%; border=radius:">
                </div>
              </li>
              <?php
              function getAllCategories()
              {
                global $connection;

                $sql = "SELECT * FROM food_sub_cat";
                $result = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                  $category_name = $row['sub_cat_name'];

                  echo "<option value='{$category_name}'>{$category_name}</option>";
                }
              }
              ?>

              <li>
                <div class="mb-5">
                  <label for="food">Quantity <span class="req">*</span></label>
                  <input type="text" class="form-control" name="food_title" placeholder="Quantity" />
                  </p>
                </div>
              </li>
              <li>
                <div class="mb-5">
                  <label for="email">Food Price <span class="req">*</span></label>
                  <input type="number" class="form-control" name="food_price" placeholder="Food Price" />
                  </p>
                </div>
              </li>
              <li>
                <div class="mb-5">
                  <input type="file" name="image" class="text_field">
                  <!-- <input type="file"> -->
                </div>
              </li>
              <li>
                <div class="divider"></div>
              </li>
              <li>
                <div class="mb-5">
                  <label for="floatingTextarea" for="comments">Food Disciption</label>
                  <textarea cols="46" class="form-control" rows="3" name="food_desc"></textarea>
                </div>
              </li>

              <div class="mb-5">
                <li>
                  <button class="btn btn-primary" name="add_food">Add Food</button>

                </li>
              </div>
            </ul>
          </form>
        </div>
      </div>




    </div><!--//container-fluid-->
  </div><!--//app-content-->
  <?php include "includes/footer.php" ?>