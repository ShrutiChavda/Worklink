<?php include('session.php'); ?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='description' content=''>
    <meta name='author' content=''>

    <title>Saved jobs</title>

    <link href='img/favicon.png' rel='icon'>
    <link href="css/saved_jobs.css" rel="stylesheet">
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

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4 saved-jobs-container">
        <div class="saved-jobs-header">
            <h1 class="h3 text-gray-800">Saved Jobs</h1>
            <p class="text-muted"><small>Manage your saved job listings</small></p>
        </div>
        <div class="saved-jobs-search">
            <input type="text" class="form-control" placeholder="Search saved jobs...">
            <button class="btn btn-outline-secondary"><i class="fas fa-filter"></i> Filters</button>
        </div>
    </div>

    <div class="row">
        <!-- Job Card 1 -->
        <div class="col-md-6 mb-4">
            <div class="saved-job-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="saved-job-title">Senior Frontend Developer</h5>
                        <p class="saved-job-company">TechCorp Solutions - San Francisco, CA</p>
                        <span class="badge badge-light">Full-time</span>
                        <span class="saved-job-salary">$120K - $150K</span>
                        <p class="text-muted mt-1"><small>Saved 2 days ago</small></p>
                    </div>
                    <i class="fas fa-bookmark saved-job-bookmark"></i>
                </div>
                <ul class="saved-job-requirements mt-2">
                    <li>5+ years React experience</li>
                    <li>TypeScript expertise</li>
                    <li>UI/UX knowledge</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <a href="#" class="btn btn-primary">Apply Now</a>
                    <span class="saved-job-match">95% Match</span>
                </div>
            </div>
        </div>

        <!-- Job Card 2 -->
        <div class="col-md-6 mb-4">
            <div class="saved-job-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="saved-job-title">Product Designer</h5>
                        <p class="saved-job-company">Creative Minds Inc - Remote</p>
                        <span class="badge badge-light">Full-time</span>
                        <span class="saved-job-salary">$90K - $120K</span>
                        <p class="text-muted mt-1"><small>Saved 3 days ago</small></p>
                    </div>
                    <i class="fas fa-bookmark saved-job-bookmark"></i>
                </div>
                <ul class="saved-job-requirements mt-2">
                    <li>Figma proficiency</li>
                    <li>3+ years experience</li>
                    <li>Portfolio required</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <a href="#" class="btn btn-primary">Apply Now</a>
                    <span class="saved-job-match">88% Match</span>
                </div>
            </div>
        </div>

        <!-- Job Card 3 -->
        <div class="col-md-6 mb-4">
            <div class="saved-job-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="saved-job-title">DevOps Engineer</h5>
                        <p class="saved-job-company">Cloud Systems - New York, NY</p>
                        <span class="badge badge-light">Full-time</span>
                        <span class="saved-job-salary">$130K - $160K</span>
                        <p class="text-muted mt-1"><small>Saved 1 week ago</small></p>
                    </div>
                    <i class="fas fa-bookmark saved-job-bookmark"></i>
                </div>
                <ul class="saved-job-requirements mt-2">
                    <li>AWS expertise</li>
                    <li>CI/CD pipeline experience</li>
                    <li>Kubernetes</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <a href="#" class="btn btn-primary">Apply Now</a>
                    <span class="saved-job-match">82% Match</span>
                </div>
            </div>
        </div>

        <!-- Job Card 4 -->
        <div class="col-md-6 mb-4">
            <div class="saved-job-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="saved-job-title">Full Stack Developer</h5>
                        <p class="saved-job-company">Innovation Labs - Boston, MA</p>
                        <span class="badge badge-light">Remote</span>
                        <span class="saved-job-salary">$100K - $140K</span>
                        <p class="text-muted mt-1"><small>Saved 1 week ago</small></p>
                    </div>
                    <i class="fas fa-bookmark saved-job-bookmark"></i>
                </div>
                <ul class="saved-job-requirements mt-2">
                    <li>Node.js</li>
                    <li>React</li>
                    <li>MongoDB</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <a href="#" class="btn btn-primary">Apply Now</a>
                    <span class="saved-job-match">90% Match</span>
                </div>
            </div>
        </div>
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
