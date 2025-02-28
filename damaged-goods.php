<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; 

include_once "./includes/session_check.php" ;?>

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
							<h4>Damaged Products<i class="fas "></i></h4>
							<h6>Manage your Damaged Goods</h6>
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
						<gedP href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-category"><i
								data-feather="plus-circle" class="me-2"></i>Report Damaged Product</a>
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
								<a class="btn btn-filter" id="filter_search">
									<i data-feather="filter" class="filter-icon"></i>
									<span><img src="assets/img/icons/closes.svg" alt="img"></span>
								</a>
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
						<div class="card" id="filter_inputs">
							<div class="card-body pb-0">
								<div class="row">
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="input-blocks">
											<i data-feather="zap" class="info-img"></i>
											<select class="select">
												<option>Choose Category</option>
												<option>Laptop</option>
												<option>Electronics</option>
												<option>Shoe</option>
											</select>
										</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="input-blocks">
											<i data-feather="calendar" class="info-img"></i>
											<div class="input-groupicon">
												<input type="text" class="datetimepicker" placeholder="Choose Date">
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="input-blocks">
											<i data-feather="stop-circle" class="info-img"></i>
											<select class="select">
												<option>Choose Status</option>
												<option>Active</option>
												<option>Inactive</option>
											</select>
										</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-12 ms-auto">
										<div class="input-blocks">
											<a class="btn btn-filters ms-auto"> <i data-feather="search"
													class="feather-search"></i> Search </a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Filter -->
						<div class="table-responsive">
<?php
require_once 'config/config.php'; // Database connection

$sql = "SELECT dg.*, p.product_name, pc.category_name, 
        CONCAT(e.first_name, ' ', e.last_name) AS employee_name
        FROM damaged_goods dg
        JOIN products p ON dg.product_name = p.id
        JOIN product_category pc ON dg.category_id = pc.id
        JOIN employees e ON dg.reported_by = e.id
        ORDER BY dg.damaged_date DESC";

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
            <th>Product</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Unit</th>
            <th>Damaged Date</th>
            <th>Reported By</th>
            <th>Damage Type</th>
            <th>Location</th>
            <th>Resolution</th>
            <!-- <th class="no-sort">Action</th> -->
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <label class="checkboxs">
                            <input type="checkbox">
                            <span class="checkmarks"></span>
                        </label>
                    </td>
                    <td><?= htmlspecialchars($row['product_name']) ?></td>
                    <td><?= htmlspecialchars($row['category_name']) ?></td>
                    <td><?= intval($row['quantity']) ?></td>
                  <td>PC</td  class="hidden">   <!--  Adjust unit if necessary -->
                    <td><?= date("d M Y", strtotime($row['damaged_date'])) ?></td>
                    <td><?= htmlspecialchars($row['employee_name']) ?></td>
                    <td><?= ucfirst($row['damage_type']) ?></td>
                    <td><?= ucfirst(str_replace('-', ' ', $row['location'])) ?></td>
                    <td><?= ucfirst($row['resolution']) ?></td>
                    <!-- <td class="action-table-data">
                        <div class="edit-delete-action">
                            <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-category">
                                <i data-feather="edit" class="feather-edit"></i>
                            </a>
                            <a class="confirm-text p-2" href="delete_damaged_goods.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">
                                <i data-feather="trash-2" class="feather-trash-2"></i>
                            </a>
                        </div>
                    </td> -->
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="11" class="text-center">No damaged goods reported.</td>
            </tr>
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

	<!-- Add damaged goods -->
	<div class="modal fade" id="add-category">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Report Damaged Item</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
						<?php
require_once 'config/config.php'; // Ensure database connection is included

// Fetch products from the database
$products = [];
$result = $conn->query("SELECT id, product_name FROM products");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Fetch categories from the database
$categories = [];
$result = $conn->query("SELECT id, category_name FROM product_category");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Fetch employee names from the database
$employees = [];
$result = $conn->query("SELECT id, CONCAT(first_name, ' ', last_name) AS full_name FROM employees");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

// Fetch unit names from the database
$units = [];
$result = $conn->query("SELECT id, unit_name FROM units");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $units[] = $row;
    }
}
?>

<form action="insert_damaged_goods.php" method="POST">
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-12">
            <div class="mb-3 add-product">
                <div class="add-newplus">
                    <label class="form-label">Product Name</label>
                </div>
                <select class="select" name="product_name">
                    <option value="">Choose</option>
                    <?php foreach ($products as $product) : ?>
                        <option value="<?= $product['id']; ?>"><?= htmlspecialchars($product['product_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-12">
            <div class="mb-3 add-product">
                <div class="add-newplus">
                    <label class="form-label">Category</label>
                </div>
                <select class="select" name="category_id">
                    <option value="">Choose</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id']; ?>"><?= htmlspecialchars($category['category_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-6 col-12">
            <div class="mb-3 add-product">
                <label class="form-label">Quantity</label>
                <input type="number" class="form-control" name="quantity" required>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-12">
            <div class="mb-3 add-product">
                <div class="add-newplus">
                    <label class="form-label">Units</label>
                </div>
                <select class="select" name="units">
                    <option value="">Choose</option>
                    <?php foreach ($units as $unit) : ?>
                        <option value="<?= $unit['id']; ?>"><?= htmlspecialchars($unit['unit_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-6 col-12">
            <div class="input-blocks">
                <label>Damaged Date</label>
                <div class="input-groupicon calender-input">
                    <input type="date" class="form-control" name="damaged_date" required>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-12">
            <div class="input-blocks add-product">
                <label>Reported by</label>
                <select class="select" name="reported_by">
                    <option value="">Choose</option>
                    <?php foreach ($employees as $employee) : ?>
                        <option value="<?= $employee['id']; ?>"><?= htmlspecialchars($employee['full_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-6 col-12">
            <div class="mb-3 add-product">
                <div class="add-newplus">
                    <label class="form-label">Damage Type</label>
                </div>
                <select class="select" name="damage_type">
                    <option value="Physical">Physical</option>
                    <option value="Quality">Quality</option>
                    <option value="Expiry">Expiry</option>
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-12">
            <div class="mb-3 add-product">
                <div class="add-newplus">
                    <label class="form-label">Location</label>
                </div>
                <select class="select" name="location">
                    <option value="Inventory">Inventory</option>
                    <option value="Transit">Transit</option>
                    <option value="Store">Store</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-12">
            <div class="mb-3 add-product">
                <div class="add-newplus">
                    <label class="form-label">Resolution</label>
                </div>
                <select class="select" name="resolution">
                    <option value="Return to Inventory">Return to Inventory</option>
                    <option value="Dispose">Dispose</option>
                </select>
            </div>
        </div>
    </div>

    <div class="modal-footer-btn">
        <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-submit">Submit Report</button>
    </div>
</form>


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Add damaged goods -->

	<!-- ediit  damaged goods -->
	<div class="modal fade" id="add-category">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Report Damaged Item</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
						<?php
require_once 'config/config.php'; // Ensure database connection is included

// Fetch products from the database
$products = [];
$result = $conn->query("SELECT id, product_name FROM products");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Fetch categories from the database
$categories = [];
$result = $conn->query("SELECT id, category_name FROM product_category");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Fetch employee names from the database
$employees = [];
$result = $conn->query("SELECT id, CONCAT(first_name, ' ', last_name) AS full_name FROM employees");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

// Fetch unit names from the database
$units = [];
$result = $conn->query("SELECT id, unit_name FROM units");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $units[] = $row;
    }
}
?>

<form action="insert_damaged_goods.php" method="POST">
<input type="hidden" name="damaged_good_id" id="damaged_good_id"> <!-- Hidden ID for editing -->
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-12">
            <div class="mb-3 add-product">
                <div class="add-newplus">
                    <label class="form-label">Product Name</label>
                </div>
                <select class="select" name="product_name">
                    <option value="">Choose</option>
                    <?php foreach ($products as $product) : ?>
                        <option value="<?= $product['id']; ?>"><?= htmlspecialchars($product['product_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-12">
            <div class="mb-3 add-product">
                <div class="add-newplus">
                    <label class="form-label">Category</label>
                </div>
                <select class="select" name="category_id">
                    <option value="">Choose</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id']; ?>"><?= htmlspecialchars($category['category_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-6 col-12">
            <div class="mb-3 add-product">
                <label class="form-label">Quantity</label>
                <input type="number" class="form-control" name="quantity" required>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-12">
            <div class="mb-3 add-product">
                <div class="add-newplus">
                    <label class="form-label">Units</label>
                </div>
                <select class="select" name="units">
                    <option value="">Choose</option>
                    <?php foreach ($units as $unit) : ?>
                        <option value="<?= $unit['id']; ?>"><?= htmlspecialchars($unit['unit_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-6 col-12">
            <div class="input-blocks">
                <label>Damaged Date</label>
                <div class="input-groupicon calender-input">
                    <input type="date" class="form-control" name="damaged_date" required>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-12">
            <div class="input-blocks add-product">
                <label>Reported by</label>
                <select class="select" name="reported_by">
                    <option value="">Choose</option>
                    <?php foreach ($employees as $employee) : ?>
                        <option value="<?= $employee['id']; ?>"><?= htmlspecialchars($employee['full_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-6 col-12">
            <div class="mb-3 add-product">
                <div class="add-newplus">
                    <label class="form-label">Damage Type</label>
                </div>
                <select class="select" name="damage_type">
                    <option value="Physical">Physical</option>
                    <option value="Quality">Quality</option>
                    <option value="Expiry">Expiry</option>
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-12">
            <div class="mb-3 add-product">
                <div class="add-newplus">
                    <label class="form-label">Location</label>
                </div>
                <select class="select" name="location">
                    <option value="Inventory">Inventory</option>
                    <option value="Transit">Transit</option>
                    <option value="Store">Store</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-12">
            <div class="mb-3 add-product">
                <div class="add-newplus">
                    <label class="form-label">Resolution</label>
                </div>
                <select class="select" name="resolution">
                    <option value="Return to Inventory">Return to Inventory</option>
                    <option value="Dispose">Dispose</option>
                </select>
            </div>
        </div>
    </div>

    <div class="modal-footer-btn">
        <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-submit">Submit Report</button>
    </div>
</form>


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /ediit  damaged goods -->




	<?php include "includes/footer.php"; ?>

</body>

</html>