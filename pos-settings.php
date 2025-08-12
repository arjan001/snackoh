<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php";?>
    <body>
		
		<div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div>

		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
			<?php include "includes/navbar.php";?>
			<!-- /Header -->
			
			<!-- Sidebar -->
			<?php include "includes/sidebar.php";?>
			<!-- /Sidebar -->



			<div class="page-wrapper">
				<div class="content settings-content">
					<div class="page-header settings-pg-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>Settings</h4>
								<h6>Manage your settings on portal</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-xl-12">
							 <div class="settings-wrapper d-flex">
								<div class="sidebars settings-sidebar theiaStickySidebar" id="sidebar2">
									<div class="sidebar-inner slimscroll">
										<div id="sidebar-menu5" class="sidebar-menu">
											<ul>
												<li class="submenu-open">
													<ul>
														<li class="submenu">
															<a href="javascript:void(0);"><i data-feather="settings"></i><span>General Settings</span><span class="menu-arrow"></span></a>
															<ul>
																<li><a href="general-settings.html">Profile</a></li>
																<li><a href="security-settings.html">Security</a></li>
																<li><a href="notification.html">Notifications</a></li>
																<li><a href="connected-apps.html">Connected Apps</a></li>
															</ul>
														</li>
														<li class="submenu">
															<a href="javascript:void(0);"><i data-feather="airplay"></i><span>Website Settings</span><span class="menu-arrow"></span></a>
															<ul>
																<li><a href="system-settings.html">System Settings</a></li>
																<li><a href="company-settings.html">Company Settings </a></li>
																<li><a href="localization-settings.html">Localization</a></li>
																<li><a href="prefixes.html">Prefixes</a></li>
																<li><a href="preference.html">Preference</a></li>
																<li><a href="appearance.html">Appearance</a></li>
																<li><a href="social-authentication.html">Social Authentication</a></li>
																<li><a href="language-settings.html">Language</a></li>
															</ul>
														</li>
														<li class="submenu">
															<a href="javascript:void(0);" class="active subdrop"><i data-feather="archive"></i><span>App Settings</span><span class="menu-arrow"></span></a>
															<ul>
																<li><a href="invoice-settings.html">Invoice</a></li>
																<li><a href="printer-settings.html">Printer </a></li>
																<li><a href="pos-settings.html" class="active">POS</a></li>
																<li><a href="custom-fields.html">Custom Fields</a></li>
															</ul>
														</li>
														<li class="submenu">
															<a href="javascript:void(0);"><i data-feather="server"></i><span>System Settings</span><span class="menu-arrow"></span></a>
															<ul>
																<li><a href="email-settings.html">Email</a></li>
																<li><a href="sms-gateway.html">SMS Gateways</a></li>
																<li><a href="otp-settings.html">OTP</a></li>
																<li><a href="gdpr-settings.html">GDPR Cookies</a></li>
															</ul>
														</li>
														<li class="submenu">
															<a href="javascript:void(0);"><i data-feather="credit-card"></i><span>Financial Settings</span><span class="menu-arrow"></span></a>
															<ul>
																<li><a href="payment-gateway-settings.html">Payment Gateway</a></li>
																<li><a href="bank-settings-grid.html">Bank Accounts </a></li>
																<li><a href="tax-rates.html">Tax Rates</a></li>
																<li><a href="currency-settings.html">Currencies</a></li>
															</ul>
														</li>
														<li class="submenu">
															<a href="javascript:void(0);"><i data-feather="layout"></i><span>Other Settings</span><span class="menu-arrow"></span></a>
															<ul>
																<li><a href="storage-settings.html">Storage</a></li>
																<li><a href="ban-ip-address.html">Ban IP Address </a></li>
															</ul>
														</li>
													</ul>								
												</li>
												
											</ul>
										</div>
									</div>
								</div>
								<div class="settings-page-wrap">
									<form action="pos-settings.html">
										<div class="setting-title">
											<h4>POS Settings</h4>
										</div>
										<div class="company-info border-0">
											<div class="localization-info">
												<div class="row align-items-center mb-sm-4">
													<div class="col-sm-4">
														<div class="setting-info">
															<h6>POS Printer</h6>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="localization-select">
															<select class="select">
																<option>A4</option>
																<option>A4</option>
																<option>A4</option>
															</select>
														</div>
													</div>
												</div>	
												<div class="row align-items-center mb-sm-4">
													<div class="col-sm-4">
														<div class="setting-info">
															<h6>Payment Method</h6>
														</div>
													</div>
													<div class="col-sm-8">
														<div class="localization-select pos-payment-method d-flex align-items-center mb-0 w-100">
															<div class="custom-control custom-checkbox">
																<label class="checkboxs mb-0 pb-0 line-height-1">
																	<input type="checkbox">
																	<span class="checkmarks"></span>COD
																</label>
															</div>
															<div class="custom-control custom-checkbox">
																<label class="checkboxs mb-0 pb-0 line-height-1">
																	<input type="checkbox">
																	<span class="checkmarks"></span>Cheque
																</label>
															</div>
															<div class="custom-control custom-checkbox">
																<label class="checkboxs mb-0 pb-0 line-height-1">
																	<input type="checkbox">
																	<span class="checkmarks"></span>Card
																</label>
															</div>
															<div class="custom-control custom-checkbox">
																<label class="checkboxs mb-0 pb-0 line-height-1">
																	<input type="checkbox">
																	<span class="checkmarks"></span>Paypal
																</label>
															</div>
															<div class="custom-control custom-checkbox">
																<label class="checkboxs mb-0 pb-0 line-height-1">
																	<input type="checkbox">
																	<span class="checkmarks"></span>Bank Transfer
																</label>
															</div>
															<div class="custom-control custom-checkbox">
																<label class="checkboxs mb-0 pb-0 line-height-1">
																	<input type="checkbox">
																	<span class="checkmarks"></span>Cash
																</label>
															</div>
														</div>
													</div>
												</div>	
												<div class="row align-items-center">
													<div class="col-sm-4">
														<div class="setting-info">
															<h6>Enable Sound Effect </h6>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="localization-select d-flex align-items-center">
															<div class="status-toggle modal-status d-flex justify-content-between align-items-center me-3">
																<input type="checkbox" id="user4" class="check" checked>
																<label for="user4" class="checktoggle"></label>
															</div>
														</div>
													</div>
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

		<!-- Summernote JS -->
		<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>

		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>

		<!-- Sticky-sidebar -->
		<script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
		<script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

		<!-- Sweetalert 2 -->
		<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
		<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

		<!-- Custom JS --><script src="assets/js/theme-script.js"></script>	
		<script src="assets/js/script.js"></script>

	
    </body>
</html>