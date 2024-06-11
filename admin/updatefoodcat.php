<?php include 'includes/header.php' ?>
<?php include 'includes/navbar.php' ?>

<?php
$food_cat_name = $_GET['update'];

if (isset($_POST['submit'])) {
    $category_title = $_POST['cat_title'];
    if ($category_title == "" || empty($category_title)) {
        echo 'This field is required';
    } else {
        $updateQuery = "Update food_sub_cat SET sub_cat_name = '{$category_title}' where sub_cat_name = '{$food_cat_name}'";
        $query = mysqli_query($connection, $updateQuery);
        if ($query) {
            // header("Location:foodcat.php");
        } else {
            $messege[] = 'Data not Updated';
        }
    }
}

?>
<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="foodcat.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-reverse-fill" viewBox="0 0 16 16">
                                    <path d="M0 3a2 2 0 0 1 2-2h7.08a2 2 0 0 1 1.519.698l4.843 5.651a1 1 0 0 1 0 1.302L10.6 14.3a2 2 0 0 1-1.52.7H2a2 2 0 0 1-2-2zm9.854 2.854a.5.5 0 0 0-.708-.708L7 7.293 4.854 5.146a.5.5 0 1 0-.708.708L6.293 8l-2.147 2.146a.5.5 0 0 0 .708.708L7 8.707l2.146 2.147a.5.5 0 0 0 .708-.708L7.707 8z" />
                                </svg>Go back</a>
                        </div>
                    </div><!--//row-->
                </div><!--//table-utilities-->
            </div>


            <div class="col-xs-6">
                <form action="" method="post">
                    <div class="mb-5">
                        <h4 for="">Update Category</h4>
                        <input type="text" name="cat_title" class="form-control" value="<?php echo $food_cat_name;  ?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" value="Update Category" class="btn btn-primary">
                    </div>
                </form>
            </div>

            <!-- Show Categories -->


        </div>



    </div><!--//container-fluid-->
</div><!--//app-content-->
<?php include 'includes/footer.php' ?>