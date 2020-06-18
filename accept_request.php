<?php


require("db_config.php");

	$user_id = trim($_GET["user_id"]);
	$app_id = trim($_GET["app_id"]);
	$approved='"approved"';

	$query ="UPDATE applications SET status = ".$approved." WHERE user_id= ".$user_id." AND id=".$app_id;  
	
	$result = mysqli_query($link, $query);  
	
	$query ="SELECT email FROM users WHERE id= ".$user_id; 
		
	$result = mysqli_query($link, $query);  

	$row = mysqli_fetch_array($result);

	mysqli_close($link);


	//GOT TO 10 minut emails and get one
	$to = $row['email']; 
	// Subject
	$subject = 'New Request';
	// Message
	$message = '
	<html>
	<head>
		<title>Accepted request</title>
	</head>
	<body>
	<p> “Dear employee, your supervisor has accepted your application
	submitted on</p>
	</body>
	</html>
	';

	// To send HTML mail, the Content-type header must be set
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=iso-8859-1';

	// Additional headers
	$headers[] = 'To:'.$row['email'];
	$headers[] = 'From: localhost';
	$headers[] = 'Cc: localhost@localhost.com';
	$headers[] = 'Bcc: localhost@localhost.com';

	// Mail it
	mail($to, $subject, $message, implode("\r\n", $headers));




?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="index.css">
	<title>Document</title>
</head>
<body>
	<p>Request Approved</p>
</body>
</html>