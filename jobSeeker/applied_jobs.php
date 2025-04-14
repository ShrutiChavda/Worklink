<?php include('session.php'); ?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <title>Applied Jobs</title>

    <link href='img/favicon.png' rel='icon'>
    <link href='vendor/fontawesome-free/css/all.min.css' rel='stylesheet' type='text/css'>
    <link href='css/sb-admin-2.min.css' rel='stylesheet'>
    <link href='css/applied_jobs.css' rel='stylesheet'>
</head>

<body id='page-top'>
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

<div class='container-fluid applied-jobs-container'>
    <div class='applied-jobs-header'>
        <h2>Applied Jobs</h2>
        <p>Track and manage your job applications</p>
    </div>

    <div class='applied-jobs-filters'>
        <input type='text' class='form-control search-input' placeholder='Search applications'>
        <div class='filter-buttons'>
            <button class='btn btn-light'><i class='fas fa-calendar'></i> Date</button>
            <button class='btn btn-light'><i class='fas fa-filter'></i> Status</button>
            <button class='btn btn-light'><i class='fas fa-sort'></i> Sort by</button>
        </div>
    </div>

    <div class='job-card'>
        <div class='job-info'>
            <img src='img/undraw_rocket.jpg' class='company-logo'>
            <div>
                <h5>TechCorp Solutions</h5>
                <h4>Senior Frontend Developer</h4>
                <p><i class='fas fa-map-marker-alt'></i> New York, USA &nbsp;|&nbsp; <i class='fas fa-briefcase'></i> Full-time</p>
            </div>
        </div>
        <div class='job-status'>
            <span class='badge badge-review'>Under Review</span>
            <p class='applied-date'>Applied on Dec 15, 2023</p>
            <button class='btn btn-outline-primary'>View Details</button>
            <button class='btn btn-link text-danger'>Withdraw Application</button>
        </div>
    </div>

    <div class='job-card'>
        <div class='job-info'>
            <img src='img/undraw_rocket.jpg' class='company-logo'>
            <div>
                <h5>Global Innovations</h5>
                <h4>UX/UI Designer</h4>
                <p><i class='fas fa-map-marker-alt'></i> Remote &nbsp;|&nbsp; <i class='fas fa-briefcase'></i> Contract</p>
            </div>
        </div>
        <div class='job-status'>
            <span class='badge badge-scheduled'>Interview Scheduled</span>
            <p class='applied-date'>Applied on Dec 12, 2023</p>
            <button class='btn btn-outline-primary'>View Details</button>
            <button class='btn btn-link text-danger'>Withdraw Application</button>
        </div>
    </div>

    <div class='job-card'>
        <div class='job-info'>
            <img src='img/undraw_rocket.jpg' class='company-logo'>
            <div>
                <h5>Future Systems</h5>
                <h4>Software Engineer</h4>
                <p><i class='fas fa-map-marker-alt'></i> San Francisco, USA &nbsp;|&nbsp; <i class='fas fa-briefcase'></i> Full-time</p>
            </div>
        </div>
        <div class='job-status'>
            <span class='badge badge-rejected'>Rejected</span>
            <p class='applied-date'>Applied on Dec 10, 2023</p>
            <button class='btn btn-outline-primary'>View Details</button>
            <button class='btn btn-link text-danger'>Withdraw Application</button>
        </div>
    </div>

    <div class='pagination-container'>
        <span>Show 
            <select>
                <option>10</option>
                <option>20</option>
                <option>30</option>
            </select> entries
        </span>
        <ul class='pagination'>
            <li class='page-item active'><a class='page-link' href='#'>1</a></li>
            <li class='page-item'><a class='page-link' href='#'>2</a></li>
            <li class='page-item'><a class='page-link' href='#'>3</a></li>
        </ul>
    </div>
</div>

<?php include('footer.php'); ?>

<a class='scroll-to-top rounded' href='#page-top'>
    <i class='fas fa-angle-up'></i>
</a>

<!-- Logout Modal -->
<div class='modal fade' id='logoutModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title'>Ready to Leave?</h5>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
            </div>
            <div class='modal-body'>Select "Logout" below if you are ready to end your current session.</div>
            <div class='modal-footer'>
                <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancel</button>
                <a class='btn btn-success' href='logout.php'>Logout</a>
            </div>
        </div>
    </div>
</div>

<script src='vendor/jquery/jquery.min.js'></script>
<script src='vendor/bootstrap/js/bootstrap.bundle.min.js'></script>
<script src='vendor/jquery-easing/jquery.easing.min.js'></script>
<script src='js/sb-admin-2.min.js'></script>
</body>

</html>
