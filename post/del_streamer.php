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

$name = $_SESSION['name'];
$req_auth = $bdd->query("SELECT identifiant FROM users WHERE pseudo='$name'");
$auth = $req_auth->fetch();

if(isset($_SESSION['identifiant']) && $_SESSION['identifiant'] == $auth['identifiant'])
{
	// del streamer
	$bdd->query("DELETE FROM liens_twitch WHERE id='$id'");

	//Décrémentation et update du score.
	$name=$_SESSION['name'];
	$score=$_SESSION['score'];
	$new_score=$score - 0.1;
	$bdd->query("UPDATE users SET score='$new_score' WHERE pseudo='$name'");
	$_SESSION['score'] = $new_score;
	?>
	<script>
		window.alert("Le streamer a bien été retiré des abonnements.");
	</script>
	<?php
}
else
{
	?>
	<script>
		window.alert("Erreur: Le streamer n'a pas été ajouté !");
	</script>
	<?php
}
header('Location: http://192.168.0.50/administration.php');
?>