<?php
session_start();
if(isset($_SESSION['name'])){
	$idDelete = $_POST['id'];
	$connect = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
	if (!$connect){
		die("connect failed: " . bdd_connect_error());
	}
	$sql = "DELETE FROM note WHERE id=$idDelete";
	if($connect->query($sql) == TRUE){
		echo "Record deleted successfully";
	}
	else{
		echo "Error deleting record: " . $connect->error;
	}
	?>
	<script>
		document.location.href="http://192.168.0.50/note.php?page=1";
	</script>
	<?php
}
else{
	include("fonctions/ipsend.php");
}
?>