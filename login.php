<?php include "include/db.php"; ?>





<?php
session_start();
if (isset($_POST['login'])) {

	$email =  mysqli_real_escape_string($connection, $_POST['email']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);


	$select_users = $connection->query("SELECT * FROM user WHERE user_email = '$email' and user_password = '$password' ") or die('query failed');

	if (mysqli_num_rows($select_users) == 1) {

		$row = mysqli_fetch_assoc($select_users);

		if ($row['user_type'] == 'Admin') {
			$_SESSION['admin_name'] = $row['user_name'];
			$_SESSION['admin_email'] = $row['user_email'];
			$_SESSION['admin_id'] = $row['user_id'];
			header('location:admin/index.php');
		} elseif ($row['user_type'] == 'User') {
			$_SESSION['user_name'] = $row['user_name'];
			$_SESSION['user_email'] = $row['user_email'];
			$_SESSION['user_id'] = $row['user_id'];
			header('location:index.php');
		}
	} else {
		$message[] = 'Incorrect Email Id or Password!';
	}
}

?>


<!doctype html>
<html lang="en">

<head>
	<title>Login 08</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="logincss/style.css">

</head>

<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<?php
				if (isset($message)) {
					foreach ($message as $message) {
						echo '
					<div style="text-align:center; padding-top:10px;" class="message" id= "messages"><span>' . $message . '</span>
					</div>
					';
					}
				}
				?>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
						<div style="background-color:orange;" class="icon d-flex align-items-center justify-content-center">
							<span class="fa fa-user-o"></span>
						</div>
						<a href="register.php">
							<h3 class="text-center mb-4">Don't have an account?</h3>
						</a>
						<form action="" class="login-form" method="post">
							<div class="form-group">
								<input type="email" name="email" class="form-control rounded-left" placeholder="Email" required>
							</div>
							<div class="form-group d-flex">
								<input type="password" name="password" class="form-control rounded-left" placeholder="Password" required>
							</div>
							<div class="form-group d-md-flex">
								<div class="w-50">
									<label class="checkbox-wrap checkbox-primary">Remember Me
										<input type="checkbox" checked>
										<span class="checkmark"></span>
									</label>
								</div>

							</div>
							<div class="form-group">
								<button style="background-color:#0096FF;" type="submit" name="login" class=" btn-primary rounded submit  p-2 px-5 ">Login</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>