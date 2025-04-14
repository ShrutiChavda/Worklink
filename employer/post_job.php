<?php  include('session.php');  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Blank page</title>
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/search.js"></script>

    <style>
        .card {
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
            border-radius: 1rem;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            padding: 0.6rem 2rem;
        }

        .form-control,
        .form-select {
            border-radius: 0.5rem;
        }

        .invalid-feedback {
            font-size: 0.85rem;
        }
    </style>

</head>

<body id="page-top">
<?php  include('sidebar.php'); ?>
<?php  include('header.php'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Post a Job</h1>

    <form class="needs-validation" action="insert_job.php" method="POST" novalidate>
        <!-- Job Details -->
        <div class="card mb-4">
            <div class="card-header">Job Details</div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label for="jobId" class="form-label">Job ID</label>
                    <input type="text" class="form-control" id="jobId" name="jobId" required>

                    <div class="invalid-feedback">Job ID is required.</div>
                </div>
                <div class="col-md-4">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="text" class="form-control" id="salary" name="salary" required>
                    </div>
                <div class="col-md-4">
                    <label for="openings" class="form-label">Number of Openings</label>
                    <input type="number" class="form-control" id="openings" name="openings" required min="1">
                    <div class="invalid-feedback">Please specify number of openings.</div>
                </div>
                <div class="col-md-4">
                    <label for="postedOn" class="form-label">Posted On</label>
                    <input type="date" class="form-control" id="postedOn" name="postedOn" required>
                </div>
                <div class="col-md-4">
                    <label for="lastDate" class="form-label">Last Date to Apply</label>
                    <input type="date" class="form-control" id="lastDate" name="lastDate" required>
                </div>

                <div class="col-md-4">
            <label for="category" class="form-label">Category</label>
            <br>
            <select class="form-select" id="category" name="category" required>
                <option value="">Select Category</option>
                <option value="Technology">Technology </option>
                <option value="Healthcare">Healthcare </option>
                <option value="Finance">Finance </option>
                <option value="Marketing">Marketing </option>
                <option value="Education">Education </option>
                <option value="Design">Design </option>
                <option value="Sales">Sales </option>
                <option value="Engineering"> Engineering</option>
            </select>
            <div class="invalid-feedback">Please select a category.</div>
        </div>
            </div>
        </div>

        <!-- Company & Role -->
        <div class="card mb-4">
            <div class="card-header">Company & Role</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label for="companyName" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="companyName" name="companyName" required>
                    <div class="invalid-feedback">Company name is required.</div>
                </div>
                <div class="col-md-6">
                    <label for="jobTitle" class="form-label">Job Title</label>
                    <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
                    <div class="invalid-feedback">Job title is required.</div>
                </div>
                <div class="col-md-6">
                    <label for="organisationType" class="form-label">Organisation Type</label>
                    <input type="text" class="form-control" id="organisationType" name="organisationType" required/>
                </div>
                <div class="col-md-6">
                    <label for="functionalArea" class="form-label">Functional Area</label>
                    <input type="text" class="form-control" id="functionalArea" name="functionalArea" /required>
                </div>
                <div class="col-md-6">
                    <label for="functionalRole" class="form-label">Functional Role</label>
                    <input type="text" class="form-control" id="functionalRole" name="functionalRole" required>
                    <div class="invalid-feedback">Functional role is required.</div>
                </div>
            </div>
        </div>

        <!-- Job Description -->
        <div class="card mb-4">
            <div class="card-header">Job Description</div>
            <div class="card-body">
                <textarea class="form-control" id="jobDescription" name="jobDescription" rows="5" required></textarea>
                <div class="invalid-feedback">Job description is required.</div>
            </div>
        </div>

        <!-- Qualification & Preferences -->
        <div class="card mb-4">
            <div class="card-header">Requirements & Preferences</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label for="qualification" class="form-label">Minimum Qualification</label>
                    <input type="text" class="form-control" id="qualification" name="qualification" /required>
                </div>
                <div class="col-md-6">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" id="country" name="country" required>
                </div>
                <div class="col-md-6">
                    <label for="occupation" class="form-label">Occupation</label>
                    <input type="text" class="form-control" id="occupation"  name="occupation" /required>
                </div>
                <div class="col-md-6">
                    <label for="jobType" class="form-label">Nature of Job</label>
                    <select class="form-select" id="jobType" name="jobType" required>
    <option value="" disabled selected>Select...</option>
    <option>Full Time</option>
    <option>Part Time</option>
    <option>Contract</option>
</select>

                </div>
                <div class="col-md-6">
                    <label for="genderPref" class="form-label">Gender Preference</label>
                    <select class="form-select" id="genderPref" name="genderPref" required>
                        <option value="" disabled selected>Select...</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Any</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label d-block">Ex-Servicemen Preferred</label>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="exServicemen" id="exYes" value="Yes" required>
                    <label class="form-check-label" for="exYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="exServicemen" id="exNo" value="No" required>
                    <label class="form-check-label" for="exNo">No</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="text-end">
            <input type="submit" class="btn btn-primary" value="Post Job"></input>
        </div>
    </form>
</div> 
    <?php include_once('footer.php'); ?>

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
                    <a class="btn btn-success" href="http://localhost/worklink/jobSeeker/logout.php">Logout</a>
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
<!-- Optional JS: Bootstrap Validation -->
<script>
    (function () {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();

</script>
</body>
</html>
