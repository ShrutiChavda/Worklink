<?php
session_start();
require 'includes/db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer\PHPMailer.php');
require('PHPMailer\SMTP.php');
require('PHPMailer\Exception.php');

$em = $_SESSION['em'];

        date_default_timezone_set("Asia/Kolkata");
        $s_time = date("Y-m-d G:i:s", strtotime("+ 1 min"));

        $token = hash('sha512', $s_time);
        $otp = mt_rand(100000, 999999);
        $ins_token = "INSERT INTO token1 VALUES ('','$em','$s_time','$token',$otp)";
        
        if (mysqli_query($conn, $ins_token)) {
            $link = "http://localhost/Worklink/verify_otp.php?email=$em&token=$token";

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP(); 
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true; 
                $mail->Username = 'chavdashruti516@gmail.com'; 
                $mail->Password = 'xwig fjqp gnea fqml'; 
                $mail->SMTPSecure = 'ssl'; 
                $mail->Port = 465; 
                $mail->SMTPDebug = 0; 

                $mail->setFrom('chavdashruti516@gmail.com', 'Worklink');
                $mail->addAddress($em, 'Shruti'); 
                $mail->addReplyTo('chavdashruti516@gmail.com', 'Reply');

                $mail->isHTML(true); 
                $mail->Subject = 'Password reset link for user';
                $mail->Body    = 'OTP for password reset is ' . $otp . ' <br/>This is the password reset link for your account. The link is valid for 1 minute.=> ' . @$link .  "<br/> Please use forgot password facility again if the link has expired";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if ($mail->send()) {
                    echo "<script type='text/javascript'>alert('Password reset link has been sent to your registered email. Please check the spam folder as well.');</script>";
                    echo "<script type='text/javascript'> window.location.href='http://localhost/Worklink/login.php';</script>'";
                }
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

?>
