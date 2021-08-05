<?php
// try{
// 	$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
// }
// catch(Exeption $e){
// 	die('Erreur : ' . $e->getMessage());
// }
$req_id_dev = $bdd->query('SELECT pseudo, email FROM users WHERE id = 2');
$data = $req_id_dev->fetch();
$req_auth=$bdd->query("SELECT identifiant FROM users WHERE pseudo='$name'");
$auth=$req_auth->fetch();
if(isset($_SESSION['identifiant']) && $_SESSION['identifiant'] == $auth['identifiant'])
{
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
	<?php
}
else
{
	echo "Vous n'êtes pas identifié Veuillez dégager de ce site. Unge !!!";
}
?>