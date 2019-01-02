<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_GET["id"]) && isset($_GET["name"]) && isset($_GET["status"]) ){
	if( !empty($_GET["id"] && isset($_GET["name"]) && isset($_GET["status"]))){
		require_once('config.php');

			$id=$_GET["id"];
			$name=$_GET["name"];
			$status=$_GET["status"];
			
			$sql="UPDATE  children SET
		          name='$name',
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