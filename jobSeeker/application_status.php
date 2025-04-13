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
    <link href='css/application_status.css' rel='stylesheet'>
    <script src='js/jquery-3.6.4.min.js'></script>
    <script src='js/search.js'></script>
</head>

<body id='page-top'>
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

<div class="main-container">
  <h1 class="title">Application Status</h1>

  <div class="summary-cards">
    <div class="card total">
      <div class="icon"></div>
      <div class="info">
        <h2>24</h2>
        <p>Total Applications</p>
      </div>
    </div>
    <div class="card pending">
      <div class="icon"></div>
      <div class="info">
        <h2>8</h2>
        <p>Pending Review</p>
      </div>
    </div>
    <div class="card shortlisted">
      <div class="icon"></div>
      <div class="info">
        <h2>12</h2>
        <p>Shortlisted</p>
      </div>
    </div>
    <div class="card rejected">
      <div class="icon"></div>
      <div class="info">
        <h2>4</h2>
        <p>Rejected</p>
      </div>
    </div>
  </div>

  <div class="filters">
    <input type="text" placeholder="Search applications..." />
    <select>
      <option>Status</option>
    </select>
    <select>
      <option>Date Range</option>
    </select>
    <button class="export-btn">Export</button>
  </div>

  <div class="application-table">
    <div class="table-header">
      <span>Company & Position</span>
      <span>Applied Date</span>
      <span>Status</span>
      <span>Last Updated</span>
      <span>Actions</span>
    </div>

    <div class="table-row">
      <div class="company">
        <img src="img/undraw_profile_1.jpg" alt="logo" />
        <div>
          <strong>Tech Solutions Inc</strong>
          <p>Senior Frontend Developer</p>
        </div>
      </div>
      <div>2024-01-15</div>
      <div><span class="badge shortlisted">Shortlisted</span></div>
      <div>2024-01-20</div>
      <div><a href="#">View Details</a></div>
    </div>

    <div class="table-row">
      <div class="company">
        <img src="img/undraw_profile_1.jpg" alt="logo" />
        <div>
          <strong>Digital Innovations</strong>
          <p>UX Designer</p>
        </div>
      </div>
      <div>2024-01-14</div>
      <div><span class="badge pending">Pending</span></div>
      <div>2024-01-19</div>
      <div><a href="#">View Details</a></div>
    </div>

    <div class="table-row">
      <div class="company">
        <img src="img/company3.png" alt="logo" />
        <div>
          <strong>Cloud Systems</strong>
          <p>DevOps Engineer</p>
        </div>
      </div>
      <div>2024-01-13</div>
      <div><span class="badge rejected">Rejected</span></div>
      <div>2024-01-18</div>
      <div><a href="#">View Details</a></div>
    </div>

    <div class="table-row">
      <div class="company">
        <img src="img/company4.png" alt="logo" />
        <div>
          <strong>AI Solutions Ltd</strong>
          <p>Machine Learning Engineer</p>
        </div>
      </div>
      <div>2024-01-12</div>
      <div><span class="badge shortlisted">Shortlisted</span></div>
      <div>2024-01-17</div>
      <div><a href="#">View Details</a></div>
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
