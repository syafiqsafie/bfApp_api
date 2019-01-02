<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
	if(isset($_GET["e"]) && isset($_GET["p"]) && isset($_GET["t"])){
		if( !empty($_GET["e"])  && !empty($_GET["p"]) && !empty($_GET["t"]) ){
			
			require_once('config.php');

			$username=$_GET["e"];
			$password=$_GET["p"];
			$t=$_GET["t"];
			// To protect MySQL injection for Security purpose
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = $con->real_escape_string($username);
			$password = $con->real_escape_string($password);
			$password = md5($password);
			$query2 = "UPDATE  users SET token = '$t' WHERE email = '$username'";
			$result2 = mysqli_query($con,$query2);
			//$result2 = $con->query($query2);

			$query="SELECT id, username, roles_id FROM users where email = '$username' AND passmd5 ='$password' AND status = 'active' ";
			$result = mysqli_query($con,$query);
			
			$outp = "";
			while( $rs=$result->fetch_array(MYSQLI_ASSOC)) {
			if ($outp != "") {$outp .= ",";}
			$outp .= '{"id":"'  . $rs["id"] . '",';
			$outp .= '"roles_id":"'   . $rs["roles_id"]        . '",';
			$outp .= '"username":"'. $rs["username"]     . '"}';
			}
			$outp ='{"records":'.$outp.'}';
			$con->close();
			echo($outp);
		}
	}
?>