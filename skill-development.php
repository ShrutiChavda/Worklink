<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill Development - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/departments.css">
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
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?digital,login') no-repeat center center/cover;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        font-size: 2rem;
    }

    .section-image {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .report-link {
        display: block;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-decoration: none;
        color: #333;
    }

    .report-link:hover {
        background-color: #f0f0f0;
    }

    .training-program {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 5px;
    }

    .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        border: 1px solid #ddd;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        max-height: 80vh;
        overflow-y: auto;
    }

    .popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }
    </style>
</head>

<body>

    <?php include 'includes/nav.php'; ?>

    <div class="hero animate__animated animate__fadeIn">
        <h1>Skill Development</h1>
    </div>

    <div class="container mt-4">
        <h1 class="text-primary text-center">Government Skill Development Programs</h1>
        <p class="text-center">Enhance your skills with government-approved training programs and funding options.</p>

        <div class="section-container">
            <section class="mt-4 text-center">
                <h2>Training Programs</h2>
                <p>Explore various skill training programs across different sectors:</p>

                <div class="training-program">
                    <h3>Information Technology (IT)</h3>
                    <p>Programs in software development, cybersecurity, data analytics, and digital marketing.</p>
                    <img src="https://www.skillindiadigital.gov.in/assets/images/courses/it.webp"
                        class="section-image img-fluid" alt="IT Training">
                </div>

                <div class="training-program">
                    <h3>Manufacturing</h3>
                    <p>Training in machine operation, welding, fabrication, and quality control.</p>
                    <img src="https://www.msde.gov.in/sites/default/files/inline-images/Manufacturing.jpg"
                        class="section-image img-fluid" alt="Manufacturing Training">
                </div>

                <div class="training-program">
                    <h3>Healthcare</h3>
                    <p>Programs for medical assistants, nursing, pharmacy technicians, and healthcare administration.
                    </p>
                    <img src="https://www.skillindiadigital.gov.in/assets/images/courses/healthcare.webp"
                        class="section-image img-fluid" alt="Healthcare Training">
                </div>

                <div class="training-program">
                    <h3>Agriculture</h3>
                    <p>Training in modern farming techniques, horticulture, and agricultural technology.</p>
                    <img src="https://www.skillindiadigital.gov.in/assets/images/courses/agriculture.webp"
                        class="section-image img-fluid" alt="Agriculture Training">
                </div>

                <button class="btn btn-primary btn-custom" onclick="openPopup('coursesPopup')">View All
                    Programs</button>
            </section>
        </div>

        <div class="section-container">
            <section class="mt-4 text-center">
                <h2>Skill Certification Schemes</h2>
                <p>Get certified in various trades through government-recognized schemes:</p>
                <p>The National Skill Qualification Framework (NSQF) ensures standardized and nationally recognized
                    skill certifications. Learn how to get certified in your chosen trade and enhance your
                    employability.</p>
                <button class="btn btn-info btn-custom" onclick="openPopup('nsqfPopup')">Learn About NSQF</button>
            </section>
        </div>

        <div class="section-container">
            <section class="mt-4 text-center">
                <h2>Financial Aid & Scholarships</h2>
                <p>Explore financial assistance options for skill training:</p>
                <p>Government subsidies and scholarships are available to support your skill development journey. Find
                    out about eligibility criteria and application processes.</p>
                <button class="btn btn-success btn-custom" onclick="openPopup('schemesPopup')">Explore Financial
                    Aid</button>
            </section>
        </div>

        <div class="section-container">
            <section class="mt-4 text-center">
                <h2>Skill Development Centers</h2>
                <p>Locate training centers across states:</p>
                <p>Find government-approved skill development centers in your region. These centers offer a range of
                    training programs and resources.</p>
                <button class="btn btn-warning btn-custom" onclick="openPopup('centersPopup')">Find Training
                    Centers</button>
            </section>
        </div>
    </div>

    <div class="popup" id="coursesPopup">
        <h2>All Training Programs</h2>
        <p>Detailed list of all available training programs.</p>
        <button onclick="closePopup('coursesPopup')">Close</button>
    </div>

    <div class="popup" id="nsqfPopup">
        <h2>National Skill Qualification Framework (NSQF)</h2>
        <p>Information about NSQF and its benefits.</p>
        <button onclick="closePopup('nsqfPopup')">Close</button>
    </div>

    <div class="popup" id="schemesPopup">
        <h2>Financial Aid & Scholarships</h2>
        <p>Details on available financial aid and scholarship schemes.</p>
        <button onclick="closePopup('schemesPopup')">Close</button>
    </div>

    <div class="popup" id="centersPopup">
        <h2>Skill Development Centers</h2>
        <p>List of government-approved skill development centers.</p>
        <button onclick="closePopup('centersPopup')">Close</button>
    </div>

    <div class="popup-overlay" id="popupOverlay"></div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function openPopup(popupId) {
        document.getElementById(popupId).style.display = 'block';
        document.getElementById('popupOverlay').style.display = 'block';
    }

    function closePopup(popupId) {
        document.getElementById(popupId).style.display = 'none';
        document.getElementById('popupOverlay').style.display = 'none';
    }
    </script>