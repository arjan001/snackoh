<!DOCTYPE html>
<html lang="en">
<?php
include_once "./includes/session_check.php" ;
include "includes/header.php";
?>
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
								<h4>PRODUCTION REPORTS</h4>
								<h6>Manage your Batch Productions Reports</h6>
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
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
					</div>
					<!-- /product list -->
					<div class="card table-list-card">
						<div class="card-body">
							<div class="table-top">
								<div class="search-set">
									<div class="search-input">
										<a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
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
									<select class="select" id="sortSelect">
										<option value="date_desc">Sort by Date (Newest)</option>
										<option value="date_asc">Sort by Date (Oldest)</option>
										<option value="status">Sort by Status</option>
										<option value="product">Sort by Product</option>
									</select>
								</div>
							</div>
							<!-- /Filter -->
					
							<!-- /Filter -->
							<div class="table-responsive">

<!-- production report Table -->
<table class="table datanew">
    <thead>
        <tr>
            <th>Batch ID</th>
            <th>Product</th>
            <th>Date Range</th>
            <th>Quantity Produced</th>
            <th>Status</th>
            <th>Produced By</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch production data from database
        $query = "
            SELECT 
                nbp.batch_id,
                p.product_name,
                nbp.production_datetime,
                nbp.estimated_completion,
                nbp.quantity_produced,
                nbp.status,
                e.full_name as produced_by,
                nbp.id as production_id
            FROM new_batch_production nbp
            LEFT JOIN products p ON nbp.product_id = p.id
            LEFT JOIN employees e ON nbp.produced_by = e.id
            ORDER BY nbp.production_datetime DESC
        ";
        
        $result = $conn->query($query);
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $start_date = date('Y-m-d', strtotime($row['production_datetime']));
                $end_date = $row['estimated_completion'] ? date('Y-m-d', strtotime($row['estimated_completion'])) : $start_date;
                $date_range = $start_date . ' to ' . $end_date;
                
                $status_class = '';
                switch ($row['status']) {
                    case 'Completed':
                        $status_class = 'badge bg-success';
                        break;
                    case 'In Progress':
                        $status_class = 'badge bg-warning';
                        break;
                    case 'Pending':
                        $status_class = 'badge bg-info';
                        break;
                    default:
                        $status_class = 'badge bg-secondary';
                }
                
                echo "<tr>
                        <td>{$row['batch_id']}</td>
                        <td>{$row['product_name']}</td>
                        <td>{$date_range}</td>
                        <td>{$row['quantity_produced']} units</td>
                        <td><span class='$status_class'>{$row['status']}</span></td>
                        <td>{$row['produced_by']}</td>
                        <td>
                            <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#viewProductionReportModal' 
                                    onclick='viewProductionDetails({$row['production_id']})'>View</button>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7' class='text-center'>No production data available</td></tr>";
        }
        ?>
    </tbody>
</table>
<!-- production report Table -->

</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Main Wrapper -->
		
		<!-- View Production Report Modal -->
		<div class="modal fade" id="viewProductionReportModal" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Production Report Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body" id="productionReportContent">
						<!-- Content will be loaded dynamically -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" onclick="printReport()">Print Report</button>
					</div>
				</div>
			</div>
		</div>

		<!-- jQuery -->
		<script src="assets/js/jquery-3.6.0.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		
		<!-- Feather Icon JS -->
		<script src="assets/js/feather.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="assets/js/jquery.slimscroll.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
		<script>
		$(document).ready(function() {
			// Initialize feather icons
			feather.replace();
			
			// Sort functionality
			$('#sortSelect').on('change', function() {
				var sortBy = $(this).val();
				// Implement sorting logic here
				console.log('Sort by:', sortBy);
			});
		});
		
		function viewProductionDetails(productionId) {
			// Load production details via AJAX
			$.ajax({
				url: 'get_production_details.php',
				type: 'GET',
				data: { id: productionId },
				success: function(response) {
					if (response.success) {
						$('#productionReportContent').html(response.html);
					} else {
						$('#productionReportContent').html('<div class="alert alert-danger">Error loading production details</div>');
					}
				},
				error: function() {
					$('#productionReportContent').html('<div class="alert alert-danger">Error loading production details</div>');
				}
			});
		}
		
		function printReport() {
			// Implement print functionality
			window.print();
		}
		</script>
	</body>
</html>