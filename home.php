<?php

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}else{
    if($_SESSION["user_type"] == 1){
		header("location: admin.php"); 
	}
}
require("db_config.php");

$query ="SELECT submit_date,date_start,date_end, reason,status FROM applications WHERE user_id= ".$_SESSION["id"]." ORDER BY submit_date DESC";  

$result = mysqli_query($link, $query);  

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
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
    <!-- <?php print_r($_SESSION)?> -->
    <h2>User area</h2>
    <h2>Welcome!</h2>
    <a class="warning" href="logout.php" >Log Out</a>
    <a href="new_request.php" >Make a request</a>

    <div class="table-responsive">  
					<table id="application_data" class="table table-striped table-bordered">  
							<thead>  
										<tr>  
												<td>submit_date</td>  
												<td>date_start</td>  
												<td>date_end</td>  
												<td>days requested</td>  
												<td>reason</td>  
												<td>status</td>  
										</tr>  
							</thead>  
							<?php  
							

							while($row = mysqli_fetch_array($result))  
							{  
								$date1 = new DateTime(date("d-m-Y", strtotime($row["date_end"])));
								$date2 = new DateTime(date("d-m-Y", strtotime($row["date_start"])));
								$difference = $date1->diff($date2);


										echo '  
										<tr>  
												<td>'.date("d-m-Y", strtotime($row["submit_date"])).'</td>  
												<td>'.date("d-m-Y", strtotime($row["date_start"])).'</td>  
												<td>'.date("d-m-Y", strtotime($row["date_end"])).'</td>  
												<td>'.$difference->d.'</td>  
												<td>'.$row["reason"].'</td>  
												<td>'.$row["status"].'</td>  
										</tr>  
										';  
							}  
							?>  
					</table>  
		</div>  


		
</body>



<script>  
 $(document).ready(function(){  
      $('#application_data').DataTable();  
 });  
 </script>  


</html>