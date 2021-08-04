<?php
session_start();
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
}
catch(Exeption $e)
{
	die('Erreur : ' . $e->getMessage());
}

// vars
$id = $_POST['id_del'];

// del streamer

	$bdd->query("DELETE FROM liens_twitch WHERE id='$id'");

	//Décrémentation et update du score.
	$name=$_SESSION['name'];
	$score=$_SESSION['score'];
	$new_score=$score - 0.1;
	$bdd->query("UPDATE users SET score='$new_score' WHERE pseudo='$name'");
	$_SESSION['score'] = $new_score;

header('Location: http://192.168.0.50/administration.php');
?>