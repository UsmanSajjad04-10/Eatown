<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<div class="app-wrapper">

	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="position-relative mb-3">
				<div class="row g-3 justify-content-between">
					<div class="col-auto">
						<h1 class="app-page-title mb-0">Notifications</h1>
					</div>

				</div>
			</div>


			<?php



			// $admin_id = $_SESSION['admin_id'];

			if (!isset($admin_id)) {
				header('location:login.php');
			};


			if (isset($_GET['delete_msg'])) {
				$msg_id = $_GET['delete_msg'];
				mysqli_query($connection, "DELETE FROM `msg` WHERE id = '$msg_id'") or die('query failed');
				//    header('location:message.php');
			}

			?>
			<?php
			$select_user = mysqli_query($connection, "SELECT id,name,email,number,msg,date FROM msg ORDER BY `date` DESC") or die('query failed');
			if (mysqli_num_rows($select_user) > 0) {
				while ($fetch_user = mysqli_fetch_assoc($select_user)) {
			?>
					<div class="app-card app-card-notification shadow-sm mb-4">
						<div class="app-card-header px-4 py-3">
							<div class="row g-3 align-items-center">
								<div class="col-12 col-lg-auto text-center text-lg-start">
									<img class="profile-image" src="assets/images/profiles/PROFILE.png" alt="">
								</div>
								<div class="col-12 col-lg-auto text-center text-lg-start">
									<div class="notification-type mb-2"><span class="badge bg-info">Hello</span></div>
									<h4 class="notification-title mb-1"><?php echo $fetch_user['name']; ?></h4>

									<ul class="notification-meta list-inline mb-0">
										<li class="list-inline-item"><?php echo $fetch_user['date']; ?></li>
										<li class="list-inline-item">|</li>
										<li class="list-inline-item"> <b> Email:</b> <?php echo $fetch_user['email']; ?></li>
										<li class="list-inline-item"> <b> Number:</b> <?php echo $fetch_user['number']; ?></li>
										<a href="notifications.php?delete_msg=<?php echo $fetch_user['id']; ?>" onclick="return confirm('Delete this message?');" class="btn btn-danger">Delete</a>
									</ul>

								</div>
							</div>
						</div>
						<div class="app-card-body p-4">
							<div class="notification-content"><?php echo wordwrap($fetch_user['msg'], 150, "<br>\n", TRUE); ?>.</div>
						</div>
						<div class="app-card-footer px-4 py-3">

						</div>
					</div>
			<?php
				}
			} else {
				echo '<p class="empty">No messages received yet!</p>';
			}
			?>






		</div><!--//container-fluid-->
	</div><!--//app-content-->

	<?php include "includes/footer.php" ?>