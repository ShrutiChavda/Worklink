<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certifications & Skill Assessments - Worklink Dashboard</title>

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
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?certifications,skills') no-repeat center center/cover;
        text-align: center;
    }

    .certification-card {
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

    .certification-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .certification-table th,
    .certification-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .certification-table th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>

    <?php include 'includes/nav.php'; ?>

    <div class="hero animate__animated animate__fadeIn">
        <h1>Boost Your Career with Skill Certifications!</h1>
        <div class="search-bar">
            <input type="text" placeholder="Search Certifications...">
            <select>
                <option value="">Category</option>
                <option value="Technical">Technical</option>
                <option value="Soft Skills">Soft Skills</option>
                <option value="IT">IT</option>
                <option value="Healthcare">Healthcare</option>
            </select>
            <select>
                <option value="">Location</option>
                <option value="Online">Online</option>
                <option value="Mumbai">Mumbai</option>
                <option value="Delhi">Delhi</option>
            </select>
            <button class="btn btn-primary">Find Certifications</button>
        </div>
    </div>

    <div class="container mt-4">
        <section class="section-container">
            <h2 class="section-title">National Skill Certification Portal</h2>
            <p>Quick Links to Certification Schemes:</p>
            <div class="row">
                <div class="col-md-3">
                    <a href="#" class="btn btn-outline-primary btn-block">PMKVY</a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="btn btn-outline-primary btn-block">Skill India Digital</a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="btn btn-outline-primary btn-block">NSDC</a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="btn btn-outline-primary btn-block">Sector Skill Councils</a>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-success">Visit the Certification Portal</a>
            </div>
        </section>

        <section class="section-container">
            <h2 class="section-title">Government Recognized Certificates</h2>
            <div class="certification-table">
                <table>
                    <thead>
                        <tr>
                            <th>Sector</th>
                            <th>Certification Name</th>
                            <th>Issued By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>IT & Software</td>
                            <td>Digital Marketing Certification</td>
                            <td>NSDC</td>
                        </tr>
                        <tr>
                            <td>Manufacturing</td>
                            <td>CNC Machine Training</td>
                            <td>Skill India</td>
                        </tr>
                        <tr>
                            <td>Healthcare</td>
                            <td>Nursing Assistant</td>
                            <td>Ministry of Health</td>
                        </tr>
                        <tr>
                            <td>Electrician</td>
                            <td>Electrical Technician</td>
                            <td>ITI</td>
                        </tr>
                        <tr>
                            <td>Construction</td>
                            <td>Safety & Welding Training</td>
                            <td>Sector Skill Council</td>
                        </tr>
                        <tr>
                            <td>Hospitality</td>
                            <td>Hotel Management Training</td>
                            <td>FICSI</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-primary">Get Certified Now</a>
            </div>
        </section>

        <section class="section-container">
            <h2 class="section-title">Test Centers & Online Exams</h2>
            <div class="row">
                <div class="col-md-6">
                    <h3>Test Centers</h3>
                    <p>Find a Test Center Near You:</p>
                    <div class="map-placeholder" style="height: 200px; border: 1px solid #ddd;">
                        Map Integration Here
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-info">Find a Test Center</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Online Skill Assessments</h3>
                    <p>Take AI-powered assessments from home:</p>
                    <ul>
                        <li>Instant certification upon passing</li>
                        <li>Mock practice tests available</li>
                    </ul>
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-warning">Take Online Test</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-container">
            <h2 class="section-title">How to Apply for Certifications?</h2>
            <div class="row">
                <div class="col-md-3 text-center">
                    <i class="fas fa-search fa-3x"></i>
                    <p>Choose a Certification</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-file-alt fa-3x"></i>
                    <p>Check Eligibility</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-edit fa-3x"></i>
                    <p>Register for the Exam</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-check-circle fa-3x"></i>
                    <p>Take the Assessment</p>
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