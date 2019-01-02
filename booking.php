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

      	$query = "SELECT * FROM booking WHERE cb_id = '$vid' AND status != 'Done'";

		//"SELECT areas.id, areas.sb_id, areas.price FROM areas JOIN vehicles ON reg_num = '$reg_num' WHERE areas.sb_id=vehicles.id ";
		$outp = "";

		$result = mysqli_query($con,$query);

		while( $rs=$result->fetch_array(MYSQLI_ASSOC)) {
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
		$outp ='{"records":['.$outp.']}';
		$con->close();
		echo($outp);
	}
}
?>