<?php include('session.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employers</title>

    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
</head>

<body id="page-top">
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Employers</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Aadhar</th>
                            <th>Qualification</th>
                            <th>Address</th>
                            <th>State</th>
                            <th>District</th>
                            <th>Pincode</th>
                            <th>Company Name</th>
                            <th>Industry</th>
                            <th>Company Email</th>
                            <th>Company Phone</th>
                            <th>Company Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Pincode</th>
                            <th>Website</th>
                            <th>Description</th>
                            <th>Job Description File</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('connection.php');
                        $query = "SELECT u.*, e.* FROM users u INNER JOIN employers e ON u.id = e.user_id WHERE u.user_type='employer'";
                        $result = mysqli_query($con, $query);
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$count}</td>
                                <td>{$row['full_name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['gender']}</td>
                                <td>{$row['birthday']}</td>
                                <td>{$row['aadhar']}</td>
                                <td>{$row['qualification']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['state']}</td>
                                <td>{$row['district']}</td>
                                <td>{$row['pincode']}</td>
                                <td>{$row['company_name']}</td>
                                <td>{$row['industry']}</td>
                                <td>{$row['company_email']}</td>
                                <td>{$row['company_phone']}</td>
                                <td>{$row['company_address']}</td>
                                <td>{$row['company_city']}</td>
                                <td>{$row['company_state']}</td>
                                <td>{$row['company_pincode']}</td>
                                <td>{$row['website']}</td>
                                <td>{$row['description']}</td>
                                <td><a href='../employer/uploads/jds/{$row['jd_file']}' target='_blank'>View JD</a></td>
                                <td>
                                    <a href='#' class='btn btn-sm btn-primary edit-btn'
                                        data-id='{$row['user_id']}'
                                        data-fullname='{$row['full_name']}'
                                        data-email='{$row['email']}'
                                        data-phone='{$row['phone']}'
                                        data-company='{$row['company_name']}'
                                        title='Edit'><i class='fas fa-edit'></i></a>
                                    <a href='manage_employers.php?id={$row['user_id']}' class='btn btn-sm btn-danger' title='Delete' onclick=\"return confirm('Are you sure you want to delete this employer?');\"><i class='fas fa-trash-alt'></i></a>
                                </td>
                            </tr>";
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit Employer Modal -->
<div class="modal fade" id="editEmployerModal" tabindex="-1" role="dialog" aria-labelledby="editEmployerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="manage_employers.php" method="POST" id="editEmployerForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Employer</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" name="user_id" id="edit_user_id">
                    <div class="form-group col-md-6">
                        <label>Full Name</label>
                        <input type="text" class="form-control" name="full_name" id="edit_full_name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="edit_email">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" id="edit_phone">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Company Name</label>
                        <input type="text" class="form-control" name="company_name" id="edit_company_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update_employer" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include_once('footer.php'); ?>

<!-- Scripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();

        $('.edit-btn').click(function () {
            $('#edit_user_id').val($(this).data('id'));
            $('#edit_full_name').val($(this).data('fullname'));
            $('#edit_email').val($(this).data('email'));
            $('#edit_phone').val($(this).data('phone'));
            $('#edit_company_name').val($(this).data('company'));
            $('#editEmployerModal').modal('show');
        });
    });
</script>

</body>
</html>
