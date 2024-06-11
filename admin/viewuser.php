<?php include "includes/header.php" ?>
<?php include "includes/navbar.php" ?>

<?php


$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
	header('location:login.php');
}


if (isset($_POST['update_user'])) {
	$update_user = mysqli_real_escape_string($connection, $_POST['updateuser']);
	$user_update_id = mysqli_real_escape_string($connection, $_POST['user_id']);
	$date = date("d.m.Y");

	// Use prepared statement or at least sanitize inputs
	$query = "UPDATE user SET user_type = '$update_user' WHERE user_id = '$user_update_id'";
	mysqli_query($connection, $query) or die('Query failed');

	
}

if (isset($_GET['delete'])) {
	$user_id = $_GET['delete'];
	$deleteQuery = "DELETE FROM user where user_id = ('{$user_id}')";
	$deleteSQL = mysqli_query($connection, $deleteQuery);
	if (!$deleteSQL) {
		die("QUERY FAILED" . mysqli_error($connection));
	} else {
		// header('location:food.php');
		$message[] = 'Deleted user Successfully';
	}
}




?>


<div class="app-wrapper">

	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">View User</h1>
				</div>



				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<div class="col-auto">
								<form class="docs-search-form row gx-1 align-items-center" action="searchuser.php" method="post">
									<div class="col-auto">
										<input type="text" id="search-docs" name="search_user_value" class="form-control search-docs" placeholder="Search">
									</div>
									<div class="col-auto">
										<button type="submit" name="search_user" class="btn app-btn-secondary">Search</button>
									</div>
								</form>

							</div><!--//col-->
							<!-- <div class="col-auto">
								    <a class="btn app-btn-primary" href="add_item.php">Item Category</a>
							    </div> -->
							<div class="col-auto">
								<a class="btn app-btn-primary" href="adduser.php"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upload me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
										<path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
									</svg>Add New User</a>
							</div>
						</div><!--//row-->
					</div><!--//table-utilities-->
				</div><!--//col-auto-->
			</div><!--//row-->
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

			<div class="row g-4">



				<div class="tab-content" id="orders-table-tab-content">
					<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
						<div class="app-card app-card-orders-table shadow-sm mb-5">
							<div class="app-card-body">
								<div class="table-responsive">
									<table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">User ID</th>
												<th class="cell">User Name</th>
												<th class="cell">Email</th>
												<th class="cell">User type</th>
												<th class="cell">Edit</th>
												<th class="cell">Delete</th>
											</tr>
										</thead>
										<tbody>
											<?php


											$foodshow = "SELECT * FROM user ";
											$select_all_food_query = mysqli_query($connection, $foodshow);

											while ($row = mysqli_fetch_assoc($select_all_food_query)) {
												$userid = $row['user_id'];
												$username = $row['user_name'];
												$email = $row['user_email'];
												$type = $row['user_type'];

											?>

												<tr>
													<td class="cell"><?php echo $userid; ?></td>
													<td class="cell"><?php echo $username; ?></td>
													<td class="cell"><span><?php echo $email; ?></span></td>
													<form action="" method="POST">
													<td class="cell">
															<input type="hidden" name="user_id" value="<?php echo $userid; ?>">
															<select name="updateuser" class="form-control mb-2">
																<option value="" disabled <?php if (empty($row['user_type'])) echo 'selected'; ?>>User type</option>
																<option value="Admin" <?php if ($row['user_type'] === 'Admin') echo 'selected'; ?>>Admin</option>
																<option value="User" <?php if ($row['user_type'] === 'User') echo 'selected'; ?>>User</option>
															</select>
													</td>
													<td class="cell">
														<button type="submit" class="btn btn-success" name="update_user">Update</button>
													</td>
												</form>
													<td>
														<a class="btn btn-danger" href="viewuser.php?delete=<?php echo $userid; ?>" onclick="return confirm('Remove this user?');">Delete</a>
													</td>
												</tr>
											<?php
											}
											?>
										</tbody>
									</table>
								</div>

							</div><!--//app-card-body-->
						</div><!--//app-card-->


					</div><!--//tab-pane-->




				</div><!--//row-->

			</div><!--//container-fluid-->
		</div><!--//app-content-->
		<?php include "includes/footer.php" ?>