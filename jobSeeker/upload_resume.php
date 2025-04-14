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
    <link href='css/upload_resume.css' rel='stylesheet'>

    <script src='js/jquery-3.6.4.min.js'></script>
    <script src='js/search.js'></script>
</head>

<body id='page-top'>
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

<div class="container-fluid resume-upload-page">
    <h2 class="page-title">Upload/Update Resume</h2>
    <p class="page-subtitle">Manage your resumes and make them visible to employers</p>

    <!-- Current Resume -->
    <div class="resume-box">
        <div class="resume-info">
            <i class="fas fa-file-alt resume-icon"></i>
            <div>
                <p class="resume-name">MyResume_2024.pdf</p>
                <p class="resume-date">Uploaded on Jan 15, 2024</p>
            </div>
        </div>
        <div class="resume-actions">
            <a href="#" class="btn btn-link text-primary">Download</a>
            <a href="#" class="btn btn-link text-danger">Delete</a>
        </div>
    </div>

    <!-- Upload New Resume -->
    <h5 class="upload-title">Upload New Resume</h5>
    <div class="upload-box">
        <div class="upload-area">
            <i class="fas fa-cloud-upload-alt upload-icon"></i>
            <p>Drag and drop your resume here</p>
            <span>or</span>
            <button class="btn btn-primary mt-2">Browse files</button>
            <p class="upload-info">Supported formats: PDF, DOC, DOCX (Max size: 5MB)</p>
        </div>
    </div>

    <!-- Resume Tips -->
    <div class="resume-tips">
        <h6 class="tips-title">Resume Tips</h6>
        <ul class="tips-list">
            <li>Keep your resume clear and concise</li>
            <li>Use bullet points to highlight achievements</li>
            <li>Include relevant keywords from job descriptions</li>
            <li>Proofread carefully for errors</li>
            <li>Update your resume regularly</li>
        </ul>
    </div>

    <p class="resume-footer-note">
        <i class="fas fa-shield-alt mr-1"></i> Your resume will be stored securely and only shared with employers you apply to. 
        You can manage your resume visibility settings in your profile preferences.
    </p>
</div>


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
