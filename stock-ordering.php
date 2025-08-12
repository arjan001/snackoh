<?php 
include_once "./includes/session_check.php"

?>	
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php";?>
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
								<h4>Stock Ordering</h4>
								<h6>Manage your stock Orders</h6>
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
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Add New</a>
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
include_once "./config/config.php";

// SQL query to fetch all relevant data including the supplier details
$sql = "SELECT 
            stock.id,
            stock.product_name, 
            stock.stock_quantity, 
            units.unit_name,  
            suppliers.supplier_name,
            suppliers.phone_no,
            suppliers.physical_address
        FROM stock
        LEFT JOIN suppliers ON stock.stock_supplier_id = suppliers.id
        LEFT JOIN units ON stock.stock_unit = units.id
        WHERE stock.stock_quantity <= stock.reorder_level";

$result = $conn->query($sql);

// Check for SQL query error
if (!$result) {
    die("Query failed: " . $conn->error);
}
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
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Units</th>
            <th>Supplier</th>
            <th>Phone Number</th>
            <th>Physical Address</th>
            <!-- <th>Notes</th> -->
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productId = htmlspecialchars($row['id']);
                $productName = htmlspecialchars($row['product_name']);
                $stockQuantity = htmlspecialchars($row['stock_quantity']);
                $stockUnit = htmlspecialchars($row['unit_name']);
                $supplierName = htmlspecialchars($row['supplier_name']);
                $supplierPhone = htmlspecialchars($row['phone_no']);
                $supplierAddress = htmlspecialchars($row['physical_address']);

                echo "<tr>";
                echo "<td>
                        <label class='checkboxs'>
                            <input type='checkbox'>
                            <span class='checkmarks'></span>
                        </label>
                      </td>";
                echo "<td>{$productName}</td>";  
                echo "<td>{$stockQuantity}</td>"; 
                echo "<td>{$stockUnit}</td>"; 
                echo "<td>{$supplierName}</td>"; 
                echo "<td>{$supplierPhone}</td>"; 
                echo "<td>{$supplierAddress}</td>"; 
                // echo "<td><a href='#' class='view-note' data-bs-toggle='modal' data-bs-target='#view-notes'>View order Note</a></td>";

                // Order Action button
                echo "<td class='action-table-data'>
                        <div class='edit-delete-action'>
                            <a class='me-2 p-2' href='#' data-bs-toggle='modal' data-bs-target='#confirm_order' 
                               data-id='{$productId}' data-name='{$productName}' data-supplier='{$supplierName}'
                               data-phone='{$supplierPhone}' data-address='{$supplierAddress}'>
                                <i data-feather='edit' class='feather-edit'></i> Order
                            </a>
                        </div>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No items need reordering.</td></tr>";
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

		<!-- confirm stock order -->
		<div class="modal fade" id="confirm_order">
			<div class="modal-dialog modal-dialog-centered stock-adjust-modal">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>STOCK ORDERING</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="send_inventory_order.php" method="POST">

								<div class="row">
								<div class="col-lg-6 col-sm-6 col-12">

<div class="mb-3 add-product">
	<label class="form-label">item Name</label>
	<input type="text" class="form-control" name="stock_category_name">
</div>
</div>
								<div class="col-lg-6 col-sm-6 col-12">

<div class="mb-3 add-product">
	<label class="form-label">Quantity</label>
	<input type="number" class="form-control" name="stock_category_name">
</div>
</div>
									</div>

									<div class="row">
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Unit</label>
												<select class="select" name="stock_unit" required>
                        <?php
                        // Fetch units from the database
                        $sql = "SELECT * FROM units WHERE status = 'active'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                          echo "<option value='" . $row['id'] . "'>" . $row['unit_name'] . "</option>";
                        }
                        ?>
                      </select>
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="input-blocks">
												<label>supplier</label>
												<select class="select" name="stock_supplier_id" required>
                        <?php
                        // Fetch suppliers from the database
                        $sql = "SELECT * FROM suppliers WHERE status = 'active'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                          echo "<option value='" . $row['id'] . "'>" . $row['supplier_name'] . "</option>";
                        }
                        ?>
                      </select>
											</div>
										</div>
	
									</div>
									
									<div class="col-lg-12">
										<div class="input-blocks summer-description-box">
											<label>Notes</label>
											<textarea class="form-control"></textarea>
										</div>
									</div>
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Confirm Order</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Adjustment -->

		

		<!-- View Notes -->
		<div class="modal fade" id="view-notes">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Notes</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<p>The Jordan brand is owned by Nike (owned by the Knight family), as, at the time, the company was building its strategy to work with athletes to launch shows that could inspire consumers.Although Jordan preferred Converse and Adidas, they simply could not match the offer Nike made. Jordan also signed with Nike because he loved the way they wanted to market him with the banned colored shoes. Nike promised to cover the fine Jordan would receive from the NBA.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /View Notes -->
  

		<?php include "includes/footer.php";?>

	
    </body>
</html>