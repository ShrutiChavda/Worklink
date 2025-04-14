<?php include('session.php'); ?>
<?php
include('connection.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Profile</title>
  <link href="img/favicon.png" rel="icon" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link href="css/sb-admin-2.css" rel="stylesheet" />
  <link href="vendor/select2/select2.min.css" rel="stylesheet" />
  <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/main.css" />
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
            <?php 
if (isset($_GET['edit'])) {
    $a = $_SESSION['user_id'];
    $res = mysqli_query($con, "SELECT * FROM users WHERE id='$a'");
    $rec = mysqli_fetch_array($res);

    $res2 = mysqli_query($con, "SELECT * FROM government_officials WHERE user_id='$a'");
    $gov = mysqli_fetch_array($res2);
}
?>
            <p>Full Name</p>
            <div class="input-group1">
              <input class="input--style-1" type="text" name="fn" value="<?php echo $rec['full_name']; ?>" required />
            </div>

            <p>Email</p>
            <div class="input-group1">
              <input class="input--style-1" type="email" name="em" value="<?php echo $rec['email']; ?>" readonly />
            </div>

            <p>Gender</p>
            <div class="input-group1">
              <label class="radio-container">Male
                <input type="radio" name="gender" value="Male" <?php if ($rec['gender'] == 'Male') echo 'checked'; ?>>
                <span class="checkmark"></span>
              </label>
              <label class="radio-container">Female
                <input type="radio" name="gender" value="Female" <?php if ($rec['gender'] == 'Female') echo 'checked'; ?>>
                <span class="checkmark"></span>
              </label>
            </div>

            <p>Contact Number</p>
            <div class="input-group1">
              <input class="input--style-1" type="text" name="pn" value="<?php echo $rec['phone']; ?>" required />
            </div>

            <p>Birthday</p>
            <div class="input-group1">
              <input class="input--style-1" type="date" name="birthday" value="<?php echo $rec['birthday']; ?>" required />
            </div>

            <p>Profile Picture</p>
            <?php if (!empty($rec['pic'])) { ?>
              <img class="img-profile rounded-circle" height="100px" width="100px" src="img/Uploads/<?php echo $rec['pic']; ?>" />
            <?php } ?>
            <div class="input-group1">
              <input class="input--style-1" type="file" name="f1" />
            </div><br>

            <p>Department</p>
            <div class="input-group1">
            <select class="input--style-1" name="department" required>
  <?php
  $departments = ["Administrative Services", "Agriculture", "Education", "Finance", "Health & Family Welfare",
    "Home Affairs", "Information Technology", "Labour and Employment", "Law and Justice", "Public Works Department (PWD)",
    "Railways", "Revenue", "Rural Development", "Skill Development and Entrepreneurship", "Social Welfare",
    "Textiles", "Tourism", "Transport", "Urban Development", "Water Resources", "Women and Child Development",
    "Youth Affairs and Sports"
  ];
  foreach ($departments as $dept) {
    $selected = (isset($gov['department']) && $gov['department'] == $dept) ? 'selected' : '';
    echo "<option value='$dept' $selected>$dept</option>";
  }
  ?>
</select>

            </div><br>

            <p>Designation</p>
            <div class="input-group1">
            <input class="input--style-1" type="text" name="designation" value="<?php echo $gov['designation']; ?>" required />
            </div><br>

            <div class="p-t-20">
              <button type="submit" class="btn btn--radius btn-success" name="submit">Update Info</button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $fn = $_POST['fn'];
    $gender = $_POST['gender'];
    $pn = $_POST['pn'];
    $birthday = $_POST['birthday'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];

    $pic = $rec['pic'];
    if ($_FILES['f1']['name']) {
        $pic = time() . '_' . $_FILES['f1']['name'];
        move_uploaded_file($_FILES["f1"]["tmp_name"], "img/Uploads/" . $pic);
    }

    $update_user = "UPDATE users SET full_name='$fn', gender='$gender', phone='$pn', birthday='$birthday', pic='$pic' WHERE id='$a'";
    mysqli_query($con, $update_user);

    // Check if entry exists in government_officials
    $check_go = mysqli_query($con, "SELECT * FROM government_officials WHERE user_id='$a'");
    if (mysqli_num_rows($check_go) > 0) {
        $update_go = "UPDATE government_officials SET department='$department', designation='$designation' WHERE user_id='$a'";
        mysqli_query($con, $update_go);
    } else {
        $insert_go = "INSERT INTO government_officials (user_id, department, designation) VALUES ('$a', '$department', '$designation')";
        mysqli_query($con, $insert_go);
    }

    echo "<script>alert('Profile updated successfully');</script>";
    echo "<script>window.location.href='Manage_profile.php';</script>";
}
?>

<?php include_once('footer.php'); ?>
<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>
</body>
</html>
