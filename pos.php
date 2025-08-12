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
				
				<!-- Status Messages -->
				<?php if (isset($_GET['status'])): ?>
					<?php if ($_GET['status'] === 'inventory_error' && isset($_GET['message'])): ?>
						<script>
							// Store error in localStorage for notifications
							localStorage.setItem('pos_error', '<?= addslashes(urldecode($_GET['message'])) ?>');
							localStorage.setItem('pos_error_type', 'inventory_error');
							
							// Show popup modal
							$(document).ready(function() {
								$('#inventory-error-modal').modal('show');
							});
						</script>
					<?php elseif ($_GET['status'] === 'success'): ?>
						<script>
							// Store success in localStorage for notifications
							localStorage.setItem('pos_success', '<?= isset($_GET['message']) ? addslashes(urldecode($_GET['message'])) : 'Order completed successfully!' ?>');
							
							// Store receipt data if available
							<?php if (isset($_GET['transaction_id']) && isset($_GET['order_id'])): ?>
							localStorage.setItem('receipt_transaction_id', '<?= $_GET['transaction_id'] ?>');
							localStorage.setItem('receipt_order_id', '<?= $_GET['order_id'] ?>');
							<?php endif; ?>
							
							// Show success popup
							$(document).ready(function() {
								$('#success-modal').modal('show');
							});
						</script>
					<?php elseif ($_GET['status'] === 'error'): ?>
						<script>
							// Store error in localStorage for notifications
							localStorage.setItem('pos_error', '<?= isset($_GET['message']) ? addslashes(urldecode($_GET['message'])) : 'Order processing error' ?>');
							localStorage.setItem('pos_error_type', 'general_error');
							
							// Show error popup
							$(document).ready(function() {
								$('#error-modal').modal('show');
							});
						</script>
					<?php endif; ?>
				<?php endif; ?>
				
				<!-- Session Status Banner -->
				<?php
				$employee_id = $_SESSION['employee_id'] ?? 0;
				$active_session_query = "SELECT * FROM pos_sessions WHERE employee_id = ? AND status = 'open' ORDER BY opening_time DESC LIMIT 1";
				$stmt = $conn->prepare($active_session_query);
				$stmt->bind_param("i", $employee_id);
				$stmt->execute();
				$active_session = $stmt->get_result()->fetch_assoc();
				$stmt->close();
				?>
				
				<?php if ($active_session): ?>
					<div class="alert alert-success mb-3">
						<div class="d-flex align-items-center justify-content-between">
							<div>
								<strong><i data-feather="check-circle" class="feather-16 me-2"></i>Active POS Session</strong>
								<span class="ms-3">Session ID: <?= $active_session['session_id'] ?></span>
								<span class="ms-3">Opening: KSH <?= number_format($active_session['opening_amount'], 2) ?></span>
								<span class="ms-3">Sales: KSH <?= number_format($active_session['total_sales'], 2) ?></span>
							</div>
							<div>
								<a href="pos_sessions.php" class="btn btn-sm btn-warning">
									<i data-feather="settings" class="feather-12 me-1"></i>Manage Session
								</a>
							</div>
						</div>
					</div>
				<?php else: ?>
					<div class="alert alert-warning mb-3">
						<div class="d-flex align-items-center justify-content-between">
							<div>
								<strong><i data-feather="alert-triangle" class="feather-16 me-2"></i>No Active POS Session</strong>
								<span class="ms-3">You need to open a session before making sales</span>
							</div>
							<div>
								<a href="pos_sessions.php" class="btn btn-sm btn-primary">
									<i data-feather="unlock" class="feather-12 me-1"></i>Open Session
								</a>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<div class="btn-row d-sm-flex align-items-center">
					<a href="javascript:void(0);" class="btn btn-secondary mb-xs-3" data-bs-toggle="modal"
						data-bs-target="#orders"><span class="me-1 d-flex align-items-center"><i
								data-feather="shopping-cart" class="feather-16"></i></span>View Orders</a>
					<a href="check_missing_ingredients.php" class="btn btn-warning btn-sm me-2" title="Check missing ingredients">
						<i data-feather="search" class="feather-16 me-1"></i>Check Ingredients
					</a>
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
												$product_image = 'assets/img/products/5.jpg';
												// $product_image = 'img/5.jpg';

												// Determine inventory status and styling
												$inventory_class = '';
												$inventory_icon = '';
												$inventory_text = '';
												
												if ($product_quantity <= 0) {
													$inventory_class = 'text-danger';
													$inventory_icon = '<i data-feather="alert-triangle" class="feather-12 me-1"></i>';
													$inventory_text = 'OUT OF STOCK';
												} elseif ($product_quantity <= 5) {
													$inventory_class = 'text-warning';
													$inventory_icon = '<i data-feather="alert-circle" class="feather-12 me-1"></i>';
													$inventory_text = 'LOW STOCK';
												} else {
													$inventory_class = 'text-success';
													$inventory_icon = '<i data-feather="check-circle" class="feather-12 me-1"></i>';
													$inventory_text = 'IN STOCK';
												}

												echo "<div class='col-sm-2 col-md-6 col-lg-3 col-xl-3 pe-2'>
                            <div class='product-info default-cover card'>
                                <a href='javascript:void(0);' class='img-bg'>
                                    <img src='$product_image' alt='Product Image'>
                                    <span><i data-feather='check' class='feather-16'></i></span>
                                </a>
                                <h6 class='product-name'><a href='javascript:void(0);'>$product_name</a></h6>
                                <div class='d-flex align-items-center justify-content-between price'>
                                    <div class='d-flex align-items-center'>
                                        <span class='$inventory_class'>$inventory_icon $product_quantity Pcs Left</span>
                                        " . ($product_quantity <= 5 ? "<small class='text-warning ms-1'>($inventory_text)</small>" : "") . "
                                    </div>
                                    <p>KSH $product_price</p>
                                </div>
                                <form method='post' action='' class='add-to-cart-form'>
                                    <input type='hidden' name='id' value='$product_id'>
                                    <input type='hidden' name='name' value='$product_name'>
                                    <input type='hidden' name='price' value='$product_price'>
                                    <input type='hidden' name='image' value='$product_image'>
                                    <button type=' name='add_to_cart' class='btn " . ($product_quantity <= 0 ? 'btn-secondary disabled' : 'btn-primary') . "' " . ($product_quantity <= 0 ? 'disabled' : '') . ">" . ($product_quantity <= 0 ? 'Out of Stock' : 'Add to Cart') . "</button>
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
        <!-- <a class="confirm-text" href="javascript:void(0);"><i data-feather="trash-2"
                class="feather-16 text-danger"></i></a> -->
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
												<option value="0">Select Customer</option>
												<?php
												// Fetch customers from the database
												$sql = "SELECT id, customer_name FROM customers";
												$stmt = $conn->prepare($sql);
												$stmt->execute();
												$result = $stmt->get_result();
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
									Grand Total : KSH 64,024.5
								</a>
							</div>
							<div class="btn-row d-sm-flex align-items-center justify-content-between">
								<a href="javascript:void(0);" class="btn btn-info btn-icon flex-fill"
									data-bs-toggle="modal" data-bs-target="#hold-order"><span
										class="me-1 d-flex align-items-center"><i data-feather="pause"
											class="feather-16"></i></span>Hold</a>

								<a href="javascript:void(0);" class="btn btn-primary btn-icon flex-fill"
									data-bs-toggle="modal" data-bs-target="#pending-orders"><span
										class="me-1 d-flex align-items-center"><i data-feather="clock"
											class="feather-16"></i></span>Pending Orders</a>

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
							<form action="save_order.php" method="POST">
								<!-- Hidden fields for order data -->
								<input type="hidden" id="mpesa_customer_id" name="customer_id">
								<input type="hidden" id="mpesa_employee_id" name="employee_id">
								<input type="hidden" id="mpesa_total_price" name="total_price">
								<input type="hidden" id="mpesa_cart" name="cart">
								<input type="hidden" id="mpesa_transaction_id" name="transaction_id">
								<input type="hidden" id="mpesa_payment_status" name="payment_status" value="pending">
								<input type="hidden" id="mpesa_payment_type" name="payment_type" value="mpesa">
								
								<!-- Customer Info Display -->
								<div class="alert alert-info mb-3" id="mpesa_customer_info_alert" style="display: none;">
									<i class="fas fa-info-circle"></i> 
									<span id="mpesa_customer_info_text">Walk-in customer transaction</span>
								</div>
								
								<div class="mb-3">
									<label class="form-label">Payable Amount</label>
									<input type="number" id="mpesa_total_amount" name="total_amount" readonly class="form-control">
								</div>

								<div class="mb-3">
									<label class="form-label">Safaricom Number</label>
									<input type="number" name="mpesa_number" class="form-control" required>
								</div>

								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Submit Payment</button>
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

                            <!-- Customer Info Display -->
                            <div class="alert alert-info mb-3" id="customer_info_alert" style="display: none;">
                                <i class="fas fa-info-circle"></i> 
                                <span id="customer_info_text">Walk-in customer transaction</span>
                            </div>


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
                     <input type="hidden" id="credit_customer_id" name="customer_id">
                     <input type="hidden" id="credit_employee_id" name="employee_id">
                     <input type="hidden" id="credit_total_price" name="total_price">
                     <input type="hidden" id="credit_cart" name="cart">
                     <input type="hidden" id="credit_transaction_id" name="transaction_id">
                     <input type="hidden" id="credit_payment_status" name="payment_status" value="pending">
                     <input type="hidden" id="credit_payment_type" name="payment_type" value="credit">

                    <div class="icon-head">
                        <a href="javascript:void(0);">
                            <i data-feather="check-circle" class="feather-40"></i>
                        </a>
                    </div>
                    <h4>Confirm Credit Sale</h4>
                    <h5 class="mb-0">Are you sure you want to process this order as a credit sale?</h5>
                    <p class="mb-0">Transactions will successfully be saved in the <strong>Debtors Table</strong>.<br>Customer details will be shown in the Debtors tab for payment tracking.</p>
                    
                    <!-- Customer Information Display -->
                    <div id="credit_customer_info" class="alert alert-info mt-3" style="display: none;">
                        <strong>Customer Information:</strong><br>
                        <span id="credit_customer_name"></span><br>
                        <span id="credit_customer_contact"></span>
                    </div>
                
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
							<button type="button" class="btn btn-primary flex-fill" onclick="showReceipt()">Print Receipt<i
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
        let quantity = cart[id] ? cart[id].quantity + 1 : 1;

        // Check inventory before adding to cart
        $.ajax({
            url: 'check_inventory_before_cart.php',
            type: 'POST',
            data: {
                product_name: name,
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    // Inventory check passed - add to cart
                    if (cart[id]) {
                        cart[id].quantity += 1;
                    } else {
                        cart[id] = { name, price, image, quantity: 1 };
                    }
                    updateCartUI();
                } else {
                    // Show error modal
                    $('#inventory-error-details').text(response.message);
                    $('#inventory-error-modal').modal('show');
                }
            },
            error: function() {
                $('#inventory-error-details').text('Error checking inventory. Please try again.');
                $('#inventory-error-modal').modal('show');
            }
        });
    });

    $(document).on("click", ".inc", function () {
        let id = $(this).closest(".product-list").data("id");
        let newQuantity = cart[id].quantity + 1;
        
        // Check inventory before incrementing
        $.ajax({
            url: 'check_inventory_before_cart.php',
            type: 'POST',
            data: {
                product_name: cart[id].name,
                quantity: newQuantity
            },
            success: function(response) {
                if (response.success) {
                    // Inventory check passed - increment quantity
                    cart[id].quantity += 1;
                    updateCartUI();
                } else {
                    // Show error modal
                    $('#inventory-error-details').text(response.message);
                    $('#inventory-error-modal').modal('show');
                }
            },
            error: function() {
                $('#inventory-error-details').text('Error checking inventory. Please try again.');
                $('#inventory-error-modal').modal('show');
            }
        });
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
        
        // Show helpful message for walk-in customers
        if (selectedValue === "0") {
            console.log("Walk-in customer selected - no customer ID will be recorded");
        }
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

    // Ensure correct values are assigned in the payment forms before submission
    function populatePaymentModal() {
        let customerID = localStorage.getItem("customer_id") || "0";
        let employeeID = localStorage.getItem("employee_id") || "";
        let totalPrice = localStorage.getItem("total_price") || "0";
        let cart = localStorage.getItem("cart") || "{}";
        let transactionID = localStorage.getItem("transactionID") || "";
        
        // Handle walk-in customers - send empty string instead of "0"
        let customerIDForForm = (customerID === "0") ? "" : customerID;
        
        // Populate cash payment modal
        $("#customer_id").val(customerIDForForm);
        $("#employee_id").val(employeeID);
        $("#total_price").val(totalPrice);
        $("#cart").val(cart);
        $("#transaction_id").val(transactionID);
        $("#payment_type").val(selectedPaymentType);
        
        // Populate M-Pesa payment modal
        $("#mpesa_customer_id").val(customerIDForForm);
        $("#mpesa_employee_id").val(employeeID);
        $("#mpesa_total_price").val(totalPrice);
        $("#mpesa_cart").val(cart);
        $("#mpesa_transaction_id").val(transactionID);
        $("#mpesa_total_amount").val(parseFloat(totalPrice).toFixed(2));
        
        // Populate Credit sale modal
        $("#credit_customer_id").val(customerIDForForm);
        $("#credit_employee_id").val(employeeID);
        $("#credit_total_price").val(totalPrice);
        $("#credit_cart").val(cart);
        $("#credit_transaction_id").val(transactionID);

        // Show customer info in payment modals
        if (customerID === "0") {
            $("#customer_info_alert").show();
            $("#customer_info_text").text("Walk-in customer transaction - no customer ID will be recorded");
            $("#mpesa_customer_info_alert").show();
            $("#mpesa_customer_info_text").text("Walk-in customer transaction - no customer ID will be recorded");
        } else {
            $("#customer_info_alert").hide();
            $("#mpesa_customer_info_alert").hide();
        }

        console.log("Payment Modal Data Loaded:", {
            customer_id: customerID,
            employee_id: employeeID,
            total_price: totalPrice,
            products: cart,
            transaction_id: transactionID,
            payment_type: selectedPaymentType
        });
    }

    // Bind modal events for correct data population
    $("#cash, #pay_mpesa").on("show.bs.modal", populatePaymentModal);
    
    // Special handling for credit sale modal
    $("#credit-sale").on("show.bs.modal", function() {
        populatePaymentModal();
        
        // Show customer information for credit sales
        var customerID = localStorage.getItem("selectedCustomer") || "0";
        if (customerID !== "0") {
            // Get customer details from localStorage or make AJAX call
            var customerName = localStorage.getItem("selectedCustomerName") || "Customer";
            var customerPhone = localStorage.getItem("selectedCustomerPhone") || "N/A";
            var customerEmail = localStorage.getItem("selectedCustomerEmail") || "N/A";
            
            $("#credit_customer_name").text("Name: " + customerName);
            $("#credit_customer_contact").text("Phone: " + customerPhone + " | Email: " + customerEmail);
            $("#credit_customer_info").show();
        } else {
            $("#credit_customer_info").hide();
        }
    });
});

// credit sale logic

// $(document).ready(function () {
//     let selectedPaymentType = "credit"; // Default to credit for credit sales

//     $(".complete-credit-sale").click(function () {
//         let transactionID = localStorage.getItem("transactionID") || "";
//         let customerID = localStorage.getItem("selectedCustomer") || "0";
//         let employeeID = localStorage.getItem("employee_id") || "";
//         let totalPrice = localStorage.getItem("total_price") || "0";
//         let cart = JSON.parse(localStorage.getItem("cart")) || {};

//         let orderItems = Object.keys(cart).map(id => ({
//             name: cart[id].name,
//             price: cart[id].price,
//             quantity: cart[id].quantity,
//             image: cart[id].image
//         }));

//         let creditOrderData = {
//             transaction_id: transactionID,
//             customer_id: customerID,
//             employee_id: employeeID,
//             total_price: totalPrice,
//             products: orderItems,
//             payment_status: "pending", // Since it's a credit sale, payment is pending
//             payment_type: selectedPaymentType
//         };

//         console.log("Credit Sale Data:", creditOrderData);

//         $.ajax({
//             url: "save_order.php",
//             type: "POST",
//             contentType: "application/json",
//             data: JSON.stringify(creditOrderData),
//             success: function (response) {
//                 console.log("Response: ", response);
//                 alert("Credit sale recorded successfully!");
//                 localStorage.removeItem("cart");
//                 localStorage.removeItem("total_price");
//                 localStorage.removeItem("transactionID");
//                 localStorage.removeItem("selectedCustomer");
//                 localStorage.removeItem("employeeID");
//                 updateCartUI();
//             },
//             error: function () {
//                 alert("Failed to save credit sale.");
//             }
//         });
//     });

//     function populateCreditModal() {
//         $("#customer_id").val(localStorage.getItem("customer_id") || "");
//         $("#employee_id").val(localStorage.getItem("employee_id") || "");
//         $("#total_price").val(localStorage.getItem("total_price") || "");
//         $("#cart").val(localStorage.getItem("cart") || "");
//         $("#transaction_id").val(localStorage.getItem("transactionID") || "");
//         $("#payment_type").val(selectedPaymentType); // Set as credit

//         console.log("Credit Modal Data Loaded:", {
//             customer_id: $("#customer_id").val(),
//             employee_id: $("#employee_id").val(),
//             total_price: $("#total_price").val(),
//             products: $("#cart").val(),
//             transaction_id: $("#transaction_id").val(),
//             payment_type: $("#payment_type").val()
//         });
//     }

//     $("#credit-sale").on("show.bs.modal", populateCreditModal);
// });


</script>

	<!-- Inventory Error Modal -->
	<div class="modal fade" id="inventory-error-modal" tabindex="-1" aria-labelledby="inventory-error-modal-label" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-danger text-white">
					<h5 class="modal-title" id="inventory-error-modal-label">
						<i data-feather="alert-triangle" class="feather-20 me-2"></i>
						⚠️ Inventory Error - Order Cannot Be Processed
					</h5>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p class="mb-3">The order cannot be completed due to insufficient inventory. Please check and update your stock:</p>
					<div class="alert alert-light border">
						<pre id="inventory-error-details" style="margin: 0; white-space: pre-wrap; font-family: inherit;"></pre>
					</div>
					<div class="mt-3">
						<a href="manage-stocks.php" class="btn btn-primary me-2">
							<i data-feather="package" class="feather-16 me-1"></i>Manage Stock
						</a>
						<a href="recipe.php" class="btn btn-secondary me-2">
							<i data-feather="edit" class="feather-16 me-1"></i>Edit Recipes
						</a>
						<a href="check_missing_ingredients.php" class="btn btn-info">
							<i data-feather="search" class="feather-16 me-1"></i>Check Ingredients
						</a>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Success Modal -->
	<div class="modal fade" id="success-modal" tabindex="-1" aria-labelledby="success-modal-label" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-success text-white">
					<h5 class="modal-title" id="success-modal-label">
						<i data-feather="check-circle" class="feather-20 me-2"></i>
						✅ Order Completed Successfully!
					</h5>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p id="success-message">Your order has been processed and inventory has been updated.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" data-bs-dismiss="modal">Continue</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Error Modal -->
	<div class="modal fade" id="error-modal" tabindex="-1" aria-labelledby="error-modal-label" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-warning text-dark">
					<h5 class="modal-title" id="error-modal-label">
						<i data-feather="alert-circle" class="feather-20 me-2"></i>
						⚠️ Order Error
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p id="error-message">There was an error processing your order. Please try again.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		// Handle modal content population
		$(document).ready(function() {
			// Inventory Error Modal
			$('#inventory-error-modal').on('show.bs.modal', function() {
				var errorMessage = localStorage.getItem('pos_error');
				if (errorMessage) {
					$('#inventory-error-details').text(errorMessage);
				}
			});

			// Success Modal
			$('#success-modal').on('show.bs.modal', function() {
				var successMessage = localStorage.getItem('pos_success');
				if (successMessage) {
					$('#success-message').text(successMessage);
				}
			});

			// Error Modal
			$('#error-modal').on('show.bs.modal', function() {
				var errorMessage = localStorage.getItem('pos_error');
				if (errorMessage) {
					$('#error-message').text(errorMessage);
				}
			});

			// Clear localStorage after showing modals
			$('#inventory-error-modal, #success-modal, #error-modal').on('hidden.bs.modal', function() {
				localStorage.removeItem('pos_error');
				localStorage.removeItem('pos_error_type');
				localStorage.removeItem('pos_success');
			});
		});

		// Function to mark notification as read
		function markNotificationAsRead(notificationId) {
			$.ajax({
				url: 'mark_notification_read.php',
				type: 'POST',
				data: { notification_id: notificationId },
				success: function(response) {
					// Reload the page to update notification count
					location.reload();
				},
				error: function() {
					console.log('Error marking notification as read');
				}
			});
		}

		// Function to show receipt
		function showReceipt() {
			var transactionId = localStorage.getItem('receipt_transaction_id');
			var orderId = localStorage.getItem('receipt_order_id');
			
			if (transactionId && orderId) {
				// Close success modal
				$('#success-modal').modal('hide');
				
				// Load receipt data and show receipt modal
				loadReceiptData(transactionId, orderId);
				$('#print-receipt').modal('show');
				
				// Clear receipt data from localStorage
				localStorage.removeItem('receipt_transaction_id');
				localStorage.removeItem('receipt_order_id');
			} else {
				alert('Receipt data not available. Please try again.');
			}
		}
	</script>

</body>

</html>
<script src="https://cdn.tiny.cloud/1/4t1ov4q8dvcsifzo1wm9jqi5p6v5x5t27eepjy09kbo8ldby/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>