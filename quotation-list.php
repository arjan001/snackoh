<!DOCTYPE html>
<html lang="en">
	
<?php
include_once "./includes/session_check.php" ;
include "includes/header.php"

;?>
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
								<h4>Quotation List</h4>
								<h6>Manage Your Quotation</h6>
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
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Add New Quotation</a>
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
											<th>Product Name</th>
											<th>Reference</th>
											<th>Custmer Name</th>
											<th>Status</th>
											<th>Grand Total (KSH)</th>
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
											<td class="productimgname">
												<div class="view-product me-2">
													<a href="javascript:void(0);">
														<img src="assets/img/products/stock-img-01.png" alt="product">
													</a>
												</div>
												<a href="javascript:void(0);">Lenovo 3rd Generation</a>
											</td>
											<td>PT001</td>
											<td>walk-in-customer</td>
											<td><span class="badges status-badge">Sent</span></td>
											<td>KSH550</td>
											<td class="action-table-data">
												<div class="edit-delete-action data-row">
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
										
										<tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>
											<td class="productimgname">
												<div class="view-product me-2">
													<a href="javascript:void(0);">
														<img src="assets/img/products/stock-img-02.png" alt="product">
													</a>
												</div>
												<a href="javascript:void(0);">Nike Jordan</a>
											</td>
											<td>PT003</td>
											<td>walk-in-customer</td>
											<td><span class="badges order-badge">Ordered</span></td>
											<td>KSH260</td>
											<td class="action-table-data">
												<div class="edit-delete-action data-row">
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
										<tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>
											<td class="productimgname">
												<div class="view-product me-2">
													<a href="javascript:void(0);">
														<img src="assets/img/products/stock-img-03.png" alt="product">
													</a>
												</div>
												<a href="javascript:void(0);">Apple Series 5 Watch</a>
											</td>
											<td>PT004</td>
											<td>John Smith</td>
											<td><span class="badges unstatus-badge">Pending</span></td>
											<td>KSH470</td>
											<td class="action-table-data">
												<div class="edit-delete-action data-row">
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
					<!-- /product list -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

		<!--Add Quotation -->
		<div class="modal fade" id="add-units">
			<div class="modal-dialog edit-sales-modal">
				<div class="modal-content">
					<div class="page-wrapper p-0 m-0">
						<div class="content p-0">
							<div class="page-header p-4 mb-0">
								<div class="add-item new-sale-items d-flex">
									<div class="page-title">
										<h4>Edit Quotation</h4>
									</div>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<form action="quotationList.html">
										<div class="row">
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Customer Name</label>
													<div class="row">
														<div class="col-lg-10 col-sm-10 col-10">
															<select class="select">
																<option>Thomas</option>
																<option>Rose</option>
															</select>
														</div>
														<div class="col-lg-2 col-sm-2 col-2 ps-0">
															<div class="add-icon">
																<span class="choose-add"><i data-feather="plus-circle" class="plus"></i></span>
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
														<input type="text" class="datetimepicker" placeholder="19 jan 2023">
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Reference Number</label>
													<input type="text" placeholder="010203">
												</div>
											</div>
											<div class="col-lg-12 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Product Name</label>
													<div class="input-groupicon select-code">
														<input type="text" placeholder="Please type product code and select">
														<div class="addonset">
															<img src="assets/img/icons/scanners.svg" alt="img">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="table-responsive no-pagination">
											<table class="table  datanew">
												<thead>
													<tr>
														<th>Product</th>
														<th>Qty</th>
														<th>Purchase Price(KSH)</th>
														<th>Discount(KSH)</th>
														<th>Tax(%)</th>
														<th>Tax Amount(KSH)</th>
														<th>Unit Cost(KSH)</th>
														<th>Total Cost(%)</th>
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
														<td>
															<div class="product-quantity">
																<span class="quantity-btn">+<i data-feather="plus-circle" class="plus-circle"></i></span>
																<input type="text" class="quntity-input" value="2">
																<span class="quantity-btn"><i data-feather="minus-circle" class="feather-search"></i></span>
															</div>
														</td>
														<td>2000</td>
														<td>500</td>
														<td>
															0.00
														</td>
														<td>0.00</td>
														<td>0.00</td>
														<td>1500</td>
													</tr>
													<tr>
														<td>
															<div class="productimgname">
																<a href="javascript:void(0);" class="product-img stock-img">
																	<img src="assets/img/products/stock-img-03.png" alt="product">
																</a>
																<a href="javascript:void(0);">Apple Series 5 Watch</a>
															</div>												
														</td>
														<td>
															<div class="product-quantity">
																<span class="quantity-btn">+<i data-feather="plus-circle" class="plus-circle"></i></span>
																<input type="text" class="quntity-input" value="2">
																<span class="quantity-btn"><i data-feather="minus-circle" class="feather-search"></i></span>
															</div>
														</td>
														<td>3000</td>
														<td>400</td>
														<td>
															0.00
														</td>
														<td>0.00</td>
														<td>0.00</td>
														<td>1700</td>
													</tr>
													<tr>
														<td>
															<div class="productimgname">
																<a href="javascript:void(0);" class="product-img stock-img">
																	<img src="assets/img/products/stock-img-05.png" alt="product">
																</a>
																<a href="javascript:void(0);">Lobar Handy</a>
															</div>												
														</td>
														<td>
															<div class="product-quantity">
																<span class="quantity-btn">+<i data-feather="plus-circle" class="plus-circle"></i></span>
																<input type="text" class="quntity-input" value="2">
																<span class="quantity-btn"><i data-feather="minus-circle" class="feather-search"></i></span>
															</div>
														</td>
														<td>2500</td>
														<td>500</td>
														<td>
															0.00
														</td>
														<td>0.00</td>
														<td>0.00</td>
														<td>2000</td>
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
															<h5>KSH 0.00</h5>
														</li>
														<li>
															<h4>Discount</h4>
															<h5>KSH 0.00</h5>
														</li>
														<li>
															<h4>Shipping</h4>
															<h5>KSH 0.00</h5>
														</li>
														<li>
															<h4>Grand Total</h4>
															<h5>KSH5200.00</h5>
														</li>
													</ul>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Order Tax</label>
													<div class="input-groupicon select-code">
														<input type="text" placeholder="0">
													</div>
													
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Discount</label>
													<div class="input-groupicon select-code">
														<input type="text" placeholder="0">
													</div>
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Shipping</label>
													<div class="input-groupicon select-code">
														<input type="text" placeholder="0">
													</div>
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Status</label>
													<select class="select">
														<option>Sent</option>
														<option>Completed</option>
														<option>Inprogress</option>
													</select>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="input-blocks summer-description-box">
													<label>Description</label>
													<div id="summernote5"></div>
												</div>
											</div>
											<div class="col-lg-12 text-end">
												<button type="button" class="btn btn-cancel add-cancel me-3" data-bs-dismiss="modal">Cancel</button>
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
		<!-- /Add Quotation -->


  
		<?php include "includes/footer.php";?>
		
    </body>
</html>