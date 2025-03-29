<?php 

session_start();
require 'includes/db.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer\PHPMailer.php');
require('PHPMailer\SMTP.php');
require('PHPMailer\Exception.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

    <style>
        .hero {
            height: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            font-size: 2rem;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?password,recovery') no-repeat center center/cover;
            text-align: center;
        }

        .forgot-password-card {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #eee;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<?php include 'includes/nav.php'; ?>

    <div class="hero">
        <h1>Forgot Your Password?</h1>
        <p>Enter your email to reset it.</p>
    </div>

    <div class="container">
        <div class="forgot-password-card">
            <form method="POST" class="user" id="form1">
                                        <div class="form-group">
                                            <label for="email">Enter your Email</label><br><br>
                                            <input type="email" name="em" id="email1"
                                                class="form-control form-control-user" id="exampleInputEmail"
                                                aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                            <span id="em_err" class="emm"></span>
                                        </div><br>
                                        <button type="submit" name="sub" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                    </button>
                                    </form>

        </div>
    </div>
                                        
<?php
if (isset($_POST['sub'])) {
    $em = @$_POST['em'];
	$q = "select * from users where email='$em'";
	$count = mysqli_num_rows(mysqli_query($conn, $q));
	if ($count == 1) {
		$q1 = "select * from token1 where Email='$em'";
		$countem = mysqli_num_rows(mysqli_query($conn, $q1));
		if ($countem == 1) {
			echo "<script type='text/javascript'>alert('A Password reset link is already sent to your mail please check. New link will be generated after old link expires');</script>";
		} else {
			date_default_timezone_set("Asia/Kolkata");
			$s_time = date("Y-m-d G:i:s", strtotime("+ 1 min"));

			$token = hash('sha512', $s_time);
			$otp = mt_rand(100000, 999999);
			$ins_token = "INSERT INTO token1 VALUES ('','$em','$s_time','$token',$otp)";
			
			if (mysqli_query($conn, $ins_token)) {
				$link = "http://localhost/Worklink/verify_otp.php?email=$em&token=$token";
				//echo $link;
				$mail = new PHPMailer(true);
				try {
					$mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true; 
                $mail->Username = 'chavdashruti516@gmail.com'; 
                $mail->Password = 'ikcm jbpr tcxm rhsz'; 
                $mail->SMTPSecure = 'ssl'; 
                $mail->Port = 465; 
                $mail->SMTPDebug = 0;                           

					$mail->setFrom('chavdashruti516@gmail.com', 'Worklink');
					$mail->addAddress($em, 'Shruti');    
					$mail->addReplyTo('chavdashruti516@gmail.com', 'Reply');
				
					$mail->isHTML(true);                              
					$mail->Subject = 'Password reset link for User';
					$mail->Body    = 'OTP for password reset is ' . $otp . ' <br/>This is the password reset link for your account. The link is valid for 1 minute.=>   ' . @$link .  "<br/> Please use forgot password facility again if the link has expired";
					$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					if ($mail->send()) {
						echo '<script>alert("Password reset link has been sent to your registered email.Please check the spam also.");</script>';
					}
				}catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
			}
		}
	} else {
		echo "<script type='text/javascript'>alert('No such Email address is registered'); window.location='forgot_password.php';</script>";
	}
}
?>


<?php include 'includes/footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="assets/js/script.js"></script> 

</body>
</html>