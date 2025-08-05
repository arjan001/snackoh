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
								<h4>SCHEDULE BATCH PRODUCTION</h4>
								<h6>Manage your Batch Schedules</h6>
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
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#scheduleBatchModal"><i data-feather="plus-circle" class="me-2"></i>Schedule Batch</a>
                            

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
										<div class="layout-hide-box">
											<a href="javascript:void(0);" class="me-3 layout-box"><i data-feather="layout" class="feather-search feather-20"></i></a>
											<div class="layout-drop-item card">
												<div class="drop-item-head">
													<h5>Want to manage datatable?</h5>
													<p>Please drag and drop your column to reorder your table and enable see option as you want.</p>
												</div>
												<ul>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Shop</span>
															<input type="checkbox" id="option1" class="check" checked>
															<label for="option1" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Product</span>
															<input type="checkbox" id="option2" class="check" checked>
															<label for="option2" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Reference No</span>
															<input type="checkbox" id="option3" class="check" checked>
															<label for="option3" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Date</span>
															<input type="checkbox" id="option4" class="check" checked>
															<label for="option4" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Responsible Person</span>
															<input type="checkbox" id="option5" class="check" checked>
															<label for="option5" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Notes</span>
															<input type="checkbox" id="option6" class="check" checked>
															<label for="option6" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Quantity</span>
															<input type="checkbox" id="option7" class="check" checked>
															<label for="option7" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Actions</span>
															<input type="checkbox" id="option8" class="check" checked>
															<label for="option8" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
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
include_once "./config/config.php";

// Fetch production batches with product name and assigned employee
$sql = "SELECT 
            pb.batch_id, 
            p.product_name, 
            pb.start_time, 
            pb.end_time, 
            CONCAT(e.first_name, ' ', e.last_name) AS assigned_staff, 
            pb.status 
        FROM production_batches pb
        LEFT JOIN products p ON pb.product_id = p.id
        LEFT JOIN employees e ON pb.assigned_employee_id = e.id";

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
            <th>Scheduled Batch ID</th>
            <th>Product Name</th>
            <th>Start Date & Time</th>
            <th>End Date & Time</th>
            <th>Assigned Staff</th>
            <th>Status</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td>
                    <label class="checkboxs">
                        <input type="checkbox">
                        <span class="checkmarks"></span>
                    </label>
                </td>
                <td><?php echo htmlspecialchars($row['batch_id']); ?></td>
                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                <td><?php echo htmlspecialchars($row['start_time']); ?></td>
                <td><?php echo htmlspecialchars($row['end_time']); ?></td>
                <td><?php echo htmlspecialchars($row['assigned_staff'] ?: 'Not Assigned'); ?></td>
                <td>
                    <span class="badge badge-<?php echo ($row['status'] == 'Upcoming') ? 'warning' : 'success'; ?>">
                        <?php echo htmlspecialchars($row['status']); ?>
                    </span>
                </td>
                <td class='action-table-data'>
    <div class='edit-delete-action'>
        <a class='me-2 p-2 edit-btn' href='#' data-bs-toggle='modal' data-bs-target='#editscheduleBatchModal' data-id='<?php echo $row["id"]; ?>'>
            <i data-feather='edit' class='feather-edit'></i>
        </a>
        <a class='confirm-text p-2 delete-btn' href='javascript:void(0);' data-id='<?php echo $row["id"]; ?>'>
            <i data-feather='trash-2' class='feather-trash-2'></i>
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

<!-- Production Schedule Modal -->
<div class="modal fade" id="scheduleBatchModal" tabindex="-1" aria-labelledby="scheduleBatchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleBatchModalLabel">Schedule Production Batch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="scheduleBatchForm" method="POST" action="insert_schedule_batch.php">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="scheduledBatchId" class="form-label">Batch ID</label>
                                <input type="text" class="form-control" id="scheduledBatchId" name="batch_id" placeholder="Auto-generated" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="productUsed" class="form-label">Product Name</label>
                                <select class="form-control" id="productUsed" name="product_id" required>
                                    <option value="">Select Product</option>
                                    <?php
                                    $sql = "SELECT id, product_name FROM products";
                                    $result = $conn->query($sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='".$row['id']."'>".$row['product_name']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="recipeUsed" class="form-label">Select or Create Recipe</label>
                                <select class="form-control" id="recipeUsed" name="recipe_id" required>
                                    <option value="">Select Recipe</option>
                                    <?php
                                    $query = "SELECT id, recipe_name FROM recipes";
                                    $stmt = $conn->prepare($query);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='".htmlspecialchars($row['id'])."'>".htmlspecialchars($row['recipe_name'])."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="priority" class="form-label">Priority</label>
                                <select class="form-control" id="priority" name="priority">
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="startTime" class="form-label">Start Date & Time</label>
                                <input type="datetime-local" class="form-control" id="startTime" name="start_time" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="endTime" class="form-label">End Date & Time</label>
                                <input type="datetime-local" class="form-control" id="endTime" name="end_time" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="assignedEmployee" class="form-label">Assign Employees</label>
                                <select class="form-control" id="assignedEmployee" name="employee_id" required>
                            <option value="">Select Employee</option>
                            <?php
                            $sql = "SELECT id, first_name, last_name FROM employees";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='".htmlspecialchars($row['id'])."'>".htmlspecialchars($row['first_name'])." ".htmlspecialchars($row['last_name'])."</option>";
                            }
                            ?>
                        </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Upcoming">Upcoming</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer-btn">
                        <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-submit">Schedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Production Schedule Modal -->


<!-- edit Production Schedule Modal -->
<div class="modal fade" id="editscheduleBatchModal" tabindex="-1" aria-labelledby="scheduleBatchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleBatchModalLabel">Schedule Production Batch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="scheduleBatchForm" method="POST" action="insert_schedule_batch.php">
                <input type="hidden" id="editBatchId" name="batch_id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="scheduledBatchId" class="form-label">Batch ID</label>
                                <input type="text" class="form-control" id="scheduledBatchId" name="batch_id" placeholder="Auto-generated" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="productUsed" class="form-label">Product Name</label>
                                <select class="form-control" id="productUsed" name="product_id" required>
                                    <option value="">Select Product</option>
                                    <?php
                                    $sql = "SELECT id, product_name FROM products";
                                    $result = $conn->query($sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='".$row['id']."'>".$row['product_name']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="recipeUsed" class="form-label">Select or Create Recipe</label>
                                <select class="form-control" id="recipeUsed" name="recipe_id" required>
                                    <option value="">Select Recipe</option>
                                    <?php
                                    $query = "SELECT id, recipe_name FROM recipes";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='".$row['id']."'>".$row['recipe_name']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="priority" class="form-label">Priority</label>
                                <select class="form-control" id="priority" name="priority">
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="startTime" class="form-label">Start Date & Time</label>
                                <input type="datetime-local" class="form-control" id="startTime" name="start_time" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="endTime" class="form-label">End Date & Time</label>
                                <input type="datetime-local" class="form-control" id="endTime" name="end_time" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="assignedEmployee" class="form-label">Assign Employees</label>
                                <select class="form-control" id="assignedEmployee" name="employee_id" required>
                            <option value="">Select Employee</option>
                            <?php
                            $sql = "SELECT id, first_name, last_name FROM employees";
                            $result = $conn->query($sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='".$row['id']."'>".$row['first_name']." ".$row['last_name']."</option>";
                            }
                            ?>
                        </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Upcoming">Upcoming</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer-btn">
                        <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-submit">Schedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit Production Schedule Modal -->



  

		<?php include "includes/footer.php";?>

        <script>
                // Generate Batch ID on modal open
    $("#scheduleBatchModal").on("show.bs.modal", function () {
        let currentMonth = new Date().getMonth() + 1;
        let currentTime = new Date().getHours() + "" + new Date().getMinutes();
        let randomString = Math.random().toString(36).substring(2, 6).toUpperCase();
        let batchId = `SNK-${currentMonth}-${currentTime}${randomString}`;
        $("#scheduledBatchId").val(batchId);
    });

    // delete schedule_batch code..

    $(document).on("click", ".delete-btn", function () {
    var batchId = $(this).data("id");
    if (confirm("Are you sure you want to delete this batch?")) {
        $.ajax({
            url: "delete_scheduled_batch.php",
            type: "POST",
            data: { batch_id: batchId },
            success: function (response) {
                alert(response);
                location.reload();
            }
        });
    }
});

// populate edit schedule batch modal
$(document).ready(function () {
    $(".edit-btn").click(function () {
        var batchId = $(this).data("id");

        $.ajax({
            url: "fetch_scheduled_batch_details.php",
            type: "POST",
            data: { batch_id: batchId },
            dataType: "json",
            success: function (data) {
                $("#editBatchId").val(data.id);
                $("#productUsed").val(data.product_id);
                $("#recipeUsed").val(data.recipe_id);
                $("#priority").val(data.priority);
                $("#startTime").val(data.start_time);
                $("#endTime").val(data.end_time);
                $("#assignedEmployee").val(data.employee_id);
                $("#status").val(data.status);
            }
        });
    });
});


        </script>

	
    </body>
</html>