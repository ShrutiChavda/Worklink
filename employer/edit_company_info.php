<?php
include('session.php');
include('connection.php');

// Handle delete functionality
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM employers WHERE id = '$delete_id'";
    if (mysqli_query($con, $delete_query)) {
        header("Location: edit_company_info.php"); // Redirect to the correct page
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}

// Handle update functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $company_name = $_POST['company_name'] ?? '';
    $industry = $_POST['industry'] ?? '';
    $company_email = $_POST['company_email'] ?? '';
    $company_phone = $_POST['company_phone'] ?? '';
    $company_address = $_POST['company_address'] ?? '';
    $company_city = $_POST['company_city'] ?? '';
    $company_state = $_POST['company_state'] ?? '';
    $company_pincode = $_POST['company_pincode'] ?? '';
    $website = $_POST['website'] ?? '';
    $description = $_POST['description'] ?? '';

    $update_query = "UPDATE employers SET
        company_name = '$company_name',
        industry = '$industry',
        company_email = '$company_email',
        company_phone = '$company_phone',
        company_address = '$company_address',
        company_city = '$company_city',
        company_state = '$company_state',
        company_pincode = '$company_pincode',
        website = '$website',
        description = '$description'
    WHERE id = '$edit_id'";

    if (mysqli_query($con, $update_query)) {
        header("Location: edit_company_info.php"); // Redirect to the correct page
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Company Info</title> <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/search.js"></script>
</head>

<body id="page-top">
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Company Information</h1> <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Your Company Details</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>User ID</th>
                                <th>Company Name</th>
                                <th>Industry</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $user_id = $_SESSION['user_id']; // Assuming you want to edit the logged-in employer's info
                            $query = "SELECT * FROM employers WHERE user_id = '$user_id'";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>{$row['id']}</td>";
                                echo "<td>{$row['user_id']}</td>";
                                echo "<td>{$row['company_name']}</td>";
                                echo "<td>{$row['industry']}</td>";
                                echo "<td>{$row['company_email']}</td>";
                                echo "<td>{$row['company_phone']}</td>";
                                echo "<td>{$row['company_city']}</td>";
                                echo "<td>{$row['company_state']}</td>";
                                echo "<td>
                                        <button class='btn btn-primary btn-sm editBtn'
                                                data-toggle='modal' data-target='#editModal'
                                                data-id='{$row['id']}'
                                                data-user_id='{$row['user_id']}'
                                                data-company_name='{$row['company_name']}'
                                                data-industry='{$row['industry']}'
                                                data-company_email='{$row['company_email']}'
                                                data-company_phone='{$row['company_phone']}'
                                                data-company_address='{$row['company_address']}'
                                                data-company_city='{$row['company_city']}'
                                                data-company_state='{$row['company_state']}'
                                                data-company_pincode='{$row['company_pincode']}'
                                                data-website='{$row['website']}'
                                                data-description='" . htmlspecialchars($row['description'] ?? '') . "'>
                                            Edit</button>
                                        <a href='edit_company_info.php?delete_id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
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

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Company Details</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="edit_company_info.php" method="POST">
                    <div class="modal-body row">
                        <input type="hidden" class="form-control" id="edit_id" name="edit_id">
                        <div class="form-group col-md-6">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control" id="edit_company_name" name="company_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="industry">Industry</label>
                            <input type="text" class="form-control" id="edit_industry" name="industry">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="company_email">Company Email</label>
                            <input type="email" class="form-control" id="edit_company_email" name="company_email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="company_phone">Company Phone</label>
                            <input type="text" class="form-control" id="edit_company_phone" name="company_phone">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="company_address">Company Address</label>
                            <input type="text" class="form-control" id="edit_company_address" name="company_address">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="company_city">Company City</label>
                            <input type="text" class="form-control" id="edit_company_city" name="company_city">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="company_state">Company State</label>
                            <input type="text" class="form-control" id="edit_company_state" name="company_state">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="company_pincode">Company Pincode</label>
                            <input type="text" class="form-control" id="edit_company_pincode" name="company_pincode">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="website">Website</label>
                            <input type="url" class="form-control" id="edit_website" name="website">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="edit_description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include_once('footer.php'); ?>

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
                    <a class="btn btn-success" href="http://localhost/worklink/employer/logout.php">Logout</a> </div>
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
        $(document).ready(function () {
            $('.editBtn').click(function () {
                $('#edit_id').val($(this).data('id'));
                $('#edit_user_id').val($(this).data('user_id'));
                $('#edit_company_name').val($(this).data('company_name'));
                $('#edit_industry').val($(this).data('industry'));
                $('#edit_company_email').val($(this).data('company_email'));
                $('#edit_company_phone').val($(this).data('company_phone'));
                $('#edit_company_address').val($(this).data('company_address'));
                $('#edit_company_city').val($(this).data('company_city'));
                $('#edit_company_state').val($(this).data('company_state'));
                $('#edit_company_pincode').val($(this).data('company_pincode'));
                $('#edit_website').val($(this).data('website'));
                $('#edit_description').val($(this).data('description'));
                $('#editModal').modal('show');
            });
        });
    </script>

</body>

</html>