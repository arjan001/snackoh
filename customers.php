<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; 

include_once "./includes/session_check.php" ;?>

<body>

	<!-- <div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div> -->

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
					<div class="page-title me-auto">
						<h4>Customers List</h4>
						<h6>Manage your Customers</h6>
					</div>
					<ul class="table-top-head low-stock-top-head">
						<li>
							<div class="page-btn">
								<a href="#" class="btn btn-added" data-bs-toggle="modal"
									data-bs-target="#add-customer"><i data-feather="plus-circle" class="me-2"></i>Add
									New Customer</a>
							</div>
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
				</div>
				<div class="table-tab">
					<ul class="nav nav-pills" id="pills-tab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="customer-tab" data-bs-toggle="pill"
								data-bs-target="#customer" type="button" role="tab" aria-controls="customer"
								aria-selected="true">Customers List</button>
						</li>


						<li class="nav-item" role="presentation">
							<button class="nav-link" id="geoMapping-tab" data-bs-toggle="pill"
								data-bs-target="#geoMapping" type="button" role="tab" aria-controls="geoMapping"
								aria-selected="false">Geo Mapping</button>
						</li>


						<li class="nav-item" role="presentation">
							<button class="nav-link" id="segmentation-tab" data-bs-toggle="pill"
								data-bs-target="#segmentation" type="button" role="tab" aria-controls="segmentation"
								aria-selected="false">Segmentation</button>
						</li>

						<li class="nav-item" role="presentation">
							<button class="nav-link" id="engagementTerms-tab" data-bs-toggle="pill"
								data-bs-target="#engagementTerms" type="button" role="tab"
								aria-controls="engagementTerms" aria-selected="false">Engagement Terms</button>
						</li>

					</ul>
					<div class="tab-content" id="pills-tabContent">

						<!--CUSTOMERS LIST TAB  -->
						<div class="tab-pane fade show active" id="customer" role="tabpanel"
							aria-labelledby="customer-tab">
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
												<option>Newest</option>
												<option>Oldest</option>
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
													<th>Customer Name</th>
													<th>Segment</th>
													<th>Phone No</th>
													<th>Pay Terms</th>
													<th>Out - Balance</th>
													<th>physical-Address</th>

													<th class="no-sort">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												// Assuming you have already connected to your database
												$sql = "SELECT id, customer_name, segment, phone, payment_terms, town, physical_address FROM customers";
												$result = mysqli_query($conn, $sql);

												if (mysqli_num_rows($result) > 0) {
													// Loop through the result and display the data
													while ($row = mysqli_fetch_assoc($result)) {
														echo "<tr>";
														echo "<td><label class='checkboxs'><input type='checkbox'><span class='checkmarks'></span></label></td>";
														echo "<td>" . $row['customer_name'] . "</td>";
														echo "<td>" . $row['segment'] . "</td>";
														echo "<td>" . $row['phone'] . "</td>";
														echo "<td>" . $row['payment_terms'] . "</td>";
														echo "<td>null</td>"; // Placeholder for outstanding balance
														echo "<td>" . $row['physical_address'] . "</td>"; // Placeholder for last pay date
														echo "<td class='action-table-data'>
                <div class='edit-delete-action'>
                   
					
                    <a class='me-2 p-2' href='#' data-bs-toggle='modal' data-bs-target='#edit_customer' data-id='" . $row['id'] . "'>
                        <i data-feather='edit' class='feather-edit'></i>
                    </a>

					
                    <a class='confirm-text p-2' href='javascript:void(0);'>
                        <i data-feather='trash-2' class='feather-trash-2'></i>
                    </a>
                </div>
              </td>";
														echo "</tr>";
													}
												} else {
													echo "<tr><td colspan='8'>No customers found</td></tr>";
												}
												?>


											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- /product list -->
						</div>
						<!--CUSTOMERS LIST TAB  -->

						<!-- GEO MAPPING TAB -->
						<div class="tab-pane fade" id="geoMapping" role="tabpanel" aria-labelledby="geoMapping-tab">
							<div class="card table-list-card">
								<div class="card-body">
									<div id="geoMap" style="width: 100%; height: 500px;"></div>
								</div>
							</div>
						</div>
						<!-- GEO MAPPING TAB -->


						<!--SEGMENTATION TAB  -->
						<div class="tab-pane fade" id="segmentation" role="tabpanel" aria-labelledby="segmentation-tab">

							<div class="row sales-cards">
								<div class="col-xl-12 col-sm-12 col-12">
									<div
										class="card d-flex align-items-center justify-content-between default-cover mb-4">
										<div>
											<h6>Weekly Earning</h6>
											<h3>KSH <span class="counters" data-count="95000.45">95000.45</span></h3>
											<p class="sales-range"><span class="text-success"><i
														data-feather="chevron-up"
														class="feather-16"></i>48%&nbsp;</span>increase compare to last
												week</p>
										</div>
										<img src="assets/img/icons/weekly-earning.svg" alt="img">
									</div>
								</div>

								<div class="col-xl-4 col-sm-6 col-12">
									<div class="card color-info bg-primary mb-4">
										<p>Retailers</p>
										<img src="assets/img/icons/total-sales.svg" alt="img">
										<h3 class="counters" data-count="10000.00">10,000+</h3>
										<p>Total volume: 25,000 units</p>
										<i data-feather="rotate-ccw" class="feather-16" data-bs-toggle="tooltip"
											data-bs-placement="top" title="Refresh"></i>
									</div>
								</div>
								<div class="col-xl-4 col-sm-6 col-12">
									<div class="card color-info bg-secondary mb-4">
										<p>Wholesalers</p>
										<img src="assets/img/icons/purchased-earnings.svg" alt="img">
										<h3 class="counters" data-count="800.00">800+</h3>
										<p>Total volume: 25,000 units</p>
										<i data-feather="rotate-ccw" class="feather-16" data-bs-toggle="tooltip"
											data-bs-placement="top" title="Refresh"></i>
									</div>
								</div>
								<div class="col-xl-4 col-sm-6 col-12">
									<div class="card color-info bg-secondary mb-4">
										<p>Distributors</p>
										<img src="assets/img/icons/purchased-earnings.svg" alt="img">
										<h3 class="counters" data-count="800.00">800+</h3>
										<p>Total volume: 25,000 units</p>
										<i data-feather="rotate-ccw" class="feather-16" data-bs-toggle="tooltip"
											data-bs-placement="top" title="Refresh"></i>
									</div>
								</div>
							</div>

						</div>
						<!--SEGMENTATION TAB  -->

						<!--SEGMENTATION TAB  -->
						<div class="tab-pane fade" id="engagementTerms" role="tabpanel"
							aria-labelledby="engagementTerms-tab">

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
											<th>Customer Name</th>
											<th>Segment</th>
											<th>Payment Terms</th>
											<th>Credit Period</th>
											<th>Outstanding Balance</th>
											<th>Days Until</th>
											<th>Notification </th>
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
											<td>njugunas Shop </td>
											<td>Retailer </td>
											<td>Credit</td>
											<td>7 days</td>
											<td>KSH 5000</td>
											<td>2 Days</td>
											<td><span class="badge badge-linedanger">Not Notified</span></td>


											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2  btn btn-added" href="#" data-bs-toggle="modal"
														data-bs-target="#notify_customer">
														Notify
													</a>
													<!-- <a class="confirm-text p-2" href="javascript:void(0);">
														<i data-feather="trash-2" class="feather-trash-2"></i>
													</a> -->
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
											<td>kevin Shop </td>
											<td>Retailer </td>
											<td>Credit</td>
											<td>7 days</td>
											<td>KSH 5000</td>
											<td>2 Days</td>
											<td><span class="badge badge-linesuccess">Notified</span> </td>


											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2 btn btn-added" href="#" data-bs-toggle="modal"
														data-bs-target="#notify_customer">
														Notify
													</a>

												</div>

											</td>
										</tr>


									</tbody>
								</table>
							</div>

						</div>
						<!--SEGMENTATION TAB  -->

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Main Wrapper -->

	<!-- Add Customer -->
	<div class="modal fade" id="add-customer">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Add Customer</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form action="add_customers.php" method="POST">
								<div class="row">
									<div class="col-lg-4 pe-0">
										<div class="mb-3">
											<label class="form-label">Customer Name</label>
											<input type="text" class="form-control" name="customer_name" required>
										</div>
									</div>
									<div class="col-lg-4 pe-0">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input type="email" class="form-control" name="email" required>
										</div>
									</div>
									<div class="col-lg-4 pe-0">
										<div class="input-blocks">
											<label class="mb-2">Phone</label>
											<input class="form-control form-control-lg group_formcontrol" name="phone"
												type="text" required>
										</div>
									</div>
									<div class="col-lg-12 pe-0">
										<div class="mb-3">
											<label class="form-label">Physical Address</label>
											<input type="text" class="form-control" name="physical_address">
										</div>
									</div>
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Town</label>
											<input type="text" class="form-control" name="town">
										</div>
									</div>
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Segment</label>
											<select class="select form-control" name="segment">
												<option value="Retailer">Retailer</option>
												<option value="Wholesaler">Wholesaler</option>
												<option value="Distributor">Distributor</option>
												<option value="Consumer">Consumer</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">City</label>
											<input type="text" class="form-control" name="city">
										</div>
									</div>
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Gender</label>
											<select class="select form-control" name="gender">
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
									</div>
									<div class="col-lg-12 pe-0">
										<div class="mb-3">
											<label class="form-label">Payment Terms</label>
											<select class="select form-control" name="payment_terms">
												<option value="Cash">Cash</option>
												<option value="Credit">Credit</option>
											</select>
										</div>
									</div>
									<div class="col-lg-12 pe-0">
										<div class="mb-3">
											<label class="form-label">Map Location (Type or Click on the map)</label>

											<!-- Search Input for Places Autocomplete -->
											<input id="autocomplete" class="form-control" type="text"
												placeholder="Search for a location..." />

											<!-- Google Map Container -->
											<div id="map"
												style="height: 400px; border: 1px solid #ccc; margin-top: 10px;"></div>

											<!-- Hidden fields for latitude & longitude -->
											<input type="hidden" name="latitude" id="latitude">
											<input type="hidden" name="longitude" id="longitude">
										</div>
									</div>

								</div>

								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Submit</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Add Customer -->

	<!-- Send Mail -->
	<div class="modal fade" id="send-email">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="success-email-send modal-body .custom-modal-body text-center">
					<span><i data-feather="check-circle" class="feather-trash-2"></i></span>
					<h4>Success</h4>
					<p>Email Sent Successfully</p>
					<a href="" class="btn btn-primary" data-bs-dismiss="modal">Close</a>
				</div>
			</div>
		</div>
	</div>
	<!-- /Send Mail -->


	<!-- Edit Customer -->
	<div class="modal fade" id="edit_customer">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Edit Customer</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form action="add_customers.php" method="POST">
								<input type="hidden" name="id" value="<?php echo $customer_id; ?>" />
								<div class="row">
									<div class="col-lg-4 pe-0">
										<div class="mb-3">
											<label class="form-label">Customer Name</label>
											<input type="text" class="form-control" name="customer_name" required>
										</div>
									</div>
									<div class="col-lg-4 pe-0">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input type="email" class="form-control" name="email" required>
										</div>
									</div>
									<div class="col-lg-4 pe-0">
										<div class="input-blocks">
											<label class="mb-2">Phone</label>
											<input class="form-control form-control-lg group_formcontrol" name="phone"
												type="text" required>
										</div>
									</div>
									<div class="col-lg-12 pe-0">
										<div class="mb-3">
											<label class="form-label">Physical Address</label>
											<input type="text" class="form-control" name="physical_address">
										</div>
									</div>
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Town</label>
											<input type="text" class="form-control" name="town">
										</div>
									</div>
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Segment</label>
											<select class="select form-control" name="segment">
												<option value="Retailer">Retailer</option>
												<option value="Wholesaler">Wholesaler</option>
												<option value="Consumer">Consumer</option>
												<option value="Distributor">Distributor</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">City</label>
											<input type="text" class="form-control" name="city">
										</div>
									</div>
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Gender</label>
											<select class="select form-control" name="gender">
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
									</div>
									<div class="col-lg-12 pe-0">
										<div class="mb-3">
											<label class="form-label">Payment Terms</label>
											<select class="select form-control" name="payment_terms">
												<option value="Cash">Cash</option>
												<option value="Credit">Credit</option>
											</select>
										</div>
									</div>


								</div>

								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Submit</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Edit Customer -->

	<!-- notify customer -->

	<div class="modal fade" id="notify_customer">
		<div class="modal-dialog modal-dialog-centered stock-adjust-modal">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>NOTIFY CUSTOMER</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form action="send_inventory_order.php" method="POST">

								<div class="row">
									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Customer Name</label>
											<input type="text" class="form-control" name="stock_category_name">
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Outstanding Balance</label>
											<input type="number" class="form-control" name="stock_category_name">
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Days Untill Due</label>
											<input type="number" class="form-control" name="stock_category_name">
										</div>
									</div>

									<div class="col-lg-6 col-sm-6 col-12">
										<div class="input-blocks">
											<label>Notification Method</label>
											<select class="select">
												<option>select notfication  method</option>
												<option>sms</option>
												<option>Email</option>
												
											</select>
										</div>
									</div>
								</div>

								

								<div class="col-lg-12">
									<div class="input-blocks summer-description-box">
										<label>Message to be sent</label>
										<textarea class="form-control"></textarea>
									</div>
								</div>
								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Confirm Order</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- notify customer -->





	<?php include "includes/footer.php"; ?>


</body>

</html>