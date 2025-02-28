<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php';

include_once "./includes/session_check.php" ;
?>
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
								<h4>Unsold Products<i class="fas fa-goods"></i></h4>
								<h6>Manage your Unsold Goods</h6>
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
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-unsold-items"><i data-feather="plus-circle" class="me-2"></i>Add Unsold Items</a>
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
													<input type="text" class="datetimepicker" placeholder="Choose Date" >
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
												<a class="btn btn-filters ms-auto"> <i data-feather="search" class="feather-search"></i> Search </a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Filter -->
							<div class="table-responsive">
							<?php
include_once 'config/config.php'; // Ensure you have a database connection file

$query = "
    SELECT u.id, p.product_name, u.quantity, un.unit_name, u.expiry_date, u.status, u.resolution 
    FROM unsold_goods u
    JOIN products p ON u.product_id = p.id
    JOIN units un ON u.unit_id = un.id
";
$result = $conn->query($query);
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
            <th>Product name</th>
            <th>Quantity</th>
            <th>Unit</th>
            <th>Expiry Date</th>
            <th>Reason</th>
            <th>Resolution</th>
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
                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                <td><?php echo htmlspecialchars($row['unit_name']); ?></td>
                <td><?php echo date('d M Y', strtotime($row['expiry_date'])); ?></td>
                <td>
                    <span class="badge badge-linesuccess"><?php echo htmlspecialchars($row['status']); ?></span>
                </td>
                <td><?php echo htmlspecialchars($row['resolution']); ?></td>
                <td class="action-table-data">
                    <div class="edit-delete-action">
                        <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-unsold-items" data-id="<?php echo $row['id']; ?>">
                            <i data-feather="edit" class="feather-edit"></i>
                        </a>
                        <a class="confirm-text p-2 delete-item" href="delete_unsold.php?id=<?php echo $row['id']; ?>">
                            <i data-feather="trash-2" class="feather-trash-2"></i>
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

		<?php
// Database connection
include_once "./config/config.php";

// Fetch products
$products = $conn->query("SELECT id, product_name FROM products");

// Fetch units
$units = $conn->query("SELECT id, unit_name FROM units");
?>

<!-- Add New Unsold Item Modal -->
 <div class="modal fade" id="add-unsold-items">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Add Unsold Items</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form action="insert-unsold.php" method="POST">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="mb-3 add-product">
                                        <label class="form-label">Product Name</label>
                                        <select class="form-control select" name="product_id" required>
                                            <option value="">Select Product</option>
                                            <?php while ($row = $products->fetch_assoc()) { ?>
                                                <option value="<?= $row['id']; ?>"><?= $row['product_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="mb-3 add-product">
                                        <label class="form-label">Quantity</label>
                                        <input type="number" class="form-control" name="quantity" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <label>Expiry Date</label>
                                        <div class="input-groupicon calender-input">
                                            <!-- <i data-feather="calendar" class="info-img"></i> -->
                                            <input type="date" class="form-control" name="expiry_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="mb-3 add-product">
                                        <label class="form-label">Units</label>
                                        <select class="form-control select" name="unit_id" required>
                                            <option value="">Select Unit</option>
                                            <?php while ($row = $units->fetch_assoc()) { ?>
                                                <option value="<?= $row['id']; ?>"><?= $row['unit_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="mb-3 add-product">
                                        <label class="form-label">Resolution</label>
                                        <select class="form-control select" name="resolution" required>
                                            <option value="return to Inventory">Return to Inventory</option>
                                            <option value="Discard">Discard</option>
                                            <option value="Donate">Donate</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="mb-3 add-product">
                                        <label class="form-label">Status</label>
                                        <select class="form-control select" name="status" required>
                                            <option value="Expired">Expired</option>
                                            <option value="Near Expiry">Near Expiry</option>
                                            <option value="Close Of Business">Close Of Business</option>
                                            <option value="Excess Production">Excess Production</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


		<!-- Edit Category -->
		<div class="modal fade" id="edit-unsold-items">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Edit Unsold Items</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form action="insert-unsold.php" method="POST">

								<div class="row">

									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Product Name</label>
											<input type="text" class="form-control" name="unsold_goods_product_name">
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Quantity</label>
											<input type="text" class="form-control" name="unsold_goods_quantity">
										</div>
									</div>

								</div>

								<div class="row">
								<div class="col-lg-6 col-sm-6 col-12">
										<div class="input-blocks">
											<label>Exoiry Date</label>

											<div class="input-groupicon calender-input">
												<i data-feather="calendar" class="info-img"></i>
												<input type="text" class="datetimepicker" placeholder="Choose Date"
													name="unsold_goods_expiry_date">
											</div>
										</div>
									</div>

									<div class="col-lg-6 col-sm-6 col-12">
										<div class="mb-3 add-product">
											<div class="add-newplus">
												<label class="form-label">Units</label>

											</div>
											<select class="select" name="product_category">
												<option>Pieces</option>
												<option>Crate</option>

											</select>
										</div>

									</div>
								</div>


								<div class="row">

								<div class="col-lg-6 col-sm-12 col-12">
										<div class="mb-3 add-product">
											<div class="add-newplus">
												<label class="form-label">Resolution</label>

											</div>
											<select class="select" name="damage_type">
												<option>return toInventory</option>
												<option>Discard</option>
												<option>Donate</option>
												

											</select>
										</div>

									</div>

									<div class="col-lg-6 col-sm-6 col-12">
										<div class="mb-3 add-product">
											<div class="add-newplus">
												<label class="form-label">Status</label>

											</div>
											<select class="select" name="damage_type">
												<option>Expired</option>
												<option>Near Expiry</option>
												<option>Close Of Business</option>
												<option>excess Production</option>

											</select>
										</div>

									</div>


								</div>



								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Submit </button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<!-- /Edit Category -->
  

		<?php include "includes/footer.php";?>
		
    </body>
</html>