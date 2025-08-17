<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "There was a problem with your submission. Please try again.";
        exit;
    }

    $from = "603340@student.belgiumcampus.co.za";
    $headers = "From: $from\r\nReply-To: $email";

    $to = "marno.hennops@gmail.com";
    $subject = "New Form Submission";
    $body = "Name: $name" . PHP_EOL . "Email: $email" . PHP_EOL . "Message: $message";
    
    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you for your message. We will get back to you soon.";
    } else {
        echo "There was a problem sending your message. Please try again later.";
    }
}
?>