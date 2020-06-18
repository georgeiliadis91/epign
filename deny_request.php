<?php


require("db_config.php");


require("db_config.php");

	$user_id = trim($_GET["user_id"]);
	$app_id = trim($_GET["app_id"]);
	$denied='"denied"';

	$query ="UPDATE applications SET status = ".$denied." WHERE user_id= ".$user_id;  
	
	$result = mysqli_query($link, $query);  
	
	
	
	$query ="SELECT email FROM users WHERE id= ".$user_id; 
		
	$result = mysqli_query($link, $query);  

	$row = mysqli_fetch_array($result);

	mysqli_close($link);


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
	<p>Request Denied</p>
</body>
</html>