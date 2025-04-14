<?php
include('session.php');
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        $state = $_POST['state'];
        $min_wage_rate = $_POST['min_wage_rate'];
        $sector = $_POST['sector'];
        $date_of_implementation = $_POST['date_of_implementation'];

        $sql = "INSERT INTO wage_laws (state, min_wage_rate, sector, date_of_implementation, created_at) 
                VALUES ('$state', '$min_wage_rate', '$sector', '$date_of_implementation', NOW())";
        mysqli_query($con, $sql);
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $state = $_POST['state'];
        $min_wage_rate = $_POST['min_wage_rate'];
        $sector = $_POST['sector'];
        $date_of_implementation = $_POST['date_of_implementation'];

        $sql = "UPDATE wage_laws SET state='$state', min_wage_rate='$min_wage_rate', sector='$sector', 
                date_of_implementation='$date_of_implementation', updated_at=NOW() WHERE id='$id'";
        mysqli_query($con, $sql);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM wage_laws WHERE id='$id'";
        mysqli_query($con, $sql);
    }
}

$sql = "SELECT * FROM wage_laws ORDER BY created_at DESC";
$result = mysqli_query($con, $sql);

$states = ["Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jharkhand", "Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Odisha", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal"];
$sectors = ["Agriculture", "Construction", "Manufacturing", "Retail", "IT Services", "Education", "Healthcare", "Transport", "Hospitality", "Government Services"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Labour Wage Laws Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>


<body id="page-top">
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Labour Wage Laws Management</h1>

    <!-- Add Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Add New Wage Law</h6></div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="form-group">
                    <label>State</label>
                    <select name="state" class="form-control" required>
                        <?php foreach ($states as $state) echo "<option value='$state'>$state</option>"; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Minimum Wage Rate</label>
                    <input type="number" name="min_wage_rate" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Sector</label>
                    <select name="sector" class="form-control" required>
                        <?php foreach ($sectors as $sector) echo "<option value='$sector'>$sector</option>"; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Date of Implementation</label>
                    <input type="text" name="date_of_implementation" id="current_datetime" class="form-control" readonly required>
                </div>
                <button type="submit" name="create" class="btn btn-primary">Add Law</button>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Existing Wage Laws</h6></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="wageLawsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th><th>State</th><th>Wage Rate</th><th>Sector</th><th>Date</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['state'] ?></td>
                                <td><?= $row['min_wage_rate'] ?></td>
                                <td><?= $row['sector'] ?></td>
                                <td><?= $row['date_of_implementation'] ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateModal<?= $row['id'] ?>">Update</button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $row['id'] ?>">Delete</button>
                                </td>
                            </tr>

                            <!-- Update Modal -->
                            <div class="modal fade" id="updateModal<?= $row['id'] ?>" tabindex="-1">
                                <div class="modal-dialog"><div class="modal-content">
                                    <div class="modal-header"><h5 class="modal-title">Update Wage Law</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select name="state" class="form-control" required>
                                                    <?php foreach ($states as $state) {
                                                        $selected = $state == $row['state'] ? "selected" : "";
                                                        echo "<option value='$state' $selected>$state</option>";
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Minimum Wage Rate</label>
                                                <input type="number" name="min_wage_rate" class="form-control" value="<?= $row['min_wage_rate'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Sector</label>
                                                <select name="sector" class="form-control" required>
                                                    <?php foreach ($sectors as $sector) {
                                                        $selected = $sector == $row['sector'] ? "selected" : "";
                                                        echo "<option value='$sector' $selected>$sector</option>";
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Date of Implementation</label>
                                                <input type="text" name="date_of_implementation" class="form-control" value="<?= $row['date_of_implementation'] ?>" readonly required>
                                            </div>
                                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div></div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal<?= $row['id'] ?>" tabindex="-1">
                                <div class="modal-dialog"><div class="modal-content">
                                    <div class="modal-header"><h5 class="modal-title">Confirm Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="">
                                            <p>Delete this law?</p>
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div></div>
                            </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
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
        $('#wageLawsTable').DataTable();
        const now = new Date();
        const formatted = now.toISOString().slice(0, 19).replace('T', ' ');
        document.getElementById("current_datetime").value = formatted;
    });
</script>
</body>
</html>
