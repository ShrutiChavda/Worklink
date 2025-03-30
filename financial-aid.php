<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Aid for Training - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll("button").forEach(element => {
            element.addEventListener("click", function(event) {
                event.preventDefault();
                window.location.href = "login.php";
            });
        });
    });
    </script>
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
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?financial,aid') no-repeat center center/cover;
        text-align: center;
    }

    .aid-card {
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

    .aid-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .aid-table th,
    .aid-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .aid-table th {
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

    <?php include 'includes/nav.php'; ?>

    <div class="hero animate__animated animate__fadeIn">
        <h1>Funding Your Future: Explore Financial Aid for Skill Training</h1>
        <div class="mt-3">
            <a href="#scholarships" class="btn btn-primary">Check Available Scholarships</a>
        </div>
    </div>

    <div class="container mt-4">
        <section class="section-container">
            <h2 class="section-title">Introduction</h2>
            <p>Financial aid options are available to support individuals in pursuing skill training and education.
                These options include government and private scholarships, grants, loans, and employer-sponsored
                training programs.</p>
            <div class="text-center mt-3">
                <img src="https://source.unsplash.com/600x400/?scholarship,training" alt="Training Programs"
                    class="img-fluid">
            </div>
        </section>

        <section id="scholarships" class="section-container">
            <h2 class="section-title">Government & Private Scholarships</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="aid-card">
                        <img src="https://via.placeholder.com/100" alt="NSDC Training Grants" class="img-fluid mb-3">
                        <h3>NSDC Training Grants</h3>
                        <p>Free training for unemployed youth.</p>
                        <a href="#" class="btn btn-sm btn-success">Apply Now</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="aid-card">
                        <img src="https://via.placeholder.com/100" alt="PMKVY Stipend Program" class="img-fluid mb-3">
                        <h3>PMKVY Stipend Program</h3>
                        <p>Monthly stipend for skill trainees.</p>
                        <a href="#" class="btn btn-sm btn-success">Apply Now</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="aid-card">
                        <img src="https://via.placeholder.com/100" alt="Private Scholarships" class="img-fluid mb-3">
                        <h3>Private Scholarships</h3>
                        <p>Funding by NGOs and corporations.</p>
                        <a href="#" class="btn btn-sm btn-success">Apply Now</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-container">
            <h2 class="section-title">Eligibility & Application Process</h2>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0"
                    aria-valuemax="100">1. Check Eligibility</div>
                <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0"
                    aria-valuemax="100">2. Select Program</div>
                <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0"
                    aria-valuemax="100">3. Gather Documents</div>
                <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0"
                    aria-valuemax="100">4. Submit Application</div>
                <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0"
                    aria-valuemax="100">5. Await Approval</div>
            </div>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-primary">Apply for Aid</a>
            </div>
        </section>

        <section class="section-container">
            <h2 class="section-title">Loan & Credit Support</h2>
            <div class="row">
                <div class="col-md-3 text-center">
                    <i class="fas fa-university fa-3x"></i>
                    <p>Government Education Loans</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-piggy-bank fa-3x"></i>
                    <p>Bank Credit Schemes</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-hand-holding-usd fa-3x"></i>
                    <p>NSDC Loan Assistance</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-file-invoice-dollar fa-3x"></i>
                    <p>Repayment & Subsidy Details</p>
                </div>
            </div>
        </section>
    </div>
    <?php include 'includes/footer.php'; ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>