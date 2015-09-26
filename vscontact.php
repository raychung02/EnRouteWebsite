<?php

	if(isset($_POST['submit'])) {
	
		// Submission data.
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		$datetime = date('d/m/Y H:i:s');

		// Form data.
		$to = 'illooroo@gmail.com'; 
		$name = $_POST['name']; 
		$email = $_POST['email'];
		$company = $_POST['company'];
		$website = $_POST['website'];
		$message = $_POST['message'];
		$subject = "$company - Vendor/Sponsor Form Submission";
		$body = "<p>Vendor/Sponsor Form Submission - En Route Website.</p>
				<p><strong>Name: </strong> {$name} </p>
				<p><strong>Email Address: </strong> {$email} </p>
				<p><strong>Company: </strong> {$company} </p>
				<p><strong>Website: </strong> {$website} </p>
				<p><strong>Message: </strong> {$message} </p>
				<p>This message was sent from the IP Address: {$ipaddress} at {$datetime}</p>";

		$headers = "From: $email" . "\r\n" .
		"Reply-To: $to" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();

		mail($to, $subject, $body, $headers);
		header('location:confirm.html');

	}
?>
