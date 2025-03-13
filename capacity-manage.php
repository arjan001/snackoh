<!DOCTYPE html>
<html lang="en">
<?php  include_once "./includes/session_check.php" ;?>
<?php include "includes/header.php"; ?>

<body>
	<div id="global-loader">
		<div class="whirly-loader"> </div>
	</div>
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
							<h4>Capacity Managet</h4>
							<h6>Manage Asset Capacities</h6>
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
					<div class="page-btn">
						<ts href="add-product.php" class="btn btn-added" data-bs-toggle="modal"
							data-bs-target="#add-capacity"><i data-feather="plus-circle" class="me-2"></i>Add Capacity</a>
					</div>

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
include('config/config.php');

$query = "SELECT cm.id, a.asset_name, cm.category, cm.max_capacity, cm.current_usage, cm.available_capacity, cm.status, cm.last_updated 
          FROM capacity_management cm
          JOIN assets a ON cm.asset_id = a.id";

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
            <th>Production Unit</th>
            <th>Category</th>
            <th>Max Capacity</th>
            <th>Current Usage (%)</th>
            <th>Available Capacity</th>
            <th>Status</th>
            <th>Last Updated</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
<tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td>
                    <label class="checkboxs">
                        <input type="checkbox">
                        <span class="checkmarks"></span>
                    </label>
                </td>
                <td><?php echo htmlspecialchars($row['asset_name']); ?></td>
                <td><?php echo htmlspecialchars($row['category']); ?></td>
                <td><?php echo htmlspecialchars($row['max_capacity']) . " kg/day"; ?></td>
                <td><?php echo htmlspecialchars($row['current_usage']) . "%"; ?></td>
                <td><?php echo htmlspecialchars($row['available_capacity']) . " kg"; ?></td>
                <td>
                    <?php 
                        $status = htmlspecialchars($row['status']);
                        $badgeClass = ($status == 'Near Limit') ? 'bg-warning' : (($status == 'Full') ? 'bg-danger' : 'bg-success');
                    ?>
                    <span class="badge <?php echo $badgeClass; ?>"><?php echo $status; ?></span>
                </td>
                <td><?php echo date("d M Y", strtotime($row['last_updated'])); ?></td>
                <td class='action-table-data'>
    <div class='edit-delete-action'>
 <!-- Edit Action -->
<a class="me-2 p-2 edit-btn" href="#" data-bs-toggle="modal" data-bs-target="#edit_capacity" 
   data-id="<?= $row['id']; ?>" data-product-unit="<?= $row['asset_name']; ?>" 
   data-category="<?= $row['category']; ?>" data-max-capacity="<?= $row['max_capacity']; ?>" 
   data-current-usage="<?= $row['current_usage']; ?>" data-available-capacity="<?= $row['available_capacity']; ?>" 
   data-status="<?= $row['status']; ?>" data-last-updated="<?= $row['last_updated']; ?>">
    <i data-feather="edit" class="feather-edit"></i>
</a>

        <!-- Delete Action -->
        <a class='confirm-text p-2' href='delete_capacity.php?id=<?php echo $row['id']; ?>' onclick="return confirm('Are you sure you want to delete this record?');">
            <i data-feather='trash-2' class='feather-trash-2'></i>
        </a>
    </div>
</td>

            </tr>
        <?php endwhile; ?>
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

<!-- Add Capacity Management Popup -->
<div class="modal fade" id="add-capacity">
    <div class="modal-dialog add-centered">
        <div class="modal-content">
            <div class="page-wrapper p-0 m-0">
                <div class="content p-0">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Add Capacity Record</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="insert_capacity.php" method="POST">
                                <div class="row">
                                    <!-- Product Unit (Asset Name) -->
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Product Unit</label>
                                            <select class="form-control" name="product_unit" id="product-unit" required>
                                                <option value="">Choose</option>
                                                <?php
                                                    $query = "SELECT a.id, a.asset_name, c.category_name FROM assets a 
                                                              JOIN asset_category c ON a.category_id = c.id";
                                                    $result = $conn->query($query);
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<option value='{$row['id']}' data-category='{$row['category_name']}'>{$row['asset_name']}</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Auto-filled Category (Non-editable) -->
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Category</label>
                                            <input type="text" class="form-control" name="category" id="category" readonly required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Max Capacity (kg/day)</label>
                                            <input type="number" class="form-control" name="max_capacity" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Current Usage (%)</label>
                                            <input type="number" class="form-control" name="current_usage" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Available Capacity (kg)</label>
                                            <input type="number" class="form-control" name="available_capacity" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status" required>
                                                <option value="">Choose</option>
                                                <option value="Available">Available</option>
                                                <option value="Near Limit">Near Limit</option>
                                                <option value="Overloaded">Overloaded</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Last Updated</label>
                                            <input type="date" class="form-control" name="last_updated" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer-btn">
                                    <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-submit">Save Record</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Add Capacity Management Popup -->

<!-- Edit Capacity Management Popup -->
<div class="modal fade" id="edit_capacity" tabindex="-1">
    <div class="modal-dialog add-centered">
        <div class="modal-content">
            <div class="modal-header border-0 custom-modal-header">
                <h4>Edit Capacity Record</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <form id="editCapacityForm" action="update_capacity.php" method="POST">
                        <!-- Hidden field to store capacity ID -->
                        <input type="hidden" name="capacity_id" id="capacity-id">
                        
                        <div class="row">
                            <!-- Product Unit (Asset Name) -->
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Product Unit</label>
                                    <select class="form-control" name="product_unit" id="edit-product-unit" required>
                                        <option value="">Choose</option>
                                        <?php
                                            $query = "SELECT a.id, a.asset_name, c.category_name FROM assets a 
                                                      JOIN asset_category c ON a.category_id = c.id";
                                            $result = $conn->query($query);
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='{$row['id']}' data-category='{$row['category_name']}'>{$row['asset_name']}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Auto-filled Category -->
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <input type="text" class="form-control" name="category" id="edit-category" readonly required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Max Capacity (kg/day)</label>
                                    <input type="number" class="form-control" name="max_capacity" id="edit-max-capacity" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Current Usage (%)</label>
                                    <input type="number" class="form-control" name="current_usage" id="edit-current-usage" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Available Capacity (kg)</label>
                                    <input type="number" class="form-control" name="available_capacity" id="edit-available-capacity" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-control" name="status" id="edit-status" required>
                                        <option value="Available">Available</option>
                                        <option value="Near Limit">Near Limit</option>
                                        <option value="Overloaded">Overloaded</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Last Updated</label>
                                    <input type="date" class="form-control" name="last_updated" id="edit-last-updated" required>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer-btn">
                            <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-submit">Update Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Capacity Management Popup -->





	<?php include "includes/footer.php"; ?>
<!-- code po populating  asset category dynamically -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
$(document).ready(function() {
    $("#product-unit").on("change", function() {
        var selectedCategory = $(this).find("option:selected").data("category");
        $("#category").val(selectedCategory);
    });
});

$(document).ready(function() {
    $('.edit-btn').click(function() {
        let capacityId = $(this).data('id');

        $.ajax({
            url: 'fetch_capacity_details.php',
            type: 'POST',
            data: { capacity_id: capacityId },
            dataType: 'json',
            success: function(response) {
                $('#capacity-id').val(response.id);
                $('#edit-product-unit').val(response.asset_id).change();
                $('#edit-category').val(response.category);
                $('#edit-max-capacity').val(response.max_capacity);
                $('#edit-current-usage').val(response.current_usage);
                $('#edit-available-capacity').val(response.available_capacity);
                $('#edit-status').val(response.status);
                $('#edit-last-updated').val(response.last_updated);

                $('#edit_capacity').modal('show');
            }
        });
    });

    // Update category field based on selected asset
    $('#edit-product-unit').change(function() {
        let selectedCategory = $(this).find(':selected').data('category');
        $('#edit-category').val(selectedCategory);
    });
});

</script>
</body>

</html>