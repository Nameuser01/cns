<?php
session_start();
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
}
catch (Exeption $e)
{
	die('Erreur : ' . $e->getMessage());
}

$name = $_SESSION['name'];
$req_auth = $bdd->query("SELECT identifiant FROM users WHERE pseudo='$name'");
$auth=$req_auth->fetch();

if(isset($_SESSION['identifiant']) AND $_SESSION['identifiant'] == $auth['identifiant'])
{	
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
	$bdd->query("UPDATE users SET nbr_messages=$nbr_msg WHERE pseudo='$name'");

	//Requête pour incrémenter le score de l'utilisateur
	$score=$_SESSION['score'];
	$score = $score + 0.1;
	echo "score: ".$score;
	$_SESSION['score'] = $score;
	$bdd->query("UPDATE users SET score=$score WHERE pseudo='$name'");

	header('Location: http://192.168.0.50/note.php?page=1');
}
else{
	include("fonctions/ipsend.php");
}
?>
