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
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Expired Products</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive dataview">
							<table class="table dashboard-expired-products">
								<thead>
									<tr>
										<th class="no-sort">
											<label class="checkboxs">
												<input type="checkbox" id="select-all">
												<span class="checkmarks"></span>
											</label>
										</th>
										<th>Product</th>
										<th>SKU</th>
										<th>Manufactured Date</th>
										<th>Expired Date</th>
										<th class="no-sort">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<label class="checkboxs">
												<input type="checkbox">
												<span class="checkmarks"></span>
											</label>
										</td>
										<td>
											<div class="productimgname">
												<a href="javascript:void(0);" class="product-img stock-img">
													<img src="assets/img/products/expire-product-01.png" alt="product">
												</a>
												<a href="javascript:void(0);">Red Premium Handy </a>
											</div>
										</td>
										<td><a href="javascript:void(0);">PT006</a></td>
										<td>17 Jan 2023</td>
										<td>29 Mar 2023</td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="#">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
												<a class=" confirm-text p-2" href="javascript:void(0);">
													<i data-feather="trash-2" class="feather-trash-2"></i>
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<label class="checkboxs">
												<input type="checkbox">
												<span class="checkmarks"></span>
											</label>
										</td>
										<td>
											<div class="productimgname">
												<a href="javascript:void(0);" class="product-img stock-img">
													<img src="assets/img/products/expire-product-02.png" alt="product">
												</a>
												<a href="javascript:void(0);">Iphone 14 Pro</a>
											</div>
										</td>
										<td><a href="javascript:void(0);">PT007</a></td>
										<td>22 Feb 2023</td>
										<td>04 Apr 2023</td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="#">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
												<a class="confirm-text p-2" href="javascript:void(0);">
													<i data-feather="trash-2" class="feather-trash-2"></i>
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<label class="checkboxs">
												<input type="checkbox">
												<span class="checkmarks"></span>
											</label>
										</td>
										<td>
											<div class="productimgname">
												<a href="javascript:void(0);" class="product-img stock-img">
													<img src="assets/img/products/expire-product-03.png" alt="product">
												</a>
												<a href="javascript:void(0);">Black Slim 200 </a>
											</div>
										</td>
										<td><a href="javascript:void(0);">PT008</a></td>
										<td>18 Mar 2023</td>
										<td>13 May 2023</td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="#">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
												<a class=" confirm-text p-2" href="javascript:void(0);">
													<i data-feather="trash-2" class="feather-trash-2"></i>
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<label class="checkboxs">
												<input type="checkbox">
												<span class="checkmarks"></span>
											</label>
										</td>
										<td>
											<div class="productimgname">
												<a href="javascript:void(0);" class="product-img stock-img">
													<img src="assets/img/products/expire-product-04.png" alt="product">
												</a>
												<a href="javascript:void(0);">Woodcraft Sandal</a>
											</div>
										</td>
										<td><a href="javascript:void(0);">PT009</a></td>
										<td>29 Mar 2023</td>
										<td>27 May 2023</td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="#">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
												<a class=" confirm-text p-2" href="javascript:void(0);">
													<i data-feather="trash-2" class="feather-trash-2"></i>
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<label class="checkboxs">
												<input type="checkbox">
												<span class="checkmarks"></span>
											</label>
										</td>
										<td>
											<div class="productimgname">
												<a href="javascript:void(0);" class="product-img stock-img">
													<img src="assets/img/products/stock-img-03.png" alt="product">
												</a>
												<a href="javascript:void(0);">Apple Series 5 Watch </a>
											</div>
										</td>
										<td><a href="javascript:void(0);">PT010</a></td>
										<td>24 Mar 2023</td>
										<td>26 May 2023</td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
												<a class=" confirm-text p-2" href="javascript:void(0);">
													<i data-feather="trash-2" class="feather-trash-2"></i>
												</a>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
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