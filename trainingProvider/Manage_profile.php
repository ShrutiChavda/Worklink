<?php include('session.php'); ?>
<?php include('connection.php'); ?>


<!DOCTYPE html>
<html lang="en">

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
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
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
            .profile-label, .profile-value {
                width: 100%;
            }
        }
     
    </style>
</head>

<body id="page-top">
    <?php include('sidebar.php'); ?>
    <?php include('header.php'); ?>

    <div class="container-fluid justify-content-center align-items-center min-vh-100">
    <div class="profile-card">

            <h2>Profile Information</h2>

            <?php
$un = $_SESSION['username'];
$q = "SELECT u.*, tp.organization_name, tp.registration_number, tp.head_office_location, tp.training_sectors
      FROM users u 
      LEFT JOIN training_providers tp ON u.id = tp.user_id 
      WHERE u.user_name = '$un'";
$res = mysqli_query($con, $q);
$row = mysqli_fetch_assoc($res);
?>

            <img class="profile-pic" 
     src="img/Uploads/<?php echo $row['pic'] ? $row['pic'] : 'undraw_profile.jpg'; ?>" 
     height="100" width="100" alt="Profile Picture">

            <div class="profile-row"><div class="profile-label">User Name:</div><div class="profile-value"><?php echo $row  ['user_name']; ?></div></div>
            <div class="profile-row"><div class="profile-label">Full Name:</div><div class="profile-value"><?php echo $row['full_name']; ?></div></div>
            <div class="profile-row"><div class="profile-label">User Type:</div><div class="profile-value"><?php echo $row['user_type']; ?></div></div>
            <div class="profile-row"><div class="profile-label">Email:</div><div class="profile-value"><?php echo $row['email']; ?></div></div>
            <div class="profile-row"><div class="profile-label">Gender:</div><div class="profile-value"><?php echo $row['gender']; ?></div></div>
            <div class="profile-row"><div class="profile-label">Contact Number:</div><div class="profile-value"><?php echo $row['phone']; ?></div></div>
            <div class="profile-row"><div class="profile-label">Date Of Birth:</div><div class="profile-value"><?php echo $row['birthday']; ?></div></div>

            <?php if ($row['user_type'] === 'trainingProvider') { ?>
                <hr>
                <div class="profile-row"><div class="profile-label">Organization Name:</div><div class="profile-value"><?php echo $row['organization_name']; ?></div></div>
                <div class="profile-row"><div class="profile-label">Registration Number:</div><div class="profile-value"><?php echo $row['registration_number']; ?></div></div>
                <div class="profile-row"><div class="profile-label">Head Office Location:</div><div class="profile-value"><?php echo $row['head_office_location']; ?></div></div>
                <div class="profile-row"><div class="profile-label">Training Sectors:</div><div class="profile-value"><?php echo $row['training_sectors']; ?></div></div>
            <?php } ?>

            <div class="text-center mt-4">
                <a href="edit_profile.php?edit=<?php echo $row['id']; ?>" class="btn btn-success">Update Info</a>
            </div>
        </div>
    </div>

    <?php include_once('footer.php'); ?>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document"><div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Ready to Leave?</h5><button class="close" type="button" data-dismiss="modal"><span>×</span></button></div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-success" href="logout.php">Logout</a>
            </div>
        </div></div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>
