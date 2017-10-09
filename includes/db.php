<?php
define("DBNAME" , "blog");
define("DBUSER","root");
define("DBHOST", "localhost" );
define("DBPASS", "");

try{
	$conn = new PDO('mysql:host='.DBHOST.';
		      dbname='.DBNAME,DBUSER,DBPASS);
}catch(PDOException $e){
	echo $e-> getMessage();
}


?>