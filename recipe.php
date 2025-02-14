<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>

<body>

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
							<h4>New Recipe</h4>
							<h6>Create new Recipe</h6>
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
include_once "./config/config.php";

// Fetch units dynamically from the database
$units = [];
$sql = "SELECT CONCAT(unit_name, ' (', short_name, ')') AS unit_display FROM units WHERE status = 'active'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $units[] = $row['unit_display'];
    }
}
?>

<!-- /add -->
<form action="insert-recipe.php" method="POST">
    <div class="card">
        <div class="card-body add-product pb-0">
            <div class="accordion-card-one accordion" id="accordionExample">
                <div class="accordion-item">
                    <div class="accordion-header" id="headingOne">
                        <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                            aria-controls="collapseOne">
                            <div class="addproduct-icon">
                                <h5><i data-feather="info" class="add-info"></i><span>Product Information</span></h5>
                                <a href="javascript:void(0);"><i data-feather="chevron-down"
                                        class="chevron-down-add"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="add-product-new">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-12">
                                        <div class="mb-3 add-product">
                                            <label class="form-label">Recipe Name</label>
                                            <input type="text" class="form-control" name="product_name" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ingredients Section -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3 add-product">
                                            <label class="form-label">Ingredients</label>
                                            <div id="ingredient-container">
                                                <!-- Ingredients will be added dynamically here -->
                                            </div>
                                            <button type="button" class="btn btn-success mt-2" id="add-ingredient">Add
                                                Ingredient</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Temperature Inputs -->
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="mb-3 add-product">
                                            <label>Upper Temperature (°C)</label>
                                            <input type="number" class="form-control" name="upper_temp"
                                                placeholder="e.g. 235-240" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="mb-3 add-product">
                                            <label>Lower Temperature (°C)</label>
                                            <input type="number" class="form-control" name="lower_temp"
                                                placeholder="e.g. 275-280" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Recipe Instructions -->
                                <div class="col-lg-12">
                                    <div class="input-blocks summer-description-box transfer mb-3">
                                        <label>Recipe Instruction</label>
                                        <textarea class="form-control h-100" name="recipe_instructions" rows="5"
                                            required></textarea>
                                        <p class="mt-1">Maximum 60 Characters</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="col-lg-12">
            <div class="btn-addproduct mb-4">
                <button type="button" class="btn btn-cancel me-2">Cancel</button>
                <button type="submit" class="btn btn-submit">Save Recipe</button>
            </div>
        </div>
    </div>
</form>
<!-- /add -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let units = <?php echo json_encode($units); ?>;
        let container = document.getElementById("ingredient-container");
        let addIngredientBtn = document.getElementById("add-ingredient");

        // Load saved ingredients from localStorage
        let savedIngredients = JSON.parse(localStorage.getItem("ingredients")) || [];

        function addIngredient(name = "", quantity = "", unit = "") {
            let ingredientDiv = document.createElement("div");
            ingredientDiv.classList.add("row", "mb-2");

            let unitOptions = units.map(unitText =>
                `<option value="${unitText}" ${unitText === unit ? 'selected' : ''}>${unitText}</option>`
            ).join("");

            ingredientDiv.innerHTML = `
                <div class="col-lg-5">
                    <input type="text" class="form-control ingredient-name" value="${name}" placeholder="Ingredient Name" required>
                </div>
                <div class="col-lg-3">
                    <input type="number" class="form-control ingredient-quantity" value="${quantity}" placeholder="Quantity" required>
                </div>
                <div class="col-lg-3">
                    <select class="form-control ingredient-unit" required>
                        ${unitOptions}
                    </select>
                </div>
                <div class="col-lg-1">
                    <button type="button" class="btn btn-danger remove-ingredient">X</button>
                </div>
            `;

            container.appendChild(ingredientDiv);

            // Remove ingredient row
            ingredientDiv.querySelector(".remove-ingredient").addEventListener("click", function () {
                ingredientDiv.remove();
                saveIngredients();
            });

            // Update localStorage on input change
            ingredientDiv.querySelectorAll("input, select").forEach(input => {
                input.addEventListener("input", saveIngredients);
            });
        }

        // Function to save ingredients in localStorage
        function saveIngredients() {
            let ingredientData = [];
            document.querySelectorAll("#ingredient-container .row").forEach(row => {
                let name = row.querySelector(".ingredient-name").value;
                let quantity = row.querySelector(".ingredient-quantity").value;
                let unit = row.querySelector(".ingredient-unit").value;
                ingredientData.push({ name, quantity, unit });
            });
            localStorage.setItem("ingredients", JSON.stringify(ingredientData));
        }

        // Load existing ingredients on page load
        savedIngredients.forEach(ing => addIngredient(ing.name, ing.quantity, ing.unit));

        // Add new ingredient on button click
        addIngredientBtn.addEventListener("click", function () {
            addIngredient();
        });
    });
</script>

				<!-- /add -->

			</div>
		</div>
	</div>
	<!-- /Main Wrapper -->

















	<?php include "includes/footer.php" ?>


</body>

</html>