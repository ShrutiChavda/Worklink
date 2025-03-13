<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Security & Welfare - Worklink Dashboard</title>

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
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?social,security,welfare') no-repeat center center/cover;
        }
        .benefit-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .benefit-table th, .benefit-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .benefit-table th {
            background-color: #f2f2f2;
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
    <h1>Social Security & Welfare for Workers</h1>
</div>

<div class="container mt-4">
    <section class="introduction">
        <h2>Why Social Security Matters?</h2>
        <p>Social security schemes provide financial protection for workers against health issues, unemployment, and retirement.</p>
        <p><strong>Who Benefits?</strong></p>
        <ul>
            <li>Unorganized Sector Workers (Construction, Agriculture, Domestic Workers, Gig Workers)</li>
            <li>Self-Employed Individuals</li>
            <li>Factory & Industrial Workers</li>
        </ul>
        <img src="https://via.placeholder.com/600x300?text=Work+Earn+Secure+Future+Retire+with+Benefits" alt="Social Security Flowchart" class="img-fluid">
    </section>

    <section class="pension-schemes mt-4">
        <h2>Pension Schemes</h2>
        <ul>
            <li>
                <strong>Atal Pension Yojana (APY)</strong>
                <p>Pension for workers after retirement.</p>
                <button class="btn btn-primary">Apply for Pension</button>
            </li>
            <li>
                <strong>Employees' Provident Fund Organisation (EPFO)</strong>
                <p>Monthly pension after 58 years of age.</p>
                <button class="btn btn-primary">Apply for Pension</button>
            </li>
            <li>
                <strong>National Pension System (NPS)</strong>
                <p>Retirement savings scheme.</p>
                <button class="btn btn-primary">Apply for Pension</button>
            </li>
        </ul>
        <p>Eligibility Criteria: Age, employment status, contribution required.</p>
        <h3>Application Process:</h3>
        <ol>
            <li>Register on the pension portal.</li>
            <li>Provide Aadhaar & bank details.</li>
            <li>Start monthly contributions.</li>
        </ol>
    </section>

    <section class="health-insurance mt-4">
        <h2>Health Insurance for Workers</h2>
        <ul>
            <li>
                <strong>Ayushman Bharat (PM-JAY)</strong>
                <p>₹5 lakh coverage for medical treatment.</p>
                <button class="btn btn-success">Check Your Eligibility</button>
            </li>
            <li>
                <strong>ESIC (Employees' State Insurance Corporation)</strong>
                <p>Medical benefits for employees.</p>
                <button class="btn btn-success">Check Your Eligibility</button>
            </li>
            <li>
                <strong>Rashtriya Swasthya Bima Yojana (RSBY)</strong>
                <p>Health insurance for unorganized workers.</p>
                <button class="btn btn-success">Check Your Eligibility</button>
            </li>
        </ul>
        <h3>Table of Benefits:</h3>
        <div class="benefit-table">
            <table>
                <thead>
                    <tr>
                        <th>Scheme</th>
                        <th>Coverage Amount</th>
                        <th>Eligibility</th>
                        <th>Premium</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ayushman Bharat</td>
                        <td>₹5 Lakh</td>
                        <td>BPL Families</td>
                        <td>Free</td>
                    </tr>
                    <tr>
                        <td>ESIC</td>
                        <td>Full Medical Coverage</td>
                        <td>Private Sector Workers</td>
                        <td>1.75% Salary Deduction</td>
                    </tr>
                    <tr>
                        <td>RSBY</td>
                        <td>₹30,000</td>
                        <td>Unorganized Workers</td>
                        <td>Subsidized</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h3>How to Apply?</h3>
        <ol>
            <li>Visit the health insurance portal.</li>
            <li>Enter Aadhaar & employment details.</li>
            <li>Get e-health card for cashless treatment.</li>
        </ol>
    </section>

    <section class="maternity-disability mt-4">
        <h2>Maternity & Disability Benefits</h2>
        <h3>Schemes for Women Workers:</h3>
        <ul>
            <li>
                <strong>Pradhan Mantri Matru Vandana Yojana (PMMVY)</strong>
                <p>₹6,000 maternity benefit for pregnant women.</p>
                <button class="btn btn-primary">Apply for Benefits</button>
            </li>
            <li>
                <strong>ESIC Maternity Benefit Scheme</strong>
                <p>26 weeks paid leave for working women.</p>
                <button class="btn btn-primary">Apply for Benefits</button>
            </li>
            <li>
                <strong>National Creche Scheme</strong>
                <p>Childcare support for working mothers.</p>
                <button class="btn btn-primary">Apply for Benefits</button>
            </li>
        </ul>
        <h3>Disability & Accident Benefits:</h3>
        <ul>
            <li>
                <strong>PM Suraksha Bima Yojana (PMSBY)</strong>
                <p>₹2 lakh insurance for accidental disability.</p>
                <button class="btn btn-primary">Apply for Benefits</button>
            </li>
            <li>
                <strong>ESIC Disability Pension</strong>
                <p>Monthly pension for permanently disabled workers.</p>
                <button class="btn btn-primary">Apply for Benefits</button>
            </li>
            <li>
                <strong>Employee Compensation Scheme</strong>
                <p>Compensation for workplace injuries.</p>
                <button class="btn btn-primary">Apply for Benefits</button>
            </li>
        </ul>
        <h3>Application Process:</h3>
        <ol>
            <li>Register on the government portal.</li>
            <li>Submit medical documents & employment details.</li>
            <li>Get approval & receive financial aid.</li>
        </ol>
    </section>

    <section class="grievance mt-4">
        <h2>Grievance Redressal & Helplines</h2>
        <h3>How to Raise a Complaint?</h3>
        <ul>
            <li>Online Grievance Portal: Submit issues related to pension, insurance, or benefits.</li>
            <li>Toll-Free Helpline: 📞 1800-XXX-XXXX</li>
            <li>Email Support: 📧 help@workerswelfare.gov.in</li>
            <li>State Welfare Offices: Find the nearest welfare office.</li>
        </ul>
        <button class="btn btn-danger">Submit a Complaint</button>
    </section>

    <section class="success-stories mt-4">
        <h2>Success Stories (Testimonials)</h2>
        <div class="testimonial">
            <p>"Ayushman Bharat saved my family during a medical emergency!" – Rakesh, Delhi</p>
        </div>
        <div class="testimonial">
            <p>"Pension scheme gives me security in old age!" – Me
                Rahul, Bangalore</p>
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