				<!-- dashboard cards -->
				<div class="row">
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-widget w-100">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash1.svg" alt="img"></span>
							</div>
							<div class="dash-widgetcontent">
								<h5>KSH<span class="counters" data-count="307144.00">KSH307,144.00</span></h5>
								<h6>Total Purchase Due</h6>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-widget dash1 w-100">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash2.svg" alt="img"></span>
							</div>
							<div class="dash-widgetcontent">
								<h5>KSH<span class="counters" data-count="4385.00">KSH4,385.00</span></h5>
								<h6>Total Sales Due</h6>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-widget dash2 w-100">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash3.svg" alt="img"></span>
							</div>
							<div class="dash-widgetcontent">
								<h5>KSH<span class="counters" data-count="385656.50">KSH385,656.50</span></h5>
								<h6>Total Sale Amount</h6>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-widget dash3 w-100">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash4.svg" alt="img"></span>
							</div>
							<div class="dash-widgetcontent">
								<h5>KSH<span class="counters" data-count="40000.00">KSH400.00</span></h5>
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