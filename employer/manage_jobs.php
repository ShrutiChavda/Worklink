<?php include('session.php'); ?>
<?php include('connection.php'); ?>
<?php
// Get session user_id
$user_id = $_SESSION['user_id'];

$query_emp = "SELECT id FROM employers WHERE user_id = '$user_id'";
    $result_emp = mysqli_query($con, $query_emp);

    if ($result_emp && mysqli_num_rows($result_emp) > 0) {
        $row_emp = mysqli_fetch_assoc($result_emp);
        $employer_id = $row_emp['id'];
    }
?>
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
</head>

<body id="page-top">
<?php  include('sidebar.php'); ?>
<?php  include('header.php'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Posted Jobs</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="jobsTable">
            <thead class="thead-light">
                <tr>
                    <th>Job ID</th>
                    <th>Salary</th>
                    <th>No. of Openings</th>
                    <th>Posted On</th>
                    <th>Last Date</th>
                    <th>Company Name</th>
                    <th>Job Title</th>
                    <th>category</th>
                    <th>Organisation Type</th>
                    <th>Functional Area</th>
                    <th>Functional Role</th>
                    <th>Job Description</th>
                    <th>Min Qualification</th>
                    <th>Country</th>
                    <th>Occupation</th>
                    <th>Job Type</th>
                    <th>Gender</th>
                    <th>Ex-Servicemen</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                

                $result = mysqli_query($con, "SELECT * FROM totaljobs where employee_id = $employer_id ORDER BY id DESC"); // Update 'jobs' to your actual table name

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['job_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['salary']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['openings']) . "</td>";
                    echo "<td>" . date('d-m-Y', strtotime($row['posted_on'])) . "</td>";
                    echo "<td>" . date('d-m-Y', strtotime($row['last_date'])) . "</td>";
                    echo "<td>" . htmlspecialchars($row['company_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['job_title']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['category']) . "</td>";

                    echo "<td>" . htmlspecialchars($row['organisation_type']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['functional_area']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['functional_role']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['job_description']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['qualification']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['country']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['occupation']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['job_type']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['gender_preference']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['ex_servicemen_preferred']) . "</td>";
                    
                    echo "<td>
        <a href='edit_jobs.php?id=" . $row['id'] . "' class='btn btn-sm btn-info' style='margin: 5px 0;'>
            <i class='fas fa-edit'></i>
        </a>
        <a href='delete_job.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' style='margin: 5px;' onclick=\"return confirm('Are you sure?')\">
            <i class='fas fa-trash'></i> 
        </a>
      </td>";
echo "</tr>";


                }

                ?>
            </tbody>
        </table>
    </div>
</div>

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

</body>
</html>
