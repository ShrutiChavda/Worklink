<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employment Reports & Statistics - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?employment,statistics') no-repeat center center/cover;
            text-align: center;
        }

        .report-card {
            border: 1px solid #eee;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .category-section {
            border: 1px solid #eee;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .testimonial {
            border: 1px solid #eee;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .slick-slide img {
            width: 100%;
            height: auto;
        }

        .section-container {
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid #eee;
            border-radius: 8px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .report-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .report-table th, .report-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .report-table th {
            background-color: #f2f2f2;
        }

        .sticky-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="hero animate__animated animate__fadeIn">
    <h1>Employment Insights: Stay Ahead with Data-Driven Reports</h1>
    <div class="mt-3">
        <a href="#reports" class="btn btn-primary">Explore Reports</a>
    </div>
</div>

<div class="container mt-4">
    <section class="section-container">
        <h2 class="section-title">Introduction</h2>
        <p>Employment reports and statistics provide valuable insights into the job market, labor trends, and sector-wise growth. These data-driven reports help individuals and businesses make informed decisions.</p>
        <div class="text-center mt-3">
            <img src="https://source.unsplash.com/600x400/?employment,data" alt="Employment Data" class="img-fluid">
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Current Employment Trends</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="report-card">
                    <h3>IT Sector Growth</h3>
                    <p>Tech jobs increased by 15% in the last year.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="report-card">
                    <h3>Healthcare Employment</h3>
                    <p>Nursing demand surged by 20% post-pandemic.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="report-card">
                    <h3>Manufacturing Jobs</h3>
                    <p>Factory workforce expansion by 10%.</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="#" class="btn btn-info">View More Trends</a>
        </div>
    </section>

    <section id="reports" class="section-container">
        <h2 class="section-title">Government Labour Reports</h2>
        <div class="report-table">
            <table>
                <thead>
                    <tr>
                        <th>Report Name</th>
                        <th>Year</th>
                        <th>Download Link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>National Employment Report</td>
                        <td>2024</td>
                        <td><a href="#" class="btn btn-sm btn-primary">Download PDF</a></td>
                    </tr>
                    <tr>
                        <td>Labour Market Analysis</td>
                        <td>2023</td>
                        <td><a href="#" class="btn btn-sm btn-primary">Download PDF</a></td>
                    </tr>
                    <tr>
                        <td>State-wise Workforce Report</td>
                        <td>2022</td>
                        <td><a href="#" class="btn btn-sm btn-primary">Download PDF</a></td>
                    </tr>
                    <tr>
                        <td>Women in Workforce</td>
                        <td>2021</td>
                        <td><a href="#" class="btn btn-sm btn-primary">Download PDF</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-3">
            <a href="#" class="btn btn-secondary">View Full Archive</a>
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Job Growth Forecast</h2>
        <canvas id="jobGrowthChart" width="400" height="200"></canvas>
        <div class="text-center mt-3">
            <a href="#" class="btn btn-primary">Explore Future Job Trends</a>
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Sector-wise Employment Data</h2>
        <div class="accordion" id="sectorDataAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        IT & Software Development
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#sectorDataAccordion">
                    <div class="accordion-body">
                        500K new jobs in 2024.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Manufacturing & Engineering
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#sectorData
                aria-expanded="false" aria-controls="collapseTwo">
                        Manufacturing & Engineering
                    </button>
                </h2>
            </div>
    </section>
    </div>
    <?php include '../includes/footer.php'; ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="../assets/js/script.js"></script>

</body>

</html>