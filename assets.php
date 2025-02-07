<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>

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
							<h4>Assets List</h4>
							<h6>Manage your Assets</h6>
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
						<ts href="add-product.php" class="btn btn-added" data-bs-toggle="modal"
							data-bs-target="#add-assets"><i data-feather="plus-circle" class="me-2"></i>Add New
							Assets</a>
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
							<table class="table datanew">
								<thead>
									<tr>
										<th class="no-sort">
											<label class="checkboxs">
												<input type="checkbox" id="select-all">
												<span class="checkmarks"></span>
											</label>
										</th>
										<th>Asset Name</th>
										<th>Category</th>
										<th>company code</th>
										<th>serial Number</th>
										<th>Registration-No</th>
										<th>Initial Cost</th>
										<th>Current Cost</th>
										<th>Status</th>
										<th>Next Maintainance</th>
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
										<td>Lenovo 3rd Generation </td>
										<td>PT001 </td>
										<td>Laptop</td>
										<td>Lenovo</td>
										<td>$12500.00</td>
										<td>Pc</td>
										<td>Pc</td>
										<td>100</td>
										<td>Arroon</td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 edit-icon  p-2" href="product-details.html">
													<i data-feather="eye" class="feather-eye"></i>
												</a>
												<a class="me-2 p-2" href="edit-product.html">
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
										<td>Bold V3.2</td>
										<td>PT002</td>
										<td>Electronics</td>
										<td>Bolt</td>
										<td>$1600.00</td>
										<td>Pc</td>
										<td>Pc</td>
										<td>140</td>
										<td>Kenneth</td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 edit-icon p-2" href="product-details.html">
													<i data-feather="eye" class="action-eye"></i>
												</a>
												<a class="me-2 p-2" href="edit-product.html">
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

	<!--add popup -->
	<div class="modal fade" id="add-assets">
		<div class="modal-dialog add-centered">
			<div class="modal-content">
				<div class="page-wrapper p-0 m-0">
					<div class="content p-0">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4> Add New Assets</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="card">
							<div class="card-body">
								<form action="add_assets.php" method="POST">
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="mb-3">
												<label class="form-label">Asset Name</label>
												<input type="text" class="form-control" name="unit_name" required>
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="input-blocks mb-5">
												<label>Choose Category</label>
												<select class="select">
													<option>Choose</option>
													<option>Completed</option>
													<option>Inprogress</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="mb-3">
												<label class="form-label">company code</label>
												<input type="text" class="form-control" name="unit_name" required>
											</div>
										</div>


										<div class="col-lg-6 col-sm-6 col-12">
											<div class="mb-3">
												<label class="form-label">Registration Number</label>
												<input type="text" class="form-control" name="unit_name" required>
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="mb-3">
												<label class="form-label">Initial Cost</label>
												<input type="text" class="form-control" name="unit_name" required>
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="mb-3">
												<label class="form-label">Current Cost</label>
												<input type="text" class="form-control" name="unit_name" required>
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="input-blocks mb-5">
												<label>Status</label>
												<select class="select">
													<option>Choose</option>
													<option>Completed</option>
													<option>Inprogress</option>
												</select>
											</div>
										</div>

										<div class="col-lg-6 col-sm-6 col-12">
											<div class="mb-3">
												<label class="form-label">Next Maintainance</label>
												<input type="text" class="form-control" name="unit_name" required>
											</div>
										</div>

										<div class="col-lg-6 col-sm-6 col-12">
											<div class="input-blocks mb-5">
												<label>Ownership</label>
												<select class="select">
													<option>Choose</option>
													<option>Owned</option>
													<option>Leased</option>
												</select>
											</div>
										</div>

										<div class="col-lg-6 col-sm-6 col-12">
											<div class="mb-3">
												<label class="form-label">Maintainance Cost</label>
												<input type="text" class="form-control" name="unit_name" required>
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="mb-3">
												<label class="form-label">Depreciation Factor</label>
												<input type="text" class="form-control" name="unit_name" required>
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="mb-3">
												<label class="form-label">Lifespan</label>
												<input type="text" class="form-control" name="unit_name" required>
											</div>
										</div>

									</div>

									<div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit create">Create Unit</button>
                            </div>
							</div>




							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- /add popup -->


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