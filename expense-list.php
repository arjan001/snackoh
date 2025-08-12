<!DOCTYPE html>
<html lang="en">
<?php 
include_once "./includes/session_check.php"

?>	
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
								<h4>Expense List</h4>
								<h6>Manage Your Expenses</h6>
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
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-expense"><i data-feather="plus-circle" class="me-2"></i> Add New Expense</a>
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
										<option>11 09 23</option>
										<option>20 09 23</option>
									</select>
								</div>
							</div>
							<!-- /Filter -->
						
							<!-- /Filter -->
							

                            <?php
// Include database connection
include_once './config/config.php';

// Fetch expenses with category names
$query = "SELECT expenses.*, expense_category.expense_name 
          FROM expenses 
          JOIN expense_category ON expenses.expense_category_id = expense_category.id";
$result = mysqli_query($conn, $query);
?>

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
                <th>Expense Category</th>
                <th>Reference</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Description</th>
                <th class="no-sort">Action</th>
            </tr>
        </thead>
        <tbody class="Expense-list-blk">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td>
                        <label class="checkboxs">
                            <input type="checkbox">
                            <span class="checkmarks"></span>
                        </label>
                    </td>
                    <td><?= htmlspecialchars($row['expense_name']); ?></td>
                    <td><?= htmlspecialchars($row['reference']); ?></td>
                    <td><?= htmlspecialchars(date('d M Y', strtotime($row['date']))); ?></td>
                    <td>KSH <?= number_format($row['amount'], 2); ?></td>
                    <td><?= htmlspecialchars($row['description']); ?></td>
                    <td class="action-table-data">
                        <div class="edit-delete-action">
                            
                            <a class="me-2 p-2 mb-0 edit-btn" 
                               data-bs-toggle="modal" 
                               data-bs-target="#edit-units"
                               data-id="<?= $row['id']; ?>" 
                               data-category="<?= htmlspecialchars($row['expense_category_id']); ?>"
                               data-reference="<?= htmlspecialchars($row['reference']); ?>"
                               data-date="<?= htmlspecialchars($row['date']); ?>"
                               data-amount="<?= htmlspecialchars($row['amount']); ?>"
                               data-description="<?= htmlspecialchars($row['description']); ?>">
                                <i data-feather="edit" class="feather-edit"></i>
                            </a>
                            <a class="me-3 confirm-text p-2 mb-0 delete-btn" 
                               href="delete_expense.php?id=<?= $row['id']; ?>" 
                               onclick="return confirm('Are you sure you want to delete this expense?');">
                                <i data-feather="trash-2" class="feather-trash-2"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>



							
						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>
<!-- Add Expense Modal -->
<div class="modal fade" id="add-expense">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Add Expense</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
					<form action="add_expense.php" method="POST">
    <div class="row">
        <!-- Expense Category (Fetched from DB) -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Category Name</label>
            <select class="form-control" name="category_name" required>
                <option value="">Select Category</option>

                <?php
                include_once "./config/config.php";
                $result = $conn->query("SELECT expense_name FROM expense_category");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['expense_name'] . "'>" . $row['expense_name'] . "</option>";
                }
                ?>
            </select>
        </div>
        <!-- Reference -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Reference-(expense was used for?)</label>
            <input type="text" class="form-control" name="reference" required>
        </div>
    </div>

    <div class="row">
        <!-- Date -->
        <div class="col-md-12 mb-3">
            <label class="form-label">Date</label>
            <input type="date" class="form-control" name="date" required>
        </div>
    </div>

    <div class="row">
        <!-- Amount -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Amount</label>
            <input type="number" step="0.01" class="form-control" name="amount" required>
        </div>
        <!-- Description -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
    </div>

    <div class="modal-footer-btn">
        <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-submit">Add Expense</button>
    </div>
</form>

                    </div> 
					<!-- End Modal Body -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Add Expense Modal -->
 </div>
		<!-- /Main Wrapper -->

		

		<!-- Edit Expense -->
		<div class="modal fade" id="edit-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Expense</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
							<form action="add_expense.php" method="POST">
    <input type="hidden" name="expense_id" value="<?php echo $expense_id; ?>"> <!-- Hidden field for updating -->

    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Expense Category</label>
                <select class="select" name="category_name">
                    <option value="Employee Benefits" <?php echo ($category_name == 'Employee Benefits') ? 'selected' : ''; ?>>Employee Benefits</option>
                    <option value="Foods & Snacks" <?php echo ($category_name == 'Foods & Snacks') ? 'selected' : ''; ?>>Foods & Snacks</option>
                    <option value="Entertainment" <?php echo ($category_name == 'Entertainment') ? 'selected' : ''; ?>>Entertainment</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="input-blocks date-group">
                <i data-feather="calendar" class="info-img"></i>
                <div class="input-groupicon">
                    <input type="text" name="date" class="datetimepicker ps-5" placeholder="19 Jan 2023" value="<?php echo $date; ?>">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Amount</label>
                <input type="text" name="amount" class="form-control" value="<?php echo $amount; ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Reference</label>
                <input type="text" name="reference" class="form-control" value="<?php echo $reference; ?>">
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="edit-add card">
                <div class="edit-add">
                    <label class="form-label">Description</label>
                </div>
                <div class="card-body-list input-blocks mb-0">
                    <textarea class="form-control" name="description"><?php echo $description; ?></textarea>
                </div>
                <p>Maximum 600 Characters</p>
            </div>
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
		<!-- /Edit Expense -->
  

		 
		<?php include "includes/footer.php";?>
        <script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".edit-expense-btn").forEach(button => {
        button.addEventListener("click", function() {
            let expense = JSON.parse(this.getAttribute("data-expense")); // Assume data-expense contains JSON

            document.getElementById("expense_id").value = expense.id;
            document.querySelector("select[name='category_name']").value = expense.category_name;
            document.querySelector("input[name='date']").value = expense.date;
            document.querySelector("input[name='amount']").value = expense.amount;
            document.querySelector("input[name='reference']").value = expense.reference;
            document.querySelector("input[name='status']").value = expense.status;
            document.querySelector("textarea[name='description']").value = expense.description;
        });
    });
});

</script>


	
    </body>
</html>