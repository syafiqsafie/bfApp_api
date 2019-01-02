<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
	
	//Importing database
	require_once('config.php');
	
	//Creating sql query with where clause to get an specific employee
	$sql = "SELECT id, name, status FROM children ";
	
	//getting result 
	$result = mysqli_query($con,$sql);
	
	//pushing result to an array 
	$outp = "";
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	    if ($outp != "") {$outp .= ",";}
	    $outp .= '{"id":"'  . $rs["id"] . '",';
	    $outp .= '"name":"'   . $rs["name"]        . '",';
	    $outp .= '"status":"'. $rs["status"]     . '"}';
	}
	$outp ='{"records":['.$outp.']}';
	$con->close();

	echo($outp);
?>