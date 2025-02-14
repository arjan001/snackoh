<?php 
include_once "./includes/session_check.php"

?>	
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php";?>
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
								<h4>Supplier List</h4>
								<h6>Manage Your Supplier</h6>
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
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Add New Supplier</a>
						</div>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#supllier_category"><i data-feather="plus-circle" class="me-2"></i>add supplier Category</a>
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
										<option>25 9 23</option>
										<option>12 9 23</option>
									</select>
								</div>
							</div>
							<!-- /Filter -->
							<div class="card" id="filter_inputs">
								<div class="card-body pb-0">
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="user" class="info-img"></i>
												<select class="select">
													<option>Choose Supplier Name</option>
													<option>Dazzle Shoes</option>
													<option>A-Z Store</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="globe" class="info-img"></i>
												<select class="select">
													<option>Choose Country</option>
													<option>Mexico</option>
													<option>Italy</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
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
// Include database connection
include_once "./config/config.php"; 

// Fetch suppliers data from the database
$sql = "SELECT * FROM suppliers";
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
            <th>Supplier Name</th>
            <th>Category</th>
            <th>Contact Person</th>
            <th>Phone No</th>
            <th>Payment Terms</th>
            <th>Status</th>
            <!-- <th class="no-sort">Action</th> -->
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if there are any suppliers in the database
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $statusBadge = $row['status'] == 'active' ? 'badge-linesuccess' : 'badge-lineinactive';
                echo "<tr>";
                echo "<td><label class='checkboxs'><input type='checkbox'><span class='checkmarks'></span></label></td>";
                echo "<td>" . $row['supplier_name'] . "</td>";
                echo "<td>" . $row['supplier_category'] . "</td>";
                echo "<td>" . $row['contact_person_name'] . "</td>";
                echo "<td>" . $row['phone_no'] . "</td>";
                echo "<td>" . $row['payment_terms'] . "</td>";
                echo "<td><span class='badge $statusBadge'>" . ucfirst($row['status']) . "</span></td>";
                // echo "<td class='action-table-data'>
                //         <div class='edit-delete-action'>
                //             <a class='me-2 p-2 mb-0' href='javascript:void(0);'>
                //                 <i data-feather='eye' class='action-eye'></i>
                //             </a>
                //             <a class='me-2 p-2 mb-0' data-bs-toggle='modal' data-bs-target='#edit-units'>
                //                 <i data-feather='edit' class='feather-edit'></i>
                //             </a>
                //             <a class='me-2 confirm-text p-2 mb-0' href='javascript:void(0);'>
                //                 <i data-feather='trash-2' class='feather-trash-2'></i>
                //             </a>
                //         </div>
                //     </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No suppliers found</td></tr>";
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

<!-- Add Supplier category -->
<div class="modal fade" id="supllier_category">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Supplier Category</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <!-- Update action to handle POST to supplier_category_logic.php -->
                        <form action="supplier_category.php" method="POST">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-blocks">
                                        <label>Category Name</label>
                                        <input type="text" class="form-control" name="category_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3 input-blocks">
                                        <label class="form-label">Category Description</label>
                                        <textarea class="form-control" name="category_description" required></textarea>
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
<!-- /Add Supplier category -->


<!-- Add Supplier -->
<div class="modal fade" id="add-units">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Add Supplier</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <!-- Form POST to add_supplier.php -->
                        <form action="add_supplier.php" method="POST">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Supplier Name</label>
                                        <input type="text" class="form-control" name="supplier_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Contact Person's Name</label>
                                        <input type="text" class="form-control" name="contact_person_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Phone No</label>
                                        <input type="phone" class="form-control" name="phone_no" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Email Address</label>
                                        <input type="email" class="form-control" name="email_address" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 add-product">
                                        <div class="add-newplus">
                                            <label class="form-label">Supplier Category</label>
                                        </div>
                                        <select class="select" name="supplier_category" required>
                                            <?php
                                            // Fetch supplier categories from the database
                                            include_once 'config/config.php';
                                            $sql = "SELECT * FROM supplier_category";
                                            $result = $conn->query($sql);
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='".$row['category_name']."'>".$row['category_name']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3 input-blocks">
                                        <label class="form-label">Physical Address</label>
                                        <textarea class="form-control" name="physical_address" required></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Payment Terms</label>
                                        <select class="select" name="payment_terms" required>
                                            <option value="Choose">Choose</option>
                                            <option value="cash">Cash</option>
                                            <option value="Credit Sale">Credit Sale</option>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Tax Information</label>
                                        <input type="text" class="form-control" name="tax_information" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Bank Details</label>
                                        <input type="text" class="form-control" name="bank_details" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mt-4">
                                        <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                            <span class="status-label">Status</span>
                                            <input type="checkbox" id="unit_status" class="check" name="status" checked>
                                            <label for="unit_status" class="checktoggle"></label>
                                        </div>
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
<!-- /Add Supplier -->


		<!-- Edit Supplier -->
		<div class="modal fade" id="edit-units">
				<div class="modal-dialog modal-dialog-centered custom-modal-two">
					<div class="modal-content">
						<div class="page-wrapper-new p-0">
							<div class="content">
								<div class="modal-header border-0 custom-modal-header">
									<div class="page-title">
										<h4>Edit Supplier</h4>
									</div>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body custom-modal-body">
									<form action="suppliers.html">
										<div class="row">
											
											<div class="col-lg-6">
												<div class="input-blocks">
													<label>Supplier Name</label>
													<input type="text" class="form-control">
												</div>

											</div>
											<div class="col-lg-6">
												<div class="input-blocks">
													<label>contact person's Name</label>
													<input type="text" class="form-control">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="input-blocks">
													<label>Phone No</label>
													<input type="phone" class="form-control">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="input-blocks">
													<label>email Adresss</label>
													<input type="email" class="form-control">
												</div>
											</div>

											<div class="col-lg-12 col-sm-12 col-12">
													<div class="mb-3 add-product">
														<div class="add-newplus">
															<label class="form-label">Supplier Category</label>

														</div>
														<select class="select" name="product_category">
															<option>Wholesaler</option>
															<option>Retailer</option>
															<option>Distributor</option>
														</select>
													</div>

												</div>
										<div class="col-lg-12">
									<div class="mb-3 input-blocks">
										<label class="form-label">Physical Adress</label>
										<textarea class="form-control"></textarea>
										
									</div>
								</div>
											<div class="col-lg-6 col-sm-10 col-10">
												<div class="input-blocks">
													<label>Payment Terms</label>
													<select class="select">
														<option>Choose</option>
														<option>Varrel</option>
													</select>
												</div>
											</div>

											<div class="col-lg-6">
												<div class="input-blocks">
													<label>Tax Information</label>
													<input type="text" class="form-control">
												</div>
											</div>
											
											<div class="col-lg-6">
												<div class="input-blocks">
													<label>Bank Details</label>
													<input type="text" class="form-control">
												</div>
											</div>
											<div class="col-lg-6">
											<div class="mt-4">
                                <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Status</span>
                                    <input type="checkbox" id="unit_status" class="check" name="status" checked>
                                    <label for="unit_status" class="checktoggle"></label>
                                </div>
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
		<!-- /Edit Supplier -->
  

		 
	
		<?php include "includes/footer.php";?>

	
    </body>
</html>