<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/reset.css" rel="stylesheet" type="text/css" media="all">
<link href="fonts/fonts.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/global.css" rel="stylesheet" type="text/css" media="all" />

</head>

<body style="background:none; font: normal 13px 'TurminoNormalRegular'; color:#444;">
<?php
if(isset($_POST['email'])) {
	
	// EDIT THE 2 LINES BELOW AS REQUIRED //
	$email_to = "info@injazctc.com"; 
	$email_subject = "Injaz CTC - Feedback";
	
	
	function died($error) {
		// your error code can go here
		echo "We are very sorry, but there were error(s) found with the form your submitted. ";
		echo "These errors appear below.<br /><br />";
		echo $error."<br /><br />";
		echo "Please go back and fix these errors.<br /><br />";
		die();
	}
	
	// validation expected data exists
	if(!isset($_POST['name']) ||
		!isset($_POST['company']) ||
		!isset($_POST['email']) ||
		!isset($_POST['phone']) ||
		!isset($_POST['comments'])) {
		died('We are sorry, but there appears to be a problem with the form your submitted.');		
	}
	
	$name = $_POST['name']; // required
	$company = $_POST['company']; // required
	$email_from = $_POST['email']; // required
	$phone = $_POST['phone']; // not required
	$comments = $_POST['comments']; // required
	
	$error_message = "";
	$email_exp = "^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$";
  if(!eregi($email_exp,$email_from)) {
  	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
	$string_exp = "^[a-z .'-]+$";
  if(!eregi($string_exp,$name)) {
  	$error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
	$string_exp = "^[a-z .'-]+$";

	
  if(strlen($comments) < 2) {
  	$error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  $string_exp = "^[0-9 .-]+$";
  if(!eregi($string_exp,$phone)) {
  	$error_message .= 'The Telphone Number you entered does not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
  	died($error_message);
  }
	$email_message = "Form details below.\n\n";
	
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
	
	$email_message .= "Name: ".clean_string($name)."\n";
	$email_message .= "Company: ".clean_string($company)."\n";
	$email_message .= "Email: ".clean_string($email_from)."\n";
	$email_message .= "Phone: ".clean_string($phone)."\n";
	$email_message .= "Comments: ".clean_string($comments)."\n";
	
	
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>

<!-- include your own success html here -->

Thank you for contacting us. We will be in touch with you very soon.

<?
}
?>

</body>
</html>