<?php include('session.php'); ?>

<?php
include('connection.php');
if(isset($_GET['edit']))
{
    $a=$_GET['edit'];
    $res=mysqli_query($con,"SELECT u.*, e.company_name, e.industry FROM users u LEFT JOIN employers e ON u.id = e.user_id WHERE u.id='$a'");
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

    <?php include('sidebar.php'); ?>

    <?php include('header.php'); ?>

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

                                <p>User Name</p>
                                <div class="input-group1">
                                    <input class="input--style-1" type="text" placeholder="User Name" name="un"
                                        value="<?php echo $rec['user_name']; ?>" readonly />
                                    <span id="un_err" class="error1 p-1"></span>
                                </div>

                                <p>Email</p>
                                <div class="input-group1">
                                    <input class="input--style-1" type="email" placeholder="Email" name="em"
                                        value="<?php echo $rec['email']; ?>" readonly/>
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

                                <p>Qualification</p>
                                <div class="input-group1">
                                    <input class="input--style-1" type="text" value="<?php echo $rec['qualification']; ?>"
                                        placeholder="Qualification" name="ql" />
                                    <span id="ql_err" class="error1 p-1"></span>
                                </div>

                                <p>Address</p>
                                <div class="input-group1">
                                    <input class="input--style-1" type="text" value="<?php echo $rec['address']; ?>"
                                        placeholder="Address" name="ad" />
                                    <span id="ad_err" class="error1 p-1"></span>
                                </div>

                                <p>State</p>
                                <div class="input-group1">
                                    <input class="input--style-1" type="text" value="<?php echo $rec['state']; ?>"
                                        placeholder="State" name="st" />
                                    <span id="st_err" class="error1 p-1"></span>
                                </div>

                                <p>District</p>
                                <div class="input-group1">
                                    <input class="input--style-1" type="text" value="<?php echo $rec['district']; ?>"
                                        placeholder="District" name="di" />
                                    <span id="di_err" class="error1 p-1"></span>
                                </div>

                                <p>Pincode</p>
                                <div class="input-group1">
                                    <input class="input--style-1" type="text" value="<?php echo $rec['pincode']; ?>"
                                        placeholder="Pincode" name="pi" />
                                    <span id="pi_err" class="error1 p-1"></span>
                                </div>

                                <?php if($rec['user_type'] == 'employer') { ?>
                                <p>Company Name</p>
                                <div class="input-group1">
                                    <input class="input--style-1" type="text" placeholder="Company Name" name="cn"
                                        value="<?php echo $rec['company_name']; ?>" />
                                    <span id="cn_err" class="error1 p-1"></span>
                                </div>

                                <p>Industry</p>
                                <div class="input-group1">
                                    <input class="input--style-1" type="text" placeholder="Industry" name="ind"
                                        value="<?php echo $rec['industry']; ?>" />
                                    <span id="ind_err" class="error1 p-1"></span>
                                </div>
                                <?php } ?>

                                <p>Profile picture</p>

                                <?php

if(isset($_GET['edit']))
{
$id= $_GET['edit'];
$q = "select pic from users where id='$id'";
$res = mysqli_query($con, $q);
while ($row = mysqli_fetch_array($res)) { ?>
<img class="img-profile rounded-circle" height="100px" width="100px" src="img/Uploads/<?php echo $row['pic']; ?>"/><?php  }}  ?>

<div class="input-group1">
    <input class="input--style-1" type="file" placeholder="Upload Image" name="f1"
        id="f1" />
</div>
<?php

$dir = "img/Uploads/";
if (isset($_POST['submit'])) {
    $file_uploaded = false;

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
        $ql1 = $_POST['ql'];
        $ad1 = $_POST['ad'];
        $st1 = $_POST['st'];
        $di1 = $_POST['di'];
        $pi1 = $_POST['pi'];

        $ins = "UPDATE users SET `full_name`='$un1', `email`='$em1', `gender`='$gen1', `phone`='$cn1', `qualification`='$ql1', `address`='$ad1', `state`='$st1', `district`='$di1', `pincode`='$pi1'";
        if (!empty($unique_filename)) {
            $ins .= ", `pic`='$unique_filename'";
        }
        $ins .= " WHERE `id`='$a'";

        if (mysqli_query($con, $ins)) {
            if($rec['user_type'] == 'employer') {
                $cn_emp = $_POST['cn'];
                $ind_emp = $_POST['ind'];
                $q_emp = "UPDATE employers SET `company_name`='$cn_emp', `industry`='$ind_emp' WHERE `user_id`='$a'";
                if (mysqli_query($con, $q_emp)) {
                    echo "<script>alert('Form updated successfully!');</script>";
                    echo "<script>window.location.href='http://localhost/worklink/employer/Manage_profile.php';</script>";
                } else {
                    echo "Error updating employer info: " . mysqli_error($con);
                }
            } else {
                echo "<script>alert('Form updated successfully!');</script>";
                echo "<script>window.location.href='http://localhost/worklink/employer/Manage_profile.php';</script>";
            }
        } else {
            echo "Error updating user info: " . mysqli_error($con);
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
                    <a class="btn btn-success"
                        href="http://localhost/worklink/employer/logout.php">Logout</a>
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