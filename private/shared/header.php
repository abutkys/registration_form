<?php
/**
 * Created by PhpStorm.
 * User: andriusbutkys
 * Date: 20/09/2018
 * Time: 13:51
 */
	if(!isset($page_title))
	{
		echo $page_title = "Registration form";
	}
	
?>
<!doctype html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport" content = "width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv = "X-UA-Compatible" content = "ie=edge">
	<link rel = "stylesheet" href = "../styles.css">
	<title><?php echo $page_title; ?></title>
</head>
<body>

<header>
	<h1>Console</h1>
</header>
