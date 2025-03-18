<!DOCTYPE html>
<html lang="en">
<?php
include_once "./includes/session_check.php"

  ?>
<?php include "includes/header.php"; ?>


<body>
  <div id="global-loader">
    <div class="whirly-loader"></div>
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
        <div class="page-header justify-content-between">
          <div class="page-title">
            <h4>Expenses</h4>
            <h6>Manage your Expenses</h6>
          </div>
          <ul class="table-top-head">
            <li>
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg"
                  alt="img" /></a>
            </li>
            <li>
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img src="assets/img/icons/excel.svg"
                  alt="img" /></a>
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
                    <span><img src="assets/img/icons/closes.svg" alt="img" /></span>
                  </a>
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
              <table class="table datanew">
                <thead>
                  <tr>
                    <th class="no-sort">
                      <label class="checkboxs">
                        <input type="checkbox" id="select-all" />
                        <span class="checkmarks"></span>
                      </label>
                    </th>
                    <th>Date</th>
                    <th>Expense Category</th>
                    <th>User</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody class="Expense-list">
                  <tr>
                    <td>
                      <label class="checkboxs">
                        <input type="checkbox" />
                        <span class="checkmarks"></span>
                      </label>
                    </td>
                    <td>01 Jan 2024</td>
                    <td>Printing</td>
                    <td>Mitchum Daniel</td>
                    <td>KSH 14,174</td>
                  </tr>
                  <tr>
                    <td>
                      <label class="checkboxs">
                        <input type="checkbox" />
                        <span class="checkmarks"></span>
                      </label>
                    </td>
                    <td>14 Jan 2024</td>
                    <td>Utilities</td>
                    <td>Susan Lopez</td>
                    <td>KSH 19,474</td>
                  </tr>
               
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


  <!-- jQuery -->
  <script src="assets/js/jquery-3.7.1.min.js"></script>

  <!-- Feather Icon JS -->
  <script src="assets/js/feather.min.js"></script>

  <!-- Slimscroll JS -->
  <script src="assets/js/jquery.slimscroll.min.js"></script>

  <!-- Datatable JS -->
  <script src="assets/js/jquery.dataTables.min.js"></script>
  <script src="assets/js/dataTables.bootstrap5.min.js"></script>

  <!-- Bootstrap Core JS -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>

  <!-- Datetimepicker JS -->
  <script src="assets/js/moment.min.js"></script>
  <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

  <!-- Daterangepikcer JS -->
  <script src="assets/js/moment.min.js"></script>
  <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>

  <!-- Select2 JS -->
  <script src="assets/plugins/select2/js/select2.min.js"></script>

  <!-- Sweetalert 2 -->
  <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
  <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

  <!-- Custom JS -->
  <script src="assets/js/theme-script.js"></script>
  <script src="assets/js/script.js"></script>
</body>

</html>