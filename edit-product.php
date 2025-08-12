<!DOCTYPE html>
<html lang="en">
<?php  include_once "./includes/session_check.php" ;?>
<?php include "includes/header.php";


?>

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
		<?php include "includes/sidebar.php" ?>
		<!-- /Sidebar -->


		<div class="page-wrapper">
			<div class="content">
				<div class="page-header">
					<div class="add-item d-flex">
						<div class="page-title">
							<h4>PRODUCT EDIT</h4>
							<h6>EDIT PRODUCT IN YOUR INVENTORY</h6>
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

<?php


$categoryQuery = "SELECT * FROM product_category";
$categoryResult = $conn->query($categoryQuery);

// Fetch units
$unitQuery = "SELECT * FROM units";
$unitResult = $conn->query($unitQuery);


?>

<?php
// Include your database connection
include_once "./config/config.php";

// Check if ID is set in URL
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']); // Sanitize ID

    // Fetch product details from the database
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    // Fetch categories
    $categoryQuery = "SELECT id, category_name FROM product_category";
    $categoryResult = $conn->query($categoryQuery);

    // Fetch units
    $unitQuery = "SELECT id, unit_name FROM units";
    $unitResult = $conn->query($unitQuery);
} else {
    echo "Invalid product ID.";
    exit();
}
?>

<form action="update-product.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

    <div class="card">
        <div class="card-body add-product pb-0">
            <div class="accordion-card-one accordion" id="accordionExample">
                <div class="accordion-item">
                    <div class="accordion-header" id="headingOne">
                        <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne">
                            <div class="addproduct-icon">
                                <h5><i data-feather="info" class="add-info"></i><span>Product Information</span></h5>
                                <a href="javascript:void(0);"><i data-feather="chevron-down" class="chevron-down-add"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="add-product-new">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="mb-3 add-product">
                                            <label class="form-label">Product Name</label>
                                            <input type="text" class="form-control" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="mb-3 add-product">
                                            <div class="add-newplus">
                                                <label class="form-label">Category</label>
                                            </div>
                                            <select class="select" name="product_category" required>
                                                <option>Choose category</option>
                                                <?php while ($category = $categoryResult->fetch_assoc()): ?>
                                                    <option value="<?php echo $category['id']; ?>" 
                                                        <?php echo ($category['id'] == $product['product_category']) ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($category['category_name']); ?>
                                                    </option>
                                                <?php endwhile; ?>
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
                                            <select name="product_unit" class="form-control" required>
                                                <option value="">Select Unit</option>
                                                <?php while ($unitRow = $unitResult->fetch_assoc()): ?>
                                                    <option value="<?php echo $unitRow['id']; ?>" 
                                                        <?php echo ($unitRow['id'] == $product['product_unit']) ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($unitRow['unit_name']); ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="input-blocks add-product">
                                            <label>Quantity</label>
                                            <input type="text" class="form-control" name="product_quantity" value="<?php echo htmlspecialchars($product['product_quantity']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="input-blocks add-product">
                                            <label>Price</label>
                                            <input type="text" class="form-control" name="product_price" value="<?php echo htmlspecialchars($product['product_price']); ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="input-blocks add-product">
                                            <label>Quantity Alert</label>
                                            <input type="text" class="form-control" name="product_quantity_alert" value="<?php echo htmlspecialchars($product['product_quantity_alert']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="input-blocks">
                                            <label>Manufactured Date</label>
                                            <div class="input-groupicon calender-input">
                                                <i data-feather="calendar" class="info-img"></i>
                                                <input type="text" class="datetimepicker" placeholder="Choose Date" name="product_manufactured_date" value="<?php echo htmlspecialchars($product['manufactured_on']); ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="add-choosen">
                                        <div class="input-blocks">
                                            <div class="image-upload">
                                                <input type="file" name="product_image" accept="image/*" id="productImage" onchange="previewImage(event)">
                                                <div class="image-uploads">
                                                    <i data-feather="plus-circle" class="plus-down-add me-0"></i>
                                                    <h4>Add Images</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Image preview -->
                                        <div class="phone-img" id="imagePreviewContainer" style="display: <?php echo $product['product_image'] ? 'block' : 'none'; ?>;">
                                            <img id="previewImg" src="uploads/<?php echo $product['product_image']; ?>" alt="image" class="img-fluid" style="object-fit: contain; width: 100%; height: auto;">
                                            <a href="javascript:void(0);" onclick="removeImage()"><i data-feather="x" class="x-square-add remove-product"></i></a>
                                        </div>
                                        <!-- Image preview -->
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
            <button type="submit" class="btn btn-submit">Update Product</button>
        </div>
    </div>
</form>

<!-- /add -->

<script>
    // Function to preview image before upload
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('previewImg');
            output.src = reader.result;
            document.getElementById('imagePreviewContainer').style.display = 'block'; // Show preview container
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // Function to remove the selected image preview
    function removeImage() {
        document.getElementById('previewImg').src = ""; // Clear the preview image
        document.getElementById('productImage').value = ""; // Clear the file input
        document.getElementById('imagePreviewContainer').style.display = 'none'; // Hide preview container
    }
</script>



			</div>
		</div>
	</div>
	<!-- /Main Wrapper -->














	<?php include "includes/footer.php" ?>


</body>

</html>