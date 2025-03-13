<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill Development Policies - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
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
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?skill,development') no-repeat center center/cover;
            text-align: center;
        }

        .policy-card {
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

        .policy-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .policy-table th, .policy-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .policy-table th {
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
    <h1>Empowering the Workforce with Skills</h1>
    <div class="mt-3">
        <a href="#registration-process" class="btn btn-primary">Explore Skill Programs</a>
    </div>
</div>

<div class="container mt-4">
    <section class="section-container">
        <h2 class="section-title">Introduction</h2>
        <p>Government skill development policies and initiatives are designed to enhance employability and foster economic growth. Skill training programs provide individuals with the necessary skills to secure better job opportunities.</p>
        <div class="text-center mt-3">
            <img src="https://source.unsplash.com/600x400/?training,workshop" alt="Training Programs" class="img-fluid">
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Government Skill Missions</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="policy-card">
                    <img src="https://via.placeholder.com/100" alt="Skill India Mission" class="img-fluid mb-3">
                    <h3>Skill India Mission</h3>
                    <p>Nationwide initiative for skill enhancement.</p>
                    <a href="#" class="btn btn-sm btn-info">Learn More</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="policy-card">
                    <img src="https://via.placeholder.com/100" alt="NSDC" class="img-fluid mb-3">
                    <h3>National Skill Development Corporation (NSDC)</h3>
                    <p>Partnering with training institutes.</p>
                    <a href="#" class="btn btn-sm btn-info">Learn More</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="policy-card">
                    <img src="https://via.placeholder.com/100" alt="PMKVY" class="img-fluid mb-3">
                    <h3>Pradhan Mantri Kaushal Vikas Yojana (PMKVY)</h3>
                    <p>Free training for job seekers.</p>
                    <a href="#" class="btn btn-sm btn-info">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Eligibility Criteria</h2>
        <div class="policy-table">
            <table>
                <thead>
                    <tr>
                        <th>Program</th>
                        <th>Age Limit</th>
                        <th>Educational Qualification</th>
                        <th>Special Categories</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PMKVY</td>
                        <td>18-45 Years</td>
                        <td>8th Pass & Above</td>
                        <td>SC/ST, Women, PwD</td>
                    </tr>
                    <tr>
                        <td>ITI Training</td>
                        <td>16+ Years</td>
                        <td>10th Pass</td>
                        <td>Open to all</td>
                    </tr>
                    <tr>
                        <td>NSDC Skill Courses</td>
                        <td>18-50 Years</td>
                        <td>Varies by Course</td>
                        <td>Youth, Unemployed</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Incentives & Benefits</h2>
        <div class="row">
            <div class="col-md-3 text-center">
                <i class="fas fa-money-bill-wave fa-3x"></i>
                <p>Monthly Stipends</p>
            </div>
            <div class="col-md-3 text-center">
                <i class="fas fa-briefcase fa-3x"></i>
                <p>Job Placement Support</p>
            </div>
            <div class="col-md-3 text-center">
                <i class="fas fa-certificate fa-3x"></i>
                <p>Industry Certification</p>
            </div>
            <div class="col-md-3 text-center">
                <i class="fas fa-book fa-3x"></i>
                <p>Free Training Material</p>
            </div>
        </div>
    </section>

    <section id="registration-process" class="section-container">
        <h2 class="section-title">Registration Process</h2>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">1. Visit Portal</div>
            <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">2. Create Account</div>
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