<?php
include('session.php');
include('connection.php');

// Function to get user data by ID
function getUserData($conn, $userId) {
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

// Handle delete functionality
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // 1. Delete from job_seekers table
    $delete_jobseeker_query = "DELETE FROM job_seekers WHERE id = '$delete_id'";
    if (mysqli_query($con, $delete_jobseeker_query)) {

        // 2. Optionally, delete the user from the users table (if needed and if user_id is available)
        $get_user_id_query = "SELECT user_id FROM job_seekers WHERE id = '$delete_id'";
        $user_id_result = mysqli_query($con, $get_user_id_query);
        if ($user_id_result && $user_id_row = mysqli_fetch_assoc($user_id_result)) {
            $user_id_to_delete = $user_id_row['user_id'];
            $delete_user_query = "DELETE FROM users WHERE id = '$user_id_to_delete'";
            mysqli_query($con, $delete_user_query); // Don't check result, deletion might not be required.
        }
        header("Location: manage_job_seekers.php"); // Redirect to the job seekers list page
        exit();
    } else {
        echo "Error deleting job seeker: " . mysqli_error($con);
    }
}


// Handle update functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $edit_user_id = $_POST['edit_user_id'];  // Get the user_id from the form.

    $edit_resume = $_POST['edit_resume'] ?? '';

    //users table fields
    $edit_full_name = $_POST['edit_full_name'] ?? '';
    $edit_user_name = $_POST['edit_user_name'] ?? '';
    $edit_email = $_POST['edit_email'] ?? '';
    $edit_gender = $_POST['edit_gender'] ?? '';
    $edit_phone = $_POST['edit_phone'] ?? '';
    $edit_birthday = $_POST['edit_birthday'] ?? '';
    $edit_aadhar = $_POST['edit_aadhar'] ?? '';
    $edit_qualification = $_POST['edit_qualification'] ?? '';
    $edit_address = $_POST['edit_address'] ?? '';
    $edit_state = $_POST['edit_state'] ?? '';
    $edit_district = $_POST['edit_district'] ?? '';
    $edit_pincode = $_POST['edit_pincode'] ?? '';


    // Handle resume upload (similar to the previous example)
    $resumeFileName = ''; // Initialize
    if ($_FILES['edit_resume_file']['error'] == UPLOAD_ERR_OK) {
        $tempFilePath = $_FILES['edit_resume_file']['tmp_name'];
        $resumeFileName = uniqid() . '_' . basename($_FILES['edit_resume_file']['name']);
        $destinationPath = 'uploads/' . $resumeFileName;  // Use the 'uploads/' directory
        if (move_uploaded_file($tempFilePath, $destinationPath)) {
            // File was moved successfully.
        } else {
            echo "Failed to move uploaded file.";
            $resumeFileName = $_POST['old_resume']; // Keep old name
        }
    } else if ($_FILES['edit_resume_file']['error'] == UPLOAD_ERR_NO_FILE) {
        $resumeFileName = $_POST['old_resume']; // Keep the old resume filename
    } else {
        echo "File upload error: " . $_FILES['edit_resume_file']['error'];
        $resumeFileName = $_POST['old_resume']; // Keep the old name
    }


    // Update job_seekers table
    $update_jobseeker_query = "UPDATE job_seekers SET resume = '$resumeFileName' WHERE id = '$edit_id'";
    if (mysqli_query($con, $update_jobseeker_query)) {
        // Update successful
    } else {
        echo "Error updating job seeker: " . mysqli_error($con);
    }

    //update users table
    $update_users_query = "UPDATE users SET
        full_name = '$edit_full_name',
        user_name = '$edit_user_name',
        email = '$edit_email',
        gender = '$edit_gender',
        phone = '$edit_phone',
        birthday = '$edit_birthday',
        aadhar = '$edit_aadhar',
        qualification = '$edit_qualification',
        address = '$edit_address',
        state = '$edit_state',
        district = '$edit_district',
        pincode = '$edit_pincode'
        WHERE id = '$edit_user_id'";

    if(mysqli_query($con,$update_users_query)){
        header("Location: manage_job_seekers.php");
        exit();
    }else{
        echo "Error updating users table: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>View Job Seekers</title>

    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/search.js"></script>
    <style>
    .info-icon {
        cursor: pointer;
    }
    </style>
</head>

<body id="page-top">
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

        <div class="container-fluid">

            <h1 class="h3 mb-4 text-gray-800">View Job Seekers</h1>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Job Seekers List</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Full Name</th>
                                    <th>Resume</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM job_seekers";
                                $result = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $user_id = $row['user_id'];
                                    $user_data = getUserData($con, $user_id); // Get user data
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td>{$user_id}</td>";
                                    echo "<td>" . ($user_data ? $user_data['full_name'] : 'N/A') . "</td>"; // Display full name
                                    echo "<td>{$row['resume']}</td>";
                                    echo "<td>
                                            <i class='fas fa-info-circle text-primary info-icon'
                                                data-toggle='modal' data-target='#infoModal'
                                                data-id='{$row['id']}'
                                                data-user_id='{$user_id}'
                                                data-resume='{$row['resume']}'";
                                                if ($user_data) {
                                                    echo "
                                                        data-full_name='{$user_data['full_name']}'
                                                        data-user_name='{$user_data['user_name']}'
                                                        data-email='{$user_data['email']}'
                                                        data-gender='{$user_data['gender']}'
                                                        data-phone='{$user_data['phone']}'
                                                        data-birthday='{$user_data['birthday']}'
                                                        data-pic='{$user_data['pic']}'
                                                        data-aadhar='{$user_data['aadhar']}'
                                                        data-qualification='{$user_data['qualification']}'
                                                        data-address='{$user_data['address']}'
                                                        data-state='{$user_data['state']}'
                                                        data-district='{$user_data['district']}'
                                                        data-pincode='{$user_data['pincode']}'
                                                    ";
                                                }
                                            echo ">
                                            </i>
                                            <button class='btn btn-primary btn-sm editBtn'
                                                data-toggle='modal' data-target='#editModal'
                                                data-id='{$row['id']}'
                                                data-user_id='{$user_id}'
                                                data-resume='{$row['resume']}'";
                                                if ($user_data) {
                                                    echo "
                                                        data-full_name='{$user_data['full_name']}'
                                                        data-user_name='{$user_data['user_name']}'
                                                        data-email='{$user_data['email']}'
                                                        data-gender='{$user_data['gender']}'
                                                        data-phone='{$user_data['phone']}'
                                                        data-birthday='{$user_data['birthday']}'
                                                        data-pic='{$user_data['pic']}'
                                                        data-aadhar='{$user_data['aadhar']}'
                                                        data-qualification='{$user_data['qualification']}'
                                                        data-address='{$user_data['address']}'
                                                        data-state='{$user_data['state']}'
                                                        data-district='{$user_data['district']}'
                                                        data-pincode='{$user_data['pincode']}'
                                                    ";
                                                }
                                            echo ">
                                                Edit
                                            </button>
                                            <a href='manage_job_seekers.php?delete_id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                                        </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        </div>
    <?php
    include_once('footer.php');
    ?>

    </div>
    </div>
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
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-success"
                        href="http://localhost/worklink/admin/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Job Seeker Information</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>ID:</strong> <span id="info_id"></span></p>
                            <p><strong>User ID:</strong> <span id="info_user_id"></span></p>
                            <p><strong>Full Name:</strong> <span id="info_full_name"></span></p>
                            <p><strong>User Name:</strong> <span id="info_user_name"></span></p>
                            <p><strong>Email:</strong> <span id="info_email"></span></p>
                            <p><strong>Gender:</strong> <span id="info_gender"></span></p>
                            <p><strong>Phone:</strong> <span id="info_phone"></span></p>
                            <p><strong>Birthday:</strong> <span id="info_birthday"></span></p>
                            <p><strong>Aadhar:</strong> <span id="info_aadhar"></span></p>
                            <p><strong>Qualification:</strong> <span id="info_qualification"></span></p>

                        </div>
                        <div class="col-md-6">
                            <p><strong>Address:</strong> <span id="info_address"></span></p>
                            <p><strong>State:</strong> <span id="info_state"></span></p>
                            <p><strong>District:</strong> <span id="info_district"></span></p>
                            <p><strong>Pincode:</strong> <span id="info_pincode"></span></p>
                            <p><strong>Resume:</strong>
                                <a id="info_resume_download" href="#" class="btn btn-sm btn-info" target="_blank">Download</a>
                            </p>
                            <p><strong>Profile Picture:</strong></p>
                            <img id="info_pic" src="" alt="Profile Picture" style="width: 150px; height: auto;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Job Seeker</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="manage_job_seekers.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body row">
                        <div class="col-md-6">
                            <input type="hidden" class="form-control" id="edit_id" name="edit_id">
                            <input type="hidden" class="form-control" id="edit_user_id" name="edit_user_id">
                            <div class="form-group">
                                <label for="edit_full_name">Full Name</label>
                                <input type="text" class="form-control" id="edit_full_name" name="edit_full_name">
                            </div>
                            <div class="form-group">
                                <label for="edit_user_name">User Name</label>
                                <input type="text" class="form-control" id="edit_user_name" name="edit_user_name">
                            </div>
                            <div class="form-group">
                                <label for="edit_email">Email</label>
                                <input type="email" class="form-control" id="edit_email" name="edit_email">
                            </div>
                             <div class="form-group">
                                <label for="edit_gender">Gender</label>
                                 <select class="form-control" id="edit_gender" name="edit_gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_phone">Phone</label>
                                <input type="text" class="form-control" id="edit_phone" name="edit_phone">
                            </div>
                            <div class="form-group">
                                <label for="edit_birthday">Birthday</label>
                                <input type="date" class="form-control" id="edit_birthday" name="edit_birthday">
                            </div>

                            <div class="form-group">
                                <label for="edit_aadhar">Aadhar</label>
                                <input type="text" class="form-control" id="edit_aadhar" name="edit_aadhar">
                            </div>
                            <div class="form-group">
                                <label for="edit_qualification">Qualification</label>
                                <input type="text" class="form-control" id="edit_qualification" name="edit_qualification">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_address">Address</label>
                                <input type="text" class="form-control" id="edit_address" name="edit_address">
                            </div>
                            <div class="form-group">
                                <label for="edit_state">State</label>
                                <input type="text" class="form-control" id="edit_state" name="edit_state">
                            </div>
                            <div class="form-group">
                                <label for="edit_district">District</label>
                                <input type="text" class="form-control" id="edit_district" name="edit_district">
                            </div>
                            <div class="form-group">
                                <label for="edit_pincode">Pincode</label>
                                <input type="text" class="form-control" id="edit_pincode" name="edit_pincode">
                            </div>
                            <div class="form-group">
                                <label for="edit_resume">Resume</label>
                                <input type="file" class="form-control-file" id="edit_resume_file" name="edit_resume_file" accept=".pdf,.doc,.docx">
                                 <input type="hidden"  id="old_resume" name="old_resume">
                            </div>
                            <div class="form-group">
                                <label for="edit_pic">Profile Picture</label>
                                <input type="file" class="form-control-file" id="edit_pic" name="edit_pic" accept="image/*">
                                <input type="hidden" id="old_pic" name="old_pic">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
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

    <script>
    $(document).ready(function() {
        $('.info-icon').click(function() {
            var id = $(this).data('id');
            var user_id = $(this).data('user_id');
            var full_name = $(this).data('full_name');
            var user_name = $(this).data('user_name');
            var email = $(this).data('email');
            var gender = $(this).data('gender');
            var phone = $(this).data('phone');
            var birthday = $(this).data('birthday');
            var pic = $(this).data('pic');
            var resume = $(this).data('resume');
            var aadhar = $(this).data('aadhar');
            var qualification = $(this).data('qualification');
            var address = $(this).data('address');
            var state = $(this).data('state');
            var district = $(this).data('district');
            var pincode = $(this).data('pincode');


            $('#info_id').text(id);
            $('#info_user_id').text(user_id);
            $('#info_full_name').text(full_name);
            $('#info_user_name').text(user_name);
            $('#info_email').text(email);
            $('#info_gender').text(gender);
            $('#info_phone').text(phone);
            $('#info_birthday').text(birthday);
            $('#info_pic').attr('src', 'img/Uploads/' + pic);
            $('#info_resume_download').attr('href', '../uploads/resumes/' + resume);
            $('#info_aadhar').text(aadhar);
            $('#info_qualification').text(qualification);
            $('#info_address').text(address);
            $('#info_state').text(state);
            $('#info_district').text(district);
            $('#info_pincode').text(pincode);
            $('#infoModal').modal('show');
        });



        $('.editBtn').click(function() {
            var id = $(this).data('id');
            var user_id = $(this).data('user_id');
            var full_name = $(this).data('full_name');
            var user_name = $(this).data('user_name');
            var email = $(this).data('email');
            var gender = $(this).data('gender');
            var phone = $(this).data('phone');
            var birthday = $(this).data('birthday');
            var pic = $(this).data('pic');
            var resume = $(this).data('resume');
             var aadhar = $(this).data('aadhar');
            var qualification = $(this).data('qualification');
            var address = $(this).data('address');
            var state = $(this).data('state');
            var district = $(this).data('district');
            var pincode = $(this).data('pincode');


            $('#edit_id').val(id);
            $('#edit_user_id').val(user_id);
            $('#edit_full_name').val(full_name);
            $('#edit_user_name').val(user_name);
            $('#edit_email').val(email);
            $('#edit_gender').val(gender);
            $('#edit_phone').val(phone);
            $('#edit_birthday').val(birthday);
            $('#edit_pic').attr('src', 'img/Uploads/' + pic);
            $('#edit_resume').val(resume);
            $('#edit_aadhar').val(aadhar);
            $('#edit_qualification').val(qualification);
            $('#edit_address').val(address);
            $('#edit_state').val(state);
            $('#edit_district').val(district);
            $('#edit_pincode').val(pincode);
            $('#old_resume').val(resume);
            $('#old_pic').val(pic);

            $('#editModal').modal('show');
        });
    });
    </script>

</body>

</html>
