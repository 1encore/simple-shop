<?php
	$connection=new mysqli("localhost", "root", "", "shop");
	if($connection->connect_error){
		echo "Error with db connection.";
	}
?>
