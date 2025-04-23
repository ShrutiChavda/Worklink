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

    // 1. Get user_id first
    $get_user_id_query = "SELECT user_id FROM government_officials WHERE id = ?";
    $stmt_get_user_id = mysqli_prepare($con, $get_user_id_query);
    mysqli_stmt_bind_param($stmt_get_user_id, "i", $delete_id);
    mysqli_stmt_execute($stmt_get_user_id);
    $user_id_result = mysqli_stmt_get_result($stmt_get_user_id);

    if ($user_id_result && $user_id_row = mysqli_fetch_assoc($user_id_result)) {
        $user_id_to_delete = $user_id_row['user_id'];
        
        // 2. Delete from government_officials table
        $delete_official_query = "DELETE FROM government_officials WHERE id = ?";
        $stmt_delete_official = mysqli_prepare($con, $delete_official_query);
        mysqli_stmt_bind_param($stmt_delete_official, "i", $delete_id);
        mysqli_stmt_execute($stmt_delete_official);
        mysqli_stmt_close($stmt_delete_official);

        // 3. Delete from users table
        $delete_user_query = "DELETE FROM users WHERE id = ?";
        $stmt_delete_user = mysqli_prepare($con, $delete_user_query);
        mysqli_stmt_bind_param($stmt_delete_user, "i", $user_id_to_delete);
        mysqli_stmt_execute($stmt_delete_user);
        mysqli_stmt_close($stmt_delete_user);
    }
    mysqli_stmt_close($stmt_get_user_id);
    header("Location: manage_officials.php");
    exit();
}

// Handle update functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_official_id'])) {
    $edit_official_id = $_POST['edit_official_id'];
    $edit_user_id = $_POST['edit_user_id'];
    $edit_department = $_POST['edit_department'];
    $edit_designation = $_POST['edit_designation'];
    $edit_full_name = $_POST['edit_full_name'];
    $edit_email = $_POST['edit_email'];
    $edit_phone = $_POST['edit_phone'];

    $update_official_query = "UPDATE government_officials SET department = ?, designation = ? WHERE id = ?";
    $stmt_update_official = mysqli_prepare($con, $update_official_query);
    mysqli_stmt_bind_param($stmt_update_official, "ssi", $edit_department, $edit_designation, $edit_official_id);
    mysqli_stmt_execute($stmt_update_official);
    mysqli_stmt_close($stmt_update_official);

    $update_user_query = "UPDATE users SET full_name = ?, email = ?, phone = ? WHERE id = ?";
    $stmt_update_user = mysqli_prepare($con, $update_user_query);
    mysqli_stmt_bind_param($stmt_update_user, "sssi", $edit_full_name, $edit_email, $edit_phone, $edit_user_id);
    mysqli_stmt_execute($stmt_update_user);
    mysqli_stmt_close($stmt_update_user);

    header("Location: manage_officials.php");
    exit();
}

// Handle add functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_official'])) {
    $add_user_type = 'governmentOfficial';
    $add_full_name = $_POST['add_full_name'];
    $add_user_name = $_POST['add_user_name'];
    $add_email = $_POST['add_email'];
    $add_gender = $_POST['add_gender'];
    $add_phone = $_POST['add_phone'];
    $add_birthday = $_POST['add_birthday'];
    $add_password = password_hash($_POST['add_password'], PASSWORD_DEFAULT);
    $add_department = $_POST['add_department'];
    $add_designation = $_POST['add_designation'];

    $insert_user_query = "INSERT INTO users (user_type, full_name, user_name, email, gender, phone, birthday, password, status, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'active', '')";
    $stmt_insert_user = mysqli_prepare($con, $insert_user_query);
    mysqli_stmt_bind_param($stmt_insert_user, "ssssssss", $add_user_type, $add_full_name, $add_user_name, $add_email, $add_gender, $add_phone, $add_birthday, $add_password);

    if (mysqli_stmt_execute($stmt_insert_user)) {
        $new_user_id = mysqli_insert_id($con);
        $insert_official_query = "INSERT INTO government_officials (user_id, department, designation) VALUES (?, ?, ?)";
        $stmt_insert_official = mysqli_prepare($con, $insert_official_query);
        mysqli_stmt_bind_param($stmt_insert_official, "iss", $new_user_id, $add_department, $add_designation);
        mysqli_stmt_execute($stmt_insert_official);
        mysqli_stmt_close($stmt_insert_official);
    }
    mysqli_stmt_close($stmt_insert_user);
    header("Location: manage_officials.php");
    exit();
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

    <title>Manage Government Officials</title>

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

            <h1 class="h3 mb-4 text-gray-800">Manage Government Officials</h1>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Government Officials List</h6>
                </div>
                <div class="card-body">
                    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addOfficialModal">
                        <i class="fas fa-plus"></i> Add New Official
                    </button>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT go.id, go.user_id, go.department, go.designation, u.full_name, u.email
                                          FROM government_officials go
                                          INNER JOIN users u ON go.user_id = u.id";
                                $result = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td>{$row['user_id']}</td>";
                                    echo "<td>{$row['full_name']}</td>";
                                    echo "<td>{$row['email']}</td>";
                                    echo "<td>{$row['department']}</td>";
                                    echo "<td>{$row['designation']}</td>";
                                    echo "<td>
                                            <i class='fas fa-info-circle text-primary info-icon'
                                                data-toggle='modal' data-target='#infoModal'
                                                data-id='{$row['id']}'
                                                data-user_id='{$row['user_id']}'
                                                data-full_name='{$row['full_name']}'
                                                data-email='{$row['email']}'
                                                data-department='{$row['department']}'
                                                data-designation='{$row['designation']}'>";
                                                $user_data = getUserData($con, $row['user_id']);
                                                if ($user_data) {
                                                    echo "
                                                        data-user_name='{$user_data['user_name']}'
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
                                            echo "</i>
                                            <button class='btn btn-primary btn-sm editBtn'
                                                data-toggle='modal' data-target='#editOfficialModal'
                                                data-official_id='{$row['id']}'
                                                data-user_id='{$row['user_id']}'
                                                data-department='{$row['department']}'
                                                data-designation='{$row['designation']}'
                                                data-full_name='{$row['full_name']}'
                                                data-email='{$row['email']}'";
                                                if ($user_data) {
                                                    echo "
                                                        data-phone='{$user_data['phone']}'
                                                    ";
                                                }
                                            echo ">
                                                Edit
                                            </button>
                                            <a href='manage_officials.php?delete_id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this official?');\">Delete</a>
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
                    <a class="btn btn-success" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Government Official Information</h5>
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
                            <p><strong>Email:</strong> <span id="info_email"></span></p>
                            <p><strong>Department:</strong> <span id="info_department"></span></p>
                            <p><strong>Designation:</strong> <span id="info_designation"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>User Name:</strong> <span id="info_user_name"></span></p>
                            <p><strong>Gender:</strong> <span id="info_gender"></span></p>
                            <p><strong>Phone:</strong> <span id="info_phone"></span></p>
                            <p><strong>Birthday:</strong> <span id="info_birthday"></span></p>
                            <p><strong>Profile Picture:</strong></p>
                            <img id="info_pic" src="img/Uploads/" alt="Profile Picture" style="width: 100px; height: auto;">
                            <p><strong>Aadhar:</strong> <span id="info_aadhar"></span></p>
                            <p><strong>Qualification:</strong> <span id="info_qualification"></span></p>
                            <p><strong>Address:</strong> <span id="info_address"></span></p>
                            <p><strong>State:</strong> <span id="info_state"></span></p>
                            <p><strong>District:</strong> <span id="info_district"></span></p>
                            <p><strong>Pincode:</strong> <span id="info_pincode"></span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

     <!-- Add Official Modal -->
     <div class="modal fade" id="addOfficialModal" tabindex="-1" role="dialog" aria-labelledby="addOfficialModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <form method="POST">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add Government Official</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
              </div>
              <div class="modal-body">
                <!-- Add form fields -->
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Full Name</label>
                    <input type="text" name="add_full_name" class="form-control" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Username</label>
                    <input type="text" name="add_user_name" class="form-control" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="email" name="add_email" class="form-control" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Phone</label>
                    <input type="text" name="add_phone" class="form-control" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Gender</label>
                    <select name="add_gender" class="form-control" required>
                      <option value="">Select Gender</option>
                      <option>Male</option>
                      <option>Female</option>
                      <option>Other</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Birthday</label>
                    <input type="date" name="add_birthday" class="form-control" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Password</label>
                    <input type="password" name="add_password" class="form-control" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Department</label>
                    <input type="text" name="add_department" class="form-control" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Designation</label>
                    <input type="text" name="add_designation" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="add_official" class="btn btn-success">Add Official</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
            </div>
        </form>
      </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editOfficialModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <form method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Official</h5>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="edit_official_id" id="edit_official_id">
              <input type="hidden" name="edit_user_id" id="edit_user_id">
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="edit_full_name" id="edit_full_name" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="edit_email" id="edit_email" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Phone</label>
                <input type="text" name="edit_phone" id="edit_phone" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Department</label>
                <input type="text" name="edit_department" id="edit_department" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Designation</label>
                <input type="text" name="edit_designation" id="edit_designation" class="form-control" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Update</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Scripts -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();

            // Edit button handler
            $('.editBtn').on('click', function () {
                $('#edit_official_id').val($(this).data('official_id'));
                $('#edit_user_id').val($(this).data('user_id'));
                $('#edit_full_name').val($(this).data('full_name'));
                $('#edit_email').val($(this).data('email'));
                $('#edit_phone').val($(this).data('phone'));
                $('#edit_department').val($(this).data('department'));
                $('#edit_designation').val($(this).data('designation'));
            });
        });
    </script>