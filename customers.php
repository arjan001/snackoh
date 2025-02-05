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
								<h4>Customer List</h4>
								<h6>Manage your warehouse</h6>
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
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-customer"><i data-feather="plus-circle" class="me-2"></i>Add New Customer</a>
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
										<option>Newest</option>
										<option>Oldest</option>
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
													<option>Choose Customer Name</option>
													<option>Benjamin</option>
													<option>Ellen</option>
													<option>Freda</option>
													<option>Kaitlin</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="globe" class="info-img"></i>
												<select class="select">
													<option>Choose Country</option>
													<option>India</option>
													<option>USA</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12 ms-auto">
											<div class="input-blocks">
												<a class="btn btn-filters ms-auto"> <i data-feather="search" class="feather-search"></i> Search </a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Filter -->
							<div class="table-responsive">
								<table class="table  datanew">
									<thead>
										<tr>
											<th class="no-sort">
												<label class="checkboxs">
													<input type="checkbox" id="select-all">
													<span class="checkmarks"></span>
												</label>
											</th>
											<th>Customer  Name</th>
											<th>Segment</th>
											<th>Phone No</th>
											<th>Payment Terms</th>
											<th>Outstanding Balance</th>
											<th>Last Pay Date</th>
											
											<th class="no-sort">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
// Assuming you have already connected to your database
$sql = "SELECT id, customer_name, segment, phone, payment_terms, town FROM customers";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Loop through the result and display the data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><label class='checkboxs'><input type='checkbox'><span class='checkmarks'></span></label></td>";
        echo "<td>" . $row['customer_name'] . "</td>";
        echo "<td>" . $row['segment'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['payment_terms'] . "</td>";
        echo "<td>null</td>"; // Placeholder for outstanding balance
        echo "<td>null</td>"; // Placeholder for last pay date
        echo "<td class='action-table-data'>
                <div class='edit-delete-action'>
                    <a class='me-2 p-2' href='#'>
                        <i data-feather='eye' class='feather-eye'></i>
                    </a>
					
                    <a class='me-2 p-2' href='#' data-bs-toggle='modal' data-bs-target='#edit_customer' data-id='" . $row['id'] . "'>
                        <i data-feather='edit' class='feather-edit'></i>
                    </a>

					
                    <a class='confirm-text p-2' href='javascript:void(0);'>
                        <i data-feather='trash-2' class='feather-trash-2'></i>
                    </a>
                </div>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No customers found</td></tr>";
}
?>
	
	
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

		<!-- Add Customer -->
		<div class="modal fade" id="add-customer">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Customer</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
							<form action="add_customers.php" method="POST">
    <div class="row">
        <div class="col-lg-4 pe-0">
            <div class="mb-3">
                <label class="form-label">Customer Name</label>
                <input type="text" class="form-control" name="customer_name" required>
            </div>
        </div>
        <div class="col-lg-4 pe-0">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
        </div>
        <div class="col-lg-4 pe-0">
            <div class="input-blocks">
                <label class="mb-2">Phone</label>
                <input class="form-control form-control-lg group_formcontrol" name="phone" type="text" required>
            </div>
        </div>
        <div class="col-lg-12 pe-0">
            <div class="mb-3">
                <label class="form-label">Physical Address</label>
                <input type="text" class="form-control" name="physical_address">
            </div>
        </div>
        <div class="col-lg-6 pe-0">
            <div class="mb-3">
                <label class="form-label">Town</label>
                <input type="text" class="form-control" name="town">
            </div>
        </div>
        <div class="col-lg-6 pe-0">
            <div class="mb-3">
                <label class="form-label">Segment</label>
                <select class="select form-control" name="segment">
                    <option value="Retailer">Retailer</option>
                    <option value="Wholesaler">Wholesaler</option>
                    <option value="Distributor">Distributor</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 pe-0">
            <div class="mb-3">
                <label class="form-label">City</label>
                <input type="text" class="form-control" name="city">
            </div>
        </div>
        <div class="col-lg-6 pe-0">
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select class="select form-control" name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>
        <div class="col-lg-12 pe-0">
            <div class="mb-3">
                <label class="form-label">Payment Terms</label>
                <select class="select form-control" name="payment_terms">
                    <option value="Cash">Cash</option>
                    <option value="Credit">Credit</option>
                </select>
            </div>
        </div>
		<div class="col-lg-12 pe-0">
            <div class="mb-3">
                <label class="form-label">Map Location (Type or Click on the map)</label>
                
                <!-- Search Input for Places Autocomplete -->
                <input id="autocomplete" class="form-control" type="text" placeholder="Search for a location..." />

                <!-- Google Map Container -->
                <div id="map" style="height: 400px; border: 1px solid #ccc; margin-top: 10px;"></div>

                <!-- Hidden fields for latitude & longitude -->
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
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
		<!-- /Add Customer -->

        <!-- Edit Customer -->
		<div class="modal fade" id="edit_customer">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Customer</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
							<form action="add_customers.php" method="POST">
							<input type="hidden" name="id" value="<?php echo $customer_id; ?>" />
    <div class="row">
        <div class="col-lg-4 pe-0">
            <div class="mb-3">
                <label class="form-label">Customer Name</label>
                <input type="text" class="form-control" name="customer_name" required>
            </div>
        </div>
        <div class="col-lg-4 pe-0">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
        </div>
        <div class="col-lg-4 pe-0">
            <div class="input-blocks">
                <label class="mb-2">Phone</label>
                <input class="form-control form-control-lg group_formcontrol" name="phone" type="text" required>
            </div>
        </div>
        <div class="col-lg-12 pe-0">
            <div class="mb-3">
                <label class="form-label">Physical Address</label>
                <input type="text" class="form-control" name="physical_address">
            </div>
        </div>
        <div class="col-lg-6 pe-0">
            <div class="mb-3">
                <label class="form-label">Town</label>
                <input type="text" class="form-control" name="town">
            </div>
        </div>
        <div class="col-lg-6 pe-0">
            <div class="mb-3">
                <label class="form-label">Segment</label>
                <select class="select form-control" name="segment">
                    <option value="Retailer">Retailer</option>
                    <option value="Wholesaler">Wholesaler</option>
                    <option value="Distributor">Distributor</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 pe-0">
            <div class="mb-3">
                <label class="form-label">City</label>
                <input type="text" class="form-control" name="city">
            </div>
        </div>
        <div class="col-lg-6 pe-0">
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select class="select form-control" name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>
        <div class="col-lg-12 pe-0">
            <div class="mb-3">
                <label class="form-label">Payment Terms</label>
                <select class="select form-control" name="payment_terms">
                    <option value="Cash">Cash</option>
                    <option value="Credit">Credit</option>
                </select>
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
		<!-- /Edit Customer -->
  
		<script>
// This assumes you have an edit button with class 'edit-btn' and the customer ID as a data attribute
$(document).ready(function() {
    // Open edit modal and populate fields
    $('.edit-btn').on('click', function() {
        // Get the customer ID from the button's data-id attribute
        var customerId = $(this).data('id');
        
        // Make an AJAX call to fetch the customer data based on the ID
        $.ajax({
            url: 'fetch_customer_data.php', // Your script to fetch customer data by ID
            method: 'GET',
            data: { id: customerId },
            success: function(response) {
                // Populate the modal with the returned data
                var data = JSON.parse(response);
                $('input[name="customer_name"]').val(data.customer_name);
                $('input[name="email"]').val(data.email);
                $('input[name="phone"]').val(data.phone);
                $('input[name="physical_address"]').val(data.physical_address);
                $('input[name="town"]').val(data.town);
                $('input[name="city"]').val(data.city);
                $('select[name="segment"]').val(data.segment);
                $('select[name="gender"]').val(data.gender);
                $('select[name="payment_terms"]').val(data.payment_terms);
                // Set the customer ID in the hidden field
                $('input[name="id"]').val(data.id);
            }
        });
    });
});
</script>

		<?php include "includes/footer.php";?>

	
    </body>
</html>