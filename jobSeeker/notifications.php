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
    <link href="css/notifications.css" rel="stylesheet"> 
    <script src='js/jquery-3.6.4.min.js'></script>
    <script src='js/search.js'></script>
</head>

<body id='page-top'>
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>


<div class="container-fluid custom-notification-msg">
    <div class="row">
        <!-- Notifications Section -->
        <div class="col-lg-8">
            <div class="card notifications-card">
                <div class="card-body">
                    <h3 class="section-title">Notifications</h3>
                    <div class="btn-group filter-tabs mb-3">
                        <button class="btn btn-light active">All</button>
                        <button class="btn btn-light">Unread</button>
                        <button class="btn btn-light">Important</button>
                    </div>

                    <div class="notification">
                        <div class="dot blue"></div>
                        <div class="content">
                            <strong>New job match found based on your profile</strong>
                            <p>A new Senior Frontend Developer position at Tech Corp matches your skills</p>
                            <small>10 minutes ago</small>
                        </div>
                    </div>

                    <div class="notification">
                        <div class="dot blue"></div>
                        <div class="content">
                            <strong>Your application was viewed</strong>
                            <p>Tech Corp has viewed your application for Senior Developer position</p>
                            <small>2 hours ago</small>
                        </div>
                    </div>

                    <div class="notification">
                        <div class="content">
                            <strong>Upcoming interview reminder</strong>
                            <p>Your interview with Design Studios is scheduled for tomorrow at 2 PM</p>
                            <small>5 hours ago</small>
                        </div>
                    </div>

                    <div class="notification">
                        <div class="content">
                            <strong>Profile strength update</strong>
                            <p>Add work experience to improve your profile visibility to recruiters</p>
                            <small>1 day ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages Section -->
        <div class="col-lg-4">
            <div class="card messages-card">
                <div class="card-body">
                    <h3 class="section-title">Messages</h3>
                    <input type="text" class="form-control search-input mb-3" placeholder="Search messages...">

                    <div class="message">
                        <img src="https://i.pravatar.cc/40?img=1" class="avatar" alt="User">
                        <div class="message-content">
                            <strong>HR Team - Tech Corp</strong>
                            <p>Thank you for your application...</p>
                            <small>10:30 AM</small>
                        </div>
                    </div>

                    <div class="message unread">
                        <img src="https://i.pravatar.cc/40?img=2" class="avatar" alt="User">
                        <div class="message-content">
                            <strong>Career Advisor</strong>
                            <p>Your resume review is complete...</p>
                            <small>Yesterday</small>
                        </div>
                    </div>

                    <div class="message">
                        <img src="https://i.pravatar.cc/40?img=3" class="avatar" alt="User">
                        <div class="message-content">
                            <strong>Interview Team</strong>
                            <p>Schedule confirmation for...</p>
                            <small>Yesterday</small>
                        </div>
                    </div>

                    <div class="message">
                        <img src="https://i.pravatar.cc/40?img=4" class="avatar" alt="User">
                        <div class="message-content">
                            <strong>System Notification</strong>
                            <p>New job recommendations are...</p>
                            <small>2 days ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
