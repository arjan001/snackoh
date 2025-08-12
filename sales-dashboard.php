<?php 
include_once "./includes/session_check.php";
include_once "./config/config.php";

// Get current date and week start/end
$current_date = date('Y-m-d');
$week_start = date('Y-m-d', strtotime('monday this week'));
$week_end = date('Y-m-d', strtotime('sunday this week'));
$last_week_start = date('Y-m-d', strtotime('monday last week'));
$last_week_end = date('Y-m-d', strtotime('sunday last week'));

// Fetch weekly earnings (current week)
$weekly_sql = "SELECT SUM(total_price) AS weekly_earnings FROM orders 
               WHERE DATE(created_at) BETWEEN '$week_start' AND '$week_end'";
$weekly_result = $conn->query($weekly_sql);
$weekly_earnings = 0.00;
if ($weekly_result && $weekly_result->num_rows > 0) {
    $row = $weekly_result->fetch_assoc();
    $weekly_earnings = (float) ($row['weekly_earnings'] ?? 0.00);
}

// Fetch last week earnings for comparison
$last_week_sql = "SELECT SUM(total_price) AS last_week_earnings FROM orders 
                  WHERE DATE(created_at) BETWEEN '$last_week_start' AND '$last_week_end'";
$last_week_result = $conn->query($last_week_sql);
$last_week_earnings = 0.00;
if ($last_week_result && $last_week_result->num_rows > 0) {
    $row = $last_week_result->fetch_assoc();
    $last_week_earnings = (float) ($row['last_week_earnings'] ?? 0.00);
}

// Calculate percentage increase
$percentage_increase = 0;
if ($last_week_earnings > 0) {
    $percentage_increase = (($weekly_earnings - $last_week_earnings) / $last_week_earnings) * 100;
}

// Fetch total sales amount
$total_sales_sql = "SELECT SUM(total_price) AS total_sales FROM orders";
$total_sales_result = $conn->query($total_sales_sql);
$total_sales = 0.00;
if ($total_sales_result && $total_sales_result->num_rows > 0) {
    $row = $total_sales_result->fetch_assoc();
    $total_sales = (float) ($row['total_sales'] ?? 0.00);
}

// Fetch online sales amount (fixed the variable assignment bug)
$online_sales_sql = "SELECT SUM(total_price) AS online_sales FROM orders WHERE chanel='online'";
$online_sales_result = $conn->query($online_sales_sql);
$online_sales = 0.00;
if ($online_sales_result && $online_sales_result->num_rows > 0) {
    $row = $online_sales_result->fetch_assoc();
    $online_sales = (float) ($row['online_sales'] ?? 0.00);
}

// Fetch best sellers (top 5 products by sales quantity)
$best_sellers_sql = "SELECT oi.product_name, SUM(oi.quantity) as total_sold, SUM(oi.quantity * oi.price) as total_revenue
                     FROM order_items oi
                     GROUP BY oi.product_name
                     ORDER BY total_sold DESC
                     LIMIT 5";
$best_sellers_result = $conn->query($best_sellers_sql);

// Fetch recent transactions (latest 5 orders)
$recent_transactions_sql = "SELECT o.*, GROUP_CONCAT(oi.product_name SEPARATOR ', ') as products
                           FROM orders o
                           LEFT JOIN order_items oi ON o.id = oi.order_id
                           GROUP BY o.id
                           ORDER BY o.created_at DESC
                           LIMIT 5";
$recent_transactions_result = $conn->query($recent_transactions_sql);


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
									<h3>KSH <span class="counters" data-count="<?php echo $weekly_earnings; ?>"><?php echo number_format($weekly_earnings, 2); ?></span></h3>
									<p class="sales-range">
										<?php if ($percentage_increase >= 0): ?>
											<span class="text-success"><i data-feather="chevron-up" class="feather-16"></i><?php echo number_format($percentage_increase, 1); ?>%&nbsp;</span>
										<?php else: ?>
											<span class="text-danger"><i data-feather="chevron-down" class="feather-16"></i><?php echo number_format(abs($percentage_increase), 1); ?>%&nbsp;</span>
										<?php endif; ?>
										<?php echo $percentage_increase >= 0 ? 'increase' : 'decrease'; ?> compare to last week
									</p>
								</div>
								<img src="assets/img/icons/weekly-earning.svg" alt="img">
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card color-info bg-primary mb-4">
								<img src="assets/img/icons/total-sales.svg" alt="img">
								<h3>KSH <span class="counters" data-count="<?php echo $total_sales; ?>"><?php echo number_format($total_sales, 2); ?></span></h3>
								<p>Total Store Sales</p>
								<i data-feather="rotate-ccw" class="feather-16" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"></i>
							</div>
						</div>

						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card color-info bg-secondary mb-4">
								<img src="assets/img/icons/purchased-earnings.svg" alt="img">
								<h3>KSH <span class="counters" data-count="<?php echo $online_sales; ?>"><?php echo number_format($online_sales, 2); ?></span></h3>
								<p>Online Total Sales</p>
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
										<a href="product-list.php" class="view-all d-flex align-items-center">
											View All<span class="ps-2 d-flex align-items-center"><i data-feather="arrow-right" class="feather-16"></i></span>
										</a>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-borderless best-seller">
											<tbody>
												<?php 
												if ($best_sellers_result && $best_sellers_result->num_rows > 0):
													while ($product = $best_sellers_result->fetch_assoc()):
														$total_revenue = $product['total_revenue'];
												?>
												<tr>
													<td>
														<div class="product-info">
															<div class="info">
																<a href="product-list.php"><?php echo htmlspecialchars($product['product_name']); ?></a>
																<p class="dull-text">KSH <?php echo number_format($total_revenue, 2); ?></p>
															</div>
														</div>
													</td>
													<td>
														<p class="head-text">Sales</p>
														<?php echo number_format($product['total_sold']); ?>
													</td>
												</tr>
												<?php 
													endwhile;
												else:
												?>
												<tr>
													<td colspan="2" class="text-center text-muted">
														No sales data available
													</td>
												</tr>
												<?php endif; ?>
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
										<a href="sales-list.php" class="view-all d-flex align-items-center">
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
												<?php 
												if ($recent_transactions_result && $recent_transactions_result->num_rows > 0):
													$counter = 1;
													while ($transaction = $recent_transactions_result->fetch_assoc()):
														$time_ago = '';
														if ($transaction['created_at']) {
															$created_time = new DateTime($transaction['created_at']);
															$now = new DateTime();
															$interval = $now->diff($created_time);
															
															if ($interval->h > 0) {
																$time_ago = $interval->h . ' Hr' . ($interval->h > 1 ? 's' : '');
															} else {
																$time_ago = $interval->i . ' Min' . ($interval->i > 1 ? 's' : '');
															}
														}
														
														// Determine status badge
														$status_class = '';
														$status_text = '';
														switch(strtolower($transaction['payment_status'])) {
															case 'completed':
															case 'success':
																$status_class = 'background-less border-success';
																$status_text = 'Success';
																break;
															case 'pending':
																$status_class = 'background-less border-primary';
																$status_text = 'Pending';
																break;
															case 'cancelled':
															case 'canceled':
																$status_class = 'background-less border-danger';
																$status_text = 'Canceled';
																break;
															default:
																$status_class = 'background-less border-warning';
																$status_text = ucfirst($transaction['payment_status']);
														}
												?>
												<tr>
													<td><?php echo $counter; ?></td>
													<td>
														<div class="product-info">
															<div class="info">
																<a href="sales-list.php"><?php echo htmlspecialchars($transaction['products'] ?: 'N/A'); ?></a>
																<span class="dull-text d-flex align-items-center"><i data-feather="clock" class="feather-14"></i><?php echo $time_ago; ?></span>
															</div>
														</div>
													</td>
													<td>
														<span class="d-block head-text"><?php echo ucfirst($transaction['payment_type'] ?: 'N/A'); ?></span>
														<span class="text-blue">#<?php echo $transaction['id']; ?></span>
													</td>
													<td><span class="badge <?php echo $status_class; ?>"><?php echo $status_text; ?></span></td>
													<td>KSH <?php echo number_format($transaction['total_price'], 2); ?></td>
												</tr>
												<?php 
													$counter++;
													endwhile;
												else:
												?>
												<tr>
													<td colspan="5" class="text-center text-muted">
														No recent transactions available
													</td>
												</tr>
												<?php endif; ?>
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