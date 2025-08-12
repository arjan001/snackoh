<!DOCTYPE html>
<html lang="en">
<?php 
include_once "./includes/session_check.php"

?>	
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
					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>Supplier Report</h4>
								<h6>Manage Your Supplier Report</h6>
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
					<div class="table-tab">
						<ul class="nav nav-pills" id="pills-tab" role="tablist">
							<li class="nav-item" role="presentation">
							  <button class="nav-link active" id="purchase-report-tab" data-bs-toggle="pill" data-bs-target="#purchase-report" type="button" role="tab" aria-controls="purchase-report" aria-selected="true">Purchase</button>
							</li>
							<li class="nav-item" role="presentation">
							  <button class="nav-link" id="payment-report-tab" data-bs-toggle="pill" data-bs-target="#payment-report" type="button" role="tab" aria-controls="payment-report" aria-selected="false">Payment</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="return-report-tab" data-bs-toggle="pill" data-bs-target="#return-report" type="button" role="tab" aria-controls="return-report" aria-selected="false">Return</button>
							  </li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="purchase-report" role="tabpanel" aria-labelledby="purchase-report-tab">
								<!-- /product list -->
								<div class="card table-list-card">
									<div class="card-body">
										<div class="table-top">
											<div class="search-set">
												<div class="search-input">
													<a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
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
													<option>17 09 23</option>
													<option>19 09 23</option>
												</select>
											</div>
										</div>
										<!-- /Filter -->

										<!-- /Filter -->
										<div class="table-responsive">
											<table class="table  datanew">
												<thead>
													<tr>
														<th class="no-sort">
															<label class="checkboxs">
																<input type="checkbox" id="select-all">
																<span class="checkmarks"></span>
															</label>
														</th>
														<th>Purchase Date</th>
														<th>Product</th>
														<th>Purchase Amount</th>
														<th>Purchase Qty</th>
														<th>Paid</th>
														<th>Balance</th>
														<th>Status</th>
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
														<td>19 Jan 2023</td>
														<td>baking Powder</td>
														<td>KSH 12500</td>
														<td>50</td>
														<td>KSH 12500</td>
														<td>KSH 0.00</td>
														<td><span class="badges status-badge">Received</span></td>
													
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- /product list -->
							</div>
							<div class="tab-pane fade" id="payment-report" role="tabpanel" aria-labelledby="payment-report-tab">
								<!-- /product list -->
								<div class="card table-list-card">
									<div class="card-body">
										<div class="table-top">
											<div class="search-set">
												<div class="search-input">
													<a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
												</div>
											</div>
											<div class="search-path">
												<a class="btn btn-filter" id="filter_search1">
													<i data-feather="filter" class="filter-icon"></i>
													<span><img src="assets/img/icons/closes.svg" alt="img"></span>
												</a>
											</div>
											<div class="form-sort">
												<i data-feather="sliders" class="info-img"></i>
												<select class="select">
													<option>Sort by Date</option>
													<option>22 09 23</option>
													<option>18 09 23</option>
												</select>
											</div>
										</div>
										<!-- /Filter -->
									
										<!-- /Filter -->
										<div class="table-responsive">
											<table class="table  datanew">
												<thead>
													<tr>
														<th class="no-sort">
															<label class="checkboxs">
																<input type="checkbox" id="select-all2">
																<span class="checkmarks"></span>
															</label>
														</th>
														<th>Date</th>
														<th>Purchase</th>
														<th>Reference</th>
														<th>Supplier Name</th>
														<th>Amount</th>
														<th>Paid</th>
														<th>Paid By</th>
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
														<td>19 Jan 2023</td>
														<td>PR_0001</td>
														<td>INV/PR_0001</td>
														<td>Kabansora Millers</td>
														<td>KSH 1800</td>
														<td>KSH 1800</td>
														<td>Cash</td>
													</tr>
												
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- /product list -->
							</div>
							<div class="tab-pane fade" id="return-report" role="tabpanel" aria-labelledby="return-report-tab">
								<!-- /product list -->
								<div class="card table-list-card">
									<div class="card-body">
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
													<option>24 09 23</option>
													<option>30 09 23</option>
												</select>
											</div>
										</div>
										<!-- /Filter -->
									
										<!-- /Filter -->
										<div class="table-responsive">
											<table class="table  datanew">
												<thead>
													<tr>
														<th class="no-sort">
															<label class="checkboxs">
																<input type="checkbox" id="select-all3">
																<span class="checkmarks"></span>
															</label>
														</th>
														<th>Reference</th>
														<th>Supplier Name</th>
														<th>Amount</th>
														<th>Paid</th>
														<th>Due Amount</th>
														<th>Status</th>
														<th>Payment Status</th>
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
														<td>PR0001</td>
														<td>Pembe Floor Millers</td>
														<td>KSH 1800</td>
														<td>KSH 1800</td>
														<td>KSH 0.00</td>
														<td><span class="badges status-badge">Completed</span></td>
														<td><span class="badge-linesuccess">Paid</span></td>
													</tr>
													
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- /product list -->
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

		<!-- Daterangepikcer JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>

		<!-- Summernote JS -->
	    <script src="assets/plugins/summernote/summernote-bs4.min.js"></script>

		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>

		<!-- Sweetalert 2 -->
		<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
		<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

		<!-- Custom JS --><script src="assets/js/theme-script.js"></script>	
		<script src="assets/js/script.js"></script>

	
    </body>
</html>