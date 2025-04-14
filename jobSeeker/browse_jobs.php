<?php include('session.php'); ?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='description' content=''>
    <meta name='author' content=''>

    <title>Browse Jobs</title>

    <link href='img/favicon.png' rel='icon'>
    <link href='vendor/fontawesome-free/css/all.min.css' rel='stylesheet' type='text/css'>
    <link href='css/sb-admin-2.min.css' rel='stylesheet'>
    <link href='vendor/datatables/dataTables.bootstrap4.min.css' rel='stylesheet'>
    <link href='css/sb-admin-2.css' rel='stylesheet'>
    <link href='css/browse_jobs.css' rel='stylesheet'> <!-- New CSS File -->
    <script src='js/jquery-3.6.4.min.js'></script>
    <script src='js/search.js'></script>
</head>

<body id='page-top'>
    <?php include('sidebar.php'); ?>
    <?php include('header.php'); ?>

    <div class='container-fluid'>
        <h1 class='h3 mb-4 text-gray-800'>Browse Jobs</h1>

        <!-- Popular Job Categories -->
        <div class="job-categories">
            <h2>Popular Job Categories</h2>
            <div class="categories-grid">
                <div class="category-box"><i class="fas fa-code"></i> Technology <span>1,234 jobs available</span></div>
                <div class="category-box"><i class="fas fa-heartbeat"></i> Healthcare <span>943 jobs available</span></div>
                <div class="category-box"><i class="fas fa-chart-line"></i> Finance <span>856 jobs available</span></div>
                <div class="category-box"><i class="fas fa-bullhorn"></i> Marketing <span>678 jobs available</span></div>
                <div class="category-box"><i class="fas fa-graduation-cap"></i> Education <span>567 jobs available</span></div>
                <div class="category-box"><i class="fas fa-paint-brush"></i> Design <span>445 jobs available</span></div>
                <div class="category-box"><i class="fas fa-briefcase"></i> Sales <span>389 jobs available</span></div>
                <div class="category-box"><i class="fas fa-cogs"></i> Engineering <span>287 jobs available</span></div>
            </div>
        </div>

        <!-- Featured Job Opportunities -->
        <div class="featured-jobs">
            <h2>Featured Job Opportunities</h2>
            <div class="filter-options">
                <select>
                    <option>Most Relevant</option>
                    <option>Latest</option>
                </select>
                <select>
                    <option>All Types</option>
                    <option>Full-time</option>
                    <option>Part-time</option>
                </select>
                <select>
                    <option>All Levels</option>
                    <option>Entry Level</option>
                    <option>Mid Level</option>
                    <option>Senior Level</option>
                </select>
            </div>

            <div class="job-listings">
                <?php
                $sql = mysqli_query($con, "SELECT * FROM totaljobs"); ?>

                <?php if (mysqli_num_rows($sql) > 0):
                    while ($row = mysqli_fetch_assoc($sql)):  ?>
                        <div class="job-card">
                            <img src="img/undraw_profile.jpg" class="company-logo">
                            <h3><?php echo htmlspecialchars($row['job_title']); ?></h3>
                            <p><?php echo htmlspecialchars($row['company_name']); ?></p>
                            <class="job-location"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($row['country']); ?></span><br>
                                <span class="job-type"><?php echo htmlspecialchars($row['job_type']) ?></span>
                                <span class="salary"><?php echo htmlspecialchars($row['salary']) ?></span>
                                <div class="tags"><span>React</span><span>Node.js</span><span>TypeScript</span></div>
                                <button class="apply-btn">Apply Now</button>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No jobs found.</p>
                <?php endif; ?>

                <!-- <div class="job-card">
                    <img src="img/undraw_profile.jpg" class="company-logo">
                    <h3>Product Designer</h3>
                    <p>DesignLabs</p>
                    <span class="job-location"><i class="fas fa-map-marker-alt"></i> Remote</span>
                    <span class="job-type">Full-time</span>
                    <span class="salary">$90K - $120K</span>
                    <div class="tags"><span>Figma</span><span>UI/UX</span><span>Prototyping</span></div>
                    <button class="apply-btn">Apply Now</button>
                </div>

                <div class="job-card">
                    <img src="img/undraw_profile.jpg" class="company-logo">
                    <h3>Marketing Manager</h3>
                    <p>GrowthCo</p>
                    <span class="job-location"><i class="fas fa-map-marker-alt"></i> New York, NY</span>
                    <span class="job-type">Full-time</span>
                    <span class="salary">$80K - $100K</span>
                    <div class="tags"><span>Digital Marketing</span><span>SEO</span><span>Analytics</span></div>
                    <button class="apply-btn">Apply Now</button>
                </div>

                <div class="job-card">
                    <img src="img/undraw_profile.jpg" class="company-logo">
                    <h3>Data Scientist</h3>
                    <p>DataTech Solutions</p>
                    <span class="job-location"><i class="fas fa-map-marker-alt"></i> Boston, MA</span>
                    <span class="job-type">Full-time</span>
                    <span class="salary">$130K - $160K</span>
                    <div class="tags"><span>Python</span><span>ML</span><span>SQL</span></div>
                    <button class="apply-btn">Apply Now</button>
                </div>

                <div class="job-card">
                    <img src="img/undraw_profile.jpg" class="company-logo">
                    <h3>Frontend Developer</h3>
                    <p>WebCraft</p>
                    <span class="job-location"><i class="fas fa-map-marker-alt"></i> Remote</span>
                    <span class="job-type">Full-time</span>
                    <span class="salary">$90K - $120K</span>
                    <div class="tags"><span>React</span><span>Vue</span><span>JavaScript</span></div>
                    <button class="apply-btn">Apply Now</button>
                </div>

                <div class="job-card">
                    <img src="img/undraw_profile.jpg" class="company-logo">
                    <h3>UX Researcher</h3>
                    <p>UserFirst</p>
                    <span class="job-location"><i class="fas fa-map-marker-alt"></i> Seattle, WA</span>
                    <span class="job-type">Full-time</span>
                    <span class="salary">$85K - $110K</span>
                    <div class="tags"><span>User Research</span><span>Usability Testing</span></div>
                    <button class="apply-btn">Apply Now</button>
                </div> -->
            </div>
        </div>

    </div>

    <?php include_once('footer.php'); ?>

    <a class='scroll-to-top rounded' href='#page-top'>
        <i class='fas fa-angle-up'></i>
    </a>

    <script src='vendor/jquery/jquery.min.js'></script>
    <script src='vendor/bootstrap/js/bootstrap.bundle.min.js'></script>
    <script src='vendor/jquery-easing/jquery.easing.min.js'></script>
    <script src='js/sb-admin-2.min.js'></script>
    <script src='vendor/datatables/jquery.dataTables.min.js'></script>
    <script src='vendor/datatables/dataTables.bootstrap4.min.js'></script>
    <script src='js/demo/datatables-demo.js'></script>

</body>

</html>