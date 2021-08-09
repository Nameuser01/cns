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

// Ajout du nouveau streamer
$name = $_SESSION['name'];
$req_auth=$bdd->query("SELECT identifiant FROM users WHERE pseudo='$name'");
$auth=$req_auth->fetch();

if(isset($_SESSION['identifiant']) && $_SESSION['identifiant'] == $auth['identifiant'])
{
	$req = $bdd->prepare('INSERT INTO liens_twitch (pseudo, streamer, groupe) VALUES (?, ?, ?)');
	$req->execute(array($_POST['pseudo'], $_POST['streamer'], $_POST['groupe']));

	//Incrémentation et update du score.
	$name=$_SESSION['name'];
	$score=$_SESSION['score'];
	$score=$score + 1;
	$bdd->query("UPDATE users SET score=$score WHERE pseudo='$name'");
	$_SESSION['score'] = $score;
}
else
{
	//do nothing
}

header('Location: http://192.168.0.50/administration.php');
?>