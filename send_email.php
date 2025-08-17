use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

<?php

require 'hmail/PHPMailer/src/Exception.php';
require 'hmail/PHPMailer/src/PHPMailer.php';
require 'hmail/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        empty($_POST['name']) ||
        empty($_POST['email']) ||
        empty($_POST['message'])
    ) {
        echo "All fields are required. Please fill out the form completely.";
        exit;
    }

    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "There was a problem with your submission. Please try again.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->Port = 25;
        $mail->SMTPAuth = false;
        // $mail->Username = 'your_username';
        // $mail->Password = 'your_password';

        $mail->setFrom('603340@student.belgiumcampus.co.za', 'Website Contact');
        $mail->addAddress('marno.hennops@gmail.com');

        $mail->Subject = 'New Form Submission';
        $mail->Body    = "Name: $name\nEmail: $email\nMessage: $message";
        $mail->AltBody = $mail->Body;

        $mail->send();
        echo "Thank you for your message. We will get back to you soon.";
    } catch (Exception $e) {
        echo "There was a problem sending your message. Please try again later.";
    }
}
?>