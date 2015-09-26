<?php
	
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
	$subject = "$company - Vendor/Sponsor Form Submission"
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

	if(isset($_POST['submit'])) {              
		mail($to, $subject, $body, $headers); 
		echo "<p>Your message has been sent. Thank you!</p>";
	}

	// Return to form.
	$returndata = array(
		'posted_form_data' => array(
			'name' => $name,
			'email' => $email,
			'company' => $company,
			'website' => $website,
			'message' => $message
		),
	);

	// If this is not an ajax request.
	if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
		
		// Set session variables.
		session_start();
		$_SESSION['cf_returndata'] = $returndata;

		// Redirect back to form.
		header('location: ' . $_SERVER['HTTP_REFERER']);
	}
?>