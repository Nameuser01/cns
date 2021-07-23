<?php
session_start();
$ip_addr = $_SERVER['REMOTE_ADDR'];
$date_var = date("H:i:s d/m/Y");
$legal = 0;
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
}
catch (Exeption $e)
{
	die('Erreur : ' . $e->getMessage());
}
	$req = $bdd->prepare ('INSERT INTO logs (D4TE, IP_ADDR, legal) VALUES (?, ?, ?)');
	$req->execute(array($date_var, $ip_addr, $legal));
	header('Location: http://192.168.0.50/home.php');
?>
