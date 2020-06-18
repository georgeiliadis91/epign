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


$query ="SELECT id,first_name,last_name, email,user_type FROM users ORDER BY ID DESC";  
$result = mysqli_query($link, $query);  


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>

	<!-- DATA TABLE IMPORTS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
	<link rel="stylesheet" href="index.css">
</head>
<body>
<div >
      <h2>Admin area</h2>
        <a  class="warning" href="logout.php" >Log Out</a>
				<br>

				<a href="register.php" >Register New User</a>
				<br>


				<div class="table-responsive">  
					<table id="user_data" class="table table-striped table-bordered">  
							<thead>  
										<tr>  
												<td>id</td>  
												<td>first_name</td>  
												<td>last_name</td>  
												<td>email</td>  
												<td>user_type</td>  
												<td>edit</td>  
										</tr>  
							</thead>  
							<?php  
							while($row = mysqli_fetch_array($result))  
							{  
										echo '  
										<tr>  
												<td>'.$row["id"].'</td>  
												<td>'.$row["first_name"].'</td>  
												<td>'.$row["last_name"].'</td>  
												<td>'.$row["email"].'</td>  
												<td>'.($row["user_type"]? admin:employee).'</td>  
												<td> 	<a href="http://localhost/epignosis/update_user.php?first_name='.$row["first_name"] .'&last_name='.$row["last_name"] .'&email='.$row["email"] .'&user_type='.$row["user_type"] .'&id='.$row["id"] .'"> EDIT USER </a> </td>  
										</tr>  
										';  
							}  
							?>  
					</table>  
		</div>  

	
</body>

<script>  
 $(document).ready(function(){  
      $('#user_data').DataTable();  
 });  
 </script>  


</html>