<?php
include('session.php');
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_grant'])) {
    $user_id = $_SESSION['user_id']; 

    $check_query = "SELECT go.id FROM users u 
                    JOIN government_officials go ON u.id = go.user_id
                    WHERE u.id = '$user_id'"; 
    $result = mysqli_query($con, $check_query);

    if (!$result) {
        die("Error executing query: " . mysqli_error($con)); 
    }

    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        echo "Error: The user ID does not correspond to any official in the government_officials table.";
        exit;
    }

    $official_id = $row['id']; 

    $grant_name = mysqli_real_escape_string($con, $_POST['grant_name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $amount = floatval($_POST['amount']);

    $query = "INSERT INTO grants (official_id, grant_name, description, amount) VALUES ('$official_id', '$grant_name', '$description', '$amount')";
    if (mysqli_query($con, $query)) {
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grant_id = intval($_POST['grant_id']);
    if (isset($_POST['approve'])) {
        mysqli_query($con, "UPDATE grants SET status='Approved' WHERE grant_id=$grant_id");
    } elseif (isset($_POST['reject'])) {
        mysqli_query($con, "UPDATE grants SET status='Rejected' WHERE grant_id=$grant_id");
    }
    echo "<meta http-equiv='refresh' content='0'>";
    exit;
}

$grants = mysqli_query($con, "SELECT * FROM grants ORDER BY created_at DESC");

$total_grants_query = "SELECT COUNT(*) as total FROM grants";
$approved_grants_query = "SELECT COUNT(*) as approved FROM grants WHERE status = 'Approved'";
$pending_grants_query = "SELECT COUNT(*) as pending FROM grants WHERE status = 'Pending'";
$rejected_grants_query = "SELECT COUNT(*) as rejected FROM grants WHERE status = 'Rejected'";

$total_result = mysqli_query($con, $total_grants_query);
$approved_result = mysqli_query($con, $approved_grants_query);
$pending_result = mysqli_query($con, $pending_grants_query);
$rejected_result = mysqli_query($con, $rejected_grants_query);

$total_grants = mysqli_fetch_assoc($total_result)['total'];
$approved_grants = mysqli_fetch_assoc($approved_result)['approved'];
$pending_grants = mysqli_fetch_assoc($pending_result)['pending'];
$rejected_grants = mysqli_fetch_assoc($rejected_result)['rejected'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Grant Distribution</title>
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .modal-body {
            overflow-x: auto;
        }
    </style>
</head>
<body id="page-top">
    <?php include('sidebar.php'); ?>
    <?php include('header.php'); ?>

    <div class="container-fluid px-3">
        <h1 class="h3 mb-4 text-gray-800">Grant Distribution</h1>

<!-- Quick Stats Section -->
<div class="row">
    <!-- Card 1: Total Grants -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Grants</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_grants; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Approved Grants -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Approved Grants</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $approved_grants; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: Pending Grants -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Grants</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $pending_grants; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 4: Rejected Grants -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Rejected Grants</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $rejected_grants; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Add Grant Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New Grant</h6>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="grant_name">Grant Name</label>
                        <input type="text" name="grant_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" class="form-control" step="0.01" required>
                    </div>
                    <button type="submit" name="add_grant" class="btn btn-primary">Add Grant</button>
                </form>
            </div>
        </div>

        <!-- Display Grants Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Submitted Grants</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="grantTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Grant Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($grants) > 0) {
                                while ($row = mysqli_fetch_assoc($grants)) {
                                    $grant_id = $row['grant_id'];
                                    $grant_name = $row['grant_name'] ?? 'N/A';
                                    $official_id = $row['official_id'] ?? 'N/A';
                                    $amount = $row['amount'] ?? 0;
                                    $status = $row['status'] ?? 'Pending';
                                    $description = $row['description'] ?? 'No description available';

                                    $official_query = mysqli_query($con, "SELECT u.full_name, u.email, g.department, g.designation 
                                                                          FROM users u 
                                                                          JOIN government_officials g ON u.id = g.user_id 
                                                                          WHERE g.id = $official_id");
                                    $official_info = mysqli_fetch_assoc($official_query);
                                    $official_name = $official_info['full_name'] ?? 'N/A';
                                    $official_email = $official_info['email'] ?? 'N/A';
                                    $department = $official_info['department'] ?? 'N/A';
                                    $designation = $official_info['designation'] ?? 'N/A';

                                    $badgeClass = match (strtolower($status)) {
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        'pending' => 'warning',
                                        default => 'secondary'
                                    };

                                    echo "<tr>
                                        <td>{$grant_id}</td>
                                        <td>{$grant_name}</td>
                                        <td>₹" . number_format($amount, 2) . "</td>
                                        <td><span class='badge badge-{$badgeClass}'>" . ucfirst($status) . "</span></td>
                                        <td>
                                            <button class='btn btn-info btn-sm' data-toggle='modal' data-target='#infoModal{$grant_id}'>Info</button>
                                        </td>
                                    </tr>";

                                    echo "
                                    <div class='modal fade' id='infoModal{$grant_id}' tabindex='-1' role='dialog'>
                                        <div class='modal-dialog modal-dialog-scrollable modal-lg' role='document'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title'>Grant Details</h5>
                                                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                                                </div>
                                                <form method='POST'>
                                                    <input type='hidden' name='grant_id' value='{$grant_id}'>
                                                    <div class='modal-body'>
                                                        <h5 class='text-primary mb-3'>📘 Grant Info</h5>
                                                        <ul class='list-group mb-3'>
                                                            <li class='list-group-item'><strong>Grant Name:</strong> {$grant_name}</li>
                                                            <li class='list-group-item'><strong>Description:</strong> {$description}</li>
                                                            <li class='list-group-item'><strong>Official ID:</strong> {$official_id}</li>
                                                            <li class='list-group-item'><strong>Amount:</strong> ₹" . number_format($amount, 2) . "</li>
                                                            <li class='list-group-item'><strong>Status:</strong> <span class='badge badge-{$badgeClass}'>" . ucfirst($status) . "</span></li>
                                                            <li class='list-group-item'><strong>Official Name:</strong> {$official_name}</li>
                                                            <li class='list-group-item'><strong>Official Email:</strong> {$official_email}</li>
                                                            <li class='list-group-item'><strong>Department:</strong> {$department}</li>
                                                            <li class='list-group-item'><strong>Designation:</strong> {$designation}</li>
                                                        </ul>
                                                    </div>
                                                    <div class='modal-footer flex-column flex-md-row justify-content-center'>
                                                        <button type='submit' name='approve' class='btn btn-success m-1 w-100 w-md-auto'>Approve</button>
                                                        <button type='submit' name='reject' class='btn btn-danger m-1 w-100 w-md-auto'>Reject</button>
                                                        <button type='button' class='btn btn-secondary m-1 w-100 w-md-auto' data-dismiss='modal'>Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>No grants submitted yet.</td></tr>";
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
            $('#grantTable').DataTable();
        });
    </script>
</body>
</html>
