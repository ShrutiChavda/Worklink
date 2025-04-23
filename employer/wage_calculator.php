<?php include('session.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Wage Calculator</title>
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Wage Calculator</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form id="wageForm">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Hours Worked</label>
                        <input type="number" min="0" step="0.1" class="form-control" id="hours" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Hourly Rate (₹)</label>
                        <input type="number" min="0" step="0.1" class="form-control" id="rate" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Deductions (₹)</label>
                        <input type="number" min="0" step="0.1" class="form-control" id="deductions" value="0">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Bonuses (₹)</label>
                        <input type="number" min="0" step="0.1" class="form-control" id="bonuses" value="0">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Calculate Wage</button>
            </form>

            <hr>
            <h5>Total Wage: ₹<span id="totalWage">0.00</span></h5>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<script>
    document.getElementById('wageForm').addEventListener('submit', function (e) {
        e.preventDefault();
        let hours = parseFloat(document.getElementById('hours').value);
        let rate = parseFloat(document.getElementById('rate').value);
        let deductions = parseFloat(document.getElementById('deductions').value);
        let bonuses = parseFloat(document.getElementById('bonuses').value);
        let total = (hours * rate) + bonuses - deductions;
        document.getElementById('totalWage').innerText = total.toFixed(2);
    });
</script>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

</body>
</html>
