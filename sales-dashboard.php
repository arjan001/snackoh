<?php 
include_once "./includes/session_check.php"

?>	
<!DOCTYPE html>
<html lang="en">
	<?php include 'includes/header.php';?>
	
	<body>
		<!-- <div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div>  -->
		<!-- Main Wrapper -->
		<div class="main-wrapper">

			<!-- Header -->
			<?php include 'includes/navbar.php';?>
			<!-- /Header -->
			
			<!-- Sidebar -->
			<?php include 'includes/sidebar.php';?>
			<!-- /Sidebar -->

	

			<div class="page-wrapper">
				<div class="content">
					<div class="welcome d-lg-flex align-items-center justify-content-between">
						<div class="d-flex align-items-center welcome-text">
						<?php 
    // Retrieve user data from session
$full_name = $_SESSION['full_name'] ?? 'Guest User';
$role = $_SESSION['user_role'] ?? 'Guest';
?>
							<h3 class="d-flex align-items-center"><img src="assets/img/icons/hi.svg" alt="img">&nbsp;Hi <?= htmlspecialchars($full_name); ?>,</h3>&nbsp;<h6>here's what's happening with your store today.</h6>
						</div>
						<div class="d-flex align-items-center">
							<div class="position-relative daterange-wraper me-2">
								<div class="input-groupicon calender-input">
									<input type="text" class="form-control  date-range bookingrange" placeholder="Select" value="13 Aug 1992">
								</div>
								<i data-feather="calendar" class="feather-14"></i>
							</div>
							<button type="button" data-toggle="tooltip" class="btn btn-white-outline d-none d-md-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-16"></i></button>
							<a href="#" class="d-none d-lg-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-16"></i></a>
						</div>
					</div>
					<div class="row sales-cards">
						<div class="col-xl-6 col-sm-12 col-12">
							<div class="card d-flex align-items-center justify-content-between default-cover mb-4">
								<div>
									<h6>Weekly Earning</h6>
									<h3>KSH <span class="counters" data-count="95000.45">95000.45</span></h3>
									<p class="sales-range"><span class="text-success"><i data-feather="chevron-up" class="feather-16"></i>48%&nbsp;</span>increase compare to last week</p>
								</div>
								<img src="assets/img/icons/weekly-earning.svg" alt="img">
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<?php
include_once "./config/config.php";

// Fetch total sales amount
$sql = "SELECT SUM(total_price) AS total_sales FROM orders";
$result = $conn->query($sql);
$total_sales = 0.00;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_sales = (float) ($row['total_sales'] ?? 0.00);
}
?>
							<div class="card color-info bg-primary mb-4">
								<img src="assets/img/icons/total-sales.svg" alt="img">
								<h3>KSH <span class="counters" data-count="<?php echo $total_sales; ?>">
        <?php echo "KSH " . number_format($total_sales, 2); ?>
    </span></h3>
								<p>No of Total  Store Sales</p>
								<i data-feather="rotate-ccw" class="feather-16" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"></i>
							</div>
						</div>


						<div class="col-xl-3 col-sm-6 col-12">
						<?php
include_once "./config/config.php";

// Fetch total sales amount
$sql = "SELECT SUM(total_price) AS online_sales FROM orders WHERE chanel='online' ";
$result = $conn->query($sql);
$online_sales = 0.00;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_sales = (float) ($row['online_sales'] ?? 0.00);
}
?>
							<div class="card color-info bg-secondary mb-4">
								<img src="assets/img/icons/purchased-earnings.svg" alt="img">
								<h3>KSH <span class="counters" data-count="<?php echo $total_sales; ?>">
        <?php echo "KSH " . number_format($online_sales, 2); ?>
    </span></h3>
								<p>No of  Online Total Sales</p>
								<i data-feather="rotate-ccw" class="feather-16" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"></i>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-12 col-md-12 col-xl-4 d-flex">
							<div class="card flex-fill default-cover w-100 mb-4">
								<div class="card-header d-flex justify-content-between align-items-center">
									<h4 class="card-title mb-0">Best Seller</h4>
									<div class="dropdown">
										<a href="javascript:void(0);" class="view-all d-flex align-items-center">
											View All<span class="ps-2 d-flex align-items-center"><i data-feather="arrow-right" class="feather-16"></i></span>
										</a>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-borderless best-seller">
											<tbody>
												<tr>
													<td>
														<div class="product-info">
															
															<div class="info">
																<a href="product-list.html">white Bread 400gms</a>
																<p class="dull-text">KSH 4420</p>
															</div>
														</div>
													</td>
													<td>
														<p class="head-text">Sales</p>
														6547
													</td>
												</tr>
												<tr>
													<td>
														<div class="product-info">
															
															<div class="info">
																<a href="product-list.html">Kaimati</a>
																<p class="dull-text">KSH 1474</p>
															</div>
														</div>
													</td>
													<td>
														<p class="head-text">Sales</p>
														3474
													</td>
												</tr>
												<tr>
													<td>
														<div class="product-info">
															
															<div class="info">
																<a href="product-list.html">Dryfcons</a>
																<p class="dull-text">KSH 8784</p>
															</div>
														</div>
													</td>
													<td>
														<p class="head-text">Sales</p>
														1478
													</td>
												</tr>
												<tr>
													<td>
														<div class="product-info">
															
															<div class="info">
																<a href="product-list.html">White bread 400gms</a>
																<p class="dull-text">KSH 3240</p>
															</div>
														</div>
													</td>
													<td>
														<p class="head-text">Sales</p>
														987
													</td>
												</tr>
												<tr>
													<td>
														<div class="product-info">
															
															<div class="info">
																<a href="product-list.html">Amazon Echo Dot</a>
																<p class="dull-text">KSH 597</p>
															</div>
														</div>
													</td>
													<td>
														<p class="head-text">Sales</p>
														784
													</td>
												</tr>
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-12 col-xl-8 d-flex">
							<div class="card flex-fill default-cover w-100 mb-4">
								<div class="card-header d-flex justify-content-between align-items-center">
									<h4 class="card-title mb-0">Recent Transactions</h4>
									<div class="dropdown">
										<a href="javascript:void(0);" class="view-all d-flex align-items-center">
										View All<span class="ps-2 d-flex align-items-center"><i data-feather="arrow-right" class="feather-16"></i></span>
									</a>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-borderless recent-transactions">
											<thead>
												<tr>
													<th>#</th>
													<th>Order Details</th>
													<th>Payment</th>
													<th>Status</th>
													<th>Amount</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>
														<div class="product-info">
															
															<div class="info">
																<a href="product-list.html">kaimati</a>
																<span class="dull-text d-flex align-items-center"><i data-feather="clock" class="feather-14"></i>15 Mins</span>
															</div>
														</div>
													</td>
													<td>
														<span class="d-block head-text">Mpesa</span>
														<span class="text-blue">#416645453773</span>
													</td>
													<td><span class="badge background-less border-success">Success</span></td>
													<td>KSH 1,099.00</td>
												</tr>
												<tr>
													<td>2</td>
													<td>
														<div class="product-info">
															
															<div class="info">
																<a href="product-list.html">brown bread 400gms</a>
																<span class="dull-text d-flex align-items-center"><i data-feather="clock" class="feather-14"></i>10 Mins</span>
															</div>
														</div>
													</td>
													<td>
														<span class="d-block head-text">cash</span>
														<span class="text-blue">#147784454554</span>
													</td>
													<td><span class="badge background-less border-danger">Canceled</span></td>
													<td>KSH 600.55</td>
												</tr>
												<tr>
													<td>3</td>
													<td>
														<div class="product-info">
															
															<div class="info">
																<a href="product-list.html">dryfcons</a>
																<span class="dull-text d-flex align-items-center"><i data-feather="clock" class="feather-14"></i>10 Mins</span>
															</div>
														</div>
													</td>
													<td>
														<span class="d-block head-text">credit sale</span>
														<span class="text-blue">#147784454554</span>
													</td>
													<td><span class="badge background-less border-primary">Pending</span></td>
													<td>KSH 1,099.00</td>
												</tr>
												<tr>
													<td>4</td>
													<td>
														<div class="product-info">
															
															<div class="info">
																<a href="product-list.html">scones</a>
																<span class="dull-text d-flex align-items-center"><i data-feather="clock" class="feather-14"></i>10 Mins</span>
															</div>
														</div>
													</td>
													<td>
														<span class="d-block head-text">Mpesa</span>
														<span class="text-blue">#147784454554</span>
													</td>
													<td><span class="badge background-less border-success">Success</span></td>
													<td>KSH 1,569.00</td>
												</tr>
												<tr>
													<td>5</td>
													<td>
														<div class="product-info">
															
															<div class="info">
																<a href="product-list.html">white bread 400gms</a>
																<span class="dull-text d-flex align-items-center"><i data-feather="clock" class="feather-14"></i>15 Mins</span>
															</div>
														</div>
													</td>
													<td>
														<span class="d-block head-text">Mpesa</span>
														<span class="text-blue">#147784454554</span>
													</td>
													<td><span class="badge background-less border-success">Success</span></td>
													<td>KSH 1,478.00</td>
												</tr>
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Button trigger modal -->


				</div>
			</div>


	
		
			</div>
		<!-- /Main Wrapper -->
		
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

		<!-- Map JS -->
		<script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.5.min.js"></script>
		<script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
		<script src="assets/plugins/jvectormap/jquery-jvectormap-ru-mill.js"></script>
		<script src="assets/plugins/jvectormap/jquery-jvectormap-us-aea.js"></script>
		<script src="assets/plugins/jvectormap/jquery-jvectormap-uk_countries-mill.js"></script>        
		<script src="assets/plugins/jvectormap/jquery-jvectormap-in-mill.js"></script>
		<script src="assets/js/jvectormap.js"></script>
		
		<!-- Custom JS --><script src="assets/js/theme-script.js"></script>	
		<script src="assets/js/script.js"></script>

	
	</body>
</html>