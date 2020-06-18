<?php 

session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}

require("db_config.php");


$email = $password = $user_type="";
$email_err = $password_err = "";
//  check req
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
   //get data
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    //PASS CHECK
    if(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
            $password = trim($_POST["password"]);
    }
  
    
   //validate no errors
    if(empty($passwword_err)){
        
        $sql = "SELECT id, first_name, last_name, email, password, user_type FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_email);
 
            $param_email = $email;
            //ATtempt exec

            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
               //check rows
                if(mysqli_stmt_num_rows($stmt) == 1){    

                    
                    mysqli_stmt_bind_result($stmt, $id, $first_name,$last_name, $email, $hashed_password,$user_type);
										
                    if(mysqli_stmt_fetch($stmt)){

                        if(password_verify($password, $hashed_password)){
                            //ADd session data
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["first_name"] = $first_name;
                            $_SESSION["last_name"] = $last_name;
                            $_SESSION["email"] = $email;                            
                            $_SESSION["user_type"] = $user_type;                            
                            
                            header("location: home.php");
                        } else{
                            $password_err = "INVALID PASSWORD";
                        }
                    }
                } else{
                    $email_err = "EMAIL DOES NOT EXIST";
                }
            } else{
                echo "ERROR CONNECTING TO DB";
            }

            mysqli_stmt_close($stmt);
        }
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Epignosis</title>

	<link rel="stylesheet" href="index.css">
</head>
<body>	
				<h2>Login</h2>
					<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
						<div class="errors">
							<?php echo $username_err; ?>
							<?php echo $password_err; ?>
						</div>
						<br>
							<label>Email</label>
							<input required type="email" name="email"  value="<?php echo $email; ?>">
             <br>
                <label>Password</label>
                <input required type="password" name="password" class="form-control">
						<br>
							<input type="submit"value="LOGIN">
        </form>
</body>
</html>