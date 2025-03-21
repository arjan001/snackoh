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
									<span>Transaction ID : #65565</span>
								</div>
								<div class="">
									<a class="confirm-text" href="javascript:void(0);"><i data-feather="trash-2"
											class="feather-16 text-danger"></i></a>
									<a href="javascript:void(0);" class="text-default"><i data-feather="more-vertical"
											class="feather-16"></i></a>
								</div>
							</div>


							<div class="product-added block-section">
								<div class="head-text d-flex align-items-center justify-content-between">
									<h6 class="d-flex align-items-center mb-0">Product Added<span class="count">2</span>
									</h6>
									<a href="javascript:void(0);" class="d-flex align-items-center text-danger"><span
											class="me-1"><i data-feather="x" class="feather-16"></i></span>Clear all</a>
								</div>
								<div class="product-wrap">
									<div class="product-list d-flex align-items-center justify-content-between">
										<div class="d-flex align-items-center product-info" data-bs-toggle="modal"
											data-bs-target="#products">
											<a href="javascript:void(0);" class="img-bg">
												<img src="assets/img/profiles/avator1.jpg" alt="Products">
											</a>
											<div class="info">
												<span>PT0005</span>
												<h6><a href="javascript:void(0);">Kaimati</a></h6>
												<p>KSH 2000</p>
											</div>
										</div>
										<div class="qty-item text-center">
											<a href="javascript:void(0);"
												class="dec d-flex justify-content-center align-items-center"
												data-bs-toggle="tooltip" data-bs-placement="top" title="minus"><i
													data-feather="minus-circle" class="feather-14"></i></a>
											<input type="text" class="form-control text-center" name="qty" value="4">
											<a href="javascript:void(0);"
												class="inc d-flex justify-content-center align-items-center"
												data-bs-toggle="tooltip" data-bs-placement="top" title="plus"><i
													data-feather="plus-circle" class="feather-14"></i></a>
										</div>
										<div class="d-flex align-items-center action">

											<a class="btn-icon delete-icon confirm-text" href="javascript:void(0);">
												<i data-feather="trash-2" class="feather-14"></i>
											</a>
										</div>
									</div>



								</div>
							</div>
							<div class="block-section">
								<div class="selling-info">
									<div class="row">


									</div>
								</div>

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


								<div class="order-total">
									<table class="table table-responsive table-borderless">

										<tr>
											<td>Sub Total</td>
											<td class="text-end">KSH 60,454</td>
										</tr>
										<tr>
											<td class="danger">Discount (10%)</td>
											<td class="danger text-end">KSH 15.21</td>
										</tr>
										<tr>
											<td>Total</td>
											<td class="text-end">KSH 64,024.5</td>
										</tr>
									</table>
								</div>
							</div>

							<div class="block-section payment-method">
								<h6>Payment Method</h6>
								<div class="row d-flex align-items-center justify-content-center methods">
									<div class="col-md-6 col-lg-4 item">
										<div class="default-cover">
											<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#cash">
												<img src="assets/img/icons/cash-pay.svg" alt="Payment Method">
												<span>Cash</span>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-lg-4 item">
										<div class="default-cover">
											<a href="javascript:void(0);">
												<img src="assets/img/icons/credit-card.svg" alt="Payment Method">
												<span>Debit Card</span>
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

	<!--CASH PAYMENT Modal -->
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
							<form action="save_user.php" method="POST">
								<div class="row">


									<!-- User Role Selection -->


									<!-- CASH PAID -->
									<div class="col-lg-6 mt-4">
										<div class="input-blocks">
											<label>AMOUNT GIVEN</label>
											<div class="pass-group">
												<input type="number" class="form-control" name="password" required>
												<!-- <span class="fas toggle-password fa-eye-slash"></span> -->
											</div>
										</div>
									</div>

									<!-- CASH PAID  BALANCE -->
									<div class="col-lg-6 mt-4">
										<div class="input-blocks">
											<label>CHANGE GIVEN</label>
											<div class="pass-group">
												<input type="number" class="form-control" readonly name="">
												<!-- <span class="fas toggle-password fa-eye-slash"></span> -->
											</div>
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
	<!-- CASH PAYMENT Modal -->


	<!-- Payment Completed -->
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
	<!-- /Payment Completed -->

	<!-- Print Receipt -->
	<div class="modal fade modal-default" id="print-receipt" aria-labelledby="print-receipt">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="d-flex justify-content-end">
					<button type="button" class="close p-0" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="icon-head text-center">
						<a href="javascript:void(0);">
							<img src="assets/img/logo.png" width="100" height="30" alt="Receipt Logo">
						</a>
					</div>
					<div class="text-center info text-center">
						<h6>Snackoh Bakers</h6>
						<p class="mb-0">Phone Number: +1 5656665656</p>
						<p class="mb-0">Email: <a href="mailto:info@SnackohBakers.co.ke">info@SnackohBakers.co.ke</a>
						</p>
					</div>
					<div class="tax-invoice">
						<h6 class="text-center">Tax Invoice</h6>
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<div class="invoice-user-name"><span>Name: </span><span>John Doe</span></div>
								<div class="invoice-user-name"><span>Invoice No: </span><span>CS132453</span></div>
							</div>
							<div class="col-sm-12 col-md-6">
								<div class="invoice-user-name"><span>Customer Id: </span><span>#LL93784</span></div>
								<div class="invoice-user-name"><span>Date: </span><span>02.02.2025</span></div>
							</div>
						</div>
					</div>
					<table class="table-borderless w-100 table-fit">
						<thead>
							<tr>
								<th># Item</th>
								<th>Price</th>
								<th>Qty</th>
								<th class="text-end">Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1. Bread white (400g)</td>
								<td>KSH 50</td>
								<td>3</td>
								<td class="text-end">KSH150</td>
							</tr>
							<tr>
								<td>2. Bread yellow (400g)</td>
								<td>KSH 50</td>
								<td>2</td>
								<td class="text-end">KSH100</td>
							</tr>
							<tr>
								<td>3. Doughnuts</td>
								<td>KSH 50</td>
								<td>3</td>
								<td class="text-end">KSH150</td>
							</tr>
							<tr>
								<td colspan="4">
									<table class="table-borderless w-100 table-fit">
										<tr>
											<td>Sub Total :</td>
											<td class="text-end">KSH 700.00</td>
										</tr>
										<tr>
											<td>Discount :</td>
											<td class="text-end">-KSH 50.00</td>
										</tr>
										<tr>
											<td>Shipping :</td>
											<td class="text-end">0.00</td>
										</tr>
										<tr>
											<td>Tax (5%) :</td>
											<td class="text-end">KSH 5.00</td>
										</tr>
										<tr>
											<td>Total Bill :</td>
											<td class="text-end">KSH 655.00</td>
										</tr>
										<tr>
											<td>Due :</td>
											<td class="text-end">KSH 0.00</td>
										</tr>
										<tr>
											<td>Total Payable :</td>
											<td class="text-end">KSH 655.00</td>
										</tr>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="text-center invoice-bar">
						<p>**VAT against this challan is payable through central registration. Thank you for your
							business!</p>
						<a href="javascript:void(0);">
							<img src="assets/img/barcode/barcode-03.jpg" alt="Barcode">
						</a>
						<p>Sale 31</p>
						<p>Thank You For Shopping With Us. Please Come Again</p>
						<a href="javascript:void(0);" class="btn btn-primary">Print Receipt</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Print Receipt -->

	<!-- Products -->
	<div class="modal fade modal-default pos-modal" id="products" aria-labelledby="products">
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
	</div>
	<!-- /Products -->

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
	<div class="modal fade modal-default pos-modal" id="hold-order" aria-labelledby="hold-order">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header p-4">
					<h5>Hold order</h5>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body p-4">
					<form action="pos.html">
						<h2 class="text-center p-4">KSH 4500.00</h2>
						<div class="input-block">
							<label>Order Reference</label>
							<input class="form-control" type="text" value="" placeholder="">
						</div>
						<p>The current order will be set on hold. You can retreive this order from the pending order
							button. Providing a reference to it might help you to identify the order more quickly.</p>
						<div class="modal-footer d-sm-flex justify-content-end">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Confirm</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /Hold -->


	<!-- Recent Transactions -->
	<div class="modal fade pos-modal" id="recents" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header p-4">
					<h5 class="modal-title">Recent Transactions</h5>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body p-4">
					<div class="tabs-sets">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="purchase-tab" data-bs-toggle="tab"
									data-bs-target="#purchase" type="button" aria-controls="purchase"
									aria-selected="true" role="tab">Purchase</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment"
									type="button" aria-controls="payment" aria-selected="false"
									role="tab">Payment</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="return-tab" data-bs-toggle="tab" data-bs-target="#return"
									type="button" aria-controls="return" aria-selected="false"
									role="tab">Return</button>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade show active" id="purchase" role="tabpanel"
								aria-labelledby="purchase-tab">
								<div class="table-top">
									<div class="search-set">
										<div class="search-input">
											<a class="btn btn-searchset d-flex align-items-center h-100"><img
													src="assets/img/icons/search-white.svg" alt="img"></a>
										</div>
									</div>
									<div class="wordset">
										<ul>
											<li>
												<a class="d-flex align-items-center justify-content-center"
													data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
														src="assets/img/icons/pdf.svg" alt="img"></a>
											</li>
											<li>
												<a class="d-flex align-items-center justify-content-center"
													data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
														src="assets/img/icons/excel.svg" alt="img"></a>
											</li>
											<li>
												<a class="d-flex align-items-center justify-content-center"
													data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i
														data-feather="printer" class="feather-rotate-ccw"></i></a>
											</li>
										</ul>
									</div>
								</div>
								<div class="table-responsive">
									<table class="table datanew">
										<thead>
											<tr>
												<th>Date</th>
												<th>Reference</th>
												<th>Customer</th>
												<th>Amount </th>
												<th class="no-sort">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0101</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0102</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0103</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0104</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0105</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0106</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0107</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="tab-pane fade" id="payment" role="tabpanel">
								<div class="table-top">
									<div class="search-set">
										<div class="search-input">
											<a class="btn btn-searchset d-flex align-items-center h-100"><img
													src="assets/img/icons/search-white.svg" alt="img"></a>
										</div>
									</div>
									<div class="wordset">
										<ul>
											<li>
												<a class="d-flex align-items-center justify-content-center"
													data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
														src="assets/img/icons/pdf.svg" alt="img"></a>
											</li>
											<li>
												<a class="d-flex align-items-center justify-content-center"
													data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
														src="assets/img/icons/excel.svg" alt="img"></a>
											</li>
											<li>
												<a class="d-flex align-items-center justify-content-center"
													data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i
														data-feather="printer" class="feather-rotate-ccw"></i></a>
											</li>
										</ul>
									</div>
								</div>
								<div class="table-responsive">
									<table class="table datanew">
										<thead>
											<tr>
												<th>Date</th>
												<th>Reference</th>
												<th>Customer</th>
												<th>Amount </th>
												<th class="no-sort">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0101</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0102</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0103</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0104</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0105</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0106</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0107</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="tab-pane fade" id="return" role="tabpanel">
								<div class="table-top">
									<div class="search-set">
										<div class="search-input">
											<a class="btn btn-searchset d-flex align-items-center h-100"><img
													src="assets/img/icons/search-white.svg" alt="img"></a>
										</div>
									</div>
									<div class="wordset">
										<ul>
											<li>
												<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"
													class="d-flex align-items-center justify-content-center"><img
														src="assets/img/icons/pdf.svg" alt="img"></a>
											</li>
											<li>
												<a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"
													class="d-flex align-items-center justify-content-center"><img
														src="assets/img/icons/excel.svg" alt="img"></a>
											</li>
											<li>
												<a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"
													class="d-flex align-items-center justify-content-center"><i
														data-feather="printer" class="feather-rotate-ccw"></i></a>
											</li>
										</ul>
									</div>
								</div>
								<div class="table-responsive">
									<table class="table datanew">
										<thead>
											<tr>
												<th>Date</th>
												<th>Reference</th>
												<th>Customer</th>
												<th>Amount </th>
												<th class="no-sort">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0101</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0102</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0103</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0104</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0105</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0106</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>19 Jan 2023</td>
												<td>INV/SL0107</td>
												<td>Walk-in Customer</td>
												<td>$1500.00</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="eye" class="feather-eye"></i></a>
														<a class="me-2 p-2" href="javascript:void(0);"><i
																data-feather="edit" class="feather-edit"></i></a>
														<a class="p-2 confirm-text" href="javascript:void(0);"><i
																data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Recent Transactions -->

	<!-- Recent Transactions -->
	<div class="modal fade pos-modal" id="orders" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-md modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header p-4">
					<h5 class="modal-title">Orders</h5>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body p-4">
					<div class="tabs-sets">
						<ul class="nav nav-tabs" id="myTabs" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="onhold-tab" data-bs-toggle="tab"
									data-bs-target="#onhold" type="button" aria-controls="onhold" aria-selected="true"
									role="tab">Onhold</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="unpaid-tab" data-bs-toggle="tab" data-bs-target="#unpaid"
									type="button" aria-controls="unpaid" aria-selected="false"
									role="tab">Unpaid</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="paid-tab" data-bs-toggle="tab" data-bs-target="#paid"
									type="button" aria-controls="paid" aria-selected="false" role="tab">Paid</button>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade show active" id="onhold" role="tabpanel"
								aria-labelledby="onhold-tab">
								<div class="table-top">
									<div class="search-set w-100 search-order">
										<div class="search-input w-100">
											<a class="btn btn-searchset d-flex align-items-center h-100"><img
													src="assets/img/icons/search-white.svg" alt="img"></a>
										</div>
									</div>
								</div>
								<div class="order-body">
									<div class="default-cover p-4 mb-4">
										<span class="badge bg-secondary d-inline-block mb-4">Order ID : #666659</span>
										<div class="row">
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr class="mb-3">
														<td>Cashier</td>
														<td class="colon">:</td>
														<td class="text">admin</td>
													</tr>
													<tr>
														<td>Customer</td>
														<td class="colon">:</td>
														<td class="text">Botsford</td>
													</tr>
												</table>
											</div>
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr>
														<td>Total</td>
														<td class="colon">:</td>
														<td class="text">$900</td>
													</tr>
													<tr>
														<td>Date</td>
														<td class="colon">:</td>
														<td class="text">29-08-2023 13:39:11</td>
													</tr>
												</table>
											</div>
										</div>
										<p class="p-4">Customer need to recheck the product once</p>
										<div class="btn-row d-sm-flex align-items-center justify-content-between">
											<a href="javascript:void(0);"
												class="btn btn-info btn-icon flex-fill">Open</a>
											<a href="javascript:void(0);"
												class="btn btn-danger btn-icon flex-fill">Products</a>
											<a href="javascript:void(0);"
												class="btn btn-success btn-icon flex-fill">Print</a>
										</div>
									</div>
									<div class="default-cover p-4 mb-4">
										<span class="badge bg-secondary d-inline-block mb-4">Order ID : #666660</span>
										<div class="row">
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr class="mb-3">
														<td>Cashier</td>
														<td class="colon">:</td>
														<td class="text">admin</td>
													</tr>
													<tr>
														<td>Customer</td>
														<td class="colon">:</td>
														<td class="text">Smith</td>
													</tr>
												</table>
											</div>
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr>
														<td>Total</td>
														<td class="colon">:</td>
														<td class="text">$15000</td>
													</tr>
													<tr>
														<td>Date</td>
														<td class="colon">:</td>
														<td class="text">30-08-2023 15:59:11</td>
													</tr>
												</table>
											</div>
										</div>
										<p class="p-4">Customer need to recheck the product once</p>
										<div class="btn-row d-flex align-items-center justify-content-between">
											<a href="javascript:void(0);"
												class="btn btn-info btn-icon flex-fill">Open</a>
											<a href="javascript:void(0);"
												class="btn btn-danger btn-icon flex-fill">Products</a>
											<a href="javascript:void(0);"
												class="btn btn-success btn-icon flex-fill">Print</a>
										</div>
									</div>
									<div class="default-cover p-4">
										<span class="badge bg-secondary d-inline-block mb-4">Order ID : #666661</span>
										<div class="row">
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr class="mb-3">
														<td>Cashier</td>
														<td class="colon">:</td>
														<td class="text">admin</td>
													</tr>
													<tr>
														<td>Customer</td>
														<td class="colon">:</td>
														<td class="text">John David</td>
													</tr>
												</table>
											</div>
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr>
														<td>Total</td>
														<td class="colon">:</td>
														<td class="text">$2000</td>
													</tr>
													<tr>
														<td>Date</td>
														<td class="colon">:</td>
														<td class="text">01-09-2023 13:15:00</td>
													</tr>
												</table>
											</div>
										</div>
										<p class="p-4 mb-4">Customer need to recheck the product once</p>
										<div class="btn-row d-flex align-items-center justify-content-between">
											<a href="javascript:void(0);"
												class="btn btn-info btn-icon flex-fill">Open</a>
											<a href="javascript:void(0);"
												class="btn btn-danger btn-icon flex-fill">Products</a>
											<a href="javascript:void(0);"
												class="btn btn-success btn-icon flex-fill">Print</a>
										</div>
									</div>
								</div>

							</div>
							<div class="tab-pane fade" id="unpaid" role="tabpanel">
								<div class="table-top">
									<div class="search-set w-100 search-order">
										<div class="search-input">
											<a class="btn btn-searchset d-flex align-items-center h-100"><img
													src="assets/img/icons/search-white.svg" alt="img"></a>
										</div>
									</div>

								</div>
								<div class="order-body">
									<div class="default-cover p-4 mb-4">
										<span class="badge bg-info d-inline-block mb-4">Order ID : #666662</span>
										<div class="row">
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr class="mb-3">
														<td>Cashier</td>
														<td class="colon">:</td>
														<td class="text">admin</td>
													</tr>
													<tr>
														<td>Customer</td>
														<td class="colon">:</td>
														<td class="text">Anastasia</td>
													</tr>
												</table>
											</div>
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr>
														<td>Total</td>
														<td class="colon">:</td>
														<td class="text">$2500</td>
													</tr>
													<tr>
														<td>Date</td>
														<td class="colon">:</td>
														<td class="text">10-09-2023 17:15:11</td>
													</tr>
												</table>
											</div>
										</div>
										<p class="p-4">Customer need to recheck the product once</p>
										<div class="btn-row d-flex align-items-center justify-content-between">
											<a href="javascript:void(0);"
												class="btn btn-info btn-icon flex-fill">Open</a>
											<a href="javascript:void(0);"
												class="btn btn-danger btn-icon flex-fill">Products</a>
											<a href="javascript:void(0);"
												class="btn btn-success btn-icon flex-fill">Print</a>
										</div>
									</div>
									<div class="default-cover p-4 mb-4">
										<span class="badge bg-info d-inline-block mb-4">Order ID : #666663</span>
										<div class="row">
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr class="mb-3">
														<td>Cashier</td>
														<td class="colon">:</td>
														<td class="text">admin</td>
													</tr>
													<tr>
														<td>Customer</td>
														<td class="colon">:</td>
														<td class="text">Lucia</td>
													</tr>
												</table>
											</div>
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr>
														<td>Total</td>
														<td class="colon">:</td>
														<td class="text">$1500</td>
													</tr>
													<tr>
														<td>Date</td>
														<td class="colon">:</td>
														<td class="text">11-09-2023 14:50:11</td>
													</tr>
												</table>
											</div>
										</div>
										<p class="p-4">Customer need to recheck the product once</p>
										<div class="btn-row d-flex align-items-center justify-content-between">
											<a href="javascript:void(0);"
												class="btn btn-info btn-icon flex-fill">Open</a>
											<a href="javascript:void(0);"
												class="btn btn-danger btn-icon flex-fill">Products</a>
											<a href="javascript:void(0);"
												class="btn btn-success btn-icon flex-fill">Print</a>
										</div>
									</div>
									<div class="default-cover p-4 mb-4">
										<span class="badge bg-info d-inline-block mb-4">Order ID : #666664</span>
										<div class="row">
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr class="mb-3">
														<td>Cashier</td>
														<td class="colon">:</td>
														<td class="text">admin</td>
													</tr>
													<tr>
														<td>Customer</td>
														<td class="colon">:</td>
														<td class="text">Diego</td>
													</tr>
												</table>
											</div>
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr>
														<td>Total</td>
														<td class="colon">:</td>
														<td class="text">$30000</td>
													</tr>
													<tr>
														<td>Date</td>
														<td class="colon">:</td>
														<td class="text">12-09-2023 17:22:11</td>
													</tr>
												</table>
											</div>
										</div>
										<p class="p-4 mb-4">Customer need to recheck the product once</p>
										<div class="btn-row d-flex align-items-center justify-content-between">
											<a href="javascript:void(0);"
												class="btn btn-info btn-icon flex-fill">Open</a>
											<a href="javascript:void(0);"
												class="btn btn-danger btn-icon flex-fill">Products</a>
											<a href="javascript:void(0);"
												class="btn btn-success btn-icon flex-fill">Print</a>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="paid" role="tabpanel">
								<div class="table-top">
									<div class="search-set w-100 search-order">
										<div class="search-input">
											<a class="btn btn-searchset d-flex align-items-center h-100"><img
													src="assets/img/icons/search-white.svg" alt="img"></a>
										</div>
									</div>
								</div>
								<div class="order-body">
									<div class="default-cover p-4 mb-4">
										<span class="badge bg-primary d-inline-block mb-4">Order ID : #666665</span>
										<div class="row">
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr class="mb-3">
														<td>Cashier</td>
														<td class="colon">:</td>
														<td class="text">admin</td>
													</tr>
													<tr>
														<td>Customer</td>
														<td class="colon">:</td>
														<td class="text">Hugo</td>
													</tr>
												</table>
											</div>
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr>
														<td>Total</td>
														<td class="colon">:</td>
														<td class="text">$5000</td>
													</tr>
													<tr>
														<td>Date</td>
														<td class="colon">:</td>
														<td class="text">13-09-2023 19:39:11</td>
													</tr>
												</table>
											</div>
										</div>
										<p class="p-4">Customer need to recheck the product once</p>
										<div class="btn-row d-flex align-items-center justify-content-between">
											<a href="javascript:void(0);"
												class="btn btn-info btn-icon flex-fill">Open</a>
											<a href="javascript:void(0);"
												class="btn btn-danger btn-icon flex-fill">Products</a>
											<a href="javascript:void(0);"
												class="btn btn-success btn-icon flex-fill">Print</a>
										</div>
									</div>
									<div class="default-cover p-4 mb-4">
										<span class="badge bg-primary d-inline-block mb-4">Order ID : #666666</span>
										<div class="row">
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr class="mb-3">
														<td>Cashier</td>
														<td class="colon">:</td>
														<td class="text">admin</td>
													</tr>
													<tr>
														<td>Customer</td>
														<td class="colon">:</td>
														<td class="text">Antonio</td>
													</tr>
												</table>
											</div>
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr>
														<td>Total</td>
														<td class="colon">:</td>
														<td class="text">$7000</td>
													</tr>
													<tr>
														<td>Date</td>
														<td class="colon">:</td>
														<td class="text">15-09-2023 18:39:11</td>
													</tr>
												</table>
											</div>
										</div>
										<p class="p-4">Customer need to recheck the product once</p>
										<div class="btn-row d-flex align-items-center justify-content-between">
											<a href="javascript:void(0);"
												class="btn btn-info btn-icon flex-fill">Open</a>
											<a href="javascript:void(0);"
												class="btn btn-danger btn-icon flex-fill">Products</a>
											<a href="javascript:void(0);"
												class="btn btn-success btn-icon flex-fill">Print</a>
										</div>
									</div>
									<div class="default-cover p-4 mb-4">
										<span class="badge bg-primary d-inline-block mb-4">Order ID : #666667</span>
										<div class="row">
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr class="mb-3">
														<td>Cashier</td>
														<td class="colon">:</td>
														<td class="text">admin</td>
													</tr>
													<tr>
														<td>Customer</td>
														<td class="colon">:</td>
														<td class="text">MacQuoid</td>
													</tr>
												</table>
											</div>
											<div class="col-sm-12 col-md-6 record mb-3">
												<table>
													<tr>
														<td>Total</td>
														<td class="colon">:</td>
														<td class="text">$7050</td>
													</tr>
													<tr>
														<td>Date</td>
														<td class="colon">:</td>
														<td class="text">17-09-2023 19:39:11</td>
													</tr>
												</table>
											</div>
										</div>
										<p class="p-4 mb-4">Customer need to recheck the product once</p>
										<div class="btn-row d-flex align-items-center justify-content-between">
											<a href="javascript:void(0);"
												class="btn btn-info btn-icon flex-fill">Open</a>
											<a href="javascript:void(0);"
												class="btn btn-danger btn-icon flex-fill">Products</a>
											<a href="javascript:void(0);"
												class="btn btn-success btn-icon flex-fill">Print</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Recent Transactions -->




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

	<script>
		// Function to load products based on the selected category
		function loadProducts(categorySlug) {
			// Show loading indicator or message
			document.getElementById('product-list').innerHTML = 'Loading...';

			let categoryId = categorySlug === 'all' ? '' : categorySlug; // Set category ID or empty for 'all'

			// Fetch products using AJAX
			fetch(`insert-product.php?category=${categoryId}`)
				.then(response => response.json())
				.then(data => {
					let productHTML = '';
					if (data.length > 0) {
						data.forEach(product => {
							// Build the product HTML structure
							productHTML += `
						<div class="product">
							<img src="${product.product_image}" alt="${product.product_name}" class="product-image">
							<h4>${product.product_name}</h4>
							<p>${product.product_description ? product.product_description : 'No description available'}</p>
							<span class="product-price">$${product.product_price}</span>
						</div>
					`;
						});
					} else {
						productHTML = '<p>No products found for this category.</p>';
					}
					// Update the product list display
					document.getElementById('product-list').innerHTML = productHTML;
				})
				.catch(error => {
					console.error('Error fetching products:', error);
					document.getElementById('product-list').innerHTML = 'Error loading products.';
				});
		}


		// document.addEventListener("DOMContentLoaded", function () {
		//     let cart = [];

		//     function updateCart() {
		//         let cartContainer = document.querySelector(".product-wrap");
		//         cartContainer.innerHTML = "";

		//         cart.forEach((item, index) => {
		//             let productHTML = `
		//                 <div class="product-list d-flex align-items-center justify-content-between" data-index="${index}">
		//                     <div class="d-flex align-items-center product-info">
		//                         <a href="javascript:void(0);" class="img-bg">
		//                             <img src="${item.image}" alt="Products">
		//                         </a>
		//                         <div class="info">
		//                             <span>${item.code}</span>
		//                             <h6><a href="javascript:void(0);">${item.name}</a></h6>
		//                             <p>KSH <span class="price">${item.price * item.quantity}</span></p>
		//                         </div>
		//                     </div>
		//                     <div class="qty-item text-center">
		//                         <a href="javascript:void(0);" class="dec d-flex justify-content-center align-items-center" data-action="decrease">
		//                             <i data-feather="minus-circle" class="feather-14"></i>
		//                         </a>
		//                         <input type="text" class="form-control text-center quantity" value="${item.quantity}" readonly>
		//                         <a href="javascript:void(0);" class="inc d-flex justify-content-center align-items-center" data-action="increase">
		//                             <i data-feather="plus-circle" class="feather-14"></i>
		//                         </a>
		//                     </div>
		//                     <div class="d-flex align-items-center action">
		//                         <a class="btn-icon delete-icon confirm-text" href="javascript:void(0);" data-action="remove">
		//                             <i data-feather="trash-2" class="feather-14"></i>
		//                         </a>
		//                     </div>
		//                 </div>
		//             `;
		//             cartContainer.insertAdjacentHTML("beforeend", productHTML);
		//         });

		//         updateTotal();
		//         feather.replace(); // Refresh icons
		//     }

		//     function updateTotal() {
		//         let total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
		//         document.querySelector(".order-total .text-end").innerText = `KSH ${total.toLocaleString()}`;
		//     }

		//     document.querySelectorAll(".product-info").forEach((product) => {
		//         product.addEventListener("click", function () {
		//             let productData = {
		//                 name: this.querySelector("h6").innerText,
		//                 price: parseInt(this.querySelector("p").innerText.replace("KSH ", "")),
		//                 code: this.querySelector("span").innerText,
		//                 image: this.querySelector("img").src,
		//                 quantity: 1
		//             };

		//             let existingItem = cart.find(item => item.code === productData.code);
		//             if (existingItem) {
		//                 existingItem.quantity++;
		//             } else {
		//                 cart.push(productData);
		//             }

		//             updateCart();
		//         });
		//     });

		//     document.querySelector(".product-wrap").addEventListener("click", function (e) {
		//         let target = e.target.closest("a");
		//         if (!target) return;

		//         let parent = target.closest(".product-list");
		//         let index = parseInt(parent.getAttribute("data-index"));

		//         if (target.dataset.action === "increase") {
		//             cart[index].quantity++;
		//         } else if (target.dataset.action === "decrease") {
		//             if (cart[index].quantity > 1) {
		//                 cart[index].quantity--;
		//             } else {
		//                 cart.splice(index, 1);
		//             }
		//         } else if (target.dataset.action === "remove") {
		//             cart.splice(index, 1);
		//         }

		//         updateCart();
		//     });
		// });

	</script>


</body>

</html>