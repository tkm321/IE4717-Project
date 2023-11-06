<?php

$enquirer_name = $_POST['name'];
$enquirer_email = $_POST['email'];
$enquirer_contact = $_POST['contact'];
$enquirer_message = $_POST['message'];

// Send Enquiry Confirmation email 
$to      = 'f32ee@localhost';
$subject = 'Contact Form Enquiry Confirmation';
$message = 
// START OF EMAIL MESSAGE STRUCTURE
'Dear ' . $enquirer_name . ",\r\n\n" .
'We have successfully received your enquiry. Our team will review your message and get back to you as soon as possible within 2 working days. In the meantime, please feel free to explore our website for more information about our products and services.' . "\r\n\n" .

'If you require immediate assistance, do not hesitate to contact us directly at tel:+6567671314.' . "\r\n\n" .

'Best Regards,' . "\r\n" .
'NovaTech Customer Support Team' . "\r\n\n" .

'--------------------------------------------------------------------------------' . "\r\n\n" .

'Enquirer Details:' . "\r\n" .
'Name: ' . $enquirer_name . "\r\n" .
'Email: ' . $enquirer_email . "\r\n" .
'Contact Number: ' . $enquirer_contact . "\r\n" .
'Message: ' . "\r\n" . $enquirer_message;
// END OF EMAIL MESSAGE STRUCTURE

$headers = 'From: noreply@novatech.com.sg' . "\r\n" .
    'Reply-To: noreply@novatech.com.sg' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers,'-ff32ee@localhost');
echo '<script> alert("Your enquiry has been sent! We get back to you as soon as possible."); </script>';
header("Location: ../contact.php");
?>