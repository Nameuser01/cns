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
$name = $_SESSION['name'];
$req_auth = $bdd->query("SELECT identifiant FROM users WHERE pseudo='$name'");
$auth=$req_auth->fetch();
if(isset($_SESSION['identifiant']) AND $_SESSION['identifiant'] == $auth['identifiant'])
{
	$idDelete = $_POST['id'];
	$tagReturn = $_POST['tag'];
	//requête de suppression de vidéo
	$sql=$bdd->query("DELETE FROM ytb_videos WHERE id='$idDelete'");
	?>
	<script>
		document.location.href="http://192.168.0.50/ytb.php?tag=<?php echo $tagReturn ; ?>";
	</script>
	<?php
}
else
{
	include("fonctions/ipsend.php");
}
?>