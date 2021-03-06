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
	<style>
		#conteneurs
		{
			display: flex;
			flex-direction: row;
			justify-content: space-around;
			width: auto;
		}
		.conteneur_gauche
		{
			width: 20%;
		}
		.conteneur_centre
		{
			width: 40%;
		}
		.conteneur_droite
		{
			width: 25%;
		}
		.titre_section
		{
			text-decoration: none;
			font-size: 25px;
		}
		.titre
		{
			text-decoration: none;
			font-size: 20px;
		}
		.submit_bouton
		{
			padding: 5px 15px;
			border-radius: 2px;
		}
	</style>
</head>
<body>
<?php
if(isset($_SESSION['name']))
{
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
	<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
	}
	catch(Exeption $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	?>
	<nav id="conteneurs">
		<div class="conteneur_gauche">
			<h4 class="titre_section">Récapitulatif:</h4>
			<h5 class="titre">Chaînes twitch:</h5>
			<?php
			$name=$_SESSION['name'];
			// Visualisation des chaines twitch (récap + proposition de supression)
			$liste_twitch = $bdd->query("SELECT * FROM liens_twitch WHERE pseudo='$name'");
			while($chaines = $liste_twitch->fetch())
			{
				?>
				<form action="http://192.168.0.50/post/del_streamer.php" method="post" style="margin-bottom: 5px;">
					<input type="hidden" name="id_del" value="<?php echo $chaines['id']; ?>" />

					<input type="submit" value="supprimer" style="border-radius: 2px;" />
					<?php
					echo $chaines['streamer'];
					?>
				</form>
				<?php
			}
			?>
		</div>
		<div class="conteneur_centre">
			<h4 class="titre_section" style="text-align: left;">Panneau de gestion:</h4>
			<?php
			// Requête récupération des groupes
			$recup_groupes_twitch = $bdd->query("SELECT groupe, pseudo FROM groupes_twitch WHERE pseudo='$name'")
			?>
			<fieldset style="width: 50%;">
				<legend>Ajouter une chaîne Twitch:</legend>
				<form action="http://192.168.0.50/post/add_streamer.php" method="post">
					<input type="hidden" name="pseudo" value="<?php echo $_SESSION['name']; ?>" />
					<br />
					<center><label class="label_informations">Entrer le nom du streamer:</label></center><br />
					<center><input type="text" name="streamer" style="font-size: 17px;"  /></center><br />
					<center><select name="groupe">
						<?php
						while($info_groupe = $recup_groupes_twitch->fetch())
						{
							?>
							<option value="<?php echo $info_groupe['groupe']; ?>" required><?php echo $info_groupe['groupe']; ?></option>
							<?php
						}
						?>
					</select></center>
					<br />

					<center><input class="submit_bouton" type="submit" value="Ajouter" /></center><br />
				</form>
			</fieldset>
			<!-- 			<fieldset style="margin-top:50px;">
				<legend>Ajouter un twitch clip:</legend>
				<form method="post" action="">
				</form>
			</fieldset> -->
		</div>
		<div class="conteneur_droite">
			<h4 class="titre_section">Logs:</h4>
			<?php
			$reponse = $bdd->query('SELECT * FROM logs ORDER BY ID DESC LIMIT 0, 10');
			while ($donnees = $reponse->fetch())
			{
				if ($donnees['legal'] == false)
				{
					?>
					<p><strong><?php echo $donnees['IP_ADDR'] ; ?></strong> logged in at <strong><?php echo $donnees['D4TE'] ; ?></strong></p>
					<?php
				}
				else
				{
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
else
{
	include("fonctions/ipsend.php");
}
?>
</body>
</html>