<?php
session_start();
if(isset($_SESSION['name'])){
	$idDelete = $_POST['id'];
	$tagReturn = $_POST['tag'];
	$connexion = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
	if (!$connexion){
		die("Connexion failed: " . bdd_connect_error());
	}
	$sql = "DELETE FROM ytb_videos WHERE id=$idDelete";
	if($connexion->query($sql) == TRUE){
		echo "Record deleted successfully";
	}
	else{
		echo "Error deleting record: " . $connexion->error;
	}
	?>
	<script>
		document.location.href="http://192.168.0.50/ytb.php?tag=<?php echo $tagReturn ; ?>";
	</script>
	<?php
}
else{
	include("fonctions/ipsend.php");
}
	?>