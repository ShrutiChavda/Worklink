<?php include('session.php'); include('connection.php');

// Handle update request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $org = mysqli_real_escape_string($con, $_POST['organization_name']);
    $loc = mysqli_real_escape_string($con, $_POST['head_office_location']);
    $sectors = isset($_POST['training_sectors']) ? implode(', ', $_POST['training_sectors']) : '';

    $update = mysqli_query($con, "UPDATE training_providers SET 
        organization_name='$org',
        head_office_location='$loc',
        training_sectors='$sectors'
        WHERE id='$id'
    ");

    if ($update) {
        echo "<script>location.href='manage_trainers.php';</script>";
    } else {
        echo "<script>alert('Update failed!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Training Providers</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">
<?php include('sidebar.php'); include('header.php'); ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Training Providers</h1>
    <table class="table table-bordered" id="dataTable">
        <thead><tr>
            <th>#</th><th>User Name</th><th>Email</th><th>Organization</th><th>Location</th><th>Sectors</th><th>Actions</th>
        </tr></thead>
        <tbody>
            <?php
            $q = mysqli_query($con, "SELECT tp.*, u.full_name, u.email FROM training_providers tp JOIN users u ON tp.user_id = u.id");
            $i = 1;
            while ($row = mysqli_fetch_array($q)) {
                echo "<tr>
                    <td>{$i}</td>
                    <td>{$row['full_name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['organization_name']}</td>
                    <td>{$row['head_office_location']}</td>
                    <td>{$row['training_sectors']}</td>
                    <td>
                        <button class='btn btn-info btn-sm editBtn' 
                            data-id='{$row['id']}'
                            data-org='{$row['organization_name']}'
                            data-loc='{$row['head_office_location']}'
                            data-sect='{$row['training_sectors']}'
                        >Edit</button>
                        <a href='manage_trainers.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                    </td>
                </tr>";
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$sectors = [
    "Agriculture", "Apparel", "Automotive", "Banking & Finance", "Construction",
    "Electronics", "Food Processing", "Healthcare", "IT/ITeS", "Logistics",
    "Manufacturing", "Retail", "Telecom", "Tourism & Hospitality", "Beauty & Wellness"
];
?>

<!-- Edit Modal -->
<div class="modal fade" id="editModal">
  <div class="modal-dialog"><form method="post" action="manage_trainers.php">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Edit Provider</h5></div>
      <div class="modal-body">
        <input type="hidden" name="id" id="editId">
        <div class="form-group">
            <label>Organization Name</label>
            <input name="organization_name" id="editOrg" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Head Office Location</label>
            <input name="head_office_location" id="editLoc" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Training Sectors</label>
            <select name="training_sectors[]" id="editSect" class="form-control" multiple required>
                <?php foreach ($sectors as $sector) {
                    echo "<option value='$sector'>$sector</option>";
                } ?>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div></form>
  </div>
</div>

<?php include('footer.php'); ?>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function () {
    $('#dataTable').DataTable();

    $('.editBtn').on('click', function () {
        let sectors = $(this).data('sect').split(', ');
        $('#editId').val($(this).data('id'));
        $('#editOrg').val($(this).data('org'));
        $('#editLoc').val($(this).data('loc'));

        $('#editSect option').each(function () {
            $(this).prop('selected', sectors.includes($(this).val()));
        });

        $('#editModal').modal('show');
    });

    $('#editSect').on('change', function () {
        if ($(this).val().includes('All')) {
            $('#editSect option').prop('selected', true);
        }
    });
});
</script>
</body>
</html>
