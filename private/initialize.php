<?php
/**
 * Created by PhpStorm.
 * User: andriusbutkys
 * Date: 20/09/2018
 * Time: 13:52
 */

	define("PRIVATE_PATH", dirname(__FILE__));
	define("PROJECT_PATH", dirname(PRIVATE_PATH));
	define("PUBLIC_PATH", PROJECT_PATH . '/public');
	define("SHARED_PATH", PRIVATE_PATH . '/shared');
	$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
	$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end );
	define("WWW_ROOT", $doc_root);

	require('functions.php');
	require('database.php');
	require('db_queries.php');
	require('validation_functions.php');
	
	$db = db_connect();
	$errors = [];