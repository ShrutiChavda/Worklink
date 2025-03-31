<?php
include('connection.php');

// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Admin Panel</div>
        </a>
        <hr class="sidebar-divider my-0">

        <!-- Dashboard -->
        <li class="nav-item <?php echo ($current_page == "index.php") ? "active" : ""; ?>">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <hr class="sidebar-divider">

        <!-- User Management -->
        <div class="sidebar-heading">User Management</div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userManagement"
                aria-expanded="<?php echo (in_array($current_page, ['manage_job_seekers.php', 'manage_employers.php', 'manage_officials.php', 'manage_trainers.php'])) ? 'true' : 'false'; ?>">
                <i class="fas fa-users-cog"></i>
                <span>Manage Users</span>
            </a>
            <div id="userManagement"
                class="collapse <?php echo (in_array($current_page, ['manage_job_seekers.php', 'manage_employers.php', 'manage_officials.php', 'manage_trainers.php'])) ? 'show' : ''; ?>">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?php echo ($current_page == 'manage_job_seekers.php') ? 'active' : ''; ?>"
                        href="manage_job_seekers.php">Manage Job Seekers</a>
                    <a class="collapse-item <?php echo ($current_page == 'manage_employers.php') ? 'active' : ''; ?>"
                        href="manage_employers.php">Manage Employers</a>
                    <a class="collapse-item <?php echo ($current_page == 'manage_officials.php') ? 'active' : ''; ?>"
                        href="manage_officials.php">Manage Govt Officials</a>
                    <a class="collapse-item <?php echo ($current_page == 'manage_trainers.php') ? 'active' : ''; ?>"
                        href="manage_trainers.php">Manage Training Providers</a>
                </div>
            </div>
        </li>


        <!-- Job Listings & Verification -->
        <li class="nav-item <?php echo ($current_page == 'job_verification.php') ? 'active' : ''; ?>">
            <a class="nav-link" href="job_verification.php">
                <i class="fas fa-clipboard-check"></i>
                <span>Job Listings & Verification</span></a>
        </li>

        <!-- Training & Education -->
        <li class="nav-item <?php echo ($current_page == 'training_verification.php') ? 'active' : ''; ?>">
            <a class="nav-link" href="training_verification.php">
                <i class="fas fa-book-open"></i>
                <span>Training & Education</span></a>
        </li>

        <!-- System Analytics & Reports -->
        <li class="nav-item <?php echo ($current_page == 'system_reports.php') ? 'active' : ''; ?>">
            <a class="nav-link" href="system_reports.php">
                <i class="fas fa-chart-line"></i>
                <span>System Analytics & Reports</span></a>
        </li>

        <!-- Government Policy Implementation -->
        <li class="nav-item <?php echo ($current_page == 'policy_implementation.php') ? 'active' : ''; ?>">
            <a class="nav-link" href="policy_implementation.php">
                <i class="fas fa-balance-scale"></i>
                <span>Government Policy Implementation</span></a>
        </li>

        <!-- Content Management -->
        <li class="nav-item <?php echo ($current_page == 'content_management.php') ? 'active' : ''; ?>">
            <a class="nav-link" href="content_management.php">
                <i class="fas fa-newspaper"></i>
                <span>Content Management</span></a>
        </li>

        <!-- Security & Access Control -->
        <li class="nav-item <?php echo ($current_page == 'security_settings.php') ? 'active' : ''; ?>">
            <a class="nav-link" href="security_settings.php">
                <i class="fas fa-shield-alt"></i>
                <span>Security & Access Control</span></a>
        </li>

        <!-- Settings & Support -->
        <li class="nav-item <?php echo ($current_page == 'admin_settings.php') ? 'active' : ''; ?>">
            <a class="nav-link" href="admin_settings.php">
                <i class="fas fa-cogs"></i>
                <span>Settings & Support</span></a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->