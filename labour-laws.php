<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labour Laws & Regulations - Worklink Dashboard</title>

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
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?labour,laws') no-repeat center center/cover;
        text-align: center;
    }

    .law-card {
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

    .law-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .law-table th,
    .law-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .law-table th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>

    <?php include 'includes/nav.php'; ?>

    <div class="hero animate__animated animate__fadeIn">
        <h1>Understanding Labour Laws & Your Rights</h1>
    </div>

    <div class="container mt-4">
        <section class="section-container">
            <h2 class="section-title">Overview of Labour Laws</h2>
            <p>Labour laws in India are designed to protect the rights of workers and ensure fair employment practices.
                Here's an overview of key labour laws:</p>
            <ul>
                <li><strong>The Minimum Wages Act, 1948:</strong> Sets minimum wages for workers.</li>
                <li><strong>The Factories Act, 1948:</strong> Ensures safety, health, and welfare of workers in
                    factories.</li>
                <li><strong>The Industrial Disputes Act, 1947:</strong> Provides mechanisms for resolving industrial
                    disputes.</li>
                <li><strong>The Employees' Provident Funds and Miscellaneous Provisions Act, 1952:</strong> Provides
                    social security benefits.</li>
                <li><strong>The Maternity Benefit Act, 1961:</strong> Protects the employment of women during maternity.
                </li>
                <li><strong>The Payment of Gratuity Act, 1972:</strong> Provides for payment of gratuity to employees.
                </li>
                <li><strong>The Contract Labour (Regulation and Abolition) Act, 1970:</strong> Regulates the employment
                    of contract labour.</li>
            </ul>
        </section>

        <section class="section-container">
            <h2 class="section-title">Employee Rights & Protections</h2>
            <p>Employees in India have several rights and protections under labour laws:</p>
            <ul>
                <li>Right to fair wages and timely payment.</li>
                <li>Right to safe and healthy working conditions.</li>
                <li>Right to fixed working hours and overtime pay.</li>
                <li>Right to paid leaves and holidays.</li>
                <li>Right to job security and protection against unfair dismissal.</li>
                <li>Right to maternity benefits and childcare facilities.</li>
                <li>Right to social security benefits like provident fund and gratuity.</li>
            </ul>
        </section>

        <section class="section-container">
            <h2 class="section-title">Employer Obligations</h2>
            <p>Employers have several obligations under labour laws:</p>
            <ul>
                <li>To pay fair wages and ensure timely payment.</li>
                <li>To provide safe and healthy working conditions.</li>
                <li>To comply with working hour regulations and pay overtime.</li>
                <li>To provide paid leaves and holidays.</li>
                <li>To ensure job security and follow legal procedures for dismissal.</li>
                <li>To provide maternity benefits and childcare facilities.</li>
                <li>To contribute to social security schemes like provident fund and gratuity.</li>
            </ul>
        </section>

        <section class="section-container">
            <h2 class="section-title">Dispute Resolution Process</h2>
            <p>Labour disputes can be resolved through various mechanisms:</p>
            <ul>
                <li><strong>Conciliation:</strong> A third party facilitates discussions between the employer and
                    employees.</li>
                <li><strong>Mediation:</strong> A neutral mediator helps the parties reach a mutually agreeable
                    solution.</li>
                <li><strong>Arbitration:</strong> A neutral arbitrator makes a binding decision.</li>
                <li><strong>Labour Courts and Tribunals:</strong> For legal resolution of disputes.</li>
            </ul>
        </section>

        <section class="section-container">
            <h2 class="section-title">Labour Law FAQs</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            What is the minimum wage in my state?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            The minimum wage varies by state and industry. Please refer to the state-specific minimum
                            wage notifications.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            How do I file a complaint for unpaid wages?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            You can file a complaint with the labour commissioner or through the online grievance
                            portal.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            What are my rights during maternity leave?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            You have the right to maternity leave for up to 90 days. You can apply for leave through the
                            employer's website or by filing a notice of leave with the labour commissioner.
                        </div>
                    </div>
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