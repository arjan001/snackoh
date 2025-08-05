		<!-- Sidebar -->
		<div class="sidebar" id="sidebar">
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
						<li class="submenu-open">
							<h6 class="submenu-hdr">Main</h6>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);" class="subdrop active"><i data-feather="grid"></i><span>Dashboard</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="index.php" class="active">Admin Dashboard</a></li>
										<li><a href="sales-dashboard.php">Sales Dashboard</a></li>
                                        <li><a href="pos.php"><i data-feather="hard-drive"></i><span>POS</span></a></li>
									</ul>
								</li>


							</ul>
						</li>

						<li class="submenu-open">
							<h6 class="submenu-hdr">Sales</h6>
							<ul>
								<li><a href="sales-list.php"><i data-feather="shopping-cart"></i><span>Sales</span></a></li>
								<!-- <li><a href="invoice-report.php"><i data-feather="file-text"></i><span>Invoices</span></a></li> -->
								<li><a href="sales-returns.php"><i data-feather="copy"></i><span>Sales Return</span></a></li>
								<li><a href="deliveries.php"><i data-feather="truck"></i><span>Dispatch Delivery</span></a></li>
								
								<li><a href="quotation-list.php"><i data-feather="save"></i><span>Quotation</span></a></li>
								<li><a href="pos.php"><i data-feather="hard-drive"></i><span>POS</span></a></li>
								<li><a href="pos_sessions.php"><i data-feather="clock"></i><span>POS Sessions</span></a></li>
							</ul>
						</li>
						
						<li class="submenu-open">
							<h6 class="submenu-hdr">Bakery Products Inventory</h6>
							<ul>
								
							
								<li><a href="product-list.php"><i data-feather="box"></i><span>Products</span></a></li>
								<li><a href="add-product.php"><i data-feather="plus-square"></i><span>Create Product</span></a></li>
								<li><a href="recipe.php"><i data-feather="plus-square"></i><span>Recipes</span></a></li>
								<li><a href="ingredient_usage_tracking.php"><i data-feather="activity"></i><span>BOM Tracking</span></a></li>
								<!-- <li><a href="expired-products.php"><i data-feather="codesandbox"></i><span>Expired Products</span></a></li> -->

								<li><a href="damaged-goods.php"><i data-feather="codesandbox"></i><span>Damaged Goods</span></a></li>

								<li><a href="unsold-goods.php"><i data-feather="layers"></i><span>Unsold Goods</span></a></li>

								<!-- <li><a href="low-stocks.php"><i data-feather="shuffle"></i><span>Low Inventory Products</span></a></li> -->
								<li><a href="product-category.php"><i data-feather="codepen"></i><span>Product Category</span></a></li>
								
								
								<li><a href="units.php"><i data-feather="speaker"></i><span>Units</span></a></li>
		
							</ul>
						</li>
						<li class="submenu-open">
							<h6 class="submenu-hdr">Stock /Inventory Management</h6>
							<ul>
								<li><a href="manage-stocks.php"><i data-feather="package"></i><span>Manage Stock</span></a></li>

								<li><a href="stocks-category.php"><i data-feather="shopping-bag"></i><span>Stock Category</span></a></li>

								<li><a href="stock-ordering.php"><i data-feather="clipboard"></i><span>Stock ordering</span></a></li>

								<!-- <li><a href="#"><i data-feather="truck"></i><span>Stock Transfer</span></a></li> -->
								<li><a href="low-stocks.php"><i data-feather="shuffle"></i><span>Low Inventory Products</span></a></li>
							</ul>
						</li>
						<li class="submenu-open">
							<h6 class="submenu-hdr" data-bs-toggle="tooltip" data-bs-placement="right" title="request ingridient usage Stats if your Employees may need it ">PRODUCTION</h6>
							<ul>
								<li><a href="new_production.php"><i data-feather="package"></i><span> 📌 New Production Batch</span></a></li>

								<li><a href="batch_history.php"><i data-feather="shopping-bag"></i><span>📜Batch History</span></a></li>

								<li><a href="schedule_production.php
								"><i data-feather="clipboard"></i><span>Production Schedule</span></a></li>

								<!-- <li><a href="ingridient_usage.php"><i data-feather="clipboard"></i><span>📦 Ingredient Usage</span></a></li> -->

								<li><a href="waste_manage.php"><i data-feather="clipboard"></i><span>🗑️ Waste Management</span></a></li>
								<li><a href="#"  data-bs-toggle="tooltip" data-bs-placement="right" title="production reports will be dynamic and populate here once the system is being used.."></i><span>📊 Production Reports</span></a></li>
								<!-- production_reports.php -->

								<!-- <li><a href="#"><i data-feather="truck"></i><span>Stock Transfer</span></a></li> -->
							</ul>
						</li>
					

						<li class="submenu-open">
							<h6 class="submenu-hdr">Purchases</h6>
							<ul>
								<li><a href="purchase-list.php"><i data-feather="shopping-bag"></i><span>Purchases</span></a></li>
								<li><a href="purchase-order-report.php"><i data-feather="file-minus"></i><span>Purchase Order</span></a></li>
								<li><a href="purchase-returns.php"><i data-feather="refresh-cw"></i><span>Purchase Return</span></a></li>
							</ul>
						</li>
						<li class="submenu-open">
							<h6 class="submenu-hdr">Finance & Accounts</h6>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);"><i data-feather="file-text"></i><span>Expenses</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="expense-list.php">Expenses</a></li>
										<li><a href="expense-category.php">Expense Category</a></li>
									</ul>
								</li>
							</ul>
						</li>

						<li class="submenu-open">
							<h6 class="submenu-hdr">ALL APPROVALS</h6>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);" ><i data-feather="file-text"></i><span>Approvals</span><span class="menu-arrow" data-bs-placement="right" title="When we have an Approval this menu will be active  and have a notification icon  "></span></a>
									<ul>
										<!-- <li><a href="expense-list.php">Approvals</a></li>
										<li><a href="expense-category.php">Expense Category</a></li> -->
									</ul>
								</li>
							</ul>
						</li>
						<li class="submenu-open">
							<h6 class="submenu-hdr">Peoples</h6>
							<ul>
								<li><a href="customers.php"><i data-feather="user"></i><span>Customers</span></a></li>
								<li><a href="suppliers.php"><i data-feather="users"></i><span>Suppliers</span></a></li>
								<li><a href="debtors.php"><i data-feather="users"></i><span>Debtors</span></a></li>
								<li><a href="creditors.php"><i data-feather="users"></i><span>Creditors</span></a></li>
								<li><a href="creditor-debtor-Payment-Trigger.php"><i data-feather="users"></i><span>PayMent Triggers</span></a></li>
								
								</li>
							</ul>
						</li>
						<li class="submenu-open">
							<h6 class="submenu-hdr">Property</h6>
							<ul>
								<li><a href="assets.php"><i data-feather="box"></i><span>Assets</span></a></li>
								<li><a href="assets-category.php"><i data-feather="file-text"></i><span>Asset Category</span></a></li>
								<li><a href="assets-trigger.php"><i data-feather="speaker"></i><span>Asset Triggers</span> </a></li>

								
										<!-- <span><i data-feather="bell" class="feather-user"></i><?php echo $totalEmployees; ?></span> show alll alerts here from policies-->
									

								<li><a href="Replacement-policy.php"><i data-feather="codesandbox"></i><span>Replacement Policy</span></a></li>

								<li><a href="capacity-manage.php"><i data-feather="box"></i><span>Capacity Management</span></a></li>

								<li><a href="fleet-manage.php"><i data-feather="truck"></i><span>Fleet Management</span></a></li>
								
								</li>
							</ul>
						</li>
						<li class="submenu-open">
							<h6 class="submenu-hdr">HRM</h6>
							<ul>
								<li><a href="employees.php"><i data-feather="user"></i><span>Employees</span></a></li>
								<li><a href="department.php"><i data-feather="users"></i><span>Departments</span></a></li>
								<li><a href="designation.php"><i data-feather="git-merge"></i><span>Designation</span></a></li>
								<li><a href="#"><i data-feather="shuffle"></i><span>Shifts</span></a></li>
						
								</li>
								<li class="submenu">
    <a href="payroll-list.html" data-bs-toggle="tooltip" data-bs-placement="right" title="Request module from developer">
        <i data-feather="dollar-sign"></i><span>Payroll</span><span class="menu-arrow"></span>
    </a>
    <ul>
        <!-- <li><a href="payroll-list.php">Employee Salary</a></li>
        <li><a href="payslip.php">Payslip</a></li> -->
    </ul>
</li>



							</ul>
						</li>
						<li class="submenu-open">
							<h6 class="submenu-hdr"  data-bs-toggle="tooltip" data-bs-placement="right" title="Reports will auto generate when system is in use">Reports </h6>
							<ul>
								<li><a href="sales-report.php"><i data-feather="bar-chart-2"></i><span>Sales Report</span></a></li>
								<li><a href="purchase-report.php"><i data-feather="pie-chart"></i><span>Purchase report</span></a></li>
								<li><a href="inventory-report.php"><i data-feather="inbox"></i><span>Inventory Report</span></a></li>
								<li><a href="invoice-report.php"><i data-feather="file"></i><span>Invoice Report</span></a></li>
								<li><a href="supplier-report.php"><i data-feather="user-check"></i><span>Supplier Report</span></a></li>
								<li><a href="customer-report.php"><i data-feather="user"></i><span>Customer Report</span></a></li>
								<li><a href="expense-report.php"><i data-feather="file"></i><span>Expense Report</span></a></li>
								<li><a href="income-report.php"><i data-feather="bar-chart"></i><span>Income Report</span></a></li>
								<li><a href="tax-reports.php"><i data-feather="database"></i><span>Tax Report</span></a></li>
								<li><a href="profit-and-loss.php"><i data-feather="pie-chart"></i><span>Profit & Loss</span></a></li>
								<li><a href="balance-sheet.php"><i data-feather="book-open"></i><span>Balance Sheet</span></a></li>
							</ul>
						</li>
						<li class="submenu-open">
							<h6 class="submenu-hdr">User Management</h6>
							<ul>
								<li><a href="users.php"><i data-feather="user-check"></i><span>Users</span></a></li>
								<li><a href="roles_permissions.php"><i data-feather="shield"></i><span>Roles & Permissions</span></a></li>
								
							</ul>
						</li>

						<li class="submenu-open">
							<h6 class="submenu-hdr">Settings</h6>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);"><i data-feather="settings"></i><span>General Settings</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="general-settings.php">SETTINGS</a></li>
										
									</ul>
								</li>
							
								
							</ul>
						</li>
						<li class="submenu-open">
							<h6 class="submenu-hdr">UI Interface</h6>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i data-feather="layers"></i><span>Base UI</span><span class="menu-arrow"></span>
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
										<i data-feather="layers"></i><span>Advanced UI</span><span class="menu-arrow"></span>
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
									<a href="javascript:void(0);"><i data-feather="bar-chart-2"></i>
										<span>Charts</span><span class="menu-arrow"></span>
									</a>
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
									<a href="javascript:void(0);"><i data-feather="database"></i>
										<span>Icons</span><span class="menu-arrow"></span>
									</a>
									<ul>
										<li><a href="icon-fontawesome.html">Fontawesome Icons</a></li>
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
										<i data-feather="edit"></i><span>Forms</span><span class="menu-arrow"></span>
									</a>
									<ul>
										<li class="submenu submenu-two">
											<a href="javascript:void(0);">Form Elements<span class="menu-arrow inside-submenu"></span></a>
											<ul>
												<li><a href="form-basic-inputs.html">Basic Inputs</a></li>
												<li><a href="form-checkbox-radios.html">Checkbox & Radios</a></li>
												<li><a href="form-input-groups.html">Input Groups</a></li>
												<li><a href="form-grid-gutters.html">Grid & Gutters</a></li>
												<li><a href="form-select.html">Form Select</a></li>
												<li><a href="form-mask.html">Input Masks</a></li>
												<li><a href="form-fileupload.html">File Uploads</a></li>
											</ul>
										</li>
										<li class="submenu submenu-two">
											<a href="javascript:void(0);">Layouts<span class="menu-arrow inside-submenu"></span></a>
											<ul>
												<li><a href="form-horizontal.html">Horizontal Form</a></li>
												<li><a href="form-vertical.html">Vertical Form</a></li>
												<li><a href="form-floating-labels.html">Floating Labels</a></li>
											</ul>
										</li>
										<li><a href="form-validation.html">Form Validation</a></li>
										<li><a href="form-select2.html">Select2</a></li>
										<li><a href="form-wizard.html">Form Wizard</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"><i data-feather="columns"></i><span>Tables</span><span
											class="menu-arrow"></span></a>
									<ul>
										<li><a href="tables-basic.html">Basic Tables </a></li>
										<li><a href="data-tables.html">Data Table </a></li>
									</ul>
								</li>
							</ul>

						</li>
					
					</ul>
				</div>
			</div>
		</div>
		<!-- /Sidebar -->