<?php

$url = 'https://api.sendgrid.com/';//smtp.sendgrid.net
$user = 'azure_1817263d3cfa53e07f693470e4ea6610@azure.com';
$pass = '8B8wooxbTaBwe0r'; 

    // Only process POST reqeusts.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
  $name = strip_tags(trim($_POST["name"]));
  $name = str_replace(array("\r","\n"),array(" "," "),$name);
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
  if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
    //http_response_code(400);
    echo "Oops! There was a problem with your submission. Please complete the form and try again.";
    exit;
  }

        // Build the email content.
  $email_content = "Name: $name\n";
  $email_content .= "Email: $email\n\n";
  $email_content .= "Message:\n$message\n";

  $params = array(
    'api_user' => $user,
    'api_key' => $pass,
    'to' => 'chrisbama92@gmail.com',//you.down.ent202@gmail.com
    'subject' => 'You Down?!',
    'html' => $email_content,
    'text' => $email_content,
    'from' => $email,
    );

  $request = $url.'api/mail.send.json';

 // Generate curl request
  $session = curl_init($request);

 // Tell curl to use HTTP POST
  curl_setopt ($session, CURLOPT_POST, true);

 // Tell curl that this is the body of the POST
  curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

 // Tell curl not to return headers, but do return the response
  curl_setopt($session, CURLOPT_HEADER, false);
  curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

 // obtain response
  $response = curl_exec($session);
  curl_close($session);

 // print everything out
  print_r($response);
?>