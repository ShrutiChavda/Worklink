<?php
include('session.php');
include('connection.php');

$provider_id = $_SESSION['user_id'];
$msg = "";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($con, "DELETE FROM assessments WHERE id = $id AND provider_id = $provider_id");
    $msg = "<div class='alert alert-success'>Assessment deleted.</div>";
}

$assessments = mysqli_query($con, "SELECT a.*, t.course_name 
                                   FROM assessments a 
                                   JOIN training_programs t ON t.id = a.course_id 
                                   WHERE a.provider_id = $provider_id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Update Assessments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body id="page-top">
    <?php include('sidebar.php'); include('header.php'); ?>

    <div class="container-fluid">
        <h2 class="mb-4">Manage Assessments</h2>
        <?= $msg ?>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Course</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Timer</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($assessments)) { ?>
                    <tr>
                        <td><?= $row['course_name'] ?></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['type'] ?></td>
                        <td><?= $row['timer_minutes'] ?? '—' ?></td>
                        <td><?= $row['due_date'] ?? '—' ?></td>
                        <td>
                            <button class="btn btn-info btn-sm"
                                onclick='showDetails(<?= json_encode($row) ?>)'>View</button>
                            <a href="edit_assessment.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this assessment?')">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="assessmentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assessment Details</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <div id="assessmentDetails"></div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php include_once('footer.php'); ?>
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

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
    </div>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
    <script>
    $('#dataTable').DataTable();

    function showDetails(data) {
        let html = `<strong>Course:</strong> ${data.course_name}<br>
                    <strong>Title:</strong> ${data.title}<br>
                    <strong>Type:</strong> ${data.type}<br>
                    <strong>Timer:</strong> ${data.timer_minutes || '—'} mins<br>
                    <strong>Due Date:</strong> ${data.due_date || '—'}<br><br>
                    <strong>Questions:</strong><br>`;
        const questions = JSON.parse(data.questions);
        questions.forEach((q, i) => {
            html += `<div class="mb-2"><strong>Q${i + 1}:</strong> ${q.q}<br>`;
            if (q.options) {
                q.options.forEach((opt, j) => {
                    html += `Option ${j + 1}: ${opt}<br>`;
                });
                html += `Answer: Option ${q.answer}</div>`;
            }
        });
        document.getElementById('assessmentDetails').innerHTML = html;
        $('#assessmentModal').modal('show');
    }
    </script>
</body>

</html>