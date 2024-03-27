<?php
session_start();
unset($_SESSION['success']);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Your Gmail credentials

require 'PHPMailer-master/src/Exception.php';

/* The main PHPMailer class. */
require 'PHPMailer-master/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'PHPMailer-master/src/SMTP.php';



$emailTo = 'nobuhlemlahleki@gmail.com';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["contactName"];
    $emailFrom = $_POST["contactEmail"];
    $subject = $_POST["contactSubject"];
    $message = $_POST["contactMessage"];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'nobuhlemlahleki@gmail.com';
        $mail->Password   = 'jcob fytq hkhg xpac'; // Your Gmail password
        $mail->SMTPSecure = 'tls'; // Encryption type
        $mail->Port       = 587; // Port for TLS encryption

        $mail->setFrom($emailFrom);
        $mail->addAddress($emailTo);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "Name: $name<br><br>" . $message;

        if ($mail->send()) {
            $_SESSION['success'] = true;
			error_log('Email sent successfully to ' . $emailTo);
        } else {
            $_SESSION['success'] = false;
			error_log('Email sending failed: ' . $mail->ErrorInfo);
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        $_SESSION['success'] = false;
        echo 'Exception: ' . $e->getMessage();
    }

    header('Location: index.html'); // Redirect back to the contact form page
    exit(); // Terminate script execution after redirection
} else {
    header('Location: index.html'); // Redirect back to the contact form page if accessed directly
    exit(); // Terminate script execution after redirection
}
?>
