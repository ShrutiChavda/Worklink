<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "worklink";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    $sql = "INSERT INTO queries (fullName, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $fullName, $email, $phone, $subject, $message);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    if($stmt){
        echo "<script>alert('Your query is submitted successfully');</script>";
    }
}
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
    <link rel="stylesheet" href="assets/css/styles.css">

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
            text-align: center;
            background: linear-gradient(to right,rgb(159, 162, 166),rgb(150, 158, 159));
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

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 125px;
            justify-items: center;
        }

        .team-card {
            text-align: center;
            padding: 15px;
            margin-top: 10%;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .team-card img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .team-card h5 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        .team-card p {
            color: #777;
        }

        .team-card .role {
            font-style: italic;
            color: #888;
            margin-top: 10px;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.2);
        }

        .jobseeker {
            background-color: #d1f7d1;
        }

        .employer {
            background-color: #fff5b1;
        }

        .training-provider {
            background-color: #d0e9ff;
        }

        .leader-card {
            grid-column: 1 / -1;
            justify-self: center;
            background-color: #d0e9ff;
            border: 2px solid #007bff;
            box-shadow: 0px 4px 10px rgba(0, 0, 255, 0.2);
            width: 35%;
        }

        @media (max-width: 768px) {
            .leader-card {
                width: 90%;
            }
            .team-grid {
                gap: 30px;
            }
        }

        .leader-card img {
            border: 3px solid #007bff;
        }

        .team-group {
            margin-bottom: 40px;
        }

        .team-group-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .contact-form {
            max-width: 700px;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <?php include 'includes/nav.php'; ?>

    <div class="hero animate__animated animate__fadeIn">
        <h1>Meet Our Amazing Student Team</h1>
        <p class="mt-2">A collaborative project built with dedication and creativity</p>
    </div>

    <div class="container mt-4">
        <section class="section-container">
            <div class="team-grid">
                <div class="team-card leader-card animate__animated animate__fadeIn">
                    <img src="https://api.dicebear.com/7.x/adventurer/png?seed=Shruti119&gender=female&skinColor=ffffff" alt="Leader">
                    <h5>Shruti Chavda</h5>
                    <p>schavda684@rku.ac.in</p>
                    <strong>Team Leader</strong>
                    <p class="role">Admin & Govt. Official</p>
                </div>

                <div class="team-group">
                    <h3 class="team-group-title">Jobseeker Module</h3>
                    <div class="team-card jobseeker animate__animated animate__fadeIn">
                        <img src="https://api.dicebear.com/7.x/adventurer/png?seed=Archil912&gender=male&skinColor=ffffff" alt="Archil">
                        <h5>Archil Gajera</h5>
                        <p>agajera171@rku.ac.in</p>
                    </div>
                    <div class="team-card jobseeker animate__animated animate__fadeIn">
                        <img src="https://api.dicebear.com/7.x/adventurer/png?seed=Rutika18&gender=female&skinColor=ffffff" alt="Rutika">
                        <h5>Rutika Vaghasiya</h5>
                        <p>rvaghasiya328@rku.ac.in</p>
                    </div>
                </div>

                <div class="team-group">
                    <h3 class="team-group-title">Employer Module</h3>
                    <div class="team-card employer animate__animated animate__fadeIn">
                    <img src="https://api.dicebear.com/7.x/adventurer/png?seed=Kashish19&gender=female&skinColor=ffffff" alt="Kashish">
                    <h5>Kashish Koshiya</h5>
                        <p>kkoshiya268@rku.ac.in</p>
                    </div>
                    <div class="team-card employer animate__animated animate__fadeIn">
                        <img src="https://api.dicebear.com/7.x/adventurer/png?seed=Hemanshi152&gender=female&skinColor=ffffff" alt="Hemanshi">
                        <h5>Hemanshi Garnara</h5>
                        <p>hgarnara015@rku.ac.in</p>
                    </div>
                </div>

                <div class="team-group">
                    <h3 class="team-group-title">Training Provider Module</h3>
                    <div class="team-card training-provider animate__animated animate__fadeIn">
                        <img src="https://api.dicebear.com/7.x/adventurer/png?seed=Avani5&gender=female&skinColor=ffffff" alt="Avani">
                        <h5>Avani Tarapara</h5>
                        <p>atarapara765@rku.ac.in</p>
                    </div>
                    <div class="team-card training-provider animate__animated animate__fadeIn">
                        <img src="https://api.dicebear.com/7.x/adventurer/png?seed=krutii&gender=female&skinColor=ffffff" alt="Kruti">
                        <h5>Kruti Patel</h5>
                        <p>kpatel527@rku.ac.in</p>
                    </div>
                    <div class="team-card training-provider animate__animated animate__fadeIn">
                        <img src="https://api.dicebear.com/7.x/adventurer/png?seed=happy4&gender=female&skinColor=ffffff" alt="Happy">
                        <h5>Happy Domadia</h5>
                        <p>hdomadia699@rku.ac.in</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="query-form" class="section-container">
            <h2 class="section-title">Online Query Submission</h2>
            <form class="contact-form" method="post" action="contact.php">
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name (Required)</label>
                    <input type="text" class="form-control" name="fullName" id="fullName" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address (Required)</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number (Optional)</label>
                    <input type="tel" class="form-control" name="phone" id="phone">
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject (Required)</label>
                    <input type="text" class="form-control" name="subject" id="subject" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message (Required)</label>
                    <textarea class="form-control" name="message" id="message" rows="5" required></textarea>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="agree" required>
                    <label class="form-check-label" for="agree">I agree to the terms and conditions</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </section>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
