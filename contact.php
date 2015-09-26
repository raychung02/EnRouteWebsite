<?php
	
	// Submission data.
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$datetime = date('d/m/Y H:i:s');

	// Form data.
	$name = $_POST['name']; 
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$to = 'illooroo@gmail.com'; 
	$body = "<p>Contact Form Submission - En Route Website.</p>
			<p><strong>Name: </strong> {$name} </p>
			<p><strong>Email Address: </strong> {$email} </p>
			<p><strong>Subject: </strong> {$subject} </p>
			<p><strong>Message: </strong> {$message} </p>
			<p>This message was sent from the IP Address: {$ipaddress} at {$datetime}</p>";

	$headers = "From: $email" . "\r\n" .
	"Reply-To: $email" . "\r\n" .
	"X-Mailer: PHP/" . phpversion();

	if(isset($_POST['submit'])) {              
		mail($to, $subject, $body, $headers); 
		echo "<p>Your message has been sent. Thank you!</p>";
	} 
	else { 
		echo "<p>Something went wrong, go back and try again!</p>"; 
	} 

	// Return to form.
	$returndata = array(
		'posted_form_data' => array(
			'name' => $name,
			'email' => $email,
			'subject' => $subject,
			'message' => $message
		),
	);

	// If this is not an ajax request.
	if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {

		// Set session variables
		session_start();
		$_SESSION['cf_returndata'] = $returndata;

		// Redirect back to form
		header('location: ' . $_SERVER['HTTP_REFERER']);
	}
?>