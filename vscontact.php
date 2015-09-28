<?php

	if(isset($_POST['submit'])) {
	
		// Submission data.
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		$datetime = date('d/m/Y H:i:s');

		// Form data.
		$to = 'enroutesc@gmail.com'; 
		$name = $_POST['name']; 
		$email = $_POST['email'];
		$company = $_POST['company'];
		$website = $_POST['website'];
		$message = $_POST['message'];
		$subject = "$company - Vendor/Sponsor Form Submission";
		$body = "Vendor/Sponsor Form Submission - En Route Website.\r\n
				Name:{$name}\r\n
				Email Address: {$email}\r\n
				Company: {$company}\r\n
				Website: {$website}\r\n
				Message: {$message}\r\n
				This message was sent from the IP Address: {$ipaddress} at {$datetime}";

		$headers = "From: $email" . "\r\n" .
		"Reply-To: $$email" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();

		mail($to, $subject, $body, $headers);
		header('location:confirm.html');

	}
?>
