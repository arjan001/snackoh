<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="POS - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Dreams Pos Admin Template</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- animation CSS -->
        <link rel="stylesheet" href="assets/css/animate.css">

		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

		<!-- Datatable CSS -->
		<link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">

		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

		<!-- Daterangepikcer CSS -->
		<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">

		<!-- Summernote CSS -->
	    <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
		
        <!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
    </head>
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
								<h4>Invoice Report	</h4>
								<h6>Manage Your Invoice Report</h6>
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
													<option>Choose Name</option>
													<option>Rose</option>
													<option>Kaitlin</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="stop-circle" class="info-img"></i>
												<select class="select">
													<option>Choose Status</option>
													<option>Paid</option>
													<option>Unpaid</option>
													<option>Overdue</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<div class="position-relative daterange-wraper">
													<input type="text" class="form-control" name="datetimes" placeholder="From Date - To Date" >
													<i data-feather="calendar" class="feather-14 info-img"></i>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<a class="btn btn-filters ms-auto"> <i data-feather="search" class="feather-search"></i> Search </a>
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
											<th>Invoice No</th>
											<th>Customer</th>
											<th>Due Date</th>
											<th>Amount</th>
											<th>Paid</th>
											<th>Amount Due</th>
											<th>Status</th>
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
											<td>INV001</td>
											<td>Thomas</td>
											<td>19 Jan 2023</td>
											<td>KSH 1000</td>
											<td>KSH 1000</td>
											<td>$0.00</td>
											<td><span class="badge badge-linesuccess">Paid</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#view_invoice">
														<i data-feather="edit" class="feather-edit"></i> View invoice
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
											<td>INV001</td>
											<td>Thomas</td>
											<td>19 Jan 2023</td>
											<td>KSH 1000</td>
											<td>KSH 1000</td>
											<td>$0.00</td>
											<td><span class="badge badge-linesuccess">Paid</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#view_invoice">
														<i data-feather="edit" class="feather-edit"></i> View invoice
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
											<td>INV001</td>
											<td>Thomas</td>
											<td>19 Jan 2023</td>
											<td>KSH 1000</td>
											<td>KSH 1000</td>
											<td>$0.00</td>
											<td><span class="badge badge-linesuccess">Paid</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#view_invoice">
														<i data-feather="edit" class="feather-edit"></i> View invoice
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

				<!-- VIEW INVOICE MODAL -->
				<div class="modal fade" id="view_invoice">
			<div class="modal-dialog modal-dialog-centered stock-adjust-modal">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>CUSTOMER INVOICE DATA</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="stock-adjustment.html">
								<div class="row">

								</div>
								<div class="col-lg-12 col-sm-12 col-12">

<div class="mb-3 add-product">
	<label class="form-label">Customer Name</label>
	<input type="text" class="form-control" name="stock_category_name" value="Thomas" readonly>
</div>
</div>
									<div class="row">

										<div class="col-lg-12">
											<div class="modal-body-table">
												<div class="table-responsive">
													<table class="table  datanew">
														<thead>
															<tr>
																<th>Product Name</th>
																<th>Quantity</th>
																<th>Units</th>
																<th>Price</th>
																
																<!-- <th class="no-sort">Action</th> -->
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<div class="productimgname">
																		<a href="javascript:void(0);" class="product-img stock-img">
																			<img src="assets/img/profiles/avator1.jpg" alt="product">
																		</a>
																		<a href="javascript:void(0);">bread 500gms</a>
																	</div>												
																</td>
																<td>1</td>
																<td>Crate</td>
																<td>Ksh 1200</td>
																
																<!-- <td class="action-table-data">
																	<div class="edit-delete-action">
																		<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
																			<i data-feather="edit" class="feather-edit"></i>
																		</a>
																		<a class="confirm-text p-2" href="javascript:void(0);">
																			<i data-feather="trash-2" class="feather-trash-2"></i>
																		</a>
																	</div>
																</td> -->
															</tr>
														</tbody>
													</table>
												</div>
											</div>
											
										</div>
									
									</div>
									
									<div class="col-lg-12">
										<div class="input-blocks summer-description-box">
											<label>Invoice Delivery Notes</label>
											<textarea class="form-control"></textarea>
										</div>
									</div>
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Create Adjustment</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- / VIEW INVOICE MODAL  -->
  

		 
		<?php include "includes/footer.php";?>

	
    </body>
</html>