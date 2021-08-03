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
	$req = $bdd->prepare ('INSERT INTO note (titre, date, pseudo, commentaire) VALUES (?, ?, ?, ?)');
	$date_var = date("H:i:s d/m/Y");
	$req->execute(array($_POST['titre'], $date_var, $_SESSION['name'], $_POST['commentaire']));
	// Requêtes pour incrémenter le nombre de messages de l'utilisateur
	$r_msg_nbr = $bdd->query('SELECT nbr_messages FROM users WHERE pseudo="'.$_SESSION['name'].'"');
	$stats = $r_msg_nbr->fetch();
	//Incrémentation du compte de messages
	$nbr_msg = $stats['nbr_messages'];
	$nbr_msg++;
	//Envoie de la requête
	$user_name = $_SESSION['name'];
	$bdd->query("UPDATE users SET nbr_messages=$nbr_msg WHERE pseudo='$user_name'");
	header('Location: http://192.168.0.50/note.php?page=1');
}
else{
	include("fonctions/ipsend.php");
}
?>
