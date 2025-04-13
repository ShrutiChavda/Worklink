<?php include('session.php'); ?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='description' content=''>
    <meta name='author' content=''>

    <title>Blank Page</title>

    <link href='img/favicon.png' rel='icon'>
    <link href='vendor/fontawesome-free/css/all.min.css' rel='stylesheet' type='text/css'>
    <link href='css/sb-admin-2.min.css' rel='stylesheet'>
    <link href='vendor/datatables/dataTables.bootstrap4.min.css' rel='stylesheet'>
    <link href='css/sb-admin-2.css' rel='stylesheet'>
    <link href="css/interview_training.css" rel="stylesheet">
    <script src='js/jquery-3.6.4.min.js'></script>
    <script src='js/search.js'></script>
</head>

<body id='page-top'>
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>



<div class="container-fluid interview-skill-training">
    <div class="intro-banner">
        <h1>Enhance Your Skills & Interview Readiness</h1>
        <p>Comprehensive resources to help you succeed in your career journey</p>
    </div>

    <!-- Featured Training Programs -->
    <section class="featured-section">
        <h2>Featured Training Programs</h2>
        <div class="cards">
            <div class="card">
                <img src="img/Training.jpg" alt="Advanced Interview Mastery">
                <h3>Advanced Interview Mastery</h3>
                <p><i class="fas fa-clock"></i> 8 weeks &nbsp; <i class="fas fa-users"></i> 2.5k+</p>
                <div class="rating">⭐ 4.8</div>
                <a class="btn" href="#">Enroll Now</a>
            </div>
            <div class="card">
                <img src="img/Training.jpg" alt="Technical Interview Prep">
                <h3>Technical Interview Preparation</h3>
                <p><i class="fas fa-clock"></i> 6 weeks &nbsp; <i class="fas fa-users"></i> 3k+</p>
                <div class="rating">⭐ 4.9</div>
                <a class="btn" href="#">Enroll Now</a>
            </div>
            <div class="card">
                <img src="img/Training.jpg" alt="Soft Skills">
                <h3>Soft Skills Development</h3>
                <p><i class="fas fa-clock"></i> 4 weeks &nbsp; <i class="fas fa-users"></i> 1.8k+</p>
                <div class="rating">⭐ 4.7</div>
                <a class="btn" href="#">Enroll Now</a>
            </div>
        </div>
    </section>

    <!-- Learning Tracks -->
    <section class="learning-tracks">
        <h2>Featured Learning Tracks</h2>
        <div class="cards">
            <div class="track-card">
                <img src="img/FullStack.jpg" alt="Full Stack">
                <h4>Full Stack Development</h4>
                <p><i class="fas fa-clock"></i> 12 weeks • Intermediate</p>
                <div class="progress-bar"><div style="width: 75%;">75% Complete</div></div>
                <a href="#">Continue</a>
            </div>
            <div class="track-card">
                <img src="img/DataScience.jpg" alt="Data Science">
                <h4>Data Science Fundamentals</h4>
                <p><i class="fas fa-clock"></i> 8 weeks • Beginner</p>
                <div class="progress-bar"><div style="width: 45%;">45% Complete</div></div>
                <a href="#">Continue</a>
            </div>
            <div class="track-card">
                <img src="img/Cloud.jpg" alt="Cloud">
                <h4>Cloud Computing</h4>
                <p><i class="fas fa-clock"></i> 10 weeks • Advanced</p>
                <div class="progress-bar"><div style="width: 30%;">30% Complete</div></div>
                <a href="#">Continue</a>
            </div>
        </div>
    </section>

    <!-- Skill Courses -->
    <section class="skills-section">
        <h2>Popular Skill Courses</h2>
        <div class="skill-grid">
            <div class="skill-box">🌐 Communication Skills<br><small>24 Courses</small></div>
            <div class="skill-box">👥 HR Interview Skills<br><small>18 Courses</small></div>
            <div class="skill-box">🛠 Technical Skills<br><small>32 Courses</small></div>
            <div class="skill-box">💬 Group Discussion<br><small>12 Courses</small></div>
            <div class="skill-box">📽 Presentation Skills<br><small>15 Courses</small></div>
            <div class="skill-box">📊 Assessment Preparation<br><small>20 Courses</small></div>
        </div>
    </section>

    <!-- Govt Schemes -->
    <section class="govt-section">
        <h2>Government Training Programs</h2>
        <div class="cards">
            <div class="govt-card">
                <h4>PMKVY</h4>
                <p>Skill development initiative for Indian youth</p>
                <small>⏱ 3-6 months • 👥 Age 18-35</small>
                <a href="#">Learn More →</a>
            </div>
            <div class="govt-card">
                <h4>Apprenticeship Scheme</h4>
                <p>On-the-job training with stipend</p>
                <small>⏱ 1 year • 🎓 Graduates/Diploma holders</small>
                <a href="#">Learn More →</a>
            </div>
        </div>
    </section>

    <!-- Videos & Downloads -->
    <section class="extras-section">
        <div class="video-tutorials">
            <h2>🎥 Video Tutorials</h2>
            <ul>
                <li>▶️ Mock Interview Demonstrations</li>
                <li>▶️ Body Language Tips</li>
                <li>▶️ Common Interview Questions</li>
                <li>▶️ Industry-specific Preparation</li>
            </ul>
        </div>
        <div class="downloads">
            <h2>📥 Downloadable Resources</h2>
            <ul>
                <li><a href="#">📄 Interview Question Bank</a></li>
                <li><a href="#">📄 Resume Templates</a></li>
                <li><a href="#">📄 Skill Assessment Guides</a></li>
                <li><a href="#">📄 Industry Reports</a></li>
            </ul>
        </div>
    </section>
</div>
<!-- 🔁 REPLACEMENT ENDS HERE -->


<?php include_once('footer.php'); ?>

<a class='scroll-to-top rounded' href='#page-top'>
    <i class='fas fa-angle-up'></i>
</a>

<div class='modal fade' id='logoutModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>Ready to Leave?</h5>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
            </div>
            <div class='modal-body'>Select 'Logout' below if you are ready to end your current session.</div>
            <div class='modal-footer'>
                <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancel</button>
                <a class='btn btn-success' href='http://localhost/worklink/jobSeeker/logout.php'>Logout</a>
            </div>
        </div>
    </div>
</div>

<script src='vendor/jquery/jquery.min.js'></script>
<script src='vendor/bootstrap/js/bootstrap.bundle.min.js'></script>
<script src='vendor/jquery-easing/jquery.easing.min.js'></script>
<script src='js/sb-admin-2.min.js'></script>
<script src='vendor/datatables/jquery.dataTables.min.js'></script>
<script src='vendor/datatables/dataTables.bootstrap4.min.js'></script>
<script src='js/demo/datatables-demo.js'></script>

</body>
</html>
