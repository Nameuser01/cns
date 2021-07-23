<?php
session_start();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Music - C'nS</title>
	<meta charset="utf-8" />
	<!-- <link rel="stylesheet" href="http://192.168.0.50/main.css" /> -->
	<link rel="icon" href="lapin.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>
		section{
			display: flex;
			flex-direction: row;
			justify-content: space-around;
			width: auto;
		}
		section h4{
			border-left: 1px solid #ccc;
			border-bottom: 1px solid #ccc;
			padding-left: 10px;
		}
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
	</style>
</head>
<body>
<?php
if(isset($_SESSION['name'])){
?>
	<header>
		<div class="top_infos">
			<div><h1>Code'nShill - Music</h1></div>
			<div class="user_infos">
				<div><?php echo $_SESSION["name"];?></div>
				<div><a href="session_destroy.php">Logout</a></div>
			</div>
		</div>
		<nav id="menu_deroulant"><!--Menu animations-->
			<ul class="listonglet">
				<li>
					<div class="onglet">
						Allée principale
					</div>
					<div class="deroulant">
						<ul class="listoption">
							<a class="option" href="http://192.168.0.50/home.php">Accueil</a><br />
						</ul>
				</li>
			</ul>
			<ul class="listonglet">
				<li>
					<div class="onglet">
						Communication
					</div>
					<div class="deroulant">
						<ul class="listoption">
							<a class="option" href="http://192.168.0.50/note.php?page=1">Notes</a><br />
							<a class="option" href="http://192.168.0.50/orientation.php">Orientation</a>
						</ul>
				</li>
			</ul>
			<ul class="listonglet">
				<li>
					<div class="onglet">
						Medias
					</div>
					<div class="deroulant">
						<ul class="listoption">
							<a class="option" href="http://192.168.0.50/music.php">Musique</a><br />
							<a class="option" href="http://192.168.0.50/ytb.php?tag=toute">Vidéos Youtube</a>
						</ul>
				</li>
			</ul>
			<ul class="listonglet">
				<li>
					<div class="onglet">
						Développement
					</div>
					<div class="deroulant">
						<ul class="listoption">
							<a class="option" href="http://192.168.0.50/cpp.php">Projets C++</a><br />
							<a class="option" href="http://192.168.0.50/test_menu.php">test menus</a>
						</ul>
				</li>
			</ul>
			<ul class="listonglet">
				<li>
					<div class="onglet">
						Administration
					</div>
					<div class="deroulant">
						<ul class="listoption">
							<a class="option" href="http://192.168.0.50/administration.php">Administration</a><br />
						</ul>
				</li>
			</ul>
		</nav>
		<script>
			$('.listonglet li').mouseenter(function(){
				$(this).children('.deroulant').css('transition','0.2s')
				$(this).children('.deroulant').css('opacity','1')
				$(this).children('.deroulant').css('height','auto')
			})
			$('.listonglet li').mouseleave(function(){
				$(this).children('.deroulant').css('opacity','0')
				$(this).children('.deroulant').css('height','0px')
			})
		</script>
	</header>
	<section>
		<div class="contleft">
			<h4>Trying to find a utility for this space:</h4>
			<p>foo</p>
		</div>
		</div>
		<div class="contcent">
			<h4>Vidéos:</h4>
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
				while ($donnees = $reponse->fetch())
				{
					?>
					<iframe width="720" height="540" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($donnees['lien_video']) ; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<form action="http://192.168.0.50/delete_video.php" method="post">
						<center>
							<input name="id" value="<?php echo htmlspecialchars($donnees['id']) ; ?>" type="hidden">
							<input type="submit" id="suppression" name="suppression" value="Remove">
						</center>
					</form>
					<br />
					<br />
					<?php
				}
				$reponse->closeCursor();
			?>
		</div>
		<div class="contright">
			<h4>Management vidéos:</h4>
			<form method="POST" action="add_video.php">
				<div>
					<label for="name_video">Titre:</label><br />
					<input name="name_video" id="name_video" type="text" size="30"/>
				</div>
				<div>
					<label for="url_video">URL:</label><br />
					<input name="url_video" id="url_video" type="text" size="30" maxlength="11" required/>
				</div>
				<div>
					<center><input type="submit" value="Envoyer" /></center>
				</div>
			</form>
		</div>
	</section>
	<footer>
		<div class="menu_left">
			<div>
				<p>Creator:</p>
				<p>Creation: 01/28/21</p>
			</div>
		</div>
		<div class="menu_right"> 
			<div>
				<p>email:</p>
				<p>phone:</p>
			</div>
		</div>
	</footer>
<?php
}
else{
	$ip_addr = $_SERVER['REMOTE_ADDR'];
		$date_var = date("H:i:s d/m/Y");
		$legal = 1;
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
		}
		catch (Exeption $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
			$req = $bdd->prepare ('INSERT INTO logs (D4TE, IP_ADDR, legal) VALUES (?, ?, ?)');
			$req->execute(array($date_var, $ip_addr, $legal));
		?>
	<script>
		window.alert("Vous n'avez pas le droit d'être sur cette page !");
		document.location.href="http://192.168.0.50";
	</script>
<?php
}
?>
</body>
</html>
