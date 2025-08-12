<!DOCTYPE html>
<html lang="en">

<?php  include_once "./includes/session_check.php" ;?>
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
							<h4>Assets List</h4>
							<h6>Manage your Assets</h6>
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
							data-bs-target="#add-assets"><i data-feather="plus-circle" class="me-2"></i>Add New
							Assets</a>
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
            <th>Asset Name</th>
            <th>Category</th>
            <th>Company Code</th>
            <th>Serial Number</th>
            <!-- <th>Registration No</th> -->
            <th>Initial Cost</th>
            <th>Current Cost</th>
            <th>Status</th>
            <th>Next Maintenance</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
       include('config/config.php');

        $query = "SELECT a.*, c.category_name FROM assets a 
                  JOIN asset_category c ON a.category_id = c.id";
        $result = $conn->query($query);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>
                    <label class='checkboxs'>
                        <input type='checkbox'>
                        <span class='checkmarks'></span>
                    </label>
                </td>
                <td>{$row['asset_name']}</td>
                <td>{$row['category_name']}</td>
                <td>{$row['company_code']}</td>
                <td>{$row['serial_number']}</td>
                
                <td>KSH {$row['initial_cost']}</td>
                <td>KSH {$row['current_cost']}</td>
                <td>{$row['status']}</td>
                <td>{$row['next_maintenance']}</td>
                <td class='action-table-data'>
                    <div class='edit-delete-action'>
                        <a class='me-2 edit-icon p-2' href='product-details.php?id={$row['id']}'>
                            <i data-feather='eye' class='feather-eye'></i>
                        </a>
                        <a class='me-2 p-2' href='edit-product.php?id={$row['id']}'>
                            <i data-feather='edit' class='feather-edit'></i>
                        </a>
                        <a class='confirm-text p-2' href='delete-asset.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>
                            <i data-feather='trash-2' class='feather-trash-2'></i>
                        </a>
                    </div>
                </td>
            </tr>";
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

	<!--add  ASSETS popup -->
	<div class="modal fade" id="add-assets">
		<div class="modal-dialog add-centered">
			<div class="modal-content">
				<div class="page-wrapper p-0 m-0">
					<div class="content p-0">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4> Add New Assets</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="card">
						<?php
include('config/config.php');

// Fetch asset categories
$categoryQuery = "SELECT id, category_name FROM asset_category WHERE status = 1";
$categoryResult = $conn->query($categoryQuery);
?>

<div class="card-body">
    <form action="add_assets.php" method="POST">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-12">
                <div class="mb-3">
                    <label class="form-label">Asset Name</label>
                    <input type="text" class="form-control" name="asset_name" required>
                </div>
            </div>
            
            <div class="col-lg-6 col-sm-6 col-12">
                <div class="input-blocks mb-5">
                    <label>Choose Category</label>
                    <select class="form-control" name="category_id" required>
                        <option value="">Choose</option>
                        <?php while ($row = $categoryResult->fetch_assoc()) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['category_name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="mb-3">
                    <label class="form-label">Company Code</label>
                    <input type="text" class="form-control" name="company_code" required>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="mb-3">
                    <label class="form-label">Registration Number(Number Plate -Strictly for cars only)</label>
                    <input type="text" class="form-control" name="registration_number">
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="mb-3">
                    <label class="form-label">Initial Cost</label>
                    <input type="number" class="form-control" name="initial_cost" step="0.01" required>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="mb-3">
                    <label class="form-label">Current Cost</label>
                    <input type="number" class="form-control" name="current_cost" step="0.01" required>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="input-blocks mb-5">
                    <label>Status</label>
                    <select class="form-control" name="status" required>
                        <option value="">Choose</option>
                        <option value="Operational">Operational</option>
                        <option value="Maintenance Required">Maintenance Required</option>
                        <option value="Out of Service">Out of Service</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="mb-3">
                    <label class="form-label">Next Maintenance</label>
                    <input type="date" class="form-control" name="next_maintenance" required>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="input-blocks mb-5">
                    <label>Ownership</label>
                    <select class="form-control" name="ownership" required>
                        <option value="">Choose</option>
                        <option value="Owned">Owned</option>
                        <option value="Leased">Leased</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="mb-3">
                    <label class="form-label">Maintenance Cost</label>
                    <input type="number" class="form-control" name="maintenance_cost" step="0.01" required>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="mb-3">
                    <label class="form-label">Depreciation Factor</label>
                    <input type="number" class="form-control" name="depreciation_factor" step="0.01" required>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="mb-3">
                    <label class="form-label">Lifespan (Years)</label>
                    <input type="number" class="form-control" name="lifespan" required>
                </div>
            </div>
        </div>

        <div class="modal-footer-btn">
            <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-submit create">Create Asset</button>
        </div>
    </form>
</div>





							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- /add ASSETS popup -->


	
	<?php include "includes/footer.php"; ?>

</body>

</html>