<?php

define('hostname', 'localhost');
define('user', 'root');
define('password', '');
define('db_name', 'bfapp');

$con = mysqli_connect(hostname,user,password,db_name) or die('Unable to Connect');

?>