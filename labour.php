<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labour Welfare - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/departments.css">

</head>

<body>

    <?php include 'includes/nav.php'; ?>

    <div class="hero animate__animated animate__fadeIn">
        <h1>Labour Welfare & Rights</h1>
    </div>

    <div class="container mt-4">
        <h1 class="text-primary text-center">Labour Welfare</h1>
        <p class="text-center">Find information on workers' rights, grievance redressal, and workplace safety.</p>

        <div class="section-container">
            <section class="mt-4 text-center">
                <h2>Workers' Rights</h2>
                <p>Understand your rights as a worker, including fair wages, working hours, and benefits.</p>
                <img src="https://thumbs.dreamstime.com/b/labor-rights-protection-blue-gradient-concept-icon-labor-rights-protection-blue-gradient-concept-icon-employee-health-safety-192804509.jpg" class="section-image img-fluid">
                <a href="login.php" class="btn btn-primary btn-custom">Learn More</a>
            </section>
        </div>

        <div class="section-container">
            <section class="mt-4 text-center">
                <h2>Grievance Redressal</h2>
                <p>If you face workplace issues, file complaints through the Labour Grievance Redressal system.</p>
                <a href="login.php" class="btn btn-danger btn-custom">File a Complaint</a>
            </section>
        </div>

        <div class="section-container">
            <section class="mt-4 text-center">
                <h2>Workplace Safety</h2>
                <p>Learn about safety regulations, accident prevention, and emergency protocols at work.</p>
                <img src="https://static.vecteezy.com/system/resources/previews/011/060/381/non_2x/workplace-safety-flat-style-illustration-design-free-vector.jpg" class="section-image img-fluid">
                <a href="login.php" class="btn btn-warning btn-custom">View Safety Guidelines</a>
            </section>
        </div>

        <div class="section-container">
            <section class="mt-4 text-center">
                <h2>Labour Laws & Regulations</h2>
                <p>Stay updated on the latest labour laws and compliance requirements.</p>
                <a href="login.php" class="btn btn-info btn-custom">View Labour Laws</a>
            </section>
        </div>

        <div class="section-container">
            <section class="mt-4 text-center">
                <h2>Government Schemes & Benefits</h2>
                <p>Check various government welfare schemes available for workers.</p>
                <img src="https://www.ethika.co.in/wp-content/uploads/2022/06/govt-help-scheme-1200x900.png" class="section-image img-fluid">
                <a href="login.php" class="btn btn-success btn-custom">Explore Schemes</a>
            </section>
        </div>

        <div class="section-container">
            <section class="mt-4 text-center">
                <h2>Success Stories</h2>
                <div id="successCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://thumbs.dreamstime.com/b/employee-survey-customer-feedback-rating-performance-review-five-stars-service-best-experience-feedback-engagement-356263053.jpg" class="d-block w-100" alt="Success Story 1">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Empowering Workers</h5>
                                <p>How government initiatives transformed lives.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://res.cloudinary.com/people-matters/image/upload/fl_immutable_cache,w_624,h_351,q_auto,f_auto/v1536251178/1536251033.jpg" class="d-block w-100" alt="Success Story 2">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Skill Training Impact</h5>
                                <p>From laborer to entrepreneur: A success story.</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#successCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#successCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </section>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>