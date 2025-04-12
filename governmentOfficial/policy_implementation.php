<?php
include('session.php');
include('connection.php');

// Add New Policy
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['policy_title']) && !isset($_POST['policy_id'])) {
    $title = $_POST['policy_title'];
    $dept = $_POST['department'];
    $desc = $_POST['description'];
    $status = $_POST['status'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO policies (policy_title, department, description, status) VALUES ('$title', '$dept', '$desc', '$status')";
    if (mysqli_query($con, $sql)) {
        $id = mysqli_insert_id($con);
        $new_data = json_encode([
            "policy_title" => $title,
            "department" => $dept,
            "description" => $desc,
            "status" => $status
        ]);
        mysqli_query($con, "INSERT INTO audit_logs (action, table_name, record_id, new_data, created_by) VALUES ('insert', 'policies', $id, '$new_data', $user_id)");
    }
    header("Location: policy_implementation.php");
    exit;
}

// Update Policy
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['policy_id'])) {
    $id = $_POST['policy_id'];
    $title = $_POST['policy_title'];
    $dept = $_POST['department'];
    $desc = $_POST['description'];
    $status = $_POST['status'];
    $user_id = $_SESSION['user_id'];

    $result = mysqli_query($con, "SELECT * FROM policies WHERE policy_id = $id");
    $old = mysqli_fetch_assoc($result);
    $old_data = json_encode($old);

    $update = "UPDATE policies SET policy_title='$title', department='$dept', description='$desc', status='$status' WHERE policy_id = $id";
    if (mysqli_query($con, $update)) {
        $new_data = json_encode([
            "policy_title" => $title,
            "department" => $dept,
            "description" => $desc,
            "status" => $status
        ]);
        mysqli_query($con, "INSERT INTO audit_logs (action, table_name, record_id, old_data, new_data, created_by) VALUES ('update', 'policies', $id, '$old_data', '$new_data', $user_id)");
    }
    header("Location: policy_implementation.php");
    exit;
}

// Delete Policy
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $result = mysqli_query($con, "SELECT * FROM policies WHERE policy_id = $id");
    $old = mysqli_fetch_assoc($result);
    $old_data = json_encode($old);

    if (mysqli_query($con, "DELETE FROM policies WHERE policy_id = $id")) {
        mysqli_query($con, "INSERT INTO audit_logs (action, table_name, record_id, old_data, created_by) VALUES ('delete', 'policies', $id, '$old_data', $user_id)");
    }
    header("Location: policy_implementation.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Government Schemes & Policy Implementation</title>
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
</head>
<body id="page-top">

<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Government Schemes & Policy Implementation</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Policy Management</h6>
                </div>
                <div class="card-body">
                    <p>As a government official, you have access to manage, update, and implement various policies under government schemes.</p>
                    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createPolicyModal">Add New Policy</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Policy Table -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">Existing Policies</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="policyTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Policy ID</th>
                                    <th>Policy Title</th>
                                    <th>Department</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM policies";
                                $result = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "
                                    <tr>
                                        <td>{$row['policy_id']}</td>
                                        <td>{$row['policy_title']}</td>
                                        <td>{$row['department']}</td>
                                        <td>{$row['description']}</td>
                                        <td>" . ($row['status'] == 1 ? 'Active' : 'Inactive') . "</td>
                                        <td>
                                            <button class='btn btn-info btn-sm mb-1' data-toggle='modal' data-target='#updatePolicyModal{$row['policy_id']}'>Update</button>
                                            <a href='policy_implementation.php?id={$row['policy_id']}' class='btn btn-danger btn-sm mb-1'>Delete</a>
                                        </td>
                                    </tr>
                                    ";

                                    echo "
                                    <div class='modal fade' id='updatePolicyModal{$row['policy_id']}' tabindex='-1'>
                                        <div class='modal-dialog modal-dialog-centered modal-lg'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title'>Update Policy</h5>
                                                    <button type='button' class='close' data-dismiss='modal'><span>×</span></button>
                                                </div>
                                                <form method='POST' action='policy_implementation.php'>
                                                    <div class='modal-body'>
                                                        <div class='form-group'>
                                                            <label>Policy Title</label>
                                                            <input type='text' class='form-control' name='policy_title' value='{$row['policy_title']}' required>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label>Department</label>
                                                            <input type='text' class='form-control' name='department' value='{$row['department']}' required>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label>Description</label>
                                                            <textarea class='form-control' name='description' rows='3' required>{$row['description']}</textarea>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label>Status</label>
                                                            <select class='form-control' name='status' required>
                                                                <option value='1'" . ($row['status'] == 1 ? ' selected' : '') . ">Active</option>
                                                                <option value='0'" . ($row['status'] == 0 ? ' selected' : '') . ">Inactive</option>
                                                            </select>
                                                        </div>
                                                        <input type='hidden' name='policy_id' value='{$row['policy_id']}'>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                                        <button type='submit' class='btn btn-primary'>Update Policy</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding New Policy -->
<div class="modal fade" id="createPolicyModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Policy</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <form method="POST" action="policy_implementation.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Policy Title</label>
                        <input type="text" class="form-control" name="policy_title" required>
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <input type="text" class="form-control" name="department" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Policy</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>


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

    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- JS Libraries -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script>
$(document).ready(function () {
    $('#policyTable').DataTable({
        responsive: true
    });
});
</script>
</body>
</html>
