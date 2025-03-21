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
								<h4>Category</h4>
								<h6>Manage your Assset categories</h6>
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
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-category"><i data-feather="plus-circle" class="me-2"></i>Add New Category</a>
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
            <th>Category Description</th>
            <th>Created On</th>
            <th>Status</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Database connection
   
 include_once "./config/config.php";

        // Fetch categories
        $sql = "SELECT * FROM asset_category ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = htmlspecialchars($row['category_name']);
                $description = htmlspecialchars($row['category_description']);
                $created_at = date("d M Y", strtotime($row['created_at']));
                $status = $row['status'] ? 
                    '<span class="badge badge-linesuccess">Active</span>' : 
                    '<span class="badge badge-linedanger">Inactive</span>';

                echo "<tr>
                        <td>
                            <label class='checkboxs'>
                                <input type='checkbox' name='category_ids[]' value='$id'>
                                <span class='checkmarks'></span>
                            </label>
                        </td>
                        <td>$name</td>
                        <td>$description</td>
                        <td>$created_at</td>
                        <td>$status</td>
                        <td class='action-table-data'>
                            <div class='edit-delete-action'>
                                <a class='me-2 p-2' href='#' data-bs-toggle='modal' data-bs-target='#edit-category' data-id='$id' data-name='$name' data-description='$description' data-status='{$row['status']}'>
                                    <i data-feather='edit' class='feather-edit'></i>
                                </a>
                                <a class='confirm-text p-2' href='delete_category.php?id=$id' onclick='return confirm(\"Are you sure you want to delete this category?\");'>
                                    <i data-feather='trash-2' class='feather-trash-2'></i>
                                </a>
                            </div>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>No categories found.</td></tr>";
        }

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

		<!-- Add Category -->
		<div class="modal fade" id="add-category">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Create  Assets Category</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
							<form action="add_asset_category.php" method="POST">
    <div class="mb-3">
        <label class="form-label">Category Name</label>
        <input type="text" class="form-control" name="category_name" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Category Description</label>
        <input type="text" class="form-control" name="category_description">
    </div>
    <div class="mb-0">
        <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
            <span class="status-label">Status</span>
            <input type="checkbox" id="user2" class="check" name="status" checked>
            <label for="user2" class="checktoggle"></label>
        </div>
    </div>
    <div class="modal-footer-btn">
        <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-submit">Create Asset Category</button>
    </div>
                         </form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Category -->

		<!-- Edit Category -->
	<div class="modal fade" id="edit-category">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Create  Assets Category</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="add_asset_category.php" method="POST">
									<div class="mb-3">
										<label class="form-label">Category Name</label>
										<input type="text" class="form-control">
									</div>
									<div class="mb-3">
										<label class="form-label">Category Description</label>
										<input type="text" class="form-control">
									</div>
									<div class="mb-0">
										<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
											<span class="status-label">Status</span>
											<input type="checkbox" id="user2" class="check" checked="">
											<label for="user2" class="checktoggle"></label>
										</div>
									</div>
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Create Asset Category</button>
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