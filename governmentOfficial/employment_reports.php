<?php 
include('session.php'); 
include('connection.php');

// Ensure table exists
mysqli_query($con, "CREATE TABLE IF NOT EXISTS employment_analytics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    year YEAR NOT NULL,
    employment_rate DECIMAL(5,2),
    job_seekers VARCHAR(20),
    skill_centers INT,
    nsqf_programs INT
)");

// Fetch latest year record for cards
$latestData = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM employment_analytics ORDER BY year DESC LIMIT 1"));

// Fetch all for chart
$chartData = mysqli_query($con, "SELECT * FROM employment_analytics ORDER BY year ASC");
$years = $rates = [];
while ($row = mysqli_fetch_assoc($chartData)) {
    $years[] = $row['year'];
    $rates[] = $row['employment_rate'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reports & Analytics</title>
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
</head>

<body id="page-top">
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Reports & Analytics <small class="text-muted">(Employment Rate)</small></h1>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Employment Rate</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $latestData['employment_rate'] ?>%</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Job Seekers</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $latestData['job_seekers'] ?></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Skill Centers</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $latestData['skill_centers'] ?>+</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">NSQF Programs</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $latestData['nsqf_programs'] ?>+</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Employment Growth (Last 5 Years)</h6>
        </div>
        <div class="card-body">
            <canvas id="employmentChart" width="100%" height="30"></canvas>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below to end your session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-success" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('employmentChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($years) ?>,
        datasets: [{
            label: 'Employment Rate (%)',
            data: <?= json_encode($rates) ?>,
            backgroundColor: 'rgba(78, 115, 223, 0.05)',
            borderColor: 'rgba(78, 115, 223, 1)',
            borderWidth: 2,
            pointRadius: 3,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: false,
                title: {
                    display: true,
                    text: 'Percentage (%)'
                }
            }
        }
    }
});
</script>
</body>
</html>
