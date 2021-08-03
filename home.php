<?php
session_start();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Home - C'nS</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="http://192.168.0.50/css/header.css" />
	<link rel="stylesheet" href="http://192.168.0.50/css/body.css" />
	<link rel="stylesheet" href="http://192.168.0.50/css/menu.css" />
	<link rel="stylesheet" href="http://192.168.0.50/css/footer.css" />
	<link rel="icon" href="img/lapin.ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>
	@media screen and (min-width: 1850px)
	{
		#conteneurs
		{
			display: flex;
			flex-direction: row;
			justify-content: space-around;
			width: auto;
		}
		.conteneur_gauche
		{
			width: 10%;
		}
		.conteneur_centre
		{
			width: 50%;
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
			text-decoration: underline;
			font-size: 20px;
		}
	}
	@media screen and (max-width: 1850px)
	{
		#conteneur
		{
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			width: auto;
			margin-left: 50px;
		}
		.cont_titre
		{
			font-decoration: underline;
		}
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
			<div><h1>Code'nShill - Home</h1></div>
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
	<section id="conteneurs">
		<div class="conteneur_gauche">
			<div><h4 class="titre_section">Liens utiles:</h4></div>
			<div><h3 class="titre">Twitch:</h3></div>
			<?php
				//Test d'issert avant la phase d'affichage.
				$nbr_chaines = $bdd->query("SELECT COUNT(*) as follows FROM liens_twitch WHERE pseudo='".$_SESSION['name']."'");
				$data = $nbr_chaines->fetch();
				$nbr_chaines = $data['follows'];
				if($nbr_chaines > "0")
				{
					$req_twitch = $bdd->query("SELECT * FROM liens_twitch WHERE pseudo='".$_SESSION['name']."'");
					while ($twitch_data = $req_twitch->fetch())
					{
						?>
							<a href="https://twitch.tv/<?php echo $twitch_data['streamer']; ?>" target="_blank"><?php echo $twitch_data['streamer']; ?></a><br />
						<?php
					}
				}
				else
				{
					echo "Tu ne suis aucune chaîne twitch actuellement. Tu peux en ajouter sur ";?><a href="http://192.168.0.50/administration.php">cette page</a><?php echo ".";
				}
			?>
			<br />
			<div><h3 style="margin-top: 30px;" class="titre">foo:</h3></div>
		</div>
		<div class="conteneur_centre">
			<h4 class="titre_section">Main content:</h4>
			<?php
			$req_nbr_videos = $bdd->query("SELECT COUNT(*) as compteur FROM music_playlist WHERE pseudo='".$_SESSION['name']."'");
			$data = $req_nbr_videos->fetch();
			$compteur = $data['compteur'];
			// echo "DEBEUG PHP: Il y a en tout: " . $compteur . " vidéos dans la base de donnée<br>";
			$name = $_SESSION['name'];
			if($compteur > 0)
			{
				$random_number = rand(1, $compteur);
				// echo "DEBEUG PHP 2: Le nombre random est " . $random_number ;
				$final_result = $bdd->query("SELECT * FROM music_playlist WHERE pseudo='$name'");
				$step_cursor = 1;
				while ($donnees = $final_result->fetch())
				{
					if($step_cursor == $random_number)
					{
						?>
						<iframe width="800" height="520" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($donnees['lien_video']) ; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						<?php
						break;
					}
					else
					{
						//Do nothing
					}
					$step_cursor++;
				}
				$final_result->closeCursor();
			}
			else
			{
				?>
				<p>Il n'y a aucune vidéo à afficher pour votre compte. Vous pouvez en ajouter sur <a href="http://192.168.0.50/music.php">cette page</a>.</p>
				<?php
			}
			?>
		</div>
		<div class="conteneur_droite">
			<h4 class="titre_section">Actualités:</h4>
			<?php
			$reponse = $bdd->query("SELECT * FROM note WHERE pseudo='$name' ORDER BY ID DESC LIMIT 0, 3");
			while ($donnees = $reponse->fetch())
			{
				?>
				<p>Le <strong style="color:#f00;"><?php echo htmlspecialchars($donnees['date']); ?></strong>:<br /><?php echo htmlspecialchars($donnees['commentaire']); ?></p>
				<?php
			}
			$req_twitch->closeCursor();
			$req_nbr_videos->closeCursor();
			$reponse->closeCursor();
		?>
		</div>
	</section>
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