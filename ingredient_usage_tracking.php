<!DOCTYPE html>
<html lang="en">
<?php 
include_once "./includes/session_check.php"
?>	
<?php include "includes/header.php";?>

    <body>
		
		<!-- <div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div> -->
	
		 
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			
			<!-- Header -->
			<?php include "includes/navbar.php";?>
			<!-- /Header -->
			
			<!-- Sidebar -->
			<?php include "includes/sidebar.php";?>
			<!-- /Sidebar -->

			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>Ingredient Usage Tracking</h4>
								<h6>Bill of Materials (BOM) Consumption History</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
					</div>
					
					<div class="card table-list-card">
						<div class="card-body">
							<div class="table-top">
								<div class="search-set">
									<div class="search-input">
										<a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
									</div>
								</div>
								<div class="search-path">
									<div class="d-flex align-items-center">
										<a class="btn btn-filter" id="filter_search">
											<i data-feather="filter" class="filter-icon"></i>
											<span><img src="assets/img/icons/closes.svg" alt="img"></span>
										</a>
										<a href="" class="me-3 layout-box"><i data-feather="layout" class="feather-search"></i></a>
									</div>
								</div>
								<div class="form-sort">
									<i data-feather="sliders" class="info-img"></i>
									<select class="select">
										<option>Sort by Date</option>
										<option>Newest</option>
										<option>Oldest</option>
									</select>
								</div>
							</div>
							<!-- /Filter -->
						
							<!-- /Filter -->
							<div class="table-responsive">
								<?php
								// Include database connection
								require 'config/config.php';

								// Check if ingredient_usage table exists
								$table_check = $conn->query("SHOW TABLES LIKE 'ingredient_usage'");
								
								if ($table_check->num_rows == 0) {
									echo "<div class='alert alert-warning'>
											<h4>⚠️ Table Not Found</h4>
											<p>The <strong>ingredient_usage</strong> table doesn't exist yet. Please run the installation script first.</p>
											<a href='create_ingredient_usage_table.php' class='btn btn-primary'>Install BOM Tracking Table</a>
										  </div>";
								} else {
									$query = "
										SELECT 
											iu.id,
											iu.product_name,
											iu.ingredient_name,
											iu.quantity_consumed,
											iu.transaction_id,
											iu.usage_date,
											o.total_price as order_total,
											o.payment_type,
											o.payment_status
										FROM ingredient_usage iu
										LEFT JOIN orders o ON iu.order_id = o.id
										ORDER BY iu.usage_date DESC
									";

									$result = $conn->query($query);
									
									if ($result && $result->num_rows > 0) {
										// Show table data
										echo "<table class='table datanew'>";
										echo "<thead><tr>";
										echo "<th class='no-sort'><label class='checkboxs'><input type='checkbox' id='select-all'><span class='checkmarks'></span></label></th>";
										echo "<th>Product Name</th>";
										echo "<th>Ingredient</th>";
										echo "<th>Quantity Consumed</th>";
										echo "<th>Transaction ID</th>";
										echo "<th>Order Total</th>";
										echo "<th>Payment Type</th>";
										echo "<th>Payment Status</th>";
										echo "<th>Usage Date</th>";
										echo "</tr></thead><tbody>";
										
										while ($row = $result->fetch_assoc()) {
											echo "<tr>";
											echo "<td><label class='checkboxs'><input type='checkbox'><span class='checkmarks'></span></label></td>";
											echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
											echo "<td>" . htmlspecialchars($row['ingredient_name']) . "</td>";
											echo "<td>" . number_format($row['quantity_consumed'], 2) . "</td>";
											echo "<td>" . htmlspecialchars($row['transaction_id']) . "</td>";
											echo "<td>KSH " . number_format($row['order_total'], 2) . "</td>";
											echo "<td><span class='badge " . ($row['payment_type'] == 'cash' ? 'badge-bgsuccess' : 'badge-danger') . "'>" . htmlspecialchars(ucfirst($row['payment_type'])) . "</span></td>";
											echo "<td><span class='badge " . ($row['payment_status'] == 'completed' ? 'badge-bgsuccess' : 'badge-danger') . "'>" . htmlspecialchars(ucfirst($row['payment_status'])) . "</span></td>";
											echo "<td>" . date('Y-m-d H:i:s', strtotime($row['usage_date'])) . "</td>";
											echo "</tr>";
										}
										
										echo "</tbody></table>";
									} else {
										echo "<div class='alert alert-info'>
												<h4>📊 No Data Yet</h4>
												<p>No ingredient usage data found. This is normal if you haven't made any sales yet with the BOM system.</p>
												<p><strong>To test the BOM system:</strong></p>
												<ol>
													<li>Create recipes with ingredients</li>
													<li>Create products linked to recipes</li>
													<li>Add ingredients to stock</li>
													<li>Make sales in POS</li>
													<li>Check this page for usage tracking</li>
												</ol>
											  </div>";
									}
								}
								?>


							</div>
						</div>
					</div>
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

		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

		<!-- Theme JS -->
		<script src="assets/js/script.js"></script>

		<?php include "includes/footer.php";?>

    </body>
</html> 