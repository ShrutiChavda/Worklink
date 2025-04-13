<?php
include('session.php');
include('connection.php');  // Assuming a database connection is established

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        // Create Operation
        $state = $_POST['state'];
        $min_wage_rate = $_POST['min_wage_rate'];
        $sector = $_POST['sector'];
        $date_of_implementation = $_POST['date_of_implementation'];

        $sql = "INSERT INTO wage_laws (state, min_wage_rate, sector, date_of_implementation, created_at) 
                VALUES ('$state', '$min_wage_rate', '$sector', '$date_of_implementation', NOW())";
        mysqli_query($con, $sql);
    } 
    elseif (isset($_POST['update'])) {
    // Update Operation
    $id = $_POST['id'];
    $state = $_POST['state'];
    $min_wage_rate = $_POST['min_wage_rate'];
    $sector = $_POST['sector'];
    $date_of_implementation = $_POST['date_of_implementation'];

    $sql = "UPDATE wage_laws SET state='$state', min_wage_rate='$min_wage_rate', sector='$sector', 
            date_of_implementation='$date_of_implementation', updated_at=NOW() WHERE id='$id'";
    mysqli_query($con, $sql);
}

    elseif (isset($_POST['delete'])) {
        // Delete Operation
        $id = $_POST['id'];
        $sql = "DELETE FROM wage_laws WHERE id='$id'";
        mysqli_query($con, $sql);
    }
}

// Fetch all records for display
$sql = "SELECT * FROM wage_laws ORDER BY created_at DESC";
$result = mysqli_query($con, $sql);

// States and Sectors data
$states = ["Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jharkhand", "Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Odisha", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal"];
$sectors = ["Agriculture", "Construction", "Manufacturing", "Retail", "IT Services", "Education", "Healthcare", "Transport", "Hospitality", "Government Services"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labour Wage Laws Management</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
</head>

<body id="page-top">

    <?php include('sidebar.php'); ?>
    <?php include('header.php'); ?>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Labour Wage Laws Management</h1>

        <!-- Add New Law Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New Labour Wage Law</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="state">State</label>
                        <select name="state" class="form-control" required>
                            <?php foreach ($states as $state) { ?>
                                <option value="<?php echo $state; ?>"><?php echo $state; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="min_wage_rate">Minimum Wage Rate</label>
                        <input type="number" name="min_wage_rate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sector">Sector</label>
                        <select name="sector" class="form-control" required>
                            <?php foreach ($sectors as $sector) { ?>
                                <option value="<?php echo $sector; ?>"><?php echo $sector; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_of_implementation">Date of Implementation</label>
                        <input type="text" name="date_of_implementation" class="form-control" id="current_datetime" readonly>
                    </div>
                    <button type="submit" name="create" class="btn btn-primary">Add Law</button>
                </form>
            </div>
        </div>

        <!-- Display All Laws -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Existing Labour Wage Laws</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="wageLawsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>State</th>
                            <th>Minimum Wage Rate</th>
                            <th>Sector</th>
                            <th>Date of Implementation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['state']; ?></td>
                                <td><?php echo $row['min_wage_rate']; ?></td>
                                <td><?php echo $row['sector']; ?></td>
                                <td><?php echo $row['date_of_implementation']; ?></td>
                                <td>
                                    <!-- Update and Delete actions -->
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateModal<?php echo $row['id']; ?>">Update</button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $row['id']; ?>">Delete</button>
                                </td>
                            </tr>

                           <!-- Update Modal -->
<div class="modal fade" id="updateModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel<?php echo $row['id']; ?>">Update Labour Wage Law</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label for="state">State</label>
                        <select name="state" class="form-control" required>
                            <?php foreach ($states as $state) { ?>
                                <option value="<?php echo $state; ?>" <?php echo $state == $row['state'] ? 'selected' : ''; ?>>
                                    <?php echo $state; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="min_wage_rate">Minimum Wage Rate</label>
                        <input type="number" name="min_wage_rate" class="form-control" value="<?php echo $row['min_wage_rate']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="sector">Sector</label>
                        <select name="sector" class="form-control" required>
                            <?php foreach ($sectors as $sector) { ?>
                                <option value="<?php echo $sector; ?>" <?php echo $sector == $row['sector'] ? 'selected' : ''; ?>>
                                    <?php echo $sector; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_of_implementation">Date of Implementation</label>
                        <input type="text" name="date_of_implementation" class="form-control" value="<?php echo $row['date_of_implementation']; ?>" readonly required>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Update Law</button>
                </form>
            </div>
        </div>
    </div>
</div>


                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel<?php echo $row['id']; ?>">Delete Labour Wage Law</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this wage law?</p>
                                            <form method="POST" action="">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <?php include('footer.php'); ?>

         <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">Click "Logout" to end your session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-success" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- JS Libraries -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

    <script>
        // Automatically populate the current date and time
        document.getElementById("current_datetime").value = new Date().toISOString().split('T')[0];
    </script>
</body>

</html>
