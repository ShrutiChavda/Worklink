<?php
include('connection.php');
session_start();

$id = $_GET['id'];
$sql = "SELECT c.*, u.full_name, p.course_name 
        FROM certificates c 
        JOIN users u ON c.user_id = u.id 
        JOIN training_programs p ON c.training_program_id = p.id 
        WHERE c.id = '$id'";
$res = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($res);

$provider_name = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Training Provider';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Certificate Preview</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Georgia', serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .cert-container {
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .cert {
            background: #fff;
            padding: 50px;
            border: 8px solid #333;
            width: 100%;
            max-width: 900px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
            text-align: center;
            page-break-after: always;
        }

        .cert h1 {
            font-size: 36px;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .cert h2 {
            font-size: 28px;
            margin: 20px 0;
            color: #34495e;
        }

        .cert h3 {
            font-size: 24px;
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        .cert p {
            font-size: 20px;
            color: #555;
        }

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
            display: flex;
            justify-content: center;
            padding: 20px;
            flex-wrap: wrap;
        }

        .btn-download button {
            background: #28a745;
            border: none;
            padding: 12px 20px;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 100%;
            max-width: 300px;
        }

        .btn-download button:hover {
            background: #218838;
        }

        @media (max-width: 500px) {
            .cert {
                padding: 50px 50px;
            }

            .cert h1 {
                font-size: 28px;
            }

            .cert h2 {
                font-size: 24px;
            }

            .cert h3,
            .cert p {
                font-size: 18px;
            }

            .cert .logo {
                width: 10%;
        top: 5%; 
        left: 10%; 
        transform: translateX(-50%); 
    }
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
            const options = {
                filename: 'certificate_<?= $data['certificate_number'] ?>.pdf',
                margin: [-25, 10, 10, 10],
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 3, logging: true, letterRendering: true }, 
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }  
            };
            html2pdf().from(element).set(options).save();
        }
    </script>
</body>

</html>
