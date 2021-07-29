<?php
session_start();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<title style="color: red">Admin - C'nS</title>
	<link rel="stylesheet" href="http://192.168.0.50/css/header.css" />
	<link rel="stylesheet" href="http://192.168.0.50/css/body.css" />
	<link rel="stylesheet" href="http://192.168.0.50/css/menu.css" />
	<link rel="stylesheet" href="http://192.168.0.50/css/footer.css" />
	<!-- <meta http-equiv="refresh" content="5"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="icon" href="img/lapin.ico">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="fichier_test.js" type="text/javascript"></script>
	<meta charset="utf-8" />
</head>
<body>
<?php
if(isset($_SESSION['name'])){
?>
	<header>
		<div class="top_infos">
			<div><h1>Code'nShill - Administration</h1></div>
			<div class="user_infos">
				<div><?php echo $_SESSION["name"];?></div>
				<div><a href="session_destroy.php">Logout</a></div>
			</div>
		</div>
		<?php
			include("fonctions/menu.php");
		?>
	</header>
	<nav>
		<div class="contleft">
			<h4>Gestion:</h4>
			<h5>Ajouter un Tag youtube:</h5>
			<form method="post" action="http://192.168.0.50/add_tag.php">
				<label for="tag">Tag:</label><br />
				<input type="text" name="tag" id="tag"><br />
				<input type="submit" value="Envoyer">
			</form>
		</div>
		<div class="contcenter">
			<h4>Controls pannels:</h4>
			<p>Add twitch channel to BDD</p>
			<p>Add twitch clips to BDD</p>
		</div>
		<div class="contright">
			<h4>Logs:</h4>
			<?php
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
			}
			catch(Exeption $e)
			{
				die('Erreur : ' . $e->getMessage());
			}
			$reponse = $bdd->query('SELECT * FROM logs ORDER BY ID DESC LIMIT 0, 10');
			while ($donnees = $reponse->fetch())
			{
				if ($donnees['legal'] == false){
					?>
					<p><strong><?php echo $donnees['IP_ADDR'] ; ?></strong> logged in at <strong><?php echo $donnees['D4TE'] ; ?></strong></p>
					<?php
				}
				else{
					?>
					<p><strong><?php echo $donnees['IP_ADDR'] ; ?></strong> tried to enter illegally at <strong><?php echo $donnees['D4TE'] ; ?></strong></p>
					<?php
				}
			}
			$reponse->closeCursor();
		?>
		</div>
	</nav>
	<footer>
		<?php
			include("fonctions/footer.php");
		?>
	</footer>
<?php
}
else{
	include("fonctions/ipsend.php");
}
?>
</body>
</html>