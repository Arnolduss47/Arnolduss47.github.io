<?php

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

    $to = "marno.hennops@gmail.com";
    $subject = "New Form Submission";
    $body = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $email\r\nReply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you for your message. We will get back to you soon.";
    } else {
        echo "There was a problem sending your message. Please try again later.";
    }
}
?>