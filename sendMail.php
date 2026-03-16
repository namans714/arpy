<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status"=>"error","message"=>"Invalid request"]);
    exit;
}

$fname   = $_POST['fname'] ?? '';
$lname   = $_POST['lname'] ?? '';
$email   = $_POST['email'] ?? '';
$phone   = $_POST['phone'] ?? '';
$service = $_POST['service'] ?? '';
$message = $_POST['message'] ?? '';

if(!$fname || !$lname || !$email || !$phone || !$message){
    echo json_encode(["status"=>"error","message"=>"Please fill all fields"]);
    exit;
}

$mail = new PHPMailer(true);

try {
    // SERVER SETTINGS
    $mail->isSMTP();
    $mail->Host       = "smtpout.secureserver.net";    
    $mail->SMTPAuth   = true;
    $mail->Username   = "info@arpyrenewables.com";  
    $mail->Password   = "Arpy@2025";  
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //$mail->Port       = 587;
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // TCP port to connect to
	$mail->Timeout = 5;
	$mail->SMTPKeepAlive = false;
	// $mail->SMTPSecure = "ssl";
    // $mail->Port = 465;

    // SENDER & RECEIVER (same address allowed)
    $mail->setFrom("info@arpyrenewables.com", "ARPY Renewables Contact Form");
    $mail->addReplyTo("piyush@arpyrenewables.com", "Mr.Piyush Mathur");
    $mail->addAddress("piyush@arpyrenewables.com");

    // CONTENT
    $mail->isHTML(true);
    $mail->Subject = "New Customer Enquiry - AMC Services | ARPY Renewables";

    $mail->Body = "
      <p>Hello Piyush,</p>

        <p>You have received a new customer enquiry through the ARPY Renewables website.</p>
        <h3>Customer Details:</h3>
        
        <table border='1' cellpadding='8' cellspacing='0' width='100%'>
        <tr><td><strong>Name</strong></td><td>$fname $lname</td></tr>
        <tr><td><strong>Email</strong></td><td>$email</td></tr>
        <tr><td><strong>Phone</strong></td><td>$phone</td></tr>
        <tr><td><strong>Service</strong></td><td>$service</td></tr>
        <tr><td><strong>Message</strong></td><td>$message</td></tr>
        </table>

		<br>
        <p>Please respond to the customer within 24 hours.</p>
        <br>
        <p>Best Regards,<br>
        Arpy Renewables Website<br>
        www.arpyrenewables.com<br>
        +91 99711 22890
        </p>
    ";

    $mail->send();

    echo json_encode(["status"=>"success","message"=>"Message sent successfully!"]);

} catch (Exception $e) {
    echo json_encode(["status"=>"error","message"=>"Mail Error: ".$mail->ErrorInfo]);
}
