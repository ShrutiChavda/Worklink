<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Services & Registration - Worklink Dashboard</title>

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
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?employer,services') no-repeat center center/cover;
        text-align: center;
    }

    .employer-card {
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

    .employer-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .employer-table th,
    .employer-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .employer-table th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>

    <?php include 'includes/nav.php'; ?>

    <div class="hero animate__animated animate__fadeIn">
        <h1>Hire Skilled Professionals for Your Business!</h1>
        <div class="mt-3">
            <a href="#" class="btn btn-primary me-2">Register as Employer</a>
            <a href="#" class="btn btn-success">Login to Dashboard</a>
        </div>
    </div>

    <div class="container mt-4">
        <section class="section-container">
            <h2 class="section-title">Employer Login & Dashboard</h2>
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password">
                </div>
                <a href="#">Forgot Password?</a>
                <button type="submit" class="btn btn-success mt-3">Go to Dashboard</button>
            </form>
        </section>

        <section class="section-container">
            <h2 class="section-title">Post Job Openings</h2>
            <form>
                <div class="mb-3">
                    <label for="jobTitle" class="form-label">Job Title</label>
                    <input type="text" class="form-control" id="jobTitle" placeholder="Enter job title">
                </div>
                <div class="mb-3">
                    <label for="jobCategory" class="form-label">Job Category</label>
                    <select class="form-select" id="jobCategory">
                        <option value="IT">IT</option>
                        <option value="Manufacturing">Manufacturing</option>
                        <option value="Healthcare">Healthcare</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jobDescription" class="form-label">Job Description</label>
                    <textarea class="form-control" id="jobDescription" rows="3"
                        placeholder="Enter job description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="salaryRange" class="form-label">Salary Range</label>
                    <input type="text" class="form-control" id="salaryRange" placeholder="Enter salary range">
                </div>
                <div class="mb-3">
                    <label for="workLocation" class="form-label">Work Location</label>
                    <select class="form-select" id="workLocation">
                        <option value="Remote">Remote</option>
                        <option value="On-site">On-site</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="experienceLevel" class="form-label">Experience Level</label>
                    <select class="form-select" id="experienceLevel">
                        <option value="Entry">Entry</option>
                        <option value="Mid">Mid</option>
                        <option value="Senior">Senior</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="applicationDeadline" class="form-label">Application Deadline</label>
                    <input type="date" class="form-control" id="applicationDeadline">
                </div>
                <div class="mb-3">
                    <label for="jobDocument" class="form-label">Upload Job Document (Optional)</label>
                    <input type="file" class="form-control" id="jobDocument">
                </div>
                <button type="submit" class="btn btn-primary">Submit Job Post</button>
            </form>
        </section>

        <section class="section-container">
            <h2 class="section-title">Verify Worker Certifications</h2>
            <form>
                <div class="mb-3">
                    <label for="certificateId" class="form-label">Enter Certificate ID</label>
                    <input type="text" class="form-control" id="certificateId" placeholder="Enter certificate ID">
                </div>
                <div class="mb-3">
                    <label for="workerName" class="form-label">Enter Worker Name (Optional)</label>
                    <input type="text" class="form-control" id="workerName" placeholder="Enter worker name">
                </div>
                <button type="submit" class="btn btn-info">Verify Now</button>
            </form>
        </section>

        <section class="section-container">
            <h2 class="section-title">Hiring Resources & Employer Support</h2>
            <div class="row">
                <div class="col-md-6">
                    <h3>Guides & Best Practices</h3>
                    <ul>
                        <li>How to Write an Effective Job Description</li>
                        <li>Hiring Regulations & Compliance in India</li>
                        <li>Government Incentives for Hiring Apprentices</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3>Employer Helpline & Support</h3>
                    <ul>
                        <li>Employer Assistance Contact: 1800-XXX-XXXX</li>
                        <li>Email Support: support@work
                            <span class="badge bg-success">New</span>
                        </li>
                        <li>Live Chat Support: 24/7</li>
                        <li>FAQs & Documentation</li>
                        <li>Partnerships & Collaborations</li>
                    </ul>
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