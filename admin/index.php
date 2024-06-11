	<?php include "includes/header.php" ?>
	<?php include "includes/navbar.php" ?>

	<div class="app-wrapper">

		<div class="app-content pt-3 p-md-3 p-lg-4">
			<div class="container-xl">

				<h1 class="app-page-title">Overview</h1>

				<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
					<div class="inner">
						<div class="app-card-body p-3 p-lg-4">
							<h3 class="mb-3">Welcome, <?php echo $_SESSION['admin_name']; ?>!</h3>
							<div class="row gx-5 gy-3">
								<div class="col-12 col-lg-9">

									<div><?php echo $_SESSION['admin_name']; ?> how are you? I hope are you fine. <br> please check your daily recorde</div>
								</div><!--//col-->

							</div><!--//row-->
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div><!--//app-card-body-->

					</div><!--//inner-->
				</div><!--//app-card-->

				<div class="card-sec row g-4 mb-4 ">
					<div class="col-6 col-lg-3 box">
						<div class="app-card app-card-stat shadow-sm h-100">
							<div class="app-card-body p-3 p-lg-4">
								<h4 class="stats-type mb-1">order </h4>
								<div class="stats-figure"><?php echo $orders_count; ?></div>
								<div class="stats-meta text-success">
								</div>
							</div><!--//app-card-body-->
							<a class="app-card-link-mask" href="order.php"></a>
						</div><!--//app-card-->
					</div><!--//col-->

					<div class="col-6 col-lg-3">
						<div class="app-card app-card-stat shadow-sm h-100">
							<div class="app-card-body p-3 p-lg-4">
								<h4 class="stats-type mb-1">Messeges</h4>
								<div class="stats-figure"><?php echo $msgcount; ?></div>
								<div class="stats-meta text-success">
								</div>
							</div><!--//app-card-body-->
							<a class="app-card-link-mask" href="#"></a>
						</div><!--//app-card-->
					</div><!--//col-->
					<div class="col-6 col-lg-3">
						<div class="app-card app-card-stat shadow-sm h-100">
							<div class="app-card-body p-3 p-lg-4">
								<h4 class="stats-type mb-1">Total User</h4>
								<div class="stats-figure"><?php echo $usercount; ?></div>
								<div class="stats-meta">
									Custumer</div>
							</div><!--//app-card-body-->
							<a class="app-card-link-mask" href="#"></a>
						</div><!--//app-card-->
					</div><!--//col-->
					<div class="col-6 col-lg-3">
						<div class="app-card app-card-stat shadow-sm h-100">
							<div class="app-card-body p-3 p-lg-4">
								<h4 class="stats-type mb-1">Total Items</h4>
								<div class="stats-figure"><?php echo $foodcount; ?></div>
								<div class="stats-meta">Available</div>
							</div><!--//app-card-body-->
							<a class="app-card-link-mask" href="#"></a>
						</div><!--//app-card-->
					</div><!--//col-->
				</div><!--//row-->
			</div><!--//row-->

		</div><!--//container-fluid-->
	</div><!--//app-content-->
	<?php include "includes/footer.php" ?>