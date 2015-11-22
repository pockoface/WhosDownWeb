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
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $message = trim($_POST["message"]);

  $email_content = "Name: $name\n";
  $email_content .= "Email: $email\n\n";
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
/*
$url = 'https://api.sendgrid.com/';
$user = 'azure_1817263d3cfa53e07f693470e4ea6610@azure.com';
$pass = '8B8wooxbTaBwe0r';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
  $name = strip_tags(trim($_POST["name"]));
  $name = str_replace(array("\r","\n"),array(" "," "),$name);
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $message = trim($_POST["message"]);

  $email_content = "Name: $name\n";
  $email_content .= "Email: $email\n\n";
  $email_content .= "Message:\n$message\n";

  $params = array(
    'api_user'  => $user,
    'api_key'   => $pass,
    'to'        => 'you.down.ent202@gmail.com',
    'subject'   => 'You Down',
    'text'      => $message,
    'from'      => 'noreply@youdown.com',
    );

  $request =  $url.'api/mail.send.json';

// Generate curl request
  $session = curl_init($request);
// Tell curl to use HTTP POST
  curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
  curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
  curl_setopt($session, CURLOPT_HEADER, false);
// Tell PHP not to use SSLv3 (instead opting for TLS)
  curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
  curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
  $response = curl_exec($session);
  curl_close($session);

// print everything out
  print_r($response);
}
*/
?>
