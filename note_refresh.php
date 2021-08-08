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
$name=$_SESSION['name'];
$result = $bdd->query("SELECT COUNT(*) as nbr_comments FROM note WHERE pseudo='$name'");
$data = $result->fetch();
$nbr_msg=$data['nbr_comments'];
$result->closeCursor();
echo "Il y a ".$nbr_msg." à traiter pour cette requête.<br><br>";

$id_bdd=1;
$i=1;

while($i <= $nbr_msg)
{
	$req_recup_msg = $bdd->query("SELECT * FROM note WHERE id='$id_bdd' AND pseudo='$name'");
	$data1 = $req_recup_msg->fetch();
	$sort_id = $data1['sort_id'];
	$commentaire=$data1['commentaire'];
	if($commentaire)
	{
		echo "id de bdd: ".$id_bdd;
		echo "<br>ligne traitement requêtes: ".$i;
		echo "<br>Commentaire: ".$commentaire;
		echo "<br><br>";
		$bdd->query("UPDATE note SET sort_id='$i' WHERE id='$id_bdd'");
		$i++;
	}
	$id_bdd++;
}
header('Location: http://192.168.0.50/note.php?page=1');
?>