<?php
	session_start();
	$_SESSION["cliente"]=$_POST["inputCliente"];
	header("Location: index.php");
	 $_SESSION["path"]="/"."CLT_".$_SESSION["cliente"];
	 $_SESSION["clave"]=$_POST["inputPassword"];
	 $_SESSION["page_back"]="login.php";
	die();
?>