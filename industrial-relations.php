<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industrial Relations & Safety - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

    <style>
        .hero {
            height: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            font-size: 2rem;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?industrial,safety') no-repeat center center/cover;
            text-align: center;
        }

        .hero-slider {
            width: 100%;
            padding: 20px;
        }

        .hero-slider h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .hero-slider button {
            margin-top: 20px;
        }

        .section-content {
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid #eee;
            border-radius: 8px;
        }

        .section-content h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .section-content ul, .section-content ol {
            list-style-position: inside;
            padding-left: 0;
        }

        .section-content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .section-content th, .section-content td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .section-content th {
            background-color: #f2f2f2;
        }

        .case-study {
            border: 1px solid #eee;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 8px;
        }

        .faq-item {
            border-bottom: 1px solid #eee;
            padding: 15px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .slick-slide img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

<?php include 'includes/nav.php'; ?>

<div class="hero animate__animated animate__fadeIn">
    <h1>Industrial Relations</h1>
</div>

<div class="container mt-4">
    <section class="section-content">
        <h2>Why Industrial Relations Matter?</h2>
        <p>Industrial relations focus on fair treatment, dispute resolution, and worker rights.</p>
        <p><strong>Why It’s Important?</strong></p>
        <ul>
            <li>Prevents workplace conflicts</li>
            <li>Promotes safety & better working conditions</li>
            <li>Ensures fair wages & legal protection</li>
        </ul>
        <img src="https://via.placeholder.com/600x300?text=Employer+🏭+%2B+Employee+👨‍🏭+=+Productive+%26+Safe+Workplace" alt="Industrial Relations Infographic" class="img-fluid">
    </section>

    <section class="section-content">
        <h2>Labour Dispute Resolution (Online Grievance Portal)</h2>
        <p>Helps workers file complaints against unfair wages, wrongful termination, unsafe work conditions, and labor law violations.</p>
        <h3>Common Labour Disputes Covered:</h3>
        <ul>
            <li>Unpaid salaries or delayed wages</li>
            <li>Harassment or discrimination at the workplace</li>
            <li>Wrongful termination</li>
            <li>Unsafe working conditions</li>
            <li>Workplace exploitation</li>
        </ul>
        <h3>Steps to File a Complaint:</h3>
        <ol>
            <li>Go to Online Grievance Portal</li>
            <li>Fill in Work Details (Employer Name, Job Role)</li>
            <li>Select Issue Category (Wages, Harassment, Safety Violation, etc.)</li>
            <li>Upload Supporting Documents (Payslips, Work Contract, Proof of Violation)</li>
            <li>Submit Complaint & Track Status</li>
        </ol>
        <div class="text-center">
            <button class="btn btn-danger">File a Grievance</button>
        </div>
    </section>

    <section class="section-content">
        <h2>Factory Safety Laws & Guidelines</h2>
        <p>Ensures workers & employers follow government-mandated safety laws.</p>
        <h3>Key Safety Regulations Covered:</h3>
        <ul>
            <li>Fire Safety in Factories (Fire exits, emergency drills, fire suppression systems)</li>
            <li>Hazardous Material Handling (Proper storage of chemicals, use of protective gear)</li>
            <li>Worker Safety Equipment (Mandatory helmets, gloves, masks, and harnesses)</li>
            <li>Factory Act, 1948 - Worker Rights (Safe environment, reasonable working hours, ventilation)</li>
            <li>Workplace Ergonomics & Health (Reducing stress, fatigue, injuries)</li>
        </ul>
        <h3>Table of Important Safety Standards:</h3>
        <table>
            <thead>
                <tr>
                    <th>Safety Law</th>
                    <th>Industry</th>
                    <th>Compliance Requirement</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Fire Prevention Act</td>
                    <td>Factories, Warehouses</td>
                    <td>Mandatory Fire Exits & Drills</td>
                </tr>
                <tr>
                    <td>Hazardous Materials Act</td>
                    <td>Chemical, Pharma</td>
                    <td>Proper Storage & Handling</td>
                </tr>
                <tr>
                    <td>Occupational Safety Code</td>
                    <td>All Industries</td>
                    <td>PPE (Safety Gear) Required</td>
                </tr>
                <tr>
                    <td>Industrial Accidents Act</td>
                    <td>Construction, Heavy Industry</td>
                    <td>Worker Compensation Insurance</td>
                </tr>
            </tbody>
        </table>
        <div class="text-center">
            <button class="btn btn-secondary">Download Factory Safety Handbook</button>
        </div>
    </section>

    <section class="section-content">
        <h2>Trade Unions & Workers' Rights</h2>
        <p>Helps workers understand the role of trade unions in fighting for fair wages, job security, and better working conditions.</p>
        <h3>What are Trade Unions?</h3>
        <ul>
            <li>Groups that represent workers' interests against employers.</li>
            <li>Help negotiate better wages, working hours, and job security.</li>
            <li>Provide legal support to workers in case of disputes.</li>
        </ul>
        <h3>List of Major Trade Unions in India:</h3>
        <ul>
            <li>Bharatiya Mazdoor Sangh (BMS)</li>
            <li>Indian National Trade Union Congress (INTUC)</li>
            <li>All India Trade Union Congress (AITUC)</li>
        </ul>
    </section>
    </div>
    <?php include 'includes/footer.php'; ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="assets/js/script.js"></script>

</body>

</html>        