<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; 
?>

<body>
	<div id="global-loader">
		<div class="whirly-loader"> </div>
	</div>
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<?php include "includes/navbar.php"; ?>
		<!-- /Header -->

		<!-- Sidebar -->
		<?php include "includes/sidebar.php"; ?>
		<!-- /Sidebar -->



		<div class="page-wrapper">
			<div class="content">
				<div class="page-header">
					<div class="add-item d-flex">
						<div class="page-title">
							<h4>Product List</h4>
							<h6>Manage your products</h6>
						</div>
					</div>
					<ul class="table-top-head">
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
									src="assets/img/icons/pdf.svg" alt="img"></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
									src="assets/img/icons/excel.svg" alt="img"></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer"
									class="feather-rotate-ccw"></i></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i
									data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
									data-feather="chevron-up" class="feather-chevron-up"></i></a>
						</li>
					</ul>
					<div class="page-btn">
						<a href="add-product.php" class="btn btn-added"><i data-feather="plus-circle"
								class="me-2"></i>Add New Product</a>
					</div>
					<div class="page-btn import">
						<a href="#" class="btn btn-added color" data-bs-toggle="modal" data-bs-target="#view-notes"><i
								data-feather="download" class="me-2"></i>Import Product</a>
					</div>
				</div>

				<!-- /product list -->
				<div class="card table-list-card">
					<div class="card-body">
						<div class="table-top">
							<div class="search-set">
								<div class="search-input">
									<a href="javascript:void(0);" class="btn btn-searchset"><i data-feather="search"
											class="feather-search"></i></a>
								</div>
							</div>
							<div class="search-path">
								<a class="btn btn-filter" id="filter_search">
									<i data-feather="filter" class="filter-icon"></i>
									<span><img src="assets/img/icons/closes.svg" alt="img"></span>
								</a>
							</div>
							<div class="form-sort">
								<i data-feather="sliders" class="info-img"></i>
								<select class="select">
									<option>Sort by Date</option>
									<option>14 09 23</option>
									<option>11 09 23</option>
								</select>
							</div>
						</div>
						<!-- /Filter -->
						<div class="card mb-0" id="filter_inputs">
							<div class="card-body pb-0">
								<div class="row">
									<div class="col-lg-12 col-sm-12">
										<div class="row">
											<div class="col-lg-2 col-sm-6 col-12">
												<div class="input-blocks">
													<i data-feather="box" class="info-img"></i>
													<select class="select">
														<option>Choose Product</option>
														<option>
															Lenovo 3rd Generation</option>
														<option>Nike Jordan</option>
													</select>
												</div>
											</div>
											<div class="col-lg-2 col-sm-6 col-12">
												<div class="input-blocks">
													<i data-feather="stop-circle" class="info-img"></i>
													<select class="select">
														<option>Choose Categroy</option>
														<option>Laptop</option>
														<option>Shoe</option>
													</select>
												</div>
											</div>

											<div class="col-lg-2 col-sm-6 col-12">
												<div class="input-blocks">
													<i data-feather="git-merge" class="info-img"></i>
													<select class="select">
														<option>Choose Sub Category</option>
														<option>Computers</option>
														<option>Fruits</option>
													</select>
												</div>
											</div>

											<div class="col-lg-2 col-sm-6 col-12">
												<div class="input-blocks">
													<i data-feather="stop-circle" class="info-img"></i>
													<select class="select">
														<option>All Brand</option>
														<option>Lenovo</option>
														<option>Nike</option>
													</select>
												</div>
											</div>

											<div class="col-lg-2 col-sm-6 col-12">
												<div class="input-blocks">
													<i class="fas fa-money-bill info-img"></i>
													<select class="select">
														<option>Price</option>
														<option>$12500.00</option>
														<option>$12500.00</option>
													</select>
												</div>
											</div>
											<div class="col-lg-2 col-sm-6 col-12">
												<div class="input-blocks">
													<a class="btn btn-filters ms-auto"> <i data-feather="search"
															class="feather-search"></i> Search </a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Filter -->
						<div class="table-responsive product-list">
						<?php
// Include the config file to connect to the database

// Fetch products from the database
$sql = "SELECT p.id, p.product_name, c.category_name, u.unit_name, p.product_quantity, p.product_price, 
               p.product_quantity_alert, p.manufactured_on, p.product_image
        FROM products p
        LEFT JOIN product_category c ON p.product_category = c.id
        LEFT JOIN units u ON p.product_unit = u.id";
$result = $conn->query($sql);

?>

<table class="table datanew">
    <thead>
        <tr>
            <th class="no-sort">
                <label class="checkboxs">
                    <input type="checkbox" id="select-all">
                    <span class="checkmarks"></span>
                </label>
            </th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Unit</th>
            <th>Inventory Items Quantity</th>
            <th>Manufactured Date</th>
            <th>Quantity Alert</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if there are any products to display
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Display product details dynamically (no image now)
                echo "<tr>
                        <td>
                            <label class='checkboxs'>
                                <input type='checkbox'>
                                <span class='checkmarks'></span>
                            </label>
                        </td>
                        <td>" . htmlspecialchars($row['product_name']) . "</td>
                        <td>" . htmlspecialchars($row['category_name']) . "</td>
                        <td>" . htmlspecialchars($row['unit_name']) . "</td>
                        <td>" . htmlspecialchars($row['product_quantity']) . "</td>
                        <td>" . htmlspecialchars($row['manufactured_on']) . "</td>
                        <td>" . htmlspecialchars($row['product_quantity_alert']) . "</td>
                        <td class='action-table-data'>
                            <div class='edit-delete-action'>
                                <a class='me-2 edit-icon p-2' href='product-details.html'>
                                    <i data-feather='eye' class='feather-eye'></i>
                                </a>
                                <a class='me-2 p-2' href='edit-product.php'>
                                    <i data-feather='edit' class='feather-edit'></i>
                                </a>
                                <a class='confirm-text p-2' href='javascript:void(0);'>
                                    <i data-feather='trash-2' class='feather-trash-2'></i>
                                </a>
                            </div>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No products found.</td></tr>";
        }
        ?>
    </tbody>
</table>




						</div>
					</div>
				</div>
				<!-- /product list -->
			</div>
		</div>
	</div>
	<!-- /Main Wrapper -->








	<!-- jQuery -->
	<script src="assets/js/jquery-3.7.1.min.js"></script>

	<!-- Feather Icon JS -->
	<script src="assets/js/feather.min.js"></script>

	<!-- Slimscroll JS -->
	<script src="assets/js/jquery.slimscroll.min.js"></script>

	<!-- Datatable JS -->
	<script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/dataTables.bootstrap5.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>

	<!-- Summernote JS -->
	<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>

	<!-- Select2 JS -->
	<script src="assets/plugins/select2/js/select2.min.js"></script>

	<!-- Datetimepicker JS -->
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

	<!-- Bootstrap Tagsinput JS -->
	<script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

	<!-- Sweetalert 2 -->
	<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
	<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

	<!-- Custom JS -->

	<script src="assets/js/theme-script.js"></script>
	<script src="assets/js/script.js"></script>

	<!--<script src="assets/js/theme-settings.js"></script>-->

</body>

</html>