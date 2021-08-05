<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Adding video</title>
	<meta charset="utf-8" />
	<style>
		body{
			background-color: #001;
		}
	</style>
</head>
<?php
session_start();
if(isset($_SESSION['name']))
{
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
	}
	catch (Exeption $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	$req = $bdd->prepare ('INSERT INTO ytb_videos (url, nom, tag) VALUES (?, ?, ?)');
	$req->execute(array($_POST['url'], $_POST['nom'], $_POST['tag']));
	$tag_page = $_POST['tag_page'];
?>
<script>
	document.location.href="http://192.168.0.50/ytb.php?tag=<?php echo $tag_page ; ?>";
</script> 
<?php
}
else
{
	include("fonctions/ipsend.php");
}
?>