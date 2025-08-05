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
						<h6 id="business-name">Snackoh Bakers</h6>
						<p class="mb-0">Phone Number: <span id="business-phone">+254 700 000 000</span></p>
						<p class="mb-0">Email: <a href="mailto:info@snackohbakers.co.ke" id="business-email">info@snackohbakers.co.ke</a></p>
					</div>
					<div class="tax-invoice">
						<h6 class="text-center">Tax Invoice</h6>
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<div class="invoice-user-name"><span>Name: </span><span id="customer-name">Walk-in Customer</span></div>
								<div class="invoice-user-name"><span>Invoice No: </span><span id="invoice-no">-</span></div>
							</div>
							<div class="col-sm-12 col-md-6">
								<div class="invoice-user-name"><span>Customer Id: </span><span id="customer-id">N/A</span></div>
								<div class="invoice-user-name"><span>Date: </span><span id="order-date">-</span></div>
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
						<tbody id="receipt-items">
							<!-- Dynamic items will be loaded here -->
						</tbody>
					</table>
					<div class="text-center invoice-bar">
						<p>**VAT against this challan is payable through central registration. Thank you for your business!</p>
						<a href="javascript:void(0);">
							<img src="assets/img/barcode/barcode-03.jpg" alt="Barcode">
						</a>
						<p id="sale-number">Sale -</p>
						<p>Thank You For Shopping With Us. Please Come Again</p>
						<p>You were served by <span id="employee-name">System</span></p>
						<a href="javascript:void(0);" class="btn btn-primary" onclick="printReceipt()">Print Receipt</a>
					</div>
				</div>
			</div>
		</div>
	</div>

				</div>
			</div>
		</div>
		<!-- /Print Receipt -->

		<script>
		// Global variables to store receipt data
		let currentReceiptData = null;
		let currentTransactionId = null;
		let currentOrderId = null;

		// Function to load receipt data
		function loadReceiptData(transactionId, orderId) {
			currentTransactionId = transactionId;
			currentOrderId = orderId;
			
			$.ajax({
				url: 'get_receipt_data.php',
				type: 'GET',
				data: {
					transaction_id: transactionId,
					order_id: orderId
				},
				dataType: 'json',
				success: function(response) {
					if (response.success) {
						currentReceiptData = response.data;
						populateReceipt(response.data);
					} else {
						alert('Error loading receipt: ' + response.message);
					}
				},
				error: function() {
					alert('Error loading receipt data. Please try again.');
				}
			});
		}

		// Function to populate receipt with data
		function populateReceipt(data) {
			// Business info
			$('#business-name').text(data.business_info.name);
			$('#business-phone').text(data.business_info.phone);
			$('#business-email').text(data.business_info.email);
			$('#business-email').attr('href', 'mailto:' + data.business_info.email);

			// Receipt info
			$('#invoice-no').text(data.receipt_info.invoice_no);
			$('#order-date').text(data.receipt_info.date);
			$('#sale-number').text('Sale ' + data.receipt_info.sale_number);

			// Customer info
			$('#customer-name').text(data.customer_info.name);
			$('#customer-id').text(data.customer_info.customer_id);

			// Employee
			$('#employee-name').text(data.employee);

			// Items
			let itemsHtml = '';
			data.items.forEach(function(item, index) {
				itemsHtml += `
					<tr>
						<td>${index + 1}. ${item.product_name}</td>
						<td>KSH ${parseFloat(item.unit_price).toFixed(2)}</td>
						<td>${item.quantity}</td>
						<td class="text-end">KSH ${(item.quantity * item.unit_price).toFixed(2)}</td>
					</tr>
				`;
			});

			// Add totals
			itemsHtml += `
				<tr>
					<td colspan="4">
						<table class="table-borderless w-100 table-fit">
							<tr>
								<td>Sub Total :</td>
								<td class="text-end">KSH ${data.totals.subtotal}</td>
							</tr>
							<tr>
								<td>Discount :</td>
								<td class="text-end">-KSH ${data.totals.discount}</td>
							</tr>
							<tr>
								<td>Shipping :</td>
								<td class="text-end">KSH ${data.totals.shipping}</td>
							</tr>
							<tr>
								<td>Tax (${data.totals.tax_rate}) :</td>
								<td class="text-end">KSH ${data.totals.tax_amount}</td>
							</tr>
							<tr>
								<td>Total Bill :</td>
								<td class="text-end">KSH ${data.totals.total}</td>
							</tr>
							<tr>
								<td>Due :</td>
								<td class="text-end">KSH ${data.totals.due}</td>
							</tr>
							<tr>
								<td>Total Payable :</td>
								<td class="text-end">KSH ${data.totals.total}</td>
							</tr>
						</table>
					</td>
				</tr>
			`;

			$('#receipt-items').html(itemsHtml);
		}

		// Function to print receipt
		function printReceipt() {
			if (!currentReceiptData) {
				alert('No receipt data available to print.');
				return;
			}

			// Create a new window for printing
			let printWindow = window.open('', '_blank');
			let printContent = `
				<!DOCTYPE html>
				<html>
				<head>
					<title>Receipt - ${currentReceiptData.receipt_info.invoice_no}</title>
					<style>
						body { font-family: Arial, sans-serif; margin: 20px; }
						.header { text-align: center; margin-bottom: 20px; }
						.business-info { text-align: center; margin-bottom: 20px; }
						.invoice-title { text-align: center; font-weight: bold; margin-bottom: 15px; }
						.customer-info { margin-bottom: 20px; }
						table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
						th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
						.text-end { text-align: right; }
						.footer { text-align: center; margin-top: 20px; }
						@media print {
							body { margin: 0; }
							.no-print { display: none; }
						}
					</style>
				</head>
				<body>
					<div class="header">
						<h2>${currentReceiptData.business_info.name}</h2>
						<p>${currentReceiptData.business_info.phone} | ${currentReceiptData.business_info.email}</p>
					</div>
					
					<div class="invoice-title">
						<h3>Tax Invoice</h3>
					</div>
					
					<div class="customer-info">
						<p><strong>Name:</strong> ${currentReceiptData.customer_info.name}</p>
						<p><strong>Invoice No:</strong> ${currentReceiptData.receipt_info.invoice_no}</p>
						<p><strong>Customer ID:</strong> ${currentReceiptData.customer_info.customer_id}</p>
						<p><strong>Date:</strong> ${currentReceiptData.receipt_info.date}</p>
					</div>
					
					<table>
						<thead>
							<tr>
								<th>Item</th>
								<th>Price</th>
								<th>Qty</th>
								<th class="text-end">Total</th>
							</tr>
						</thead>
						<tbody>
			`;

			// Add items
			currentReceiptData.items.forEach(function(item, index) {
				printContent += `
					<tr>
						<td>${index + 1}. ${item.product_name}</td>
						<td>KSH ${parseFloat(item.unit_price).toFixed(2)}</td>
						<td>${item.quantity}</td>
						<td class="text-end">KSH ${(item.quantity * item.unit_price).toFixed(2)}</td>
					</tr>
				`;
			});

			// Add totals
			printContent += `
						</tbody>
					</table>
					
					<table>
						<tr>
							<td>Sub Total:</td>
							<td class="text-end">KSH ${currentReceiptData.totals.subtotal}</td>
						</tr>
						<tr>
							<td>Tax (${currentReceiptData.totals.tax_rate}):</td>
							<td class="text-end">KSH ${currentReceiptData.totals.tax_amount}</td>
						</tr>
						<tr>
							<td><strong>Total Payable:</strong></td>
							<td class="text-end"><strong>KSH ${currentReceiptData.totals.total}</strong></td>
						</tr>
					</table>
					
					<div class="footer">
						<p>Thank You For Shopping With Us. Please Come Again</p>
						<p>Served by: ${currentReceiptData.employee}</p>
						<p>Sale ${currentReceiptData.receipt_info.sale_number}</p>
					</div>
					
					<div class="no-print" style="margin-top: 20px; text-align: center;">
						<button onclick="window.print()">Print Receipt</button>
						<button onclick="window.close()">Close</button>
					</div>
				</body>
				</html>
			`;

			printWindow.document.write(printContent);
			printWindow.document.close();
		}
		</script>


      