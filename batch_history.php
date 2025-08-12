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
								<h4>BATCH PRODUCTION HISTORIES</h4>
								<h6>VIEW AL YOUR PRODUCTION HISTORY</h6>
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
            <th>Quantity</th>
            <th>Production Date</th>
            <th>Completion Date</th>
            <th>Status</th>
            <th>Produced By</th>
        </tr>
    </thead>
    <tbody id="batchHistoryBody">
        <!-- Data will be loaded here via AJAX -->
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







		
		<!-- /Edit Stock -->

  

		<?php include "includes/footer.php";?>
		<script>
$(document).ready(function () {
    function loadBatchHistory() {
        $.ajax({
            url: "fetch_batch_history.php",
            type: "GET",
            dataType: "json",
            success: function (data) {
                let tableBody = $("#batchHistoryBody");
                tableBody.empty(); // Clear previous data

                if (data.length > 0) {
                    data.forEach(function (batch) {
                        let statusClass = batch.status === "Pending" ? "badge-warning" : "badge-success";

                        let row = `
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>${batch.batch_id}</td>
                                <td>${batch.product_name}</td>
                                <td>${batch.category_name}</td>
                                <td>${batch.quantity_produced}</td>
                                <td>${batch.production_datetime}</td>
                                <td>${batch.estimated_completion}</td>
                                <td><span class="badge ${statusClass}">${batch.status}</span></td>
                                <td>${batch.produced_by || "N/A"}</td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });
                } else {
                    tableBody.append("<tr><td colspan='9' class='text-center'>No batch history found.</td></tr>");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching batch history:", xhr.responseText);
            }
        });
    }

    // Load data on page load
    loadBatchHistory();

    // Refresh every 30 seconds (optional)
    setInterval(loadBatchHistory, 30000);
});



		</script>

	
    </body>
</html>