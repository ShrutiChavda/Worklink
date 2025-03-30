<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services Job Search - Worklink Dashboard</title>

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
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?job,search') no-repeat center center/cover;
        text-align: center;
    }

    .job-card {
        border: 1px solid #eee;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 8px;
    }

    .industry-section {
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

    .job-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .job-table th,
    .job-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .job-table th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>

    <?php include 'includes/nav.php'; ?>

    <div class="hero animate__animated animate__fadeIn">
        <h1>Find Your Dream Job Today!</h1>
        <div class="search-bar">
            <input type="text" placeholder="Search Jobs...">
            <select>
                <option>Location</option>
                <option>City 1</option>
                <option>City 2</option>
            </select>
            <select>
                <option>Industry</option>
                <option>IT</option>
                <option>Healthcare</option>
            </select>
            <button class="btn btn-primary">Find Jobs</button>
        </div>
    </div>

    <div class="container mt-4">
        <section class="section-container">
            <h2 class="section-title">Live Job Listings</h2>
            <div class="job-table">
                <table>
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Job Role</th>
                            <th>Location</th>
                            <th>Salary</th>
                            <th>Apply</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>TCS</td>
                            <td>Software Developer</td>
                            <td>Pune</td>
                            <td>₹6 LPA</td>
                            <td><button class="btn btn-sm btn-success">Apply Now</button></td>
                        </tr>
                        <tr>
                            <td>Wipro</td>
                            <td>Data Analyst</td>
                            <td>Noida</td>
                            <td>₹5.5 LPA</td>
                            <td><button class="btn btn-sm btn-success">Apply Now</button></td>
                        </tr>
                        <tr>
                            <td>Apollo Hospitals</td>
                            <td>Nurse</td>
                            <td>Mumbai</td>
                            <td>₹4 LPA</td>
                            <td><button class="btn btn-sm btn-success">Apply Now</button></td>
                        </tr>
                        <tr>
                            <td>Indian Railways</td>
                            <td>Clerk</td>
                            <td>Delhi</td>
                            <td>₹35,000/month</td>
                            <td><button class="btn btn-sm btn-success">Apply Now</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-3">
                <button class="btn btn-secondary">View More Jobs</button>
            </div>
        </section>

        <section class="section-container">
            <h2 class="section-title">Sector-Wise Job Categories</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="industry-section">
                        <i class="fas fa-laptop"></i> IT & Software
                        <p>Software Developer, Data Scientist, IT Support</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="industry-section">
                        <i class="fas fa-hospital"></i> Healthcare
                        <p>Nurses, Doctors, Lab Technicians</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="industry-section">
                        <i class="fas fa-industry"></i> Manufacturing
                        <p>Machine Operators, Engineers</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="industry-section">
                        <i class="fas fa-building"></i> Government Jobs
                        <p>Railways, Banking, Defense</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="industry-section">
                        <i class="fas fa-graduation-cap"></i> Education
                        <p>Teachers, Tutors, Academic Counselors</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="industry-section">
                        <i class="fas fa-chart-line"></i> Sales & Marketing
                        <p>Business Development, Digital Marketing</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <button class="btn btn-primary">Explore Jobs by Industry</button>
            </div>
        </section>

        <section class="section-container">
            <h2 class="section-title">Job Application Process</h2>
            <div class="row">
                <div class="col-md-3 text-center">
                    <i class="fas fa-search fa-3x"></i>
                    <p>Search for Jobs</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-file-alt fa-3x"></i>
                    <p>Check Job Details</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-upload fa-3x"></i>
                    <p>Upload Your Resume</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-paper-plane fa-3x"></i>
                    <p>Submit Application</p>
                </div>
            </div>
            <div class="text-center mt-3">
                <button class="btn btn-success">Upload Resume & Apply Now</button>
            </div>
        </section>

        <section class="section-container">
            <h2 class="section-title">Job Alerts</h2>
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email Address
                        <span class="text-danger">*</span>
                    </label>
                    <input type="email" class="form-control" id="email" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>
                <div class="mb-3">
                    <label for="job-alert" class="form-label">
                        Job Alerts
                        <span class="text-danger">*</span>
                    </label>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="job-alert" required>
                        <label class="form-check-label" for="job-alert">
                            Receive job alerts related to your job preferences
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Subscribe</button>
    </div>
    </form>
    </section>
    </div>
    <?php include 'includes/footer.php'; ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>