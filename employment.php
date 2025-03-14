<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employment Services - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <style>
        .hero {
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            font-size: 2rem;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?job,career') no-repeat center center/cover;
            text-align: center; /* Center text in hero */
        }
        .featured-jobs table {
            width: 100%;
            border-collapse: collapse;
        }
        .featured-jobs th, .featured-jobs td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center; /* Center table cells */
        }
        .featured-jobs th {
            background-color: #f2f2f2;
        }
        .resume-upload {
            border: 1px dashed #ccc;
            padding: 20px;
            text-align: center;
        }
        .testimonial {
            border: 1px solid #eee;
            padding: 15px;
            margin-bottom: 15px;
            text-align: center; /* Center testimonials */
        }
        .container section {
            text-align: center; /* Center all sections */
        }
        .container section h2 {
            text-align: center; /* center section titles*/
        }
        .container section ul, .container section ol {
            list-style-position: inside; /* center list items */
            padding-left: 0;
        }
        .container section table{
            margin: 0 auto;
        }

    </style>
</head>
<body>

<?php include 'includes/nav.php'; ?>

<div class="hero animate__animated animate__fadeIn">
    <h1>Find Your Dream Job</h1>
</div>

<div class="container mt-4">
    <section class="job-search">
        <h2>Job Search & Filters</h2>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Job Title, Keywords">
            </div>
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">Job Type</option>
                    <option value="full-time">Full-Time</option>
                    <option value="part-time">Part-Time</option>
                    <option value="internship">Internship</option>
                    <option value="apprenticeship">Apprenticeship</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">Location</option>
                    <option value="delhi">Delhi</option>
                    <option value="mumbai">Mumbai</option>
                    <option value="bangalore">Bangalore</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">Sector</option>
                    <option value="manufacturing">Manufacturing</option>
                    <option value="healthcare">Healthcare</option>
                    <option value="it">IT</option>
                    <option value="engineering">Engineering</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">Experience</option>
                    <option value="fresher">Fresher</option>
                    <option value="mid-level">Mid-Level</option>
                    <option value="senior-level">Senior-Level</option>
                </select>
            </div>
            <div class="col-md-1">
                <button class="btn btn-primary">Search Jobs</button>
            </div>
        </div>
    </section>

    <section class="featured-jobs mt-4">
        <h2>Featured Job Listings</h2>
        <table>
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Job Title</th>
                    <th>Location</th>
                    <th>Deadline</th>
                    <th>Apply Now</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tata Motors</td>
                    <td>Mechanical Engineer</td>
                    <td>Pune</td>
                    <td>25 Mar 2025</td>
                    <td><a href="#">Apply</a></td>
                </tr>
                <tr>
                    <td>Infosys</td>
                    <td>Software Developer</td>
                    <td>Bangalore</td>
                    <td>20 Mar 2025</td>
                    <td><a href="#">Apply</a></td>
                </tr>
                <tr>
                    <td>Apollo Hospitals</td>
                    <td>Nurse</td>
                    <td>Chennai</td>
                    <td>30 Mar 2025</td>
                    <td><a href="#">Apply</a></td>
                </tr>
                <tr>
                    <td>Indian Railways</td>
                    <td>Ticket Collector</td>
                    <td>Pan India</td>
                    <td>15 Apr 2025</td>
                    <td><a href="#">Apply</a></td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-secondary mt-2">View More Jobs</button>
    </section>

    <section class="resume-upload mt-4">
        <h2>Upload Resume</h2>
        <p>Drop your resume here or Click to Upload (PDF, DOCX)</p>
        <input type="file" class="form-control-file">
        <p>Uploaded: <span id="resume-status">No file selected</span></p>
        <button class="btn btn-success mt-2">Update Resume</button>
    </section>

    <section class="career-counseling mt-4">
        <h2>Career Counseling</h2>
        <p>AI Chatbot for Career Advice (e.g., "What job suits my skills?")</p>
        <p>Recommended Career Paths: IT, Engineering, Healthcare, etc.</p>
        <p>Personalized Job Alerts: Based on uploaded resume.</p>
        <button class="btn btn-info">Talk to an Expert</button>
    </section>

    <section class="interview-prep mt-4">
        <h2>Interview Preparation & Skill Training</h2>
        <p>📹 Video Tutorials: "Common Interview Questions & Best Answers"</p>
        <p>💬 Mock Interview Chatbot: Practice answering AI-generated questions.</p>
        <p>📚 Downloadable Guides: Resume templates, Cover letter formats.</p>
        <p>🎓 Free Certification Courses: Govt-funded online skill programs.</p>
    </section>

    <section class="success-stories mt-4">
        <h2>Success Stories & Testimonials</h2>
        <div class="testimonial">
            <p>"I got my dream IT job using this platform!" – Rajesh, Pune</p>
        </div>
        <div class="testimonial">
            <p>"Career guidance helped me switch industries successfully!" – Meena, Delhi</p>
        </div>
        <div class="testimonial">
            <p>"Govt job listings here are authentic & verified!" – Suresh, Bangalore</p>
        </div>
        <button class="btn btn-outline-primary">Submit Your Story</button>
    </section>

    <section class="employers-section mt-4">
        <h2>Employers' Section</h2>
        <button class="btn btn-primary">Post a Job</button>
        <p>Search for Candidates (Filters resumes by skills)</p>
        <button class="btn btn-secondary">Employer Login</button>
    </section>

    <section class="govt-schemes mt-4">
        <h2>Government Schemes & Policies</h2>
        <ul>
            <li>PM Rozgar Yojana – Funding for small business jobs.</li>
            <li>E-PFO – Employee Provident Fund (EPF) scheme.</li>
            <li>UGC-TNPSC – Urban Development Fund (UDF) scheme.</li>
            <li>Pension schemes like PPF, Retirement Funds, etc.</li>
    </ul>
    </section>
    </div>
    <?php include 'includes/footer.php'; ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="assets/js/script.js"></script>

</body>

</html>