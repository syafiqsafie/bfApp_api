<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_GET["id"]) && isset($_GET["status"]) ){
	if( !empty($_GET["id"] && isset($_GET["status"]))){
		require_once('config.php');

			$id=$_GET["id"];
			$status=$_GET["status"];
			
			$sql="UPDATE  booking SET
		          status='$status'
		          where id='$id'
		    ";

			$res=mysqli_query($con,$sql);
		    if($res){
		      echo "{\"update\":\"success\"}";
		    }else{
		      echo "{\"update\":\"failed\"}";;
		    }
		}
	}
?>