<?php include('session.php'); ?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='description' content=''>
    <meta name='author' content=''>

    <title>Job Alerts</title>

    <link href='img/favicon.png' rel='icon'>
    <link href='vendor/fontawesome-free/css/all.min.css' rel='stylesheet' type='text/css'>
    <link href='css/sb-admin-2.min.css' rel='stylesheet'>
    <link href='vendor/datatables/dataTables.bootstrap4.min.css' rel='stylesheet'>
    <link href='css/sb-admin-2.css' rel='stylesheet'>
    <script src='js/jquery-3.6.4.min.js'></script>
    <script src='js/search.js'></script>
</head>

<body id='page-top'>
    <?php include('sidebar.php'); ?>
    <?php include('header.php'); ?>

    <div class='container-fluid'>
        <div class='job-alerts-header d-flex justify-content-between align-items-center mb-4'>
            <div>
                <h1 class='h3 text-gray-800'>Job Alerts</h1>
                <p class="text-muted mb-0">Stay updated with latest job opportunities</p>
            </div>
            <div class="form-inline">
                <label for="sort" class="mr-2">Sort by:</label>
                <select id="sort" class="form-control">
                    <option>Latest</option>
                    <option>Oldest</option>
                    <option>Closing Soon</option>
                </select>
            </div>
        </div>

        <!-- Job Cards -->
        <div class="job-card border rounded p-4 mb-4 shadow-sm">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="font-weight-bold mb-1">Senior Frontend Developer</h5>
                    <p class="text-muted mb-1"><i class="fas fa-building mr-1"></i> Tech Solutions Inc. &nbsp; <i class="fas fa-map-marker-alt"></i> New York, NY</p>
                    <p class="mb-2"><i class="far fa-clock mr-1"></i> 5–7 years &nbsp; <i class="fas fa-envelope mr-1"></i> $120,000 – $150,000 &nbsp; <i class="far fa-calendar-alt mr-1"></i> <span class="text-warning">3 days left</span></p>
                    <span class="badge badge-success mr-1">New</span>
                    <span class="badge badge-warning">Closing Soon</span>
                </div>
                <div class="text-right d-flex flex-column justify-content-between align-items-end">
                    <a href="#" class="btn btn-primary mb-2">Apply Now</a>
                    <div>
                        <i class="far fa-bookmark mr-3"></i>
                        <i class="far fa-bell"></i>
                    </div>
                </div>
            </div>

        </div>

        <div class="job-card border rounded p-4 mb-4 shadow-sm">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="font-weight-bold mb-1">Professor</h5>
                    <p class="text-muted mb-1"><i class="fas fa-building mr-1"></i>RK University &nbsp; <i class="fas fa-map-marker-alt"></i> New York, NY</p>
                    <p class="mb-2"><i class="far fa-clock mr-1"></i> 1-2 years &nbsp; <i class="fas fa-envelope mr-1"></i> $10,000 – $20,000 &nbsp; <i class="far fa-calendar-alt mr-1"></i> <span class="text-warning">3 days left</span></p>
                    <span class="badge badge-success mr-1">New</span>
                    <span class="badge badge-warning">Closing Soon</span>
                </div>
                <div class="text-right d-flex flex-column justify-content-between align-items-end">
                    <a href="#" class="btn btn-primary mb-2">Apply Now</a>
                    <div>
                        <i class="far fa-bookmark mr-3"></i>
                        <i class="far fa-bell"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- Repeat this block for each job -->
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