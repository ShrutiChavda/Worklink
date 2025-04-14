<?php 
include('session.php'); 
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    if (isset($_POST['approve'])) {
        mysqli_query($con, "UPDATE training_programs SET status='Approved' WHERE id=$id");
    } elseif (isset($_POST['reject'])) {
        mysqli_query($con, "UPDATE training_programs SET status='Rejected' WHERE id=$id");
    }
    echo "<meta http-equiv='refresh' content='0'>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Approve Training Programs</title>
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
                <h1 class="h3 mb-4 text-gray-800">Approve Training Programs</h1>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Submitted Training Programs</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="trainingTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Program Name</th>
                                        <th>Provider</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "
                                        SELECT tp.id, tp.course_name, tp.description, tp.duration, tp.status, tp.created_at,
                                            tpv.organization_name, tpv.registration_number, tpv.head_office_location, tpv.training_sectors,
                                            u.full_name, u.email, u.phone
                                        FROM training_programs tp
                                        INNER JOIN training_providers tpv ON tp.provider_id = tpv.id
                                        LEFT JOIN users u ON tpv.user_id = u.id
                                        ORDER BY tp.created_at DESC
                                    ";
                                    $result = mysqli_query($con, $query);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id       = $row['id'];
                                            $progName = $row['course_name'] ?? 'N/A';
                                            $desc     = $row['description'] ?? 'N/A';
                                            $dur      = $row['duration'] ?? 0;
                                            $status   = $row['status'] ?? 'Pending';

                                            $orgName  = $row['organization_name'] ?? 'N/A';
                                            $regNum   = $row['registration_number'] ?? 'N/A';
                                            $headLoc  = $row['head_office_location'] ?? 'N/A';
                                            $sectors  = $row['training_sectors'] ?? 'N/A';

                                            $fullname = $row['full_name'] ?? 'N/A';
                                            $email    = $row['email'] ?? 'N/A';
                                            $phone    = $row['phone'] ?? 'N/A';
                                            $created  = $row['created_at'] ?? 'N/A';

                                            $badgeClass = match (strtolower($status)) {
                                                'approved' => 'success',
                                                'rejected' => 'danger',
                                                'pending'  => 'warning',
                                                default    => 'secondary'
                                            };

                                            echo "<tr>
                                                <td>{$id}</td>
                                                <td>{$progName}</td>
                                                <td>{$orgName}</td>
                                                <td>{$dur} months</td>
                                                <td><span class='badge badge-{$badgeClass}'>" . ucfirst($status) . "</span></td>
                                                <td>
                                                    <button class='btn btn-info btn-sm' data-toggle='modal' data-target='#infoModal{$id}'>Info</button>
                                                </td>
                                            </tr>";

                                            echo "
                                            <div class='modal fade' id='infoModal{$id}' tabindex='-1' role='dialog'>
                                                <div class='modal-dialog modal-dialog-scrollable modal-lg' role='document'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title'>Training Program Details</h5>
                                                            <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                                                        </div>
                                                        <form method='POST'>
                                                            <input type='hidden' name='id' value='{$id}'>
                                                            <div class='modal-body'>
                                                                <h5 class='text-primary mb-3'>📘 Program Info</h5>
                                                                <ul class='list-group mb-3'>
                                                                    <li class='list-group-item'><strong>Name:</strong> {$progName}</li>
                                                                    <li class='list-group-item'><strong>Description:</strong> {$desc}</li>
                                                                    <li class='list-group-item'><strong>Duration:</strong> {$dur} months</li>
                                                                    <li class='list-group-item'><strong>Status:</strong> <span class='badge badge-{$badgeClass}'>" . ucfirst($status) . "</span></li>
                                                                    <li class='list-group-item'><strong>Submitted on:</strong> {$created}</li>
                                                                </ul>
                                                                <h5 class='text-success mb-3'>🏢 Provider Info</h5>
                                                                <ul class='list-group mb-3'>
                                                                    <li class='list-group-item'><strong>Organization:</strong> {$orgName}</li>
                                                                    <li class='list-group-item'><strong>Reg No.:</strong> {$regNum}</li>
                                                                    <li class='list-group-item'><strong>Location:</strong> {$headLoc}</li>
                                                                    <li class='list-group-item'><strong>Sectors:</strong> {$sectors}</li>
                                                                </ul>
                                                                <h5 class='text-info mb-3'>👤 Contact Info</h5>
                                                                <ul class='list-group'>
                                                                    <li class='list-group-item'><strong>Name:</strong> {$fullname}</li>
                                                                    <li class='list-group-item'><strong>Email:</strong> {$email}</li>
                                                                    <li class='list-group-item'><strong>Phone:</strong> {$phone}</li>
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
                                        echo "<tr><td colspan='6' class='text-center'>No training programs submitted yet.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
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
        $('#trainingTable').DataTable();
    });
</script>
</body>
</html>
