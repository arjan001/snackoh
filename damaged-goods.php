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
							<h4>Damaged Products<i class="fas fa-goodreads "></i></h4>
							<h6>Manage your Damaged Goods</h6>
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
						<gedP href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-category"><i
								data-feather="plus-circle" class="me-2"></i>Report Damaged Product</a>
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
						<div class="card" id="filter_inputs">
							<div class="card-body pb-0">
								<div class="row">
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="input-blocks">
											<i data-feather="zap" class="info-img"></i>
											<select class="select">
												<option>Choose Category</option>
												<option>Laptop</option>
												<option>Electronics</option>
												<option>Shoe</option>
											</select>
										</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="input-blocks">
											<i data-feather="calendar" class="info-img"></i>
											<div class="input-groupicon">
												<input type="text" class="datetimepicker" placeholder="Choose Date">
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="input-blocks">
											<i data-feather="stop-circle" class="info-img"></i>
											<select class="select">
												<option>Choose Status</option>
												<option>Active</option>
												<option>Inactive</option>
											</select>
										</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-12 ms-auto">
										<div class="input-blocks">
											<a class="btn btn-filters ms-auto"> <i data-feather="search"
													class="feather-search"></i> Search </a>
										</div>
									</div>
								</div>
							</div>
						</div>
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
										<th>Product</th>
										<th>category</th>
										<th>Quantity</th>
										<th>Unit</th>
										<th>damaged Date</th>
										<th>Reported By</th>
										<th>Damage Type</th>
										<th>Location</th>
										<th>Resolution</th>
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
										<td>W-Bread 500gms</td>
										<td>bread</td>
										<td>10</td>
										<td>PC</td>
										<td>30 jan 2025</td>
										<td>George Macharia</td>
										<td>physical</td>
										<td>In-Transit</td>
										<td>dispose</td>

										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="#" data-bs-toggle="modal"
													data-bs-target="#edit-category">
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

	<!-- Add damaged goods -->
	<div class="modal fade" id="add-category">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Report Damaged Item</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form action="insert-damaged.php" method="POST">

								<div class="row">

									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Product Name</label>
											<input type="text" class="form-control" name="product_name">
										</div>
									</div>

									<div class="col-lg-6 col-sm-6 col-12">
										<div class="mb-3 add-product">
											<div class="add-newplus">
												<label class="form-label">Category</label>

											</div>
											<select class="select" name="product_category">
												<option>Choose</option>
												<option>Lenovo</option>
												<option>Electronics</option>
											</select>
										</div>

									</div>



								</div>

								<div class="row">
									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Quantity</label>
											<input type="text" class="form-control" name="product_name">
										</div>
									</div>

									<div class="col-lg-6 col-sm-6 col-12">
										<div class="mb-3 add-product">
											<div class="add-newplus">
												<label class="form-label">Units</label>

											</div>
											<select class="select" name="product_category">
												<option>Pieces</option>
												<option>Crate</option>

											</select>
										</div>

									</div>
								</div>

								<div class="row">

									<div class="col-lg-6 col-sm-6 col-12">
										<div class="input-blocks">
											<label>DamagedDate</label>

											<div class="input-groupicon calender-input">
												<i data-feather="calendar" class="info-img"></i>
												<input type="text" class="datetimepicker" placeholder="Choose Date"
													name="damaged_date">
											</div>
										</div>
									</div>

									<div class="col-lg-6 col-sm-6 col-12">
										<div class="input-blocks add-product">
											<label>Reported by</label>
											<input type="text" class="form-control" name="reported_by">
										</div>
									</div>

								</div>

								<div class="row">
								<div class="col-lg-6 col-sm-6 col-12">
										<div class="mb-3 add-product">
											<div class="add-newplus">
												<label class="form-label">Damage Type</label>

											</div>
											<select class="select" name="damage_type">
												<option>Physical</option>
												<option>Quality</option>
												<option>expiry</option>
												

											</select>
										</div>

									</div>

									<div class="col-lg-6 col-sm-6 col-12">
										<div class="mb-3 add-product">
											<div class="add-newplus">
												<label class="form-label">Location</label>

											</div>
											<select class="select" name="damage_type">
												<option>Inventory</option>
												<option>transit</option>
												<option>store</option>

											</select>
										</div>

									</div>
								</div>

								<div class="row">


									<div class="col-lg-12 col-sm-12 col-12">
										<div class="mb-3 add-product">
											<div class="add-newplus">
												<label class="form-label">Resolution</label>

											</div>
											<select class="select" name="damage_type">
												<option>return toInventory</option>
												<option>dispose</option>
												

											</select>
										</div>

									</div>
								</div>


							




								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Submit Report</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Add damaged goods -->

	<!-- Edit Category -->
	<div class="modal fade" id="edit-category">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Edit Damaged Item</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form action="insert-damaged.php" method="POST">

								<div class="row">

									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Product Name</label>
											<input type="text" class="form-control" name="product_name">
										</div>
									</div>

									<div class="col-lg-6 col-sm-6 col-12">
										<div class="mb-3 add-product">
											<div class="add-newplus">
												<label class="form-label">Category</label>

											</div>
											<select class="select" name="product_category">
												<option>Choose</option>
												<option>Lenovo</option>
												<option>Electronics</option>
											</select>
										</div>

									</div>



								</div>

								<div class="row">
									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Quantity</label>
											<input type="text" class="form-control" name="product_name">
										</div>
									</div>

									<div class="col-lg-6 col-sm-6 col-12">
										<div class="mb-3 add-product">
											<div class="add-newplus">
												<label class="form-label">Units</label>

											</div>
											<select class="select" name="product_category">
												<option>Pieces</option>
												<option>Crate</option>

											</select>
										</div>

									</div>
								</div>

								<div class="row">

									<div class="col-lg-6 col-sm-6 col-12">
										<div class="input-blocks">
											<label>DamagedDate</label>

											<div class="input-groupicon calender-input">
												<i data-feather="calendar" class="info-img"></i>
												<input type="text" class="datetimepicker" placeholder="Choose Date"
													name="damaged_date">
											</div>
										</div>
									</div>

									<div class="col-lg-6 col-sm-6 col-12">
										<div class="input-blocks add-product">
											<label>Reported by</label>
											<input type="text" class="form-control" name="reported_by">
										</div>
									</div>

								</div>

								<div class="row">
								<div class="col-lg-6 col-sm-6 col-12">
										<div class="mb-3 add-product">
											<div class="add-newplus">
												<label class="form-label">Damage Type</label>

											</div>
											<select class="select" name="damage_type">
												<option>Physical</option>
												<option>Quality</option>
												<option>expiry</option>
												

											</select>
										</div>

									</div>

									<div class="col-lg-6 col-sm-6 col-12">
										<div class="mb-3 add-product">
											<div class="add-newplus">
												<label class="form-label">Location</label>

											</div>
											<select class="select" name="damage_type">
												<option>Inventory</option>
												<option>transit</option>
												<option>store</option>

											</select>
										</div>

									</div>
								</div>

								<div class="row">


									<div class="col-lg-12 col-sm-12 col-12">
										<div class="mb-3 add-product">
											<div class="add-newplus">
												<label class="form-label">Resolution</label>

											</div>
											<select class="select" name="damage_type">
												<option>return toInventory</option>
												<option>dispose</option>
												

											</select>
										</div>

									</div>
								</div>


							




								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Submit Report</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Edit Category -->


	<?php include "includes/footer.php"; ?>

</body>

</html>