<?php
include('connection.php');

$dataPoints = array(
    array("y" => 25, "label" => "Sunday"),
    array("y" => 15, "label" => "Monday"),
    array("y" => 25, "label" => "Tuesday"),
    array("y" => 5, "label" => "Wednesday"),
    array("y" => 10, "label" => "Thursday"),
    array("y" => 0, "label" => "Friday"),
    array("y" => 20, "label" => "Saturday")
);

?>

<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Push-ups Over a Week"
            },
            axisY: {
                title: "Number of Push-ups"
            },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
</script>

<body>
    <div class="dashboard-container">
        <header>
            <h2>Welcome back, John!</h2>
            <p>Here's a quick overview of your job search progress</p>
        </header>

        <section class="stats">
            <div class="stat-box">
                <i class="fa-solid fa-briefcase"></i>
                <h3>32</h3>
                <p>Total Applications</p>
            </div>
            <div class="stat-box">
                <i class="fa-solid fa-bookmark"></i>
                <h3>15</h3>
                <p>Saved Jobs</p>
            </div>
            <div class="stat-box">
                <i class="fa-solid fa-bell"></i>
                <h3>5</h3>
                <p>Job Alerts</p>
            </div>
            <div class="stat-box">
                <i class="fa-solid fa-chart-line"></i>
                <h3>127</h3>
                <p>Profile Views</p>
            </div>
        </section>

        <section class="activity">
            <h4>Recent Activity</h4>
            <ul>
                <li><span class="dot blue"></span>Applied for Senior Frontend Developer at TechCorp <small>2 hours ago</small></li>
                <li><span class="dot purple"></span>Resume viewed by Design Studio <small>5 hours ago</small></li>
                <li><span class="dot green"></span>New job alert: UX Designer in San Francisco <small>1 day ago</small></li>
                <li><span class="dot orange"></span>Updated your profile information <small>2 days ago</small></li>
            </ul>
        </section>

        <section class="jobs">
            <div class="jobs-header">
                <h4>Recommended Jobs</h4>
                <div class="filters">
                    <button class="active">All</button>
                    <button>Full-time</button>
                    <button>Remote</button>
                    <button>Contract</button>
                </div>
            </div>

            <div class="job-cards">
                <?php
                $sql = mysqli_query($con, "SELECT * FROM totaljobs"); ?>

                <?php if (mysqli_num_rows($sql) > 0):
                    while ($row = mysqli_fetch_assoc($sql)):  ?>
                        <div class="job-card">
                            <!-- <h5>Senior Frontend Developer</h5> -->
                            <h5><?php echo htmlspecialchars($row['job_title']); ?></h5>
                            <p><?php echo htmlspecialchars($row['company_name']) . " - " . htmlspecialchars($row['country']); ?></p>
                            <h6><?php echo htmlspecialchars($row['job_type']) ?></h6>
                            <p class="salary"><?php echo htmlspecialchars($row['salary']); ?></p>
                            <button>Apply Now</button>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No jobs found.</p>
                <?php endif; ?>
                <!-- <div class="job-card">
                    <h5>UX Designer</h5>
                    <p>Design Studio - Remote</p>
                    <p class="salary">$90k - $110k</p>
                    <button>Apply Now</button>
                </div>
                <div class="job-card">
                    <h5>Product Manager</h5>
                    <p>Innovation Labs - New York, NY</p>
                    <p class="salary">$130k - $160k</p>
                    <button>Apply Now</button>
                </div> -->
            </div>
        </section>

        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    </div>
</body>