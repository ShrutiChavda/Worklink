<?php 
include('session.php'); 
include('connection.php');

// Handle approve/reject POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    if (isset($_POST['approve'])) {
        mysqli_query($con, "UPDATE training_programs SET status='Approved' WHERE id=$id");
    } elseif (isset($_POST['reject'])) {
        mysqli_query($con, "UPDATE training_programs SET status='Rejected' WHERE id=$id");
    }
    echo "<meta http-equiv='refresh' content='0'>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Skill Development Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .modal-body { overflow-x: auto; }
        .table-responsive { overflow-x: auto; }
    </style>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="page-top">

<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

<div class="container-fluid px-3">
    <h1 class="h3 mb-4 text-gray-800">Approve Training Programs</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Training Program Submissions</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="trainingTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Program Name</th>
                            <th>Category</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Completion Rate</th>
                            <th>Info</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "
                    SELECT 
    tp.*, 
    tpv.organization_name, 
    tpv.head_office_location, 
    tpv.training_sectors,
    u.full_name, 
    u.email, 
    u.phone
FROM training_programs tp
LEFT JOIN training_providers tpv ON tp.provider_id = tpv.user_id
LEFT JOIN users u ON tpv.user_id = u.id;

    ";
                    $result = mysqli_query($con, $query);
                    $modalHtml = '';

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $progName = $row['course_name'] ?? 'N/A';
                            $desc = $row['description'] ?? 'N/A';
                            $duration = $row['duration'] ?? 0;
                            $status = $row['status'] ?? 'Pending';
                            $created = $row['created_at'] ?? 'N/A';
                            $updated = $row['updated_at'] ?? 'N/A';
                            $category = $row['category'] ?? 'N/A';
                            $rate = $row['completion_rate'] ?? '0.00';

                            $orgName = $row['organization_name'] ?? 'N/A';
                            $location = $row['head_office_location'] ?? 'N/A';
                            $sectors = $row['training_sectors'] ?? 'N/A';

                            $fullname = $row['full_name'] ?? 'N/A';
                            $email = $row['email'] ?? 'N/A';
                            $phone = $row['phone'] ?? 'N/A';

                            $badgeClass = match (strtolower($status)) {
                                'approved' => 'success',
                                'rejected' => 'danger',
                                'pending' => 'warning',
                                default => 'secondary'
                            };

                            echo "<tr>
                                <td>{$id}</td>
                                <td>{$progName}</td>
                                <td>{$category}</td>
                                <td>{$duration} months</td>
                                <td><span class='badge badge-{$badgeClass}'>" . ucfirst($status) . "</span></td>
                                <td>{$rate}%</td>
                                <td><button class='btn btn-info btn-sm' data-toggle='modal' data-target='#infoModal{$id}'>Info</button></td>
                                <td>
                                    <form method='post' class='d-flex flex-column flex-md-row gap-2'>
                                        <input type='hidden' name='id' value='{$id}'>
                                        <button class='btn btn-success btn-sm mb-1 mb-md-0' name='approve'>Approve</button>
                                        <button class='btn btn-danger btn-sm' name='reject'>Reject</button>
                                    </form>
                                </td>
                            </tr>";

                            $modalHtml .= "
                            <div class='modal fade' id='infoModal{$id}' tabindex='-1' role='dialog'>
                                <div class='modal-dialog modal-lg modal-dialog-scrollable' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title'>Training Program & Provider Details</h5>
                                            <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                                        </div>
                                        <div class='modal-body'>
                                            <h5 class='text-primary'>📘 Training Program Info</h5>
                                            <ul class='list-group mb-4'>
                                                <li class='list-group-item'><strong>Name:</strong> {$progName}</li>
                                                <li class='list-group-item'><strong>Description:</strong> {$desc}</li>
                                                <li class='list-group-item'><strong>Category:</strong> {$category}</li>
                                                <li class='list-group-item'><strong>Duration:</strong> {$duration} months</li>
                                                <li class='list-group-item'><strong>Status:</strong> <span class='badge badge-{$badgeClass}'>" . ucfirst($status) . "</span></li>
                                                <li class='list-group-item'><strong>Completion Rate:</strong> {$rate}%</li>
                                                <li class='list-group-item'><strong>Created:</strong> {$created}</li>
                                                <li class='list-group-item'><strong>Last Updated:</strong> {$updated}</li>
                                            </ul>

                                            <h5 class='text-success'>🏢 Provider Details</h5>
                                            <ul class='list-group mb-4'>
                                                <li class='list-group-item'><strong>Organization:</strong> {$orgName}</li>
                                                <li class='list-group-item'><strong>Head Office:</strong> {$location}</li>
                                                <li class='list-group-item'><strong>Sectors:</strong> {$sectors}</li>
                                            </ul>

                                            <h5 class='text-info'>👤 Contact Info</h5>
                                            <ul class='list-group'>
                                                <li class='list-group-item'><strong>Name:</strong> {$fullname}</li>
                                                <li class='list-group-item'><strong>Email:</strong> {$email}</li>
                                                <li class='list-group-item'><strong>Phone:</strong> {$phone}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>No training programs found.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $modalHtml ?>

<?php include_once('footer.php'); ?>
<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
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

<!-- Scripts -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>
<script>
    $(document).ready(function() {
        $('#trainingTable').DataTable();
    });
</script>
</body>
</html>
