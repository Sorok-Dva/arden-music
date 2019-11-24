<?php

//echo crypt('Rayman3')." |____";
//$1$DdT91D0I$ECCHIDpf6dkfhRBkSNnAU.
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   empty($_POST['subject'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
       echo "error";
	return false;
   } else {
    $name = $_POST['name'];
    $email_address = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];

// Create the email and send the message
    $to = 'adprz@outlook.fr'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
    $email_subject = "Contact depuis le website de $name : \"$subject\"";
    $email_body = "Bonjour Arden, tu as reçu un nouveau message depuis ton website!.\n\n"."Voici les détails:\n\nNom: $name\n\nEmail: $email_address\n\nTéléphone: $phone\n\nMessage:\n$message";
    $headers = "From: $email_address \n";
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
    return true;
}

?>