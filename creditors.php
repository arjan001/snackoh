<!DOCTYPE html>
<html lang="en">
<?php include_once "./includes/session_check.php"; ?>
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
								<h4>Creditors List</h4>
								<h6>Manage Your Creditors</h6>
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
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#trigger"><i data-feather="plus-circle" class="me-2"></i>Add trigger</a>
						</div>
					</div>

					<div class="table-tab">
					<ul class="nav nav-pills" id="pills-tab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="creditor-tab" data-bs-toggle="pill"
								data-bs-target="#creditors" type="button" role="tab" aria-controls="creditors"
								aria-selected="true">Creditor List</button>
						</li>


						<li class="nav-item" role="presentation">
							<button class="nav-link" id="classification-tab" data-bs-toggle="pill"
								data-bs-target="#classification" type="button" role="tab" aria-controls="classification"
								aria-selected="false">Classification</button>
						</li>


						<li class="nav-item" role="presentation">
							<button class="nav-link" id="paymentTrigger-tab" data-bs-toggle="pill"
								data-bs-target="#paymentTrigger" type="button" role="tab" aria-controls="paymentTrigger"
								aria-selected="false">Payment Triggers</button>
						</li>

						<li class="nav-item" role="presentation">
							<button class="nav-link" id="CreditorCommunication-tab" data-bs-toggle="pill"
								data-bs-target="#CreditorCommunication" type="button" role="tab"
								aria-controls="CreditorCommunication" aria-selected="false">Creditor Communication</button>
						</li>

					</ul>
					</div>
					<!-- /creditor list -->
					<div class="tab-pane fade show active" id="creditors" role="tabpanel"
					aria-labelledby="creditor-tab">
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
									</div>
								</div>
								<div class="form-sort">
									<i data-feather="sliders" class="info-img"></i>
									<select class="select">
										<option>Sort by Date</option>
										<option>25 9 23</option>
										<option>12 9 23</option>
									</select>
								</div>
							</div>
							<!-- /Filter -->
							<div class="card" id="filter_inputs">
								<div class="card-body pb-0">
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="user" class="info-img"></i>
												<select class="select">
													<option>Choose creditor Name</option>
													<option>Dazzle Shoes</option>
													<option>A-Z Store</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="globe" class="info-img"></i>
												<select class="select">
													<option>Choose Country</option>
													<option>Mexico</option>
													<option>Italy</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="input-blocks">
												<a class="btn btn-filters ms-auto"> <i data-feather="search" class="feather-search"></i> Search </a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Filter -->
							<div class="table-responsive">
								<table class="table datanew">
									<thead>
										<tr>
											<th class="no-sort">
												<label class="checkboxs">
													<input type="checkbox" id="select-all">
													<span class="checkmarks"></span>
												</label>
											</th>
											<th>Creditor Name</th>
											<th>Refference ID</th>
											<th>phone</th>
											<th>Debt Amount</th>
											<th>Supply</th>
											<th>Order Date</th>
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
											<td>Wangige floor mills</td>
											<td>SNTID2403867D9D</td>
											<td>01136565678</td>
											<td>KSH 6000</td>
											<td>Floor</td>
											<td>2025-03-24</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													
													<a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
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
					<!-- /product list -->

					<!-- /Classification list -->
					<!-- <div class="tab-pane fade show" id="classification" role="tabpanel"
					aria-labelledby="classification-tab">
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
									</div>
								</div>
								<div class="form-sort">
									<i data-feather="sliders" class="info-img"></i>
									<select class="select">
										<option>Sort by Date</option>
										<option>25 9 23</option>
										<option>12 9 23</option>
									</select>
								</div>
							</div>
							
							<div class="table-responsive">
								<table class="table datanew">
									<thead>
										<tr>
											<th class="no-sort">
												<label class="checkboxs">
													<input type="checkbox" id="select-all">
													<span class="checkmarks"></span>
												</label>
											</th>
											<th>classificationName</th>
											<th>code</th>
											<th>email</th>
											<th>Phone</th>
											<th>Country</th>
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
													<a href="javascript:void(0);" class="product-img supplier-img">
														<img src="assets/img/supplier/supplier-01.png" alt="product">
													</a>
													<div>
														<a href="javascript:void(0);" class="ms-2">Apex Computers</a>
													</div>
													
												</div>
											</td>
											<td>201</td>
											<td>apexcomputers@example.com</td>
											<td>+12163547758 </td>
											<td>Germany</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2 mb-0" href="javascript:void(0);">
														<i data-feather="eye" class="action-eye"></i>
													</a>
													<a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="me-2 confirm-text p-2 mb-0" href="javascript:void(0);">
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
					</div> -->
					<!-- /Classification list -->
				</div>
			</div>		
        </div>
		<!-- /Main Wrapper -->

				<!-- Edit Category -->
				<div class="modal fade" id="trigger">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>ADD CREDIT TRIGGER</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form action="insert-unsold.php" method="POST">

								<div class="row">

									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Customer Name</label>
											<input type="text" class="form-control" name="credit_customer_name" value="debtor edwin" readonly>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Transaction ID</label>
											<input type="text" class="form-control" name="ttransaction_id"value="SNTID2403867D9D" readonly>
										</div>
									</div>

								</div>

								<div class="row">
								<div class="col-lg-6 col-sm-6 col-12">
										<div class="input-blocks">
											<label>debt paid on</label>

											<div class="input-groupicon calender-input">
												
												<input type="datetime-local" class="form-control" id="productionDateTime" name="debt_pay_date" value="datetime-local">
											</div>
										</div>
									</div>

									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Due Amount</label>
											<input type="text" class="form-control" name="due_amount" value="KSH 2500" readonly>
										</div>
									</div>
								</div>


								<div class="row">

								<div class="col-lg-12 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Paid Amount</label>
											<input type="number" class="form-control" name="debt_paid_amount" value="">
										</div>
									</div>

									


								</div>



								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Submit </button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<!-- /Edit Category -->

				<!-- Edit Category -->
				<div class="modal fade" id="edit-units">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>UPDATE SUPPLIER CREDIT PURCHACE</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form action="insert-unsold.php" method="POST">

								<div class="row">

									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Customer Name</label>
											<input type="text" class="form-control" name="credit_customer_name" value="debtor edwin" readonly>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Transaction ID</label>
											<input type="text" class="form-control" name="ttransaction_id"value="SNTID2403867D9D" readonly>
										</div>
									</div>

								</div>

								<div class="row">
								<div class="col-lg-6 col-sm-6 col-12">
										<div class="input-blocks">
											<label>debt paid on</label>

											<div class="input-groupicon calender-input">
												
												<input type="datetime-local" class="form-control" id="productionDateTime" name="debt_pay_date" value="datetime-local">
											</div>
										</div>
									</div>

									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Due Amount</label>
											<input type="text" class="form-control" name="due_amount" value="KSH 2500" readonly>
										</div>
									</div>
								</div>


								<div class="row">

								<div class="col-lg-12 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Paid Amount</label>
											<input type="number" class="form-control" name="debt_paid_amount" value="">
										</div>
									</div>

									


								</div>



								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Submit </button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<!-- /Edit Category -->
		 
  

		 
	
		<?php include "includes/footer.php";?>

	
    </body>
</html>