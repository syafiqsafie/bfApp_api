<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
if(isset($_GET["e"])){
    if( !empty($_GET["e"])){
require_once('config.php');
		
		$reg_num=$_GET["e"];
		
		$query2="SELECT id FROM vehicles WHERE reg_num = '$reg_num'";

		$result2 = mysqli_query($con,$query2);

      	if($rs1=$result2->fetch_array(MYSQLI_ASSOC)) {
        $vid=$rs1['id'];

      	}

      	$query3="SELECT id FROM areas WHERE sb_id = '$vid'";

		$result3 = mysqli_query($con,$query3);

      	if($rs2=$result3->fetch_array(MYSQLI_ASSOC)) {
        $areaid=$rs2['id'];

      	}

      	$query = "SELECT id, name, status FROM children WHERE area_id = '$areaid' AND paystatus = 'Complete'";

		//"SELECT areas.id, areas.sb_id, areas.price FROM areas JOIN vehicles ON reg_num = '$reg_num' WHERE areas.sb_id=vehicles.id ";
		$outp = "";

		$result = mysqli_query($con,$query);

		while( $rs=$result->fetch_array(MYSQLI_ASSOC)) {
			if ($outp != "") {$outp .= ",";}
			$outp .= '{"id":"'  . $rs["id"] . '",';
			$outp .= '"name":"'  . $rs["name"] . '",';
			$outp .= '"status":"'. $rs["status"]     . '"}';
		}
		$outp ='{"records":['.$outp.']}';
		$con->close();
		echo($outp);
	}
}
?>