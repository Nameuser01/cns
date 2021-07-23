<?php
session_start();
if(isset($_SESSION['name'])){
	$idDelete = $_POST['id'];
	$connexion = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
	if (!$connexion){
		die("Connexion failed: " . bdd_connect_error());
	}
	$sql = "DELETE FROM music_playlist WHERE id=$idDelete";
	if($connexion->query($sql) == TRUE){
		echo "Record deleted successfully";
	}
	else{
		echo "Error deleting record: " . $connexion->error;
	}
	?>
	<script>
		document.location.href="http://192.168.0.50/music.php";
	</script>
	<?php
}
else{
	$ip_addr = $_SERVER['REMOTE_ADDR'];
	$date_var = date("H:i:s d/m/Y");
	$legal = 1;
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
	}
	catch (Exeption $e){
		die('Erreur: ' . $e->getMessage());
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