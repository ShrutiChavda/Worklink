<?php
include('session.php');
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Progress</title>
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="setting.css">
    <script src="js/jquery-3.6.4.min.js"></script>
</head>

<body id="page-top">

    <?php include('sidebar.php'); include('header.php'); ?>

    <div class="container-fluid">
        <h3 class="mb-4 text-gray-800">Assessment Progress</h3>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="progressTable" width="100%" cellspacing="0">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th>User</th>
                                <th>Assessment</th>
                                <th>Status</th>
                                <th>Score</th>
                                <th>Submitted At</th>
                                <th>Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $query = "SELECT s.*, u.full_name, u.email, a.title, a.questions 
                                  FROM assessment_submissions s
                                  JOIN users u ON s.user_id = u.id
                                  JOIN assessments a ON s.assessment_id = a.id";

                        $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result)) {
                            $total_questions = count(json_decode($row['questions'], true));
                            echo "<tr class='text-center'>
                                <td>{$row['full_name']}</td>
                                <td>{$row['title']}</td>
                                <td><span class='badge badge-".($row['status']=='Submitted' ? 'success' : 'warning')."'>{$row['status']}</span></td>
                                <td>$total_questions / {$row['score']} </td>
                                <td>{$row['submitted_at']}</td>
                                <td><button class='btn btn-info btn-sm' data-toggle='modal' data-target='#userInfo{$row['id']}'>Info</button></td>
                            </tr>";

                            echo "<div class='modal fade' id='userInfo{$row['id']}' tabindex='-1'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title'>User Details</h5>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                            </div>
                                            <div class='modal-body'>
                                                <p><strong>Name:</strong> {$row['full_name']}</p>
                                                <p><strong>Email:</strong> {$row['email']}</p>
                                                <p><strong>Status:</strong> {$row['status']}</p>
                                                <p><strong>Score:</strong> $total_questions / {$row['score']}</p>
                                                <p><strong>Submitted At:</strong> {$row['submitted_at']}</p>
                                            </div>
                                            <div class='modal-footer'>
                                                <button class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
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
    </div>



    <?php include_once('footer.php'); ?>
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
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

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
    <script>
    $(document).ready(function() {
        $('#progressTable').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>