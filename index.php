<!DOCTYPE html>
<html lang="en">
<!-- header code -->
<?php include 'includes/header.php';?>
<!-- header code ends here -->
<body>
	<div id="global-loader">
		<div class="whirly-loader"> </div>
	</div>
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<?php include 'includes/navbar.php';?>
		<!-- /Header -->

		<!-- Sidebar -->
<?php include "includes/sidebar.php";?> 
		<!-- /Sidebar -->



		<div class="page-wrapper">
			<div class="content">

				<!-- dashboard cards -->
				
				<?php include 'includes/dashboardCards.php';?>
				<!-- dashboard cards end here -->
				<!-- Button trigger modal -->

				<div class="row">
					<div class="col-xl-7 col-sm-12 col-12 d-flex">
						<div class="card flex-fill">
							<div class="card-header d-flex justify-content-between align-items-center">
								<h5 class="card-title mb-0">Purchase & Sales</h5>
								<div class="graph-sets">
									<ul class="mb-0">
										<li>
											<span>Sales</span>
										</li>
										<li>
											<span>Purchase</span>
										</li>
									</ul>
									<div class="dropdown dropdown-wraper">
										<button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
											2023
										</button>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<li>
												<a href="javascript:void(0);" class="dropdown-item">2023</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="dropdown-item">2022</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="dropdown-item">2021</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div id="sales_charts"></div>
							</div>
						</div>
					</div>
					<div class="col-xl-5 col-sm-12 col-12 d-flex">
						<div class="card flex-fill default-cover mb-4">
							<div class="card-header d-flex justify-content-between align-items-center">
								<h4 class="card-title mb-0">Recent Products</h4>
								<div class="view-all-link">
									<a href="javascript:void(0);" class="view-all d-flex align-items-center">
										View All<span class="ps-2 d-flex align-items-center"><i data-feather="arrow-right" class="feather-16"></i></span>
									</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive dataview">
									<table class="table dashboard-recent-products">
										<thead>
											<tr>
												<th>#</th>
												<th>Products</th>
												<th>Price</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td class="productimgname">
													<a href="product-list.html" class="product-img">
														<img src="assets/img/products/stock-img-01.png" alt="product">
													</a>
													<a href="product-list.html">Lenevo 3rd Generation</a>
												</td>
												<td>$12500</td>
											</tr>
											<tr>
												<td>2</td>
												<td class="productimgname">
													<a href="product-list.html" class="product-img">
														<img src="assets/img/products/stock-img-06.png" alt="product">
													</a>
													<a href="product-list.html">Bold V3.2</a>
												</td>
												<td>$1600</td>
											</tr>
											<tr>
												<td>3</td>
												<td class="productimgname">
													<a href="product-list.html" class="product-img">
														<img src="assets/img/products/stock-img-02.png" alt="product">
													</a>
													<a href="product-list.html">Nike Jordan</a>
												</td>
												<td>$2000</td>
											</tr>
											<tr>
												<td>4</td>
												<td class="productimgname">
													<a href="product-list.html" class="product-img">
														<img src="assets/img/products/stock-img-03.png" alt="product">
													</a>
													<a href="product-list.html">Apple Series 5 Watch</a>
												</td>
												<td>$800</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- expired products was here -->


			</div>
		</div>

		<!-- <div class="customizer-links" id="setdata">
			<ul class="sticky-sidebar">
				<li class="sidebar-icons">
					<a href="#" class="navigation-add" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="Theme">
						<i data-feather="settings" class="feather-five"></i>
					</a>
				</li>
			</ul>
		</div> -->

	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script src="assets/js/jquery-3.7.1.min.js"></script>

	<!-- Feather Icon JS -->
	<script src="assets/js/feather.min.js"></script>

	<!-- Slimscroll JS -->
	<script src="assets/js/jquery.slimscroll.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>

	<!-- Chart JS -->
	<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
	<script src="assets/plugins/apexchart/chart-data.js"></script>

	<!-- Sweetalert 2 -->
	<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
	<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/theme-script.js"></script>	
		<script src="assets/js/script.js"></script>

	
</body>

</html>