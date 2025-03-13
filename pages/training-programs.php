<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Programs - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
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
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?training,programs') no-repeat center center/cover;
            text-align: center;
        }

        .program-card {
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

        .program-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .program-table th, .program-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .program-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="hero animate__animated animate__fadeIn">
    <h1>Upgrade Your Skills & Get Certified!</h1>
    <div class="search-bar">
        <input type="text" placeholder="Search Training Programs...">
        <select>
            <option value="">Category</option>
            <option value="Short-term">Short-term</option>
            <option value="Long-term">Long-term</option>
            <option value="Online">Online</option>
            <option value="Vocational">Vocational</option>
        </select>
        <select>
            <option value="">Location</option>
            <option value="Online">Online</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Delhi">Delhi</option>
        </select>
        <button class="btn btn-primary">Find Training Programs</button>
    </div>
</div>

<div class="container mt-4">
    <section class="section-container">
        <h2 class="section-title">Featured Training Programs</h2>
        <div class="program-table">
            <table>
                <thead>
                    <tr>
                        <th>Training Provider</th>
                        <th>Course</th>
                        <th>Duration</th>
                        <th>Mode</th>
                        <th>Fees</th>
                        <th>Enroll</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>NSDC</td>
                        <td>Data Analytics</td>
                        <td>6 Months</td>
                        <td>Online</td>
                        <td>Free</td>
                        <td><button class="btn btn-sm btn-success">Enroll Now</button></td>
                    </tr>
                    <tr>
                        <td>ITI Delhi</td>
                        <td>Electrician</td>
                        <td>1 Year</td>
                        <td>Offline</td>
                        <td>₹5000</td>
                        <td><button class="btn btn-sm btn-success">Enroll Now</button></td>
                    </tr>
                    <tr>
                        <td>Skill India</td>
                        <td>Graphic Design</td>
                        <td>3 Months</td>
                        <td>Online</td>
                        <td>Free</td>
                        <td><button class="btn btn-sm btn-success">Enroll Now</button></td>
                    </tr>
                    <tr>
                        <td>Polytechnic College</td>
                        <td>Mechanical Eng.</td>
                        <td>2 Years</td>
                        <td>Offline</td>
                        <td>₹20,000</td>
                        <td><button class="btn btn-sm btn-success">Enroll Now</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-3">
            <button class="btn btn-secondary">View More Programs</button>
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Short-term Courses (3-6 Months Training)</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="category-section">
                    <i class="fas fa-laptop"></i> IT & Software
                    <p>Web Development, Data Science, Cyber Security</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-section">
                    <i class="fas fa-industry"></i> Manufacturing
                    <p>CNC Machine Training, Welding, Electrical Repairs</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-section">
                    <i class="fas fa-hospital"></i> Healthcare
                    <p>Medical Assistant, Pharmacy Technician</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-section">
                    <i class="fas fa-paint-brush"></i> Beauty & Wellness
                    <p>Salon & Spa Training, Makeup Courses</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <button class="btn btn-primary">View All Short-term Courses</button>
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Long-term Training Programs (ITI, Polytechnic, Vocational Training)</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="category-section">
                    <i class="fas fa-tools"></i> ITI Courses
                    <p>Electrician, Fitter, Mechanic</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="category-section">
                    <i class="fas fa-university"></i> Polytechnic Diplomas
                    <p>Civil, Mechanical, Electrical</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="category-section">
                    <i class="fas fa-hand-holding-heart"></i> Vocational Training
                    <p>Tailoring, Handicrafts, Painting</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <button class="btn btn-primary">Explore Long-term Programs</button>
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Online Training & Digital Skills Programs</h2>
        <div class="row">
            <div class="col-md-2">
            <div class="program-card">
                <img src="https://source.unsplash.com/600x300/?coding,web development" alt="Coding">
                <h3>Coding</h3>
                <p>Learn to code from scratch</p>
                <div class="text-center">
                    <button class="btn btn-sm btn-success">Enroll Now</button>
                </div>
            </div>
    </div>
    </div>
    </section>
    </div>
    <?php include '../includes/footer.php'; ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="../assets/js/script.js"></script>

</body>

</html>