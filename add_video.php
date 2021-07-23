<?php
session_start();
if(isset($_SESSION['name'])){
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
}
catch (Exeption $e)
{
	die('Erreur : ' . $e->getMessage());
}
	$req = $bdd->prepare ('INSERT INTO music_playlist (nom_video, lien_video) VALUES (?, ?)');
	$req->execute(array($_POST['name_video'], $_POST['url_video']));
	header('Location: http://192.168.0.50/music.php');
}
else{
	include("fonctions/ipsend.php");
}
?>
