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
$new_value=10;
$new_id=0;

$result = $bdd->query("SELECT COUNT(*) as nbr_comments FROM note_bis");
$data = $result->fetch();
$nbr_msg=$data['nbr_comments'];
echo "Il y a ".$nbr_msg." à traiter pour cette requête.<br><br>";

$i=1;
$i_req=1;
$i_separator=0;

while($i <= $nbr_msg)
{
	if($i_separator == 0)
	{
		echo "---<br>";
		$i_separator = 2;
	}
	$req_recup_msg = $bdd->query("SELECT * FROM note_bis WHERE id='$i_req'");
	$data1 = $req_recup_msg->fetch();
	$msg = $data1['secondaryID'];
	if($msg)
	{
		echo "Rang: ".$i." -> msg: ".$data1['commentaire']."<br>";
		$bdd->query("UPDATE note_bis SET secondaryID='$i' WHERE id='$i_req'");
		$i_separator--;
	}
	else
	{
		$i--;
	}
	$i_req++;
	$i++;
}

echo '<a href="http://192.168.0.50/note.php?page=1" > Redirection </a>';
?>