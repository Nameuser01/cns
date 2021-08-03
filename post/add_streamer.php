<!DOCTYPE html>
<html lang='fr'>
	<head>
		<title>Ajout streamer</title>
		<meta charset="utf-8" />

	</head>
</html>
<?php
// $_POST['pseudo'];
// $_POST['streamer'];
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
}
catch(Exeption $e)
{
	die('Erreur : ' . $e->getMessage());
}

$req = $bdd->prepare('INSERT INTO liens_twitch (pseudo, streamer) VALUES (?, ?)');
$req->execute(array($_POST['pseudo'], $_POST['streamer']));
header('Location: http://192.168.0.50/administration.php');
?>