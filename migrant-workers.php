<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Migrant Workers Support - Worklink Dashboard</title>

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
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?migrant,workers') no-repeat center center/cover;
        text-align: center;
    }

    .support-card {
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

    .support-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .support-table th,
    .support-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .support-table th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>

    <?php include 'includes/nav.php'; ?>

    <div class="hero animate__animated animate__fadeIn">
        <h1>Need Shelter & Food? Find Government Support Centers Near You</h1>
        <div class="search-bar">
            <input type="text" placeholder="Enter Location">
            <select>
                <option value="">Assistance Type</option>
                <option value="Shelter">Shelter</option>
                <option value="Food">Food</option>
                <option value="Legal Aid">Legal Aid</option>
                <option value="Financial Support">Financial Support</option>
            </select>
            <button class="btn btn-primary">Find Assistance</button>
        </div>
    </div>

    <div class="container mt-4">
        <section class="section-container">
            <h2 class="section-title">Shelter & Food Assistance</h2>
            <div class="row">
                <div class="col-md-6">
                    <h3>Shelter Assistance</h3>
                    <p>Government Night Shelters in Major Cities</p>
                    <p>Find Emergency Housing for Migrant Workers</p>
                </div>
                <div class="col-md-6">
                    <h3>Free Food Distribution Centers</h3>
                    <p>Mid-day Meal & Ration Assistance</p>
                    <p>NGO Food Drives & Government Schemes</p>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-success">Find Shelter & Food Centers</a>
            </div>
        </section>

        <section class="section-container">
            <h2 class="section-title">Legal Rights for Migrant Workers</h2>
            <div class="row">
                <div class="col-md-6">
                    <h3>Key Labour Laws for Migrants</h3>
                    <ul>
                        <li>Inter-State Migrant Workmen Act, 1979</li>
                        <li>Minimum Wages Act, 1948</li>
                        <li>Factories Act, 1948</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3>Legal Aid & Helplines</h3>
                    <p>Get Free Legal Assistance from Government & NGOs</p>
                    <p>Report Unfair Treatment at Workplace</p>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-primary">Know Your Legal Rights</a>
            </div>
        </section>

        <section class="section-container">
            <h2 class="section-title">Financial Aid & Employment Opportunities</h2>
            <div class="row">
                <div class="col-md-6">
                    <h3>Government Schemes for Financial Support</h3>
                    <ul>
                        <li>PM Garib Kalyan Yojana</li>
                        <li>State-Specific Worker Welfare Schemes</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3>Skill Development & Job Portals</h3>
                    <p>Find Jobs Based on Your Skills!</p>
                    <p>Government Training Programs for Skill Development!</p>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-info">Apply for Jobs & Training</a>
            </div>
        </section>

        <section class="section-container">
            <h2 class="section-title">Emergency Contact & Support Centers</h2>
            <div class="row">
                <div class="col-md-6">
                    <h3>Emergency Helplines</h3>
                    <ul>
                        <li>National Migrant Worker Helpline: 1800-XXX-XXXX</li>
                        <li>Labour Welfare Board Contact</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3>List of State Support Centers</h3>
                    <ul>
                        <li>Delhi | Mumbai | Kolkata | Chennai | Hyderabad | Bengaluru</li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-danger">Contact Support Now</a>
            </div>
        </section>

        <section class="section-container">
            <h2 class="section-title">Success Stories & Testimonials</h2>
            <div class="testimonial">
                <p>"Ravi from Bihar Found a Job & Training Through This Portal!"</p>
            </div>
            <div class="testimonial">
                <p>"Seema Got Free Legal Help to Claim Her Wages!"</p>
            </div>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-secondary">Read More Success Stories</a>
            </div>
        </section>

        <section class="section-container">
            <h2 class="section-title">FAQs & Support Chat</h2>
            <div class="row">
                <div class="col-md-6">
                    <h3>Common FAQs:</h3>
                    <ul>
                        <li>How can I find food assistance?</li>
                        <li>Where can I file a workplace complaint?</li>
                        <li>How do I get financial aid as a migrant worker?</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-warning">Live Chat Support</a>
                    </div>
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