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

    <!-- icons -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php  include('sidebar.php'); ?>
<?php  include('header.php'); ?>

    <!-- Add this in <head> if not already present -->

    <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <!-- Responsive Icon Cards (3 columns on desktop, stacked on mobile) -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow-sm border-left-primary h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-briefcase fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0">Total Job Posts</h5>
                        <small class="text-muted">24 jobs posted</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow-sm border-left-success h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-users fa-2x text-success"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0">Total Applications</h5>
                        <small class="text-muted">132 received</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow-sm border-left-info h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-comments fa-2x text-info"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0">Total Messages</h5>
                        <small class="text-muted">18 unread</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table: Recent Job Listings -->
    <div class="card shadow-sm mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Recent Job Listings</h6>
    <a href="#" class="btn btn-sm btn-primary">View All</a>
</div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Job Title</th>
                            <th>Date Posted</th>
                            <th>Status</th>
                            <th>Applications</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
// Fetch last 3 jobs ordered by ID (or use posted_on if preferred)
$query = "SELECT job_title, posted_on, status, openings FROM totaljobs ORDER BY id DESC LIMIT 3";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Determine badge class based on status
        $statusClass = 'badge-secondary'; // default
        if ($row['status'] == 'Active') $statusClass = 'badge-success';
        // elseif ($row['status'] == 'Pending') $statusClass = 'badge-warning';
        elseif ($row['status'] == 'Closed') $statusClass = 'badge-secondary';

        echo "<tr>
                <td>{$row['job_title']}</td>
                <td>" . date("F j, Y", strtotime($row['posted_on'])) . "</td>
                <td><span class='badge $statusClass'>{$row['status']}</span></td>
                <td>{$row['openings']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No jobs found.</td></tr>";
}
?>
</tbody>

                </table>
            </div>
        </div>
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
