<!DOCTYPE html>
<html lang="en">
<?php 

include_once "./includes/session_check.php" ;
include "includes/header.php";?>
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
								<h4>Schedule Delivery</h4>
								<h6>Manage your Deliveries</h6>
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
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Schedule Delivery</a>
						</div>
						
					</div>
					<!-- /product list -->
					<div class="card table-list-card">
						<div class="card-body">
							
						
							<!-- /Filter -->
							<div class="table-responsive">
							<?php
// Database connection
include('config/config.php');

// Fetch deliveries data
$sql = "SELECT 
            d.id, 
            c.customer_name, 
            c.physical_address AS address, 
            d.order_id, 
            o.transaction_id,
            o.total_price as order_total,
            o.payment_status as order_payment_status,
            o.payment_type as order_payment_type,
            DATE_FORMAT(d.schedule_datetime, '%d %b %Y - %H:%i') AS schedule_datetime, 
            CONCAT(e.first_name, ' ', e.last_name) AS driver_name, 
            a.asset_name AS vehicle_name, 
            d.notification_method,
            d.status as delivery_status
        FROM deliveries d
        LEFT JOIN customers c ON d.customer_id = c.id
        LEFT JOIN orders o ON d.order_id = o.id
        LEFT JOIN employees e ON d.driver_id = e.id
        LEFT JOIN assets a ON d.vehicle_id = a.id
        ORDER BY d.schedule_datetime DESC";

$result = mysqli_query($conn, $sql);
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
            <th>Customer</th>
            <th>Order Details</th>
            <th>Address</th>
            <th>Date & Time</th>
            <th>Driver</th>
            <th>Vehicle</th>
            <th>Status</th>
            <th>Notified</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td>
                        <label class="checkboxs">
                            <input type="checkbox">
                            <span class="checkmarks"></span>
                        </label>
                    </td>
                    <td><?= htmlspecialchars($row['customer_name']) ?></td>
                    <td>
                        <?php if ($row['order_id']): ?>
                            <div class="order-details">
                                <strong>Order #<?= htmlspecialchars($row['order_id']) ?></strong><br>
                                <small>Transaction: <?= htmlspecialchars($row['transaction_id']) ?></small><br>
                                <small>Total: KSH <?= number_format($row['order_total'], 2) ?></small><br>
                                <small class="badge badge-<?= $row['order_payment_status'] === 'completed' ? 'success' : 'warning' ?>">
                                    <?= ucfirst(htmlspecialchars($row['order_payment_status'])) ?>
                                </small>
                            </div>
                        <?php else: ?>
                            <span class="text-muted">General Delivery</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td><?= htmlspecialchars($row['schedule_datetime']) ?></td>
                    <td><?= $row['driver_name'] ? htmlspecialchars($row['driver_name']) : '<span class="text-danger">No Driver</span>' ?></td>
                    <td><?= $row['vehicle_name'] ? htmlspecialchars($row['vehicle_name']) : '<span class="text-danger">No Vehicle</span>' ?></td>
                    <td>
                        <span class="badge badge-<?= $row['delivery_status'] === 'Completed' ? 'success' : ($row['delivery_status'] === 'Cancelled' ? 'danger' : 'warning') ?>">
                            <?= htmlspecialchars($row['delivery_status'] ?? 'Pending') ?>
                        </span>
                    </td>
                    <td><?= htmlspecialchars($row['notification_method']) ?></td>
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
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="10" class="text-center">No deliveries found</td>
            </tr>
        <?php endif; ?>
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


<!-- Schedule Delivery Modal -->
<div class="modal fade" id="add-units">
    <div class="modal-dialog modal-dialog-centered stock-adjust-modal">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>SCHEDULE DELIVERY</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form action="schedule.php" method="POST">
                            <div class="row">
                                <!-- Customer Selection -->
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Customer</label>
                                        <select class="select" id="customer-select" name="customer_id" onchange="fetchCustomerDetails(this.value); loadCustomerOrders(this.value);">
                                            <option value="">Choose</option>
                                            <?php
                                            $sql = "SELECT id, customer_name FROM customers";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id']}'>{$row['customer_name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Order Selection -->
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Order (Optional)</label>
                                        <select class="select" id="order-select" name="order_id">
                                            <option value="">Choose Order (Optional)</option>
                                            <!-- Orders will be loaded dynamically via JavaScript -->
                                        </select>
                                        <small class="text-muted">Select an order to link this delivery, or leave empty for general delivery</small>
                                    </div>
                                </div>
                                
                                <!-- Auto-filled Address -->
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Address</label>
                                        <input type="text" class="form-control" id="customer-address" name="address" readonly>
                                    </div>
                                </div>

                                <!-- Order ID (Hidden field for form submission) -->
                                <input type="hidden" name="order_id" id="order-id-hidden" value="">

                                <!-- Date & Time -->
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Schedule Date & Time</label>
                                        <input type="datetime-local" class="form-control" name="schedule_datetime" required>
                                    </div>
                                </div>

                                <!-- Driver Selection -->
                                <div class="col-lg-6">
    <div class="input-blocks">
        <label>Driver</label>
        <select class="select" name="driver_id">
            <option value="">Choose</option>
            <?php
            $sql = "SELECT id, CONCAT(first_name, ' ', last_name) AS full_name FROM employees WHERE designation_id = 4";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['full_name']}</option>";
                }
            } else {
                echo "<option value='' disabled>No drivers available</option>";
            }
            ?>
        </select>
    </div>
</div>


                                <!-- Vehicle Selection -->
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Vehicle</label>
                                        <select class="select" name="vehicle_id">
                                            <option value="">Choose</option>
                                            <?php
                                            $sql = "SELECT id, asset_name FROM assets WHERE category_id = 4";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id']}'>{$row['asset_name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Notification Method -->
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Notification Method</label>
                                        <select class="select" name="notification_method">
                                            <option value="SMS">SMS</option>
                                            <option value="WhatsApp">WhatsApp</option>
											<option value="Email">Email</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Schedule Delivery</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Schedule Delivery Modal -->



<!-- EDIT Schedule Delivery Modal -->
<div class="modal fade" id="edit-units">
    <div class="modal-dialog modal-dialog-centered stock-adjust-modal">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>SCHEDULE DELIVERY</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form action="schedule.php" method="POST">
                            <div class="row">
                                <!-- Customer Selection -->
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Customer</label>
                                        <select class="select" id="customer-select" name="customer_id" onchange="fetchCustomerDetails(this.value); loadCustomerOrders(this.value);">
                                            <option value="">Choose</option>
                                            <?php
                                            $sql = "SELECT id, customer_name FROM customers";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id']}'>{$row['customer_name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Order Selection -->
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Order (Optional)</label>
                                        <select class="select" id="order-select" name="order_id">
                                            <option value="">Choose Order (Optional)</option>
                                            <!-- Orders will be loaded dynamically via JavaScript -->
                                        </select>
                                        <small class="text-muted">Select an order to link this delivery, or leave empty for general delivery</small>
                                    </div>
                                </div>
                                
                                <!-- Auto-filled Address -->
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Address</label>
                                        <input type="text" class="form-control" id="customer-address" name="address" readonly>
                                    </div>
                                </div>

                                <!-- Order ID (Hidden field for form submission) -->
                                <input type="hidden" name="order_id" id="order-id-hidden" value="">

                                <!-- Date & Time -->
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Schedule Date & Time</label>
                                        <input type="datetime-local" class="form-control" name="schedule_datetime" required>
                                    </div>
                                </div>

                                <!-- Driver Selection -->
                                <div class="col-lg-6">
    <div class="input-blocks">
        <label>Driver</label>
        <select class="select" name="driver_id">
            <option value="">Choose</option>
            <?php
            $sql = "SELECT id, CONCAT(first_name, ' ', last_name) AS full_name FROM employees WHERE designation_id = 4";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['full_name']}</option>";
                }
            } else {
                echo "<option value='' disabled>No drivers available</option>";
            }
            ?>
        </select>
    </div>
</div>


                                <!-- Vehicle Selection -->
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Vehicle</label>
                                        <select class="select" name="vehicle_id">
                                            <option value="">Choose</option>
                                            <?php
                                            $sql = "SELECT id, asset_name FROM assets WHERE category_id = 4";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id']}'>{$row['asset_name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Notification Method -->
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Notification Method</label>
                                        <select class="select" name="notification_method">
                                            <option value="SMS">SMS</option>
                                            <option value="WhatsApp">WhatsApp</option>
                                            <option value="Email">Email</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Schedule Delivery</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /EDIT Schedule Delivery Modal -->



  

		 
		<!-- jQuery -->
        <script src="assets/js/jquery-3.7.1.min.js"></script>

        <!-- Feather Icon JS -->
		<script src="assets/js/feather.min.js"></script>

		<!-- Slimscroll JS -->
		<script src="assets/js/jquery.slimscroll.min.js"></script>

		<!-- Datatable JS -->
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/dataTables.bootstrap5.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

		<!-- Summernote JS -->
		<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>

		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>

		<!-- Sweetalert 2 -->
		<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
		<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

		<!-- Custom JS --><script src="assets/js/theme-script.js"></script>	
		<script src="assets/js/script.js"></script>

		<script>

function fetchCustomerDetails(customerId) {
    if (customerId) {
        fetch(`fetch_delivery_customer.php?id=${customerId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById("customer-address").value = data.physical_address;
            })
            .catch(error => console.error("Error fetching customer details:", error));
    } else {
        document.getElementById("customer-address").value = "";
        document.getElementById("order-select").innerHTML = '<option value="">Choose Order (Optional)</option>';
        document.getElementById("order-id-hidden").value = "";
    }
}

function loadCustomerOrders(customerId) {
    const orderSelect = document.getElementById("order-select");
    const orderIdHidden = document.getElementById("order-id-hidden");
    
    if (customerId) {
        fetch(`fetch_customer_orders.php?customer_id=${customerId}`)
            .then(response => response.json())
            .then(data => {
                orderSelect.innerHTML = '<option value="">Choose Order (Optional)</option>';
                
                if (data.success && data.orders.length > 0) {
                    data.orders.forEach(order => {
                        const option = document.createElement('option');
                        option.value = order.id;
                        option.textContent = `Order #${order.id} - ${order.transaction_id} - KSH ${order.total_price} (${order.payment_status})`;
                        orderSelect.appendChild(option);
                    });
                } else {
                    const option = document.createElement('option');
                    option.value = "";
                    option.textContent = "No orders found for this customer";
                    option.disabled = true;
                    orderSelect.appendChild(option);
                }
            })
            .catch(error => {
                console.error("Error fetching customer orders:", error);
                orderSelect.innerHTML = '<option value="">Error loading orders</option>';
            });
    } else {
        orderSelect.innerHTML = '<option value="">Choose Order (Optional)</option>';
        orderIdHidden.value = "";
    }
}

// Handle order selection change
document.addEventListener('DOMContentLoaded', function() {
    const orderSelect = document.getElementById("order-select");
    if (orderSelect) {
        orderSelect.addEventListener('change', function() {
            document.getElementById("order-id-hidden").value = this.value;
        });
    }
});

		</script>

	
    </body>
</html>