<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimum Wage Calculator - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll("button").forEach(element => {
            element.addEventListener("click", function(event) {
                event.preventDefault();
                window.location.href = "login.php";
            });
        });
    });
    </script>
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
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?minimum,wage') no-repeat center center/cover;
        text-align: center;
    }

    .wage-card {
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

    .wage-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .wage-table th,
    .wage-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .wage-table th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>

    <?php include 'includes/nav.php'; ?>

    <div class="hero animate__animated animate__fadeIn">
        <h1>Know Your Legal Minimum Wage!</h1>
        <div class="mt-3">
            <a href="#wage-calculator" class="btn btn-primary">Calculate Now</a>
        </div>
    </div>

    <div class="container mt-4">
        <section id="wage-calculator" class="section-container">
            <h2 class="section-title">Wage Calculation Form</h2>
            <form>
                <div class="mb-3">
                    <label for="state" class="form-label">Select Your State</label>
                    <select class="form-select" id="state">
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="industry" class="form-label">Industry Type</label>
                    <select class="form-select" id="industry">
                        <option value="IT">IT</option>
                        <option value="Manufacturing">Manufacturing</option>
                        <option value="Agriculture">Agriculture</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="skill" class="form-label">Skill Level</label>
                    <select class="form-select" id="skill">
                        <option value="Unskilled">Unskilled</option>
                        <option value="Semi-skilled">Semi-skilled</option>
                        <option value="Skilled">Skilled</option>
                        <option value="Highly Skilled">Highly Skilled</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="hoursPerDay" class="form-label">Work Hours Per Day</label>
                    <input type="number" class="form-control" id="hoursPerDay" placeholder="Enter hours">
                </div>
                <div class="mb-3">
                    <label for="daysPerMonth" class="form-label">Days Worked Per Month</label>
                    <input type="number" class="form-control" id="daysPerMonth" placeholder="Enter days">
                </div>
                <div class="mb-3">
                    <label for="overtimeHours" class="form-label">Overtime Hours (Optional)</label>
                    <input type="number" class="form-control" id="overtimeHours" placeholder="Enter overtime hours">
                </div>
                <button type="submit" class="btn btn-primary">Calculate Wage</button>
            </form>
        </section>

        <section class="section-container">
            <h2 class="section-title">Wage Calculation Results</h2>
            <div id="wage-results">
            </div>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-success">Download Wage Report (PDF)</a>
            </div>
        </section>

        <section class="section-container">
            <h2 class="section-title">State-wise Wage Chart</h2>
            <div class="wage-table">
                <table>
                    <thead>
                        <tr>
                            <th>State</th>
                            <th>Unskilled (₹/day)</th>
                            <th>Semi-Skilled (₹/day)</th>
                            <th>Skilled (₹/day)</th>
                            <th>Highly Skilled (₹/day)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Maharashtra</td>
                            <td>400</td>
                            <td>500</td>
                            <td>600</td>
                            <td>700</td>
                        </tr>
                        <tr>
                            <td>Gujarat</td>
                            <td>350</td>
                            <td>450</td>
                            <td>550</td>
                            <td>650</td>
                        </tr>
                        <tr>
                            <td>Tamil Nadu</td>
                            <td>380</td>
                            <td>480</td>
                            <td>580</td>
                            <td>680</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-secondary">View Full Wage List</a>
            </div>
        </section>

        <section class="section-container">
            <h2 class="section-title">Overtime Wage Calculation</h2>
            <p>Overtime Wage = (Basic Wage ÷ 8) × 2 × Overtime Hours</p>
            <p>Example: If the basic wage is ₹500/day & overtime is 2 hours:</p>
            <p>Overtime Pay = (500 ÷ 8) × 2 × 2 = ₹250 extra</p>
        </section>

        <section class="section-container">
            <h2 class="section-title">Wage Laws & Workers' Rights</h2>
            <ul>
                <li>What is the Minimum Wages Act?</li>
                <li>How is the minimum wage calculated?</li>
                <li>How to file a complaint for underpayment?</li>
            </ul>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-info">Know Your Rights</a>
            </div>
        </section>
    </div>
    <?php include 'includes/footer.php'; ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>