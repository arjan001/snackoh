<!DOCTYPE html>
<html lang="en">
<?php 
include_once "./includes/session_check.php"

?>	
<?php include "includes/header.php";?>

<?php include "includes/header.php";?>
	<body>
		
		<div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div>
	
		 
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
					<div class="page-header justify-content-between">
						<div class="page-title">
							<h4>Tax Reports</h4>
							<h6>Manage your Tax Reports</h6>
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
					

					<!-- /product list -->
					<div class="card table-list-card">
						<div class="card-body">
							<div class="tabs-set">
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									<li class="nav-item" role="presentation">
									  <button class="nav-link active" id="purchase-tab" data-bs-toggle="tab" data-bs-target="#purchase2" type="button" role="tab" aria-controls="purchase2" aria-selected="true">Purchase Tax Report</button>
									</li>
									<li class="nav-item" role="presentation">
									  <button class="nav-link" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales2" type="button" role="tab" aria-controls="sales2" aria-selected="false">Sales Tax Report</button>
									</li>
								</ul>
								  <div class="tab-content" id="myTabContent">
									<div class="tab-pane fade show active" id="purchase2" role="tabpanel" aria-labelledby="purchase-tab">
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
											<table class="table datanew">
												<thead>
													<tr>
														<th>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</th>
														<th>Supplier</th>
														<th>Date</th>
														<th>Ref No</th>
														<th>Total Amount</th>
														<th>Payment Method</th>
														<th>Discount</th>
														<th>Tax Amount</th>
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
														<td>Kabete Diaries</td>
														<td>12 Jan 2025</td>
														<td class="ref-number">#4237300</td>
														<td>KSH 30,000</td>
														<td class="payment-info">
															<a href="javascript:void(0);"> <img src="assets/img/icons/pay.svg" alt="Pay"> </a>
														</td>
														<td>10</td>
														<td>KSH 457</td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>wangige packers</td>
														<td>18 Feb 2025</td>
														<td class="ref-number">#5628954</td>
														<td>KSH 45,000</td>
														<td class="payment-info">
															<a href="javascript:void(0);"> <img src="assets/img/icons/stripe.svg" alt="Pay"> </a>
														</td>
														<td>12</td>
														<td>KSH 265</td>
													</tr>
													
												
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane fade" id="sales2" role="tabpanel" aria-labelledby="sales-tab">
										<div class="table-top">
											<div class="search-set">
												<div class="search-input">
													<a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
												</div>
											</div>
											<div class="search-path">
												<a class="btn btn-filter" id="filter_search2">
													<i data-feather="filter" class="filter-icon"></i>
													<span><img src="assets/img/icons/closes.svg" alt="img"></span>
												</a>
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
											<table class="table datanew">
												<thead>
													<tr>
														<th>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</th>
														<th>Customer</th>
														<th>Date</th>
														<th>Invoice Number</th>
														<th>Total Amount</th>
														<th>Payment Method</th>
														<th>Discount</th>
														<th>Tax Amount</th>
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
														<td class="userimgname">
															<a href="javascript:void(0);" class="product-img">
																<img src="assets/img/users/user-01.jpg" alt="product">
															</a>
															<a href="javascript:void(0);">edwin Daniel</a>
														</td>
														<td>12 Jul 2024</td>
														<td class="ref-number">INV4237300</td>
														<td>KSH 30,000</td>
														<td class="payment-info">
															<a href="javascript:void(0);"> <img src="assets/img/icons/pay.svg" alt="Pay"> </a>
														</td>
														<td>10</td>
														<td>KSH 457</td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td class="userimgname">
															<a href="javascript:void(0);" class="product-img">
																<img src="assets/img/users/user-02.jpg" alt="product">
															</a>
															<a href="javascript:void(0);">mark mutua</a>
														</td>
														<td>04 Aug 2024</td>
														<td class="ref-number">INV5385083</td>
														<td>KSH 27,000</td>
														<td class="payment-info">
															<a href="javascript:void(0);"> <img src="assets/img/icons/stripe.svg" alt="Pay"> </a>
														</td>
														<td>08</td>
														<td>KSH 382</td>
													</tr>
													
												</tbody>
											</table>
										</div>
									</div>
								</div>	
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

		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

		<!-- Daterangepikcer JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>

		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>

		<!-- Sweetalert 2 -->
		<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
		<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

		<!-- Custom JS --><script src="assets/js/theme-script.js"></script>	
		<script src="assets/js/script.js"></script>

	
    </body>
</html>