<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Worklink Dashboard</title>

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
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?customer,support') no-repeat center center/cover;
            text-align: center;
        }

        .contact-block {
            border: 1px solid #eee;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            text-align: center;
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

        .contact-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .social-links {
            text-align: center;
            margin-top: 20px;
        }

        .social-links a {
            margin: 0 10px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="hero animate__animated animate__fadeIn">
    <h1>Need Help? Contact Us Today!</h1>
    <div class="mt-3">
        <a href="#query-form" class="btn btn-primary">Submit an Inquiry</a>
    </div>
</div>

<div class="container mt-4">
    <section class="section-container">
        <h2 class="section-title">Support Phone Numbers & Emails</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="contact-block">
                    <i class="fas fa-phone fa-3x"></i>
                    <h3>Helpline for Workers & Job Seekers</h3>
                    <p>1800-XYZ-1234</p>
                    <p>support@worklink.gov</p>
                    <a href="tel:1800-XYZ-1234" class="btn btn-sm btn-success">Call Us Now</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-block">
                    <i class="fas fa-building fa-3x"></i>
                    <h3>Employer Assistance & Business Support</h3>
                    <p>1800-XYZ-5678</p>
                    <p>employers@worklink.gov</p>
                    <a href="tel:1800-XYZ-5678" class="btn btn-sm btn-success">Call Us Now</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-block">
                    <i class="fas fa-comments fa-3x"></i>
                    <h3>General Inquiries & Complaints</h3>
                    <p>helpdesk@worklink.gov</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-container">
        <h2 class="section-title">Office Addresses & Locations</h2>
        <div class="embed-responsive embed-responsive-16by9">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3783.337775586676!2d73.7981503750868!3d18.49033338235294!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2c159841f4f8b%3A0x6b107e324c489b0!2sPune%20Railway%20Station!5e0!3m2!1sen!2sin!4v1718873428945!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="accordion" id="officeAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Head Office
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#officeAccordion">
                    <div class="accordion-body">
                        [Address] | 📞 [Contact]
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        State & Regional Offices
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#officeAccordion">
                    <div class="accordion-body">
                        <ul>
                            <li>[State Office 1 Address] | 📞 [Contact]</li>
                            <li>[Regional Office 1 Address] | 📞 [Contact]</li>
                            <li>[State Office 2 Address] | 📞 [Contact]</li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="#" class="btn btn-info">Find the Nearest Office</a>
        </div>
    </section>

    <section id="query-form" class="section-container">
        <h2 class="section-title">Online Query Submission</h2>
        <form class="contact-form">
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name (Required)</label>
                <input type="text" class="form-control" id="fullName" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address (Required)</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number (Optional)</label>
                <input type="tel" class="form-control" id="phone">
                <small class="form-text text-muted">We'll never share your phone number with anyone else.</small>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject (Required)</label>
                <input type="text" class="form-control" id="subject" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message (Required)</label>
                <textarea class="form-control" id="message" rows="5" required></textarea>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="agree" required>
                <label class="form-check-label" for="agree">I agree to the terms and conditions</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            
        </form>
            </section>
            </div>
            <?php include '../includes/footer.php'; ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="../assets/js/script.js"></script>

</body>

</html>