<?php 

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: index.php");
		exit;
}

require("db_config.php");


$error='';

if($_SERVER["REQUEST_METHOD"] == "POST"){

		$date_start=trim($_POST["date_start"]);
		$date_end=trim($_POST["date_end"]);
		$reason=trim($_POST["reason"]);
		$user_id=trim($_SESSION["id"]);



		$date1 = new DateTime(date("d-m-Y", strtotime($_POST["date_end"])));
		$date2 = new DateTime(date("d-m-Y", strtotime($_POST["date_start"])));

		if($date1<$date2){
			$error="CANNOT ASK FOR 0 DAYS or NEGATIVE";
		}


		if(empty($error)){
					$sql = "INSERT INTO applications (date_start,date_end, reason,user_id) VALUES (?, ?, ?,?)";
				 
				if($stmt = mysqli_prepare($link, $sql)){
						mysqli_stmt_bind_param($stmt, "ssss", $param_date_start,$param_date_end,$param_reason,$param_user_id);
						
						$param_date_start=$date_start;
						$param_date_end=$date_end;
						$param_reason=$reason;
						$param_user_id=$user_id;
					
						if(mysqli_stmt_execute($stmt)){
							// GET THE LAST REQUEST ID OF THIS USER

				
							$query2 ="SELECT * FROM applications WHERE user_id= ".$_SESSION['id']." ORDER BY id DESC LIMIT 1";

							// echo $query2;
							$result2 = mysqli_query($link, $query2);  
							
							$row = mysqli_fetch_array($result2);
							
						
					
							//SEND MAIL
								//GOT TO 10 minut emails and get one
								$to = 'tbnjzysjojrbtgqkga@awdrt.org'; 
								// Subject
								$subject = 'New Request';
								// Message
								$message = '
								<html>
								<head>
									<title>New request</title>
								</head>
								<body>
									<p>Dear supervisor, employee.' . $_SESSION["first_name"].' '.$_SESSION["last_name"] . '. requested for some time off, starting on
									'.$date_start.' and ending on '.$date_end.', stating the reason:
									'.$reason.'
									Click on one of the below links to approve or reject the application:
									</p>
					
									<a href="http://localhost/epignosis/accept_request.php?user_id='.$_SESSION['id'].'&app_id='.$row['id'].'">ACCEPT</a>

									<a href="http://localhost/epignosis/deny_request.php?user_id='.$_SESSION['id'].'&app_id='.$row['id'].'">DENY</a>

								</body>
								</html>
								';

								// To send HTML mail, the Content-type header must be set
								$headers[] = 'MIME-Version: 1.0';
								$headers[] = 'Content-type: text/html; charset=iso-8859-1';

								// Additional headers
								$headers[] = 'To:'.$to;
								$headers[] = 'From: localhost';
								$headers[] = 'Cc: localhost@localhost.com';
								$headers[] = 'Bcc: localhost@localhost.com';

								// Mail it
								mail($to, $subject, $message, implode("\r\n", $headers));





								header("location: index.php");
						} else{
								echo "ERROR SUBMITTING DATA TO DB";
						}
						mysqli_stmt_close($stmt);
				}
			}
		mysqli_close($link);

	
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Make a new request</title>

	<link rel="stylesheet" href="index.css">
</head>


<body>
<a href="index.php">back home</a>
	<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
			<div class="error">
				<?php echo $error; ?>
			</div>
			<br>
				<label>Start</label>
				<input required type="date" name="date_start"  value="<?php echo $date_start; ?>">
			<br>	
				<label>End</label>
				<input required type="date" name="date_end"  value="<?php echo $date_end; ?>">
			<br>
				<label>Reason</label>
			
				<textarea required name="reason" id="reason" cols="30" rows="10">
					<?php echo $reason; ?>
				</textarea>
			<br>

			<br>
			<input type="submit" class="btn btn-primary" value="Submit">
		</form>
</body>
</html>