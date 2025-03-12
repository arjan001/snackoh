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
        <tr>
            <td>
                <label class="checkboxs">
                    <input type="checkbox">
                    <span class="checkmarks"></span>
                </label>
            </td>
            <td>Oven 1</td>
            <td>Baking</td>
            <td>500 kg/day</td>
            <td>80%</td>
            <td>100 kg</td>
            <td><span class="badge bg-warning">Near Limit</span></td>
            <td>12 Mar 2025</td>
            <td class='action-table-data'>
                <div class='edit-delete-action'>
                   
					
                    <a class='me-2 p-2' href='#' data-bs-toggle='modal' data-bs-target='#edit_customer' data-id='" . $row['id'] . "'>
                        <i data-feather='edit' class='feather-edit'></i>
                    </a>

					
                    <a class='confirm-text p-2' href='javascript:void(0);'>
                        <i data-feather='trash-2' class='feather-trash-2'></i>
                    </a>
                </div>
              </td>
        </tr>
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
                            <form action="#" method="POST">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Production Unit</label>
                                            <input type="text" class="form-control" name="production_unit" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Category</label>
                                            <select class="form-control" name="category" required>
                                                <option value="">Choose</option>
                                                <option value="Baking">Baking</option>
                                                <option value="Mixing">Mixing</option>
                                                <option value="Packaging">Packaging</option>
                                            </select>
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



	
	<?php include "includes/footer.php"; ?>

</body>

</html>