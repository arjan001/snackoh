<!DOCTYPE html>
<html lang="en">
<?php
include_once "./includes/session_check.php" ;
include "includes/header.php";?>
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
								<h4>WASTE MANAGEMENT</h4>
								<h6>Manage your Batch Productions Waste</h6>
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
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#reportWasteModal"><i data-feather="plus-circle" class="me-2"></i>Report Waste</a>
                            

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


<!-- Wastage Management Table -->
<table class="table datanew">
    <thead>
        <tr>
            <th>Batch ID</th>
            <!-- <th>Product Name</th> -->
            <th>Wastage Type</th>
            <th>Quantity Wasted</th>
            <th>Reason</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
	<?php
$query = "
SELECT pw.batch_id, p.product_name, c.category_name, r.recipe_name, 
	   nb.production_datetime AS production_date, 
	   pw.created_at AS wastage_date, 
	   pw.wastage_type, pw.quantity_wasted, pw.reason
FROM production_wastage pw
JOIN new_batch_production nb ON pw.batch_id = nb.batch_id
JOIN recipes r ON nb.recipe_id = r.id
JOIN products p ON nb.product_id = p.id
JOIN product_category c ON nb.category_id = c.id
ORDER BY pw.created_at DESC
";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

?>

<tbody>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= htmlspecialchars($row['batch_id']); ?></td>
		<!-- <td><?= htmlspecialchars($row['product_name']); ?></td> -->
            <td><?= htmlspecialchars($row['wastage_type']); ?></td>
            <td><?= htmlspecialchars($row['quantity_wasted']) . ' kg'; ?></td>
            <td><?= htmlspecialchars($row['reason']); ?></td>
			<td>
                    <button class='btn btn-primary viewReportBtn' 
                        data-batch="<?= htmlspecialchars($row['batch_id']); ?>"
                        data-product="<?= htmlspecialchars($row['product_name']); ?>"
                        data-category="<?= htmlspecialchars($row['category_name']); ?>"
                        data-recipe="<?= htmlspecialchars($row['recipe_name']); ?>"
                        data-production-date="<?= htmlspecialchars($row['production_date']); ?>"
                        data-wastage-date="<?= htmlspecialchars($row['wastage_date']); ?>"
                        data-type="<?= htmlspecialchars($row['wastage_type']); ?>"
                        data-quantity="<?= htmlspecialchars($row['quantity_wasted']); ?>"
                        data-reason="<?= htmlspecialchars($row['reason']); ?>">
                        View Report
                    </button>
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

<!-- Waste Reporting Modal -->
<div class="modal fade" id="reportWasteModal" tabindex="-1" aria-labelledby="reportWasteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportWasteModalLabel">Report Wastage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reportWasteForm" method="POST" action="process_wastage.php">
                    <div class="mb-3">
                        <label for="wasteBatchId" class="form-label">Batch ID</label>
                        <select class="form-control" id="wasteBatchId" name="batch_id" required>
                            <option value="">Select Batch</option>
                            <?php
                            include_once "./config/config.php";
                            $query = "SELECT batch_id FROM new_batch_production ORDER BY batch_id DESC";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='".htmlspecialchars($row['batch_id'])."'>".htmlspecialchars($row['batch_id'])."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="wasteType" class="form-label">Wastage Type</label>
                        <select class="form-control" id="wasteType" name="wastage_type" required>
                            <option value="">Select Wastage Type</option>
                            <option value="Spoilage">Spoilage</option>
                            <option value="Overproduction">Overproduction</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="wasteQuantity" class="form-label">Quantity Wasted</label>
                        <input type="number" class="form-control" id="wasteQuantity" name="quantity_wasted" placeholder="Enter quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="wasteReason" class="form-label">Reason</label>
                        <textarea class="form-control" id="wasteReason" name="reason" rows="3" placeholder="Describe the reason" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit for Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Waste Reporting Modal -->


<!-- Wastage Report Modal -->
<div class="modal fade" id="wastageReportModal" tabindex="-1" aria-labelledby="wastageReportLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg rounded">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="wastageReportLabel">Wastage Report</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div id="printArea">
                    <div class="mb-3">
                        <h4 class="text-dark">Batch Details</h4>
                        <hr>
                        <p><strong>Batch ID:</strong> <span id="reportBatchID" class="text-muted"></span></p>
                        <p><strong>Product Name:</strong> <span id="reportProduct" class="text-muted"></span></p>
                        <p><strong>Category:</strong> <span id="reportCategory" class="text-muted"></span></p>
                        <p><strong>Recipe Used:</strong> <span id="reportRecipe" class="text-muted"></span></p>
                        <p><strong>Production Date:</strong> <span id="reportProductionDate" class="text-muted"></span></p>
                    </div>

                    <div class="mb-3">
                        <h4 class="text-danger">Wastage Details</h4>
                        <hr>
                        <p><strong>Date Wastage Was Made:</strong> <span id="reportWastageDate" class="text-muted"></span></p>
                        <p><strong>Wastage Type:</strong> <span id="reportType" class="text-muted"></span></p>
                        <p><strong>Quantity Wasted:</strong> <span id="reportQuantity" class="text-muted"></span></p>
                        <p><strong>Reason:</strong> <span id="reportReason" class="text-muted"></span></p>
                    </div>
                </div>
            </div>

            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="printReportBtn">
                    <i class="fas fa-print"></i> Print Report
                </button>
            </div>
        </div>
    </div>
</div>





  

		<?php include "includes/footer.php";?>
		<script>
    document.getElementById("reportWasteForm").addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch("insert_wastage.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            if (data === "success") {
                alert("Wastage reported successfully!");
                location.reload(); // Reload page to show new data
            } else {
                alert("Error: " + data);
            }
        })
        .catch(error => console.error("Error:", error));
    });

	// view report modal form logic
	$(document).ready(function () {
    // Populate the modal with data when the View Report button is clicked
    $(".viewReportBtn").click(function () {
        $("#reportBatchID").text($(this).data("batch"));
        $("#reportProduct").text($(this).data("product"));
        $("#reportCategory").text($(this).data("category"));
        $("#reportRecipe").text($(this).data("recipe"));
        $("#reportProductionDate").text($(this).data("production-date"));
        $("#reportWastageDate").text($(this).data("wastage-date"));
        $("#reportType").text($(this).data("type"));
        $("#reportQuantity").text($(this).data("quantity") + " kg");
        $("#reportReason").text($(this).data("reason"));

        $("#wastageReportModal").modal("show");
    });

    // Print functionality
    $("#printReportBtn").click(function () {
        var printContent = document.getElementById("printArea").innerHTML;
        var originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
        location.reload(); // Reload to restore functionality
    });
});



	




</script>


	
    </body>
</html>