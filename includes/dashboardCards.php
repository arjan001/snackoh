				<!-- dashboard cards -->
				<div class="row">
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-widget w-100">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash1.svg" alt="img"></span>
							</div>
							<div class="dash-widgetcontent">
								<h5>KSH <span class="counters" data-count="307144">KSH 30,714.</span></h5>
								<h6>Total Purchase Due</h6>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-widget dash1 w-100">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash2.svg" alt="img"></span>
							</div>
							<?php
include_once "./config/config.php";

// Fetch total sales amount
$sql = "SELECT SUM(due_amount) AS total_due FROM sales_list";
$result = $conn->query($sql);
$total_dues = 0.00;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_dues = (float) ($row['total_due'] ?? 0.00);
}
?>

<div class="dash-widgetcontent">
    <h5>KSH <span class="counters" data-count="<?php echo $total_dues; ?>">
        <?php echo "KSH " . number_format($total_dues, 2); ?>
    </span></h5>
    <h6>Total Due Amount</h6>
</div>

						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-widget dash2 w-100">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash3.svg" alt="img"></span>
							</div>
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

<div class="dash-widgetcontent">
    <h5>KSH <span class="counters" data-count="<?php echo $total_sales; ?>">
        <?php echo "KSH " . number_format($total_sales, 2); ?>
    </span></h5>
    <h6>Total Sale Amount</h6>
</div>

						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-widget dash3 w-100">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash4.svg" alt="img"></span>
							</div>
							<?php
include_once "./config/config.php";

// Fetch total expenses amount
$sql = "SELECT SUM(amount) AS total_expenses FROM expenses";
$result = $conn->query($sql);
$total_expenses = 0.00;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_expenses = (float) ($row['total_expenses'] ?? 0.00);
}
?>

<div class="dash-widgetcontent">
    <h5>KSH <span class="counters" data-count="<?php echo $total_expenses; ?>">
        <?php echo "KSH " . number_format($total_expenses, 2); ?>
    </span></h5>
    <h6>Total Expense Amount</h6>
</div>


						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-count">
							<div class="dash-counts">
							<?php
								require_once 'config/config.php'; // Ensure database connection
								
								// Query to count total employees
								$result = $conn->query("SELECT COUNT(*) AS total FROM customers");
								$row = $result->fetch_assoc();
								$totalCustomers = $row['total'];
								?>
								<h4><?php echo $totalCustomers; ?></h4>
								<h5>Customers</h5>
							</div>
							<div class="dash-imgs">
								<i data-feather="user"></i>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-count das1">
							<div class="dash-counts">
							<?php
								require_once 'config/config.php'; // Ensure database connection
								
								// Query to count total employees
								$result = $conn->query("SELECT COUNT(*) AS total FROM suppliers");
								$row = $result->fetch_assoc();
								$totalSuppliers = $row['total'];
								?>
								<h4><?php echo $totalSuppliers; ?></h4>
								<h5>Suppliers</h5>
							</div>
							<div class="dash-imgs">
								<i data-feather="user-check"></i>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-count das2">
							<div class="dash-counts">
								<h4>150</h4>
								<h5>Purchase Invoice</h5>
							</div>
							<div class="dash-imgs">
								<img src="assets/img/icons/file-text-icon-01.svg" class="img-fluid" alt="icon">
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-count das3">
							<div class="dash-counts">
							<?php
								require_once 'config/config.php'; // Ensure database connection
								
								// Query to count total employees
								$result = $conn->query("SELECT COUNT(*) AS total FROM invoice");
								$row = $result->fetch_assoc();
								$totalInvoices = $row['total'];
								?>
								<h4><?php echo $totalInvoices; ?></h4>
								<h5>Sales Invoice</h5>
							</div>
							<div class="dash-imgs">
								<i data-feather="file"></i>
							</div>
						</div>
					</div>
				</div>