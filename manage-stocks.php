<!DOCTYPE html>
<html lang="en">
<?php
include_once "./includes/session_check.php";
include "includes/header.php"; ?>

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
    <?php include "includes/sidebar.php"; ?>
    <!-- /Sidebar -->



    <div class="page-wrapper">
      <div class="content">
        <div class="page-header">
          <div class="add-item d-flex">
            <div class="page-title">
              <h4>Manage Inventory</h4>
              <h6>Manage your stock Inventory</h6>
            </div>
          </div>
          <ul class="table-top-head">
            <li>
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg"
                  alt="img"></a>
            </li>
            <li>
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img src="assets/img/icons/excel.svg"
                  alt="img"></a>
            </li>
            <li>
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer"
                  class="feather-rotate-ccw"></i></a>
            </li>
            <li>
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw"
                  class="feather-rotate-ccw"></i></a>
            </li>
            <li>
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                  data-feather="chevron-up" class="feather-chevron-up"></i></a>
            </li>
          </ul>
          <div class="page-btn">
            <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-stock"><i
                data-feather="plus-circle" class="me-2"></i>Add New Inventory</a>
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
                    <a href="javascript:void(0);" class="me-3 layout-box"><i data-feather="layout"
                        class="feather-search feather-20"></i></a>
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
                            <label for="option1" class="checktoggle"> </label>
                          </div>
                        </li>
                        <li>
                          <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                            <span class="status-label"><i data-feather="menu" class="feather-menu"></i>Product</span>
                            <input type="checkbox" id="option2" class="check" checked>
                            <label for="option2" class="checktoggle"> </label>
                          </div>
                        </li>
                        <li>
                          <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                            <span class="status-label"><i data-feather="menu" class="feather-menu"></i>Reference
                              No</span>
                            <input type="checkbox" id="option3" class="check" checked>
                            <label for="option3" class="checktoggle"> </label>
                          </div>
                        </li>
                        <li>
                          <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                            <span class="status-label"><i data-feather="menu" class="feather-menu"></i>Date</span>
                            <input type="checkbox" id="option4" class="check" checked>
                            <label for="option4" class="checktoggle"> </label>
                          </div>
                        </li>
                        <li>
                          <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                            <span class="status-label"><i data-feather="menu" class="feather-menu"></i>Responsible
                              Person</span>
                            <input type="checkbox" id="option5" class="check" checked>
                            <label for="option5" class="checktoggle"> </label>
                          </div>
                        </li>
                        <li>
                          <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                            <span class="status-label"><i data-feather="menu" class="feather-menu"></i>Notes</span>
                            <input type="checkbox" id="option6" class="check" checked>
                            <label for="option6" class="checktoggle"> </label>
                          </div>
                        </li>
                        <li>
                          <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                            <span class="status-label"><i data-feather="menu" class="feather-menu"></i>Quantity</span>
                            <input type="checkbox" id="option7" class="check" checked>
                            <label for="option7" class="checktoggle"> </label>
                          </div>
                        </li>
                        <li>
                          <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                            <span class="status-label"><i data-feather="menu" class="feather-menu"></i>Actions</span>
                            <input type="checkbox" id="option8" class="check" checked>
                            <label for="option8" class="checktoggle"> </label>
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

            <!-- /Filter -->
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
        LEFT JOIN units ON stock.stock_unit = units.id";

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
                    <th class="no-sort">Action</th>
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
                        <td class='action-table-data'>
                          <div class='edit-delete-action'>
                            <a class='me-2 p-2 edit-btn' href='' data-bs-toggle='modal' data-bs-target='#edit-stock'
                              data-id='<?= $productId; ?>' data-name='<?= $productName; ?>'
                              data-category-id='<?= $row['stock_category_id'] ?? ""; ?>'
                              data-quantity='<?= $stockQuantity; ?>' data-unit-id='<?= $row['stock_unit'] ?? ""; ?>'
                              data-expiry='<?= $expiryDate; ?>' data-reorder='<?= $reorderLevel; ?>'
                              data-supplier-id='<?= $row['stock_supplier_id'] ?? ""; ?>' data-price='<?= $stockPrice; ?>'>
                              <i data-feather='edit' class='feather-edit'></i>
                            </a>
                            <a class='confirm-text p-2' href='delete_stock.php?id=<?= $productId; ?>'
                              onclick="return confirm('Are you sure you want to delete this product?');">
                              <i data-feather='trash-2' class='feather-trash-2'></i>
                            </a>
                          </div>
                        </td>
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
  <!-- /Main Wrapper -->

  <!-- Add Stock -->
  <div class="modal fade" id="add-stock">
    <div class="modal-dialog modal-dialog-centered stock-adjust-modal">
      <div class="modal-content">
        <div class="page-wrapper-new p-0">
          <div class="content">
            <div class="modal-header border-0 custom-modal-header">
              <div class="page-title">
                <h4>Add Stock Inventory</h4>
              </div>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body custom-modal-body">
              <form action="add_stock.php" method="POST">
                <div class="row">
                  <div class="col-lg-6 col-sm-12 col-12">
                    <div class="mb-3 add-product">
                      <label class="form-label">Item Name</label>
                      <input type="text" class="form-control" name="stock_item_name" required>
                    </div>
                  </div>
                  <div class="col-lg-6 col-sm-12 col-12">
                    <div class="input-blocks">
                      <label>Category</label>
                      <select class="select" name="stock_category_id" required>
                        <?php
                        // Fetch stock categories from the database
                        include_once "./config/config.php";
                        $sql = "SELECT * FROM stock_category WHERE stock_category_status = 'active'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                          echo "<option value='" . $row['id'] . "'>" . $row['stock_category_name'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-sm-12 col-12">
                    <div class="mb-3 add-product">
                      <label class="form-label">Quantity</label>
                      <input type="number" class="form-control" name="stock_quantity" required>
                    </div>
                  </div>
                  <div class="col-lg-6 col-sm-12 col-12">
                    <div class="input-blocks">
                      <label>Unit</label>
                      <select class="select" name="stock_unit" required>
                        <?php
                        // Fetch units from the database
                        $sql = "SELECT * FROM units WHERE status = 'active'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                          echo "<option value='" . $row['id'] . "'>" . $row['unit_name'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-lg-6 col-sm-12 col-12">
                    <div class="mb-3 add-product">
                      <label class="form-label">Expiry Date</label>
                      <input type="date" class="form-control" name="stock_expiry_date" required>
                    </div>
                  </div>

                  <div class="col-lg-6 col-sm-12 col-12">
                    <div class="mb-3 add-product">
                      <label class="form-label">Supplier Price</label>
                      <input type="number" class="form-control" name="stock_price" required>
                    </div>
                  </div>



                </div>
                <div class="row">
                  <div class="col-lg-6 col-sm-12 col-12">
                    <div class="input-blocks">
                      <label>Supplier</label>
                      <select class="select" name="stock_supplier_id" required>
                        <?php
                        // Fetch suppliers from the database
                        $sql = "SELECT * FROM suppliers WHERE status = 'active'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                          echo "<option value='" . $row['id'] . "'>" . $row['supplier_name'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>


                  <div class="col-lg-6 col-sm-12 col-12">
                    <div class="mb-3 add-product">
                      <label class="form-label">Reorder Level</label>
                      <input type="number" class="form-control" name="reorder_level" required id="reorder_level">
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
  <!-- /Add Stock -->


  <!-- Edit Stock -->

  <!-- Edit Stock Modal -->
  <div class="modal fade" id="edit-stock">
    <div class="modal-dialog modal-dialog-centered stock-adjust-modal">
      <div class="modal-content">
        <div class="modal-header border-0 custom-modal-header">
          <h4>Edit Stock Inventory</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body custom-modal-body">
          <form action="update_stock.php" method="POST">
            <input type="hidden" name="stock_id" id="edit_stock_id">
            <div class="row">
              <div class="col-lg-6">
                <label>Item Name</label>
                <input type="text" class="form-control" name="stock_item_name" id="edit_stock_item_name" required>
              </div>
              <div class="col-lg-6">
                <label>Quantity</label>
                <input type="number" class="form-control" name="stock_quantity" id="edit_stock_quantity" required>
              </div>
              <!-- <div class="col-lg-6">
              <label>Category</label>
              <select class="select" name="stock_category_id" id="edit_stock_category_id" required></select>
            </div> -->
            </div>
            <div class="row">

              <!-- <div class="col-lg-6">
              <label>Unit</label>
              <select class="select" name="stock_unit" id="edit_stock_unit" required></select>
            </div> -->
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label>Expiry Date</label>
                <input type="date" class="form-control" name="stock_expiry_date" id="edit_stock_expiry_date" required>
              </div>
              <div class="col-lg-6">
                <label>Supplier Price</label>
                <input type="number" class="form-control" name="stock_price" id="edit_stock_price" required>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label>current quantity</label>
                <input type="number" class="form-control" name="stock_quantity" id="edit_stock_quantity" required>
              </div>
              <div class="col-lg-6">
                <label>Reorder Level</label>
                <input type="number" class="form-control" name="reorder_level" id="edit_reorder_level" required>
              </div>
            </div>
            <div class="modal-footer-btn">
              <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-submit">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- /Edit Stock -->



  <?php include "includes/footer.php"; ?>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function () {
          document.getElementById("edit_stock_id").value = this.dataset.id;
          document.getElementById("edit_stock_item_name").value = this.dataset.name;
          document.getElementById("edit_stock_quantity").value = this.dataset.quantity;
          document.getElementById("edit_stock_expiry_date").value = this.dataset.expiry;
          document.getElementById("edit_reorder_level").value = this.dataset.reorder;
          document.getElementById("edit_stock_price").value = this.dataset.price;
          // Ensure dropdowns correctly set values
          document.getElementById("edit_stock_category_id").value = this.dataset.categoryId;
          document.getElementById("edit_stock_unit").value = this.dataset.unitId;  // ✅ Corrected unit_id
          document.getElementById("edit_stock_supplier_id").value = this.dataset.supplierId;
        });
      });
    });
  </script>


</body>

</html>