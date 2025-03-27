		<!-- Print Receipt -->
		<div class="modal fade modal-default" id="print-receipt" aria-labelledby="print-receipt">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
                <div class="d-flex justify-content-end">
					<button type="button" class="close p-0" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="icon-head text-center">
						<a href="javascript:void(0);">
							<img src="assets/img/logo.png" width="100" height="30" alt="Receipt Logo">
						</a>
					</div>
					<div class="text-center info text-center">
						<h6>Snackoh Bakers</h6>
						<p class="mb-0">Phone Number: +1 5656665656</p>
						<p class="mb-0">Email: <a href="mailto:info@SnackohBakers.co.ke">info@SnackohBakers.co.ke</a>
						</p>
					</div>
					<div class="tax-invoice">
						<h6 class="text-center">Tax Invoice</h6>
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<div class="invoice-user-name"><span>Name: </span><span>John Doe</span></div>
								<div class="invoice-user-name"><span>Invoice No: </span><span>CS132453</span></div>
							</div>
							<div class="col-sm-12 col-md-6">
								<div class="invoice-user-name"><span>Customer Id: </span><span>#LL93784</span></div>
								<div class="invoice-user-name"><span>Date: </span><span>02.02.2025</span></div>
							</div>
						</div>
					</div>
					<table class="table-borderless w-100 table-fit">
						<thead>
							<tr>
								<th># Item</th>
								<th>Price</th>
								<th>Qty</th>
								<th class="text-end">Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1. Bread white (400g)</td>
								<td>KSH 50</td>
								<td>3</td>
								<td class="text-end">KSH150</td>
							</tr>
							<tr>
								<td>2. Bread yellow (400g)</td>
								<td>KSH 50</td>
								<td>2</td>
								<td class="text-end">KSH100</td>
							</tr>
							<tr>
								<td>3. Doughnuts</td>
								<td>KSH 50</td>
								<td>3</td>
								<td class="text-end">KSH150</td>
							</tr>
							<tr>
								<td colspan="4">
									<table class="table-borderless w-100 table-fit">
										<tr>
											<td>Sub Total :</td>
											<td class="text-end">KSH 700.00</td>
										</tr>
										<tr>
											<td>Discount :</td>
											<td class="text-end">-KSH 50.00</td>
										</tr>
										<tr>
											<td>Shipping :</td>
											<td class="text-end">0.00</td>
										</tr>
										<tr>
											<td>Tax (5%) :</td>
											<td class="text-end">KSH 5.00</td>
										</tr>
										<tr>
											<td>Total Bill :</td>
											<td class="text-end">KSH 655.00</td>
										</tr>
										<tr>
											<td>Due :</td>
											<td class="text-end">KSH 0.00</td>
										</tr>
										<tr>
											<td>Total Payable :</td>
											<td class="text-end">KSH 655.00</td>
										</tr>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="text-center invoice-bar">
						<p>**VAT against this challan is payable through central registration. Thank you for your
							business!</p>
						<a href="javascript:void(0);">
							<img src="assets/img/barcode/barcode-03.jpg" alt="Barcode">
						</a>
						<p>Sale 31</p>
						<p>Thank You For Shopping With Us. Please Come Again</p>
						<?php 
    // Retrieve user data from session
$full_name = $_SESSION['full_name'] ?? 'Guest User';
$role = $_SESSION['user_role'] ?? 'Guest';
?>
						<p>You were served by <?= htmlspecialchars($full_name); ?></p>
						<a href="javascript:void(0);" class="btn btn-primary">Print Receipt</a>
					</div>
				</div>
			</div>
		</div>
	</div>

				</div>
			</div>
		</div>
		<!-- /Print Receipt -->


      