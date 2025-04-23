<?php
include('session.php');
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['application_id']) && isset($_POST['status'])) {
    $application_id = $_POST['application_id'];
    $status = $_POST['status']; // now directly using the values from select: applied, hired, rejected

    $update_query = "UPDATE job_applications SET status = '$status' WHERE id = '$application_id'";
    if (mysqli_query($con, $update_query)) {
        header("Location: manage_applications.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Manage Applications</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
</head>
<body id="page-top">
<?php
include('sidebar.php');
include('header.php');
?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manage Applications</h1>
    <div class="table-responsive">
        <table class="table table-bordered" id="applicationsTable">
            <thead class="thead-light">
            <tr>
                <th>Applicant Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Job Title</th>
                <th>Applied On</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $employer_id = $_SESSION['user_id'];
            $query = "SELECT 
            ja.*, 
            ja.status AS application_status,
            j.title AS job_title, 
            u.*, 
            js.resume, 
            js.id AS js_id
          FROM job_applications ja
          JOIN jobs j ON ja.job_id = j.id
          JOIN job_seekers js ON ja.job_seeker_id = js.id
          JOIN users u ON js.user_id = u.id
          WHERE j.employer_id = '$employer_id'
          ORDER BY ja.applied_at DESC";

            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['full_name']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['phone']}</td>";
                echo "<td>{$row['job_title']}</td>";
                echo "<td>" . date('d-m-Y', strtotime($row['applied_at'])) . "</td>";
                echo "<td>";
                if ($row['status'] == 'applied') {
                    echo "<span class='badge badge-warning'>Applied</span>";
                } elseif ($row['status'] == 'hired') {
                    echo "<span class='badge badge-success'>Selected</span>";
                } elseif ($row['status'] == 'rejected') {
                    echo "<span class='badge badge-danger'>Rejected</span>";
                } else {
                    echo ucfirst($row['status']);
                }

                echo "</td>";
                echo "<td>
                            <button class='btn btn-primary btn-sm editBtn'
                                    data-toggle='modal' data-target='#editModal'
                                    data-appid='{$row['id']}'
                                    data-uid='{$row['id']}'
                                    data-fullname='{$row['full_name']}'
                                    data-email='{$row['email']}'
                                    data-gender='{$row['gender']}'
                                    data-phone='{$row['phone']}'
                                    data-birthday='{$row['birthday']}'
                                    data-qualification='{$row['qualification']}'
                                    data-address='{$row['address']}'
                                    data-state='{$row['state']}'
                                    data-district='{$row['district']}'
                                    data-pincode='{$row['pincode']}'
                                    data-resume='" . htmlspecialchars($row['resume'] ?? '') . "'
                                    data-status='{$row['status']}'>
                                Edit</button>
                            <a href='delete_application.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="manage_applications.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Application</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" name="application_id" id="edit_app_id">
                    <div class="form-group col-md-6">
                        <label>Full Name</label>
                        <input type="text" name="full_name" id="edit_full_name" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="text" name="email" id="edit_email" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Gender</label>
                        <input type="text" name="gender" id="edit_gender" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Phone</label>
                        <input type="text" name="phone" id="edit_phone" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Birthday</label>
                        <input type="text" name="birthday" id="edit_birthday" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Qualification</label>
                        <input type="text" name="qualification" id="edit_qualification" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Address</label>
                        <textarea name="address" id="edit_address" class="form-control" readonly></textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label>State</label>
                        <input type="text" name="state" id="edit_state" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>District</label>
                        <input type="text" name="district" id="edit_district" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Pincode</label>
                        <input type="text" name="pincode" id="edit_pincode" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Resume</label><br>
                        <a href="#" id="resume_link" target="_blank" class="btn btn-info btn-sm">Download Resume</a>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Status</label>
                        <select name="status" id="edit_status" class="form-control">
    <option value="applied">Applied</option>
    <option value="hired">Selected</option>
    <option value="rejected">Rejected</option>
</select>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('.editBtn').click(function () {
            $('#edit_app_id').val($(this).data('appid'));
            $('#edit_full_name').val($(this).data('fullname'));
            $('#edit_email').val($(this).data('email'));
            $('#edit_gender').val($(this).data('gender'));
            $('#edit_phone').val($(this).data('phone'));
            $('#edit_birthday').val($(this).data('birthday'));
            $('#edit_qualification').val($(this).data('qualification'));
            $('#edit_address').val($(this).data('address'));
            $('#edit_state').val($(this).data('state'));
            $('#edit_district').val($(this).data('district'));
            $('#edit_pincode').val($(this).data('pincode'));
            let resume = $(this).data('resume');
            $('#resume_link').attr('href', '../uploads/resumes/' + resume);

            var status = $(this).data('status');
if (status === 'hired') {
    status = 'Selected';
} else if (status === 'rejected') {
    status = 'Rejected';
} else if (status === 'applied') {
    status = 'Applied';
}
$('#edit_status').val($(this).data('status'));

        });
    });
</script>
</body>
</html>