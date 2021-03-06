<?php
session_start();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Youtube - C'nS</title>
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
		.contright{
			position: -webkit-sticky;
			position: sticky;
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
	</style>
</head>
<body>
<?php
if(isset($_SESSION['name'])){
$tag_page = $_GET['tag'];
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
		<!-- <div class="contleft">
			<h4>Trying to find a utility for this space:</h4>
			<p>foo</p>
		</div>-->
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
	$nbr_vid_query = $bdd->query('SELECT COUNT(*) as nbr_videos FROM ytb_videos');
	$data = $nbr_vid_query->fetch();
	$nbr_videos = htmlspecialchars($data['nbr_videos']);
				if(!$_GET['tag']){
					$reponse = $bdd->query('SELECT * FROM ytb_videos ORDER BY id DESC');
				}
				elseif($_GET['tag'] == "toute"){
					$reponse = $bdd->query('SELECT * FROM ytb_videos ORDER BY id DESC');
				}
				else{
					$reponse = $bdd->query('SELECT * FROM ytb_videos WHERE tag="'.$_GET['tag'].'" ORDER BY id DESC');
				}
				while ($donnees = $reponse->fetch())
				{
					?>
					<iframe width="600" height="480" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($donnees['url']);?>?vq=hd720p60" frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
					<form action="http://192.168.0.50/del_ytb_video.php" method="post">
						<center>
							<input name="id" value="<?php echo htmlspecialchars($donnees['id']) ; ?>" type="hidden">
							<input name="tag" value="<?php echo $tag_page ; ?>" type="hidden">
							<input type="submit" id="suppression" name="suppression" value="Remove" style="padding-top:10px; padding-bottom: 10px; padding-right: 40px; padding-left: 40px;">
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
			<!-- <div style="position: fixed;"> -->
			<h4>Nombre vidéos sur le site:</h4>
			<p>|--> <?php echo "$nbr_videos" ; ?> <--|</p>
			<h4>Management vidéos:</h4>
			<h5>Ajout de vidéos</h5>
				<form method="POST" action="add_ytb_video.php">
				<div>
					<label for="name_video">Titre:</label><br />
					<input name="nom" id="nom" type="text" size="30" style="margin-top: 5px; margin-bottom: 10px; padding-top: 5px; padding-top: 5px;"/>
				</div>
				<div>
					<label for="url_video">URL*:</label><br />
					<input name="url" id="url" type="text" size="30" maxlength="11" required style="margin-top: 5px; margin-bottom: 10px; padding-top: 5px; padding-top: 5px;"/>
				</div>
				<div>
					<label for="tag">tag*:</label><br />
					<select name="tag" id="tag" style="padding-right:40px; padding-left: 40px; padding-top: 5px; padding-bottom: 5px; margin-bottom: 10px; margin-top: 5px;">
						<option value="toute">Toutes</option>
						<option value="divertissement">Divertissement</option>
						<option value="gaming">Gaming</option>
						<option value="thread">Thread</option>
						<option value="documentaire">Documentaire</option>
						<option value="informatique">Informatique</option>

						<option value="autre">Autre</option>
					</select>
				</div>
				<div>
					<input type="hidden" name="tag_page" value="<?php echo $tag_page ; ?>" />
					<center><input class="envoyer" type="submit" value="Envoyer" style="padding-right: 40px; padding-left:40px; padding-top:10px; padding-bottom: 10px;"/></center>
				</div>
				</form>
			<h5 style="margin-top: 50px;">Selection du tag</h5>
			<form method="GET" action="ytb.php">
				<label for="tag">Choose Tag:</label>
				<br />
				<center>
				<select name="tag" id="tag" style="padding-right: 40px; padding-left: 40px; padding-top: 5px; padding-bottom: 5px; margin-bottom: 10px; margin-top: 5px;">
					<option value="toute">Toutes</option>
					<option value="divertissement">Divertissement</option>
					<option value="gaming">Gaming</option>
					<option value="thread">Thread</option>
					<option value="documentaire">Documentaire</option>
					<option value="informatique">Informatique</option>

					<option value="autre">Autre</option>
				</select>
				<br />
				<input type="submit" value="Apply" style="padding-right: 40px; padding-left: 40px; padding-top: 10px; padding-bottom: 10px; background-color: #cccccc;"></center>
			</form>
			<!-- </div> -->
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