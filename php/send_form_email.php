<?php

 $url = 'smtp.sendgrid.net';
 $user = 'azure_1817263d3cfa53e07f693470e4ea6610@azure.com';
 $pass = '8B8wooxbTaBwe0r'; 

 $params = array(
      'api_user' => $user,
      'api_key' => $pass,
      'to' => 'domain@yourdomain.com',
      'subject' => 'You Down?!',
      'html' => 'testing body',
      'text' => 'testing body',
      'from' => 'noreply@youdown.com',
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