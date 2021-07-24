<?php
session_start();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Home - C'nS</title>
	<meta charset="utf-8" />
	<!-- <link rel="stylesheet" href="http://192.168.0.50/main.css" /> -->
	<link rel="icon" href="lapin.ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>
	@media (min-width: 1980px){/*Le CSS suivant concerne tous les écrans avec une longueur > 1920px*/
		a{
			color: #7777ff;
		}
		a:hover{
			text-decoration: none;
		}
		body{
			color:#cccccc;
			background-color: #000011;
			margin: 0px;
			/*margin-top: -50px;*/
			font-family: Arial, sans-serif;
		}
		header{
			background-color: #030332;
			padding-bottom: 1%;
			margin-bottom: 2%;
			font-variant: small-caps;
		}
		/*header .menu{
			display: flex;
			flex-direction: row;
			justify-content: space-around;
			padding-top: 1%;
			flex-wrap: wrap;
		}*/
		.top_infos{
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			border-bottom: 1px solid #cccccc;
		}
		.user_infos{
			display:flex;
			flex-direction: column;
			justify-content : space-around;
			margin-right: 30px;
			font-size: 20px;
		}
		footer{
			border-top: 1px solid #cccccc;
			margin-top: 5%;
			display: flex;
			flex-direction: row;
			justify-content: space-around;
			background-color: #030332;
		}
		.menu_left{
			display: flex;
			flex-direction: column;
		}
		.menu_right{
			display: flex;
			flex-direction: column;
		}
		nav{
			display:flex;
			flex-direction: row;
			/*justify-content: space-around;*/
			/*border-bottom:1px solid #ccc;*/
		}
		.contleft{
			/*border: 1px solid #ccc;*/
			padding: 10px;
			width: 24%;
		}
		.contleft input{
			margin-top: 10px;
		}
		.contcenter{
			padding-top: 10px;
			padding-bottom: 10px;
			padding-right: 30px;
			padding-left: 30px;
			width: 49%;
		}
		.contright{
			/*border:1px solid #cccccc;*/
			padding:10px;
			flex-wrap: wrap;
			width: 24%;
		}
		h4{
			border-bottom: 1px solid #cccccc;
			border-left: 1px solid #cccccc;
			padding-left:5px;
		}
		ul{/*Style du texte uniquement*/
			/*list-style:none;*/
		}
		.deroulant{
			/*height: 0px;*/
			overflow: hidden;
			opacity: 0;
			position: absolute;
			/*display: none;*/
			/*margin-left: 0px;*/
			transition: 2s;
			background-color: #303032;
			border-radius: 0px 10px;
			padding-bottom: 10px;
			padding-top:5px;
			/*border: 1px solid purple;*/
		}
		.option{/*Style des liens contenus dans les sous-onglets*/
			color: #cccccc;
			float: left;
			margin-left: -40px;
			/*border: 1px solid green;*/
			padding: 5px 20px 5px 20px;
		}
		.listonglet{/*Style des onglets*/
			display: flex;
			justify-content: left;
			/*border: 1px solid red;*/
		}
		.onglet{
			font-weight: 600;
			margin: 10px 50px 10px 0px;
			/*border: 1px solid yellow;*/
		}
	}
	@media (max-width: 100px){/*Le css ci-dessous concerne tous les écrans avec une taille < 1000px*/

	}
	</style>
</head>
<body>
<?php
if(isset($_SESSION['name'])){
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
	<nav id="sections">
		<div class="contleft"> <!-- !!!!!!!!!! Informations pratiques (liens etc...) !!!!!!!!!! -->
			<div><h4>Useful links:</h4></div>
			<div><h3>Twitch:</h3></div>
			<a class="useful_links" href="https://www.twitch.tv/" target="_blank"></a>
			<a class="useful_links" href="https://www.twitch.tv/" target="_blank"></a>
			<a class="useful_links" href="https://www.twitch.tv/" target="_blank"></a>
			<br />
			<div><h3 style="margin-top: 30px;">foo:</h3></div>
		</div>
		<div class="contcenter">
			<h4>Main content:</h4>
			<?php
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
			}
			catch(Exeption $e)
			{
				die('Erreur : ' . $e->getMessage());
			}
			$reponse = $bdd->query('SELECT * FROM music_playlist ORDER BY ID DESC');
			$compteur = 0;
			while ($donnees = $reponse->fetch())
			{
				$compteur++;
			}
			// echo "DEBEUG PHP: Il y a en tout: " . $compteur . " vidéos dans la base de donnée";?><br /><?php
			$random_number = rand(1, $compteur);
			// echo "DEBEUG PHP 2: Le nombre random est " . $random_number ;
			$final_result = $bdd->query("SELECT * FROM music_playlist");
			$step_cursor = 	1;
			while ($donnees = $final_result->fetch())
			{
				if($step_cursor == $random_number){
				?>
				<iframe width="1000" height="720" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($donnees['lien_video']) ; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				<?php
				break;
				}
				else{
					//Do nothing
				}
				$step_cursor++;
			}
			$reponse->closeCursor();
			?>
		</div>
		<div class="contright">
			<h4>Actualités:</h4>
			<?php
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
			}
			catch(Exeption $e)
			{
				die('Erreur : ' . $e->getMessage());
			}
			$reponse = $bdd->query('SELECT * FROM note ORDER BY ID DESC LIMIT 0, 5');
			while ($donnees = $reponse->fetch())
			{
				?>
				<p>At <strong style="color:#f00;"><?php echo htmlspecialchars($donnees['date']) . " " . $donnees['auteur']; ?></strong> says: <?php echo htmlspecialchars($donnees['commentaire']); ?></p>
				<?php
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
