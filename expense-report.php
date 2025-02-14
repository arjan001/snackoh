<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0"
    />
    <meta name="description" content="POS - Bootstrap Admin Template" />
    <meta
      name="keywords"
      content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects"
    />
    <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
    <meta name="robots" content="noindex, nofollow" />
    <title>SNACK-OH BAKERY ERP</title>

    <!-- Favicon -->
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="assets/img/favicon.png"
    />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css" />

    <!-- animation CSS -->
    <link rel="stylesheet" href="assets/css/animate.css" />

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css" />

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css" />

    <!-- Daterangepikcer CSS -->
    <link
      rel="stylesheet"
      href="assets/plugins/daterangepicker/daterangepicker.css"
    />

    <!-- Fontawesome CSS -->
    <link
      rel="stylesheet"
      href="assets/plugins/fontawesome/css/fontawesome.min.css"
    />
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body>
    <div id="global-loader">
      <div class="whirly-loader"></div>
    </div>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
      <!-- Header -->
      <div class="header">
        <!-- Logo -->
        <div class="header-left active">
          <a href="index.html" class="logo logo-normal">
            <img src="assets/img/logo.png" alt="" />
          </a>
          <a href="index.html" class="logo logo-white">
            <img src="assets/img/logo-white.png" alt="" />
          </a>
          <a href="index.html" class="logo-small">
            <img src="assets/img/logo-small.png" alt="" />
          </a>
          <a id="toggle_btn" href="javascript:void(0);">
            <i data-feather="chevrons-left" class="feather-16"></i>
          </a>
        </div>
        <!-- /Logo -->

        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
          <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </a>

        <!-- Header Menu -->
        <ul class="nav user-menu">
          <!-- Search -->
          <li class="nav-item nav-searchinputs">
            <div class="top-nav-search">
              <a href="javascript:void(0);" class="responsive-search">
                <i class="fa fa-search"></i>
              </a>
              <form action="#" class="dropdown">
                <div
                  class="searchinputs dropdown-toggle"
                  id="dropdownMenuClickable"
                  data-bs-toggle="dropdown"
                  data-bs-auto-close="false"
                >
                  <input type="text" placeholder="Search" />
                  <div class="search-addon">
                    <span
                      ><i data-feather="x-circle" class="feather-14"></i
                    ></span>
                  </div>
                </div>
                <div
                  class="dropdown-menu search-dropdown"
                  aria-labelledby="dropdownMenuClickable"
                >
                  <div class="search-info">
                    <h6>
                      <span
                        ><i data-feather="search" class="feather-16"></i></span
                      >Recent Searches
                    </h6>
                    <ul class="search-tags">
                      <li><a href="javascript:void(0);">Products</a></li>
                      <li><a href="javascript:void(0);">Sales</a></li>
                      <li><a href="javascript:void(0);">Applications</a></li>
                    </ul>
                  </div>
                  <div class="search-info">
                    <h6>
                      <span
                        ><i
                          data-feather="help-circle"
                          class="feather-16"
                        ></i></span
                      >Help
                    </h6>
                    <p>
                      How to Change Product Volume from 0 to 200 on Inventory
                      management
                    </p>
                    <p>Change Product Name</p>
                  </div>
                  <div class="search-info">
                    <h6>
                      <span><i data-feather="user" class="feather-16"></i></span
                      >Customers
                    </h6>
                    <ul class="customers">
                      <li>
                        <a href="javascript:void(0);"
                          >Aron Varu<img
                            src="assets/img/profiles/avator1.jpg"
                            alt=""
                            class="img-fluid"
                        /></a>
                      </li>
                      <li>
                        <a href="javascript:void(0);"
                          >Jonita<img
                            src="assets/img/profiles/avatar-01.jpg"
                            alt=""
                            class="img-fluid"
                        /></a>
                      </li>
                      <li>
                        <a href="javascript:void(0);"
                          >Aaron<img
                            src="assets/img/profiles/avatar-10.jpg"
                            alt=""
                            class="img-fluid"
                        /></a>
                      </li>
                    </ul>
                  </div>
                </div>
              </form>
            </div>
          </li>
          <!-- /Search -->

          <!-- Select Store -->
          <li
            class="nav-item dropdown has-arrow main-drop select-store-dropdown"
          >
            <a
              href="javascript:void(0);"
              class="dropdown-toggle nav-link select-store"
              data-bs-toggle="dropdown"
            >
              <span class="user-info">
                <span class="user-letter">
                  <img
                    src="assets/img/store/store-01.png"
                    alt="Store Logo"
                    class="img-fluid"
                  />
                </span>
                <span class="user-detail">
                  <span class="user-name">Select Store</span>
                </span>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="javascript:void(0);" class="dropdown-item">
                <img
                  src="assets/img/store/store-01.png"
                  alt="Store Logo"
                  class="img-fluid"
                />
                Grocery Alpha
              </a>
              <a href="javascript:void(0);" class="dropdown-item">
                <img
                  src="assets/img/store/store-02.png"
                  alt="Store Logo"
                  class="img-fluid"
                />
                Grocery Apex
              </a>
              <a href="javascript:void(0);" class="dropdown-item">
                <img
                  src="assets/img/store/store-03.png"
                  alt="Store Logo"
                  class="img-fluid"
                />
                Grocery Bevy
              </a>
              <a href="javascript:void(0);" class="dropdown-item">
                <img
                  src="assets/img/store/store-04.png"
                  alt="Store Logo"
                  class="img-fluid"
                />
                Grocery Eden
              </a>
            </div>
          </li>
          <!-- /Select Store -->

          <!-- Flag -->
          <li class="nav-item dropdown has-arrow flag-nav nav-item-box">
            <a
              class="nav-link dropdown-toggle"
              data-bs-toggle="dropdown"
              href="javascript:void(0);"
              role="button"
            >
              <img
                src="assets/img/flags/us.png"
                alt="Language"
                class="img-fluid"
              />
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="javascript:void(0);" class="dropdown-item active">
                <img src="assets/img/flags/us.png" alt="" height="16" /> English
              </a>
              <a href="javascript:void(0);" class="dropdown-item">
                <img src="assets/img/flags/fr.png" alt="" height="16" /> French
              </a>
              <a href="javascript:void(0);" class="dropdown-item">
                <img src="assets/img/flags/es.png" alt="" height="16" /> Spanish
              </a>
              <a href="javascript:void(0);" class="dropdown-item">
                <img src="assets/img/flags/de.png" alt="" height="16" /> German
              </a>
            </div>
          </li>
          <!-- /Flag -->

          <li class="nav-item nav-item-box">
            <a href="javascript:void(0);" id="btnFullscreen">
              <i data-feather="maximize"></i>
            </a>
          </li>
          <li class="nav-item nav-item-box">
            <a href="email.html">
              <i data-feather="mail"></i>
              <span class="badge rounded-pill">1</span>
            </a>
          </li>
          <!-- Notifications -->
          <li class="nav-item dropdown nav-item-box">
            <a
              href="javascript:void(0);"
              class="dropdown-toggle nav-link"
              data-bs-toggle="dropdown"
            >
              <i data-feather="bell"></i
              ><span class="badge rounded-pill">2</span>
            </a>
            <div class="dropdown-menu notifications">
              <div class="topnav-dropdown-header">
                <span class="notification-title">Notifications</span>
                <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
              </div>
              <div class="noti-content">
                <ul class="notification-list">
                  <li class="notification-message">
                    <a href="activities.html">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img alt="" src="assets/img/profiles/avatar-02.jpg" />
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details">
                            <span class="noti-title">John Doe</span> added new
                            task
                            <span class="noti-title"
                              >Patient appointment booking</span
                            >
                          </p>
                          <p class="noti-time">
                            <span class="notification-time">4 mins ago</span>
                          </p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="notification-message">
                    <a href="activities.html">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img alt="" src="assets/img/profiles/avatar-03.jpg" />
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details">
                            <span class="noti-title">Tarah Shropshire</span>
                            changed the task name
                            <span class="noti-title"
                              >Appointment booking with payment gateway</span
                            >
                          </p>
                          <p class="noti-time">
                            <span class="notification-time">6 mins ago</span>
                          </p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="notification-message">
                    <a href="activities.html">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img alt="" src="assets/img/profiles/avatar-06.jpg" />
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details">
                            <span class="noti-title">Misty Tison</span> added
                            <span class="noti-title">Domenic Houston</span> and
                            <span class="noti-title">Claire Mapes</span> to
                            project
                            <span class="noti-title"
                              >Doctor available module</span
                            >
                          </p>
                          <p class="noti-time">
                            <span class="notification-time">8 mins ago</span>
                          </p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="notification-message">
                    <a href="activities.html">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img alt="" src="assets/img/profiles/avatar-17.jpg" />
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details">
                            <span class="noti-title">Rolland Webber</span>
                            completed task
                            <span class="noti-title"
                              >Patient and Doctor video conferencing</span
                            >
                          </p>
                          <p class="noti-time">
                            <span class="notification-time">12 mins ago</span>
                          </p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="notification-message">
                    <a href="activities.html">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img alt="" src="assets/img/profiles/avatar-13.jpg" />
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details">
                            <span class="noti-title">Bernardo Galaviz</span>
                            added new task
                            <span class="noti-title">Private chat module</span>
                          </p>
                          <p class="noti-time">
                            <span class="notification-time">2 days ago</span>
                          </p>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="topnav-dropdown-footer">
                <a href="activities.html">View all Notifications</a>
              </div>
            </div>
          </li>
          <!-- /Notifications -->

          <li class="nav-item nav-item-box">
            <a href="general-settings.html"><i data-feather="settings"></i></a>
          </li>
          <li class="nav-item dropdown has-arrow main-drop">
            <a
              href="javascript:void(0);"
              class="dropdown-toggle nav-link userset"
              data-bs-toggle="dropdown"
            >
              <span class="user-info">
                <span class="user-letter">
                  <img
                    src="assets/img/profiles/avator1.jpg"
                    alt=""
                    class="img-fluid"
                  />
                </span>
                <span class="user-detail">
                  <span class="user-name">George Macharia</span>
                  <span class="user-role">Super Admin</span>
                </span>
              </span>
            </a>
            <div class="dropdown-menu menu-drop-user">
              <div class="profilename">
                <div class="profileset">
                  <span class="user-img"
                    ><img src="assets/img/profiles/avator1.jpg" alt="" />
                    <span class="status online"></span
                  ></span>
                  <div class="profilesets">
                    <h6>George Macharia</h6>
                    <h5>Super Admin</h5>
                  </div>
                </div>
                <hr class="m-0" />
                <a class="dropdown-item" href="profile.html">
                  <i class="me-2" data-feather="user"></i> My Profile</a
                >
                <a class="dropdown-item" href="general-settings.html"
                  ><i class="me-2" data-feather="settings"></i>Settings</a
                >
                <hr class="m-0" />
                <a class="dropdown-item logout pb-0" href="signin.html"
                  ><img
                    src="assets/img/icons/log-out.svg"
                    class="me-2"
                    alt="img"
                  />Logout</a
                >
              </div>
            </div>
          </li>
        </ul>
        <!-- /Header Menu -->

        <!-- Mobile Menu -->
        <div class="dropdown mobile-user-menu">
          <a
            href="javascript:void(0);"
            class="nav-link dropdown-toggle"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            ><i class="fa fa-ellipsis-v"></i
          ></a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="profile.html">My Profile</a>
            <a class="dropdown-item" href="general-settings.html">Settings</a>
            <a class="dropdown-item" href="signin.html">Logout</a>
          </div>
        </div>
        <!-- /Mobile Menu -->
      </div>
      <!-- /Header -->

      <!-- Sidebar -->
      <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
          <div id="sidebar-menu" class="sidebar-menu">
            <ul>
              <li class="submenu-open">
                <h6 class="submenu-hdr">Main</h6>
                <ul>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="grid"></i><span>Dashboard</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li><a href="index.html">Admin Dashboard</a></li>
                      <li>
                        <a href="sales-dashboard.html">Sales Dashboard</a>
                      </li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="smartphone"></i><span>Application</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li><a href="chat.html">Chat</a></li>
                      <li class="submenu submenu-two">
                        <a href="javascript:void(0);"
                          >Call<span class="menu-arrow inside-submenu"></span
                        ></a>
                        <ul>
                          <li><a href="video-call.html">Video Call</a></li>
                          <li><a href="audio-call.html">Audio Call</a></li>
                          <li><a href="call-history.html">Call History</a></li>
                        </ul>
                      </li>
                      <li><a href="calendar.html">Calendar</a></li>
                      <li><a href="email.html">Email</a></li>
                      <li><a href="todo.html">To Do</a></li>
                      <li><a href="notes.html">Notes</a></li>
                      <li><a href="file-manager.html">File Manager</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="submenu-open">
                <h6 class="submenu-hdr">Inventory</h6>
                <ul>
                  <li>
                    <a href="product-list.html"
                      ><i data-feather="box"></i><span>Products</span></a
                    >
                  </li>
                  <li>
                    <a href="add-product.html"
                      ><i data-feather="plus-square"></i
                      ><span>Create Product</span></a
                    >
                  </li>
                  <li>
                    <a href="expired-products.html"
                      ><i data-feather="codesandbox"></i
                      ><span>Expired Products</span></a
                    >
                  </li>
                  <li>
                    <a href="low-stocks.html"
                      ><i data-feather="trending-down"></i
                      ><span>Low Stocks</span></a
                    >
                  </li>
                  <li>
                    <a href="category-list.html"
                      ><i data-feather="codepen"></i><span>Category</span></a
                    >
                  </li>
                  <li>
                    <a href="sub-categories.html"
                      ><i data-feather="speaker"></i
                      ><span>Sub Category</span></a
                    >
                  </li>
                  <li>
                    <a href="brand-list.html"
                      ><i data-feather="tag"></i><span>Brands</span></a
                    >
                  </li>
                  <li>
                    <a href="units.html"
                      ><i data-feather="speaker"></i><span>Units</span></a
                    >
                  </li>
                  <li>
                    <a href="varriant-attributes.html"
                      ><i data-feather="layers"></i
                      ><span>Variant Attributes</span></a
                    >
                  </li>
                  <li>
                    <a href="warranty.html"
                      ><i data-feather="bookmark"></i><span>Warranties</span></a
                    >
                  </li>
                  <li>
                    <a href="barcode.html"
                      ><i data-feather="align-justify"></i
                      ><span>Print Barcode</span></a
                    >
                  </li>
                  <li>
                    <a href="qrcode.html"
                      ><i data-feather="maximize"></i
                      ><span>Print QR Code</span></a
                    >
                  </li>
                </ul>
              </li>
              <li class="submenu-open">
                <h6 class="submenu-hdr">Stock</h6>
                <ul>
                  <li>
                    <a href="manage-stocks.html"
                      ><i data-feather="package"></i
                      ><span>Manage Stock</span></a
                    >
                  </li>
                  <li>
                    <a href="stock-adjustment.html"
                      ><i data-feather="clipboard"></i
                      ><span>Stock Adjustment</span></a
                    >
                  </li>
                  <li>
                    <a href="stock-transfer.html"
                      ><i data-feather="truck"></i
                      ><span>Stock Transfer</span></a
                    >
                  </li>
                </ul>
              </li>
              <li class="submenu-open">
                <h6 class="submenu-hdr">Sales</h6>
                <ul>
                  <li>
                    <a href="sales-list.html"
                      ><i data-feather="shopping-cart"></i><span>Sales</span></a
                    >
                  </li>
                  <li>
                    <a href="invoice-report.html"
                      ><i data-feather="file-text"></i><span>Invoices</span></a
                    >
                  </li>
                  <li>
                    <a href="sales-returns.html"
                      ><i data-feather="copy"></i><span>Sales Return</span></a
                    >
                  </li>
                  <li>
                    <a href="quotation-list.html"
                      ><i data-feather="save"></i><span>Quotation</span></a
                    >
                  </li>
                  <li>
                    <a href="pos.html"
                      ><i data-feather="hard-drive"></i><span>POS</span></a
                    >
                  </li>
                </ul>
              </li>
              <li class="submenu-open">
                <h6 class="submenu-hdr">Promo</h6>
                <ul>
                  <li>
                    <a href="coupons.html"
                      ><i data-feather="shopping-cart"></i
                      ><span>Coupons</span></a
                    >
                  </li>
                </ul>
              </li>
              <li class="submenu-open">
                <h6 class="submenu-hdr">Purchases</h6>
                <ul>
                  <li>
                    <a href="purchase-list.html"
                      ><i data-feather="shopping-bag"></i
                      ><span>Purchases</span></a
                    >
                  </li>
                  <li>
                    <a href="purchase-order-report.html"
                      ><i data-feather="file-minus"></i
                      ><span>Purchase Order</span></a
                    >
                  </li>
                  <li>
                    <a href="purchase-returns.html"
                      ><i data-feather="refresh-cw"></i
                      ><span>Purchase Return</span></a
                    >
                  </li>
                </ul>
              </li>
              <li class="submenu-open">
                <h6 class="submenu-hdr">Finance & Accounts</h6>
                <ul>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="file-text"></i><span>Expenses</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li><a href="expense-list.html">Expenses</a></li>
                      <li>
                        <a href="expense-category.html">Expense Category</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="submenu-open">
                <h6 class="submenu-hdr">Peoples</h6>
                <ul>
                  <li>
                    <a href="customers.html"
                      ><i data-feather="user"></i><span>Customers</span></a
                    >
                  </li>
                  <li>
                    <a href="suppliers.html"
                      ><i data-feather="users"></i><span>Suppliers</span></a
                    >
                  </li>
                  <li>
                    <a href="store-list.html"
                      ><i data-feather="home"></i><span>Stores</span></a
                    >
                  </li>
                  <li>
                    <a href="warehouse.html"
                      ><i data-feather="archive"></i><span>Warehouses</span></a
                    >
                  </li>
                </ul>
              </li>
              <li class="submenu-open">
                <h6 class="submenu-hdr">HRM</h6>
                <ul>
                  <li>
                    <a href="employees-grid.html"
                      ><i data-feather="user"></i><span>Employees</span></a
                    >
                  </li>
                  <li>
                    <a href="department-grid.html"
                      ><i data-feather="users"></i><span>Departments</span></a
                    >
                  </li>
                  <li>
                    <a href="designation.html"
                      ><i data-feather="git-merge"></i
                      ><span>Designation</span></a
                    >
                  </li>
                  <li>
                    <a href="shift.html"
                      ><i data-feather="shuffle"></i><span>Shifts</span></a
                    >
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="book-open"></i><span>Attendence</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li><a href="attendance-employee.html">Employee</a></li>
                      <li><a href="attendance-admin.html">Admin</a></li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="calendar"></i><span>Leaves</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li><a href="leaves-admin.html">Admin Leaves</a></li>
                      <li>
                        <a href="leaves-employee.html">Employee Leaves</a>
                      </li>
                      <li><a href="leave-types.html">Leave Types</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="holidays.html"
                      ><i data-feather="credit-card"></i
                      ><span>Holidays</span></a
                    >
                  </li>
                  <li class="submenu">
                    <a href="payroll-list.html"
                      ><i data-feather="dollar-sign"></i><span>Payroll</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li><a href="payroll-list.html">Employee Salary</a></li>
                      <li><a href="payslip.html">Payslip</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="submenu-open">
                <h6 class="submenu-hdr">Reports</h6>
                <ul>
                  <li>
                    <a href="sales-report.html"
                      ><i data-feather="bar-chart-2"></i
                      ><span>Sales Report</span></a
                    >
                  </li>
                  <li>
                    <a href="purchase-report.html"
                      ><i data-feather="pie-chart"></i
                      ><span>Purchase report</span></a
                    >
                  </li>
                  <li>
                    <a href="inventory-report.html"
                      ><i data-feather="inbox"></i
                      ><span>Inventory Report</span></a
                    >
                  </li>
                  <li>
                    <a href="invoice-report.html"
                      ><i data-feather="file"></i><span>Invoice Report</span></a
                    >
                  </li>
                  <li>
                    <a href="supplier-report.html"
                      ><i data-feather="user-check"></i
                      ><span>Supplier Report</span></a
                    >
                  </li>
                  <li>
                    <a href="customer-report.html"
                      ><i data-feather="user"></i
                      ><span>Customer Report</span></a
                    >
                  </li>
                  <li class="active">
                    <a href="expense-report.html"
                      ><i data-feather="file"></i><span>Expense Report</span></a
                    >
                  </li>
                  <li>
                    <a href="income-report.html"
                      ><i data-feather="bar-chart"></i
                      ><span>Income Report</span></a
                    >
                  </li>
                  <li>
                    <a href="tax-reports.html"
                      ><i data-feather="database"></i><span>Tax Report</span></a
                    >
                  </li>
                  <li>
                    <a href="profit-and-loss.html"
                      ><i data-feather="pie-chart"></i
                      ><span>Profit & Loss</span></a
                    >
                  </li>
                </ul>
              </li>
              <li class="submenu-open">
                <h6 class="submenu-hdr">User Management</h6>
                <ul>
                  <li>
                    <a href="users.html"
                      ><i data-feather="user-check"></i><span>Users</span></a
                    >
                  </li>
                  <li>
                    <a href="roles-permissions.html"
                      ><i data-feather="shield"></i
                      ><span>Roles & Permissions</span></a
                    >
                  </li>
                  <li>
                    <a href="delete-account.html"
                      ><i data-feather="lock"></i
                      ><span>Delete Account Request</span></a
                    >
                  </li>
                </ul>
              </li>
              <li class="submenu-open">
                <h6 class="submenu-hdr">Pages</h6>
                <ul>
                  <li>
                    <a href="profile.html"
                      ><i data-feather="user"></i><span>Profile</span></a
                    >
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="shield"></i><span>Authentication</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li class="submenu submenu-two">
                        <a href="javascript:void(0);"
                          >Login<span class="menu-arrow inside-submenu"></span
                        ></a>
                        <ul>
                          <li><a href="signin.html">Cover</a></li>
                          <li><a href="signin-2.html">Illustration</a></li>
                          <li><a href="signin-3.html">Basic</a></li>
                        </ul>
                      </li>
                      <li class="submenu submenu-two">
                        <a href="javascript:void(0);"
                          >Register<span
                            class="menu-arrow inside-submenu"
                          ></span
                        ></a>
                        <ul>
                          <li><a href="register.html">Cover</a></li>
                          <li><a href="register-2.html">Illustration</a></li>
                          <li><a href="register-3.html">Basic</a></li>
                        </ul>
                      </li>
                      <li class="submenu submenu-two">
                        <a href="javascript:void(0);"
                          >Forgot Password<span
                            class="menu-arrow inside-submenu"
                          ></span
                        ></a>
                        <ul>
                          <li><a href="forgot-password.html">Cover</a></li>
                          <li>
                            <a href="forgot-password-2.html">Illustration</a>
                          </li>
                          <li><a href="forgot-password-3.html">Basic</a></li>
                        </ul>
                      </li>
                      <li class="submenu submenu-two">
                        <a href="javascript:void(0);"
                          >Reset Password<span
                            class="menu-arrow inside-submenu"
                          ></span
                        ></a>
                        <ul>
                          <li><a href="reset-password.html">Cover</a></li>
                          <li>
                            <a href="reset-password-2.html">Illustration</a>
                          </li>
                          <li><a href="reset-password-3.html">Basic</a></li>
                        </ul>
                      </li>
                      <li class="submenu submenu-two">
                        <a href="javascript:void(0);"
                          >Email Verification<span
                            class="menu-arrow inside-submenu"
                          ></span
                        ></a>
                        <ul>
                          <li><a href="email-verification.html">Cover</a></li>
                          <li>
                            <a href="email-verification-2.html">Illustration</a>
                          </li>
                          <li><a href="email-verification-3.html">Basic</a></li>
                        </ul>
                      </li>
                      <li class="submenu submenu-two">
                        <a href="javascript:void(0);"
                          >2 Step Verification<span
                            class="menu-arrow inside-submenu"
                          ></span
                        ></a>
                        <ul>
                          <li>
                            <a href="two-step-verification.html">Cover</a>
                          </li>
                          <li>
                            <a href="two-step-verification-2.html"
                              >Illustration</a
                            >
                          </li>
                          <li>
                            <a href="two-step-verification-3.html">Basic</a>
                          </li>
                        </ul>
                      </li>
                      <li><a href="lock-screen.html">Lock Screen</a></li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="file-minus"></i><span>Error Pages</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li><a href="error-404.html">404 Error </a></li>
                      <li><a href="error-500.html">500 Error </a></li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="map"></i><span>Places</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li><a href="countries.html">Countries</a></li>
                      <li><a href="states.html">States</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="blank-page.html"
                      ><i data-feather="file"></i><span>Blank Page</span>
                    </a>
                  </li>
                  <li>
                    <a href="coming-soon.html"
                      ><i data-feather="send"></i><span>Coming Soon</span>
                    </a>
                  </li>
                  <li>
                    <a href="under-maintenance.html"
                      ><i data-feather="alert-triangle"></i
                      ><span>Under Maintenance</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="submenu-open">
                <h6 class="submenu-hdr">Settings</h6>
                <ul>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="settings"></i
                      ><span>General Settings</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li><a href="general-settings.html">Profile</a></li>
                      <li><a href="security-settings.html">Security</a></li>
                      <li><a href="notification.html">Notifications</a></li>
                      <li><a href="connected-apps.html">Connected Apps</a></li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="globe"></i><span>Website Settings</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li>
                        <a href="system-settings.html">System Settings</a>
                      </li>
                      <li>
                        <a href="company-settings.html">Company Settings </a>
                      </li>
                      <li>
                        <a href="localization-settings.html">Localization</a>
                      </li>
                      <li><a href="prefixes.html">Prefixes</a></li>
                      <li><a href="preference.html">Preference</a></li>
                      <li><a href="appearance.html">Appearance</a></li>
                      <li>
                        <a href="social-authentication.html"
                          >Social Authentication</a
                        >
                      </li>
                      <li><a href="language-settings.html">Language</a></li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="smartphone"></i><span>App Settings</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li><a href="invoice-settings.html">Invoice</a></li>
                      <li><a href="printer-settings.html">Printer</a></li>
                      <li><a href="pos-settings.html">POS</a></li>
                      <li><a href="custom-fields.html">Custom Fields</a></li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="monitor"></i><span>System Settings</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li><a href="email-settings.html">Email</a></li>
                      <li><a href="sms-gateway.html">SMS Gateways</a></li>
                      <li><a href="otp-settings.html">OTP</a></li>
                      <li><a href="gdpr-settings.html">GDPR Cookies</a></li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="dollar-sign"></i
                      ><span>Financial Settings</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li>
                        <a href="payment-gateway-settings.html"
                          >Payment Gateway</a
                        >
                      </li>
                      <li>
                        <a href="bank-settings-grid.html">Bank Accounts</a>
                      </li>
                      <li><a href="tax-rates.html">Tax Rates</a></li>
                      <li><a href="currency-settings.html">Currencies</a></li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="hexagon"></i><span>Other Settings</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li><a href="storage-settings.html">Storage</a></li>
                      <li><a href="ban-ip-address.html">Ban IP Address</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="signin.html"
                      ><i data-feather="log-out"></i><span>Logout</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="submenu-open">
                <h6 class="submenu-hdr">UI Interface</h6>
                <ul>
                  <li class="submenu">
                    <a href="javascript:void(0);">
                      <i data-feather="layers"></i><span>Base UI</span
                      ><span class="menu-arrow"></span>
                    </a>
                    <ul>
                      <li><a href="ui-alerts.html">Alerts</a></li>
                      <li><a href="ui-accordion.html">Accordion</a></li>
                      <li><a href="ui-avatar.html">Avatar</a></li>
                      <li><a href="ui-badges.html">Badges</a></li>
                      <li><a href="ui-borders.html">Border</a></li>
                      <li><a href="ui-buttons.html">Buttons</a></li>
                      <li><a href="ui-buttons-group.html">Button Group</a></li>
                      <li><a href="ui-breadcrumb.html">Breadcrumb</a></li>
                      <li><a href="ui-cards.html">Card</a></li>
                      <li><a href="ui-carousel.html">Carousel</a></li>
                      <li><a href="ui-colors.html">Colors</a></li>
                      <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                      <li><a href="ui-grid.html">Grid</a></li>
                      <li><a href="ui-images.html">Images</a></li>
                      <li><a href="ui-lightbox.html">Lightbox</a></li>
                      <li><a href="ui-media.html">Media</a></li>
                      <li><a href="ui-modals.html">Modals</a></li>
                      <li><a href="ui-offcanvas.html">Offcanvas</a></li>
                      <li><a href="ui-pagination.html">Pagination</a></li>
                      <li><a href="ui-popovers.html">Popovers</a></li>
                      <li><a href="ui-progress.html">Progress</a></li>
                      <li><a href="ui-placeholders.html">Placeholders</a></li>
                      <li><a href="ui-rangeslider.html">Range Slider</a></li>
                      <li><a href="ui-spinner.html">Spinner</a></li>
                      <li><a href="ui-sweetalerts.html">Sweet Alerts</a></li>
                      <li><a href="ui-nav-tabs.html">Tabs</a></li>
                      <li><a href="ui-toasts.html">Toasts</a></li>
                      <li><a href="ui-tooltips.html">Tooltips</a></li>
                      <li><a href="ui-typography.html">Typography</a></li>
                      <li><a href="ui-video.html">Video</a></li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);">
                      <i data-feather="layers"></i><span>Advanced UI</span
                      ><span class="menu-arrow"></span>
                    </a>
                    <ul>
                      <li><a href="ui-ribbon.html">Ribbon</a></li>
                      <li><a href="ui-clipboard.html">Clipboard</a></li>
                      <li><a href="ui-drag-drop.html">Drag & Drop</a></li>
                      <li><a href="ui-rangeslider.html">Range Slider</a></li>
                      <li><a href="ui-rating.html">Rating</a></li>
                      <li><a href="ui-text-editor.html">Text Editor</a></li>
                      <li><a href="ui-counter.html">Counter</a></li>
                      <li><a href="ui-scrollbar.html">Scrollbar</a></li>
                      <li><a href="ui-stickynote.html">Sticky Note</a></li>
                      <li><a href="ui-timeline.html">Timeline</a></li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="bar-chart-2"></i><span>Charts</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li><a href="chart-apex.html">Apex Charts</a></li>
                      <li><a href="chart-c3.html">Chart C3</a></li>
                      <li><a href="chart-js.html">Chart Js</a></li>
                      <li><a href="chart-morris.html">Morris Charts</a></li>
                      <li><a href="chart-flot.html">Flot Charts</a></li>
                      <li><a href="chart-peity.html">Peity Charts</a></li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="database"></i><span>Icons</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li>
                        <a href="icon-fontawesome.html">Fontawesome Icons</a>
                      </li>
                      <li><a href="icon-feather.html">Feather Icons</a></li>
                      <li><a href="icon-ionic.html">Ionic Icons</a></li>
                      <li><a href="icon-material.html">Material Icons</a></li>
                      <li><a href="icon-pe7.html">Pe7 Icons</a></li>
                      <li>
                        <a href="icon-simpleline.html">Simpleline Icons</a>
                      </li>
                      <li><a href="icon-themify.html">Themify Icons</a></li>
                      <li><a href="icon-weather.html">Weather Icons</a></li>
                      <li><a href="icon-typicon.html">Typicon Icons</a></li>
                      <li><a href="icon-flag.html">Flag Icons</a></li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);">
                      <i data-feather="edit"></i><span>Forms</span
                      ><span class="menu-arrow"></span>
                    </a>
                    <ul>
                      <li class="submenu submenu-two">
                        <a href="javascript:void(0);"
                          >Form Elements<span
                            class="menu-arrow inside-submenu"
                          ></span
                        ></a>
                        <ul>
                          <li>
                            <a href="form-basic-inputs.html">Basic Inputs</a>
                          </li>
                          <li>
                            <a href="form-checkbox-radios.html"
                              >Checkbox & Radios</a
                            >
                          </li>
                          <li>
                            <a href="form-input-groups.html">Input Groups</a>
                          </li>
                          <li>
                            <a href="form-grid-gutters.html">Grid & Gutters</a>
                          </li>
                          <li><a href="form-select.html">Form Select</a></li>
                          <li><a href="form-mask.html">Input Masks</a></li>
                          <li>
                            <a href="form-fileupload.html">File Uploads</a>
                          </li>
                        </ul>
                      </li>
                      <li class="submenu submenu-two">
                        <a href="javascript:void(0);"
                          >Layouts<span class="menu-arrow inside-submenu"></span
                        ></a>
                        <ul>
                          <li>
                            <a href="form-horizontal.html">Horizontal Form</a>
                          </li>
                          <li>
                            <a href="form-vertical.html">Vertical Form</a>
                          </li>
                          <li>
                            <a href="form-floating-labels.html"
                              >Floating Labels</a
                            >
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="form-validation.html">Form Validation</a>
                      </li>
                      <li><a href="form-select2.html">Select2</a></li>
                      <li><a href="form-wizard.html">Form Wizard</a></li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="columns"></i><span>Tables</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li><a href="tables-basic.html">Basic Tables </a></li>
                      <li><a href="data-tables.html">Data Table </a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="submenu-open">
                <h6 class="submenu-hdr">Help</h6>
                <ul>
                  <li>
                    <a href="javascript:void(0);"
                      ><i data-feather="file-text"></i
                      ><span>Documentation</span></a
                    >
                  </li>
                  <li>
                    <a href="javascript:void(0);"
                      ><i data-feather="lock"></i
                      ><span>Changelog v2.0.3</span></a
                    >
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);"
                      ><i data-feather="file-minus"></i><span>Multi Level</span
                      ><span class="menu-arrow"></span
                    ></a>
                    <ul>
                      <li><a href="javascript:void(0);">Level 1.1</a></li>
                      <li class="submenu submenu-two">
                        <a href="javascript:void(0);"
                          >Level 1.2<span
                            class="menu-arrow inside-submenu"
                          ></span
                        ></a>
                        <ul>
                          <li><a href="javascript:void(0);">Level 2.1</a></li>
                          <li class="submenu submenu-two submenu-three">
                            <a href="javascript:void(0);"
                              >Level 2.2<span
                                class="menu-arrow inside-submenu inside-submenu-two"
                              ></span
                            ></a>
                            <ul>
                              <li>
                                <a href="javascript:void(0);">Level 3.1</a>
                              </li>
                              <li>
                                <a href="javascript:void(0);">Level 3.2</a>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /Sidebar -->

      <!-- Sidebar -->
      <div class="sidebar collapsed-sidebar" id="collapsed-sidebar">
        <div class="sidebar-inner slimscroll">
          <div id="sidebar-menu-2" class="sidebar-menu sidebar-menu-three">
            <aside id="aside" class="ui-aside">
              <ul class="tab nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a
                    class="tablinks nav-link"
                    href="#home"
                    id="home-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#home"
                    role="tab"
                    aria-selected="true"
                  >
                    <img src="assets/img/icons/menu-icon.svg" alt="" />
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="tablinks nav-link"
                    href="#messages"
                    id="messages-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#product"
                    role="tab"
                    aria-selected="false"
                  >
                    <img src="assets/img/icons/product.svg" alt="" />
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="tablinks nav-link"
                    href="#profile"
                    id="profile-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#sales"
                    role="tab"
                    aria-selected="false"
                  >
                    <img src="assets/img/icons/sales1.svg" alt="" />
                  </a>
                </li>

                <li class="nav-item" role="presentation">
                  <a
                    class="tablinks nav-link"
                    href="#reports"
                    id="report-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#purchase"
                    role="tab"
                    aria-selected="true"
                  >
                    <img src="assets/img/icons/purchase1.svg" alt="" />
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="tablinks nav-link"
                    href="#set"
                    id="set-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#user"
                    role="tab"
                    aria-selected="true"
                  >
                    <img src="assets/img/icons/users1.svg" alt="" />
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="tablinks nav-link"
                    href="#set2"
                    id="set-tab2"
                    data-bs-toggle="tab"
                    data-bs-target="#employee"
                    role="tab"
                    aria-selected="true"
                  >
                    <img src="assets/img/icons/calendars.svg" alt="" />
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="tablinks nav-link active"
                    href="#set3"
                    id="set-tab3"
                    data-bs-toggle="tab"
                    data-bs-target="#report"
                    role="tab"
                    aria-selected="true"
                  >
                    <img src="assets/img/icons/printer.svg" alt="" />
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="tablinks nav-link"
                    href="#set4"
                    id="set-tab4"
                    data-bs-toggle="tab"
                    data-bs-target="#document"
                    role="tab"
                    aria-selected="true"
                  >
                    <i data-feather="user"></i>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="tablinks nav-link"
                    href="#set5"
                    id="set-tab6"
                    data-bs-toggle="tab"
                    data-bs-target="#permission"
                    role="tab"
                    aria-selected="true"
                  >
                    <i data-feather="file-text"></i>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="tablinks nav-link"
                    href="#set6"
                    id="set-tab5"
                    data-bs-toggle="tab"
                    data-bs-target="#settings"
                    role="tab"
                    aria-selected="true"
                  >
                    <i data-feather="settings"></i>
                  </a>
                </li>
              </ul>
            </aside>
            <div class="tab-content tab-content-four pt-2">
              <ul class="tab-pane" id="home" aria-labelledby="home-tab">
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Dashboard</span> <span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="index.html">Admin Dashboard</a></li>
                    <li><a href="sales-dashboard.html">Sales Dashboard</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Application</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="chat.html">Chat</a></li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        ><span>Call</span
                        ><span class="menu-arrow inside-submenu"></span
                      ></a>
                      <ul>
                        <li><a href="video-call.html">Video Call</a></li>
                        <li><a href="audio-call.html">Audio Call</a></li>
                        <li><a href="call-history.html">Call History</a></li>
                      </ul>
                    </li>
                    <li><a href="calendar.html">Calendar</a></li>
                    <li><a href="email.html">Email</a></li>
                    <li><a href="todo.html">To Do</a></li>
                    <li><a href="notes.html">Notes</a></li>
                    <li><a href="file-manager.html">File Manager</a></li>
                  </ul>
                </li>
              </ul>
              <ul class="tab-pane" id="product" aria-labelledby="messages-tab">
                <li>
                  <a href="product-list.html"><span>Products</span></a>
                </li>
                <li>
                  <a href="add-product.html"><span>Create Product</span></a>
                </li>
                <li>
                  <a href="expired-products.html"
                    ><span>Expired Products</span></a
                  >
                </li>
                <li>
                  <a href="low-stocks.html"><span>Low Stocks</span></a>
                </li>
                <li>
                  <a href="category-list.html"><span>Category</span></a>
                </li>
                <li>
                  <a href="sub-categories.html"><span>Sub Category</span></a>
                </li>
                <li>
                  <a href="brand-list.html"><span>Brands</span></a>
                </li>
                <li>
                  <a href="units.html"><span>Units</span></a>
                </li>
                <li>
                  <a href="varriant-attributes.html"
                    ><span>Variant Attributes</span></a
                  >
                </li>
                <li>
                  <a href="warranty.html"><span>Warranties</span></a>
                </li>
                <li>
                  <a href="barcode.html"><span>Print Barcode</span></a>
                </li>
                <li>
                  <a href="qrcode.html"><span>Print QR Code</span></a>
                </li>
              </ul>
              <ul class="tab-pane" id="sales" aria-labelledby="profile-tab">
                <li>
                  <a href="sales-list.html"><span>Sales</span></a>
                </li>
                <li>
                  <a href="invoice-report.html"><span>Invoices</span></a>
                </li>
                <li>
                  <a href="sales-returns.html"><span>Sales Return</span></a>
                </li>
                <li>
                  <a href="quotation-list.html"><span>Quotation</span></a>
                </li>
                <li>
                  <a href="pos.html"><span>POS</span></a>
                </li>
                <li>
                  <a href="coupons.html"><span>Coupons</span></a>
                </li>
              </ul>
              <ul class="tab-pane" id="purchase" aria-labelledby="report-tab">
                <li>
                  <a href="purchase-list.html"><span>Purchases</span></a>
                </li>
                <li>
                  <a href="purchase-order-report.html"
                    ><span>Purchase Order</span></a
                  >
                </li>
                <li>
                  <a href="purchase-returns.html"
                    ><span>Purchase Return</span></a
                  >
                </li>
                <li>
                  <a href="manage-stocks.html"><span>Manage Stock</span></a>
                </li>
                <li>
                  <a href="stock-adjustment.html"
                    ><span>Stock Adjustment</span></a
                  >
                </li>
                <li>
                  <a href="stock-transfer.html"><span>Stock Transfer</span></a>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Expenses</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="expense-list.html">Expenses</a></li>
                    <li>
                      <a href="expense-category.html">Expense Category</a>
                    </li>
                  </ul>
                </li>
              </ul>
              <ul class="tab-pane" id="user" aria-labelledby="set-tab">
                <li>
                  <a href="customers.html"><span>Customers</span></a>
                </li>
                <li>
                  <a href="suppliers.html"><span>Suppliers</span></a>
                </li>
                <li>
                  <a href="store-list.html"><span>Stores</span></a>
                </li>
                <li>
                  <a href="warehouse.html"><span>Warehouses</span></a>
                </li>
              </ul>
              <ul class="tab-pane" id="employee" aria-labelledby="set-tab2">
                <li>
                  <a href="employees-grid.html"><span>Employees</span></a>
                </li>
                <li>
                  <a href="department-grid.html"><span>Departments</span></a>
                </li>
                <li>
                  <a href="designation.html"><span>Designation</span></a>
                </li>
                <li>
                  <a href="shift.html"><span>Shifts</span></a>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Attendence</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li>
                      <a href="attendance-employee.html">Employee Attendence</a>
                    </li>
                    <li>
                      <a href="attendance-admin.html">Admin Attendence</a>
                    </li>
                  </ul>
                </li>

                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Leaves</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="leaves-admin.html">Admin Leaves</a></li>
                    <li><a href="leaves-employee.html">Employee Leaves</a></li>
                    <li><a href="leave-types.html">Leave Types</a></li>
                  </ul>
                </li>
                <li>
                  <a href="holidays.html"><span>Holidays</span></a>
                </li>
                <li class="submenu">
                  <a href="payroll-list.html"
                    ><span>Payroll</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="payroll-list.html">Employee Salary</a></li>
                    <li><a href="payslip.html">Payslip</a></li>
                  </ul>
                </li>
              </ul>
              <ul
                class="tab-pane active"
                id="report"
                aria-labelledby="set-tab3"
              >
                <li>
                  <a href="sales-report.html"><span>Sales Report</span></a>
                </li>
                <li>
                  <a href="purchase-report.html"
                    ><span>Purchase report</span></a
                  >
                </li>
                <li>
                  <a href="inventory-report.html"
                    ><span>Inventory Report</span></a
                  >
                </li>
                <li>
                  <a href="invoice-report.html"><span>Invoice Report</span></a>
                </li>
                <li>
                  <a href="supplier-report.html"
                    ><span>Supplier Report</span></a
                  >
                </li>
                <li>
                  <a href="customer-report.html"
                    ><span>Customer Report</span></a
                  >
                </li>
                <li>
                  <a href="expense-report.html" class="active"
                    ><span>Expense Report</span></a
                  >
                </li>
                <li>
                  <a href="income-report.html"><span>Income Report</span></a>
                </li>
                <li>
                  <a href="tax-reports.html"><span>Tax Report</span></a>
                </li>
                <li>
                  <a href="profit-and-loss.html"><span>Profit & Loss</span></a>
                </li>
              </ul>
              <ul class="tab-pane" id="permission" aria-labelledby="set-tab4">
                <li>
                  <a href="users.html"><span>Users</span></a>
                </li>
                <li>
                  <a href="roles-permissions.html"
                    ><span>Roles & Permissions</span></a
                  >
                </li>
                <li>
                  <a href="delete-account.html"
                    ><span>Delete Account Request</span></a
                  >
                </li>

                <li class="submenu">
                  <a href="javascript:void(0);">
                    <span>Base UI</span><span class="menu-arrow"></span>
                  </a>
                  <ul>
                    <li><a href="ui-alerts.html">Alerts</a></li>
                    <li><a href="ui-accordion.html">Accordion</a></li>
                    <li><a href="ui-avatar.html">Avatar</a></li>
                    <li><a href="ui-badges.html">Badges</a></li>
                    <li><a href="ui-borders.html">Border</a></li>
                    <li><a href="ui-buttons.html">Buttons</a></li>
                    <li><a href="ui-buttons-group.html">Button Group</a></li>
                    <li><a href="ui-breadcrumb.html">Breadcrumb</a></li>
                    <li><a href="ui-cards.html">Card</a></li>
                    <li><a href="ui-carousel.html">Carousel</a></li>
                    <li><a href="ui-colors.html">Colors</a></li>
                    <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                    <li><a href="ui-grid.html">Grid</a></li>
                    <li><a href="ui-images.html">Images</a></li>
                    <li><a href="ui-lightbox.html">Lightbox</a></li>
                    <li><a href="ui-media.html">Media</a></li>
                    <li><a href="ui-modals.html">Modals</a></li>
                    <li><a href="ui-offcanvas.html">Offcanvas</a></li>
                    <li><a href="ui-pagination.html">Pagination</a></li>
                    <li><a href="ui-popovers.html">Popovers</a></li>
                    <li><a href="ui-progress.html">Progress</a></li>
                    <li><a href="ui-placeholders.html">Placeholders</a></li>
                    <li><a href="ui-rangeslider.html">Range Slider</a></li>
                    <li><a href="ui-spinner.html">Spinner</a></li>
                    <li><a href="ui-sweetalerts.html">Sweet Alerts</a></li>
                    <li><a href="ui-nav-tabs.html">Tabs</a></li>
                    <li><a href="ui-toasts.html">Toasts</a></li>
                    <li><a href="ui-tooltips.html">Tooltips</a></li>
                    <li><a href="ui-typography.html">Typography</a></li>
                    <li><a href="ui-video.html">Video</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);">
                    <span>Advanced UI</span><span class="menu-arrow"></span>
                  </a>
                  <ul>
                    <li><a href="ui-ribbon.html">Ribbon</a></li>
                    <li><a href="ui-clipboard.html">Clipboard</a></li>
                    <li><a href="ui-drag-drop.html">Drag & Drop</a></li>
                    <li><a href="ui-rangeslider.html">Range Slider</a></li>
                    <li><a href="ui-rating.html">Rating</a></li>
                    <li><a href="ui-text-editor.html">Text Editor</a></li>
                    <li><a href="ui-counter.html">Counter</a></li>
                    <li><a href="ui-scrollbar.html">Scrollbar</a></li>
                    <li><a href="ui-stickynote.html">Sticky Note</a></li>
                    <li><a href="ui-timeline.html">Timeline</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Charts</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="chart-apex.html">Apex Charts</a></li>
                    <li><a href="chart-c3.html">Chart C3</a></li>
                    <li><a href="chart-js.html">Chart Js</a></li>
                    <li><a href="chart-morris.html">Morris Charts</a></li>
                    <li><a href="chart-flot.html">Flot Charts</a></li>
                    <li><a href="chart-peity.html">Peity Charts</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Icons</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li>
                      <a href="icon-fontawesome.html">Fontawesome Icons</a>
                    </li>
                    <li><a href="icon-feather.html">Feather Icons</a></li>
                    <li><a href="icon-ionic.html">Ionic Icons</a></li>
                    <li><a href="icon-material.html">Material Icons</a></li>
                    <li><a href="icon-pe7.html">Pe7 Icons</a></li>
                    <li><a href="icon-simpleline.html">Simpleline Icons</a></li>
                    <li><a href="icon-themify.html">Themify Icons</a></li>
                    <li><a href="icon-weather.html">Weather Icons</a></li>
                    <li><a href="icon-typicon.html">Typicon Icons</a></li>
                    <li><a href="icon-flag.html">Flag Icons</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);">
                    <span>Forms</span><span class="menu-arrow"></span>
                  </a>
                  <ul>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >Form Elements<span
                          class="menu-arrow inside-submenu"
                        ></span
                      ></a>
                      <ul>
                        <li>
                          <a href="form-basic-inputs.html">Basic Inputs</a>
                        </li>
                        <li>
                          <a href="form-checkbox-radios.html"
                            >Checkbox & Radios</a
                          >
                        </li>
                        <li>
                          <a href="form-input-groups.html">Input Groups</a>
                        </li>
                        <li>
                          <a href="form-grid-gutters.html">Grid & Gutters</a>
                        </li>
                        <li><a href="form-select.html">Form Select</a></li>
                        <li><a href="form-mask.html">Input Masks</a></li>
                        <li><a href="form-fileupload.html">File Uploads</a></li>
                      </ul>
                    </li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >Layouts<span class="menu-arrow inside-submenu"></span
                      ></a>
                      <ul>
                        <li>
                          <a href="form-horizontal.html">Horizontal Form</a>
                        </li>
                        <li><a href="form-vertical.html">Vertical Form</a></li>
                        <li>
                          <a href="form-floating-labels.html"
                            >Floating Labels</a
                          >
                        </li>
                      </ul>
                    </li>
                    <li><a href="form-validation.html">Form Validation</a></li>
                    <li><a href="form-select2.html">Select2</a></li>
                    <li><a href="form-wizard.html">Form Wizard</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Tables</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="tables-basic.html">Basic Tables </a></li>
                    <li><a href="data-tables.html">Data Table </a></li>
                  </ul>
                </li>
              </ul>
              <ul class="tab-pane" id="document" aria-labelledby="set-tab5">
                <li>
                  <a href="profile.html"><span>Profile</span></a>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Authentication</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >Login<span class="menu-arrow inside-submenu"></span
                      ></a>
                      <ul>
                        <li><a href="signin.html">Cover</a></li>
                        <li><a href="signin-2.html">Illustration</a></li>
                        <li><a href="signin-3.html">Basic</a></li>
                      </ul>
                    </li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >Register<span class="menu-arrow inside-submenu"></span
                      ></a>
                      <ul>
                        <li><a href="register.html">Cover</a></li>
                        <li><a href="register-2.html">Illustration</a></li>
                        <li><a href="register-3.html">Basic</a></li>
                      </ul>
                    </li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >Forgot Password<span
                          class="menu-arrow inside-submenu"
                        ></span
                      ></a>
                      <ul>
                        <li><a href="forgot-password.html">Cover</a></li>
                        <li>
                          <a href="forgot-password-2.html">Illustration</a>
                        </li>
                        <li><a href="forgot-password-3.html">Basic</a></li>
                      </ul>
                    </li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >Reset Password<span
                          class="menu-arrow inside-submenu"
                        ></span
                      ></a>
                      <ul>
                        <li><a href="reset-password.html">Cover</a></li>
                        <li>
                          <a href="reset-password-2.html">Illustration</a>
                        </li>
                        <li><a href="reset-password-3.html">Basic</a></li>
                      </ul>
                    </li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >Email Verification<span
                          class="menu-arrow inside-submenu"
                        ></span
                      ></a>
                      <ul>
                        <li><a href="email-verification.html">Cover</a></li>
                        <li>
                          <a href="email-verification-2.html">Illustration</a>
                        </li>
                        <li><a href="email-verification-3.html">Basic</a></li>
                      </ul>
                    </li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >2 Step Verification<span
                          class="menu-arrow inside-submenu"
                        ></span
                      ></a>
                      <ul>
                        <li><a href="two-step-verification.html">Cover</a></li>
                        <li>
                          <a href="two-step-verification-2.html"
                            >Illustration</a
                          >
                        </li>
                        <li>
                          <a href="two-step-verification-3.html">Basic</a>
                        </li>
                      </ul>
                    </li>
                    <li><a href="lock-screen.html">Lock Screen</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Error Pages</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="error-404.html">404 Error </a></li>
                    <li><a href="error-500.html">500 Error </a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Places</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="countries.html">Countries</a></li>
                    <li><a href="states.html">States</a></li>
                  </ul>
                </li>
                <li>
                  <a href="blank-page.html"><span>Blank Page</span> </a>
                </li>
                <li>
                  <a href="coming-soon.html"><span>Coming Soon</span> </a>
                </li>
                <li>
                  <a href="under-maintenance.html"
                    ><span>Under Maintenance</span>
                  </a>
                </li>
              </ul>
              <ul class="tab-pane" id="settings" aria-labelledby="set-tab6">
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>General Settings</span
                    ><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="general-settings.html">Profile</a></li>
                    <li><a href="security-settings.html">Security</a></li>
                    <li><a href="notification.html">Notifications</a></li>
                    <li><a href="connected-apps.html">Connected Apps</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Website Settings</span
                    ><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="system-settings.html">System Settings</a></li>
                    <li>
                      <a href="company-settings.html">Company Settings </a>
                    </li>
                    <li>
                      <a href="localization-settings.html">Localization</a>
                    </li>
                    <li><a href="prefixes.html">Prefixes</a></li>
                    <li><a href="preference.html">Preference</a></li>
                    <li><a href="appearance.html">Appearance</a></li>
                    <li>
                      <a href="social-authentication.html"
                        >Social Authentication</a
                      >
                    </li>
                    <li><a href="language-settings.html">Language</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>App Settings</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="invoice-settings.html">Invoice</a></li>
                    <li><a href="printer-settings.html">Printer</a></li>
                    <li><a href="pos-settings.html">POS</a></li>
                    <li><a href="custom-fields.html">Custom Fields</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>System Settings</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="email-settings.html">Email</a></li>
                    <li><a href="sms-gateway.html">SMS Gateways</a></li>
                    <li><a href="otp-settings.html">OTP</a></li>
                    <li><a href="gdpr-settings.html">GDPR Cookies</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Financial Settings</span
                    ><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li>
                      <a href="payment-gateway-settings.html"
                        >Payment Gateway</a
                      >
                    </li>
                    <li><a href="bank-settings-grid.html">Bank Accounts</a></li>
                    <li><a href="tax-rates.html">Tax Rates</a></li>
                    <li><a href="currency-settings.html">Currencies</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Other Settings</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="storage-settings.html">Storage</a></li>
                    <li><a href="ban-ip-address.html">Ban IP Address</a></li>
                  </ul>
                </li>
                <li>
                  <a href="javascript:void(0);"><span>Documentation</span></a>
                </li>
                <li>
                  <a href="javascript:void(0);"
                    ><span>Changelog v2.0.3</span></a
                  >
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Multi Level</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="javascript:void(0);">Level 1.1</a></li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >Level 1.2<span class="menu-arrow inside-submenu"></span
                      ></a>
                      <ul>
                        <li><a href="javascript:void(0);">Level 2.1</a></li>
                        <li class="submenu submenu-two submenu-three">
                          <a href="javascript:void(0);"
                            >Level 2.2<span
                              class="menu-arrow inside-submenu inside-submenu-two"
                            ></span
                          ></a>
                          <ul>
                            <li><a href="javascript:void(0);">Level 3.1</a></li>
                            <li><a href="javascript:void(0);">Level 3.2</a></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- /Sidebar -->

      <!-- Sidebar -->
      <div class="sidebar horizontal-sidebar">
        <div id="sidebar-menu-3" class="sidebar-menu">
          <ul class="nav">
            <li class="submenu">
              <a href="index.html"
                ><i data-feather="grid"></i><span> Main Menu</span>
                <span class="menu-arrow"></span
              ></a>
              <ul>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Dashboard</span> <span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="index.html">Admin Dashboard</a></li>
                    <li><a href="sales-dashboard.html">Sales Dashboard</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Application</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="chat.html">Chat</a></li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        ><span>Call</span
                        ><span class="menu-arrow inside-submenu"></span
                      ></a>
                      <ul>
                        <li><a href="video-call.html">Video Call</a></li>
                        <li><a href="audio-call.html">Audio Call</a></li>
                        <li><a href="call-history.html">Call History</a></li>
                      </ul>
                    </li>
                    <li><a href="calendar.html">Calendar</a></li>
                    <li><a href="email.html">Email</a></li>
                    <li><a href="todo.html">To Do</a></li>
                    <li><a href="notes.html">Notes</a></li>
                    <li><a href="file-manager.html">File Manager</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="submenu">
              <a href="javascript:void(0);"
                ><img src="assets/img/icons/product.svg" alt="img" /><span>
                  Inventory
                </span>
                <span class="menu-arrow"></span
              ></a>
              <ul>
                <li>
                  <a href="product-list.html"><span>Products</span></a>
                </li>
                <li>
                  <a href="add-product.html"><span>Create Product</span></a>
                </li>
                <li>
                  <a href="expired-products.html"
                    ><span>Expired Products</span></a
                  >
                </li>
                <li>
                  <a href="low-stocks.html"><span>Low Stocks</span></a>
                </li>
                <li>
                  <a href="category-list.html"><span>Category</span></a>
                </li>
                <li>
                  <a href="sub-categories.html"><span>Sub Category</span></a>
                </li>
                <li>
                  <a href="brand-list.html"><span>Brands</span></a>
                </li>
                <li>
                  <a href="units.html"><span>Units</span></a>
                </li>
                <li>
                  <a href="varriant-attributes.html"
                    ><span>Variant Attributes</span></a
                  >
                </li>
                <li>
                  <a href="warranty.html"><span>Warranties</span></a>
                </li>
                <li>
                  <a href="barcode.html"><span>Print Barcode</span></a>
                </li>
                <li>
                  <a href="qrcode.html"><span>Print QR Code</span></a>
                </li>
              </ul>
            </li>
            <li class="submenu">
              <a href="javascript:void(0);"
                ><img src="assets/img/icons/purchase1.svg" alt="img" /><span
                  >Sales &amp; Purchase</span
                >
                <span class="menu-arrow"></span
              ></a>
              <ul>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Sales</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li>
                      <a href="sales-list.html"><span>Sales</span></a>
                    </li>
                    <li>
                      <a href="invoice-report.html"><span>Invoices</span></a>
                    </li>
                    <li>
                      <a href="sales-returns.html"><span>Sales Return</span></a>
                    </li>
                    <li>
                      <a href="quotation-list.html"><span>Quotation</span></a>
                    </li>
                    <li>
                      <a href="pos.html"><span>POS</span></a>
                    </li>
                    <li>
                      <a href="coupons.html"><span>Coupons</span></a>
                    </li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Purchase</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li>
                      <a href="purchase-list.html"><span>Purchases</span></a>
                    </li>
                    <li>
                      <a href="purchase-order-report.html"
                        ><span>Purchase Order</span></a
                      >
                    </li>
                    <li>
                      <a href="purchase-returns.html"
                        ><span>Purchase Return</span></a
                      >
                    </li>
                    <li>
                      <a href="manage-stocks.html"><span>Manage Stock</span></a>
                    </li>
                    <li>
                      <a href="stock-adjustment.html"
                        ><span>Stock Adjustment</span></a
                      >
                    </li>
                    <li>
                      <a href="stock-transfer.html"
                        ><span>Stock Transfer</span></a
                      >
                    </li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Expenses</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="expense-list.html">Expenses</a></li>
                    <li>
                      <a href="expense-category.html">Expense Category</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="submenu">
              <a href="javascript:void(0);"
                ><img src="assets/img/icons/users1.svg" alt="img" /><span
                  >User Management</span
                >
                <span class="menu-arrow"></span
              ></a>
              <ul>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>People</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li>
                      <a href="customers.html"><span>Customers</span></a>
                    </li>
                    <li>
                      <a href="suppliers.html"><span>Suppliers</span></a>
                    </li>
                    <li>
                      <a href="store-list.html"><span>Stores</span></a>
                    </li>
                    <li>
                      <a href="warehouse.html"><span>Warehouses</span></a>
                    </li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Roles &amp; Permissions</span
                    ><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li>
                      <a href="roles-permissions.html"
                        ><span>Roles & Permissions</span></a
                      >
                    </li>
                    <li>
                      <a href="delete-account.html"
                        ><span>Delete Account Request</span></a
                      >
                    </li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Base UI</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="ui-alerts.html">Alerts</a></li>
                    <li><a href="ui-accordion.html">Accordion</a></li>
                    <li><a href="ui-avatar.html">Avatar</a></li>
                    <li><a href="ui-badges.html">Badges</a></li>
                    <li><a href="ui-borders.html">Border</a></li>
                    <li><a href="ui-buttons.html">Buttons</a></li>
                    <li><a href="ui-buttons-group.html">Button Group</a></li>
                    <li><a href="ui-breadcrumb.html">Breadcrumb</a></li>
                    <li><a href="ui-cards.html">Card</a></li>
                    <li><a href="ui-carousel.html">Carousel</a></li>
                    <li><a href="ui-colors.html">Colors</a></li>
                    <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                    <li><a href="ui-grid.html">Grid</a></li>
                    <li><a href="ui-images.html">Images</a></li>
                    <li><a href="ui-lightbox.html">Lightbox</a></li>
                    <li><a href="ui-media.html">Media</a></li>
                    <li><a href="ui-modals.html">Modals</a></li>
                    <li><a href="ui-offcanvas.html">Offcanvas</a></li>
                    <li><a href="ui-pagination.html">Pagination</a></li>
                    <li><a href="ui-popovers.html">Popovers</a></li>
                    <li><a href="ui-progress.html">Progress</a></li>
                    <li><a href="ui-placeholders.html">Placeholders</a></li>
                    <li><a href="ui-rangeslider.html">Range Slider</a></li>
                    <li><a href="ui-spinner.html">Spinner</a></li>
                    <li><a href="ui-sweetalerts.html">Sweet Alerts</a></li>
                    <li><a href="ui-nav-tabs.html">Tabs</a></li>
                    <li><a href="ui-toasts.html">Toasts</a></li>
                    <li><a href="ui-tooltips.html">Tooltips</a></li>
                    <li><a href="ui-typography.html">Typography</a></li>
                    <li><a href="ui-video.html">Video</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Advanced UI</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="ui-ribbon.html">Ribbon</a></li>
                    <li><a href="ui-clipboard.html">Clipboard</a></li>
                    <li><a href="ui-drag-drop.html">Drag & Drop</a></li>
                    <li><a href="ui-rangeslider.html">Range Slider</a></li>
                    <li><a href="ui-rating.html">Rating</a></li>
                    <li><a href="ui-text-editor.html">Text Editor</a></li>
                    <li><a href="ui-counter.html">Counter</a></li>
                    <li><a href="ui-scrollbar.html">Scrollbar</a></li>
                    <li><a href="ui-stickynote.html">Sticky Note</a></li>
                    <li><a href="ui-timeline.html">Timeline</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Charts</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="chart-apex.html">Apex Charts</a></li>
                    <li><a href="chart-c3.html">Chart C3</a></li>
                    <li><a href="chart-js.html">Chart Js</a></li>
                    <li><a href="chart-morris.html">Morris Charts</a></li>
                    <li><a href="chart-flot.html">Flot Charts</a></li>
                    <li><a href="chart-peity.html">Peity Charts</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Primary Icons</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li>
                      <a href="icon-fontawesome.html">Fontawesome Icons</a>
                    </li>
                    <li><a href="icon-feather.html">Feather Icons</a></li>
                    <li><a href="icon-ionic.html">Ionic Icons</a></li>
                    <li><a href="icon-material.html">Material Icons</a></li>
                    <li><a href="icon-pe7.html">Pe7 Icons</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Secondary Icons</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="icon-simpleline.html">Simpleline Icons</a></li>
                    <li><a href="icon-themify.html">Themify Icons</a></li>
                    <li><a href="icon-weather.html">Weather Icons</a></li>
                    <li><a href="icon-typicon.html">Typicon Icons</a></li>
                    <li><a href="icon-flag.html">Flag Icons</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span> Forms</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        ><span>Form Elements</span
                        ><span class="menu-arrow inside-submenu"></span
                      ></a>
                      <ul>
                        <li>
                          <a href="form-basic-inputs.html">Basic Inputs</a>
                        </li>
                        <li>
                          <a href="form-checkbox-radios.html"
                            >Checkbox & Radios</a
                          >
                        </li>
                        <li>
                          <a href="form-input-groups.html">Input Groups</a>
                        </li>
                        <li>
                          <a href="form-grid-gutters.html">Grid & Gutters</a>
                        </li>
                        <li><a href="form-select.html">Form Select</a></li>
                        <li><a href="form-mask.html">Input Masks</a></li>
                        <li><a href="form-fileupload.html">File Uploads</a></li>
                      </ul>
                    </li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        ><span> Layouts</span
                        ><span class="menu-arrow inside-submenu"></span
                      ></a>
                      <ul>
                        <li>
                          <a href="form-horizontal.html">Horizontal Form</a>
                        </li>
                        <li><a href="form-vertical.html">Vertical Form</a></li>
                        <li>
                          <a href="form-floating-labels.html"
                            >Floating Labels</a
                          >
                        </li>
                      </ul>
                    </li>
                    <li><a href="form-validation.html">Form Validation</a></li>
                    <li><a href="form-select2.html">Select2</a></li>
                    <li><a href="form-wizard.html">Form Wizard</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Tables</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="tables-basic.html">Basic Tables </a></li>
                    <li><a href="data-tables.html">Data Table </a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="submenu">
              <a href="javascript:void(0);"
                ><i data-feather="user"></i><span>Profile</span>
                <span class="menu-arrow"></span
              ></a>
              <ul>
                <li>
                  <a href="profile.html"><span>Profile</span></a>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Authentication</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >Login<span class="menu-arrow inside-submenu"></span
                      ></a>
                      <ul>
                        <li><a href="signin.html">Cover</a></li>
                        <li><a href="signin-2.html">Illustration</a></li>
                        <li><a href="signin-3.html">Basic</a></li>
                      </ul>
                    </li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >Register<span class="menu-arrow inside-submenu"></span
                      ></a>
                      <ul>
                        <li><a href="register.html">Cover</a></li>
                        <li><a href="register-2.html">Illustration</a></li>
                        <li><a href="register-3.html">Basic</a></li>
                      </ul>
                    </li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >Forgot Password<span
                          class="menu-arrow inside-submenu"
                        ></span
                      ></a>
                      <ul>
                        <li><a href="forgot-password.html">Cover</a></li>
                        <li>
                          <a href="forgot-password-2.html">Illustration</a>
                        </li>
                        <li><a href="forgot-password-3.html">Basic</a></li>
                      </ul>
                    </li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >Reset Password<span
                          class="menu-arrow inside-submenu"
                        ></span
                      ></a>
                      <ul>
                        <li><a href="reset-password.html">Cover</a></li>
                        <li>
                          <a href="reset-password-2.html">Illustration</a>
                        </li>
                        <li><a href="reset-password-3.html">Basic</a></li>
                      </ul>
                    </li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >Email Verification<span
                          class="menu-arrow inside-submenu"
                        ></span
                      ></a>
                      <ul>
                        <li><a href="email-verification.html">Cover</a></li>
                        <li>
                          <a href="email-verification-2.html">Illustration</a>
                        </li>
                        <li><a href="email-verification-3.html">Basic</a></li>
                      </ul>
                    </li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >2 Step Verification<span
                          class="menu-arrow inside-submenu"
                        ></span
                      ></a>
                      <ul>
                        <li><a href="two-step-verification.html">Cover</a></li>
                        <li>
                          <a href="two-step-verification-2.html"
                            >Illustration</a
                          >
                        </li>
                        <li>
                          <a href="two-step-verification-3.html">Basic</a>
                        </li>
                      </ul>
                    </li>
                    <li><a href="lock-screen.html">Lock Screen</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Pages</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="error-404.html">404 Error </a></li>
                    <li><a href="error-500.html">500 Error </a></li>
                    <li>
                      <a href="blank-page.html"><span>Blank Page</span> </a>
                    </li>
                    <li>
                      <a href="coming-soon.html"><span>Coming Soon</span> </a>
                    </li>
                    <li>
                      <a href="under-maintenance.html"
                        ><span>Under Maintenance</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Places</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="countries.html">Countries</a></li>
                    <li><a href="states.html">States</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Employees</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li>
                      <a href="employees-grid.html"><span>Employees</span></a>
                    </li>
                    <li>
                      <a href="department-grid.html"
                        ><span>Departments</span></a
                      >
                    </li>
                    <li>
                      <a href="designation.html"><span>Designation</span></a>
                    </li>
                    <li>
                      <a href="shift.html"><span>Shifts</span></a>
                    </li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Attendence</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li>
                      <a href="attendance-employee.html">Employee Attendence</a>
                    </li>
                    <li>
                      <a href="attendance-admin.html">Admin Attendence</a>
                    </li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Leaves &amp; Holidays</span
                    ><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="leaves-admin.html">Admin Leaves</a></li>
                    <li><a href="leaves-employee.html">Employee Leaves</a></li>
                    <li><a href="leave-types.html">Leave Types</a></li>
                    <li>
                      <a href="holidays.html"><span>Holidays</span></a>
                    </li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="payroll-list.html"
                    ><span>Payroll</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="payroll-list.html">Employee Salary</a></li>
                    <li><a href="payslip.html">Payslip</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="submenu">
              <a href="javascript:void(0);" class="active subdrop"
                ><img src="assets/img/icons/printer.svg" alt="img" /><span
                  >Reports</span
                >
                <span class="menu-arrow"></span
              ></a>
              <ul>
                <li>
                  <a href="sales-report.html"><span>Sales Report</span></a>
                </li>
                <li>
                  <a href="purchase-report.html"
                    ><span>Purchase report</span></a
                  >
                </li>
                <li>
                  <a href="inventory-report.html"
                    ><span>Inventory Report</span></a
                  >
                </li>
                <li>
                  <a href="invoice-report.html"><span>Invoice Report</span></a>
                </li>
                <li>
                  <a href="supplier-report.html"
                    ><span>Supplier Report</span></a
                  >
                </li>
                <li>
                  <a href="customer-report.html"
                    ><span>Customer Report</span></a
                  >
                </li>
                <li>
                  <a href="expense-report.html" class="active"
                    ><span>Expense Report</span></a
                  >
                </li>
                <li>
                  <a href="income-report.html"><span>Income Report</span></a>
                </li>
                <li>
                  <a href="tax-reports.html"><span>Tax Report</span></a>
                </li>
                <li>
                  <a href="profit-and-loss.html"><span>Profit & Loss</span></a>
                </li>
              </ul>
            </li>
            <li class="submenu">
              <a href="javascript:void(0);"
                ><img src="assets/img/icons/settings.svg" alt="img" /><span>
                  Settings</span
                >
                <span class="menu-arrow"></span
              ></a>
              <ul>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>General Settings</span
                    ><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="general-settings.html">Profile</a></li>
                    <li><a href="security-settings.html">Security</a></li>
                    <li><a href="notification.html">Notifications</a></li>
                    <li><a href="connected-apps.html">Connected Apps</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Website Settings</span
                    ><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="system-settings.html">System Settings</a></li>
                    <li>
                      <a href="company-settings.html">Company Settings </a>
                    </li>
                    <li>
                      <a href="localization-settings.html">Localization</a>
                    </li>
                    <li><a href="prefixes.html">Prefixes</a></li>
                    <li><a href="preference.html">Preference</a></li>
                    <li><a href="appearance.html">Appearance</a></li>
                    <li>
                      <a href="social-authentication.html"
                        >Social Authentication</a
                      >
                    </li>
                    <li><a href="language-settings.html">Language</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>App Settings</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="invoice-settings.html">Invoice</a></li>
                    <li><a href="printer-settings.html">Printer</a></li>
                    <li><a href="pos-settings.html">POS</a></li>
                    <li><a href="custom-fields.html">Custom Fields</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>System Settings</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="email-settings.html">Email</a></li>
                    <li><a href="sms-gateway.html">SMS Gateways</a></li>
                    <li><a href="otp-settings.html">OTP</a></li>
                    <li><a href="gdpr-settings.html">GDPR Cookies</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Financial Settings</span
                    ><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li>
                      <a href="payment-gateway-settings.html"
                        >Payment Gateway</a
                      >
                    </li>
                    <li><a href="bank-settings-grid.html">Bank Accounts</a></li>
                    <li><a href="tax-rates.html">Tax Rates</a></li>
                    <li><a href="currency-settings.html">Currencies</a></li>
                  </ul>
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Other Settings</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="storage-settings.html">Storage</a></li>
                    <li><a href="ban-ip-address.html">Ban IP Address</a></li>
                  </ul>
                </li>
                <li>
                  <a href="javascript:void(0);"><span>Documentation</span></a>
                </li>
                <li>
                  <a href="javascript:void(0);"
                    ><span>Changelog v2.0.3</span></a
                  >
                </li>
                <li class="submenu">
                  <a href="javascript:void(0);"
                    ><span>Multi Level</span><span class="menu-arrow"></span
                  ></a>
                  <ul>
                    <li><a href="javascript:void(0);">Level 1.1</a></li>
                    <li class="submenu submenu-two">
                      <a href="javascript:void(0);"
                        >Level 1.2<span class="menu-arrow inside-submenu"></span
                      ></a>
                      <ul>
                        <li><a href="javascript:void(0);">Level 2.1</a></li>
                        <li class="submenu submenu-two submenu-three">
                          <a href="javascript:void(0);"
                            >Level 2.2<span
                              class="menu-arrow inside-submenu inside-submenu-two"
                            ></span
                          ></a>
                          <ul>
                            <li><a href="javascript:void(0);">Level 3.1</a></li>
                            <li><a href="javascript:void(0);">Level 3.2</a></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
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
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"
                  ><img src="assets/img/icons/pdf.svg" alt="img"
                /></a>
              </li>
              <li>
                <a
                  data-bs-toggle="tooltip"
                  data-bs-placement="top"
                  title="Excel"
                  ><img src="assets/img/icons/excel.svg" alt="img"
                /></a>
              </li>
              <li>
                <a
                  data-bs-toggle="tooltip"
                  data-bs-placement="top"
                  title="Print"
                  ><i data-feather="printer" class="feather-rotate-ccw"></i
                ></a>
              </li>
              <li>
                <a
                  data-bs-toggle="tooltip"
                  data-bs-placement="top"
                  title="Refresh"
                  ><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i
                ></a>
              </li>
              <li>
                <a
                  data-bs-toggle="tooltip"
                  data-bs-placement="top"
                  title="Collapse"
                  id="collapse-header"
                  ><i data-feather="chevron-up" class="feather-chevron-up"></i
                ></a>
              </li>
            </ul>
          </div>

          <!-- /product list -->
          <div class="card table-list-card">
            <div class="card-body">
              <div class="table-top">
                <div class="search-set">
                  <div class="search-input">
                    <a href="" class="btn btn-searchset"
                      ><i data-feather="search" class="feather-search"></i
                    ></a>
                  </div>
                </div>
                <div class="search-path">
                  <div class="d-flex align-items-center">
                    <a class="btn btn-filter" id="filter_search">
                      <i data-feather="filter" class="filter-icon"></i>
                      <span
                        ><img src="assets/img/icons/closes.svg" alt="img"
                      /></span>
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
              <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                      <div class="input-blocks">
                        <i data-feather="zap" class="info-img"></i>
                        <select class="select">
                          <option>Choose Category</option>
                          <option>Computers</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                      <div class="input-blocks">
                        <i data-feather="user" class="info-img"></i>
                        <select class="select">
                          <option>Created by</option>
                          <option>Complete</option>
                          <option>Inprogress</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                      <div class="input-blocks">
                        <div class="position-relative daterange-wraper">
                          <input
                            type="text"
                            class="form-control"
                            name="datetimes"
                            placeholder="From Date - To Date"
                          />
                          <i
                            data-feather="calendar"
                            class="feather-14 info-img"
                          ></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 ms-auto">
                      <div class="input-blocks">
                        <a class="btn btn-filters ms-auto">
                          <i data-feather="search" class="feather-search"></i>
                          Search
                        </a>
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
                      <td class="userimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img
                            src="assets/img/users/user-01.jpg"
                            alt="product"
                          />
                        </a>
                        <a href="javascript:void(0);">Mitchum Daniel</a>
                      </td>
                      <td>$14,174</td>
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
                      <td class="userimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img
                            src="assets/img/users/user-02.jpg"
                            alt="product"
                          />
                        </a>
                        <a href="javascript:void(0);">Susan Lopez</a>
                      </td>
                      <td>$19,474</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>25 Jan 2024</td>
                      <td>Travel</td>
                      <td class="userimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img
                            src="assets/img/users/user-03.jpg"
                            alt="product"
                          />
                        </a>
                        <a href="javascript:void(0);">Robert Grossman</a>
                      </td>
                      <td>$20,744</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>01 May 2024</td>
                      <td>Purchase</td>
                      <td class="userimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img
                            src="assets/img/users/user-04.jpg"
                            alt="product"
                          />
                        </a>
                        <a href="javascript:void(0);">Russell Belle</a>
                      </td>
                      <td>$25,474</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>14 Oct 2024</td>
                      <td>Printing</td>
                      <td class="userimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img
                            src="assets/img/users/user-05.jpg"
                            alt="product"
                          />
                        </a>
                        <a href="javascript:void(0);">Edward K. Muniz</a>
                      </td>
                      <td>$12,436</td>
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
    <div class="customizer-links" id="setdata">
      <ul class="sticky-sidebar">
        <li class="sidebar-icons">
          <a
            href="#"
            class="navigation-add"
            data-bs-toggle="tooltip"
            data-bs-placement="left"
            data-bs-original-title="Theme"
          >
            <i data-feather="settings" class="feather-five"></i>
          </a>
        </li>
      </ul>
    </div>

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
