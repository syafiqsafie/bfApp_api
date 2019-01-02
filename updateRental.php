<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
	//Getting the requested id
	$id = $_GET['id'];
	
	//Importing database
	require_once('config.php');
	
	//Creating sql query with where clause to get an specific employee
	$sql = "SELECT * FROM booking WHERE id=$id";
	
	//getting result 
	$result = mysqli_query($con,$sql);
	
	$outp = "";
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	    if ($outp != "") {$outp .= ",";}
	    $outp .= '{"id":"'  . $rs["id"] . '",';
	    $outp .= '"date_start":"'  . $rs["date_start"] . '",';
		$outp .= '"date_end":"'  . $rs["date_end"] . '",';
		$outp .= '"time":"'  . $rs["time"] . '",';
		$outp .= '"addrfrom":"'  . $rs["addrfrom"] . '",';
		$outp .= '"addrto":"'  . $rs["addrto"] . '",';
		$outp .= '"distance":"'  . $rs["distance"] . '",';
	    $outp .= '"status":"'. $rs["status"]     . '"}';
	}
	$outp ='{"records":'.$outp.'}';
	$con->close();

	echo($outp);
?>