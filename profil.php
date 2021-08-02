<?php
session_start();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>profile - cns</title>
	<meta charset="utf-8" />
	<link rel="icon" href="img/lapin.ico">
	<link rel="stylesheet" href="http://192.168.0.50/css/header.css" />
	<link rel="stylesheet" href="http://192.168.0.50/css/body.css" />
	<link rel="stylesheet" href="http://192.168.0.50/css/menu.css" />
	<link rel="stylesheet" href="http://192.168.0.50/css/footer.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>

	</style>
	</head>
<body>
	<?php
		if(isset($_SESSION['name']))
		{
	?>
		<header>
			<div class="top_infos">
				<div><h1>Code'nShill - Youtube</h1></div>
				<div class="user_infos">
					<div><?php echo $_SESSION["name"];?></div>
					<div><a href="session_destroy.php">Logout</a></div>
				</div>
			</div>
			<?php
				include("fonctions/menu.php");
			?>
		</header>
		<section>
			<?php
				try{
					$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
				}
				catch(Exeption $e)
				{
					die('Erreur : ' . $e->getMessage());
				}
				$requete = $bdd->query('SELECT * FROM users WHERE pseudo="'.$_SESSION['name'].'"');
				$info = $requete->fetch();
			?>
			<h4 class="informations">Bonjour <?php echo $info['pseudo']; ?>,<br />Tu peux ici modifier tes infomations personnelles et consulter ton activité sur le site.</h4>
			<!-- Récap des infos connues sur l'utilisateur -->
			<br /><p>Tes informations:</p>
			<p>
				Pseudo: <?php echo $info['pseudo']; ?><br />
				Rôle(s) <?php echo $info['role']; ?><br />
				Nombres de messages sur le forum: <?php echo $info['nbr_messages']; ?><br />
				<strong>Ton score est actuellement de: <?php echo $info['score']; ?></strong>
				<br />
			</p>
			<!-- Formulaire de création de compte -->
			<?php
				if($_SESSION['id'] == "1" AND $_SESSION['identifiant'] == $info['identifiant'])
				{//L'utilisateur est administrateur
					?>
						<fieldset>
							<legend>Formulaire de création de compte</legend>
							<form action="add_user.php" method="post">
								<label for="pseudo">Pseudo de l'utilisateur:</label><br />
								<input type="text" name="pseudo" /><br />
								<label for="password">Mot de passe:</label><br />
								<input type="text" name="password"><br />
								<label for="role">Rôle(s):</label><br />
								<input type="checkbox" name="role" /><br />
								<!-- Ajouter les options dynamiquement -->
								<label for="score">Score:</label><br />
								<input type="number" name="score" value="0" /><br />
								<label for="nbr_messages">Nombre de messages (forum):</label><br />
								<input type="number" name="nbr_messages" value="0" /><br />
								<label for="identifiant">Identifiant secret:</label><br />
								<input type="text" name="identifiant" /><br />
								<br /><input type="submit" value="Ajouter l'utilisateur }>" /><br />
							</form>
						</fieldset>
					<?php
				}
				else{/*L'utilisateur n'est pas administrateur. Donc, Ne rien afficher.*/}
			?>
		</section>
		<footer>
			<?php
				include("fonctions/footer.php");
			?>
		</footer>
	<?php
		}
		else
		{
			include("fonctions/ipsend.php");
		}
	?>
</body>
</html>