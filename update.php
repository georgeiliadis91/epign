<?php 

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: index.php");
		exit;
}else{
	if($_SESSION["user_type"] !== 1){
		header("location: home.php"); 
	}
}

require("db_config.php");

$first_name=$last_name=$email = $password = $confirm_password = "";
$user_type=0;
$email_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
				$first_name=trim($_POST["first_name"]);
				$last_name=trim($_POST["last_name"]);
				$user_type=trim($_POST["user_type"]);
 

				$sql = "SELECT id FROM users WHERE email = ?";
				
				if($stmt = mysqli_prepare($link, $sql)){
					
						mysqli_stmt_bind_param($stmt, "s", $param_email);

						$param_email = trim($_POST["email"]);

						if(mysqli_stmt_execute($stmt)){
							
								mysqli_stmt_store_result($stmt);
								//IF RESULT EXIST EMAIL TAKEN
								if(mysqli_stmt_num_rows($stmt) == 1){
										$email_err = "This email is already taken.";
								} else{
										$email = trim($_POST["email"]);
								}
						} else{
								echo "ERROR";
						}

						mysqli_stmt_close($stmt);
				}
		
		if(strlen(trim($_POST["password"])) < 6){
				$password_err = "Password must have atleast 6 characters.";
		} else{
				$password = trim($_POST["password"]);
		}
		
		//VERIFY PASSWORD
		$confirm_password = trim($_POST["confirm_password"]);
		if(empty($password_err) && ($password != $confirm_password)){
				$confirm_password_err = "Password did not match.";
		}
		
		
		
		if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){
				
				$sql = "INSERT INTO users (first_name,last_name, email, password, user_type) VALUES (?, ?, ?, ?, ?)";
				 
				if($stmt = mysqli_prepare($link, $sql)){
						mysqli_stmt_bind_param($stmt, "sssss", $param_first_name,$param_last_name,$param_email, $param_password,$param_user_type);
						
						// Set parameters
						$param_first_name=$first_name;
						$param_last_name=$last_name;
						$param_user_type=$user_type;
						$param_email = $email;
						$param_password = password_hash($password, PASSWORD_DEFAULT);
						
						if(mysqli_stmt_execute($stmt)){
								header("location: index.php");
						} else{
								echo "Something went wrong. Please try again later.";
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
	<title>Update User</title>
	<link rel="stylesheet" href="index.css">
</head>
<body>
<a href="index.php">back home</a>
	<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
			<div class="error">
			<?php echo $email_err; ?>
			<?php echo $password_err; ?>
			<?php echo $confirm_password_err; ?>
			<br>
			
			</div>
				<label>First Name</label>
				<input required type="text" name="first_name"  value="<?php echo $first_name; ?>">
			<br>
				<label>Last Name</label>
				<input required type="text" name="last_name"  value="<?php echo $last_name; ?>">
			<br>
				<label>Email</label>
				<input required type="email" name="email"  value="<?php echo $email; ?>">
			<br>
			<label>Password</label>
			<input required type="password" name="password"  value="<?php echo $password; ?>">
			<br>
				<label>Confirm Password</label>
				<input required type="password" name="confirm_password"  value="<?php echo $confirm_password; ?>">
			<br>
			<select id="user_type" name="user_type">
				<option value="1">Admin</option>
				<option value="0">Employee</option>

			</select>
			<br>
			<input type="submit" class="btn btn-primary" value="Submit">
		</form>
</body>
</html>