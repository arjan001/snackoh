<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>

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
		<?php include "includes/sidebar.php" ?>
		<!-- /Sidebar -->


		<div class="page-wrapper">
			<div class="content">
				<div class="page-header">
					<div class="add-item d-flex">
						<div class="page-title">
							<h4>New Product</h4>
							<h6>Create new product</h6>
						</div>
					</div>
					<ul class="table-top-head">
						<li>
							<div class="page-btn">
								<a href="product-list.php" class="btn btn-secondary"><i data-feather="arrow-left"
										class="me-2"></i>Back to Product</a>
							</div>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
									data-feather="chevron-up" class="feather-chevron-up"></i></a>
						</li>
					</ul>

				</div>
				<!-- /add -->
				<form action="insert-product.php" method="POST">
					<div class="card">
						<div class="card-body add-product pb-0">
							<div class="accordion-card-one accordion" id="accordionExample">
								<div class="accordion-item">
									<div class="accordion-header" id="headingOne">
										<div class="accordion-button" data-bs-toggle="collapse"
											data-bs-target="#collapseOne" aria-controls="collapseOne">
											<div class="addproduct-icon">
												<h5><i data-feather="info" class="add-info"></i><span>Product
														Information</span></h5>
												<a href="javascript:void(0);"><i data-feather="chevron-down"
														class="chevron-down-add"></i></a>
											</div>
										</div>
									</div>
									<div id="collapseOne" class="accordion-collapse collapse show"
										aria-labelledby="headingOne" data-bs-parent="#accordionExample">
										<div class="accordion-body">

											
											<div class="add-product-new">

											<div class="row">

												<div class="col-lg-6 col-sm-6 col-12">
													<div class="mb-3 add-product">
														<label class="form-label">Product Name</label>
														<input type="text" class="form-control" name="product_name">
													</div>
												</div>

												<div class="col-lg-6 col-sm-6 col-12">
													<div class="mb-3 add-product">
														<div class="add-newplus">
															<label class="form-label">Category</label>

														</div>
														<select class="select" name="product_category">
															<option>Choose</option>
															<option>Lenovo</option>
															<option>Electronics</option>
														</select>
													</div>

												</div>

											</div>
												<div class="row">

													<div class="col-lg-12 col-sm-12 col-12">
														<div class="mb-3 add-product">

															<div class="add-newplus">
																<label class="form-label">Unit</label>

															</div>
															<select class="select" name="product_unit">
																<option>Choose</option>
																<option name="product_unit">Kg</option>
																<option name="product_unit">Pc</option>
															</select>
														</div>
													</div>
												
												</div>

												<div class="row">
													<div class="col-lg-6 col-sm-6 col-12">
														<div class="input-blocks add-product">
															<label>Quantity</label>
															<input type="text" class="form-control" name="product_quantity">
														</div>
													</div>
													<div class="col-lg-6 col-sm-6 col-12">
														<div class="input-blocks add-product">
															<label>Price</label>
															<input type="text" class="form-control"name="product_price">
														</div>
													</div>

												</div>
												<div class="row">
													<div class="col-lg-6 col-sm-6 col-12">
														<div class="input-blocks add-product">
															<label>Quantity Alert</label>
															<input type="text" class="form-control"name="product_quantity_alert">
														</div>
													</div>
													<div class="col-lg-6 col-sm-6 col-12">
														<div class="input-blocks">
															<label>Manufactured Date</label>

															<div class="input-groupicon calender-input">
																<i data-feather="calendar" class="info-img"></i>
																<input type="text" class="datetimepicker" placeholder="Choose Date" name="product_manufactured_date">
															</div>
														</div>
													</div>
			
												</div>

												<div class="col-lg-12">
													<div class="add-choosen">
														<div class="input-blocks">
															<div class="image-upload">
																<input type="file" name="product_image">
																<div class="image-uploads">
																	<i data-feather="plus-circle"
																		class="plus-down-add me-0"></i>
																	<h4>Add Images</h4>
																</div>
															</div>
														</div>
														<div class="phone-img">
															<img src="assets/img/products/phone-add-2.png"
																alt="image">
															<a href="javascript:void(0);"><i
																	data-feather="x"
																	class="x-square-add remove-product"></i></a>
														</div>


													</div>
												</div>
											</div>


										</div>
									</div>
								</div>
							</div>
						

						</div>
					</div>
					<div class="col-lg-12">
						<div class="btn-addproduct mb-4">
							<button type="button" class="btn btn-cancel me-2">Cancel</button>
							<button type="submit" class="btn btn-submit">Save Product</button>
						</div>
					</div>
				</form>
				<!-- /add -->

			</div>
		</div>
	</div>
	<!-- /Main Wrapper -->














	<?php include "includes/footer.php" ?>


</body>

</html>