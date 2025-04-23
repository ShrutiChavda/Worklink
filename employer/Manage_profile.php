<?php include('session.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Dashboard</title>
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/search.js"></script>

    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <link rel="stylesheet" href="css/main.css">

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/update_profile.js"></script>

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
                                $un=$_SESSION['username'];

                                $q = "SELECT u.*, e.company_name, e.industry FROM users u LEFT JOIN employers e ON u.id = e.user_id WHERE u.user_name='$un'";
                                $res = mysqli_query($con, $q);
                                // Fetch the data only once
                                if ($row = mysqli_fetch_array($res)) { ?>

                            <div>
                                <img class="img-profile rounded-circle" height="100px" width="100px" src="img/Uploads/<?php echo $row['pic']; ?>"/>

                            </div><br>

                            <div class="profile-item">
                                <label>User Name:</label>
                                <span><?php echo $row['user_name']; ?></span>
                            </div>

                            <div class="profile-item">
                                <label>Full Name:</label>
                                <span><?php echo $row['full_name']; ?></span>
                            </div>

                            <div class="profile-item">
                                <label>User Type:</label>
                                <span><?php echo $row['user_type']; ?></span>
                            </div>

                            <?php if($row['user_type'] == 'employer') { ?>
                            <div class="profile-item">
                                <label>Company Name:</label>
                                <span><?php echo $row['company_name']; ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Industry:</label>
                                <span><?php echo $row['industry']; ?></span>
                            </div>
                            <?php } ?>

                            <div class="profile-item">
                                <label>Email:</label>
                                <span><?php echo $row['email']; ?></span>
                            </div>

                            <div class="profile-item">
                                <label>Gender:</label>
                                <span><?php echo $row['gender']; ?></span>
                            </div>

                            <div class="profile-item">
                                <label>Date Of Birth:</label>
                                <span><?php echo $row['birthday']; ?></span>
                            </div>

                            <div class="profile-item">
                                <label>Contact Number:</label>
                                <span><?php echo $row['phone']; ?></span>
                            </div>

                            <div class="profile-item">
                                <label>Qualification:</label>
                                <span><?php echo $row['qualification']; ?></span>
                            </div>

                            <div class="profile-item">
                                <label>Address:</label>
                                <span><?php echo $row['address']; ?></span>
                            </div>

                            <div class="profile-item">
                                <label>State:</label>
                                <span><?php echo $row['state']; ?></span>
                            </div>

                            <div class="profile-item">
                                <label>District:</label>
                                <span><?php echo $row['district']; ?></span>
                            </div>

                            <div class="profile-item">
                                <label>Pincode:</label>
                                <span><?php echo $row['pincode']; ?></span>
                            </div><br>

                            <div class="p-t-20">
                                <a href="edit_profile.php?edit=<?php echo $row['id']; ?>">
                                    <button class="btn btn--radius btn-success" type="button">Update Info</button>
                                </a>
                                <?php } // Closing the if condition for fetching the row ?>

                                </form>

        </div>
    </div>
    </div>
    </div>



    </div>
    </div>
    </div>
    <?php
        include_once('footer.php');
        ?>
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
                        href="http://localhost/worklink/employer/logout.php">Logout</a>
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

</body>

</html>