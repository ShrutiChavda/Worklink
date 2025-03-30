<?php  include('session.php');  ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Team</title>

    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>

    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <link rel="stylesheet" href="css/main.css">

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>

</head>


<body id="page-top">
    <?php  include('sidebar.php'); ?>

    <?php  include('header.php'); ?>

    <div class="container-fluid">
        <form id="registrationForm" action="add_team.php" method="POST" enctype="multipart/form-data">

            <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
                <div class="wrapper wrapper--w680">
                    <div class="card card-1">
                        <div class="card-heading"></div>
                        <div class="card-body">
                            <h2 class="title">Team form</h2>

                            <div>
                                <p>Person Name</p>
                                <div class="input-group1">
                                    <input class="input--style-1"
                                        value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" type="text"
                                        placeholder="Enter a person name" name="name" />
                                </div><br>
                            </div>

                            <div>
                                <p>Position</p>
                                <div class="input-group1">
                                    <input class="input--style-1"
                                        value="<?php if(isset($_POST['position'])) echo $_POST['position']; ?>" type="text"
                                        placeholder="Enter a position" name="position" />
                                </div><br>
                            </div>

                            <div>
                                <p>Team Image</p>
                                <div class="input-group1">
                                    <input class="input--style-1" type="file" placeholder="Upload Image" name="f1"
                                        id="f1" />
                                </div><br>
                            </div>


                            <?php
include('connection.php');

$dir = "img/intro-carousel";

if (isset($_POST['btn'])) {
    $file_uploaded = false;

    if (!is_dir($dir)) {
        mkdir($dir);
    }

    $total_files = is_array($_FILES['f1']['name']) ? count($_FILES['f1']['name']) : 1;

    // Loop through each uploaded file
    for ($i = 0; $i < $total_files; $i++) {
        $file_name = is_array($_FILES['f1']['name']) ? $_FILES['f1']['name'][$i] : $_FILES['f1']['name'];
        $file_type = is_array($_FILES['f1']['type']) ? $_FILES['f1']['type'][$i] : $_FILES['f1']['type'];
        $tmp_name = is_array($_FILES['f1']['tmp_name']) ? $_FILES['f1']['tmp_name'][$i] : $_FILES['f1']['tmp_name'];

        if ($file_type == 'image/jpeg' || $file_type == 'image/png') {
            // Generate unique filename
            $unique_filename = uniqid() . '_' . $file_name;
            $target_path = $dir . "/" . $unique_filename;

            // Move uploaded file to target directory
            if (move_uploaded_file($tmp_name, $target_path)) {
                $file_uploaded = true;
            } else {
                echo "<span style='color:red'>Error uploading file '$file_name'. Please try again</span><br>";
            }
        } else {
            echo "<span style='color:red'>Only JPG and PNG files are allowed</span><br>";
        }
    }

    if ($file_uploaded) {
        $name = $_POST['name'];
        $position = $_POST['position'];
        
        $q = "INSERT INTO guest_team (name, position, img) VALUES ('$name', '$position', '$unique_filename')";
        
        if (mysqli_query($con, $q)) {
            echo "<script>alert('Form submitted successfully!');</script>";
            echo "<script>window.location.href='http://localhost/Employee%20Management%20System/admin_panel/add_team.php';</script>";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>


                            <div class="p-t-20 p-2">
                                <button class="btn btn--radius btn-success" name="btn" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>

    </div>


    </div>

    </div>

    <?php
        include_once('footer.php');
          ?>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
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
                        href="http://localhost/worklink/jobSeeker/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="js/Guest panel js/add_team.js"></script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>

    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>