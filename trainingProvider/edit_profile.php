<?php  include('session.php');  ?>

<?php
include('connection.php');

$id = $_SESSION['user_id'];
if(isset($_GET['edit']))
{
    $a=$_GET['edit'];
    $res=mysqli_query($con,"SELECT * FROM users u
          LEFT JOIN training_providers tp ON u.id = tp.user_id
          WHERE u.id = '$id'");
    $rec=mysqli_fetch_array($res);
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

    <title>Edit Profile</title>
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
        <form id="registrationForm" method="POST" enctype="multipart/form-data">

            <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
                <div class="wrapper wrapper--w680">
                    <div class="card card-1">
                        <div class="card-heading"></div>
                        <div class="card-body">
                            <h2 class="title">Edit Profile</h2>

                            <p>Full Name</p>
                            <div class="input-group1">
                                <input class="input--style-1" type="text" placeholder="Full Name" name="fn"
                                    value="<?php echo $rec['full_name']; ?>" />
                                <span id="fn_err" class="error1 p-1"></span>
                            </div>


                            <p>Email</p>
                            <div class="input-group1">
                                <input class="input--style-1" type="email" placeholder="Email" name="em"
                                    value="<?php echo $rec['email']; ?>" readonly />
                                <span id="em_err" class="error1 p-1"></span>
                            </div>


                            <p>Gender</p>
                            <div class="input-group1">
                                <label class="radio-container">Male
                                    <input type="radio" name="gender" value="Male"
                                        <?php if($rec['gender'] == 'Male') echo 'checked'; ?>>
                                    <span class="checkmark"></span>
                                </label><br>
                                <label class="radio-container">Female
                                    <input type="radio" name="gender" value="Female"
                                        <?php if($rec['gender'] == 'Female') echo 'checked'; ?>>
                                    <span class="checkmark"></span>
                                </label>

                            </div>


                            <p>Contact Number</p>
                            <div class="input-group1">
                                <input class="input--style-1" type="number" value="<?php echo $rec['phone']; ?>"
                                    placeholder="Contact Number" name="pn" />
                                <span id="pn_err" class="error1 p-1"></span>
                            </div>

                            <p>Profile picture</p>

                            <?php
if (!empty($rec['pic'])) { ?>
                            <img class="img-profile rounded-circle" height="100px" width="100px"
                                src="img/Uploads/<?php echo $rec['pic']; ?>" />
                            <?php } ?>


                            <div class="input-group1">
                                <input class="input--style-1" type="file" placeholder="Upload Image" name="f1"
                                    id="f1" />
                            </div>

                            <p>Organization Name</p>
                            <div class="input-group1">
                                <input class="input--style-1" type="text" placeholder="Organization Name"
                                    name="org_name" value="<?php echo $rec['organization_name']; ?>" />
                                <span id="org_name_err" class="error1 p-1"></span>
                            </div>

                            <p>Registration Number</p>
                            <div class="input-group1">
                                <input class="input--style-1" type="text" placeholder="Registration Number"
                                    name="reg_num" value="<?php echo $rec['registration_number']; ?>" readonly/>
                                <span id="reg_num_err" class="error1 p-1"></span>
                            </div>

                            <p>Head Office Location</p>
                            <div class="input-group1">
                                <input class="input--style-1" type="text" placeholder="Head Office Location"
                                    name="head_office" value="<?php echo $rec['head_office_location']; ?>" />
                                <span id="head_office_err" class="error1 p-1"></span>
                            </div>

                            <p>Training Sectors</p>
                            <div class="input-group1">
                                <select class="input--style-1" name="training_sectors" required>
                                    <?php
        $training_sectors = ["IT", "Healthcare", "Construction", "Manufacturing", "Retail", "Education", "Hospitality", "Finance"];

        foreach ($training_sectors as $sector) {
            $selected = ($rec['training_sectors'] == $sector) ? 'selected' : ''; 
            echo "<option value='$sector' $selected>$sector</option>";
        }
        ?>
                                </select>
                                <span id="training_sectors_err" class="error1 p-1"></span>
                            </div>

                            <?php

$dir = "img/Uploads/";
if (isset($_POST['submit'])) {
    $file_uploaded = false;
    $unique_filename = '';

    if (!empty($_FILES['f1']['name'])) {
        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $total_files = is_array($_FILES['f1']['name']) ? count($_FILES['f1']['name']) : 1;

        for ($i = 0; $i < $total_files; $i++) {
            $file_name = is_array($_FILES['f1']['name']) ? $_FILES['f1']['name'][$i] : $_FILES['f1']['name'];
            $file_type = is_array($_FILES['f1']['type']) ? $_FILES['f1']['type'][$i] : $_FILES['f1']['type'];
            $tmp_name = is_array($_FILES['f1']['tmp_name']) ? $_FILES['f1']['tmp_name'][$i] : $_FILES['f1']['tmp_name'];

            if ($file_type == 'image/jpeg' || $file_type == 'image/png') {
                $unique_filename = uniqid() . '_' . $file_name;
                $target_path = $dir . "/" . $unique_filename;

                if (move_uploaded_file($tmp_name, $target_path)) {
                    $file_uploaded = true;
                } else {
                    echo "<span style='color:red'>Error uploading file '$file_name'. Please try again</span><br>";
                }
            } else {
                echo "<span style='color:red'>Please select one file in JPG or PNG format</span><br>";
            }
        }
    } else {
        $file_uploaded = true;
    }
   
    if ($file_uploaded) {
        $un1 = $_POST['fn'];
        $em1 = $_POST['em'];
        $cn1 = $_POST['pn'];
        $gen1 = $_POST['gender'];
        $org_name = $_POST['org_name'];
        $reg_num = $_POST['reg_num'];
        $head_office = $_POST['head_office'];
        $training_sectors = $_POST['training_sectors'];

        $ins_users = "UPDATE users SET full_name='$un1', email='$em1', gender='$gen1', phone='$cn1'";
        if (!empty($unique_filename)) {
            $ins_users .= ", pic='$unique_filename'";
        }
        $ins_users .= " WHERE id='$id'";

        
        $ins_providers = "UPDATE training_providers SET `organization_name`='$org_name', `registration_number`='$reg_num', `head_office_location`='$head_office', `training_sectors`='$training_sectors' WHERE `user_id`='$id'";
        
        if (mysqli_query($con, $ins_users)) {
            if (mysqli_query($con, $ins_providers)) {
                echo "<script>alert('Form updated successfully!');</script>";
                echo "<script>window.location.href='http://localhost/worklink/trainingProvider/Manage_profile.php';</script>";
            } else {
                echo "Error updating training providers data.";
            }
        } else {
            echo "Error updating user data.";
        }
        
        
    }
}

?>

                            <div class="p-t-20">
                                <button type="submit" class="btn btn--radius btn-success" name="submit">Update
                                    Info</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>

    <?php
        include_once('footer.php');
    ?>

    </div>

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
                    <a class="btn btn-success" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="js/edit_profile.js"></script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>

    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="js/demo/datatables-demo.js"></script>


</body>

</html>