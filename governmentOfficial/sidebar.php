<?php
include('connection.php');
$url = $_SERVER['REQUEST_URI'];
// echo $url;
$url = parse_url($url, PHP_URL_PATH);
$arr_url = explode("/", $url);
// echo $arr_url[3];

?>

<div id="wrapper">

    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon">
                <i class="fas fa-gavel"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Labour & Employment Panel</div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "index.php") { echo "active"; } ?>">
            <a class="nav-link" href="index.php">
                <i class="fas fa-chart-line"></i>
                <span>Employment Reports</span></a>
        </li>

        <hr class="sidebar-divider">

        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "manage_job_listings.php") { echo "active"; } ?>">
            <a class="nav-link" href="manage_job_listings.php">
                <i class="fas fa-tasks"></i>
                <span>Approve/Reject Job Posts</span></a>
        </li>

        <li
            class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "approve_training.php") { echo "active"; } ?>">
            <a class="nav-link" href="approve_training.php">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Approve Training Programs</span></a>
        </li>

        <li
            class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "worker_complaints.php") { echo "active"; } ?>">
            <a class="nav-link" href="worker_complaints.php">
                <i class="fas fa-user-shield"></i>
                <span>Worker Complaints</span></a>
        </li>

        <li
            class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "employment_reports.php") { echo "active"; } ?>">
            <a class="nav-link" href="employment_reports.php">
                <i class="fas fa-chart-pie"></i>
                <span>Employment Rate</span></a>
        </li>

        <hr class="sidebar-divider">

        <li
            class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "policy_implementation.php") { echo "active"; } ?>">
            <a class="nav-link" href="policy_implementation.php">
                <i class="fas fa-balance-scale"></i>
                <span>Policy Implementation</span></a>
        </li>

        <li
            class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "grant_distribution.php") { echo "active"; } ?>">
            <a class="nav-link" href="grant_distribution.php">
                <i class="fas fa-hand-holding-usd"></i>
                <span>Grant Distribution</span></a>
        </li>

        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "track_wage_laws.php") { echo "active"; } ?>">
            <a class="nav-link" href="track_wage_laws.php">
                <i class="fas fa-coins"></i>
                <span>Minimum Wage Compliance</span></a>
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
