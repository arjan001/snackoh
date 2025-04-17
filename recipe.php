<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; 

include_once "./includes/session_check.php" ;?>

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
                                <h5><i data-feather="info" class="add-info"></i><span>Recipe & Ingridient Information</span></h5>
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
                                            <input type="text" class="form-control" name="recipe_name" required>
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
								        <!-- Submit Buttons -->
										<div class="col-lg-12 ml-3">
            <div class="btn-addproduct mb-4">
                <button type="button" class="btn btn-cancel me-2">Cancel</button>
                <button type="submit" class="btn btn-submit">Save Recipe</button>
            </div>
        </div>
                    </div>

			
    </div>
                </div>
            </div>
        </div>


</form>
<!-- /add -->


			<div class="content">
				<div class="page-header">
					<div class="add-item d-flex">
						<div class="page-title">
							<h4>Recipe List</h4>
							<h6>Manage your Recipe</h6>
						</div>
					</div>
					<ul class="table-top-head">
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
									src="assets/img/icons/pdf.svg" alt="img"></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
									src="assets/img/icons/excel.svg" alt="img"></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer"
									class="feather-rotate-ccw"></i></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i
									data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
									data-feather="chevron-up" class="feather-chevron-up"></i></a>
						</li>
					</ul>
					
					
				</div>

				<!-- /product list -->
				<div class="card table-list-card">
					<div class="card-body">
						<div class="table-top">
							<div class="search-set">
								<div class="search-input">
									<a href="javascript:void(0);" class="btn btn-searchset"><i data-feather="search"
											class="feather-search"></i></a>
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
									<option>14 09 23</option>
									<option>11 09 23</option>
								</select>
							</div>
						</div>
						<!-- /Filter -->
						<div class="card mb-0" id="filter_inputs">
							<div class="card-body pb-0">
								<div class="row">
									<div class="col-lg-12 col-sm-12">
										<div class="row">
											<div class="col-lg-2 col-sm-6 col-12">
												<div class="input-blocks">
													<i data-feather="box" class="info-img"></i>
													<select class="select">
														<option>Choose Product</option>
														<option>
															Lenovo 3rd Generation</option>
														<option>Nike Jordan</option>
													</select>
												</div>
											</div>
											<div class="col-lg-2 col-sm-6 col-12">
												<div class="input-blocks">
													<i data-feather="stop-circle" class="info-img"></i>
													<select class="select">
														<option>Choose Categroy</option>
														<option>Laptop</option>
														<option>Shoe</option>
													</select>
												</div>
											</div>

											<div class="col-lg-2 col-sm-6 col-12">
												<div class="input-blocks">
													<i data-feather="git-merge" class="info-img"></i>
													<select class="select">
														<option>Choose Sub Category</option>
														<option>Computers</option>
														<option>Fruits</option>
													</select>
												</div>
											</div>

											<div class="col-lg-2 col-sm-6 col-12">
												<div class="input-blocks">
													<i data-feather="stop-circle" class="info-img"></i>
													<select class="select">
														<option>All Brand</option>
														<option>Lenovo</option>
														<option>Nike</option>
													</select>
												</div>
											</div>

											<div class="col-lg-2 col-sm-6 col-12">
												<div class="input-blocks">
													<i class="fas fa-money-bill info-img"></i>
													<select class="select">
														<option>Price</option>
														<option>$12500.00</option>
														<option>$12500.00</option>
													</select>
												</div>
											</div>
											<div class="col-lg-2 col-sm-6 col-12">
												<div class="input-blocks">
													<a class="btn btn-filters ms-auto"> <i data-feather="search"
															class="feather-search"></i> Search </a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Filter -->
						<div class="table-responsive product-list">
                        <?php
include_once "./config/config.php";

// Fetch recipes along with ingredient counts
$sql = "SELECT r.id, r.recipe_name, r.created_at, ri.ingredients_json 
        FROM recipes r
        LEFT JOIN recipe_ingredients ri ON r.id = ri.recipe_id";

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
            <th>Recipe Name</th>
            <th>Number of Ingredients Used</th>
            <th>Created On</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $recipe_name = htmlspecialchars($row['recipe_name']);
                $created_at = htmlspecialchars($row['created_at']);
                $ingredient_count = 0;

                // Decode ingredients JSON and count the items
                $ingredients_json = $row['ingredients_json'];
                if (!empty($ingredients_json)) {
                    $ingredients = json_decode($ingredients_json, true);
                    if (is_array($ingredients)) {
                        $ingredient_count = count($ingredients);
                    }
                }

                echo "<tr>
                        <td>
                            <label class='checkboxs'>
                                <input type='checkbox'>
                                <span class='checkmarks'></span>
                            </label>
                        </td>
                        <td>$recipe_name</td>
                        <td>$ingredient_count</td>
                        <td>$created_at</td>
                        <td class='action-table-data'>
                            <div class='edit-delete-action'>
                                <a class='me-2 edit-icon p-2' href='#'>
                                    <i data-feather='eye' class='feather-eye'></i>
                                </a>
                                <a class='me-2 p-2' href='#'>
                                    <i data-feather='edit' class='feather-edit'></i>
                                </a>
                               
                                </a>
                            </div>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No recipes found.</td></tr>";
        }
        ?>
    </tbody>
</table>


						</div>
					</div>
				</div>
				<!-- /product list -->
			</div>
		

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
        <input type="text" class="form-control ingredient-name" name="ingredient_name[]" value="${name}" placeholder="Select Ingredient Name" required>
    </div>
    <div class="col-lg-3">
        <input type="number" class="form-control ingredient-quantity" name="ingredient_quantity[]" value="${quantity}" placeholder="Quantity" required>
    </div>
    <div class="col-lg-3">
        <select class="form-control ingredient-unit" name="ingredient_unit[]" required>
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