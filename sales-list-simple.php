<?php 
include_once "./includes/session_check.php"

?>	
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php";?>
    <body>
		
		<!-- <div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div> -->
	
		 
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
								<h4>Sales List</h4>
								<h6>Manage Your Overall Sales Data</h6>
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
						<div class="page-btn">
							<!-- <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-sales-new"><i data-feather="plus-circle" class="me-2"></i> Add New Sales</a> -->
						</div>
					</div>
					

					<!-- /product list -->
					<!-- /product list -->
					<div class="card table-list-card">
						<div class="card-body">
							<div class="tabs-set">
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									<li class="nav-item" role="presentation">
									  <button class="nav-link active" id="purchase-tab" data-bs-toggle="tab" data-bs-target="#purchase2" type="button" role="tab" aria-controls="purchase2" aria-selected="true">Physical store sales</button>
									</li>
									<li class="nav-item" role="presentation">
									  <button class="nav-link" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales2" type="button" role="tab" aria-controls="sales2" aria-selected="false">Online Sales</button>
									</li>
								</ul>
								  <div class="tab-content" id="myTabContent">
									<div class="tab-pane fade show active" id="purchase2" role="tabpanel" aria-labelledby="purchase-tab">
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
													<a href="" class="me-3 layout-box"><i data-feather="layout" class="feather-search"></i></a>
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
										<div class="table-responsive">
											<table class="table datanew">
												<thead>
													<tr>
														<th class="no-sort">
															<label class="checkboxs">
																<input type="checkbox" id="select-all">
																<span class="checkmarks"></span>
															</label>
														</th>
														<th>Customer Name</th>
														<th>Transaction ID</th>
														<th>Date</th>
														<th>Status</th>
														<th>Payment Type</th>
														<th>Total Price</th>
														<th>Due Balance</th>
														<th>Biller</th>
														<th class="text-center">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													// Include database connection
													require 'config/config.php'; 
													
													$query = "
														SELECT 
															o.id,
															o.transaction_id,
															c.customer_name,
															o.created_at,
															o.payment_status,
															o.payment_type,
															o.total_price,
															CONCAT(e.first_name, ' ', e.last_name) AS biller 
														FROM orders o
														LEFT JOIN customers c ON o.customer_id = c.id
														LEFT JOIN employees e ON o.employee_id = e.id
														ORDER BY o.created_at DESC
													";
													
													$result = $conn->query($query);
													
													while ($row = $result->fetch_assoc()) {
													?>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td><?= htmlspecialchars($row['customer_name'] ?? 'Walk-in Customer'); ?></td>
														<td><?= htmlspecialchars($row['transaction_id']); ?></td>
														<td><?= date('Y-m-d H:i', strtotime($row['created_at'])); ?></td>
														<td>
															<span class="badge <?= ($row['payment_status'] == 'completed') ? 'badge-bgsuccess' : 'badge-warning'; ?>">
																<?= htmlspecialchars(ucfirst($row['payment_status'])); ?>
															</span>
														</td>
														<td>
															<span class="badge <?= ($row['payment_type'] == 'cash') ? 'badge-linesuccess' : (($row['payment_type'] == 'credit') ? 'badge-warning' : 'badge-info'); ?>">
																<?= htmlspecialchars(ucfirst($row['payment_type'])); ?>
															</span>
														</td>
														<td>KSH <?= number_format($row['total_price'], 2); ?></td>
														<td>KSH <?= number_format($row['total_price'], 2); ?></td>
														<td><?= htmlspecialchars($row['biller'] ?? 'N/A'); ?></td>
														<td class="text-center">
															<a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
																<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
															</a>
															<ul class="dropdown-menu">
																<li>
																	<a href="javascript:void(0);" class="dropdown-item delete-sale" data-sale-id="<?= $row['id']; ?>" data-transaction-id="<?= htmlspecialchars($row['transaction_id']); ?>">
																		<i data-feather="trash-2" class="info-img"></i> Delete Sale
																	</a>
																</li>                                
															</ul>
														</td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>	
							</div>
						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>

        </div>
		<!-- /Main Wrapper -->

		<?php include "includes/footer.php";?>

		<script>
		$(document).ready(function() {
			// Delete sale functionality only
			$(document).on('click', '.delete-sale', function() {
				var saleId = $(this).data('sale-id');
				var transactionId = $(this).data('transaction-id');
				
				// Show confirmation dialog
				if (confirm('Are you sure you want to delete this sale? This action cannot be undone.')) {
					$.ajax({
						url: 'delete_sale.php',
						type: 'POST',
						data: {
							sale_id: saleId,
							transaction_id: transactionId
						},
						dataType: 'json',
						success: function(response) {
							if (response.success) {
								alert('Sale deleted successfully!');
								location.reload(); // Reload the page to update the table
							} else {
								alert('Error: ' + response.message);
							}
						},
						error: function() {
							alert('An error occurred while deleting the sale.');
						}
					});
				}
			});
		});
		</script>
	
    </body>
</html> 