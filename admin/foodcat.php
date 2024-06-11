<?php include 'includes/header.php' ?>
<?php include 'includes/navbar.php' ?>

<?php
if (isset($_POST['addcat'])) {
	$category_food = $_POST['foodcategory'];
	if ($category_food == "" || empty($category_food)) {
		echo 'This field is required';
	} else {
		$selectQuery = "SELECT * FROM food_sub_cat WHERE sub_cat_name = '{$category_food}'";
		$runQuery = mysqli_query($connection, $selectQuery);
		$result = mysqli_num_rows($runQuery);
		if ($result > 0) {
			echo "This food category already exists";
		} else {
			$insertQuery = "INSERT into food_sub_cat (sub_cat_name) VALUE ('{$category_food}') ";
			$query = mysqli_query($connection, $insertQuery);
			if ($query) {
				echo 'Category Add';
				// header("Location: foodcat.php");
			} else {
				echo 'Category not add';
			}
		}
	}
}

?>



<div class="app-wrapper">

	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">

			<h1 class="app-page-title">Category Page</h1>
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



				<div id="login-form-wrap">
					<h2>Add Item Category</h2>
					<form id="login-form" method="post">
						<p>
							<input type="text" id="username" class="form-control search-docs" name="foodcategory" placeholder="add food category" required><i class="validation"><span></span><span></span></i>
						</p>

						<p>
							<button type="submit" class="btn btn-primary" name="addcat" id="login" value="Login">Add Category</button>

						</p>
					</form>

				</div>
				<div>
					<table class="table table-striped-columns">
						<thead>
							<th>Food Category Id</th>
							<th>Food Category Name</th>

						</thead>
						<tbody>
							<?php

							$query = "SELECT * FROM food_sub_cat";
							$select_all_categories_query = mysqli_query($connection, $query);
							while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
								$food_cat_id = $row['sub_cat_id'];
								$food_cat_name =  $row['sub_cat_name'];
								echo "<tr>
								<td>" . $food_cat_id . "</td>
								<td>" . $food_cat_name . "</td>
								<td><a href='foodcat.php?delete={$food_cat_id}'>
								<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
								<path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5'/>
							  </svg>
							  </a>
							  </td>
							  <td><a href='updatefoodcat.php?update={$food_cat_name}'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
							  <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
							  <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
							</svg></a></td>
							</tr>";
							}
							?>



						</tbody>
					</table>

				</div>





				<?php
				if (isset($_GET['delete'])) {
					$delete_id = $_GET['delete'];
					$deleteQuery = "DELETE FROM food_sub_cat where sub_cat_id = ('{$delete_id}')";
					$deleteSQL = mysqli_query($connection, $deleteQuery);
					if (!$deleteSQL) {
						die("QUERY FAILED" . mysqli_error($connection));
					} else {
						//  header("Location:foodcat.php");
					}
				}
				?>







			</div><!--//container-fluid-->
		</div><!--//app-content-->
		<?php include 'includes/footer.php' ?>