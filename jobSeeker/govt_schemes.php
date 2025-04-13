<?php include('session.php'); ?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='description' content=''>
    <meta name='author' content=''>

    <title>Blank Page</title>

    <link href='img/favicon.png' rel='icon'>
    <link href='vendor/fontawesome-free/css/all.min.css' rel='stylesheet' type='text/css'>
    <link href='css/sb-admin-2.min.css' rel='stylesheet'>
    <link href='vendor/datatables/dataTables.bootstrap4.min.css' rel='stylesheet'>
    <link href='css/sb-admin-2.css' rel='stylesheet'>
    <link href="css/govt-schemes.css" rel="stylesheet">
    <script src='js/jquery-3.6.4.min.js'></script>
    <script src='js/search.js'></script>
</head>

<body id='page-top'>
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

<div class="govt-schemes-wrapper">
    <div class="breadcrumbs">Dashboard / Government Schemes & Policies</div>
    <h1 class="main-heading">Government Schemes & Policies</h1>
    <p class="subtitle">Explore government initiatives to boost your career</p>

    <!-- Hero Section -->
    <div class="hero-banner">
        <div class="hero-content">
            <h2>Pradhan Mantri Kaushal Vikas Yojana (PMKVY)</h2>
            <p>A flagship scheme of the Ministry of Skill Development and Entrepreneurship aimed at enabling Indian youth to take up industry-relevant skill training.</p>
            <button class="apply-btn">Apply Now</button>
            <button class="learn-btn">Learn More</button>
        </div>
    </div>

    <!-- Stats -->
    <div class="scheme-stats">
        <div class="stat-box"><h3>45+</h3><p>Total Schemes</p></div>
        <div class="stat-box"><h3>12K+</h3><p>Active Applications</p></div>
        <div class="stat-box"><h3>5K+</h3><p>Success Stories</p></div>
    </div>

    <!-- Scheme Categories -->
    <h2 class="section-title">Scheme Categories</h2>
    <div class="scheme-categories">
        <!-- Repeat for each -->
        <div class="category-card">
            <h4>Skill Development Programs</h4>
            <p>Enhance your skills with government-backed training programs</p>
            <span>15 Schemes</span>
            <a href="#">Explore →</a>
        </div>
        <!-- Add other categories similarly -->
    </div>

    <!-- Featured Schemes -->
    <h2 class="section-title">Featured Schemes</h2>
    <div class="featured-schemes">
        <div class="featured-card">
            <h4>Pradhan Mantri Kaushal Vikas Yojana (PMKVY)</h4>
            <p><strong>Eligibility:</strong> Age 15–45 | Education: Varies by course</p>
            <p><strong>Benefits:</strong> Free Training, Certification, Placement Support</p>
            <p><strong>Deadline:</strong> Rolling Applications</p>
            <button>Apply Now</button>
            <button class="outline">Learn More</button>
        </div>
        <div class="featured-card">
            <h4>National Apprenticeship Promotion Scheme</h4>
            <p><strong>Eligibility:</strong> Age 14–21 | Education: ITI/Diploma</p>
            <p><strong>Benefits:</strong> Stipend, On-job Training, Industry Experience</p>
            <p><strong>Deadline:</strong> Open Throughout Year</p>
            <button>Apply Now</button>
            <button class="outline">Learn More</button>
        </div>
    </div>

    <!-- Helpful Resources -->
    <h2 class="section-title">Helpful Resources</h2>
    <div class="resources">
        <div class="resource-card">📄 Documentation Guide</div>
        <div class="resource-card">▶️ Video Tutorials</div>
        <div class="resource-card">❓ FAQ Section</div>
    </div>

    <div class="downloads">
        <div class="download-item">📎 Scheme Guidelines 2024 <span>PDF - 2.4 MB</span></div>
        <div class="download-item">📎 Application Process Guide <span>PDF - 2.4 MB</span></div>
        <div class="download-item">📎 Eligibility Criteria Document <span>PDF - 2.4 MB</span></div>
        <div class="download-item">📎 Success Stories & Case Studies <span>PDF - 2.4 MB</span></div>
    </div>

    <!-- Latest Updates -->
    <h2 class="section-title">Latest Updates</h2>
    <div class="latest-updates">
        <p>📌 New skill development scheme launched for IT sector</p>
        <p>📌 Application deadline extended for PMKVY 4.0</p>
        <p>📌 5000+ candidates placed through apprenticeship program</p>
    </div>
</div>


<?php include_once('footer.php'); ?>

<a class='scroll-to-top rounded' href='#page-top'>
    <i class='fas fa-angle-up'></i>
</a>

<div class='modal fade' id='logoutModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>Ready to Leave?</h5>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
            </div>
            <div class='modal-body'>Select 'Logout' below if you are ready to end your current session.</div>
            <div class='modal-footer'>
                <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancel</button>
                <a class='btn btn-success' href='http://localhost/worklink/jobSeeker/logout.php'>Logout</a>
            </div>
        </div>
    </div>
</div>

<script src='vendor/jquery/jquery.min.js'></script>
<script src='vendor/bootstrap/js/bootstrap.bundle.min.js'></script>
<script src='vendor/jquery-easing/jquery.easing.min.js'></script>
<script src='js/sb-admin-2.min.js'></script>
<script src='vendor/datatables/jquery.dataTables.min.js'></script>
<script src='vendor/datatables/dataTables.bootstrap4.min.js'></script>
<script src='js/demo/datatables-demo.js'></script>

</body>
</html>
