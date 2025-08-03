<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Vehicle Rental</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: #fff;
    padding: 20px;
}

nav ul {
    list-style: none;
    padding: 0;
}

nav ul li {
    display: inline;
    margin-right: 20px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
}

nav ul li a.active {
    font-weight: bold;
}

main {
    padding: 20px;
}

.contact-form {
    margin: 0 auto;
    max-width: 400px;
}

.contact-form h2 {
    margin-bottom: 10px;
}

.contact-form label {
    display: block;
    margin-bottom: 5px;
}

.contact-form input[type="text"],
.contact-form input[type="email"],
.contact-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.contact-form button {
    background-color: #333;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.contact-info {
    background-color: #f4f4f4;
    padding: 20px;
}

.contact-info h2 {
    margin-bottom: 10px;
}

.contact-info ul {
    padding: 0;
}

.contact-info ul li {
    margin-bottom: 5px;
}

    </style>
</head>
<body>
    <header>
        <h1>Contact Us</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html" class="active">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="contact-form">
            <h2>Send us a Message</h2>
            <form action="#" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>

                <button type="submit" name="send">Send</button>
            </form>
        </section>

        <section class="contact-info">
            <h2>Contact Information</h2>
            <p>If you have any questions or inquiries, feel free to contact us using the information below:</p>
            <ul>
                <li>Email: vehiclerental.c6@gmail.com</li>
                <li>Phone: 1234567890</li>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Vehicle Rental</p>
    </footer>
</body>
</html>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['send'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];

    //Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

//Load Composer's autoloader
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {                     //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ravi2005.madduri@gmail.com';                     //SMTP username
    $mail->Password   = 'fxmu ppzg muag rvuo';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('vehiclerental.c6@gmail.com', 'Contact Us');
    $mail->addAddress('vehiclerental.c6@gmail.com', 'Vehicle Rental');     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Contact Us';
    $mail->Body    = "Sender name: $name <br> Sender mail: $email <br> Message: $message";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

?>
