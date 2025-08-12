<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>

<body>
	<!-- <div id="global-loader">
		<div class="whirly-loader"> </div>
	</div> -->
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<?php include "includes/navbar.php"; ?>
		<!-- /Header -->

		<!-- Sidebar -->
		<?php include "includes/sidebar.php"; ?>
		<!-- /Sidebar -->



		<div class="page-wrapper">
			<div class="content">
				<div class="page-header">
					<div class="add-item d-flex">
						<div class="page-title">
							<h4>Fleet List</h4>
							<h6>Manage your Fleet</h6>
						</div>
					</div>
					<ul class="table-top-head">
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
									src="assets/img/icons/pdf.svg" alt="img"></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
									src="assets/img/icons/excel.svg" alt="img"></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer"
									class="feather-rotate-ccw"></i></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i
									data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
									data-feather="chevron-up" class="feather-chevron-up"></i></a>
						</li>
					</ul>
					<!-- <div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-fleet"><i data-feather="plus-circle" class="me-2"></i> Add New Fleet</a>
						</div> -->
					
				</div>

				<!-- /product list -->
				<div class="card table-list-card">
					<div class="card-body">
						<div class="table-top">
							<div class="search-set">
								<div class="search-input">
									<a href="javascript:void(0);" class="btn btn-searchset"><i data-feather="search"
											class="feather-search"></i></a>
								</div>
							</div>
							<div class="search-path">
								<a class="btn btn-filter" id="filter_search">
									<i data-feather="filter" class="filter-icon"></i>
									<span><img src="assets/img/icons/closes.svg" alt="img"></span>
								</a>
							</div>
							<div class="form-sort">
								<i data-feather="sliders" class="info-img"></i>
								<select class="select">
									<option>Sort by Date</option>
									<option>14 09 23</option>
									<option>11 09 23</option>
								</select>
							</div>
						</div>
		
						<div class="table-responsive product-list">
                        <?php
include('config/config.php'); // Include database connection

// Updated SQL Query to correctly join `assets` and `fleet`
$query = "SELECT 
            a.id, 
            a.asset_name AS brand_name, 
            COALESCE(a.registration_number, '') AS number_plate, 
            COALESCE(a.serial_number, '') AS serial_number, 
            COALESCE(a.company_code, '') AS company_code,
            COALESCE(f.insurance, 'N/A') AS insurance,
            COALESCE(f.capacity, 'N/A') AS capacity,
            COALESCE(f.assigned_driver, 'N/A') AS assigned_driver,
            COALESCE(f.last_service_date, 'N/A') AS last_maintenance
          FROM assets a
          LEFT JOIN fleet f ON a.registration_number = f.registration_number
          LEFT JOIN asset_category c ON a.category_id = c.id
          WHERE c.category_name LIKE '%vehicle%'";

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
            <th>Car Name</th>
            <th>Insurance</th>
            <th>Capacity</th>
            <th>Number Plate</th>
            <th>Driver</th>
            <th>Last Maintenance</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = htmlspecialchars($row['id'] ?? '');
                $brand_name = htmlspecialchars($row['brand_name'] ?? '');
                $insurance = htmlspecialchars($row['insurance'] ?? '');
                $capacity = htmlspecialchars($row['capacity'] ?? '');
                $number_plate = htmlspecialchars($row['number_plate'] ?? '');
                $assigned_driver = htmlspecialchars($row['assigned_driver'] ?? '');
                $last_maintenance = htmlspecialchars($row['last_maintenance'] ?? '');

                echo "<tr>
                    <td>
                        <label class='checkboxs'>
                            <input type='checkbox'>
                            <span class='checkmarks'></span>
                        </label>
                    </td>
                    <td>{$brand_name}</td>
                    <td>{$insurance}</td>
                    <td>{$capacity}</td>
                    <td>{$number_plate}</td>
                    <td>{$assigned_driver}</td>
                    <td>{$last_maintenance}</td>
                    <td class='action-table-data'>
                        <div class='edit-delete-action'>
                            <a class='me-2 p-2' href='javascript:void(0);'>
                                <i data-feather='eye' class='action-eye'></i>
                            </a>

                            <a class='me-2 p-2 edit-btn' data-bs-toggle='modal' data-bs-target='#edit-fleet'
                               data-id='$id'
                               data-brand='$brand_name'
                               data-plate='$number_plate'
                               data-insurance='$insurance'
                               data-capacity='$capacity'
                               data-driver='$assigned_driver'
                               data-maintenance='$last_maintenance'>
                                <i data-feather='edit' class='feather-edit'></i>
                            </a>

                            <a class='confirm-text p-2' href='javascript:void(0);'>
                                <i data-feather='trash-2' class='feather-trash-2'></i>
                            </a>
                        </div>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8' class='text-center'>No fleet data found</td></tr>";
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

<!-- EDIT VEHICLE FLEET MANAGEMENT -->
<div class="modal fade" id="edit-fleet">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Edit Vehicle Details</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form action="update_fleet.php" method="POST">
                            <input type="hidden" id="fleet_id" name="fleet_id">

                            <div class="row">
                                <!-- Vehicle Name -->
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="mb-3 add-product">
                                        <label class="form-label">Vehicle Name/Brand</label>
                                        <input type="text" class="form-control" id="vehicle_name" name="vehicle_name" readonly>
                                    </div>
                                </div>

                                <!-- Registration Number -->
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="mb-3 add-product">
                                        <label class="form-label">Registration Number</label>
                                        <input type="text" class="form-control" id="registration_number" name="registration_number" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Insurance -->
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="mb-3 add-product">
                                        <label class="form-label">Insurance</label>
                                        <input type="text" class="form-control" id="insurance" name="insurance" required>
                                    </div>
                                </div>

                                <!-- Vehicle Capacity -->
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="mb-3 add-product">
                                        <label class="form-label">Capacity(KG's)</label>
                                        <input type="number" class="form-control" id="capacity" name="capacity" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Assigned Driver -->
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="mb-3 add-product">
                                        <label class="form-label">Assigned Driver</label>
                                        <select class="select" id="assigned_driver" name="assigned_driver">
                                            <option value="">Choose</option>
                                            <?php
                                            $drivers = $conn->query("SELECT id, CONCAT(first_name, ' ', last_name) AS full_name FROM employees");
                                            while ($driver = $drivers->fetch_assoc()) {
                                                echo "<option value='{$driver['id']}'>" . htmlspecialchars($driver['full_name']) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="mb-3 add-product">
                                        <label class="form-label">Status</label>
                                        <select class="select" id="status" name="status">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                            <option value="Under Maintenance">Under Maintenance</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Last Service Date -->
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <label>Last Service Date</label>
                                        <input type="date" class="form-control" id="last_service_date" name="last_service_date" required>
                                    </div>
                                </div>

                                <!-- Next Service Date -->
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <label>Next Service Date</label>
                                        <input type="date" class="form-control" id="next_service_date" name="next_service_date" required>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Update Vehicle</button>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /EDIT VEHICLE FLEET MANAGEMENT -->




<?php include "includes/footer.php"; ?>
<!-- JS to Populate Modal with Dynamic Data -->
<script>
$(document).ready(function () {
    $('.edit-btn').on('click', function () {
        // Fetch data attributes from the clicked edit button
        var fleetId = $(this).data('id');
        var brand = $(this).data('brand');
        var plate = $(this).data('plate');

        // Populate modal fields with fetched data
        $('#fleet_id').val(fleetId);
        $('#vehicle_name').val(brand);
        $('#registration_number').val(plate);

        // Fetch additional fleet details via AJAX
        $.ajax({
            url: 'get_fleet_details.php', 
            type: 'GET',
            data: { id: fleetId },
            dataType: 'json',
            success: function (data) {
                if (data) {
                    $('#insurance').val(data.insurance || '');
                    $('#capacity').val(data.capacity || '');
                    $('#assigned_driver').val(data.assigned_driver || '');
                    $('#status').val(data.status || 'Active');
                    $('#last_service_date').val(data.last_service_date || '');
                    $('#next_service_date').val(data.next_service_date || '');
                }
            },
            error: function () {
                console.error('Error fetching fleet details');
            }
        });
    });
});

</script>

	 
</body>

</html>