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
								<h6>Manage Your Quotations</h6>
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
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" onclick="loadQuotations()"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-quotation"><i data-feather="plus-circle" class="me-2"></i>Add New Quotation</a>
						</div>
					</div>
					

					<!-- /quotation list -->
					<div class="card table-list-card">
						<div class="card-body">
							<div class="table-top">
								<div class="search-set">
									<div class="search-input">
										<input type="text" id="search-quotation" placeholder="Search quotations...">
										<a href="" class="btn btn-searchset" onclick="loadQuotations()"><i data-feather="search" class="feather-search"></i></a>
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
									<select class="select" id="status-filter" onchange="loadQuotations()">
										<option value="">All Status</option>
										<option value="draft">Draft</option>
										<option value="sent">Sent</option>
										<option value="accepted">Accepted</option>
										<option value="rejected">Rejected</option>
										<option value="expired">Expired</option>
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
											<th>Quotation Number</th>
											<th>Customer Name</th>
											<th>Date</th>
											<th>Status</th>
											<th>Grand Total (KSH)</th>
											<th class="no-sort">Action</th>
										</tr>
									</thead>
									<tbody id="quotations-tbody">
										<!-- Dynamic content will be loaded here -->
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- /quotation list -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

				<!--Add Quotation -->
		<div class="modal fade" id="add-quotation">
			<div class="modal-dialog edit-sales-modal">
				<div class="modal-content">
					<div class="page-wrapper p-0 m-0">
						<div class="content p-0">
							<div class="page-header p-4 mb-0">
								<div class="add-item new-sale-items d-flex">
									<div class="page-title">
										<h4>Add New Quotation</h4>
									</div>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<form id="quotation-form">
										<div class="row">
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Customer</label>
													<select class="select" id="customer-select" onchange="loadCustomerDetails()">
														<option value="">Select Customer</option>
													</select>
												</div>
											</div>
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Quotation Date</label>
													<div class="input-groupicon calender-input">
														<i data-feather="calendar" class="info-img"></i>
														<input type="date" id="quotation-date" value="<?= date('Y-m-d') ?>">
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Expiry Date</label>
													<div class="input-groupicon calender-input">
														<i data-feather="calendar" class="info-img"></i>
														<input type="date" id="expiry-date" value="<?= date('Y-m-d', strtotime('+30 days')) ?>">
													</div>
												</div>
											</div>
											<div class="col-lg-6 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Customer Name</label>
													<input type="text" id="customer-name" placeholder="Customer name">
												</div>
											</div>
											<div class="col-lg-6 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Customer Email</label>
													<input type="email" id="customer-email" placeholder="Customer email">
												</div>
											</div>
											<div class="col-lg-6 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Customer Phone</label>
													<input type="text" id="customer-phone" placeholder="Customer phone">
												</div>
											</div>
											<div class="col-lg-6 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Product Search</label>
													<div class="input-groupicon select-code">
														<input type="text" id="product-search" placeholder="Search products...">
														<div class="addonset">
															<img src="assets/img/icons/scanners.svg" alt="img">
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="table-responsive no-pagination">
											<table class="table datanew">
												<thead>
													<tr>
														<th>Product</th>
														<th>Qty</th>
														<th>Unit Price(KSH)</th>
														<th>Discount(KSH)</th>
														<th>Tax(%)</th>
														<th>Tax Amount(KSH)</th>
														<th>Total(KSH)</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody id="quotation-items">
													<!-- Dynamic items will be loaded here -->
												</tbody>
											</table>
										</div>
			
										<div class="row">
											<div class="col-lg-6 ms-auto">
												<div class="total-order w-100 max-widthauto m-auto mb-4">
													<ul>
														<li>
															<h4>Subtotal</h4>
															<h5 id="subtotal">KSH 0.00</h5>
														</li>
														<li>
															<h4>Tax</h4>
															<h5 id="tax-amount">KSH 0.00</h5>
														</li>
														<li>
															<h4>Discount</h4>
															<h5 id="discount-amount">KSH 0.00</h5>
														</li>
														<li>
															<h4>Shipping</h4>
															<h5 id="shipping-amount">KSH 0.00</h5>
														</li>
														<li>
															<h4>Grand Total</h4>
															<h5 id="grand-total">KSH 0.00</h5>
														</li>
													</ul>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Tax Rate (%)</label>
													<input type="number" id="tax-rate" value="16" min="0" max="100" step="0.01" onchange="calculateTotals()">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Discount (KSH)</label>
													<input type="number" id="discount" value="0" min="0" step="0.01" onchange="calculateTotals()">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Shipping (KSH)</label>
													<input type="number" id="shipping" value="0" min="0" step="0.01" onchange="calculateTotals()">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Status</label>
													<select class="select" id="quotation-status">
														<option value="draft">Draft</option>
														<option value="sent">Sent</option>
													</select>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="input-blocks">
													<label>Notes</label>
													<textarea id="notes" rows="3" placeholder="Additional notes..."></textarea>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="input-blocks">
													<label>Terms & Conditions</label>
													<textarea id="terms-conditions" rows="3" placeholder="Terms and conditions..."></textarea>
												</div>
											</div>
											<div class="col-lg-12 text-end">
												<button type="button" class="btn btn-cancel add-cancel me-3" data-bs-dismiss="modal">Cancel</button>
												<button type="button" class="btn btn-submit add-sale" onclick="saveQuotation()">Submit</button>
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

		<!--Edit Quotation -->
		<div class="modal fade" id="edit-quotation">
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
									<form id="edit-quotation-form">
										<input type="hidden" id="edit-quotation-id">
										<div class="row">
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Customer</label>
													<select class="select" id="edit-customer-select" onchange="loadEditCustomerDetails()">
														<option value="">Select Customer</option>
													</select>
												</div>
											</div>
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Quotation Date</label>
													<div class="input-groupicon calender-input">
														<i data-feather="calendar" class="info-img"></i>
														<input type="date" id="edit-quotation-date">
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Expiry Date</label>
													<div class="input-groupicon calender-input">
														<i data-feather="calendar" class="info-img"></i>
														<input type="date" id="edit-expiry-date">
													</div>
												</div>
											</div>
											<div class="col-lg-6 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Customer Name</label>
													<input type="text" id="edit-customer-name" placeholder="Customer name">
												</div>
											</div>
											<div class="col-lg-6 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Customer Email</label>
													<input type="email" id="edit-customer-email" placeholder="Customer email">
												</div>
											</div>
											<div class="col-lg-6 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Customer Phone</label>
													<input type="text" id="edit-customer-phone" placeholder="Customer phone">
												</div>
											</div>
											<div class="col-lg-6 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Product Search</label>
													<div class="input-groupicon select-code">
														<input type="text" id="edit-product-search" placeholder="Search products...">
														<div class="addonset">
															<img src="assets/img/icons/scanners.svg" alt="img">
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="table-responsive no-pagination">
											<table class="table datanew">
												<thead>
													<tr>
														<th>Product</th>
														<th>Qty</th>
														<th>Unit Price(KSH)</th>
														<th>Discount(KSH)</th>
														<th>Tax(%)</th>
														<th>Tax Amount(KSH)</th>
														<th>Total(KSH)</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody id="edit-quotation-items">
													<!-- Dynamic items will be loaded here -->
												</tbody>
											</table>
										</div>
			
										<div class="row">
											<div class="col-lg-6 ms-auto">
												<div class="total-order w-100 max-widthauto m-auto mb-4">
													<ul>
														<li>
															<h4>Subtotal</h4>
															<h5 id="edit-subtotal">KSH 0.00</h5>
														</li>
														<li>
															<h4>Tax</h4>
															<h5 id="edit-tax-amount">KSH 0.00</h5>
														</li>
														<li>
															<h4>Discount</h4>
															<h5 id="edit-discount-amount">KSH 0.00</h5>
														</li>
														<li>
															<h4>Shipping</h4>
															<h5 id="edit-shipping-amount">KSH 0.00</h5>
														</li>
														<li>
															<h4>Grand Total</h4>
															<h5 id="edit-grand-total">KSH 0.00</h5>
														</li>
													</ul>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Tax Rate (%)</label>
													<input type="number" id="edit-tax-rate" value="16" min="0" max="100" step="0.01" onchange="calculateEditTotals()">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Discount (KSH)</label>
													<input type="number" id="edit-discount" value="0" min="0" step="0.01" onchange="calculateEditTotals()">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Shipping (KSH)</label>
													<input type="number" id="edit-shipping" value="0" min="0" step="0.01" onchange="calculateEditTotals()">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Status</label>
													<select class="select" id="edit-quotation-status">
														<option value="draft">Draft</option>
														<option value="sent">Sent</option>
														<option value="accepted">Accepted</option>
														<option value="rejected">Rejected</option>
													</select>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="input-blocks">
													<label>Notes</label>
													<textarea id="edit-notes" rows="3" placeholder="Additional notes..."></textarea>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="input-blocks">
													<label>Terms & Conditions</label>
													<textarea id="edit-terms-conditions" rows="3" placeholder="Terms and conditions..."></textarea>
												</div>
											</div>
											<div class="col-lg-12 text-end">
												<button type="button" class="btn btn-cancel add-cancel me-3" data-bs-dismiss="modal">Cancel</button>
												<button type="button" class="btn btn-submit add-sale" onclick="updateQuotation()">Update</button>
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
		<!-- /Edit Quotation -->


  
		  		<?php include "includes/footer.php";?>
		
		<script>
		// Global variables
		let quotationItems = [];
		let editQuotationItems = [];
		let customers = [];
		let products = [];
		
		// Load quotations on page load
		$(document).ready(function() {
			loadQuotations();
			loadCustomers();
			loadProducts();
		});
		
		// Load quotations
		function loadQuotations() {
			const search = $('#search-quotation').val();
			const status = $('#status-filter').val();
			
			$.ajax({
				url: 'get_quotations.php',
				type: 'GET',
				data: {
					search: search,
					status: status
				},
				dataType: 'json',
				success: function(response) {
					if (response.success) {
						displayQuotations(response.data);
					} else {
						showNotification('Error loading quotations: ' + response.message, 'error');
					}
				},
				error: function() {
					showNotification('Error loading quotations', 'error');
				}
			});
		}
		
		// Display quotations in table
		function displayQuotations(quotations) {
			let html = '';
			
			if (quotations.length === 0) {
				html = '<tr><td colspan="7" class="text-center">No quotations found</td></tr>';
			} else {
				quotations.forEach(function(quotation) {
					html += `
						<tr>
							<td>
								<label class="checkboxs">
									<input type="checkbox">
									<span class="checkmarks"></span>
								</label>
							</td>
							<td>${quotation.quotation_number}</td>
							<td>${quotation.customer_name}</td>
							<td>${quotation.quotation_date}</td>
							<td>${quotation.status_badge}</td>
							<td>KSH ${quotation.grand_total}</td>
							<td class="action-table-data">
								<div class="edit-delete-action data-row">
									<a class="me-2 p-2 mb-0" onclick="editQuotation(${quotation.id})">
										<i data-feather="edit" class="feather-edit"></i>
									</a>
									<a class="me-2 confirm-text p-2 mb-0" onclick="deleteQuotation(${quotation.id})">
										<i data-feather="trash-2" class="feather-trash-2"></i>
									</a>
								</div>
							</td>
						</tr>
					`;
				});
			}
			
			$('#quotations-tbody').html(html);
			feather.replace();
		}
		
		// Load customers
		function loadCustomers() {
			$.ajax({
				url: 'get_customers_for_quotation.php',
				type: 'GET',
				dataType: 'json',
				success: function(response) {
					if (response.success) {
						customers = response.data;
						let html = '<option value="">Select Customer</option>';
						customers.forEach(function(customer) {
							html += `<option value="${customer.id}">${customer.name}</option>`;
						});
						$('#customer-select, #edit-customer-select').html(html);
					}
				}
			});
		}
		
		// Load products
		function loadProducts() {
			$.ajax({
				url: 'get_products_for_quotation.php',
				type: 'GET',
				dataType: 'json',
				success: function(response) {
					if (response.success) {
						products = response.data;
					}
				}
			});
		}
		
		// Load customer details when customer is selected
		function loadCustomerDetails() {
			const customerId = $('#customer-select').val();
			const customer = customers.find(c => c.id == customerId);
			
			if (customer) {
				$('#customer-name').val(customer.name);
				$('#customer-email').val(customer.email);
				$('#customer-phone').val(customer.phone);
			}
		}
		
		// Load edit customer details
		function loadEditCustomerDetails() {
			const customerId = $('#edit-customer-select').val();
			const customer = customers.find(c => c.id == customerId);
			
			if (customer) {
				$('#edit-customer-name').val(customer.name);
				$('#edit-customer-email').val(customer.email);
				$('#edit-customer-phone').val(customer.phone);
			}
		}
		
		// Add product to quotation
		$('#product-search').on('keyup', function() {
			const search = $(this).val();
			const filteredProducts = products.filter(p => 
				p.product_name.toLowerCase().includes(search.toLowerCase())
			);
			
			if (filteredProducts.length > 0) {
				const product = filteredProducts[0];
				addProductToQuotation(product);
				$(this).val('');
			}
		});
		
		// Add product to edit quotation
		$('#edit-product-search').on('keyup', function() {
			const search = $(this).val();
			const filteredProducts = products.filter(p => 
				p.product_name.toLowerCase().includes(search.toLowerCase())
			);
			
			if (filteredProducts.length > 0) {
				const product = filteredProducts[0];
				addProductToEditQuotation(product);
				$(this).val('');
			}
		});
		
		// Add product to quotation items
		function addProductToQuotation(product) {
			const existingItem = quotationItems.find(item => item.product_name === product.product_name);
			
			if (existingItem) {
				existingItem.quantity += 1;
			} else {
				quotationItems.push({
					product_name: product.product_name,
					product_description: '',
					quantity: 1,
					unit_price: product.unit_price,
					discount: 0,
					tax_rate: 16,
					tax_amount: 0,
					total_amount: product.unit_price
				});
			}
			
			displayQuotationItems();
			calculateTotals();
		}
		
		// Add product to edit quotation items
		function addProductToEditQuotation(product) {
			const existingItem = editQuotationItems.find(item => item.product_name === product.product_name);
			
			if (existingItem) {
				existingItem.quantity += 1;
			} else {
				editQuotationItems.push({
					product_name: product.product_name,
					product_description: '',
					quantity: 1,
					unit_price: product.unit_price,
					discount: 0,
					tax_rate: 16,
					tax_amount: 0,
					total_amount: product.unit_price
				});
			}
			
			displayEditQuotationItems();
			calculateEditTotals();
		}
		
		// Display quotation items
		function displayQuotationItems() {
			let html = '';
			
			quotationItems.forEach(function(item, index) {
				html += `
					<tr>
						<td>
							<div class="productimgname">
								<a href="javascript:void(0);" class="product-img stock-img">
									<img src="assets/img/product/Macbook.png" alt="product">
								</a>
								<a href="javascript:void(0);">${item.product_name}</a>
							</div>
						</td>
						<td>
							<div class="product-quantity">
								<span class="quantity-btn" onclick="updateQuantity(${index}, -1)">-</span>
								<input type="text" class="quntity-input" value="${item.quantity}" onchange="updateItemQuantity(${index}, this.value)">
								<span class="quantity-btn" onclick="updateQuantity(${index}, 1)">+</span>
							</div>
						</td>
						<td>${item.unit_price}</td>
						<td>
							<input type="number" value="${item.discount}" onchange="updateItemDiscount(${index}, this.value)" min="0" step="0.01">
						</td>
						<td>${item.tax_rate}%</td>
						<td>${item.tax_amount}</td>
						<td>${item.total_amount}</td>
						<td>
							<a href="javascript:void(0);" onclick="removeQuotationItem(${index})">
								<i data-feather="trash-2" class="feather-trash-2"></i>
							</a>
						</td>
					</tr>
				`;
			});
			
			$('#quotation-items').html(html);
			feather.replace();
		}
		
		// Display edit quotation items
		function displayEditQuotationItems() {
			let html = '';
			
			editQuotationItems.forEach(function(item, index) {
				html += `
					<tr>
						<td>
							<div class="productimgname">
								<a href="javascript:void(0);" class="product-img stock-img">
									<img src="assets/img/product/Macbook.png" alt="product">
								</a>
								<a href="javascript:void(0);">${item.product_name}</a>
							</div>
						</td>
						<td>
							<div class="product-quantity">
								<span class="quantity-btn" onclick="updateEditQuantity(${index}, -1)">-</span>
								<input type="text" class="quntity-input" value="${item.quantity}" onchange="updateEditItemQuantity(${index}, this.value)">
								<span class="quantity-btn" onclick="updateEditQuantity(${index}, 1)">+</span>
							</div>
						</td>
						<td>${item.unit_price}</td>
						<td>
							<input type="number" value="${item.discount}" onchange="updateEditItemDiscount(${index}, this.value)" min="0" step="0.01">
						</td>
						<td>${item.tax_rate}%</td>
						<td>${item.tax_amount}</td>
						<td>${item.total_amount}</td>
						<td>
							<a href="javascript:void(0);" onclick="removeEditQuotationItem(${index})">
								<i data-feather="trash-2" class="feather-trash-2"></i>
							</a>
						</td>
					</tr>
				`;
			});
			
			$('#edit-quotation-items').html(html);
			feather.replace();
		}
		
		// Update quantity
		function updateQuantity(index, change) {
			quotationItems[index].quantity = Math.max(1, quotationItems[index].quantity + change);
			updateItemTotal(index);
			displayQuotationItems();
			calculateTotals();
		}
		
		// Update edit quantity
		function updateEditQuantity(index, change) {
			editQuotationItems[index].quantity = Math.max(1, editQuotationItems[index].quantity + change);
			updateEditItemTotal(index);
			displayEditQuotationItems();
			calculateEditTotals();
		}
		
		// Update item quantity
		function updateItemQuantity(index, quantity) {
			quotationItems[index].quantity = parseInt(quantity) || 1;
			updateItemTotal(index);
			calculateTotals();
		}
		
		// Update edit item quantity
		function updateEditItemQuantity(index, quantity) {
			editQuotationItems[index].quantity = parseInt(quantity) || 1;
			updateEditItemTotal(index);
			calculateEditTotals();
		}
		
		// Update item discount
		function updateItemDiscount(index, discount) {
			quotationItems[index].discount = parseFloat(discount) || 0;
			updateItemTotal(index);
			calculateTotals();
		}
		
		// Update edit item discount
		function updateEditItemDiscount(index, discount) {
			editQuotationItems[index].discount = parseFloat(discount) || 0;
			updateEditItemTotal(index);
			calculateEditTotals();
		}
		
		// Update item total
		function updateItemTotal(index) {
			const item = quotationItems[index];
			const subtotal = (item.quantity * item.unit_price) - item.discount;
			item.tax_amount = subtotal * (item.tax_rate / 100);
			item.total_amount = subtotal + item.tax_amount;
		}
		
		// Update edit item total
		function updateEditItemTotal(index) {
			const item = editQuotationItems[index];
			const subtotal = (item.quantity * item.unit_price) - item.discount;
			item.tax_amount = subtotal * (item.tax_rate / 100);
			item.total_amount = subtotal + item.tax_amount;
		}
		
		// Remove quotation item
		function removeQuotationItem(index) {
			quotationItems.splice(index, 1);
			displayQuotationItems();
			calculateTotals();
		}
		
		// Remove edit quotation item
		function removeEditQuotationItem(index) {
			editQuotationItems.splice(index, 1);
			displayEditQuotationItems();
			calculateEditTotals();
		}
		
		// Calculate totals
		function calculateTotals() {
			const taxRate = parseFloat($('#tax-rate').val()) || 0;
			const discount = parseFloat($('#discount').val()) || 0;
			const shipping = parseFloat($('#shipping').val()) || 0;
			
			let subtotal = 0;
			quotationItems.forEach(function(item) {
				subtotal += (item.quantity * item.unit_price) - item.discount;
			});
			
			const taxAmount = subtotal * (taxRate / 100);
			const grandTotal = subtotal + taxAmount + shipping - discount;
			
			$('#subtotal').text('KSH ' + subtotal.toFixed(2));
			$('#tax-amount').text('KSH ' + taxAmount.toFixed(2));
			$('#discount-amount').text('KSH ' + discount.toFixed(2));
			$('#shipping-amount').text('KSH ' + shipping.toFixed(2));
			$('#grand-total').text('KSH ' + grandTotal.toFixed(2));
		}
		
		// Calculate edit totals
		function calculateEditTotals() {
			const taxRate = parseFloat($('#edit-tax-rate').val()) || 0;
			const discount = parseFloat($('#edit-discount').val()) || 0;
			const shipping = parseFloat($('#edit-shipping').val()) || 0;
			
			let subtotal = 0;
			editQuotationItems.forEach(function(item) {
				subtotal += (item.quantity * item.unit_price) - item.discount;
			});
			
			const taxAmount = subtotal * (taxRate / 100);
			const grandTotal = subtotal + taxAmount + shipping - discount;
			
			$('#edit-subtotal').text('KSH ' + subtotal.toFixed(2));
			$('#edit-tax-amount').text('KSH ' + taxAmount.toFixed(2));
			$('#edit-discount-amount').text('KSH ' + discount.toFixed(2));
			$('#edit-shipping-amount').text('KSH ' + shipping.toFixed(2));
			$('#edit-grand-total').text('KSH ' + grandTotal.toFixed(2));
		}
		
		// Save quotation
		function saveQuotation() {
			if (quotationItems.length === 0) {
				showNotification('Please add at least one item to the quotation', 'error');
				return;
			}
			
			const formData = {
				customer_id: $('#customer-select').val(),
				customer_name: $('#customer-name').val(),
				customer_email: $('#customer-email').val(),
				customer_phone: $('#customer-phone').val(),
				quotation_date: $('#quotation-date').val(),
				expiry_date: $('#expiry-date').val(),
				tax_rate: $('#tax-rate').val(),
				discount: $('#discount').val(),
				shipping: $('#shipping').val(),
				status: $('#quotation-status').val(),
				notes: $('#notes').val(),
				terms_conditions: $('#terms-conditions').val(),
				items: JSON.stringify(quotationItems)
			};
			
			$.ajax({
				url: 'save_quotation.php',
				type: 'POST',
				data: formData,
				dataType: 'json',
				success: function(response) {
					if (response.success) {
						showNotification(response.message, 'success');
						$('#add-quotation').modal('hide');
						resetQuotationForm();
						loadQuotations();
					} else {
						showNotification(response.message, 'error');
					}
				},
				error: function() {
					showNotification('Error saving quotation', 'error');
				}
			});
		}
		
		// Edit quotation
		function editQuotation(quotationId) {
			$.ajax({
				url: 'get_quotation.php',
				type: 'GET',
				data: { id: quotationId },
				dataType: 'json',
				success: function(response) {
					if (response.success) {
						populateEditForm(response.data);
						$('#edit-quotation').modal('show');
					} else {
						showNotification(response.message, 'error');
					}
				},
				error: function() {
					showNotification('Error loading quotation', 'error');
				}
			});
		}
		
		// Populate edit form
		function populateEditForm(data) {
			const quotation = data.quotation;
			editQuotationItems = data.items;
			
			$('#edit-quotation-id').val(quotation.id);
			$('#edit-customer-select').val(quotation.customer_id);
			$('#edit-customer-name').val(quotation.customer_name);
			$('#edit-customer-email').val(quotation.customer_email);
			$('#edit-customer-phone').val(quotation.customer_phone);
			$('#edit-quotation-date').val(quotation.quotation_date_formatted);
			$('#edit-expiry-date').val(quotation.expiry_date_formatted);
			$('#edit-tax-rate').val(quotation.tax_rate);
			$('#edit-discount').val(quotation.discount);
			$('#edit-shipping').val(quotation.shipping);
			$('#edit-quotation-status').val(quotation.status);
			$('#edit-notes').val(quotation.notes);
			$('#edit-terms-conditions').val(quotation.terms_conditions);
			
			displayEditQuotationItems();
			calculateEditTotals();
		}
		
		// Update quotation
		function updateQuotation() {
			if (editQuotationItems.length === 0) {
				showNotification('Please add at least one item to the quotation', 'error');
				return;
			}
			
			const formData = {
				quotation_id: $('#edit-quotation-id').val(),
				customer_id: $('#edit-customer-select').val(),
				customer_name: $('#edit-customer-name').val(),
				customer_email: $('#edit-customer-email').val(),
				customer_phone: $('#edit-customer-phone').val(),
				quotation_date: $('#edit-quotation-date').val(),
				expiry_date: $('#edit-expiry-date').val(),
				tax_rate: $('#edit-tax-rate').val(),
				discount: $('#edit-discount').val(),
				shipping: $('#edit-shipping').val(),
				status: $('#edit-quotation-status').val(),
				notes: $('#edit-notes').val(),
				terms_conditions: $('#edit-terms-conditions').val(),
				items: JSON.stringify(editQuotationItems)
			};
			
			$.ajax({
				url: 'update_quotation.php',
				type: 'POST',
				data: formData,
				dataType: 'json',
				success: function(response) {
					if (response.success) {
						showNotification(response.message, 'success');
						$('#edit-quotation').modal('hide');
						loadQuotations();
					} else {
						showNotification(response.message, 'error');
					}
				},
				error: function() {
					showNotification('Error updating quotation', 'error');
				}
			});
		}
		
		// Delete quotation
		function deleteQuotation(quotationId) {
			if (confirm('Are you sure you want to delete this quotation?')) {
				$.ajax({
					url: 'delete_quotation.php',
					type: 'POST',
					data: { quotation_id: quotationId },
					dataType: 'json',
					success: function(response) {
						if (response.success) {
							showNotification(response.message, 'success');
							loadQuotations();
						} else {
							showNotification(response.message, 'error');
						}
					},
					error: function() {
						showNotification('Error deleting quotation', 'error');
					}
				});
			}
		}
		
		// Reset quotation form
		function resetQuotationForm() {
			quotationItems = [];
			$('#quotation-form')[0].reset();
			$('#quotation-date').val('<?= date('Y-m-d') ?>');
			$('#expiry-date').val('<?= date('Y-m-d', strtotime('+30 days')) ?>');
			$('#quotation-items').html('');
			calculateTotals();
		}
		
		// Show notification
		function showNotification(message, type) {
			// Create notification element
			const notification = document.createElement('div');
			notification.className = `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} alert-dismissible fade show position-fixed`;
			notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
			notification.innerHTML = `
				${message}
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			`;
			
			document.body.appendChild(notification);
			
			// Auto remove after 5 seconds
			setTimeout(() => {
				if (notification.parentNode) {
					notification.remove();
				}
			}, 5000);
		}
		
		// Initialize modals
		$('#add-quotation').on('show.bs.modal', function() {
			resetQuotationForm();
		});
		</script>
		
    </body>
</html>