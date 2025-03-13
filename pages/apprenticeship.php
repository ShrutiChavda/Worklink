<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apprenticeship Training - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        .hero {
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            font-size: 2rem;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?apprenticeship,training') no-repeat center center/cover;
        }
        .comparison-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .comparison-table th, .comparison-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .comparison-table th {
            background-color: #f2f2f2;
        }
        .industry-category {
            border: 1px solid #eee;
            padding: 15px;
            margin-bottom: 15px;
            text-align: center;
        }
        .testimonial {
            border: 1px solid #eee;
            padding: 15px;
            margin-bottom: 15px;
        }
        .faq-item {
            border-bottom: 1px solid #eee;
            padding: 10px;
        }
    </style>
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="hero animate__animated animate__fadeIn">
    <h1>Kickstart Your Career with Apprenticeship</h1>
</div>

<div class="container mt-4">
    <section class="introduction">
        <h2>What is an Apprenticeship?</h2>
        <p>An apprenticeship is a structured training program where you work and learn skills in a real industry setting.</p>
        <p><strong>Benefits:</strong></p>
        <ul>
            <li>Earn a stipend while learning</li>
            <li>Get hands-on industry experience</li>
            <li>Government-recognized certification</li>
        </ul>
        <img src="https://via.placeholder.com/600x300?text=Learn+Train+Get+Certified+Secure+a+Job" alt="Apprenticeship Flowchart" class="img-fluid">
    </section>

    <section class="govt-schemes mt-4">
        <h2>Government Apprenticeship Schemes</h2>
        <ul>
            <li>
                <strong>National Apprenticeship Promotion Scheme (NAPS)</strong>
                <p>Financial support for apprentices.</p>
                <button class="btn btn-primary">Apply Now</button>
            </li>
            <li>
                <strong>Skill India Apprenticeship Scheme</strong>
                <p>Industry-specific training.</p>
                <button class="btn btn-primary">Apply Now</button>
            </li>
            <li>
                <strong>Pradhan Mantri Kaushal Vikas Yojana (PMKVY)</strong>
                <p>Apprenticeship & skill certification.</p>
                <button class="btn btn-primary">Apply Now</button>
            </li>
        </ul>
        <h3>How to Apply:</h3>
        <ol>
            <li>Register on the apprenticeship portal.</li>
            <li>Choose an industry & program.</li>
            <li>Submit documents & apply.</li>
            <li>Start training and earn while learning.</li>
        </ol>
        <p><a href="#">Download Official Apprenticeship Policies (PDF)</a></p>
    </section>

    <section class="comparison-table mt-4">
        <h2>Apprenticeship vs. Internship</h2>
        <table>
            <thead>
                <tr>
                    <th>Feature</th>
                    <th>Apprenticeship</th>
                    <th>Internship</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Duration</td>
                    <td>6 months – 2 years</td>
                    <td>1–6 months</td>
                </tr>
                <tr>
                    <td>Paid?</td>
                    <td>✅ Yes (Stipend)</td>
                    <td>⚠️ Sometimes</td>
                </tr>
                <tr>
                    <td>Industry Training</td>
                    <td>✅ Hands-on</td>
                    <td>🟡 Limited Exposure</td>
                </tr>
                <tr>
                    <td>Certification</td>
                    <td>✅ Govt-Recognized</td>
                    <td>❌ No Certification</td>
                </tr>
                <tr>
                    <td>Job Guarantee</td>
                    <td>✅ High Chances</td>
                    <td>⚠️ Depends on Employer</td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="industries mt-4">
        <h2>Industries Offering Apprenticeships</h2>
        <div class="row">
            <div class="col-md-4 industry-category">
                <img src="https://via.placeholder.com/150x100?text=IT" alt="IT Industry" class="img-fluid">
                <p><strong>IT & Software Development</strong></p>
                <p>(TCS, Infosys, Wipro)</p>
            </div>
            <div class="col-md-4 industry-category">
                <img src="https://via.placeholder.com/150x100?text=Engineering" alt="Engineering Industry" class="img-fluid">
                <p><strong>Engineering & Manufacturing</strong></p>
                <p>(Tata Steel, L&T, BHEL)</p>
            </div>
            <div class="col-md-4 industry-category">
                <img src="https://via.placeholder.com/150x100?text=Automobile" alt="Automobile Industry" class="img-fluid">
                <p><strong>Automobile Industry</strong></p>
                <p>(Maruti Suzuki, Mahindra)</p>
            </div>
        </div>
        <button class="btn btn-secondary mt-2">View Available Apprenticeships</button>
    </section>

    <section class="registration mt-4">
        <h2>Registration for Apprenticeship</h2>
        <form>
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone">
            </div>
            <div class="mb-3">
                <label for="education" class="form-label">Education Level</label>
                <select class="form-select" id="education">
                    <option value="10th">10th</option>
                    <option value="12th">12th</option>
                    <option value="graduate">Graduate</option>
                    <option value="diploma">Diploma</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="industry" class="form-label">Preferred Industry</label>
                <input type="text" class="form-control" id="industry">
            </div>
            <div class="mb-3">
                <label for="resume" class="form-label">Upload Resume (PDF, DOCX)</label>
                <input type="file" class="form-control" id="resume">
            </div>
            <button type="submit" class="btn btn-success">Register Now</button>
        </form>
        <p>Live Status Tracker: Your application is under review.</p>
        <p><a href="http://www.apprenticeshipindia.gov.in" target="_blank">www.apprenticeshipindia</a>
    </p>
    </section>
    </div>

<?php include '../includes/footer.php'; ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="../assets/js/script.js"></script>

</body>

</html>