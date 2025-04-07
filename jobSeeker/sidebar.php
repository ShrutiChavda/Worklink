<?php
include('connection.php');
$url = $_SERVER['REQUEST_URI'];
// echo $url;
$url = parse_url($url, PHP_URL_PATH);
$arr_url = explode("/", $url);
// echo $arr_url[3];

?>

<div id="wrapper">


    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon">
                <i class="fas fa-user"></i>
            </div>
            <div class="sidebar-brand-text mx-3">My Career Hub</div>
        </a>
        <hr class="sidebar-divider my-0">

        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "index.php") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="index.php">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Job Search</div>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "browse_jobs.php") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="browse_jobs.php">
                <i class="fas fa-search"></i>
                <span>Browse Jobs</span></a>
        </li>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "job_alerts.php") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="job_alerts.php">
                <i class="fas fa-bell"></i>
                <span>Job Alerts</span></a>
        </li>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "saved_jobs.php") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="saved_jobs.php">
                <i class="fas fa-bookmark"></i>
                <span>Saved Jobs</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">My Applications</div>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "applied_jobs.php") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="applied_jobs.php">
                <i class="fas fa-file-alt"></i>
                <span>Applied Jobs</span></a>
        </li>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "application_status.php") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="application_status.php">
                <i class="fas fa-tasks"></i>
                <span>Application Status</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Profile Management</div>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "upload_resume.php") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="upload_resume.php">
                <i class="fas fa-upload"></i>
                <span>Upload/Update Resume</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Resources</div>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "govt_schemes.php") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="govt_schemes.php">
                <i class="fas fa-university"></i>
                <span>Government Schemes</span></a>
        </li>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "interview_training.php") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="interview_training.php">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Interview & Skill Training</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Communication</div>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "notifications.php") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="notifications.php">
                <i class="fas fa-envelope"></i>
                <span>Notifications</span></a>
        </li>
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "settings.php") {
                                echo "active";
                            } ?>">
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