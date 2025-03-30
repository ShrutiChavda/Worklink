<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Worklink Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
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
</head>

<body>
    <?php include 'includes/nav.php'; ?>

    <div class="container mt-5">
        <div class="text-center">
            <h1 class="fw-bold">About Our Portal</h1>
            <p class="lead">Empowering individuals with employment opportunities, skill development, and labour welfare
                services.</p>
        </div>

        <section id="overview" class="text-center mt-5">
            <div class="container">
                <img src="assets/images/Overviewimg.png" alt="Overview Image" class="img-fluid rounded">
                <h2 class="mt-4">Overview</h2><br>
                <p>Our portal serves as a comprehensive platform integrating various services related to employment,
                    skill development, and labour welfare. By collaborating with national initiatives, we provide users
                    with resources and opportunities for career advancement.</p>
            </div>
        </section>

        <section id="mission" class="mt-5 text-center">
            <div class="container">
                <h2>Mission & Vision</h2><br>
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="https://media.istockphoto.com/id/889968488/photo/skill-concept.jpg?s=612x612&w=0&k=20&c=yDPoLvtvsnNbJQffOO8iMtfofeYLZ-r4PIdFCH7hBtc="
                            class="img-fluid rounded" alt="Mission Image">
                    </div>
                    <div class="col-md-6">
                        <p>Our mission is to bridge the gap between job seekers and employers, promote skill development
                            programs, and ensure labour rights and welfare. We envision a skilled workforce contributing
                            to the nation's economy.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="initiatives" class="mt-5">
            <div class="container">
                <h2 class="text-center">Key Government Initiatives</h2><br>
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <img src="https://media.licdn.com/dms/image/v2/C5612AQG6MflTbTCxfA/article-cover_image-shrink_720_1280/article-cover_image-shrink_720_1280/0/1520083560509?e=2147483647&v=beta&t=wgIf_lW0QjOsYFRBIClNVqBVltMEVv7IupgxNXqwZGU"
                                class="card-img-top" alt="NCS">
                            <div class="card-body">
                                <h5 class="card-title">National Career Service (NCS)</h5>
                                <p class="card-text">A government initiative offering job listings, and employment
                                    services.</p>
                                <a href="https://www.ncs.gov.in/" target="_blank" class="btn btn-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <img src="https://static.mygov.in/static/s3fs-public/mygov_147379768343741641.jpg"
                                class="card-img-top" alt="NSDA">
                            <div class="card-body">
                                <h5 class="card-title">National Skill Development Agency</h5>
                                <p class="card-text">Responsible for harmonizing skill development efforts across India.
                                </p>
                                <a href="https://www.msde.gov.in/en/organizations/nsda" target="_blank"
                                    class="btn btn-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <img src="https://www.devdiscourse.com/remote.axd?https://devdiscourse.blob.core.windows.net/devnews/05_09_2019_16_08_45_9875284.jpg?width=1280"
                                class="card-img-top" alt="Skill India">
                            <div class="card-body">
                                <h5 class="card-title">Skill India Digital Hub</h5>
                                <p class="card-text">A platform for upskilling, reskilling, and lifelong learning
                                    opportunities.</p>
                                <a href="https://www.skillindiadigital.gov.in/home" target="_blank"
                                    class="btn btn-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="statistics" class="mt-5 text-center">
            <div class="container">
                <h2>Statistics & Reports</h2><br>
                <p>We provide up-to-date statistics and reports on employment trends, skill development programs, and
                    labour welfare schemes to help users make informed career decisions.</p>
                <img src="https://cdn2.hubspot.net/hub/53/file-2390462434-png/00-Blog_Thinkstock_Images/analytics-reports.png"
                    class="img-fluid rounded" alt="Statistics Image">
            </div>
        </section>

        <section id="success-stories" class="mt-5 text-center">
            <div class="container">
                <h2>Success Stories</h2><br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <img src="https://static.vecteezy.com/system/resources/thumbnails/015/512/347/small_2x/success-story-to-motivate-people-to-develop-and-improve-to-achieve-life-success-telling-story-or-inspire-people-aspiration-concept-businessman-telling-success-story-with-megaphone-on-winner-trophy-vector.jpg"
                                class="card-img-top" alt="Success Story 1">
                            <div class="card-body">
                                <h5 class="card-title">From Unemployment to Entrepreneurship</h5>
                                <p class="card-text">A story of how skill training helped a candidate launch a startup.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <img src="https://t4.ftcdn.net/jpg/04/38/59/53/360_F_438595346_MMK0Me1ckaIG1lIa6vZawA0BOvS7jnSv.jpg"
                                class="card-img-top" alt="Success Story 2">
                            <div class="card-body">
                                <h5 class="card-title">Securing a Dream Job</h5>
                                <p class="card-text">A job seeker found a high-paying job through our career services.
                                </p>
                            </div>
                        </div>
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