<?php
include('session.php');
include('connection.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $allowed = ['approved', 'rejected'];

    if (isset($_POST['approve'])) {
        $status = 'approved';
    } elseif (isset($_POST['reject'])) {
        $status = 'rejected';
    } elseif (isset($_POST['status']) && in_array(strtolower($_POST['status']), $allowed)) {
        $status = strtolower($_POST['status']);
    } else {
        echo "Invalid or missing status.";
        exit;
    }

    $stmt = $con->prepare("UPDATE jobs SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    $stmt->close();

    if (isset($_POST['approve']) || isset($_POST['reject'])) {
        header("Location: job_verification.php");
        exit();
    } else {
        echo "Job status updated to: " . ucfirst($status);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Job Listings - Labour & Employment Management Panel</title>
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
    .modal-body {
        overflow-x: auto;
    }
    </style>
</head>

<body id="page-top">

    <?php include('sidebar.php'); ?>
    <?php include('header.php'); ?>

    <div class="container-fluid px-3">
        <h1 class="h3 mb-4 text-gray-800">Manage Job Listings</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Approve or Reject Job Posts</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="jobListingsTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Employer</th>
                                <th>Location</th>
                                <th>Posted On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$query = mysqli_query($con, "
    SELECT 
        jobs.*, 
        employers.company_name, 
        employers.industry,
        users.full_name AS employer_name, 
        users.email, 
        users.phone, 
        users.gender, 
        users.pic
    FROM jobs
    LEFT JOIN employers ON jobs.employer_id = employers.id
    LEFT JOIN users ON employers.user_id = users.id
    ORDER BY jobs.created_at DESC
");

while ($row = mysqli_fetch_assoc($query)) {
    $status = $row['status'];
    $badgeClass = match ($status) {
        'approved' => 'success',
        'rejected' => 'danger',
        'pending' => 'warning',
        default => 'secondary'
    };

    $jobId = $row['id'];
    $imgPath = "img/Uploads/" . $row['pic'];

    echo "<tr>
            <td>{$row['title']}</td>
            <td>{$row['company_name']}</td>
            <td>{$row['location']}</td>
            <td>{$row['created_at']}</td>
            <td><span class='badge badge-{$badgeClass}'>" . ucfirst($status) . "</span></td>
            <td>
                <button class='btn btn-info btn-sm' data-toggle='modal' data-target='#infoModal{$jobId}'>Info</button>
            </td>
          </tr>";

    echo "
    <div class='modal fade' id='infoModal{$jobId}' tabindex='-1' role='dialog' aria-labelledby='infoModalLabel{$jobId}' aria-hidden='true'>
      <div class='modal-dialog modal-dialog-scrollable modal-lg' role='document'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title'>Job & Employer Details</h5>
            <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
          </div>

          <div class='modal-body'>
            <h5 class='text-primary mb-3'>🧾 Job Information</h5>
            <ul class='list-group mb-4'>
              <li class='list-group-item'><strong>Title:</strong> {$row['title']}</li>
              <li class='list-group-item'><strong>Description:</strong> {$row['description']}</li>
              <li class='list-group-item'><strong>Location:</strong> {$row['location']}</li>
              <li class='list-group-item'><strong>Salary:</strong> ₹{$row['salary']}</li>
              <li class='list-group-item'><strong>Status:</strong> <span class='badge badge-{$badgeClass}'>" . ucfirst($status) . "</span></li>
            </ul>

            <h5 class='text-success mb-3'>🏢 Employer Information</h5>
            <div class='row'>
              <div class='col-md-3 text-center mb-3'>
                <img src='{$imgPath}' alt='Profile Picture' class='img-fluid rounded-circle shadow-sm' style='max-width: 100px;'>
              </div>
              <div class='col-md-9'>
                <ul class='list-group'>
                  <li class='list-group-item'><strong>Name:</strong> {$row['employer_name']}</li>
                  <li class='list-group-item'><strong>Email:</strong> {$row['email']}</li>
                  <li class='list-group-item'><strong>Phone:</strong> {$row['phone']}</li>
                  <li class='list-group-item'><strong>Gender:</strong> {$row['gender']}</li>
                  <li class='list-group-item'><strong>Company:</strong> {$row['company_name']}</li>
                  <li class='list-group-item'><strong>Industry:</strong> {$row['industry']}</li>
                </ul>
              </div>
            </div>
          </div>

          <form action='job_verification.php' method='POST'>
            <input type='hidden' name='id' value='{$jobId}'>
            <div class='modal-footer flex-column flex-md-row'>
              <button type='submit' name='approve' class='btn btn-success mb-2 mb-md-0 mr-md-2 w-100 w-md-auto'>Approve</button>
              <button type='submit' name='reject' class='btn btn-danger mb-2 mb-md-0 mr-md-2 w-100 w-md-auto'>Reject</button>
              <button type='button' class='btn btn-secondary w-100 w-md-auto' data-dismiss='modal'>Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>";
}
?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">Click "Logout" to end your session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-success" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <!-- Core Plugins -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Custom Scripts -->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#jobListingsTable').DataTable();
    });
    </script>
    <script>
    $(document).ready(function() {
        $('.approve-btn').click(function() {
            const jobId = $(this).data('id');
            updateJobStatus(jobId, 'approved');
        });

        $('.reject-btn').click(function() {
            const jobId = $(this).data('id');
            updateJobStatus(jobId, 'rejected');
        });

        function updateJobStatus(jobId, status) {
            $.ajax({
                url: 'job_verification.php',
                type: 'POST',
                data: {
                    id: jobId,
                    status: status
                },
                success: function(response) {
                    alert(response);
                    location.reload(); // reload to reflect changes
                }
            });
        }
    });
    </script>


</body>

</html>