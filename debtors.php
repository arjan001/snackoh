<!DOCTYPE html>
<html lang="en">
<?php include_once "./includes/session_check.php"; ?>
<?php include "includes/header.php";?>
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
								<h4>Debtors List</h4>
								<h6>Manage Your Debtors</h6>
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
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#trigger"><i data-feather="plus-circle" class="me-2"></i>Add trigger</a>
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
										<option>25 9 23</option>
										<option>12 9 23</option>
									</select>
								</div>
							</div>
							<!-- /Filter -->
							<div class="card" id="filter_inputs">
								<div class="card-body pb-0">
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="user" class="info-img"></i>
												<select class="select">
													<option>Choose Debtor Name</option>
													<option>Dazzle Shoes</option>
													<option>A-Z Store</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="globe" class="info-img"></i>
												<select class="select">
													<option>Choose Country</option>
													<option>Mexico</option>
													<option>Italy</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="input-blocks">
												<a class="btn btn-filters ms-auto"> <i data-feather="search" class="feather-search"></i> Search </a>
											</div>
										</div>
									</div>
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
											<th>customer Name</th>
											<th>Transaction ID</th>
											<th>Paid Amount</th>
											<th>balance</th>
											<th>sale date</th>
											<th>email</th>
											<th>Phone</th>
											<!-- <th>physical address</th> -->
											<th class="no-sort">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										// Include database connection
										require 'config/config.php'; 
										
										$query = "
											SELECT 
												d.id,
												d.customer_id,
												d.customer_name,
												d.email,
												d.phone,
												d.total_debt,
												d.created_date,
												dt.transaction_id,
												dt.amount as transaction_amount,
												dt.transaction_date
											FROM debtors d
											LEFT JOIN debt_transactions dt ON d.customer_id = dt.customer_id
											WHERE d.status = 'active'
											ORDER BY d.created_date DESC
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
											<td><?= htmlspecialchars($row['customer_name']); ?></td>
											<td><?= htmlspecialchars($row['transaction_id'] ?? 'N/A'); ?></td>
											<td>KSH 0.00</td>
											<td>KSH <?= number_format($row['total_debt'], 2); ?></td>
											<td><?= date('Y-m-d H:i:s', strtotime($row['created_date'])); ?></td>
											<td><?= htmlspecialchars($row['email'] ?? 'N/A'); ?></td>
											<td><?= htmlspecialchars($row['phone'] ?? 'N/A'); ?></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-credit-sale" 
													   data-customer-id="<?= $row['customer_id']; ?>"
													   data-customer-name="<?= htmlspecialchars($row['customer_name']); ?>"
													   data-total-debt="<?= $row['total_debt']; ?>">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#notify">
														<i data-feather="bell"></i>
													</a>
												</div>
											</td>
										</tr>
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

				<!-- Edit Category -->
				<div class="modal fade" id="trigger">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>ADD DEBTOR TRIGGER</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form action="insert-unsold.php" method="POST">

								<div class="row">

									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Customer Name</label>
											<input type="text" class="form-control" name="credit_customer_name" value="debtor edwin" readonly>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Transaction ID</label>
											<input type="text" class="form-control" name="ttransaction_id"value="SNTID2403867D9D" readonly>
										</div>
									</div>

								</div>

								<div class="row">
								<div class="col-lg-6 col-sm-6 col-12">
										<div class="input-blocks">
											<label>debt paid on</label>

											<div class="input-groupicon calender-input">
												
												<input type="datetime-local" class="form-control" id="productionDateTime" name="debt_pay_date" value="datetime-local">
											</div>
										</div>
									</div>

									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Due Amount</label>
											<input type="text" class="form-control" name="due_amount" value="KSH 2500" readonly>
										</div>
									</div>
								</div>


								<div class="row">

								<div class="col-lg-12 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Paid Amount</label>
											<input type="number" class="form-control" name="debt_paid_amount" value="">
										</div>
									</div>

									


								</div>



								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Submit </button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<!-- /Edit Category -->

				<!-- notify creditor -->
 <div class="modal fade" id="notify">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Notify Debtor</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form action="insert-unsold.php" method="POST">
                            <div class="row">
							<div class="col-lg-6 col-sm-6 col-12">

<div class="mb-3 add-product">
	<label class="form-label">Customer Name</label>
	<input type="text" class="form-control" name="credit_customer_name" value="debtor edwin" readonly>
</div>
</div>
<div class="col-lg-6 col-sm-6 col-12">

<div class="mb-3 add-product">
	<label class="form-label">Transaction ID</label>
	<input type="text" class="form-control" name="ttransaction_id"value="SNTID2403867D9D" readonly>
</div>
</div>
                            </div>

                            <div class="row">
							<div class="col-lg-6 col-sm-6 col-12">

<div class="mb-3 add-product">
	<label class="form-label">Due Amount</label>
	<input type="text" class="form-control" name="due_amount" value="KSH 2500" readonly>
</div>
</div>
<div class="col-lg-6 col-sm-6 col-12">
                                    <div class="mb-3 add-product">
                                        <label class="form-label">Notify Method</label>
                                        <select class="form-control select" name="resolution" required>
                                            <option value="return to Inventory">sms</option>
                                            <option value="Discard">whatsapp</option>
                                            <option value="Donate">email</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
							<div class="col-lg-12">
                                    <div class="input-blocks summer-description-box transfer mb-3">
                                        <label>Notification Method</label>
                                        <textarea class="form-control h-100" name="recipe_instructions" rows="3"
                                            required >your transaction debt of ksh 2,500 is due 2 days from now</textarea>
                                        <p class="mt-1">Maximum 60 Characters</p>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
          <!-- notify creditor -->


  

		 
	
		<?php include "includes/footer.php";?>

	
    </body>
</html>