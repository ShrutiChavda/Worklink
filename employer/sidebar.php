<?php
include('connection.php');
$url = $_SERVER['REQUEST_URI'];
$url = parse_url($url, PHP_URL_PATH);
$arr_url = explode("/", $url);
?>

<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Recruitment Panel</div>
        </a>
        <hr class="sidebar-divider my-0">

        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "index.php") { echo "active"; } ?>">
            <a class="nav-link" href="index.php">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Job Management</div>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "post_job.php") { echo "active"; } ?>">
            <a class="nav-link" href="post_job.php">
                <i class="fas fa-plus-circle"></i>
                <span>Post a Job</span></a>
        </li>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "manage_jobs.php") { echo "active"; } ?>">
            <a class="nav-link" href="manage_jobs.php">
                <i class="fas fa-tasks"></i>
                <span>Manage Job Listings</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Applications</div>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "manage_applications.php") { echo "active"; } ?>">
            <a class="nav-link" href="manage_applications.php">
                <i class="fas fa-users"></i>
                <span>Manage Applications</span></a>
        </li>
      

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Company Profile</div>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "edit_company_info.php") { echo "active"; } ?>">
            <a class="nav-link" href="edit_company_info.php">
                <i class="fas fa-building"></i>
                <span>Edit Company Info</span></a>
        </li>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "upload_company_documents.php") { echo "active"; } ?>">
            <a class="nav-link" href="upload_company_documents.php">
                <i class="fas fa-file-upload"></i>
                <span>Upload Company Documents - JD</span></a>
        </li>

     

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Tools & Support</div>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "wage_calculator.php") { echo "active"; } ?>">
            <a class="nav-link" href="wage_calculator.php">
                <i class="fas fa-calculator"></i>
                <span>Wage Calculation Tools</span></a>
        </li>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "settings.php") { echo "active"; } ?>">
            <a class="nav-link" href="settings.php">
                <i class="fas fa-cogs"></i>
                <span>Settings & Support</span></a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->
