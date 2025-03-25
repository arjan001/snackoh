<!DOCTYPE html>
<html lang="en">
<?php  include_once "./includes/session_check.php" ;?>
<?php include "includes/header.php";?>

<body>

	<div id="global-loader">
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
				<div class="page-header transfer">
					<div class="add-item d-flex">
						<div class="page-title">
							<h4>Purchase List</h4>
							<h6>Manage your purchases</h6>
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
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
									src="assets/img/icons/printer.svg" alt="img"></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i
									data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
						</li>		
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
						</li>
					</ul>
					<div class="d-flex purchase-pg-btn">
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i
									data-feather="plus-circle" class="me-2"></i>Add New Purchase</a>
						</div>
						
					</div>
					
				</div>

				<!-- /product list -->
				<div class="card table-list-card">
					<div class="card-body">
						<div class="table-top">
							<div class="search-set">
								<div class="search-input">
									<a href="" class="btn btn-searchset"><i data-feather="search"
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
									<option>Newest</option>
									<option>Oldest</option>
								</select>
							</div>
						</div>
						<!-- /Filter -->

						<!-- /Filter -->
						<div class="table-responsive product-list">
							<table class="table  datanew list">
								<thead>
									<tr>
										<th class="no-sort">
											<label class="checkboxs">
												<input type="checkbox" id="select-all">
												<span class="checkmarks"></span>
											</label>
										</th>
										<th>Supplier Name</th>
										<th>Reference</th>
										<th>Date</th>
										<th>Status</th>
										<th>Grand Total</th>
										<th>Paid</th>
										<th>Due</th>
										<th>Created by</th>
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
										<td>Pembe Floor mills</td>
										<td>PT001 </td>
										<td>19 Jan 2023</td>
										<td><span class="badges status-badge">Received</span></td>
										<td>ksh550</td>
										<td>ksh550</td>
										<td>ksh0.00</td>
										<td><span class="badge-linesuccess">edwin</span></td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												
												<a class="me-2 p-2" data-bs-toggle="modal" data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
												<a class="confirm-text p-2" href="javascript:void(0);">
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
				<!-- /product list -->
			</div>
		</div>
	</div>
	<!-- /Main Wrapper -->

	<!-- Add Purchase -->
	 <div class="modal fade" id="add-units">
		<div class="modal-dialog purchase modal-dialog-centered stock-adjust-modal">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Edit Purchase</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form action="purchase-list.html">							
								<div>
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Supplier Name</label>
												<div class="row">
													<div class="col-lg-10 col-sm-10 col-10">
														<select class="select">
															<option>Dazzle Shoes</option>
															<option>Apex Computers</option>
															<option>Beats Headphones</option>
														</select>
													</div>
													<div class="col-lg-2 col-sm-2 col-2 ps-0">
														<div class="add-icon tab">
															<a href="javascript:void(0);"><i data-feather="plus-circle" class="feather-plus-circles"></i></a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Purchase Date </label>
												<div class="input-groupicon">
													<input type="text" placeholder="19 Jan 2023" class="datetimepicker">
													<div class="addonset">
														<img src="assets/img/icons/calendars.svg" alt="img">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Product Name</label>
												<select class="select">
													<option>Nike Jordan</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Reference No.</label>
												<input type="text" value="010203">
											</div>
										</div>
										<div class="col-lg-12 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Product</label>
												<div class="input-groupicon">
													<input type="text"
														placeholder="Scan/Search Product by code and select">
													<div class="addonset">
														<img src="assets/img/icons/scanners.svg" alt="img">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
										<div class="modal-body-table">
											<div class="table-responsive">
												<table class="table">
													<thead>
														<tr>
															<th>Product Name</th>
															<th>QTY</th>
															<th>Purchase Price(ksh) </th>
															<th>Discount(ksh) </th>
															<th>Tax %</th>
															<th>Tax Amount(ksh)</th>
															<th class="text-end">Unit Cost(ksh)</th>
															<th class="text-end">Total Cost (ksh) </th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<div class="productimgname">
																	<a href="javascript:void(0);" class="product-img stock-img">
																		<img src="assets/img/products/stock-img-02.png" alt="product">
																	</a>
																	<a href="javascript:void(0);">Nike Jordan</a>
																</div>
															</td>
															<td><div class="product-quantity">
																<span class="quantity-btn">+<i data-feather="plus-circle" class="plus-circle"></i></span>
																<input type="text" class="quntity-input" value="10">
																<span class="quantity-btn"><i data-feather="minus-circle" class="feather-search"></i></span>
															</div></td>
															<td>2000</td>
															<td>500.00</td>
															<td>0.00</td>
															<td>0.00</td>
															<td>0.00</td>
															<td>1500</td>
															<td>
																<a class="delete-set"><img
																		src="assets/img/icons/delete.svg" alt="svg"></a>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 float-md-right">
											<div class="total-order">
												<ul>
													<li>
														<h4>Order Tax</h4>
														<h5>ksh 0.00</h5>
													</li>
													<li>
														<h4>Discount</h4>
														<h5>ksh 0.00</h5>
													</li>
													<li>
														<h4>Shipping</h4>
														<h5>ksh 0.00</h5>
													</li>
													<li class="total">
														<h4>Grand Total</h4>
														<h5>ksh1500.00</h5>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Order Tax</label>
												<input type="text" value="0">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Discount</label>
												<input type="text" value="0">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Shipping</label>
												<input type="text" value="0">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Status</label>
												<select class="select">
													<option>Sent</option>
													<option>Ordered</option>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="col-lg-12">
									<div class="input-blocks summer-description-box">
										<label>Description</label>
										<div id="summernote2">
											<p>These shoes are made with the highest quality materials. </p>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Save Changes</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Add Purchase -->

	<!-- Edit Purchase -->
	<div class="modal fade" id="edit-units">
		<div class="modal-dialog purchase modal-dialog-centered stock-adjust-modal">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Add Purchase</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form action="purchase-list.html">							
								<div>
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Supplier Name</label>
												<div class="row">
													<div class="col-lg-10 col-sm-10 col-10">
														<select class="select">
															<option>Dazzle Shoes</option>
															<option>Apex Computers</option>
															<option>Beats Headphones</option>
														</select>
													</div>
													<div class="col-lg-2 col-sm-2 col-2 ps-0">
														<div class="add-icon tab">
															<a href="javascript:void(0);"><i data-feather="plus-circle" class="feather-plus-circles"></i></a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Purchase Date </label>
												<div class="input-groupicon">
													<input type="text" placeholder="19 Jan 2023" class="datetimepicker">
													<div class="addonset">
														<img src="assets/img/icons/calendars.svg" alt="img">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Product Name</label>
												<select class="select">
													<option>Nike Jordan</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Reference No.</label>
												<input type="text" value="010203">
											</div>
										</div>
										<div class="col-lg-12 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Product</label>
												<div class="input-groupicon">
													<input type="text"
														placeholder="Scan/Search Product by code and select">
													<div class="addonset">
														<img src="assets/img/icons/scanners.svg" alt="img">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
										<div class="modal-body-table">
											<div class="table-responsive">
												<table class="table">
													<thead>
														<tr>
															<th>Product Name</th>
															<th>QTY</th>
															<th>Purchase Price(ksh) </th>
															<th>Discount(ksh) </th>
															<th>Tax %</th>
															<th>Tax Amount(ksh)</th>
															<th class="text-end">Unit Cost(ksh)</th>
															<th class="text-end">Total Cost (ksh) </th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<div class="productimgname">
																	<a href="javascript:void(0);" class="product-img stock-img">
																		<img src="assets/img/products/stock-img-02.png" alt="product">
																	</a>
																	<a href="javascript:void(0);">baking Floor (KG)</a>
																</div>
															</td>
															<td><div class="product-quantity">
																<span class="quantity-btn">+<i data-feather="plus-circle" class="plus-circle"></i></span>
																<input type="text" class="quntity-input" value="10">
																<span class="quantity-btn"><i data-feather="minus-circle" class="feather-search"></i></span>
															</div></td>
															<td>2000</td>
															<td>500.00</td>
															<td>0.00</td>
															<td>0.00</td>
															<td>0.00</td>
															<td>1500</td>
															<td>
																<a class="delete-set"><img
																		src="assets/img/icons/delete.svg" alt="svg"></a>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 float-md-right">
											<div class="total-order">
												<ul>
													<li>
														<h4>Order Tax</h4>
														<h5>ksh 0.00</h5>
													</li>
													<li>
														<h4>Discount</h4>
														<h5>ksh 0.00</h5>
													</li>
													<li>
														<h4>Shipping</h4>
														<h5>ksh 0.00</h5>
													</li>
													<li class="total">
														<h4>Grand Total</h4>
														<h5>ksh1500.00</h5>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Order Tax</label>
												<input type="text" value="0">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Discount</label>
												<input type="text" value="0">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Shipping</label>
												<input type="text" value="0">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Status</label>
												<select class="select">
													<option>Sent</option>
													<option>Ordered</option>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="col-lg-12">
									<div class="input-blocks summer-description-box">
										<label>Description</label>
										<div id="summernote2">
											<p>These shoes are made with the highest quality materials. </p>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Save Changes</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Edit Purchase -->


 


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