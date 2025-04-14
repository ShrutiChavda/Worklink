<?php  include('session.php');  ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blank Page</title>

    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/search.js"></script>
    <link href="css/government.css" rel="stylesheet">
<script src="js/government.js"></script>

</head>

<body id="page-top">

<?php  include('sidebar.php'); ?>
<?php  include('header.php'); ?>

<div class="container-fluid" id="gov-panel">
    <h1 class="h3 mb-4 text-primary">Labour & Employment Management Panel</h1>

    <!-- Dashboard Overview Cards -->
    <div class="row">
        <!-- Employment Reports -->
        <div class="col-md-4 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <h5>Employment Reports</h5>
                    <p>Monitor employment trends and workforce participation.</p>
                </div>
            </div>
        </div>
        <!-- Pending Verifications -->
        <div class="col-md-4 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <h5>Pending Verifications</h5>
                    <p>Approve or reject job listings and training programs.</p>
                </div>
            </div>
        </div>
        <!-- Labour Welfare Metrics -->
        <div class="col-md-4 mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <h5>Labour Welfare Metrics</h5>
                    <p>Track grievances, safety, and compliance data.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Functional Sections -->
    <div class="row mt-4">
        <!-- Manage Job Listings -->
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item active bg-primary border-primary">Manage Job Listings</li>
                <li class="list-group-item">Approve/Reject Job Posts</li>
                <li class="list-group-item">Track Employer Submissions</li>
            </ul>
        </div>
        <!-- Skill Development & Training -->
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item active bg-primary border-primary">Skill Development & Training</li>
                <li class="list-group-item">Approve Training Programs</li>
                <li class="list-group-item">View Skill Provider Metrics</li>
            </ul>
        </div>
    </div>

    <!-- Additional Functionalities -->
    <div class="row mt-4">
        <!-- Labour Welfare & Grievances -->
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item active bg-primary border-primary">Labour Welfare & Grievances</li>
                <li class="list-group-item">Monitor Worker Complaints</li>
                <li class="list-group-item">Implement Welfare Policies</li>
            </ul>
        </div>
        <!-- Reports & Analytics -->
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item active bg-primary border-primary">Reports & Analytics</li>
                <li class="list-group-item">Analyze Employment Rates</li>
                <li class="list-group-item">Generate Compliance Reports</li>
            </ul>
        </div>
    </div>

    <!-- Government Schemes & Support -->
    <div class="row mt-4">
        <div class="col-md-12">
            <ul class="list-group">
                <li class="list-group-item active bg-primary border-primary">Government Schemes & Support</li>
                <li class="list-group-item">Oversee Policy Implementation</li>
                <li class="list-group-item">Manage Grant Distributions</li>
            </ul>
        </div>
    </div>

    <!-- Employer Compliance -->
    <div class="row mt-4">
        <div class="col-md-12">
            <ul class="list-group">
                <li class="list-group-item active bg-primary border-primary">Employer Compliance</li>
                <li class="list-group-item">Track Minimum Wage Laws</li>
                <li class="list-group-item">Enforce Workplace Safety Regulations</li>
            </ul>
        </div>
    </div>
</div>



<?php include_once('footer.php'); ?>

</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">�</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-success" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>
