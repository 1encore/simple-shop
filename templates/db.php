<?php
	$connection=new mysqli("localhost", "root", "", "store");
	if($connection->connect_error){
		echo "Error with db connection.";
	}
?>