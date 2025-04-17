<!DOCTYPE html>
<html lang="en">
<?php  include_once "./includes/session_check.php" ;?>
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
						<div class="page-title me-auto">
							<h4>Low Stocks</h4>
							<h6>Manage your low stocks</h6>
						</div>
						<ul class="table-top-head low-stock-top-head">
				
							<li>
    <a href="javascript:void(0);" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#send-sms">
        <i data-feather="mail" class="feather-mail"></i> Send sms
    </a>
</li>
							<li>
    <a href="javascript:void(0);" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#send-email">
        <i data-feather="mail" class="feather-mail"></i> Send Email
    </a>
</li>

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
					</div>
					<div class="table-tab">
						<ul class="nav nav-pills" id="pills-tab" role="tablist">
							<li class="nav-item" role="presentation">
							  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Low Stocks Products</button>
							</li>

							
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
										
										<div class="table-responsive">

                                        <?php
              include_once "./config/config.php";

              // SQL query to fetch all relevant data including the supplier name
              $sql = "SELECT 
            stock.id,
            stock.product_name, 
            stock.stock_quantity, 
            stock.stock_price, 
            stock.stock_expiry_date, 
            COALESCE(units.unit_name, 'N/A') AS unit_name,  -- ✅ Ensures unit_name is always set
            stock.reorder_level, 
            COALESCE(suppliers.supplier_name, 'Unknown') AS supplier_name, 
            COALESCE(stock_category.stock_category_name, 'Uncategorized') AS stock_category_name
        FROM stock
        LEFT JOIN stock_category ON stock.stock_category_id = stock_category.id
        LEFT JOIN suppliers ON stock.stock_supplier_id = suppliers.id
        LEFT JOIN units ON stock.stock_unit = units.id
        WHERE  stock.stock_quantity <= stock.reorder_level";

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
                    <th>Category</th>
                    <th>current-Quantity</th>
                    <th>Expiry Date</th>
                    <th>Reorder Level</th>
                    <th>Units name</th>
                    <th>Supplier</th>
                    <th>Supplier Price</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                      <?php
                      $productId = htmlspecialchars($row['id']);
                      $productName = htmlspecialchars($row['product_name']);
                      $categoryName = htmlspecialchars($row['stock_category_name']);
                      $stockQuantity = htmlspecialchars($row['stock_quantity']);
                      $stockUnit = htmlspecialchars($row['unit_name']);
                      $expiryDate = htmlspecialchars($row['stock_expiry_date']);
                      $reorderLevel = htmlspecialchars($row['reorder_level']);
                      $supplierName = htmlspecialchars($row['supplier_name']);
                      $stockPrice = htmlspecialchars($row['stock_price']);
                      ?>

                      <tr>
                        <td>
                          <label class='checkboxs'>
                            <input type='checkbox'>
                            <span class='checkmarks'></span>
                          </label>
                        </td>
                        <td><?= $productName; ?></td>
                        <td><?= $categoryName; ?></td>
                        <td><?= $stockQuantity; ?></td>
                        <td><?= $expiryDate; ?></td>
                        <td><?= $reorderLevel; ?></td>
                        <td><?= htmlspecialchars($row['unit_name'] ?? 'N/A'); ?></td>

                        <td><?= $supplierName; ?></td>
                        <td><?= $stockPrice; ?></td>
                        
                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan='10'>No stock items found.</td>
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
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

<!-- Send SMS Modal -->
<div class="modal fade" id="send-sms" tabindex="-1" aria-labelledby="sendSmsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <h4 class="modal-title">Send SMS Notification</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
					<form id="smsNotificationForm" action="send_sms.php" method="POST">
    <div class="mb-3">
        <label class="form-label">Select Employees</label>
        <div class="employee-list">
            <?php
            include_once "./config/config.php";

            $sql = "SELECT id, first_name, last_name, contact_number FROM employees WHERE user_role IS NOT NULL AND contact_number IS NOT NULL AND contact_number != ''";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $employeeID = $row['id'];
                    $employeeName = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
                    $phoneNumber = htmlspecialchars($row['contact_number']);

                    echo '<div class="form-check">
                            <input class="form-check-input" type="checkbox" name="employees[]" value="'.$employeeID.'">
                            <label class="form-check-label">
                                '.$employeeName.' ('.$phoneNumber.')
                            </label>
                          </div>';
                }
            } else {
                echo '<p class="text-muted">No employees with valid phone numbers found.</p>';
            }
            ?>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Message</label>
        <textarea name="message" class="form-control" rows="4" placeholder="Enter message here..." required></textarea>
    </div>

    <div class="modal-footer-btn">
        <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-submit">Send SMS</button>
    </div>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Send SMS Modal -->




<!-- Send Email Modal -->
<div class="modal fade" id="send-email" tabindex="-1" aria-labelledby="sendEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <h4 class="modal-title">Send Email Notification</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form id="emailNotificationForm" action="send_email.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Select Employees</label>
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

                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea name="message" class="form-control" rows="4" placeholder="Enter message here..." required></textarea>
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
    </div>
</div>
<!-- /Send Email Modal -->







		<!-- Edit Low Stock -->
		<div class="modal fade" id="edit-stock">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Low Stocks</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="low-stocks.html">
									<div class="mb-3">
										<label class="form-label">Warehouse</label>
										<input type="text" class="form-control" value="Lavish Warehouse">
									</div>
									<div class="mb-3">
										<label class="form-label">Store</label>
										<input type="text" class="form-control" value="Crinol">
									</div>
									<div class="mb-3">
										<label class="form-label">Category</label>
										<input type="text" class="form-control" value="Laptop">
									</div>
									<div class="mb-3">
										<label class="form-label">Product</label>
										<input type="text" class="form-control" value="Lenevo 3rd Gen">
									</div>
									<div class="mb-3">
										<label class="form-label">SKU</label>
										<input type="text" class="form-control" value="PT001">
									</div>
									<div class="mb-3">
										<label class="form-label">Qty</label>
										<input type="text" class="form-control" value="15">
									</div>
									<div class="mb-3">
										<label class="form-label">Qty Alert</label>
										<input type="text" class="form-control" value="10">
									</div>
									<div class="mb-0">
										<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
											<span class="status-label">Status</span>
											<input type="checkbox" id="user3" class="check" checked="">
											<label for="user3" class="checktoggle"></label>
										</div>
									</div>
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Save Changes</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- / Edit Low Stock -->



		 
		<?php include "includes/footer.php";?>

	
    </body>
</html>