<?php 
include_once "./includes/session_check.php"

?>	
<!DOCTYPE html>
	<html lang="en">
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
									<h4>Sales Return List</h4>
									<h6>Manage your Returns</h6>
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
								<a href="javascript:void(0);" class="btn btn-added"  data-bs-toggle="modal" data-bs-target="#add-sales-new"><i data-feather="plus-circle" class="me-2"></i>Add New Sales Return</a>
							</div>
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
												<th>Product Name</th>
												<th>Date</th>
												<th>Customer</th>
												<th>Status</th>
												<th>Grand Total (KSH )</th>
												<th>Paid (KSH )</th>
												<th>Due (KSH )</th>
												<th>Payment Status</th>
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
														<a href="javascript:void(0);" class="product-img">
															<img src="assets/img/products/product1.jpg" alt="product">
														</a>
														<a href="javascript:void(0);">white bread 400gms</a>
													</div>
												</td>
												<td>19 Nov 2022</td>
												<td>Thomas</td>
												<td><span class="badges bg-lightgreen">Received</span></td>
												<td>550</td>
												<td>120</td>
												<td>550</td>
												<td><span class="badges bg-lightgreen">Paid</span></td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-sales-new">
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


			<!-- /add popup -->
			<div class="modal fade" id="add-sales-new">
				<div class="modal-dialog add-centered">
					<div class="modal-content">
						<div class="page-wrapper p-0 m-0">
							<div class="content p-0">
								<div class="modal-header border-0 custom-modal-header">
									<div class="page-title">
										<h4> Add Sales Return</h4>
									</div>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="card">
									<div class="card-body">
										<form action="sales-returns.html">
											<div class="row">
												<div class="col-lg-4 col-sm-6 col-12">
													<div class="input-blocks">
														<label class="form-label">Customer Name</label>
														<div class="row">
															<div class="col-lg-10 col-sm-10 col-10">
																<select class="select">
																	<option>Thomas</option>
																	<option>Benjamin</option>
																	<option>Bruklin</option>
																</select>
															</div>
															<div class="col-lg-2 col-sm-2 col-2 ps-0">
																<div class="add-icon">
																	<a href="#" class="choose-add"><i data-feather="plus-circle" class="plus"></i></a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-4 col-sm-6 col-12">
													<div class="input-blocks">
														<label>Date</label>
														<div class="input-groupicon calender-input">
															<i data-feather="calendar" class="info-img"></i>
															<input type="text" class="datetimepicker" placeholder="Choose">
														</div>
													</div>
												</div>
												<div class="col-lg-4 col-sm-6 col-12">
													<div class="input-blocks">
														<label class="form-label">Reference No.</label>
														<input type="text" class="form-control" value="555444">
													</div>
												</div>
												<div class="col-lg-12 col-sm-6 col-12">
													<div class="input-blocks">
														<label>Product Name</label>
														<div class="input-groupicon select-code">
															<input type="text" placeholder="Please type product code and select">
															<div class="addonset">
																<img src="assets/img/icons/qrcode-scan.svg" alt="img">
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="table-responsive no-pagination">
												<table class="table  datanew">
													<thead>
														<tr>
															<th>Product Name</th>
															<th>Net Unit Price(KSH )	</th>
															<th>Stock</th>
															<th>QTY	</th>
															<th>Discount(KSH )	</th>
															<th>Tax %</th>
															<th>Subtotal (KSH )</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<div class="productimgname">
																	<a href="javascript:void(0);" class="product-img">
																		<img src="assets/img/products/product1.jpg" alt="product">
																	</a>
																	<a href="javascript:void(0);">Kaimati</a>
																</div>													
															</td>
															<td>300</td>
															<td>400</td>
															<td>500</td>
															<td>100</td>
															<td>50</td>
															<td>300</td>
														</tr>
														<tr>
															<td>
																<div class="productimgname">
																	<a href="javascript:void(0);" class="product-img">
																		<img src="assets/img/products/product1.jpg" alt="product">
																	</a>
																	<a href="javascript:void(0);">Dryfcons</a>
																</div>													
															</td>
															<td>150</td>
															<td>500</td>
															<td>300</td>
															<td>100</td>
															<td>50</td>
															<td>300</td>
														</tr>
													</tbody>
												</table>
											</div>
				
											<div class="row">
												<div class="col-lg-6 ms-auto">
													<div class="total-order w-100 max-widthauto m-auto mb-4">
														<ul>
															<li>
																<h4>Order Tax</h4>
																<h5>KSH  0.00</h5>
															</li>
															<li>
																<h4>Discount</h4>
																<h5>KSH  0.00</h5>
															</li>
															<li>
																<h4>Shipping</h4>
																<h5>KSH  0.00</h5>
															</li>
															<li>
																<h4>Grand Total</h4>
																<h5>KSH  0.00</h5>
															</li>
														</ul>
													</div>
												</div>
											</div>
											
											<div class="row">
												<div class="col-lg-3 col-sm-6 col-12">
													<div class="input-blocks">
														<label>Order Tax</label>
														<div class="input-groupicon select-code">
															<input type="text" value="0" class="p-2">
														</div>
														
													</div>
												</div>
												<div class="col-lg-3 col-sm-6 col-12">
													<div class="input-blocks">
														<label>Discount</label>
														<div class="input-groupicon select-code">
															<input type="text" value="0" class="p-2">
														</div>
													</div>
												</div>
												<div class="col-lg-3 col-sm-6 col-12">
													<div class="input-blocks">
														<label>Shipping</label>
														<div class="input-groupicon select-code">
															<input type="text" value="0" class="p-2">
														</div>
													</div>
												</div>
												<div class="col-lg-3 col-sm-6 col-12">
													<div class="input-blocks mb-5">
														<label>Status</label>
														<select class="select">
															<option>Choose</option>
															<option>Pending</option>
															<option>Received</option>
														</select>
													</div>
												</div>
												<div class="col-lg-12 text-end">
													<button type="button"  class="btn btn-cancel add-cancel me-3" data-bs-dismiss="modal">Cancel</button>
													<button type="submit" class="btn btn-submit add-sale">Submit</button>
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

			<!-- Edit popup -->
		<div class="modal fade" id="edit-sales-new">
				<div class="modal-dialog add-centered">
					<div class="modal-content">
						<div class="page-wrapper p-0 m-0">
							<div class="content p-0">
								<div class="modal-header border-0 custom-modal-header">
									<div class="page-title">
										<h4> Add Sales Return</h4>
									</div>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="card">
									<div class="card-body">
										<form action="sales-returns.html">
											<div class="row">
												<div class="col-lg-4 col-sm-6 col-12">
													<div class="input-blocks">
														<label class="form-label">Customer Name</label>
														<div class="row">
															<div class="col-lg-10 col-sm-10 col-10">
																<select class="select">
																	<option>Thomas</option>
																	<option>Benjamin</option>
																	<option>Bruklin</option>
																</select>
															</div>
															<div class="col-lg-2 col-sm-2 col-2 ps-0">
																<div class="add-icon">
																	<a href="#" class="choose-add"><i data-feather="plus-circle" class="plus"></i></a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-4 col-sm-6 col-12">
													<div class="input-blocks">
														<label>Date</label>
														<div class="input-groupicon calender-input">
															<i data-feather="calendar" class="info-img"></i>
															<input type="text" class="datetimepicker" placeholder="Choose">
														</div>
													</div>
												</div>
												<div class="col-lg-4 col-sm-6 col-12">
													<div class="input-blocks">
														<label class="form-label">Reference No.</label>
														<input type="text" class="form-control" value="555444">
													</div>
												</div>
												<div class="col-lg-12 col-sm-6 col-12">
													<div class="input-blocks">
														<label>Product Name</label>
														<div class="input-groupicon select-code">
															<input type="text" placeholder="Please type product code and select">
															<div class="addonset">
																<img src="assets/img/icons/qrcode-scan.svg" alt="img">
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="table-responsive no-pagination">
												<table class="table  datanew">
													<thead>
														<tr>
															<th>Product Name</th>
															<th>Net Unit Price(KSH )	</th>
															<th>Stock</th>
															<th>QTY	</th>
															<th>Discount(KSH )	</th>
															<th>Tax %</th>
															<th>Subtotal (KSH )</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<div class="productimgname">
																	<a href="javascript:void(0);" class="product-img">
																		<img src="assets/img/products/product1.jpg" alt="product">
																	</a>
																	<a href="javascript:void(0);">Apple Earpods</a>
																</div>													
															</td>
															<td>300</td>
															<td>400</td>
															<td>500</td>
															<td>100</td>
															<td>50</td>
															<td>300</td>
														</tr>
														<tr>
															<td>
																<div class="productimgname">
																	<a href="javascript:void(0);" class="product-img">
																		<img src="assets/img/products/product1.jpg" alt="product">
																	</a>
																	<a href="javascript:void(0);">Apple Earpods</a>
																</div>													
															</td>
															<td>150</td>
															<td>500</td>
															<td>300</td>
															<td>100</td>
															<td>50</td>
															<td>300</td>
														</tr>
													</tbody>
												</table>
											</div>
				
											<div class="row">
												<div class="col-lg-6 ms-auto">
													<div class="total-order w-100 max-widthauto m-auto mb-4">
														<ul>
															<li>
																<h4>Order Tax</h4>
																<h5>KSH  0.00</h5>
															</li>
															<li>
																<h4>Discount</h4>
																<h5>KSH  0.00</h5>
															</li>
															<li>
																<h4>Shipping</h4>
																<h5>KSH  0.00</h5>
															</li>
															<li>
																<h4>Grand Total</h4>
																<h5>KSH  0.00</h5>
															</li>
														</ul>
													</div>
												</div>
											</div>
											
											<div class="row">
												<div class="col-lg-3 col-sm-6 col-12">
													<div class="input-blocks">
														<label>Order Tax</label>
														<div class="input-groupicon select-code">
															<input type="text" value="0" class="p-2">
														</div>
														
													</div>
												</div>
												<div class="col-lg-3 col-sm-6 col-12">
													<div class="input-blocks">
														<label>Discount</label>
														<div class="input-groupicon select-code">
															<input type="text" value="0" class="p-2">
														</div>
													</div>
												</div>
												<div class="col-lg-3 col-sm-6 col-12">
													<div class="input-blocks">
														<label>Shipping</label>
														<div class="input-groupicon select-code">
															<input type="text" value="0" class="p-2">
														</div>
													</div>
												</div>
												<div class="col-lg-3 col-sm-6 col-12">
													<div class="input-blocks mb-5">
														<label>Status</label>
														<select class="select">
															<option>Choose</option>
															<option>Pending</option>
															<option>Received</option>
														</select>
													</div>
												</div>
												<div class="col-lg-12 text-end">
													<button type="button"  class="btn btn-cancel add-cancel me-3" data-bs-dismiss="modal">Cancel</button>
													<button type="submit" class="btn btn-submit add-sale">Submit</button>
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
			<!-- /Edit popup -->

	
			<?php include "includes/footer.php";?>

	
		</body>
	</html>