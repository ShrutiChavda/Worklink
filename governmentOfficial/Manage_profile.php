<?php include('session.php'); 
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>User Dashboard</title>
        <link href="img/favicon.png" rel="icon">
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <script src="vendor/jquery/jquery.min.js"></script>

        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="css/sb-admin-2.css" rel="stylesheet">
        <link rel="stylesheet" href="css/main.css">
        <style>
        .profile-card {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .profile-card h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #4e73df;
        }

        .profile-pic {
            display: block;
            margin: 0 auto 20px;
            border-radius: 50%;
        }

        .profile-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .profile-label {
            font-weight: bold;
            width: 40%;
            color: #333;
        }

        .profile-value {
            width: 55%;
            text-align: left;
        }

        @media (max-width: 768px) {
            .profile-row {
                flex-direction: column;
            }

            .profile-label,
            .profile-value {
                width: 100%;
            }
        }
        </style>
    </head>

<body id="page-top">
    <?php include('sidebar.php'); ?>
    <?php include('header.php'); ?>

    <div class="container-fluid">
        <form id="registrationForm" style="text-align:center">
            <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
                <div class="wrapper wrapper--w680">
                    <div class="card card-1">
                        <div class="card-heading"></div>
                        <div class="card-body">
                            <h2 class="title">Profile Information</h2>

                            <?php
                            include('connection.php');
                            $un = $_SESSION['username'];
                            $q = "SELECT u.*, g.* FROM users u LEFT JOIN government_officials g ON u.id = g.user_id WHERE u.user_name = '$un'";
                            $res = mysqli_query($con, $q);
                            while ($row = mysqli_fetch_array($res)) {
                            ?>

                            <div>
                                <img class="img-profile rounded-circle" height="100px" width="100px"
                                    src="img/Uploads/<?php echo $row['pic']; ?>" />
                            </div><br>


                            <div class="profile-row">
                                <div class="profile-label">User Name:</div>
                                <div class="profile-value"><?php echo $row  ['user_name']; ?></div>
                            </div>
                            <div class="profile-row">
                                <div class="profile-label">Full Name:</div>
                                <div class="profile-value"><?php echo $row['full_name']; ?></div>
                            </div>
                            <div class="profile-row">
                                <div class="profile-label">User Type:</div>
                                <div class="profile-value"><?php echo $row['user_type']; ?></div>
                            </div>
                            <div class="profile-row">
                                <div class="profile-label">Email:</div>
                                <div class="profile-value"><?php echo $row['email']; ?></div>
                            </div>
                            <div class="profile-row">
                                <div class="profile-label">Gender:</div>
                                <div class="profile-value"><?php echo $row['gender']; ?></div>
                            </div>
                            <div class="profile-row">
                                <div class="profile-label">Contact Number:</div>
                                <div class="profile-value"><?php echo $row['phone']; ?></div>
                            </div>
                            <div class="profile-row">
                                <div class="profile-label">Date Of Birth:</div>
                                <div class="profile-value"><?php echo $row['birthday']; ?></div>
                            </div>

                            <?php if (!empty($row['designation'])) { ?>

                            <div class="profile-row">
                            <div class="profile-label">Designation:</div>
                            <div class="profile-value"><?php echo $row['designation']; ?></div>
                                </div>
                                <div class="profile-row">
                                <div class="profile-label">Department:</div>
                                <div class="profile-value"><?php echo $row['department']; ?></div>
                                    </div>

                                    <?php } ?><br>

                                    <div class="p-t-20">
                                        <a href="edit_profile.php?edit=<?php echo $row['id']; ?>">
                                            <button class="btn btn--radius btn-success" type="button">Update
                                                Info</button>
                                        </a>
                                    </div>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
        </form>
    </div>

    <?php include_once('footer.php'); ?>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below to end your session.</div>
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
</body>

</html>