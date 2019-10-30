<?php
//
// SendGrid PHP Library Example
//
// This example shows how to send email through SendGrid
// using the SendGrid PHP Library.  For more information
// on the SendGrid PHP Library, visit:
//
//     https://github.com/sendgrid/sendgrid-php
//
require("sendgrid-php/vendor/autoload.php");
require("sendgrid-php/sendgrid-php.php");


/* USER CREDENTIALS
/  Fill in the variables below with your SendGrid
/  username and password.
====================================================*/
$sg_username = "azure_1817263d3cfa53e07f693470e4ea6610@azure.com";
$sg_password = "8B8wooxbTaBwe0r";


/* CREATE THE SENDGRID MAIL OBJECT
====================================================*/
$sendgrid = new SendGrid( $sg_username, $sg_password );
$mail = new SendGrid\Email();

/* SEND MAIL
/  Replace the the address(es) in the setTo/setTos
/  function with the address(es) you're sending to.
====================================================*/

  $name = strip_tags(trim($_POST["name"]));
  $name = str_replace(array("\r","\n"),array(" "," "),$name);
  $recipient_email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $message = trim($_POST["message"]);

  $email_content = "Name: $name\n";
  $email_content .= "Email: $recipient_email\n\n";
  $email_content .= "Message:\n$message\n";

try {
    $mail->
    setFrom( "noreply@youdown.com" )->
    addTo( "you.down.ent202@gmail.com" )->
    setSubject( "You Down?!" )->
    setText( $email_content )->
    setHtml( "" );
    
    $response = $sendgrid->send( $mail );

    if (!$response) {
        throw new Exception("Did not receive response.");
    } else if ($response->message && $response->message == "error") {
        throw new Exception("Received error: ".join(", ", $response->errors));
    } else {
        print_r($response);
    }
} catch ( Exception $e ) {
    var_export($e);
}

?>
