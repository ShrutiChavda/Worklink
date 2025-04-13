<?php
include('session.php');
include('connection.php');

// Handle AJAX update request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enrollment_id'], $_POST['action'])) {
    $enrollment_id = intval($_POST['enrollment_id']);
    $action = $_POST['action'];

    if (!in_array($action, ['Approved', 'Rejected', 'Pending'])) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
        exit;
    }

    $stmt = $con->prepare("UPDATE enrollments SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $action, $enrollment_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'DB update failed']);
    }
    $stmt->close();
    exit;
}

$query = "
SELECT e.id AS enrollment_id, e.status, e.enrollment_date, 
       u.id AS user_id, u.full_name, u.email, u.phone, u.gender, u.birthday,
       tp.course_name, tp.id AS program_id
FROM enrollments e
JOIN users u ON e.user_id = u.id
JOIN training_programs tp ON e.training_program_id = tp.id
WHERE e.provider_id = ?
ORDER BY e.id DESC";

$stmt = $con->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Approve Applicants</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
    <style>
        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>
<body id="page-top">
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-primary">Approve Student Enrollments</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Enrollment Requests</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="enrollmentTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>User Info</th>
                            <th>Program</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td>
                                    <strong><?= htmlspecialchars($row['full_name']) ?></strong><br>
                                    <small><?= htmlspecialchars($row['email']) ?></small><br>
                                    <button class="btn btn-sm btn-info mt-1" data-toggle="modal" data-target="#applicantModal" 
                                        data-id="<?= $row['user_id'] ?>" data-name="<?= htmlspecialchars($row['full_name']) ?>"
                                        data-email="<?= htmlspecialchars($row['email']) ?>" data-phone="<?= htmlspecialchars($row['phone']) ?>" 
                                        data-birthday="<?= $row['birthday'] ?>" data-gender="<?= $row['gender'] ?>" 
                                        data-program="<?= htmlspecialchars($row['course_name']) ?>"
                                        data-enroll-date="<?= $row['enrollment_date'] ?>" data-status="<?= $row['status'] ?>"
                                        data-program-id="<?= $row['program_id'] ?>">More Info</button>
                                </td>
                                <td><?= htmlspecialchars($row['course_name']) ?></td>
                                <td><?= $row['enrollment_date'] ?></td>
                                <td>
                                    <span class="badge 
                                        <?= $row['status'] == 'Approved' ? 'badge-success' : ($row['status'] == 'Rejected' ? 'badge-danger' : 'badge-warning') ?>">
                                        <?= $row['status'] ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($row['status'] == 'Pending') { ?>
                                        <button class="btn btn-success btn-sm actionBtn" data-id="<?= $row['enrollment_id'] ?>" data-action="Approved">Approve</button>
                                        <button class="btn btn-danger btn-sm actionBtn" data-id="<?= $row['enrollment_id'] ?>" data-action="Rejected">Reject</button>
                                    <?php } else { ?>
                                        <span class="text-muted">No action</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php $stmt->close(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="applicantModal" tabindex="-1" role="dialog" aria-labelledby="applicantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Applicant Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-6 mb-2"><strong>Name:</strong> <span id="applicantName"></span></div>
                <div class="col-md-6 mb-2"><strong>Email:</strong> <span id="applicantEmail"></span></div>
                <div class="col-md-6 mb-2"><strong>Phone:</strong> <span id="applicantPhone"></span></div>
                <div class="col-md-6 mb-2"><strong>Date of Birth:</strong> <span id="applicantbirthday"></span></div>
                <div class="col-md-6 mb-2"><strong>Gender:</strong> <span id="applicantGender"></span></div>
                <div class="col-md-6 mb-2"><strong>Program:</strong> <span id="applicantProgram"></span></div>
                <div class="col-md-6 mb-2"><strong>Enrollment Date:</strong> <span id="applicantEnrollDate"></span></div>
                <div class="col-md-6 mb-2"><strong>Status:</strong> <span id="applicantStatus"></span></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>
<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">Click "Logout" if you're ready to end your session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
$(document).ready(function () {
    $('#enrollmentTable').DataTable();

    $('#applicantModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        $('#applicantName').text(button.data('name'));
        $('#applicantEmail').text(button.data('email'));
        $('#applicantPhone').text(button.data('phone'));
        $('#applicantbirthday').text(button.data('birthday'));
        $('#applicantGender').text(button.data('gender'));
        $('#applicantProgram').text(button.data('program'));
        $('#applicantEnrollDate').text(button.data('enroll-date'));
        $('#applicantStatus').text(button.data('status'));
    });

    $('.actionBtn').click(function () {
        var enrollmentId = $(this).data('id');
        var action = $(this).data('action');
        if (confirm(`Are you sure you want to ${action} this enrollment?`)) {
            $.ajax({
                url: 'approve_applicants.php',
                type: 'POST',
                dataType: 'json',
                data: { enrollment_id: enrollmentId, action: action },
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Enrollment ' + action + ' successfully.');
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('Server Error: ' + xhr.responseText);
                }
            });
        }
    });
});
</script>

</body>
</html>
