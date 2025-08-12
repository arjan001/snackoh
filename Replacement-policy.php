<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php";

include_once "./includes/session_check.php";
?>

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
							<h4>REPLACEMENT POLICIES</h4>
							<h6>Manage your Policies</h6>
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
						<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-policy"><i
								data-feather="plus-circle" class="me-2"></i>Add New Policy</a>
					</div>
				</div>
				<!-- /product list -->
				<div class="card table-list-card">
					<div class="card-body">
						<div class="table-top">
							<div class="search-set">
								<div class="search-input">
									<a href="" class="btn btn-searchset"><i data-feather="search"
											class="feather-search"></i></a>
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

						<div class="table-responsive">
							<?php
							// Database connection
							include('config/config.php');

							// Fetch data from asset_replacement_policy table
							$query = "SELECT arp.*, a.asset_name, a.serial_number, a.current_cost FROM asset_replacement_policy arp 
          JOIN assets a ON arp.asset_id = a.id";
							$stmt = $conn->prepare($query);
							$stmt->execute();
							$result = $stmt->get_result();
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
										<th>Asset Name</th>
										<th>Serial Number</th>
										<th>Purchase Date</th>
										<th>Purchase Price</th>
										<th>Current Value</th>
										<th>Replacement Policy</th>
										<th>Replacement Date</th>
										<th>Condition</th>
										<th class="no-sort">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php while ($row = mysqli_fetch_assoc($result)): ?>
										<tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>
											<td><?= htmlspecialchars($row['asset_name']); ?></td>
											<td><?= htmlspecialchars($row['serial_number']); ?></td>
											<td><?= htmlspecialchars($row['purchase_date']); ?></td>
											<td>KSH <?= number_format($row['current_cost'], 2); ?></td>
											<td>KSH <?= number_format($row['current_value'], 2); ?></td>
											<td class="">
												
												<button type="button" class="policy-link btn btn-outline-success rounded btn-wave" data-policy="<?= htmlspecialchars($row['policy_description']); ?>"
													data-years="<?= $row['policy_years']; ?>">
													<?= htmlspecialchars($row['policy_years']) . " years"; ?>
										</button>
											</td>
											<td><?= htmlspecialchars($row['replacement_date']); ?></td>
											<td><?= htmlspecialchars($row['asset_condition']); ?></td>
											<td class="action-table-data">
												<div class="edit-delete-action">

													<a class="me-2 p-2 edit-policy" href="#" data-id="<?= $row['id']; ?>"
														data-bs-toggle="modal" data-bs-target="#edit-asset">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="confirm-text p-2 delete-policy"
														href="delete_policy.php?id=<?= $row['id']; ?>"
														onclick="return confirm('Are you sure you want to delete this policy?');">
														<i data-feather="trash-2" class="feather-trash-2"></i>
													</a>
												</div>
											</td>
										</tr>
									<?php endwhile; ?>
								</tbody>
							</table>

							<!-- Replacement Policy Modal -->
							<div class="modal fade" id="policyModal" tabindex="-1" aria-labelledby="policyModalLabel"
								aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="policyModalLabel">Replacement Policy</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"
												aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<strong>Years:</strong> <span id="policyYears"></span><br>
											<strong>Description:</strong>
											<p id="policyDescription"></p>
										</div>
									</div>
								</div>
							</div>





						</div>
					</div>
				</div>
				<!-- /product list -->
			</div>
		</div>
	</div>
	<!-- /Main Wrapper -->

	<!-- Add Policy Modal -->
	<div class="modal fade" id="add-policy">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Add Asset Replacement Policy</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form id="addPolicyForm" method="POST">
								<div class="row">
									<!-- Asset Name (Dynamic Select) -->
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Asset Name</label>
											<select class="form-control" name="asset_id" id="asset_id" required>
												<option value="">Select Asset</option>
												<!-- Options will be loaded dynamically -->
											</select>
										</div>
									</div>

									<!-- Serial Number (Auto Fetched) -->
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Serial Number</label>
											<input type="text" class="form-control" id="serial_number"
												name="serial_number" readonly required>
										</div>
									</div>

									<!-- Purchase Date -->
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Purchase Date</label>
											<input type="date" class="form-control" id="purchase_date"
												name="purchase_date" required>
										</div>
									</div>

									<!-- Replacement Policy (User Input) -->
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Replacement Policy (Years)</label>
											<input type="number" class="form-control" id="policy_years"
												name="policy_years" min="1" required>
										</div>
									</div>

									<!-- Replacement Date (Auto Calculated) -->
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Replacement Date</label>
											<input type="date" class="form-control" id="replacement_date"
												name="replacement_date" readonly required>
										</div>
									</div>

									<!-- Current Value (Auto Fetched from DB) -->
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Current Value</label>
											<input type="number" class="form-control" id="current_value"
												name="current_value" step="0.01" required>
										</div>
									</div>

									<!-- Condition -->
									<div class="col-lg-12 pe-0">
										<div class="mb-3">
											<label class="form-label">Condition</label>
											<select class="form-control" name="condition" required>
												<option value="New">New</option>
												<option value="Good">Good</option>
												<option value="Fair">Fair</option>
												<option value="Needs Replacement">Needs Replacement</option>
											</select>
										</div>
									</div>

									<!-- Replacement Policy Description (Missing Field Added) -->
									<div class="col-lg-12">
										<div class="mb-3">
											<label class="form-label">Replacement Policy Description</label>
											<textarea class="form-control" id="policy_description"
												name="policy_description" required></textarea>
										</div>
									</div>
								</div>

								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Add Policy Modal -->



		<!-- Add Policy Modal -->

		<!-- edit Policy Modal -->


	<?php include "includes/footer.php"; ?>
	<script>

		$(document).ready(function () {
			// Fetch asset names for the dropdown
			$.ajax({
				url: 'fetch_assets.php',
				type: 'GET',
				success: function (data) {
					$('#asset_id').append(data);
				}
			});

			// Fetch serial number & current cost when asset is selected
			$('#asset_id').change(function () {
				var asset_id = $(this).val();
				if (asset_id) {
					$.ajax({
						url: 'fetch_asset_details.php',
						type: 'POST',
						data: { asset_id: asset_id },
						success: function (response) {
							var asset = JSON.parse(response);
							$('#serial_number').val(asset.serial_number);
							$('#current_value').val(asset.current_cost); // Auto-fill current cost
						}
					});
				} else {
					$('#serial_number').val('');
					$('#current_value').val('');
				}
			});

			// Auto-calculate replacement date
			$('#purchase_date, #policy_years').on('change', function () {
				var purchaseDate = new Date($('#purchase_date').val());
				var years = parseInt($('#policy_years').val());

				if (!isNaN(purchaseDate) && !isNaN(years)) {
					purchaseDate.setFullYear(purchaseDate.getFullYear() + years);
					$('#replacement_date').val(purchaseDate.toISOString().split('T')[0]);
				}
			});

			// Handle form submission
			$('#addPolicyForm').submit(function (e) {
				e.preventDefault();
				$.ajax({
					url: 'insert_policy.php',
					type: 'POST',
					data: $(this).serialize(),
					success: function (response) {
						alert(response);
						$('#add-policy').modal('hide');
						location.reload();
					}
				});
			});
		});

	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function () {
			document.querySelectorAll(".policy-link").forEach(function (link) {
				link.addEventListener("click", function (event) {
					event.preventDefault();
					let policyYears = this.getAttribute("data-years");
					let policyDescription = this.getAttribute("data-policy");

					document.getElementById("policyYears").innerText = policyYears + " years";
					document.getElementById("policyDescription").innerText = policyDescription;

					let modal = new bootstrap.Modal(document.getElementById("policyModal"));
					modal.show();
				});
			});
		});
	</script>




</body>

</html>