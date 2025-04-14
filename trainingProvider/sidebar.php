<?php
include('connection.php');
$url = $_SERVER['REQUEST_URI'];
$url = parse_url($url, PHP_URL_PATH);
$arr_url = explode("/", $url);
?>

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Skill Development Hub</div>
        </a>
        
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        
        <!-- Dashboard -->
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "index.php") { echo "active"; } ?>">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        
        <!-- Divider -->
        <hr class="sidebar-divider">
        
        <!-- Manage Training Programs -->
        <div class="sidebar-heading">Manage Training Programs</div>
        <li class="nav-item <?php if (isset($arr_url[3]) && in_array($arr_url[3], ["add_course.php", "update_course.php", "approve_applicants.php"])) { echo "active"; } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manageTraining"
                aria-expanded="true" aria-controls="manageTraining">
                <i class="fas fa-fw fa-book"></i>
                <span>Training Programs</span>
            </a>
            <div id="manageTraining" class="collapse <?php if (isset($arr_url[3]) && in_array($arr_url[3], ["add_course.php", "update_course.php", "approve_applicants.php"])) { echo "show"; } ?>" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?php if (isset($arr_url[3]) && $arr_url[3] == "add_course.php") { echo "active"; } ?>" href="add_course.php">Add New Course</a>
                    <a class="collapse-item <?php if (isset($arr_url[3]) && $arr_url[3] == "update_course.php") { echo "active"; } ?>" href="update_course.php">Update Course Details</a>
                    <a class="collapse-item <?php if (isset($arr_url[3]) && $arr_url[3] == "approve_applicants.php") { echo "active"; } ?>" href="approve_applicants.php">Approve Applications</a>
                </div>
            </div>
        </li>
        
        <hr class="sidebar-divider">

     <!-- Manage Assessments -->
     <div class="sidebar-heading">Manage Assessments</div>
        <li class="nav-item <?php if (isset($arr_url[3]) && in_array($arr_url[3], ["assessments.php", "update_assessments.php", "edit_assessment.php"])) { echo "active"; } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manageAssessment"
                aria-expanded="true" aria-controls="manageAssessment">
                <i class="fas fa-fw fa-book"></i>
                <span>Assessments</span>
            </a>
            <div id="manageAssessment" class="collapse <?php if (isset($arr_url[3]) && in_array($arr_url[3], ["assessments.php", "update_assessments.php"])) { echo "show"; } ?>" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?php if (isset($arr_url[3]) && $arr_url[3] == "assessments.php") { echo "active"; } ?>" href="assessments.php">Create assessment</a>
                    <a class="collapse-item <?php if (isset($arr_url[3]) && $arr_url[3] == "update_assessments.php") { echo "active"; } ?>" href="update_assessments.php">Manage the assessment</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">

        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "show_progress.php") { echo "active"; } ?>">
            <a class="nav-link" href="show_progress.php">
                <i class="fas fa-running"></i>
                <span>View Progress</span></a>
        </li>

       <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "issued_certificates.php") { echo "active"; } ?>">
            <a class="nav-link" href="issued_certificates.php">
                <i class="fas fa-fw fa-certificate"></i>
                <span>Issued Certificates</span></a>
        </li>
    
        <!-- Training Reports & Analytics -->
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "reports.php") { echo "active"; } ?>">
            <a class="nav-link" href="reports.php">
                <i class="fas fa-fw fa-chart-line"></i>
                <span>Training Reports & Analytics</span></a>
        </li>
        
        <!-- Settings & Support -->
        <li class="nav-item <?php if (isset($arr_url[3]) && $arr_url[3] == "settings.php") { echo "active"; } ?>">
            <a class="nav-link" href="settings.php">
                <i class="fas fa-fw fa-cogs"></i>
                <span>Settings & Support</span></a>
        </li>
        
        <hr class="sidebar-divider d-none d-md-block">
        
        <!-- Sidebar Toggler -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->