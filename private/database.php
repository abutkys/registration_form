<?php
/**
 * Created by PhpStorm.
 * User: andriusbutkys
 * Date: 20/09/2018
 * Time: 14:36
 */

require('db_credentials.php');

function db_connect()
{
	$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	confirm_db_connect($connection);
	return $connection;
}

function db_disconnect($connection) {
	if(isset($connection)) {
		mysqli_close($connection);
	}
}

function confirm_db_connect() {
	if (mysqli_connect_errno()) {
		$msg = "Database connection failure : ";
		$msg .= mysqli_connect_error();
		$msg .= "( ". mysqli_connect_errno() ." )";
		exit($msg);
	}
}

function confirm_result($result) {
	if (!$result) {
		exit("Database query failed");
	}
}

function db_escape($connection, $string) {
	return mysqli_real_escape_string($connection, $string);
}