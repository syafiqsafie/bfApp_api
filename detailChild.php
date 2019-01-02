<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
	//Getting the requested id
	$id = $_GET['id'];
	
	//Importing database
	require_once('config.php');
	
	//Creating sql query with where clause to get an specific employee
	$sql = "SELECT * FROM children WHERE id=$id";
	
	//getting result 
	$result = mysqli_query($con,$sql);
	
	$outp = "";
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	    if ($outp != "") {$outp .= ",";}
	    $outp .= '{"id":"'  . $rs["id"] . '",';
	    $outp .= '"name":"'   . $rs["name"]        . '",';
	    $outp .= '"addrpick":"'   . $rs["addrpick"]        . '",';
	    $outp .= '"citypick":"'   . $rs["citypick"]        . '",';
	    $outp .= '"postcodepick":"'   . $rs["postcodepick"]        . '",';
	    $outp .= '"statepick":"'   . $rs["statepick"]        . '",';
	    $outp .= '"addrsend":"'   . $rs["addrsend"]        . '",';
	    $outp .= '"citysend":"'   . $rs["citysend"]        . '",';
	    $outp .= '"postcodesend":"'   . $rs["postcodesend"]        . '",';
	    $outp .= '"statesend":"'   . $rs["statesend"]        . '",';
	    $outp .= '"status":"'. $rs["status"]     . '"}';
	}
	$outp ='{"records":['.$outp.']}';
	$con->close();

	echo($outp);
?>