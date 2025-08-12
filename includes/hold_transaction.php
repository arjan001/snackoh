	<!-- Hold -->
	<div class="modal fade modal-default pos-modal" id="hold-order" aria-labelledby="hold-order">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header p-4">
					<h5>Hold Order</h5>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body p-4">
					<form id="holdOrderForm">
						<h2 class="text-center p-4 btn-secondary" id="hold-total">KSH 0.00</h2>
						<div class="input-block">
							<label>Order Reference (Optional)</label>
							<input class="form-control" type="text" id="hold-reference" placeholder="Enter reference to identify this order">
						</div>
						<p>The current order will be set on hold. You can retrieve this order from the pending orders
							button. Providing a reference to it might help you to identify the order more quickly.</p>
						<div class="modal-footer d-sm-flex justify-content-end">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							<button type="button" class="btn btn-primary" onclick="holdTransaction()">Confirm Hold</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /Hold -->

	<!-- Pending Orders Modal -->
	<div class="modal fade modal-default pos-modal" id="pending-orders" aria-labelledby="pending-orders">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header p-4">
					<h5>Pending Orders</h5>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body p-4">
					<div id="pending-orders-list">
						<!-- Dynamic content will be loaded here -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Pending Orders Modal -->

	<script>
	// Function to hold transaction
	function holdTransaction() {
		var cartData = localStorage.getItem('cart') || '[]';
		var totalPrice = parseFloat(localStorage.getItem('totalPrice') || 0);
		var reference = $('#hold-reference').val().trim();
		
		if (totalPrice <= 0) {
			alert('No items in cart to hold.');
			return;
		}
		
		$.ajax({
			url: 'hold_transaction.php',
			type: 'POST',
			data: {
				cart: cartData,
				total_price: totalPrice,
				reference: reference
			},
			dataType: 'json',
			success: function(response) {
				if (response.success) {
					// Clear cart
					localStorage.removeItem('cart');
					localStorage.removeItem('totalPrice');
					updateCartUI();
					
					// Close modal
					$('#hold-order').modal('hide');
					
					// Show success message
					alert('Order held successfully!');
				} else {
					alert('Error holding order: ' + response.message);
				}
			},
			error: function() {
				alert('Error holding order. Please try again.');
			}
		});
	}

	// Function to load pending orders
	function loadPendingOrders() {
		$.ajax({
			url: 'get_held_transactions.php',
			type: 'GET',
			dataType: 'json',
			success: function(response) {
				if (response.success) {
					displayPendingOrders(response.data);
				} else {
					$('#pending-orders-list').html('<p class="text-center">Error loading pending orders.</p>');
				}
			},
			error: function() {
				$('#pending-orders-list').html('<p class="text-center">Error loading pending orders.</p>');
			}
		});
	}

	// Function to display pending orders
	function displayPendingOrders(orders) {
		if (orders.length === 0) {
			$('#pending-orders-list').html('<p class="text-center">No pending orders found.</p>');
			return;
		}
		
		var html = '<div class="table-responsive"><table class="table table-striped">';
		html += '<thead><tr><th>Reference</th><th>Total</th><th>Date</th><th>Actions</th></tr></thead><tbody>';
		
		orders.forEach(function(order) {
			html += '<tr>';
			html += '<td>' + order.reference + '</td>';
			html += '<td>KSH ' + order.total_price + '</td>';
			html += '<td>' + order.created_at + '</td>';
			html += '<td>';
			html += '<button class="btn btn-sm btn-primary me-2" onclick="retrieveOrder(\'' + order.hold_id + '\')">Retrieve</button>';
			html += '<button class="btn btn-sm btn-danger" onclick="voidOrder(\'' + order.hold_id + '\')">Void</button>';
			html += '</td>';
			html += '</tr>';
		});
		
		html += '</tbody></table></div>';
		$('#pending-orders-list').html(html);
	}

	// Function to retrieve order
	function retrieveOrder(holdId) {
		$.ajax({
			url: 'get_held_transactions.php',
			type: 'GET',
			dataType: 'json',
			success: function(response) {
				if (response.success) {
					var order = response.data.find(function(o) { return o.hold_id === holdId; });
					if (order) {
						// Load cart data
						localStorage.setItem('cart', JSON.stringify(order.cart_data));
						localStorage.setItem('totalPrice', order.total_price.replace(',', ''));
						updateCartUI();
						
						// Close modal
						$('#pending-orders').modal('hide');
						
						alert('Order retrieved successfully!');
					}
				}
			}
		});
	}

	// Function to void order
	function voidOrder(holdId) {
		if (confirm('Are you sure you want to void this order? This action cannot be undone.')) {
			$.ajax({
				url: 'delete_held_transaction.php',
				type: 'POST',
				data: { hold_id: holdId },
				dataType: 'json',
				success: function(response) {
					if (response.success) {
						// Reload pending orders
						loadPendingOrders();
						alert('Order voided successfully!');
					} else {
						alert('Error voiding order: ' + response.message);
					}
				},
				error: function() {
					alert('Error voiding order. Please try again.');
				}
			});
		}
	}

	// Update hold modal when shown
	$('#hold-order').on('show.bs.modal', function() {
		var totalPrice = localStorage.getItem('totalPrice') || 0;
		$('#hold-total').text('KSH ' + parseFloat(totalPrice).toFixed(2));
		$('#hold-reference').val('');
	});

	// Load pending orders when modal is shown
	$('#pending-orders').on('show.bs.modal', function() {
		loadPendingOrders();
	});
	</script>