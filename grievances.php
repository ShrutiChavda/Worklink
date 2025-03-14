<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labour Grievance Redressal - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

    <style>
        .hero {
            height: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            font-size: 2rem;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?labour,grievance') no-repeat center center/cover;
            text-align: center;
        }

        .grievance-card {
            border: 1px solid #eee;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .category-section {
            border: 1px solid #eee;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .testimonial {
            border: 1px solid #eee;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .slick-slide img {
            width: 100%;
            height: auto;
        }

        .section-container {
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid #eee;
            border-radius: 8px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .grievance-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .grievance-table th, .grievance-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .grievance-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php include 'includes/nav.php'; ?>

<div class="hero animate__animated animate__fadeIn">
    <h1>Facing Workplace Issues? File a Complaint Today!</h1>
    <div class="search-bar">
        <input type="text" placeholder="Enter Complaint ID">
        <select>
            <option value="">Category</option>
            <option value="Wages">Wages</option>
            <option value="Harassment">Harassment</option>
            <option value="Unsafe Conditions">Unsafe Conditions</option>
        </select>
        <button class="btn btn-primary">Track Complaint</button>
    </div>
</div>

<div class="container mt-4">
    <section class="section-container">
        <h2 class="section-title">Online Complaint Registration</h2>
        <form>
            <div class="mb-3">
                <label for="workerName" class="form-label">Worker Name</label>
                <input type="text" class="form-control" id="workerName" placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact Number</label>
                <input type="tel" class="form-control" id="contact" placeholder="Enter your contact number">
            </div>
            <div class="mb-3">
                <label for="employerName" class="form-label">Employer Name</label>
                <input type="text" class="form-control" id="employerName" placeholder="Enter company name">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" placeholder="Enter location">
            </div>
            <div class="mb-3">
                <label for="complaintCategory" class="form-label">Complaint Category</label>
                <select class="form-select" id="complaintCategory">
                    <option value="Wages">Non-payment of wages</option>
                    <option value="Harassment">Workplace harassment</option>
                    <option value="Unsafe Conditions">Unsafe working conditions</option>
                    <option value="Overwork">Overwork or forced labour</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="evidence" class="form-label">Upload Evidence (Optional)</label>
                <input type="file" class="form-control" id="evidence">
            </div>
            <button type="submit" class="btn btn-success">File a Complaint Now</button>
        </form>
    </section>

    <section class="section-container">
        <h2 class="section-title">Legal Assistance for Workers</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Free Consultation with Labour Lawyers</h3>
                <p>Get expert legal advice on workplace disputes.</p>
                <div class="text-center mt-3">
                    <a href="#" class="btn btn-primary">Get Free Legal Help</a>
                </div>
            </div>
            <div class="col-md-6">
                <h3>List of Labour Laws Protecting Workers</h3>
                <ul>
                    <li>The Minimum Wages Act, 1948</li>
                    <li>The Industrial Disputes Act, 1947</li>
                    <li>The Factories Act, 1948</li>
                    <li>The Employees’ Provident Funds Act, 1952</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Case Tracking for Complaints</h2>
        <form>
            <div class="mb-3">
                <label for="complaintId" class="form-label">Enter Complaint ID</label>
                <input type="text" class="form-control" id="complaintId" placeholder="Enter your complaint ID">
            </div>
            <button type="submit" class="btn btn-info">Track Complaint Status</button>
        </form>
    </section>

    <section class="section-container">
        <h2 class="section-title">Government & NGO Support for Labour Issues</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Labour Welfare Boards</h3>
                <ul>
                    <li>National Labour Helpline: 1800-XXX-XXXX</li>
                    <li>State Labour Offices (List of contact details)</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3>NGOs Supporting Labour Rights</h3>
                <ul>
                    <li>Pratham Foundation</li>
                    <li>LabourNet</li>
                    <li>Aajeevika Bureau</li>
                </ul>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="#" class="btn btn-secondary">Find Support Organizations</a>
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Recent Labour Rights Cases & News</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Case Studies
                    <a href="#" class="float-end"><i class="bi bi-plus-circle"></i></a>
                </h3>
                <div class="row">
                    <div class="col-md-6">
                        <img src="https://source.unsplash.com/200x200/?labour,grievance" alt="Case Study">
                        <h4>Case Study 1</h4>
                    </div>
                    <div class="col-md-6">
                        <img src="https://source.unsplash.com/200x200/?labour,grievance" alt="Case Study">
                        <h4>Case Study 2</h4>
                    </div>
                </div>
                <a href="#" class="btn btn-primary float-end">View All Cases</a>
                <div class="mt-3">
                    <a href="#" class="text-muted"><i class="bi bi-caret-right-fill"></i> Read More</a>
                </div>
                </div></div>
    </section>
    </div>
    <?php include 'includes/footer.php'; ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="assets/js/script.js"></script>

</body>

</html>
