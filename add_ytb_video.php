<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Add video</title>
	<meta charset="utf-8" />
	<style>
		body{
			background-color: #000011;
		}
	</style>
</head>
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
	$req = $bdd->prepare ('INSERT INTO ytb_videos (url, nom, tag) VALUES (?, ?, ?)');
	$req->execute(array($_POST['url'], $_POST['nom'], $_POST['tag']));
	$tag_page = $_POST['tag_page'];
	?>
	<script>
		document.location.href="http://192.168.0.50/ytb.php?tag=<?php echo $tag_page ; ?>";
	</script> 
	<?php
}
else{
	$ip_addr = $_SERVER['REMOTE_ADDR'];
		$date_var = date("H:i:s d/m/Y");
		$legal = 1;
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
	?>
	<script>
		window.alert("Vous n'êtes pas authentifié !");
		document.location.href="http://192.168.0.50";
	</script>
	<?php
}
?>
