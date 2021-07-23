<?php
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
	}
	catch(Exeption $e){
		die('Erreur : ' . $e->getMessage());
	}
	// $req_com = $bdd->query('SELECT COUNT(*) AS nbr_coms from note_bis');
	// $data = $req_com->fetch();
	// $nbr_coms = htmlspecialchars($data['nbr_coms']);

	// $req = $bdd->query('SELECT secondaryID FROM note_bis');

	
	// $row = $req->fetch();
	// 	for ($new_id = 1; $new_id < 7; $new_id++)
	// 	{
	// 		$donnees->execute(array($new_id, $row['secondaryID']));
	// }
	// $new_id = 0;
	// for ($new_id = 1; $new_id < 7; $new_id++){
	// 	$row = $req->fetch();
	// 	$donnees = $bdd->prepare("UPDATE note_bis SET secondaryID = $new_id");
	// 	$donnees->execute(array($new_id, $row['secondaryID']));
	// 	// $new_id++;
	// }

	// $req = $bdd->query('SELECT secondaryID FROM note_bis');
	// $new_id = 0;
	// while($data = $req->fetch())
	// {
	// 	$req_com = $bdd->prepare("UPDATE note_bis SET secondaryID = 2");
	// 	$donnes->execute(array($new_id, $data['secondaryID']));
	// 	echo $new_id;
	// 	$new_id++;
	// }
	$req = $bdd->query('SELECT id, secondaryID FROM note_bis');
	while($data = $req->fetch())
	{
		echo "Pour id: ";
		echo $data['id'];
		echo "<br>on a secondaryID: ";
		echo $data['secondaryID']."<br><br>";
	}
	$req = $bdd->query('SELECT id, secondaryID FROM note_bis');
	$new_id=0;
	$old_id=0;
	while($data = $req->fetch())
	{
		$bdd->exec('UPDATE note_bis SET secondaryID = $new_id');
		$new_id++;
	}

	$req =$bdd->query('SELECT id, secondaryID FROM note_bis');
	echo "<br><br>Résultat des courses<br><br>";
	while($data = $req->fetch())
	{
		echo "Pour id: ";
		echo $data['id'];
		echo "<br>on a secondaryID: ";
		echo $data['secondaryID']."<br><br>";
	}
?>