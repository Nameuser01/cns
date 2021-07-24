<?php
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
	}
	catch(Exeption $e){
		die('Erreur : ' . $e->getMessage());
	}
	$req = $bdd->query('SELECT pseudo, email FROM users WHERE id = 2');
	$data = $req->fetch();
?>
<div class="menu_left">
	<div>
		<p>Développeur : <?php echo $data['pseudo'] ; ?></p>
		<p>Début des travaux: 01/28/21</p>
	</div>
</div>
<div class="menu_right"> 
	<div>
		<p><?php echo "Email: " . $data['email'] ; ?></p>
	</div>
</div>