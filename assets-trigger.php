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
							<h4>ASSET TRIGGERS</h4>
							<h6>VIEW ALL YOUR ASSETS TRIGGERS</h6>
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
include_once "./config/config.php";

date_default_timezone_set('UTC');
$today = date('Y-m-d');
$one_month_later = date('Y-m-d', strtotime('+1 month'));
$two_months_later = date('Y-m-d', strtotime('+2 months'));

$sql = "SELECT rp.id, rp.asset_id, rp.serial_number, rp.replacement_date, rp.asset_condition, 
               a.asset_name
        FROM asset_replacement_policy rp
        JOIN assets a ON rp.asset_id = a.id
        WHERE DATE(rp.replacement_date) >= ? AND DATE(rp.replacement_date) <= ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $today, $two_months_later);
$stmt->execute();
$result = $stmt->get_result();

$assets = [];
while ($row = $result->fetch_assoc()) {
    $days_left = ceil((strtotime($row['replacement_date']) - time()) / (60 * 60 * 24));

    $assets[] = [
        "id" => $row["id"],
        "asset_name" => $row["asset_name"],
        "serial_number" => $row["serial_number"],
        "days_left" => $days_left,
        "asset_condition" => $row["asset_condition"],
        "replacement_date" => $row["replacement_date"]
    ];
}

?>


<table class="table datanew" id="assets-table">
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
            <th>Days Left</th>
			<th>Replacement Date</th>
            <th>Condition</th>
            
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($assets)) : ?>
            <?php foreach ($assets as $asset) : ?>
                <tr>
                    <td>
                        <label class="checkboxs">
                            <input type="checkbox" value="<?= $asset['id'] ?>" class="asset-checkbox">
                            <span class="checkmarks"></span>
                        </label>
                    </td>
                    <td><?= $asset['asset_name'] ?></td>
                    <td> <?= $asset['serial_number'] ?></td>
                    
                    <td>
                        <?php
                        $badgeClass = ($asset['days_left'] <= 30) ? 'bg-danger' : 'bg-warning';
                        echo "<span class='badge $badgeClass'>{$asset['days_left']} Days</span>";
                        ?>
                    </td>
                    <td> <?= $asset['replacement_date'] ?></td>
                    <td><?= $asset['asset_condition'] ?></td>
                 
                    <td class="action-table-data">
                        <div class="edit-delete-action">
                            <a href="javascript:void(0);" class="me-2 p-2 notify-trigger" 
                               data-id="<?= $asset['id'] ?>" data-name="<?= $asset['asset_name'] ?>"
                               data-bs-toggle="modal" data-bs-target="#send-email">
                               <i data-feather="user"></i>
                            </a>
                            <a href="javascript:void(0);" class="me-2 p-2 update-status" 
                               data-id="<?= $asset['id'] ?>" data-name="<?= $asset['asset_name'] ?>"
                               data-bs-toggle="modal" data-bs-target="#update-status">
                               <i data-feather="edit" class="feather-edit"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
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


<!-- Send Email Modal -->
<div class="modal fade" id="send-email" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ASSETs REPLACENT TRIGGER</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
			<div class="modal-body custom-modal-body">
                        <form id="emailNotificationForm" action="send_email.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Select Employees to Alert</label>
                                <div class="employee-list">
                                    <?php
                                    include_once "./config/config.php";

                                    $sql = "SELECT id, first_name, last_name, email FROM employees WHERE user_role IS NOT NULL";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $employeeID = $row['id'];
                                            $employeeName = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
                                            
                                            echo '<div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="employees[]" value="'.$employeeID.'">
                                                    <label class="form-check-label" for="employee'.$employeeID.'">
                                                        '.$employeeName.'
                                                    </label>
                                                  </div>';
                                        }
                                    } else {
                                        echo '<p class="text-muted">No employees with roles found.</p>';
                                    }
                                    ?>
                                </div>
                            </div>

                           

                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Send Email</button>
                            </div>
                        </form>
                    </div>
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div class="modal fade" id="update-status" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Asset Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Update the replacement status of this asset.</p>
                <button class="btn btn-success">Mark as Replaced</button>
            </div>
        </div>
    </div>
</div>


	 
<?php include "includes/footer.php";?>
<script>
$(document).ready(function () {
    if (!$.fn.DataTable.isDataTable('#assets-table')) {
        $('#assets-table').DataTable({
            "language": {
                "emptyTable": "No assets due for replacement in the next 1-2 months"
            }
        });
    }



    $(document).on("click", ".notify-trigger", function () {
        let assetID = $(this).data("id");
        let assetName = $(this).data("name");
        $("#send-email").data("asset-id", assetID);
        $("#send-email .modal-title").text(`Notify: ${assetName} Needs Replacement`);
    });

    $(document).on("click", ".update-status", function () {
        let assetID = $(this).data("id");
        let assetName = $(this).data("name");
        $("#update-status").data("asset-id", assetID);
        $("#update-status .modal-title").text(`Update Status: ${assetName}`);
    });
});
</script>

</body>

</html>