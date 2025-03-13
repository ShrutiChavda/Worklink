<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labour, Skill Development & Employment</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css"> 
    <link rel="icon" type="image/x-icon" href="../assets/images/team.jpg">
</head>
<body>

<?php include '../includes/nav.php'; ?>
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../assets/images/skills.jpg" class="d-block a" alt="Job Opportunities">
            <div class="carousel-caption d-none d-md-block m-5">
                <h2 class="b">Empowering Job Seekers</h2>
                <p class="ba">Find the best opportunities for your career growth.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="../assets/images/it.jpg" class="d-block a" alt="Skill Development">
            <div class="carousel-caption d-none d-md-block m-5">
                <h2 class="b">Skill Development Programs</h2>
                <p class="ba">Enroll in government-certified training programs.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="../assets/images/team.jpg" class="d-block a" alt="Labour Welfare">
            <div class="carousel-caption d-none d-md-block m-5">
                <h2 class="b">Labour Welfare & Rights</h2>
                <p class="ba">Ensuring fair wages and workplace safety.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
<?php include '../includes/header.php'; ?><br><br>

<section class="announcements container wow fadeInUp" data-wow-duration="1s">
    <h2>Latest Announcements</h2>
    <ul>
        <li>📰 New Job Fairs announced in Gujarat – <a href="#">Read More</a></li>
        <li>🎓 Government-sponsored skill development programs available – <a href="#">Apply Now</a></li>
        <li>⚖️ Updates on labour laws and workers’ rights – <a href="#">Know More</a></li>
    </ul>
</section><br><br>

<section class="login-register container text-center wow zoomIn" data-wow-duration="1s">
    <h2>Get Started</h2>
    <p>Register or login to access job listings, training programs, and labour support</p>
    <a href="../pages/register.php" class="btn btn-success">Register</a>
    <a href="../pages/login.php" class="btn btn-warning">Login</a>
</section><br><br>

<section class="services container">
    <h2 class="text-center wow fadeInDown" data-wow-duration="1s">Our Services</h2><br>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-lg p-3 mb-4 wow bounceInLeft" data-wow-duration="1s">
                <div class="card-body text-center">
                    <i class="fas fa-briefcase fa-3x text-primary mb-3"></i>
                    <h3>Job Search</h3>
                    <p>Find government and private sector jobs matching your skills.</p>
                    <a href="../pages/job-search.php" class="btn btn-primary">Explore</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg p-3 mb-4 wow bounceInUp" data-wow-duration="1s">
                <div class="card-body text-center">
                    <i class="fas fa-chalkboard-teacher fa-3x text-success mb-3"></i>
                    <h3>Skill Development</h3>
                    <p>Enroll in certified skill development programs and vocational training.</p>
                    <a href="../pages/training-programs.php" class="btn btn-success">Learn More</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg p-3 mb-4 wow bounceInRight" data-wow-duration="1s">
                <div class="card-body text-center">
                    <i class="fas fa-balance-scale fa-3x text-warning mb-3"></i>
                    <h3>Labour Welfare</h3>
                    <p>Get support for workplace rights, wages, and safety regulations.</p>
                    <a href="../pages/labour.php" class="btn btn-warning">Read More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<br><br>
<section class="stats container text-center wow fadeIn" data-wow-duration="1s">
    <h2>Impact & Reach</h2><br>
    <div class="row">
        <div class="col-md-3">
            <h3 class="counter text-primary" data-count="500000">0</h3>
            <p>Job Seekers Registered</p>
        </div>
        <div class="col-md-3">
            <h3 class="counter text-success" data-count="2000">0</h3>
            <p>Training Programs Available</p>
        </div>
        <div class="col-md-3">
            <h3 class="counter text-danger" data-count="150000">0</h3>
            <p>Successful Job Placements</p>
        </div>
        <div class="col-md-3">
            <h3 class="counter text-warning" data-count="300">0</h3>
            <p>Government Schemes</p>
        </div>
    </div>
</section><br>

<section class="resources container wow fadeIn" data-wow-duration="1s">
    <h2>Resources</h2>
    <ul>
        <li><a href="../pages/labour-laws.php">Labour Laws & Regulations</a></li>
        <li><a href="../pages/skill-policies.php">Skill Development Policies</a></li>
        <li><a href="../pages/financial-aid.php">Financial Aid for Training</a></li>
        <li><a href="../pages/reports.php">Employment Reports & Statistics</a></li>
    </ul>
</section>

<?php include '../includes/footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="../assets/js/script.js"></script> 

<script>
    new WOW().init();

    // Counter Animation
    $(document).ready(function () {
        $('.counter').each(function () {
            var $this = $(this),
                countTo = $this.attr('data-count');
            $({ countNum: $this.text() }).animate(
                { countNum: countTo },
                {
                    duration: 3000,
                    easing: 'swing',
                    step: function () {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        $this.text(this.countNum);
                    }
                }
            );
        });
    });
</script>

</body>
</html>
