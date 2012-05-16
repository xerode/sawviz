<?php

include_once "settings.php";

$mysql = mysql_connect( $mysql_address, $mysql_username, $mysql_password );

if( ! $mysql ) {
	die( "Could not connect to MySQL database: ".mysql_error() );
} else {
	$mysqldb = mysql_select_db( $mysql_database );

	if( ! $mysqldb ) {
	    die ('Can\'t use '.$mysql_database.' : ' . mysql_error());
	}
}

?>