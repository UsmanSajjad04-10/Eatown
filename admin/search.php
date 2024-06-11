<?php include "includes/header.php" ?>
<?php include "includes/navbar.php" ?>
<div class="app-wrapper">

	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Search Result</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<div class="col-auto">
								<form class="docs-search-form row gx-1 align-items-center" action="search.php" method="post">
									<div class="col-auto">
										<input type="text" id="search-docs" name="search_box" class="form-control search-docs" placeholder="Search">
									</div>
									<div class="col-auto">
										<button type="submit" name="search_btn" class="btn app-btn-secondary">Search</button>
									</div>
								</form>

							</div><!--//col-->
							<div class="col-auto">
								<a class="btn app-btn-primary" href="add_item.php">Item Category</a>
							</div>
							<div class="col-auto">
								<a class="btn app-btn-primary" href="add_item.php"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upload me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
										<path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
									</svg>Add New Item</a>
							</div>
						</div><!--//row-->
					</div><!--//table-utilities-->
				</div><!--//col-auto-->
			</div><!--//row-->

			<div class="row g-4">

				<?php
				if (isset($_POST['search_btn'])) {
					$search_box = $_POST['search_box'];

					$search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
					$select_products = mysqli_query($connection, "SELECT * FROM `food_details` WHERE food_name LIKE '%{$search_box}%' OR food_title LIKE '%{$search_box}%' OR food_category LIKE '%{$search_box}%' OR food_discription LIKE '%{$search_box}%' ");
					if (mysqli_num_rows($select_products) > 0) {
						while ($fetch_food = mysqli_fetch_assoc($select_products)) {
							$food_id =  $fetch_food['food_id'];
							$food_name  = $fetch_food['food_name'];
							$food_img = $fetch_food['food_img'];
							$food_price = $fetch_food['food_price'];
							$foodtitle = $fetch_food['food_title'];
							$foodcategory = $fetch_food['food_category'];
				?>

							<div class="col-6 col-md-4 col-xl-3 col-xxl-2">
								<div class="app-card app-card-doc shadow-sm  h-100">
									<div class="app-card-thumb-holder p-3">
										<div class="app-card-thumb">
											<img class="thumb-image" src="../foodimages/<?php echo $food_img; ?>" alt="">
										</div>
										<a class="app-card-link-mask" href="#file-link"></a>
									</div>
									<div class="app-card-body p-3 has-card-actions">

										<h4 class="app-doc-title truncate mb-0"><a href="#file-link"><?php echo $food_name; ?></a></h4>
										<div class="app-doc-meta">
											<ul class="list-unstyled mb-0">
												<li><span class="text-muted">Price: </span> <?php echo $food_price; ?>/-</li>
												<li><span class="text-muted">Quantity</span> <?php echo $foodtitle; ?></li>
												<li><span class="text-muted">Category</span> <?php echo $foodcategory; ?></li>
											</ul>
										</div>

										<div class="app-card-actions">
											<div class="dropdown">
												<div class="dropdown-toggle no-toggle-arrow" data-bs-toggle="dropdown" aria-expanded="false">
													<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
														<path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
													</svg>
												</div>
												<ul class="dropdown-menu">
													<li><a class="dropdown-item" href="#"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																<path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z" />
																<path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
															</svg>View</a></li>
													<li><a class="dropdown-item" href="#"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																<path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
															</svg>Edit</a></li>

													<?php echo '<li><hr class="dropdown-divider"></li>
											<li><a class="dropdown-item" href="food.php?delete={$foodid}"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
	  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
	</svg>Delete</a></li>'; ?>
												</ul>
											</div>
										</div>

									</div>

								</div>
							</div>
				<?php
						}
					} else {
						$message[] = '<p class="empty">Could not find "' . $search_box . '"! </p>';
					}
				};
				?>
			</div><!--//row-->

		</div><!--//container-fluid-->
	</div><!--//app-content-->
	<?php include "includes/footer.php" ?>