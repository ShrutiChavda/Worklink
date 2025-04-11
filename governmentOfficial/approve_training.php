<?php include('session.php'); 
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
    <meta charset="UTF-8">
    <title>Approve Training Programs</title>
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
    <h1 class="h3 mb-4 text-gray-800">Approve Training Programs</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Training Program Submissions</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="trainingTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Program Name</th>
                            <th>Provider Company</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Info</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$query = "
    SELECT tp.id, tp.course_name, tp.description, tp.duration, tp.status, tp.created_at,
           e.company_name, u.full_name, u.email, u.phone
    FROM training_programs tp
    JOIN training_providers tpv ON tp.provider_id = tpv.id
    JOIN employers e ON tpv.user_id = e.user_id
    JOIN users u ON e.user_id = u.id
";
$result = mysqli_query($con, $query);
$modalHtml = '';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['course_name'] ?? 'N/A';
        $desc = $row['description'] ?? 'N/A';
        $dur = $row['duration'] ?? 0;
        $status = $row['status'] ?? 'Pending';
        $company = $row['company_name'] ?? 'N/A';
        $fullname = $row['full_name'] ?? 'N/A';
        $email = $row['email'] ?? 'N/A';
        $phone = $row['phone'] ?? 'N/A';
        $created = $row['created_at'] ?? 'N/A';

        $badgeClass = match (strtolower($status)) {
            'approved' => 'success',
            'rejected' => 'danger',
            'pending' => 'warning',
            default => 'secondary'
        };

        echo "<tr>
            <td>{$id}</td>
            <td>{$name}</td>
            <td>{$company}</td>
            <td>{$dur} months</td>
            <td><span class='badge badge-{$badgeClass}'>" . ucfirst($status) . "</span></td>
            <td>
                <button class='btn btn-info btn-sm' data-toggle='modal' data-target='#infoModal$id'>Info</button>
            </td>
            <td>
                <form method='post' action='' class='d-flex flex-column flex-md-row gap-1'>
                    <input type='hidden' name='id' value='{$id}'>
                    <button class='btn btn-success btn-sm mb-1 mb-md-0 mr-md-2 w-100 w-md-auto' name='approve'>Approve</button>
                    <button class='btn btn-danger btn-sm w-100 w-md-auto' name='reject'>Reject</button>
                </form>
            </td>
        </tr>";

        $modalHtml .= "
        <div class='modal fade' id='infoModal$id' tabindex='-1' role='dialog'>
            <div class='modal-dialog modal-dialog-scrollable modal-lg' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>Training & Provider Details</h5>
                        <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                    </div>
                    <div class='modal-body'>
                        <h5 class='text-primary mb-3'>📘 Training Program Info</h5>
                        <ul class='list-group mb-4'>
                            <li class='list-group-item'><strong>Name:</strong> {$name}</li>
                            <li class='list-group-item'><strong>Description:</strong> {$desc}</li>
                            <li class='list-group-item'><strong>Duration:</strong> {$dur} months</li>
                            <li class='list-group-item'><strong>Status:</strong> <span class='badge badge-{$badgeClass}'>" . ucfirst($status) . "</span></li>
                            <li class='list-group-item'><strong>Created:</strong> {$created}</li>
                        </ul>

                        <h5 class='text-success mb-3'>🏢 Provider Company Info</h5>
                        <ul class='list-group'>
                            <li class='list-group-item'><strong>Company:</strong> {$company}</li>
                            <li class='list-group-item'><strong>Contact:</strong> {$fullname}</li>
                            <li class='list-group-item'><strong>Email:</strong> {$email}</li>
                            <li class='list-group-item'><strong>Phone:</strong> {$phone}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>";
    }
} else {
    echo "<tr><td colspan='7' class='text-center'>No training programs found.</td></tr>";
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $modalHtml ?>
<?php include('footer.php'); ?>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#trainingTable').DataTable();
    });
</script>

</body>
</html>
