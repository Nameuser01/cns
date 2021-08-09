<?php
session_start();
try
{
	$bdd=new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
}
catch(Exeption $e)
{
	die('Erreur: ' . $e->getMessage());
}
$name=$_SESSION['name'];
$req_auth=$bdd->query("SELECT identifiant FROM users WHERE pseudo='$name'");
$auth=$req_auth->fetch();
if(isset($_SESSION['identifiant']) AND $_SESSION['identifiant'] == $auth['identifiant'])
{
	// Suppression du commentaire
	$idDelete = $_POST['id'];
	$bdd->query("DELETE FROM note WHERE id='$idDelete'");
	
	// Décrémentation du score et du nombre de messages de l'utilisateur
	$score=$_SESSION['score'];
	$score = $score - 0.1;
	$_SESSION['score'] = $score;

	$req_update_msg_nbr=$bdd->query("SELECT nbr_messages FROM users WHERE pseudo='$name'");
	$data_msg_nbr=$req_update_msg_nbr->fetch();
	$msg_new_number=$data_msg_nbr['nbr_messages'];
	$msg_new_number=$msg_new_number-1;
	echo "msg_new_number: ".$msg_new_number;
	$bdd->query("UPDATE users SET score=$score WHERE pseudo='$name'");
	$bdd->query("UPDATE users SET nbr_messages=$msg_new_number WHERE pseudo='$name'");

	// REORGANISATION DE LA BASE DE DONNÉES
	// 1 - Récupération du nombre de commentaires à traiter{
	$result = $bdd->query("SELECT COUNT(*) as nbr_comments FROM note WHERE pseudo='$name'");
	$data = $result->fetch();
	$nbr_msg=$data['nbr_comments'];
	$result->closeCursor();

	// 2 - Algorithme
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
}
else
{
	include("fonctions/ipsend.php");
}
header('Location: http://192.168.0.50/note.php?page=1');
?>