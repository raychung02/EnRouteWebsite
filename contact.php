<?php

	if(isset($_POST['submit'])) {
	
		// Submission data.
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		$datetime = date('d/m/Y H:i:s');

		// Form data.
		$to = 'enroutesc@gmail.com'; 
		$name = $_POST['name']; 
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$body = "Contact Form Submission - En Route Website.\r\n
				Name: {$name}\r\n
				Email Address: {$email}\r\n
				Subject: {$subject}\r\n
				Message: {$message}\r\n
				This message was sent from the IP Address: {$ipaddress} at {$datetime}";

		$headers = "From: $email" . "\r\n" .
		"Reply-To: $email" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();

		mail($to, $subject, $body, $headers);
		header('location: confirm.html');

	}
?>
