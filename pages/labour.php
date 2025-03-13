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
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/departments.css">

</head>
<body>

<?php include '../includes/nav.php'; ?>

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
            <img src="https://labour.gov.in/sites/default/files/styles/inner_page_banner/public/2023-10/Workers_Rights.jpg?itok=8f6oM6hL" class="section-image img-fluid">
            <a href="../login.php" class="btn btn-primary btn-custom">Learn More</a>
        </section>
    </div>

    <div class="section-container">
        <section class="mt-4 text-center">
            <h2>Grievance Redressal</h2>
            <p>If you face workplace issues, file complaints through the Labour Grievance Redressal system.</p>
            <a href="../login.php" class="btn btn-danger btn-custom">File a Complaint</a>
        </section>
    </div>

    <div class="section-container">
        <section class="mt-4 text-center">
            <h2>Workplace Safety</h2>
            <p>Learn about safety regulations, accident prevention, and emergency protocols at work.</p>
            <img src="https://labour.gov.in/sites/default/files/styles/inner_page_banner/public/2023-10/Workplace_Safety.jpg?itok=x0i7s0Jv" class="section-image img-fluid">
            <a href="../login.php" class="btn btn-warning btn-custom">View Safety Guidelines</a>
        </section>
    </div>

    <div class="section-container">
        <section class="mt-4 text-center">
            <h2>Labour Laws & Regulations</h2>
            <p>Stay updated on the latest labour laws and compliance requirements.</p>
            <a href="../login.php" class="btn btn-info btn-custom">View Labour Laws</a>
        </section>
    </div>

    <div class="section-container">
        <section class="mt-4 text-center">
            <h2>Government Schemes & Benefits</h2>
            <p>Check various government welfare schemes available for workers.</p>
            <img src="https://www.skillindiadigital.gov.in/assets/images/home-page/schemes-benefits.webp" class="section-image img-fluid">
            <a href="../login.php" class="btn btn-success btn-custom">Explore Schemes</a>
        </section>
    </div>

    <div class="section-container">
        <section class="mt-4 text-center">
            <h2>Success Stories</h2>
            <div id="successCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://www.ncs.gov.in/PublishingImages/Success_Stories/Success_Story_1.jpg" class="d-block w-100" alt="Success Story 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Empowering Workers</h5>
                            <p>How government initiatives transformed lives.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://skills.gujarat.gov.in/images/success_stories/success_story_2.jpg" class="d-block w-100" alt="Success Story 2">
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

<?php include '../includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>