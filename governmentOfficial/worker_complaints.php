<?php
include('session.php');
include('connection.php');

if (isset($_POST['update_status'])) {
    $id = intval($_POST['complaint_id']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $resolution_note = mysqli_real_escape_string($con, $_POST['resolution_note']);
    mysqli_query($con, "UPDATE worker_complaints SET status='$status', resolution_note='$resolution_note' WHERE id=$id");
    header("Location: worker_complaints.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Worker Complaints</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .modal-body {
            max-height: 65vh;
            overflow-y: auto;
            overflow-x: auto;
        }
    </style>
</head>
<body id="page-top">
<?php include('sidebar.php'); include('header.php'); ?>

<div class="container-fluid px-3">
    <h3 class="mb-4 text-gray-800">Worker Complaints</h3>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">All Complaints</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="complaintsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Complainant Type</th>
                            <th>Complaint Type</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Submitted At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($con, "SELECT * FROM worker_complaints ORDER BY submitted_at DESC");
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['complainant_type']}</td>
                                <td>{$row['complaint_type']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['status']}</td>
                                <td>{$row['submitted_at']}</td>
                                <td><button class='btn btn-info btn-sm' data-toggle='modal' data-target='#complaintModal{$id}'>View</button></td>
                            </tr>";

                            $userQuery = mysqli_query($con, "SELECT * FROM users WHERE id={$row['user_id']}");
                            $user = mysqli_fetch_assoc($userQuery);
                            $imgPath = "img/Uploads/" . $user['pic'];
                            $sel = $row['status'];

                            echo "
                            <div class='modal fade' id='complaintModal{$id}' tabindex='-1' role='dialog'>
                                <div class='modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable' role='document'>
                                    <form method='POST'>
                                        <input type='hidden' name='complaint_id' value='{$id}'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title'>Complaint Details</h5>
                                                <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                                            </div>
                                            <div class='modal-body'>
                                                <h5 class='text-primary mb-3'>📋 Complaint Info</h5>
                                                <ul class='list-group mb-3'>
                                                    <li class='list-group-item'><strong>Complainant Type:</strong> {$row['complainant_type']}</li>
                                                    <li class='list-group-item'><strong>Complaint Type:</strong> {$row['complaint_type']}</li>
                                                    <li class='list-group-item'><strong>Description:</strong> {$row['description']}</li>
                                                    <li class='list-group-item'><strong>Submitted On:</strong> {$row['submitted_at']}</li>
                                                </ul>

                                                <h5 class='text-warning mb-3'>🛠️ Status & Resolution</h5>
                                                <ul class='list-group mb-3'>
                                                    <li class='list-group-item'>
                                                        <strong>Status:</strong>
                                                        <select name='status' class='form-control mt-2 statusSelect' data-target='noteGroup{$id}'>
                                                            <option value='Pending' " . ($sel == 'Pending' ? 'selected' : '') . ">Pending</option>
                                                            <option value='In Progress' " . ($sel == 'In Progress' ? 'selected' : '') . ">In Progress</option>
                                                            <option value='Resolved' " . ($sel == 'Resolved' ? 'selected' : '') . ">Resolved</option>
                                                        </select>
                                                    </li>
                                                    <li class='list-group-item resolutionNoteGroup' id='noteGroup{$id}' style='display:" . (($sel == 'In Progress' || $sel == 'Resolved') ? 'block' : 'none') . ";'>
                                                        <strong>Resolution Note:</strong>
                                                        <textarea name='resolution_note' class='form-control mt-2'>{$row['resolution_note']}</textarea>
                                                    </li>
                                                </ul>

                                                <h5 class='text-success mb-3'>👤 User Information</h5>
                                                <div class='row'>
                                                    <div class='col-md-3 text-center mb-3'>
                                                        <img src='{$imgPath}' class='img-fluid rounded-circle shadow' style='max-width: 100px;'>
                                                    </div>
                                                    <div class='col-md-9'>
                                                        <ul class='list-group'>
                                                            <li class='list-group-item'><strong>Name:</strong> {$user['full_name']}</li>
                                                            <li class='list-group-item'><strong>Email:</strong> {$user['email']}</li>
                                                            <li class='list-group-item'><strong>Phone:</strong> {$user['phone']}</li>
                                                            <li class='list-group-item'><strong>Gender:</strong> {$user['gender']}</li>
                                                            <li class='list-group-item'><strong>User Type:</strong> {$user['user_type']}</li>
                                                            <li class='list-group-item'><strong>Birthday:</strong> {$user['birthday']}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='modal-footer flex-column flex-md-row justify-content-center'>
                                                <button type='submit' name='update_status' class='btn btn-success m-1 w-100 w-md-auto'>Update</button>
                                                <button type='button' class='btn btn-secondary m-1 w-100 w-md-auto' data-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                    </form>
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

<!-- JS Libraries -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

<script>
$(document).ready(function() {
    $('#complaintsTable').DataTable();

    $('.statusSelect').on('change', function () {
        const targetId = $(this).data('target');
        const show = $(this).val() === 'In Progress' || $(this).val() === 'Resolved';
        $('#' + targetId).toggle(show);
    });
});
</script>
</body>
</html>
