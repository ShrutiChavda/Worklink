<?php include('session.php'); include('connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Issued Certificates</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .user-pic {
            width: 60%;
            height: 60%;
            object-fit: cover;
        }
    </style>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="page-top">
<?php include('sidebar.php'); include('header.php'); ?>
<div class="container-fluid">
    <h2 class="mb-4">Issued Certificates</h2>
    <div class="table-responsive">
        <table class="table table-bordered" id="certTable" width="100%" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>User Picture</th>
                    <th>User</th>
                    <th>Program</th>
                    <th>Organization Name</th>
                    <th>Certificate No.</th>
                    <th>Issued On</th>
                    <th>Status</th>
                    <th>Info</th>
                    <th>Preview</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT c.*, 
                            u.full_name, u.email, u.phone, u.pic, 
                            p.course_name, 
                            tp.organization_name 
                        FROM certificates c 
                        JOIN users u ON c.user_id = u.id 
                        JOIN training_programs p ON c.training_program_id = p.id 
                        JOIN training_providers tp ON p.training_provider_id = tp.id 
                        WHERE c.status = 'Issued' 
                        ORDER BY c.issue_date DESC";

                $res = mysqli_query($con, $sql);
                $count = 1;
                while($row = mysqli_fetch_assoc($res)) {
                    $userPic = 'img/Uploads/' . $row['pic'];
                ?>
                <tr>
                    <td><?= $count++ ?></td>
                    <td><img src="<?= $userPic ?>" class="img-thumbnail rounded-circle user-pic" alt="User Pic"></td>
                    <td><?= $row['full_name'] ?></td>
                    <td><?= $row['course_name'] ?></td>
                    <td><?= $row['organization_name'] ?></td>
                    <td><?= $row['certificate_number'] ?></td>
                    <td><?= date('d M Y', strtotime($row['issue_date'])) ?></td>
                    <td><span class="badge badge-success"><?= $row['status'] ?></span></td>
                    <td>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#infoModal<?= $row['id'] ?>">
                            <i class="fas fa-info-circle"></i>
                        </button>
                        <!-- Info Modal -->
                        <div class="modal fade" id="infoModal<?= $row['id'] ?>" tabindex="-1" role="dialog">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Certificate Info</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                              </div>
                              <div class="modal-body">
                                <p><strong>Full Name:</strong> <?= $row['full_name'] ?></p>
                                <p><strong>Email:</strong> <?= $row['email'] ?></p>
                                <p><strong>Phone:</strong> <?= $row['phone'] ?></p>
                                <p><strong>Training Program:</strong> <?= $row['course_name'] ?></p>
                                <p><strong>Organization:</strong> <?= $row['organization_name'] ?></p>
                                <p><strong>Certificate Number:</strong> <?= $row['certificate_number'] ?></p>
                                <p><strong>Issued On:</strong> <?= date('d M Y, h:i A', strtotime($row['issue_date'])) ?></p>
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </td>
                    <td>
                        <a href="certificate_preview.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm" target="_blank">
                            <i class="fas fa-file-download"></i> Preview
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<?php include_once('footer.php'); ?>
<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<!-- Logout Modal -->
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

<!-- Scripts -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>
<script>
$(document).ready(function () {
    $('#certTable').DataTable();
});
</script>
</body>
</html>
