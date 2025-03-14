<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrepreneurship & Startup Support - Worklink Dashboard</title>

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
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?entrepreneur,startup') no-repeat center center/cover;
            text-align: center;
        }

        .startup-card {
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

        .startup-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .startup-table th, .startup-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .startup-table th {
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
    <h1>Turn Your Ideas into Reality – Start & Grow Your Business Today</h1>
    <div class="mt-3">
        <a href="#startup-resources" class="btn btn-primary">Explore Startup Resources</a>
    </div>
</div>

<div class="container mt-4">
    <section class="section-container">
        <h2 class="section-title">Introduction</h2>
        <p>Entrepreneurship is vital for economic growth, and the government offers numerous support schemes for startups. This page provides a comprehensive guide to starting and growing your business.</p>
        <div class="text-center mt-3">
            <img src="https://source.unsplash.com/600x400/?business,founders" alt="Business Founders" class="img-fluid">
        </div>
        <div class="text-center mt-3">
            <a href="#" class="btn btn-info">Learn More About Entrepreneurship</a>
        </div>
    </section>

    <section id="startup-resources" class="section-container">
        <h2 class="section-title">How to Register a Startup</h2>
        <ol>
            <li>Choose a Business Structure – Private Ltd., LLP, Sole Proprietorship, etc.</li>
            <li>Register with Government Portals – Udyam, MSME, Startup India.</li>
            <li>Apply for GST & PAN – Legal tax registration requirements.</li>
            <li>Obtain Licenses & Certifications – FSSAI, IEC, etc.</li>
        </ol>
        <div class="text-center mt-3">
            <a href="#" class="btn btn-primary">Start Your Business Registration</a>
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Government Schemes for Entrepreneurs</h2>
        <div class="accordion" id="schemeAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Startup India
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#schemeAccordion">
                    <div class="accordion-body">
                        Tax benefits, incubation support.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Mudra Loan Scheme
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#schemeAccordion">
                    <div class="accordion-body">
                        Loan options for small businesses.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Standup India
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#schemeAccordion">
                    <div class="accordion-body">
                        Special schemes for women & SC/ST entrepreneurs.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Credit Guarantee Fund
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#schemeAccordion">
                    <div class="accordion-body">
                        Reducing financial risk for startups.
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="#" class="btn btn-secondary">View Full List of Schemes</a>
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Funding & Investment</h2>
        <div class="mb-3">
            <label for="businessType" class="form-label">Business Type</label>
            <select class="form-select" id="businessType">
                <option value="IT">IT</option>
                <option value="Finance">Finance</option>
                <option value="Healthcare">Healthcare</option>
                <option value="Education">Education</option>
                <option value="Other">Other</option>
            </select>
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