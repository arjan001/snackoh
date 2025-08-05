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
									
										<!-- /Filter -->
										<div class="table-responsive">
                                        <?php
// Include database connection
require 'config/config.php';

$query = "
    SELECT 
        o.id AS order_id,
        o.transaction_id,
        c.customer_name, 
        o.created_at AS sale_date, 
        o.total_price, 
        o.total_price, 
        o.payment_status, 
        o.payment_type, 
       
       
        CONCAT(e.first_name, ' ', e.last_name) AS biller,
        GROUP_CONCAT(CONCAT(oi.product_name, ' (', oi.quantity, ' x ', oi.price, ')') SEPARATOR ', ') AS order_items
    FROM orders o
    LEFT JOIN customers c ON o.customer_id = c.id
    LEFT JOIN employees e ON o.employee_id = e.id
    LEFT JOIN order_items oi ON o.id = oi.order_id
    GROUP BY o.id
    ORDER BY o.created_at DESC
";
 // o.due_amount, 
 
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
            <th>Payment Status</th>
            <th>Payment type</th>
            <th>Total Price</th>
            <th>Paid</th>
            <!-- <th>Due</th> -->
            
            <th>Pos Handler</th>
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
    <span class="badge <?= ($row['payment_status'] == 'completed') ? 'badge-bgsuccess' : 'badge-danger'; ?>">
        <?= htmlspecialchars(ucfirst($row['payment_status'])); ?>
    </span>
</td>
                <td>
    <span class="badge <?= ($row['payment_type'] == 'cash') ? 'badge-bgsuccess' : 'badge-danger'; ?>">
        <?= htmlspecialchars(ucfirst($row['payment_type'])); ?>
    </span>
</td>

                <td>KSH <?= number_format($row['total_price'], 2); ?></td>
                <td>KSH <?= number_format($row['total_price'], 2); ?></td>
                <!-- <td>KSH <?= number_format($row['due_balance'], 2); ?></td> -->
                
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
                            <a href="javascript:void(0);" class="dropdown-item download-pdf" data-sale-id="<?= $row['id']; ?>" data-transaction-id="<?= htmlspecialchars($row['transaction_id']); ?>">
                                <i data-feather="download" class="info-img"></i> Download PDF
                            </a>
                        </li>    
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
									<div class="tab-pane fade" id="sales2" role="tabpanel" aria-labelledby="sales-tab">
										<div class="table-top">
											<div class="search-set">
												<div class="search-input">
													<a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
												</div>
											</div>
											<div class="search-path">
												<a class="btn btn-filter" id="filter_search2">
													<i data-feather="filter" class="filter-icon"></i>
													<span><img src="assets/img/icons/closes.svg" alt="img"></span>
												</a>
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
                            <a href="javascript:void(0);" class="dropdown-item download-pdf" data-sale-id="<?= $row['id']; ?>" data-transaction-id="<?= htmlspecialchars($row['transaction_id']); ?>">
                                <i data-feather="download" class="info-img"></i> Download PDF
                            </a>
                        </li>    
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
					<!-- /product list -->
				</div>
			</div>

        </div>
		<!-- /Main Wrapper -->

	




  

		<?php include "includes/footer.php";?>


	
    </body>
</html>