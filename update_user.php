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

//Get temp data to put on form
$temp_first_name = trim($_GET["first_name"]);
$temp_last_name = trim($_GET["last_name"]);
$temp_email = trim($_GET["email"]);
$temp_user_type = trim($_GET["user_type"]);
$temp_id = trim($_GET["id"]);

 $password_err = $confirm_password_err = "";



 $user_type=0;
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$first_name=trim($_POST["first_name"]);
	$last_name=trim($_POST["last_name"]);
	$user_type=trim($_POST["user_type"]);
	$email=trim($_POST["email"]);
	$id=trim($_POST["id"]);






	if(strlen(trim($_POST["password"])) < 6){
			$password_err = "Password must have atleast 6 characters.";
	} else{
			$password = trim($_POST["password"]);
	}
	
	$confirm_password = trim($_POST["confirm_password"]);

	if(empty($password_err) && ($password != $confirm_password)){
			$confirm_password_err = "Password did not match.";
	}
	
	if( empty($password_err) && empty($confirm_password_err)){

		$pass_hash=password_hash($password, PASSWORD_DEFAULT);
		$sql = "UPDATE users SET first_name='".$first_name."', last_name='".$last_name."',email='".$email."',password='".$pass_hash."',user_type='".$user_type."' WHERE id=".$id;

	
		$result = mysqli_query($link, $sql);


		header("location: index.php");

		// if($stmt = mysqli_prepare($link, $sql)){
			
		// 			mysqli_stmt_bind_param($stmt, "ssssss", $param_first_name,$param_last_name,$param_email, $param_password,$param_user_type,$param_id);
					
		// 			$param_first_name=$first_name;
		// 			$param_last_name=$last_name;
		// 			$param_email = $email;
		// 			$param_password = password_hash($password, PASSWORD_DEFAULT);
		// 			$param_user_type=$user_type;
		// 			$param_id=$temp_id;

		// 			echo $stmt->result;
		// 			die();

			
					
					// if(mysqli_stmt_execute($stmt)){
			
				
					// 		header("location: index.php");
					// } else{
					// 		echo "Something went wrong. Please try again later.";
					// }
					// mysqli_stmt_close($stmt);
			// }
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
	<input type="hidden" name="id" value="<?php echo $temp_id; ?>">
			<div class="error">
				<?php echo $email_err; ?>
				<?php echo $password_err; ?>
				<?php echo $confirm_password_err; ?>
			</div>
			<br>
				<label>First Name</label>
				<input required type="text" name="first_name"  value="<?php echo $temp_first_name; ?>">
			<br>
				<label>Last Name</label>
				<input required type="text" name="last_name"  value="<?php echo $temp_last_name; ?>">
			<br>
				<label>Email</label>
				<input required type="email" name="email"  value="<?php echo $temp_email; ?>">
			<br>
			<label>Password</label>
			<input required type="password" name="password"  value="<?php echo $password; ?>">
			<br>
				<label>Confirm Password</label>
				<input required type="password" name="confirm_password"  value="<?php echo $confirm_password; ?>">
			<br>
			<select id="user_type" name="user_type" >
				<option value="1" <?php echo ( $temp_user_type==1 ? 'selected=selected' : '') ?>>Admin</option>
				<option value="0" <?php echo ( $temp_user_type==0 ? 'selected=selected' : '') ?>>Employee</option>

			</select>
			<br>
			<input type="submit" class="btn btn-primary" value="Submit">
		</form>


</body>
</html>