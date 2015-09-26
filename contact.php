<?php

	if(isset($_POST['submit'])) {
	
		// Submission data.
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		$datetime = date('d/m/Y H:i:s');

		// Form data.
		$to = 'illooroo@gmail.com'; 
		$name = $_POST['name']; 
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$body = "<p>Contact Form Submission - En Route Website.</p>
				<p><strong>Name: </strong> {$name} </p>
				<p><strong>Email Address: </strong> {$email} </p>
				<p><strong>Subject: </strong> {$subject} </p>
				<p><strong>Message: </strong> {$message} </p>
				<p>This message was sent from the IP Address: {$ipaddress} at {$datetime}</p>";

		$headers = "From: $email" . "\r\n" .
		"Reply-To: $to" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();

		mail($to, $subject, $body, $headers);
		header('location: confirm.html');

	}
?>
