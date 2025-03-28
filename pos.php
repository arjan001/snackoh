<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="POS - Bootstrap Admin Template">
	<meta name="keywords"
		content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
	<meta name="author" content="Dreamguys - Bootstrap Admin Template">
	<meta name="robots" content="noindex, nofollow">
	<title>SNACK-OH BAKERY ERP</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

	<!-- animation CSS -->
	<link rel="stylesheet" href="assets/css/animate.css">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

	<!-- Datatable CSS -->
	<link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

	<!-- Daterangepikcer CSS -->
	<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">

	<!-- Owl Carousel CSS -->
	<link rel="stylesheet" href="assets/plugins/owlcarousel/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/plugins/owlcarousel/owl.theme.default.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">

</head>
<?php include_once "./includes/session_check.php"; ?>

<body>
	<!-- <div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div> -->
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<?php include "includes/navbar.php";

		?>
		<!-- Header -->


		<div class="page-wrapper pos-pg-wrapper ms-0">
			<div class="content pos-design p-0">
				<div class="btn-row d-sm-flex align-items-center">
					<a href="javascript:void(0);" class="btn btn-secondary mb-xs-3" data-bs-toggle="modal"
						data-bs-target="#orders"><span class="me-1 d-flex align-items-center"><i
								data-feather="shopping-cart" class="feather-16"></i></span>View Orders</a>
					<a href="javascript:void(0);" class="btn btn-info"><span class="me-1 d-flex align-items-center"><i
								data-feather="rotate-cw" class="feather-16"></i></span>Reset</a>
					<a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal"
						data-bs-target="#recents"><span class="me-1 d-flex align-items-center"><i
								data-feather="refresh-ccw" class="feather-16"></i></span>Transaction</a>
				</div>

				<div class="row align-items-start pos-wrapper">
					<div class="col-md-12 col-lg-8">
						<div class="pos-categories tabs_wrapper">



							<div class="pos-products">
								<div class="d-flex align-items-center justify-content-between">
									<h5 class="mb-3">BAKERY ITEMS</h5>
								</div>
								<div class="tab-content">
									<div class="row">
										<?php
										include './config/config.php';

										// Fetch all products from the database
										$sql = "SELECT * FROM products";
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
											while ($product = $result->fetch_assoc()) {
												$product_id = $product['id'];
												$product_name = $product['product_name'];
												$product_price = $product['product_price'];
												$product_quantity = $product['product_quantity'];

												// Dummy image placeholder
												$product_image = 'assets/img/products/dummy.png';
												

												echo "<div class='col-sm-2 col-md-6 col-lg-3 col-xl-3 pe-2'>
                            <div class='product-info default-cover card'>
                                <a href='javascript:void(0);' class='img-bg'>
                                    <img src='$product_image' alt='Product Image'>
                                    <span><i data-feather='check' class='feather-16'></i></span>
                                </a>
                                <h6 class='product-name'><a href='javascript:void(0);'>$product_name</a></h6>
                                <div class='d-flex align-items-center justify-content-between price'>
                                    <span>$product_quantity Pcs Left</span>
                                    <p>KSH $product_price</p>
                                </div>
                                <form method='post' action='' class='add-to-cart-form'>
                                    <input type='hidden' name='id' value='$product_id'>
                                    <input type='hidden' name='name' value='$product_name'>
                                    <input type='hidden' name='price' value='$product_price'>
                                    <input type='hidden' name='image' value='$product_image'>
                                    <button type=' name='add_to_cart' class='btn btn-primary'>Add to Cart</button>
                                </form>
                            </div>
                        </div>";
											}
										} else {
											echo "<p>No products found.</p>";
										}
										?>
									</div>
								</div>
							</div>

						</div>
					</div>

					<!-- order list in cart -->
					<div class="col-md-12 col-lg-4 ps-0">
						<aside class="product-order-list">
						<div class="head d-flex align-items-center justify-content-between w-100">
    <div class="">
        <h5>Order List</h5>
        <span class="transaction-id"></span> <!-- Dynamic Transaction ID will be placed here -->
    </div>
    <div class="">
        <a class="confirm-text" href="javascript:void(0);"><i data-feather="trash-2"
                class="feather-16 text-danger"></i></a>
        <a href="javascript:void(0);" class="text-default"><i data-feather="more-vertical"
                class="feather-16"></i></a>
    </div>
</div>



							<div class="product-added block-section">
								
								<div class="customer-info block-section">
									<h6>Customer Information</h6>
									<div class="input-block d-flex align-items-center">
										<div class="flex-grow-1">
											<select class="select" id="customerDropdown">
												<option value="0">Walk-in Customer</option>
												<?php
												// Fetch customers from the database
												$sql = "SELECT id, customer_name FROM customers";
												$result = mysqli_query($conn, $sql);
												while ($row = mysqli_fetch_assoc($result)) {
													echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['customer_name']) . '</option>';
												}
												?>
											</select>
										</div>
										<a href="#" class="btn btn-primary btn-icon" data-bs-toggle="modal"
											data-bs-target="#create">
											<i data-feather="user-plus" class="feather-16"></i>
										</a>
									</div>
								</div>
								<div class="head-text d-flex align-items-center justify-content-between">
									<h6 class="d-flex align-items-center mb-0">Product Added<span class="count">2</span>
									</h6>
									<a href="javascript:void(0);" class="d-flex align-items-center text-danger"><span
											class="me-1"><i data-feather="x" class="feather-16"></i></span>Clear all</a>
								</div>
								<div class="product-wrap">

									<!-- 	product code now dynamic -->



								</div>
							</div>
							<div class="block-section">
								<div class="selling-info">
									<div class="row">


									</div>
								</div>


								<div class="order-total">
									<table class="table table-responsive table-borderless">

										<tr>
											<td>Sub Total</td>
											<td class="text-end">KSH 00</td>
										</tr>
										
										<tr>
											<td>Total</td>
											<td class="text-end">KSH 00</td>
										</tr>
									</table>
								</div>
							</div>

							<div class="block-section payment-method">
								<h6>Payment Method</h6>
								<div class="row d-flex align-items-center justify-content-center methods">
									<div class="col-md-6 col-lg-4 item">
										<div class="default-cover">
											<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#cash"data-payment-type="cash">
												<img src="assets/img/icons/cash-pay.svg" alt="Payment Method">
												<span>Cash</span>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-lg-4 item">
										<div class="default-cover">
										<a href="javascript:void(0);" id="creditSaleButton" data-bs-toggle="modal"
   data-bs-target="#credit-sale" data-payment-type="credit">
   <img src="assets/img/icons/cash.svg" alt="Payment Method">
   <span>Credit Sale</span>
</a>

										</div>
									</div>
									<div class="col-md-6 col-lg-4 item">
										<div class="default-cover">
											<a href="javascript:void(0);" data-bs-toggle="modal"
												data-bs-target="#pay_mpesa">
												<img src="assets/img/icons/qr-scan.svg" alt="Payment Method">
												<span>Mpesa</span>
											</a>
										</div>


									</div>
								</div>
							</div>
							<div class="d-grid btn-block">
								<a class="btn btn-secondary" href="javascript:void(0);">
									Grand Total : KSH 00.00
								</a>
							</div>
							<div class="btn-row d-sm-flex align-items-center justify-content-between">
								<a href="javascript:void(0);" class="btn btn-info btn-icon flex-fill"
									data-bs-toggle="modal" data-bs-target="#hold-order"><span
										class="me-1 d-flex align-items-center"><i data-feather="pause"
											class="feather-16"></i></span>Hold</a>

								<a href="javascript:void(0);" class="btn btn-danger btn-icon flex-fill"><span
										class="me-1 d-flex align-items-center"><i data-feather="trash-2"
											class="feather-16"></i></span>Void</a>

								<a href="javascript:void(0);" class="btn btn-success btn-icon flex-fill"
									data-bs-toggle="modal" data-bs-target="#payment-completed"><span
										class="me-1 d-flex align-items-center"><i data-feather="credit-card"
											class="feather-16"></i></span>Payment</a>
							</div>

						</aside>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- /Main Wrapper -->

	<!-- MPESA PAYMENT MODAL y -->
	<div class="modal fade" id="pay_mpesa">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>PAY USING MPESA NUMBER</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>


						</div>
						<div class="modal-body custom-modal-body">
							<form action="add_product_category.php" method="POST">
								<div class="mb-3">
									<label class="form-label">Payable Amount</label>
									<input type="number"  id="total_amount" name="total_amount" readonly class="form-control">
<input type="hidden" id="customer_id" name="customer_id">
<input type="hidden" id="employee_id" name="employee_id">
<input type="hidden" id="total_price" name="total_price">
<input type="hidden" id="cart" name="cart">
<input type="hidden" id="transaction_id" name="transaction_id">
<input type="hidden" id="payment_status" name="payment_status" value="completed">
<input type="hidden" id="payment_method" name="payment_method" value="">
								</div>

								<div class="mb-3">
									<label class="form-label">Safaricom Number</label>
									<input type="number" name="mpesa_number" class="form-control">
								</div>


								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">submit Pay</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- MPESA PAYMENT MODAL  -->

<!-- CASH PAYMENT Modal -->
<div class="modal fade" id="cash">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>PAY WITH CASH</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form action="save_order.php" method="POST">
<input type="hidden" id="customer_id" name="customer_id">
<input type="hidden" id="employee_id" name="employee_id">
<input type="hidden" id="total_price" name="total_price">
<input type="hidden" id="cart" name="cart">
<input type="hidden" id="transaction_id" name="transaction_id">
<input type="hidden" id="payment_status" name="payment_status" value="completed">
<input type="hidden" id="payment_method" name="payment_method" value="">


                            <div class="row">
                                <!-- Total Payable Amount -->
                                <div class="col-lg-6 mt-4">
                                    <div class="input-blocks">
                                        <label>Total Payable</label>
                                        <div class="pass-group">
                                            <input type="number" class="form-control" id="total_amount" name="total_amount" readonly>
                                        </div>
                                    </div>
                                </div>

                                <!-- Amount Given (Cash Tendered) -->
                                <div class="col-lg-6 mt-4">
                                    <div class="input-blocks">
                                        <label>Amount Given</label>
                                        <div class="pass-group">
                                            <input type="number" class="form-control" id="amount_given" name="amount_given" required oninput="calculateChange()">
                                        </div>
                                    </div>
                                </div>

                                <!-- Change Given (Balance) -->
                                <div class="col-lg-12 mt-4">
                                    <div class="input-blocks">
                                        <label>Change Given</label>
                                        <div class="pass-group">
                                            <input type="number" class="form-control" id="change_given" name="change_given" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CASH PAYMENT Modal -->

<!-- Credit Sale Confirmation Modal -->
<div class="modal fade modal-default" id="credit-sale" aria-labelledby="credit-sale">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form action="save_order.php" method="POST">
                    <!-- Hidden Input Fields -->
                    <input type="hidden" id="customer_id" name="customer_id">
                    <input type="hidden" id="employee_id" name="employee_id">
                    <input type="hidden" id="total_price" name="total_price">
                    <input type="hidden" id="cart" name="cart">
                    <input type="hidden" id="transaction_id" name="transaction_id">
                    <input type="hidden" id="payment_status" name="payment_status" value="pending">
                    <input type="hidden" id="payment_method" name="payment_method" value="credit">

                    <div class="icon-head">
                        <a href="javascript:void(0);">
                            <i data-feather="check-circle" class="feather-40"></i>
                        </a>
                    </div>
                    <h4>Confirm Credit Sale</h4>
                    <h5 class="mb-0">Are you sure you want to process this order as a credit sale?</h5>
                    <p class="mb-0">Transactions will successfully be saved in the Creditors Table.<br>When requesting payment, kindly review.</p>
                
                    <div class="modal-footer d-sm-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes, Confirm Credit Sale</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Credit Sale Confirmation Modal -->




		<!-- Credit sale payment modal-->
		<!-- <div class="modal fade modal-default" id="credit-sale" aria-labelledby="credit-sale">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body text-center">
					<form action="pos.html">
					<input type="hidden" id="paymentMethod" name="payment_method" value="credit">

						<div class="icon-head">
							<a href="javascript:void(0);">
								<i data-feather="check-circle" class="feather-40"></i>
							</a>
						</div>
						<h4>Credit Sale Payment </h4>
						<h5 class="mb-0">Transaction succesfully saved in Creditors Table When requesting payment Kindly Review</h5>
						<h5 class="mb-0">Do you want to Print Receipt for the Completed Order</>
						</div>
						<div class="modal-footer d-sm-flex justify-content-between">
							<button type="button" class="btn btn-primary flex-fill" data-bs-toggle="modal"
								data-bs-target="#print-receipt">Print Receipt<i
									class="feather-arrow-right-circle icon-me-5"></i></button>
							<button type="submit" class="btn btn-secondary flex-fill">Next Order<i
									class="feather-arrow-right-circle icon-me-5"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> -->
	<!-- Credit sale payment modal -->

<!-- /Payment Completed modal-->
<div class="modal fade modal-default" id="payment-completed" aria-labelledby="payment-completed">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body text-center">
					<form action="pos.html">
						<div class="icon-head">
							<a href="javascript:void(0);">
								<i data-feather="check-circle" class="feather-40"></i>
							</a>
						</div>
						<h4>Payment Completed</h4>
						<p class="mb-0">Do you want to Print Receipt for the Completed Order</p>
						<div class="modal-footer d-sm-flex justify-content-between">
							<button type="button" class="btn btn-primary flex-fill" data-bs-toggle="modal"
								data-bs-target="#print-receipt">Print Receipt<i
									class="feather-arrow-right-circle icon-me-5"></i></button>
							<button type="submit" class="btn btn-secondary flex-fill">Next Order<i
									class="feather-arrow-right-circle icon-me-5"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- /Payment Completed modal-->
<!-- Print Receipt -->

<?php include 'includes/reciept_print.php'; ?>

	<!-- /Print Receipt -->



	<div class="modal fade" id="create" tabindex="-1" aria-labelledby="create" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Create</h5>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="pos.html">
						<div class="row">
							<div class="col-lg-6 col-sm-12 col-12">
								<div class="input-blocks">
									<label>Customer Name</label>
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-6 col-sm-12 col-12">
								<div class="input-blocks">
									<label>Email</label>
									<input type="email" class="form-control">
								</div>
							</div>
							<div class="col-lg-6 col-sm-12 col-12">
								<div class="input-blocks">
									<label>Phone</label>
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-6 col-sm-12 col-12">
								<div class="input-blocks">
									<label>Country</label>
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-6 col-sm-12 col-12">
								<div class="input-blocks">
									<label>City</label>
									<input type="text">
								</div>
							</div>
							<div class="col-lg-6 col-sm-12 col-12">
								<div class="input-blocks">
									<label>Address</label>
									<input type="text">
								</div>
							</div>
						</div>
						<div class="modal-footer d-sm-flex justify-content-end">
							<button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-submit me-2">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Hold -->

	<?php include_once 'includes/hold_transaction.php'; ?>

	<!-- /Hold -->

		<!-- Products -->

		<!-- <div class="modal fade modal-default pos-modal" id="products" aria-labelledby="products">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header p-4 d-flex align-items-center justify-content-between">
					<div class="d-flex align-items-center">
						<h5 class="me-4">Products</h5>
						<span class="badge bg-info d-inline-block mb-0">Order ID : #666614</span>
					</div>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body p-4">
					<form action="pos.html">
						<div class="product-wrap">
							<div class="product-list d-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center flex-fill">
									<a href="javascript:void(0);" class="img-bg me-2">
										<img src="assets/img/products/pos-product-16.png" alt="Products">
									</a>
									<div class="info d-flex align-items-center justify-content-between flex-fill">
										<div>
											<span>PT0005</span>
											<h6><a href="javascript:void(0);">Red Nike Laser</a></h6>
										</div>
										<p>$2000</p>
									</div>
								</div>

							</div>
							<div class="product-list d-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center flex-fill">
									<a href="javascript:void(0);" class="img-bg me-2">
										<img src="assets/img/products/pos-product-17.png" alt="Products">
									</a>
									<div class="info d-flex align-items-center justify-content-between flex-fill">
										<div>
											<span>PT0235</span>
											<h6><a href="javascript:void(0);">Iphone 14</a></h6>
										</div>
										<p>$3000</p>
									</div>
								</div>
							</div>
							<div class="product-list d-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center flex-fill">
									<a href="javascript:void(0);" class="img-bg me-2">
										<img src="assets/img/products/pos-product-16.png" alt="Products">
									</a>
									<div class="info d-flex align-items-center justify-content-between flex-fill">
										<div>
											<span>PT0005</span>
											<h6><a href="javascript:void(0);">Red Nike Laser</a></h6>
										</div>
										<p>$2000</p>
									</div>
								</div>
							</div>
							<div class="product-list d-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center flex-fill">
									<a href="javascript:void(0);" class="img-bg me-2">
										<img src="assets/img/products/pos-product-17.png" alt="Products">
									</a>
									<div class="info d-flex align-items-center justify-content-between flex-fill">
										<div>
											<span>PT0005</span>
											<h6><a href="javascript:void(0);">Red Nike Laser</a></h6>
										</div>
										<p>$2000</p>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer d-sm-flex justify-content-end">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> -->

	<!-- /Products -->

<!-- recent_transactions section -->
   <?php include_once 'includes/recent_transactions.php'; ?>
<!-- recent_transactions section -->


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

	<!-- Chart JS -->
	<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
	<script src="assets/plugins/apexchart/chart-data.js"></script>

	<!-- Daterangepikcer JS -->
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>

	<!-- Owl JS -->
	<script src="assets/plugins/owlcarousel/owl.carousel.min.js"></script>

	<!-- Select2 JS -->
	<script src="assets/plugins/select2/js/select2.min.js"></script>

	<!-- Sweetalert 2 -->
	<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
	<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/theme-script.js"></script>
	<script src="assets/js/script.js"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    let transactionID = localStorage.getItem("transactionID") || generateTransactionID();

    function generateTransactionID() {
        let date = new Date();
        let day = String(date.getDate()).padStart(2, "0");
        let month = String(date.getMonth() + 1).padStart(2, "0");
        let uniqueNum = Math.floor(100 + Math.random() * 900);
        let randomLetters = Math.random().toString(36).substring(2, 5).toUpperCase();
        let newID = `SNTID${day}${month}${uniqueNum}${randomLetters}`;
        localStorage.setItem("transactionID", newID);
        return newID;
    }

    $(".transaction-id").text(`Transaction ID : ${transactionID}`);

    let cart = JSON.parse(localStorage.getItem("cart")) || {};

    function saveCart() {
        localStorage.setItem("cart", JSON.stringify(cart));
    }

    function formatNumber(num) {
        return Number(num).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function updateCartUI() {
        let cartHTML = "";
        let subtotal = 0;

        $.each(cart, function (id, item) {
            let totalPrice = item.price * item.quantity;
            subtotal += totalPrice;

            cartHTML += `
                <div class="product-list d-flex align-items-center justify-content-between" data-id="${id}">
                    <div class="d-flex align-items-center product-info">
                        <a href="javascript:void(0);" class="img-bg">
                            <img src="${item.image}" alt="Product Image">
                        </a>
                        <div class="info">
                            <h6>${item.name}</h6>
                            <p>KSH ${formatNumber(totalPrice)}</p>
                        </div>
                    </div>
                    <div class="qty-item text-center">
                        <a href="javascript:void(0);" class="dec d-flex justify-content-center align-items-center">
                            <i data-feather="minus-circle" class="feather-14"></i>
                        </a>
                        <input type="text" class="form-control text-center" name="qty" value="${item.quantity}" readonly>
                        <a href="javascript:void(0);" class="inc d-flex justify-content-center align-items-center">
                            <i data-feather="plus-circle" class="feather-14"></i>
                        </a>
                    </div>
                    <div class="d-flex align-items-center action">
                        <a class="btn-icon delete-icon confirm-text remove-item" href="javascript:void(0);">
                            <i data-feather="trash-2" class="feather-14"></i>
                        </a>
                    </div>
                </div>
            `;
        });

        $(".product-wrap").html(cartHTML);
        $(".order-total table tr:first-child td.text-end").text(`KSH ${formatNumber(subtotal)}`);
        $(".order-total table tr:last-child td.text-end").text(`KSH ${formatNumber(subtotal)}`);

        localStorage.setItem("total_price", subtotal);

        feather.replace();
        saveCart();
        updateGrandTotal();
    }

    $(".add-to-cart-form button").click(function (e) {
        e.preventDefault();

        let productCard = $(this).closest(".product-info");
        let id = productCard.find("input[name='id']").val();
        let name = productCard.find("input[name='name']").val();
        let price = parseFloat(productCard.find("input[name='price']").val());
        let image = productCard.find("input[name='image']").val();

        if (cart[id]) {
            cart[id].quantity += 1;
        } else {
            cart[id] = { name, price, image, quantity: 1 };
        }

        updateCartUI();
    });

    $(document).on("click", ".inc", function () {
        let id = $(this).closest(".product-list").data("id");
        cart[id].quantity += 1;
        updateCartUI();
    });

    $(document).on("click", ".dec", function () {
        let id = $(this).closest(".product-list").data("id");
        if (cart[id].quantity > 1) {
            cart[id].quantity -= 1;
        } else {
            delete cart[id];
        }
        updateCartUI();
    });

    $(document).on("click", ".remove-item", function () {
        let id = $(this).closest(".product-list").data("id");
        delete cart[id];
        updateCartUI();
    });

    updateCartUI();

    function updateGrandTotal() {
        let totalPrice = localStorage.getItem("total_price") || "0";
        totalPrice = parseFloat(totalPrice).toFixed(2);
        $(".btn.btn-secondary").html(`Grand Total : KSH ${totalPrice}`);
    }

    updateGrandTotal();

    // Handle Customer Selection
    let customerID = localStorage.getItem("customer_id") || "0";
    $("#customerDropdown").val(customerID);

    $("#customerDropdown").change(function () {
        let selectedValue = $(this).val();
        localStorage.setItem("customer_id", selectedValue);
    });

	let employeeID = "<?php echo $_SESSION['employee_id'] ?? ''; ?>";

	if (employeeID) {
        localStorage.setItem("employee_id", employeeID);
        $("#employee_id").val(employeeID); // Ensure the input field is populated

    } else {
        // If not found in session, check localStorage
        let storedEmployeeID = localStorage.getItem("employee_id");
        if (storedEmployeeID) {
            $("#employee_id").val(storedEmployeeID);
        }
    }
});

// Cash Payment Modal

document.addEventListener("DOMContentLoaded", function() {
    function updateTotalAmount() {
        let totalPrice = localStorage.getItem("total_price") || "0";
        totalPrice = parseFloat(totalPrice).toFixed(2);
        document.getElementById("total_amount").value = totalPrice;

        
        // document.getElementById("transaction_id").value = transactionId;
    }

    document.querySelector("[data-bs-target='#cash']").addEventListener("click", updateTotalAmount);
});

function calculateChange() {
    let total = parseFloat(document.getElementById("total_amount").value) || 0;
    let given = parseFloat(document.getElementById("amount_given").value) || 0;
    let change = given - total;

    document.getElementById("change_given").value = change > 0 ? change.toFixed(2) : 0;
}

// process payment section



$(document).ready(function () {
    let selectedPaymentType = "cash"; // Default payment type

    // Capture payment type when a method is clicked
    $(".methods a").click(function () {
        selectedPaymentType = $(this).data("payment-type") || "cash";
        console.log("Selected Payment Type:", selectedPaymentType);
    });

    $(".complete-order").click(function () {
        let transactionID = localStorage.getItem("transactionID") || "";
        let customerID = localStorage.getItem("selectedCustomer") || "0";
        let employeeID = localStorage.getItem("employee_id") || "";
        let totalPrice = localStorage.getItem("total_price") || "0";
        let cart = JSON.parse(localStorage.getItem("cart")) || {};

        // Ensure the correct payment type is sent
        let paymentType = selectedPaymentType;

        let orderItems = Object.keys(cart).map(id => ({
            name: cart[id].name,
            price: cart[id].price,
            quantity: cart[id].quantity,
            image: cart[id].image
        }));

        let orderData = {
            transaction_id: transactionID,
            customer_id: customerID,
            employee_id: employeeID,
            total_price: totalPrice,
            products: orderItems,
            payment_status: "completed",
            payment_type: paymentType // Send selected payment type
        };

        console.log("Order Data:", orderData);

		
        $.ajax({
            url: "save_order.php",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(orderData),
            success: function (response) {
                console.log("Response: ", response);
                alert("Order saved successfully!");
                localStorage.removeItem("cart");
                localStorage.removeItem("total_price");
                localStorage.removeItem("transactionID");
                localStorage.removeItem("selectedCustomer");
                localStorage.removeItem("employeeID");
                updateCartUI();
            },
            error: function () {
                alert("Failed to save order.");
            }
        });
    });

    // Ensure correct values are assigned in the cash form before submission
    function populatePaymentModal() {
        $("#customer_id").val(localStorage.getItem("customer_id") || "");
        $("#employee_id").val(localStorage.getItem("employee_id") || "");
        $("#total_price").val(localStorage.getItem("total_price") || "");
        $("#cart").val(localStorage.getItem("cart") || "");
        $("#transaction_id").val(localStorage.getItem("transactionID") || "");
        $("#payment_type").val(selectedPaymentType); // Set correct payment type

        console.log("Payment Modal Data Loaded:", {
            customer_id: $("#customer_id").val(),
            employee_id: $("#employee_id").val(),
            total_price: $("#total_price").val(),
            products: $("#cart").val(),
            transaction_id: $("#transaction_id").val(),
            payment_type: $("#payment_type").val()
        });
    }

    // Bind modal events for correct data population
    $("#cash, #credit-sale, #pay_mpesa").on("show.bs.modal", populatePaymentModal);
});



</script>



</body>

</html>
4t1ov4q8dvcsifzo1wm9jqi5p6v5x5t27eepjy09kbo8ldby
<script src="https://cdn.tiny.cloud/1/4t1ov4q8dvcsifzo1wm9jqi5p6v5x5t27eepjy09kbo8ldby/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>