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
	$name=$_SESSION['name'];
	$req_increment_id=$bdd->query("SELECT MAX(sort_id) AS max_id FROM note WHERE pseudo='$name'");
	$increment_id=$req_increment_id->fetch();
	$next_id=$increment_id['max_id'];
	$next_id++;
	$req = $bdd->prepare ("INSERT INTO note (titre, date, pseudo, commentaire, sort_id) VALUES (?, ?, ?, ?, ?)");
	$date_var = date("H:i:s d/m/Y");
	$req->execute(array($_POST['titre'], $date_var, $_SESSION['name'], $_POST['commentaire'], $next_id));

	// Requêtes pour incrémenter le nombre de messages de l'utilisateur
	$r_msg_nbr = $bdd->query("SELECT nbr_messages FROM users WHERE pseudo='$name'");
	$stats = $r_msg_nbr->fetch();
	$nbr_msg = $stats['nbr_messages'];
	$nbr_msg++;

	//Requête pour incrémenter le score
	
	$bdd->query("UPDATE users SET nbr_messages=$nbr_msg WHERE pseudo='$name'");
	header('Location: http://192.168.0.50/note.php?page=1');
}
else{
	include("fonctions/ipsend.php");
}
?>
