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
								<h4>Manage Stock Inventory Category</h4>
								<h6>Manage your Inventory Category</h6>
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
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-stock-category"><i data-feather="plus-circle" class="me-2"></i>Add Stock Category</a>
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
							<div class="card" id="filter_inputs">
								<div class="card-body pb-0">
									<div class="row">
										<div class="col-lg-2 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="archive" class="info-img"></i>
												<select class="select">
													<option>Choose Warehouse</option>
													<option>Lobar Handy</option>
													<option>Quaint Warehouse</option>
													<option>Traditional Warehouse</option>
													<option>Cool Warehouse</option>
												</select>
											</div>
										</div>
										<div class="col-lg-2 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="box" class="info-img"></i>
												<select class="select">
													<option>Choose Product</option>
													<option>Nike Jordan</option>
													<option>Apple Series 5 Watch</option>
													<option>Amazon Echo Dot</option>
													<option>Lobar Handy</option>
												</select>
											</div>
										</div>
										<div class="col-lg-2 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="calendar" class="info-img"></i>
												<div class="input-groupicon">
													<input type="text" class="datetimepicker" placeholder="Choose Date" >
												</div>
											</div>
										</div>
										<div class="col-lg-2 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="user" class="info-img"></i>
												<select class="select">
													<option>Choose Person</option>
													<option>Steven</option>
													<option>Gravely</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4 col-sm-6 col-12 ms-auto">
											<div class="input-blocks">
												<a class="btn btn-filters ms-auto"> <i data-feather="search" class="feather-search"></i> Search </a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Filter -->
							<div class="table-responsive">
							<table class="table datanew">
    <thead>
        <tr>
            <th class="no-sort">
                <label class="checkboxs">
                    <input type="checkbox" id="select-all">
                    <span class="checkmarks"></span>
                </label>
            </th>
            <th>Category Name</th>
            <th>Description</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once "./config/config.php";
        
        // Fetch stock categories from the database
        $sql = "SELECT * FROM stock_category";
        $result = $conn->query($sql);
        
        // Check if data is available
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Assign fetched data to variables
                $category_name = $row['stock_category_name'];
                $category_description = $row['stock_category_description'];
                $category_status = $row['stock_category_status'];
                // $category_id = $row['stock_category_id']; // Assuming there's an ID column
                
                // Output the row with fetched data
                echo "<tr>";
                echo "<td>
                        <label class='checkboxs'>
                            <input type='checkbox'>
                            <span class='checkmarks'></span>
                        </label>
                      </td>";
                echo "<td>$category_name</td>";
                echo "<td>$category_description</td>";
                echo "<td class='action-table-data'>
                        <div class='edit-delete-action'>
                            <a class='me-2 p-2' href='#' data-bs-toggle='modal' data-bs-target='#edit-stock-category'>
                                <i data-feather='edit' class='feather-edit'></i>
                            </a>
                            <a class='confirm-text p-2' href='javascript:void(0);'>
                                <i data-feather='trash-2' class='feather-trash-2'></i>
                            </a>
                        </div>
                      </td>";
                echo "</tr>";
            }
        } else {
            // If no data is found
            echo "<tr><td colspan='4'>No categories found.</td></tr>";
        }
        
        // Close connection
        $conn->close();
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

		<!-- Add Stock category -->
		<div class="modal fade" id="add-stock-category">
			<div class="modal-dialog modal-dialog-centered stock-adjust-modal">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Stock Category</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="add_stock_category.php" method="POST">
									<div class="row">


									<div class="col-lg-12 col-sm-12 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Category Name</label>
											<input type="text" class="form-control" name="stock_category_name">
										</div>
									</div>

									</div>
									<div class="row">

										<!-- Editor -->
                                        <div class="col-lg-12">
                                            <div class="input-blocks summer-description-box transfer mb-3">
                                                <label>Category Description</label>
                                                <textarea  name="stock_category_description"class="form-control h-100" rows="5"></textarea>
                                                <p class="mt-1">Maximum 60 Characters</p>
                                            </div>
                                        </div>
                                        <!-- /Editor -->

								<div class="mb-0">
                                <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Status</span>
                                    <input type="checkbox" id="stock_category_status" class="check" name="stock_category_status" checked>
                                    <label for="stock_category_status" class="checktoggle"></label>
                                </div>
                            </div>

									</div>
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Create</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Stock category -->

		<!-- Edit Stock category -->
		<div class="modal fade" id="edit-stock-category">
			<div class="modal-dialog modal-dialog-centered stock-adjust-modal">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Stock Category</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="add_stock_category.php" method="POST">
									<div class="row">


									<div class="col-lg-12 col-sm-12 col-12">

										<div class="mb-3 add-product">
											<label class="form-label">Category Name</label>
											<input type="text" class="form-control" name="stock-category-name">
										</div>
									</div>

									</div>
									<div class="row">

										<!-- Editor -->
                                        <div class="col-lg-12">
                                            <div class="input-blocks summer-description-box transfer mb-3">
                                                <label>Category Description</label>
                                                <textarea  name="stock_category_description"class="form-control h-100" rows="5"></textarea>
                                                <p class="mt-1">Maximum 60 Characters</p>
                                            </div>
                                        </div>
                                        <!-- /Editor -->
										<div class="mb-0">
                                <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Status</span>
                                    <input type="checkbox" id="stock_category_status" class="check" name="stock_category_status" checked>
                                    <label for="stock_category_status" class="checktoggle"></label>
                                </div>
                            </div>

									</div>
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Edit Stock category-->

  

		<?php include "includes/footer.php";?>

	
    </body>
</html>