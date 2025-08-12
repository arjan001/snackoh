<!DOCTYPE html>
<html lang="en">
<!-- header code -->
<?php include 'includes/header.php';?>
<!-- header code ends here -->
		
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
								<h4>Invoice Report	</h4>
								<h6>Manage Your Invoice Report</h6>
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
									<select class="select">
										<option>Sort by Date</option>
										<option>25 9 23</option>
										<option>12 9 23</option>
									</select>
								</div>
							</div>
							<!-- /Filter -->
							
							<!-- /Filter -->
							<div class="table-responsive">
							<?php

include './config/config.php';



// Fetch invoice data
$sql = "SELECT 
            i.invoice_id AS invoice_number, 
            c. customer_name AS name, 
            i.due_date, 
            i.total_amount, 
            i.paid_amount, 
            i.amount_due,  
            CASE 
                WHEN i.amount_due = 0 THEN 'Paid'
                WHEN i.due_date < CURDATE() THEN 'Overdue'
                ELSE 'Unpaid'
            END AS status
        FROM invoice i
        LEFT JOIN customers c ON i.customer_id = c.id
        ORDER BY i.created_at DESC";

$result = $conn->query($sql);
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
            <th>Invoice No</th>
            <th>Customer</th>
            <th>Due Date</th>
            <th>Amount</th>
            <th>Paid</th>
            <th>Amount Due</th>
            <th>Status</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <label class="checkboxs">
                            <input type="checkbox">
                            <span class="checkmarks"></span>
                        </label>
                    </td>
                    <td><?php echo "INV" . str_pad($row["invoice_number"], 3, "0", STR_PAD_LEFT); ?></td>
                    <td><?php echo htmlspecialchars($row["customer_name"]); ?></td>
                    <td><?php echo date("d M Y", strtotime($row["due_date"])); ?></td>
                    <td>KSH <?php echo number_format($row["total_amount"], 2); ?></td>
                    <td>KSH <?php echo number_format($row["paid_amount"], 2); ?></td>
                    <td>KSH <?php echo number_format($row["amount_due"], 2); ?></td>
                    <td>
                        <span class="badge <?php echo ($row["status"] == 'Paid') ? 'badge-linesuccess' : (($row["status"] == 'Overdue') ? 'badge-linedanger' : 'badge-linewarning'); ?>">
                            <?php echo $row["status"]; ?>
                        </span>
                    </td>
                    <td class="action-table-data">
                        <div class="edit-delete-action">
                            <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#view_invoice">
                                <i data-feather="edit" class="feather-edit"></i> View invoice
                            </a>
                        </div>
                    </td>
                </tr>
        <?php } 
        } else { ?>
            <!-- <tr> -->
                <td colspan="9">No invoices found.</td>
            <!-- </tr> -->
        <?php } ?>
    </tbody>
</table>







							</div>
						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

				<!-- VIEW INVOICE MODAL -->
				<div class="modal fade" id="view_invoice">
			<div class="modal-dialog modal-dialog-centered stock-adjust-modal">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>CUSTOMER INVOICE DATA</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="stock-adjustment.html">
								<div class="row">

								</div>
								<div class="col-lg-12 col-sm-12 col-12">

<div class="mb-3 add-product">
	<label class="form-label">Customer Name</label>
	<input type="text" class="form-control" name="stock_category_name" value="Thomas" readonly>
</div>
</div>
									<div class="row">

										<div class="col-lg-12">
											<div class="modal-body-table">
												<div class="table-responsive">
													<table class="table  datanew">
														<thead>
															<tr>
																<th>Product Name</th>
																<th>Quantity</th>
																<th>Units</th>
																<th>Price</th>
																
																<!-- <th class="no-sort">Action</th> -->
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<div class="productimgname">
																		<a href="javascript:void(0);" class="product-img stock-img">
																			<img src="assets/img/profiles/avator1.jpg" alt="product">
																		</a>
																		<a href="javascript:void(0);">bread 500gms</a>
																	</div>												
																</td>
																<td>1</td>
																<td>Crate</td>
																<td>Ksh 1200</td>
																
																<td class="action-table-data">
																	<div class="edit-delete-action">
																		<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
																			<i data-feather="edit" class="feather-edit"></i>
																		</a>
																		<a class="confirm-text p-2" href="javascript:void(0);">
																			<i data-feather="trash-2" class="feather-trash-2"></i>
																		</a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
											
										</div>
									
									</div>
									
									<div class="col-lg-12">
										<div class="input-blocks summer-description-box">
											<label>Invoice Delivery Notes</label>
											<textarea class="form-control"></textarea>
										</div>
									</div>
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Create Adjustment</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- / VIEW INVOICE MODAL  -->
  

		 
		<?php include "includes/footer.php";?>

	
    </body>
</html>