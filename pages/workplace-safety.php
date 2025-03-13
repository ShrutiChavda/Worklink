<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workplace Safety Guidelines - Worklink Dashboard</title>

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
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?workplace,safety') no-repeat center center/cover;
            text-align: center;
        }

        .safety-card {
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

        .safety-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .safety-table th, .safety-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .safety-table th {
            background-color: #f2f2f2;
        }

        .sticky-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="hero animate__animated animate__fadeIn">
    <h1>Prioritizing Safety: Ensuring a Secure Workplace for All</h1>
    <div class="mt-3">
        <a href="#safety-guidelines" class="btn btn-primary">Learn Safety Guidelines</a>
    </div>
</div>

<div class="container mt-4">
    <section class="section-container">
        <h2 class="section-title">Introduction</h2>
        <p>Workplace safety guidelines are essential for preventing accidents and ensuring a healthy work environment. These guidelines cover various aspects of safety, including factory laws, emergency protocols, and hazard handling.</p>
        <div class="text-center mt-3">
            <img src="https://source.unsplash.com/600x400/?safety,inspection" alt="Safety Inspection" class="img-fluid">
        </div>
    </section>

    <section id="safety-guidelines" class="section-container">
        <h2 class="section-title">Factory Safety Laws</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="safety-card">
                    <h3>Industrial Safety Standards</h3>
                    <p>PPE (Personal Protective Equipment), machine safety.</p>
                    <a href="#" class="btn btn-sm btn-info">Read Full Guidelines</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="safety-card">
                    <h3>Factory Act Compliance</h3>
                    <p>Legal safety requirements for manufacturing units.</p>
                    <a href="#" class="btn btn-sm btn-info">Read Full Guidelines</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="safety-card">
                    <h3>Construction Site Safety</h3>
                    <p>Guidelines for scaffolding, height work, and protective gear.</p>
                    <a href="#" class="btn btn-sm btn-info">Read Full Guidelines</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Fire & Emergency Protocols</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/VIDEO_ID_1" title="Fire Drill Demonstration" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/VIDEO_ID_2" title="Evacuation Steps in Case of Emergency" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/VIDEO_ID_3" title="Basic First Aid Training" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="#" class="btn btn-secondary">View Full Fire Safety Guide</a>
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Hazardous Material Handling</h2>
        <div class="accordion" id="hazardAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Chemical Storage & Disposal
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#hazardAccordion">
                    <div class="accordion-body">
                        Guidelines for hazardous waste handling.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Machinery Safety
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#hazardAccordion">
                    <div class="accordion-body">
                        Lockout/tagout (LOTO) procedures.
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