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
		$req = $bdd->prepare ('INSERT INTO note (titre, date, auteur, commentaire) VALUES (?, ?, ?, ?)');
		$date_var = date("H:i:s d/m/Y");
		$req->execute(array($_POST['titre'], $date_var, $_SESSION["name"], $_POST['commentaire']));
		header('Location: http://192.168.0.50/note.php?page=1');
}
else{
	include("fonctions/ipsend.php");
}
?>
