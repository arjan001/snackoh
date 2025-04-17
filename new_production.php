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
								<h4>NEW BATCH PRODUCTION</h4>
								<h6>Manage your Batch Productions</h6>
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
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#newProductionBatchModal"><i data-feather="plus-circle" class="me-2"></i>Create New Batch</a>
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


                            <table class="table datanew">
    <thead>
        <tr>
            <th class="no-sort">
                <label class="checkboxs">
                    <input type="checkbox" id="select-all">
                    <span class="checkmarks"></span>
                </label>
            </th>
            <th>Batch ID</th>
            <th>Item Name</th>
            <th>Category</th>
            <!-- <th>Recipe Used</th> -->
            <th>Quantity</th>
            <th>Production Date</th>
            <th>Estimated Time</th>
            <th>Status</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once "./config/config.php";

        // Fetch data with JOINs to get product name and category name
        $query = "
            SELECT nb.batch_id, p.product_name, c.category_name, nb.recipe_id, nb.quantity_produced, 
                   nb.production_datetime, nb.estimated_completion, nb.status, nb.id
            FROM new_batch_production nb
            JOIN recipes r ON nb.recipe_id = r.id
            JOIN products p ON nb.product_id = p.id
            JOIN product_category c ON nb.category_id = c.id
            ORDER BY nb.id DESC
        ";

        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>
                    <label class='checkboxs'>
                        <input type='checkbox' value='{$row['id']}'>
                        <span class='checkmarks'></span>
                    </label>
                  </td>";
            echo "<td>{$row['batch_id']}</td>";
            echo "<td>{$row['product_name']}</td>";
            echo "<td>{$row['category_name']}</td>";
            // echo "<td>{$row['recipe_id']}</td>";
            echo "<td>{$row['quantity_produced']} Loaves</td>";
            echo "<td>{$row['production_datetime']}</td>";
            echo "<td>{$row['estimated_completion']}</td>";

            // Status badge styling
            $status_badge = match ($row['status']) {
                "Pending" => "badge-warning",
                "In Progress" => "badge-info",
                "Completed" => "badge-success",
                default => "badge-secondary"
            };

            echo "<td><span class='badge {$status_badge}'>{$row['status']}</span></td>";
            echo "<td class='action-table-data'>
                    <div class='edit-delete-action'>
                        
                        <a class='confirm-text p-2 delete-btn' href='javascript:void(0);' data-id='{$row['id']}'>
                            <i data-feather='trash-2' class='feather-trash-2'></i>
                        </a>

                        <a class='me-2 p-2' href='#' data-bs-toggle='modal' data-bs-target='#update_production'data-id='{$row['id']}'>
                                    <i data-feather='edit' class='feather-edit'></i>
                                </a>
                    </div>
                  </td>";
            echo "</tr>";
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

<!-- New Production Batch Modal -->

<?php
include_once "./config/config.php";

// Update batch status to 'Completed' if current time is past estimated completion .. also write logic for when status is pending system will auto update to inprogress after 30 minutes
$updateQuery = "
    UPDATE new_batch_production
    SET status = 'Completed'
    WHERE status = 'In Progress' AND estimated_completion <= NOW()
";

mysqli_query($conn, $updateQuery);
?>

<div class="modal fade" id="newProductionBatchModal" tabindex="-1" aria-labelledby="newProductionBatchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newProductionBatchModalLabel">New Production Batch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="newBatchForm" method="POST" action="insert_batch.php">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="batchId" class="form-label">Batch ID</label>
                                <input type="text" class="form-control" id="batchId" name="batch_id" placeholder="Auto-generated" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="itemName" class="form-label">Item Name</label>
                                <select class="form-control" id="itemName" name="product_id" required>
                                    <option value="">Select Item</option>
                                    <option value="Whole Wheat Bread">Whole Wheat Bread</option>
                                    <option value="Croissant">Croissant</option>
                                    <option value="Baguette">Baguette</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="category" name="category" placeholder="Auto-filled" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="recipeUsed" class="form-label">Recipe Used</label>
                                <select class="form-control" id="recipeUsed" name="recipe_id" required>
                                    <option value="">Select Recipe</option>
                                    <?php
                                    include_once "./config/config.php";
                                    $query = "SELECT id, recipe_name FROM recipes";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='".$row['id']."'>".$row['recipe_name']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="productionDateTime" class="form-label">Production Date & Time</label>
                                <input type="datetime-local" class="form-control" id="productionDateTime" name="production_datetime" required>
                            </div>
                        </div>

                        <div class="col-md-6">
    <div class="mb-3">
        <label for="completionTime" class="form-label">Estimated Completion</label>
        <input type="datetime-local" class="form-control" id="completionTime" name="estimated_completion" required>
    </div>
</div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity_produced" placeholder="Enter quantity" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Pending">Pending</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer-btn">
                        <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End of New Production Batch Modal -->
<div class="modal fade" id="update_production" tabindex="-1" aria-labelledby="newProductionBatchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newProductionBatchModalLabel">New Production Batch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="newBatchForm" method="POST" action="insert_batch.php">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="batchId" class="form-label">Batch ID</label>
                                <input type="text" class="form-control" id="batchId" name="batch_id" placeholder="Auto-generated" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="itemName" class="form-label">Item Name</label>
                                <select class="form-control" id="itemName" name="product_id" required>
                                    <option value="">Select Item</option>
                                    <option value="Whole Wheat Bread">Whole Wheat Bread</option>
                                    <option value="Croissant">Croissant</option>
                                    <option value="Baguette">Baguette</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="category" name="category" placeholder="Auto-filled" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="recipeUsed" class="form-label">Recipe Used</label>
                                <select class="form-control" id="recipeUsed" name="recipe_id" required>
                                    <option value="">Select Recipe</option>
                                    <?php
                                    include_once "./config/config.php";
                                    $query = "SELECT id, recipe_name FROM recipes";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='".$row['id']."'>".$row['recipe_name']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="productionDateTime" class="form-label">Production Date & Time</label>
                                <input type="datetime-local" class="form-control" id="productionDateTime" name="production_datetime" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="completionTime" class="form-label">Estimated Completion</label>
                                <input type="datetime-localt" class="form-control" id="completionTime" name="estimated_completion" placeholder="e.g., 3 Hours">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity_produced" placeholder="Enter quantity" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Pending">Pending</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer-btn">
                        <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- edit Production Batch Modal -->


<!-- edit Production Batch Modal -->



  

		<?php include "includes/footer.php";?>

	<script>
        $(document).ready(function () {
    // Fetch products and recipes
    $.get("fetch_batch_data.php", function (response) {
        let data = JSON.parse(response);

        // Populate product dropdown
        let productSelect = $("#itemName");
        productSelect.html('<option value="">Select Item</option>');
        data.products.forEach(product => {
            productSelect.append(`<option value="${product.id}" data-category="${product.category_id}" data-category-name="${product.category_name}">${product.product_name}</option>`);
        });

        // Populate recipe dropdown
        let recipeSelect = $("#recipeUsed");
        recipeSelect.html('<option value="">Select Recipe</option>');
        data.recipes.forEach(recipe => {
            recipeSelect.append(`<option value="${recipe.id}">${recipe.recipe_name}</option>`);
        });
    });

    // Auto-fill category when product is selected
    $("#itemName").change(function () {
        let selectedOption = $(this).find(":selected");
        $("#category").val(selectedOption.data("category-name"));
    });

    // Generate Batch ID on modal open
    $("#newProductionBatchModal").on("show.bs.modal", function () {
        let currentMonth = new Date().getMonth() + 1;
        let currentTime = new Date().getHours() + "" + new Date().getMinutes();
        let randomString = Math.random().toString(36).substring(2, 6).toUpperCase();
        let batchId = `SNK-${currentMonth}-${currentTime}${randomString}`;
        $("#batchId").val(batchId);
    });

    // Submit Form
    $("#newBatchForm").submit(function (e) {
        e.preventDefault();
        let formData = {
            batch_id: $("#batchId").val(),
            product_id: $("#itemName").val(),
            category_id: $("#itemName").find(":selected").data("category"),
            recipe_id: $("#recipeUsed").val(),
            quantity_produced: $("#quantity").val(),
            production_datetime: $("#productionDateTime").val(),
            estimated_completion: $("#completionTime").val(),
            status: $("#status").val()
        };

        $.post("insert_batch.php", formData, function (response) {
            alert(response);
            location.reload();
        });
    });
});

// edit and delete batch code..

$(document).ready(function () {
    $(".edit-delete-action a[data-bs-target='#editProductionBatchModal']").click(function () {
        let batchId = $(this).data("id");

        // Fetch batch data via AJAX
        $.ajax({
            url: "fetch_batch.php",
            type: "POST",
            data: { id: batchId },
            dataType: "json",
            success: function (data) {
                console.log("Fetched Data:", data); // Debugging output

                if (data && !data.error) {
                    $("#batchId").val(data.batch_id);
                    $("#itemName").val(data.product_id);
                    $("#category").val(data.category_name);
                    $("#quantity").val(data.quantity_produced);
                    $("#productionDateTime").val(data.production_datetime);
                    $("#completionTime").val(data.estimated_completion);
                    $("#status").val(data.status);
                } else {
                    console.log("Error: Data is empty or invalid");
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", xhr.responseText);
            }
        });
    });
});


$(document).ready(function () {
    $(".delete-btn").click(function () {
        let batchId = $(this).data("id");

        if (confirm("Are you sure you want to delete this batch?")) {
            $.ajax({
                url: "delete_batch.php",
                type: "POST",
                data: { id: batchId },
                success: function (response) {
                    if (response.trim() === "success") {
                        location.reload();
                    } else {
                        alert("Error deleting batch.");
                    }
                }
            });
        }
    });
});


// update status on batch ajax
function updateBatchStatus() {
    document.querySelectorAll(".batch-status").forEach(statusElement => {
        let expectedCompletion = new Date(statusElement.getAttribute("data-completion"));
        let currentTime = new Date();

        if (currentTime >= expectedCompletion) {
            statusElement.innerText = "Completed";
            statusElement.classList.remove("text-warning"); // Remove "In Progress" color
            statusElement.classList.add("text-success"); // Apply "Completed" color
        }
    });
}

// Run every 10 seconds to check for status updates
setInterval(updateBatchStatus, 10000);



    </script>
    </body>
</html>