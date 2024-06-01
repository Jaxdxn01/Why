<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@gmail.com'; // Replace with your Gmail address
        $mail->Password = 'your_password';       // Replace with your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('your_email@gmail.com', 'Your Name');
        $mail->addAddress('jaeden4050@gmail.com', 'Jaeden'); // Replace with recipient email address

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission: $subject";
        $mail->Body    = "You have received a new message from your website contact form.<br><br>".
                         "Here are the details:<br><br>".
                         "Name: $name<br>".
                         "Email: $email<br>".
                         "Subject: $subject<br>".
                         "Message:<br>$message";

        $mail->send();
        echo 'success';
    } catch (Exception $e) {
        echo "error: {$mail->ErrorInfo}";
    }
}
?>
