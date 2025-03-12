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
						<!-- <div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#reportWasteModal"><i data-feather="plus-circle" class="me-2"></i>Report Waste</a>
                            

						</div> -->
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


<!-- production report Table -->
<table class="table datanew">
    <thead>
        <tr>
            <th>Report Name</th>
            <th>Date Range</th>
            <th>Total Production</th>
            <th>Wastage</th>
            <th>Cost</th>
            <th>Efficiency (%)</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Weekly Production Summary</td>
            <td>2025-03-01 to 2025-03-07</td>
            <td>500 kg</td>
            <td>20 kg</td>
            <td>$1,200</td>
            <td>96%</td>
            <td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewProductionReportModal">View</button>
                <button class="btn btn-success btn-sm">Download</button>
            </td>
        </tr>
        <tr>
            <td>Ingredient Usage Report</td>
            <td>2025-03-08 to 2025-03-14</td>
            <td>480 kg</td>
            <td>18 kg</td>
            <td>$1,100</td>
            <td>97%</td>
            <td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewProductionReportModal">View</button>
                
            </td>
        </tr>
    </tbody>
</table>
<!-- production report Table -->





							</div>
						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

<!-- filterReport Modal -->
<div class="modal fade" id="filterReportModal" tabindex="-1" aria-labelledby="filterReportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterReportModalLabel">Filter Production Reports</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="filterReportForm">
                    <div class="mb-3">
                        <label for="reportDateRange" class="form-label">Select Date Range</label>
                        <input type="date" class="form-control" id="reportStartDate">
                        <input type="date" class="form-control mt-2" id="reportEndDate">
                    </div>
                    <div class="mb-3">
                        <label for="reportType" class="form-label">Select Report Type</label>
                        <select class="form-control" id="reportType">
                            <option value="ingredient_usage">Ingredient Usage</option>
                            <option value="batch_performance">Batch Performance</option>
                            <option value="waste_summary">Waste Summary</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- filterReport Modal -->

<!-- Wastage Report Modal -->
<div class="modal fade" id="viewProductionReportModal" tabindex="-1" aria-labelledby="viewProductionReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewProductionReportModalLabel">Production Report Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Report Name:</strong> <span id="reportName">Weekly Production Summary</span></p>
                        <p><strong>Date Range:</strong> <span id="reportDateRange">2025-03-01 to 2025-03-07</span></p>
                        <p><strong>Total Production:</strong> <span id="reportTotalProduction">500 kg</span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Total Wastage:</strong> <span id="reportWastage">20 kg</span></p>
                        <p><strong>Production Cost:</strong> <span id="reportCost">$1,200</span></p>
                        <p><strong>Efficiency:</strong> <span id="reportEfficiency">96%</span></p>
                    </div>
                </div>
                <hr>
                <p><strong>Key Insights:</strong></p>
                <ul>
                    <li>Efficiency is above 95%, indicating optimal production.</li>
                    <li>Wastage is within acceptable limits.</li>
                    <li>Monitor ingredient usage trends for cost savings.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Download Report</button>
            </div>
        </div>
    </div>
</div>
<!-- Wastage Report Modal -->
                       



  

		<?php include "includes/footer.php";?>

	
    </body>
</html>