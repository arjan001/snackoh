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
				<form action="insert-recipe.php" method="POST">
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
												<div class="col-lg-12 col-sm-12 col-12">
													<div class="mb-3 add-product">
														<label class="form-label">Recipe Name</label>
														<input type="text" class="form-control" name="product_name">
													</div>
												</div>
											</div>
												
												<div class="row">
													<div class="col-lg-6 col-sm-6 col-12">
														<div class="input-blocks add-product">
															<label>Ingridients</label>
															<button type="" class="btn btn-success ">Add Ingridients</button>
														</div>
													</div>
													
			
												</div>

										<!-- Editor -->
                                        <div class="col-lg-12">
                                            <div class="input-blocks summer-description-box transfer mb-3">
                                                <label>Recipe Instruction</label>
                                                <textarea class="form-control h-100" name="recipe_instructions" rows="5"></textarea>
                                                <p class="mt-1">Maximum 60 Characters</p>
                                            </div>
                                        </div>
                                        <!-- /Editor -->
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
							<button type="submit" class="btn btn-submit">Save Recipe</button>
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