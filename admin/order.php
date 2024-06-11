<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php


$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
	header('location:login.php');
}


if (isset($_POST['update_order'])) {

	$order_update_id = $_POST['order_id'];
	$update_payments = $_POST['updatePayment'];
	$date = date("d.m.Y");
	mysqli_query($connection, "UPDATE confirm_order 
    SET payment_status = '$update_payments',date ='$date' 
    WHERE order_id = '$order_update_id'")
		or die('query failed');
	$message[] = 'payment status has been updated!';
}



?>
<div class="app-wrapper">

	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">

			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Orders</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
						</div><!--//row-->
					</div><!--//table-utilities-->
				</div><!--//col-auto-->
			</div>


			<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
				<a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
				<a class="flex-sm-fill text-sm-center nav-link" id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Completed</a>
				<a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Pending</a>
				<!-- <a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">	Cancelled</a> -->
			</nav>


			<div class="tab-content" id="orders-table-tab-content">
				<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					<div class="app-card app-card-orders-table shadow-sm mb-5">
						<div class="app-card-body">
							<div class="table-responsive">
								<table class="table app-table-hover mb-0 text-left">
									<thead>
										<tr>
											<th class="cell">Order ID</th>
											<th class="cell">Item Name</th>
											<th class="cell">Customer</th>
											<th class="cell">Number</th>
											<th class="cell">Address</th>
											<th class="cell">Status</th>
											<th class="cell">Total</th>
											<th class="cell"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$select_orders = mysqli_query($connection, "SELECT * FROM `confirm_order`") or die('query failed');
										if (mysqli_num_rows($select_orders) > 0) {
											while ($fetch_food = mysqli_fetch_assoc($select_orders)) {
										?>

												<tr>
													<td class="cell"><?php echo $fetch_food['order_id']; ?></td>
													<td class="cell"><span class="truncate"><?php echo wordwrap($fetch_food['total_foods'], 40, "<br>\n", TRUE); ?></span></td>
													<td class="cell"><?php echo $fetch_food['name']; ?></td>
													<td class="cell"><span><?php echo $fetch_food['number']; ?></span></td>
													<td class="cell"><span><?php echo wordwrap($fetch_food['address'], 50, "<br>\n", TRUE); ?></span></td>
													<td class="cell">
														<form action="" method="post">
															<input type="hidden" name="order_id" value="<?php echo $fetch_food['order_id']; ?>">
															<select name="updatePayment" class="form-control mb-2">
																<option value="" disabled <?php if (empty($fetch_food['payment_status'])) echo 'selected'; ?>>Select Status</option>
																<option value="pending" <?php if ($fetch_food['payment_status'] === 'pending') echo 'selected'; ?>>Pending</option>
																<option value="completed" <?php if ($fetch_food['payment_status'] === 'completed') echo 'selected'; ?>>Completed</option>
															</select>
													</td>
													<td class="cell">Rs <?php echo $fetch_food['total_price']; ?>/-</td>
													<td class="cell">
														<button type="submit" class="btn btn-success " name="update_order">Update</button>
														<a class="btn btn-danger" href="order.php?delete=<?php echo $fetch_food['order_id']; ?>" onclick="return confirm('Delete this order?');">Delete</a>
														</form>

													</td>
												</tr>

										<?php
											}
										} else {
											echo '<p class="empty">No orders placed yet!</p>';
										}
										?>
									</tbody>
								</table>
							</div>

						</div><!--//app-card-body-->
					</div><!--//app-card-->

				</div><!--//tab-pane-->

				<div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
					<div class="app-card app-card-orders-table mb-5">
						<div class="app-card-body">
							<div class="table-responsive">

								<table class="table mb-0 text-left">
									<thead>

										<tr>
											<th class="cell">Order ID</th>
											<th class="cell">Item Name</th>
											<th class="cell">Customer</th>
											<th class="cell">Number</th>
											<th class="cell">Address</th>
											<th class="cell">Status</th>
											<th class="cell">Total</th>
											<th class="cell"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$select_orders = mysqli_query($connection, "SELECT * FROM `confirm_order` WHERE payment_status = 'completed'") or die('query failed');
										if (mysqli_num_rows($select_orders) > 0) {
											while ($fetch_food = mysqli_fetch_assoc($select_orders)) {
										?>
												<tr>
													<td class="cell"><?php echo $fetch_food['order_id']; ?></td>
													<td class="cell"><span class="truncate"><?php echo wordwrap($fetch_food['total_foods'], 40, "<br>\n", TRUE); ?></span></td>
													<td class="cell"><?php echo $fetch_food['name']; ?></td>
													<td class="cell"><span><?php echo $fetch_food['number']; ?></span></td>
													<td class="cell"><span><?php echo wordwrap($fetch_food['address'], 50, "<br>\n", TRUE); ?></span></td>
													<td class="cell">
														<form action="" method="post">
															<input type="hidden" name="order_id" value="<?php echo $fetch_food['order_id']; ?>">
															<select name="updatePayment" class="form-control mb-2">
																<option value="" disabled <?php if (empty($fetch_food['payment_status'])) echo 'selected'; ?>>Select Status</option>
																<option value="pending" <?php if ($fetch_food['payment_status'] === 'pending') echo 'selected'; ?>>Pending</option>
																<option value="completed" <?php if ($fetch_food['payment_status'] === 'completed') echo 'selected'; ?>>Completed</option>
															</select>
													</td>
													<td class="cell">Rs <?php echo $fetch_food['total_price']; ?>/-</td>
													<td class="cell">
														<button type="submit" class="btn btn-success " name="update_order">Update</button>
														<a class="btn btn-danger" href="order.php?delete=<?php echo $fetch_food['order_id']; ?>" onclick="return confirm('Delete this order?');">Delete</a>
														</form>

													</td>
												</tr>

										<?php
											}
										} else {
											echo '<p class="empty">No orders placed yet!</p>';
										}
										?>

									</tbody>
								</table>
							</div><!--//table-responsive-->
						</div><!--//app-card-body-->
					</div><!--//app-card-->
				</div><!--//tab-pane-->

				<div class="tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
					<div class="app-card app-card-orders-table mb-5">
						<div class="app-card-body">
							<div class="table-responsive">
								<table class="table mb-0 text-left">
									<thead>
										<tr>
											<th class="cell">Order ID</th>
											<th class="cell">Item Name</th>
											<th class="cell">Customer</th>
											<th class="cell">Number</th>
											<th class="cell">Address</th>
											<th class="cell">Status</th>
											<th class="cell">Total</th>
											<th class="cell"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$select_orders = mysqli_query($connection, "SELECT * FROM `confirm_order` WHERE payment_status = 'pending'") or die('query failed');
										if (mysqli_num_rows($select_orders) > 0) {
											while ($fetch_food = mysqli_fetch_assoc($select_orders)) {
										?>
												<tr>
													<td class="cell"><?php echo $fetch_food['order_id']; ?></td>
													<td class="cell"><span class="truncate"><?php echo wordwrap($fetch_food['total_foods'], 40, "<br>\n", TRUE); ?></span></td>
													<td class="cell"><?php echo $fetch_food['name']; ?></td>
													<td class="cell"><span><?php echo $fetch_food['number']; ?></span></td>
													<td class="cell"><span><?php echo wordwrap($fetch_food['address'], 50, "<br>\n", TRUE); ?></span></td>
													<td class="cell">
														<form action="" method="post">
															<input type="hidden" name="order_id" value="<?php echo $fetch_food['order_id']; ?>">
															<select name="updatePayment" class="form-control mb-2">
																<option value="" disabled <?php if (empty($fetch_food['payment_status'])) echo 'selected'; ?>>Select Status</option>
																<option value="pending" <?php if ($fetch_food['payment_status'] === 'pending') echo 'selected'; ?>>Pending</option>
																<option value="completed" <?php if ($fetch_food['payment_status'] === 'completed') echo 'selected'; ?>>Completed</option>
															</select>
													</td>
													<td class="cell">Rs <?php echo $fetch_food['total_price']; ?>/-</td>
													<td class="cell">
														<button type="submit" class="btn btn-success " name="update_order">Update</button>
														<a class="btn btn-danger" href="order.php?delete=<?php echo $fetch_food['order_id']; ?>" onclick="return confirm('Delete this order?');">Delete</a>
														</form>

													</td>
												</tr>

										<?php
											}
										} else {
											echo '<p class="empty">No orders remain yet!</p>';
										}
										?>
									</tbody>
								</table>
							</div><!--//table-responsive-->
						</div><!--//app-card-body-->
					</div><!--//app-card-->
				</div><!--//tab-pane-->
				<div class="tab-pane fade" id="orders-cancelled" role="tabpanel" aria-labelledby="orders-cancelled-tab">
					<div class="app-card app-card-orders-table mb-5">
						<div class="app-card-body">
							<div class="table-responsive">
								<table class="table mb-0 text-left">
									<thead>
										<tr>
											<th class="cell">Order ID</th>
											<th class="cell">Item Name</th>
											<th class="cell">Customer</th>
											<th class="cell">Number</th>
											<th class="cell">Status</th>
											<th class="cell">Total</th>
											<th class="cell"></th>
										</tr>
									</thead>
									<tbody>

										<tr>
											<td class="cell">#15342</td>
											<td class="cell"><span class="truncate">Justo feugiat neque</span></td>
											<td class="cell">Reina Brooks</td>
											<td class="cell"><span class="cell-data">12 Oct</span><span class="note">04:23 PM</span></td>
											<td class="cell"><span class="badge bg-danger">Cancelled</span></td>
											<td class="cell">$59.00</td>
											<td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
										</tr>

									</tbody>
								</table>
							</div><!--//table-responsive-->
						</div><!--//app-card-body-->
					</div><!--//app-card-->
				</div><!--//tab-pane-->
			</div><!--//tab-content-->


			<?php
			if (isset($_GET['delete'])) {
				$delete_id = $_GET['delete'];
				mysqli_query($connection, "DELETE FROM `confirm_order` WHERE order_id = '$delete_id'") or die('query failed');
				//    header('location:order.php');
			}
			?>

		</div><!--//container-fluid-->
	</div><!--//app-content-->

	<?php include "includes/footer.php"; ?>