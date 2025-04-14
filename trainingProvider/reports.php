<?php
include('session.php');
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Skill Development Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    @media (max-width: 576px) {
        .card-body .h5 {
            font-size: 1rem;
        }
    }
    </style>
</head>

<body id="page-top">
    <?php include('sidebar.php'); include('header.php'); ?>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Training Reports & Analytics</h1>
        <div class="row">
            <?php
        $stats = [
            ["Training Programs", 7, "fas fa-chalkboard-teacher", "success"],
            ["Enrollments", 12, "fas fa-user-check", "info"],
            ["Certificates Issued", 8, "fas fa-certificate", "warning"],
            ["Assessments", 2, "fas fa-file-alt", "danger"],
        ];
        foreach ($stats as $stat) {
            echo '
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card border-left-' . $stat[3] . ' shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">' . $stat[0] . '</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">' . $stat[1] . '</div>
                            </div>
                            <div class="col-auto">
                                <i class="' . $stat[2] . ' fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
        ?>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header font-weight-bold">Training Program Overview</div>
                    <div class="card-body">
                        <canvas id="programChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header font-weight-bold">Training Statistics</div>
                    <div class="card-body">
                        <canvas id="trainingStatsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-success" href="logout.php">Logout</a>
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
    <script>
    const chartData = {
        labels: ['Training Programs', 'Enrollments', 'Certificates Issued', 'Assessments'],
        datasets: [{
            label: 'Total Count',
            data: [7, 12, 8, 2],
            backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e', '#e74a3b'],
            borderColor: ['#4e73df', '#1cc88a', '#f6c23e', '#e74a3b'],
            borderWidth: 1
        }]
    };

    new Chart(document.getElementById('programChart'), {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    new Chart(document.getElementById('trainingStatsChart'), {
        type: 'pie',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
    </script>
</body>

</html>