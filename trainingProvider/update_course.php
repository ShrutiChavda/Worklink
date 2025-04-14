<?php include('session.php'); ?>
<?php include('connection.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['update'])) {
    $providerId = $_SESSION['user_id'];
    $course = mysqli_real_escape_string($con, $_POST['course_name']);
    $desc = mysqli_real_escape_string($con, $_POST['description']);
    $duration = intval($_POST['duration']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    $providerSQL = mysqli_query($con, "SELECT id FROM training_providers WHERE user_id = $providerId");
    $provider = mysqli_fetch_assoc($providerSQL);
    $provider_id = $provider['id'];

    mysqli_query($con, "INSERT INTO training_programs (provider_id, course_name, description, duration, status, created_at) 
        VALUES ('$provider_id', '$course', '$desc', '$duration', '$status', NOW())");
    header("Location: update_course.php");
    exit;
}

if (isset($_POST['update'])) {
    $id = intval($_POST['edit_id']);
    $name = mysqli_real_escape_string($con, $_POST['course_name']);
    $desc = mysqli_real_escape_string($con, $_POST['description']);
    $duration = intval($_POST['duration']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    mysqli_query($con, "UPDATE training_programs SET 
        course_name = '$name',
        description = '$desc',
        duration = '$duration',
        status = '$status' 
        WHERE id = $id");
    header("Location: update_course.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = intval($_POST['delete_id']);
    mysqli_query($con, "DELETE FROM training_programs WHERE id = $id");
    header("Location: update_course.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Update Course</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="page-top">
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-primary">Skill Development Hub</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
            <h6 class="m-0 font-weight-bold text-success">Manage Training Programs</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="programsTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Course Name</th>
                            <th>Description</th>
                            <th>Duration (Months)</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $providerId = $_SESSION['user_id'];
                        $result = mysqli_query($con, "SELECT tp.* FROM training_programs tp
                                                      INNER JOIN training_providers p ON tp.provider_id = p.user_id
                                                      WHERE p.user_id = $providerId");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$row['course_name']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['duration']}</td>
                                <td>{$row['status']}</td>
                                <td>{$row['created_at']}</td>
                                <td>
                                    <div class='d-flex flex-wrap gap-1'>
                                        <button class='btn btn-info btn-sm editBtn mb-1' data-id='{$row['id']}'>Edit</button>
                                        <form method='POST' action='' class='d-inline'>
                                            <input type='hidden' name='delete_id' value='{$row['id']}'>
                                            <button class='btn btn-danger btn-sm mb-1' onclick=\"return confirm('Are you sure?');\">Delete</button>
                                        </form>
                                    </div>
                                </td>
                              </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addProgramModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form action="update_course.php" method="POST" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Training Program</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6 form-group">
                        <label>Course Name</label>
                        <input type="text" name="course_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Duration (Months)</label>
                        <input type="number" name="duration" class="form-control" required>
                    </div>
                    <div class="col-12 form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="col-12 form-group d-flex justify-content-end">
                        <button class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editProgramModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form action="update_course.php" method="POST" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Training Program</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body row g-3">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="col-md-6 form-group">
                        <label>Course Name</label>
                        <input type="text" name="course_name" id="edit_course_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Duration (Months)</label>
                        <input type="number" name="duration" id="edit_duration" class="form-control" required>
                    </div>
                    <div class="col-12 form-group">
                        <label>Description</label>
                        <textarea name="description" id="edit_description" class="form-control" required></textarea>
                    </div>
                  
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit" name="update">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php include_once('footer.php'); ?>
<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-success" href="logout.php">Logout</a>
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
$(document).ready(function () {
    $('#programsTable').DataTable();

    $('.editBtn').click(function () {
        const row = $(this).closest('tr');
        $('#edit_id').val($(this).data('id'));
        $('#edit_course_name').val(row.find('td:eq(0)').text().trim());
        $('#edit_description').val(row.find('td:eq(1)').text().trim());
        $('#edit_duration').val(row.find('td:eq(2)').text().trim());
        $('#edit_status').val(row.find('td:eq(3)').text().trim());
        $('#editProgramModal').modal('show');
    });
});
</script>

</body>
</html>
