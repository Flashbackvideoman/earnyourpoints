<?php
include "loyalty_globals.inc";

	if (!$con) {  die('Could not connect: ' . mysql_error()); return; }
	
	$sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'loyaltydb'";
	$result = mysql_query($sql,$con);
	if (!mysql_fetch_array( $result )) {
		if (mysql_query("CREATE DATABASE " . $db ,$con))
			$dbcreated = true;
		else
			$dbcreated = false;
		}
	
	// Select our database
	mysql_select_db($db, $con);

	if( !table_exists('users') ) {
	
	// Create table			
		$sql = "CREATE TABLE IF NOT EXISTS `users` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `firstname` text NOT NULL,
          `lastname` text NOT NULL,
          `email` text NOT NULL,
          `phone` text NOT NULL,
          `points` int(10) unsigned DEFAULT NULL,
           PRIMARY KEY (`phone`)
           )";
		mysql_query($sql,$con);
	}

function table_exists($table) {
	global $con;
	$q = "show tables like '$table'";
	$result = mysqli_query( $con, $q);	
	return (mysqli_num_rows($result) > 0) ? true : false;
}
?>
