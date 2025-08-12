<?php
// Show errors only when debugging
if (getenv('APP_DEBUG') === 'true') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

include_once __DIR__ . '/includes/session_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<!-- header code -->
<?php include 'includes/header.php';?>
<!-- header code ends here -->
<body>
	<!-- <div id="global-loader">
		<div class="whirly-loader"> </div>
	</div> -->
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<?php include 'includes/navbar.php';?>
		<!-- /Header -->

		<!-- Sidebar -->
<?php include "includes/sidebar.php";?> 
		<!-- /Sidebar -->





		<div class="page-wrapper">
			<div class="content">

				<!-- dashboard cards -->
				
				<?php include 'includes/dashboardCards.php';?>
				<!-- dashboard cards end here -->
				<!-- Button trigger modal -->

				<div class="row">
					<div class="col-xl-7 col-sm-12 col-12 d-flex">
						<div class="card flex-fill">
							<div class="card-header d-flex justify-content-between align-items-center">
								<h5 class="card-title mb-0">Purchase & Sales</h5>
								<div class="graph-sets">
									<ul class="mb-0">
										<li>
											<span>Sales</span>
										</li>
										<li>
											<span>Purchase</span>
										</li>
									</ul>
									<div class="dropdown dropdown-wraper">
										<button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
											2025
										</button>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<li>
												<a href="javascript:void(0);" class="dropdown-item">2025</a>
											</li>
											
										</ul>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div id="sales_charts"></div>
							</div>
						</div>
					</div>
					<!-- recent products code -->
					<?php  include_once 'includes/dash-recent-products.php';?>
					<!-- recent products code -->
				</div>
				<!-- expired products was here -->


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

	<!-- Bootstrap Core JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>

	<!-- Chart JS -->
	<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
	<script src="assets/plugins/apexchart/chart-data.js"></script>

	<!-- Sweetalert 2 -->
	<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
	<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/theme-script.js"></script>	
		<script src="assets/js/script.js"></script>

	
</body>

</html>