<?php
include "includes/header.php";
include "includes/navbar.php";
?>



<?php
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:login.php');
}

if (isset($_POST['add_user'])) {
  $username =  $_POST['user_name'];
  $useremail =  $_POST['user_email'];
  $userpassword =  $_POST['user_password'];
  $usertype = $_POST['user_type'];


  $insertQuery = "INSERT INTO user ( `user_name`, `user_email`, `user_password`, `user_type`)
  VALUES('$username','$useremail','$userpassword','$usertype')";
  $query = mysqli_query($connection, $insertQuery);
  if ($query) {
    $message[] = 'User Add sucessfull';
    // header("Location: adduser.php");
  } else {
    $message[] =  die("Failed" . mysqli_error($connection));
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
                            <a class="btn app-btn-primary" href="viewuser.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-reverse-fill" viewBox="0 0 16 16">
                                    <path d="M0 3a2 2 0 0 1 2-2h7.08a2 2 0 0 1 1.519.698l4.843 5.651a1 1 0 0 1 0 1.302L10.6 14.3a2 2 0 0 1-1.52.7H2a2 2 0 0 1-2-2zm9.854 2.854a.5.5 0 0 0-.708-.708L7 7.293 4.854 5.146a.5.5 0 1 0-.708.708L6.293 8l-2.147 2.146a.5.5 0 0 0 .708.708L7 8.707l2.146 2.147a.5.5 0 0 0 .708-.708L7.707 8z" />
                                </svg>Go back</a>
                        </div>
                    </div><!--//row-->
                </div><!--//table-utilities-->


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
                <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
                    <div class="d-flex flex-column align-content-end">
                        <div class="app-auth-body mx-auto">
                            <h2 class="auth-heading text-center mb-4">ADD NEW USER</h2>

                            <div class="auth-form-container text-start mx-auto">
                                <form class="auth-form auth-signup-form" action="" method="post">
                                    <div class="email mb-3">
                                        <label class="sr-only" for="signup-email">Your Name</label>
                                        <input id="signup-name" name="user_name" type="text" class="form-control signup-name" placeholder="Full name" required="required">
                                    </div>
                                    <div class="email mb-3">
                                        <label class="sr-only" for="signup-email">Your Email</label>
                                        <input id="signup-email" name="user_email" type="email" class="form-control signup-email" placeholder="Email" required="required">
                                    </div>
                                    <div class="password mb-3">
                                        <label class="sr-only" for="signup-password">Password</label>
                                        <input id="signup-password" name="user_password" type="password" class="form-control signup-password" placeholder="Create a password" required="required">
                                    </div>
                                    <div class="password mb-3">
                                        <label class="sr-only" for="signup-password">User Type</label>
                                        <select name="user_type" class="form-control signup-password" id="signup-password">
                                            <option class="form-control signup-password" value="User">User</option>
                                            <option class="form-control signup-password" value="Admin">Admin</option>
                                        </select>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="add_user" class="btn app-btn-primary w-100 theme-btn mx-auto">ADD USER </button>
                                    </div>
                                </form><!--//auth-form-->

                            </div><!--//auth-form-container-->



                        </div><!--//auth-body-->

                    </div><!--//flex-column-->
                </div><!--//auth-main-col-->





            </div><!--//container-fluid-->
        </div><!--//app-content-->

        <?php include "includes/footer.php" ?>