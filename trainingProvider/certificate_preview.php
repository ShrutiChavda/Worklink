<?php
include('connection.php');
session_start(); // Start session to access session data

$id = $_GET['id'];
$sql = "SELECT c.*, u.full_name, p.course_name 
        FROM certificates c 
        JOIN users u ON c.user_id = u.id 
        JOIN training_programs p ON c.training_program_id = p.id 
        WHERE c.id = '$id'";
$res = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($res);

// Get training provider full name from session
$provider_name = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Training Provider';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Certificate Preview</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        body { font-family: 'Georgia', serif; background: #f4f4f4; }
        .cert-container { padding: 40px; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .cert {
            background: #fff;
            padding: 50px;
            border: 8px double #333;
            width: 800px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            position: relative;
            text-align: center;
        }
        .cert h1 { font-size: 32px; margin-bottom: 10px; color: #2c3e50; }
        .cert h2 { font-size: 26px; margin: 20px 0; color: #34495e; }
        .cert h3 { font-size: 22px; color: #7f8c8d; margin-bottom: 20px; }
        .cert p { font-size: 18px; color: #555; }
        .cert .footer {
            margin-top: 40px;
            text-align: center;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
        .cert .logo {
            position: absolute;
            top: 30px;
            left: 30px;
            width: 100px;
        }
        .btn-download {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
        .btn-download button {
            background: #28a745;
            border: none;
            padding: 10px 10px;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-download button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
<div class="cert-container">
    <div class="cert" id="certificate">
        <img src="img/favicon.png" class="logo" alt="WorkLink Logo">
        <h1>Certificate of Completion</h1>
        <p>This is to certify that</p>
        <h2><?= $data['full_name'] ?></h2>
        <p>has successfully completed</p>
        <h3><?= $data['course_name'] ?></h3>
        <p>under the training provider</p>
        <h3><?= $provider_name ?></h3>
        <p>Certificate No: <strong><?= $data['certificate_number'] ?></strong></p>
        <p>Date: <?= date('d M Y', strtotime($data['issue_date'])) ?></p>
        <div class="footer">
            <p><strong>WorkLink Skill Development Initiative</strong></p>
        </div>
    </div>
</div>

<div class="btn-download">
    <button onclick="downloadPDF()">Download Certificate</button>
</div>

<script>
    function downloadPDF() {
        const element = document.getElementById('certificate');
        html2pdf().from(element).save('certificate_<?= $data['certificate_number'] ?>.pdf');
    }
</script>
</body>
</html>
