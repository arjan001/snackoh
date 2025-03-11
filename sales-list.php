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
								<h6>Manage Your Sales</h6>
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
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-sales-new"><i data-feather="plus-circle" class="me-2"></i> Add New Sales</a>
						</div>
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
									<select class="select">
										<option>Sort by Date</option>
										<option>07 09 23</option>
										<option>21 09 23</option>
									</select>
								</div>
							</div>
							<!-- /Filter -->
						
							<!-- /Filter -->
							<div class="table-responsive">
								<?php
// Include database connection
require 'config/config.php'; 

$query = "
    SELECT 
        s.sale_id, 
        s.transaction_id, 
        c.customer_name, 
        s.sale_date, 
        s.status, 
        s.grand_total, 
        s.paid_amount, 
        s.due_amount, 
        s.payment_status, 
        CONCAT(e.first_name, ' ', e.last_name) AS biller 
    FROM sales_list s
    JOIN customers c ON s.customer_id = c.id
    LEFT JOIN employees e ON s.biller_id = e.id
    ORDER BY s.sale_date DESC
";

$result = $conn->query($query);
?>


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
            <th>Grand Total</th>
            <th>Paid</th>
            <th>Due</th>
            <th>Payment Status</th>
            <th>Biller</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody class="sales-list">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td>
                    <label class="checkboxs">
                        <input type="checkbox">
                        <span class="checkmarks"></span>
                    </label>
                </td>
                <td><?= htmlspecialchars($row['customer_name']); ?></td>
                <td><?= htmlspecialchars($row['transaction_id']); ?></td>
                <td><?= htmlspecialchars($row['sale_date']); ?></td>
                <td>
                    <span class="badge <?= ($row['status'] == 'Completed') ? 'badge-bgsuccess' : 'badge-danger'; ?>">
                        <?= htmlspecialchars($row['status']); ?>
                    </span>
                </td>
                <td>$<?= number_format($row['grand_total'], 2); ?></td>
                <td>$<?= number_format($row['paid_amount'], 2); ?></td>
                <td>$<?= number_format($row['due_amount'], 2); ?></td>
                <td>
                    <span class="badge <?= ($row['payment_status'] == 'Paid') ? 'badge-linesuccess' : 'badge-warning'; ?>">
                        <?= htmlspecialchars($row['payment_status']); ?>
                    </span>
                </td>
                <td><?= htmlspecialchars($row['biller'] ?? 'N/A'); ?></td>
                <td class="text-center">
                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#sales-details-new">
                                <i data-feather="eye" class="info-img"></i> Sale Detail
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-sales-new">
                                <i data-feather="edit" class="info-img"></i> Edit Sale
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#showpayment">
                                <i data-feather="dollar-sign" class="info-img"></i> Show Payments
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#createpayment">
                                <i data-feather="plus-circle" class="info-img"></i> Create Payment
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i data-feather="download" class="info-img"></i> Download PDF
                            </a>
                        </li>    
                        <li>
                            <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0">
                                <i data-feather="trash-2" class="info-img"></i> Delete Sale
                            </a>
                        </li>                                
                    </ul>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</tabl>

							</div>
						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>

        </div>
		<!-- /Main Wrapper -->

	




  

		<?php include "includes/footer.php";?>

	
    </body>
</html>