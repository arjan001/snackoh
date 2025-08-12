
<?php
include_once "./includes/notifications.php";
?>
    <!-- Header -->
    <div class="header">

<!-- Logo -->
<div class="header-left active">
    <a href="index.php" class="logo logo-normal">
        <!-- <img src="assets/logo1.jpg" alt=""> -->
    </a>
    <a href="index.php" class="logo logo-white">
        <!-- <img src="assets/logo1.jpg" alt=""> -->
    </a>
    <a href="index.php" class="logo-small">
        <!-- <img src="assets/logo1.jpg" alt=""> -->
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
                <!-- <div class="searchinputs dropdown-toggle" id="dropdownMenuClickable"
                    data-bs-toggle="dropdown" data-bs-auto-close="false">
                    <input type="text" placeholder="Search">
                    <div class="search-addon">
                        <span><i data-feather="x-circle" class="feather-14"></i></span>
                    </div>
                </div> -->
                <!-- <div class="dropdown-menu search-dropdown" aria-labelledby="dropdownMenuClickable">
                    <div class="search-info">
                        <h6><span><i data-feather="search" class="feather-16"></i></span>Recent Searches
                        </h6>
                        <ul class="search-tags">
                            <li><a href="javascript:void(0);">Products</a></li>
                            <li><a href="javascript:void(0);">Sales</a></li>
                            <li><a href="javascript:void(0);">Applications</a></li>
                        </ul>
                    </div>
                    <div class="search-info">
                        <h6><span><i data-feather="help-circle" class="feather-16"></i></span>Help</h6>
                        <p>How to Change Product Volume from 0 to 200 on Inventory management</p>
                        <p>Change Product Name</p>
                    </div>
                    <div class="search-info">
                        <h6><span><i data-feather="user" class="feather-16"></i></span>Customers</h6>
                        <ul class="customers">
                            <li>
                                <a href="javascript:void(0);">Aron Varu<img src="assets/img/profiles/avator1.jpg" alt="" class="img-fluid"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Jonita<img src="assets/img/profiles/avatar-01.jpg" alt="" class="img-fluid"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Aaron<img src="assets/img/profiles/avatar-10.jpg" alt="" class="img-fluid"></a>
                            </li>
                        </ul>
                    </div>
                </div> -->
            </form>
        </div>
    </li>
    <!-- /Search -->

    					<!-- Select Store -->
                        <li class="nav-item dropdown has-arrow main-drop select-store-dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle nav-link select-store"
							data-bs-toggle="dropdown">
							<span class="user-info">
								<span class="user-letter">
									<img src="assets/img/store/store-01.png" alt="Store Logo" class="img-fluid">
								</span>
								<span class="user-detail">
									<span class="user-name">Select Store</span>
								</span>
							</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="assets/img/store/store-01.png" alt="Store Logo" class="img-fluid"> Phhysical Store
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="assets/img/store/store-02.png" alt="Store Logo" class="img-fluid"> Online Shop
							</a>
						
						</div>
					</li>
					<!-- /Select Store -->








    <li class="nav-item nav-item-box">
        <a href="javascript:void(0);" id="btnFullscreen">
            <i data-feather="maximize"></i>
        </a>
    </li>
    
					<!-- Notifications -->
					<li class="nav-item dropdown nav-item-box">
						<a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<i data-feather="bell"></i>
							<?php 
							$notification_count = getNotificationCount();
							if ($notification_count > 0): 
							?>
								<span class="badge rounded-pill"><?= $notification_count ?></span>
							<?php endif; ?>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<?php 
									$notifications = getUnreadNotifications();
									if ($notifications && $notifications->num_rows > 0):
										while ($notification = $notifications->fetch_assoc()):
									?>
									<li class="notification-message">
										<a href="javascript:void(0);" onclick="markNotificationAsRead(<?= $notification['id'] ?>)">
											<div class="media d-flex">
												<span class="avatar flex-shrink-0">
													<?php if ($notification['type'] === 'success'): ?>
														<div class="avatar-initial rounded-circle bg-success text-white">
															<i data-feather="check-circle" class="feather-16"></i>
														</div>
													<?php elseif ($notification['type'] === 'error'): ?>
														<div class="avatar-initial rounded-circle bg-danger text-white">
															<i data-feather="alert-triangle" class="feather-16"></i>
														</div>
													<?php elseif ($notification['type'] === 'warning'): ?>
														<div class="avatar-initial rounded-circle bg-warning text-white">
															<i data-feather="alert-circle" class="feather-16"></i>
														</div>
													<?php else: ?>
														<div class="avatar-initial rounded-circle bg-info text-white">
															<i data-feather="info" class="feather-16"></i>
														</div>
													<?php endif; ?>
												</span>
												<div class="media-body flex-grow-1">
													<p class="noti-details">
														<span class="noti-title"><?= htmlspecialchars($notification['title']) ?></span>
														<br>
														<span class="noti-message"><?= htmlspecialchars($notification['message']) ?></span>
													</p>
													<p class="noti-time">
														<span class="notification-time"><?= formatNotificationTime($notification['created_at']) ?></span>
													</p>
												</div>
											</div>
										</a>
									</li>
									<?php 
										endwhile;
									else:
									?>
									<li class="notification-message">
										<div class="media d-flex">
											<div class="media-body flex-grow-1 text-center py-3">
												<p class="text-muted mb-0">No new notifications</p>
											</div>
										</div>
									</li>
									<?php endif; ?>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="activities.php">View all Notifications</a>
							</div>
						</div>
					</li>
					<!-- /Notifications -->


    <li class="nav-item nav-item-box">
        <a href="general-settings.php"><i data-feather="settings"></i></a>
    </li>

    <?php 
    // Retrieve user data from session
$full_name = $_SESSION['full_name'] ?? 'Guest User';
$role = $_SESSION['user_role'] ?? 'Guest';
?>

<li class="nav-item dropdown has-arrow main-drop">
    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
        <span class="user-info">
            <span class="user-detail">
                <span class="user-name"><?= htmlspecialchars($full_name); ?></span>
                <span class="user-role"><?= htmlspecialchars($role); ?></span>
            </span>
        </span>
    </a>
    <div class="dropdown-menu menu-drop-user">
        <div class="profilename">
            <div class="profileset">
                <div class="profilesets">
                    <h6><?= htmlspecialchars($full_name); ?></h6>
                    <h5><?= htmlspecialchars($role); ?></h5>
                </div>
            </div>
            <hr class="m-0">
            <a class="dropdown-item" href="profile.php?id=<?php echo $_SESSION['user_id']; ?>"> 
    <i class="me-2" data-feather="user"></i> My Profile
</a>

            <a class="dropdown-item" href="general-settings.php"><i class="me-2" data-feather="settings"></i> Settings</a>
            <hr class="m-0">
            <a class="dropdown-item logout pb-0" href="logout.php">
                <img src="assets/img/icons/log-out.svg" class="me-2" alt="Logout Icon"> Logout
            </a>
        </div>
    </div>
</li>

</ul>
<!-- /Header Menu -->

<!-- Mobile Menu -->
<div class="dropdown mobile-user-menu">
    <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
    <div class="dropdown-menu dropdown-menu-right">
    <a class="dropdown-item" href="profile.php?id=<?php echo $_SESSION['user_id']; ?>"> 
    <i class="me-2" data-feather="user"></i> My Profile
</a>

        <a class="dropdown-item" href="general-settings.php">Settings</a>
        <a class="dropdown-item" href="logout.php">Logout</a>
    </div>
</div>
<!-- /Mobile Menu -->
</div>
<!-- /Header -->