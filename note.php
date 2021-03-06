<?php
session_start();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Note - C'nS</title>
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
		section{
			margin-top: 50px;
			display: flex;
			flex-direction: column;
			justify-content: space-around;
			margin: 0 auto;
			width: 1280px;
			margin-top: 50px;
		}
		section h4{
			border-bottom: 1px solid #cccccc;
			border-left: 1px solid #cccccc;
			padding-left:5px;
			margin-bottom: 50px;
		}
		.liens_pagination{
			display: flex;
			flex-direction: row;
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
		#titre,
		#commentaire
		{
			font-size: 18px;
		}
	}		
	</style>
</head>
<body>
<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
}
catch(Exeption $e)
{
	die('Erreur : ' . $e->getMessage());
}
$name = $_SESSION['name'];
$req_auth = $bdd->query("SELECT identifiant FROM users WHERE pseudo='$name'");
$auth=$req_auth->fetch();
if(isset($_SESSION['identifiant']) AND $_SESSION['identifiant'] == $auth['identifiant'])
{
	$bit = 0;
?>
	<header>
		<div class="top_infos">
			<div><h1>Code'nShill - Note</h1></div>
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
		<div>
			<h4>All my notes:</h4>
			<?php
				$result = $bdd->query("SELECT COUNT(*) as nbr_comments FROM note WHERE pseudo='$name'");
				$data = $result->fetch();
				$nbr_comments = $data['nbr_comments'];
				// Nombre de pages ?? cr??er
				$query_max_id = $bdd->query("SELECT MAX(sort_id) AS max_id FROM note WHERE pseudo='$name'");
				$data_for_id = $query_max_id->fetch();
				$max_id = $data_for_id['max_id'];
				$nbr_pages = intdiv($max_id, 10);
				$nbr_pages++;
				$i = 1;
				$max_id_comment = intdiv($max_id, 10);
				$max_id_comment = ++$max_id_comment * 10;
				$max_borne = ($max_id_comment - ($_GET['page'] - 1) * 10);
				$min_borne = $max_borne - 10;
				$reponse = $bdd->query("SELECT * FROM note WHERE pseudo='$name' AND sort_id < $max_borne AND sort_id >= $min_borne ORDER BY sort_id DESC");
				$step_stop = 1;
				while ($donnees = $reponse->fetch())
				{
					$bit++;
					if($bit % 2 == 1){
						?>
							<div class="forum_impair"><p style="background-color: #0f0f3f; padding:10px"><strong style="color: red;">
								<?php
									if (strlen(htmlspecialchars($donnees['titre'])) > 0){
										?>
										Titre : <?php echo htmlspecialchars($donnees['titre']); ?><br /><br />
										<?php
									}
									else
									{
										//Do nothing
									}
								?>
								</strong>At <strong style="color:#f00;"><?php echo htmlspecialchars($donnees['date']); ?>, <?php echo $donnees['pseudo']; ?></strong> says:<br /><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
							</div>
						<?php
					}
					else{
						?>
							<div class="forum_pair">
								<p style="padding: 10px;"><strong style="color: red;">
								<?php
									if(strlen(htmlspecialchars($donnees['titre'])) > 0){
										echo "Titre: ".htmlspecialchars($donnees['titre'])."<br><br>";
									}
									else
									{
										//Do nothing
									}
								?>
								</strong>
								At <strong style="color:#f00;"><?php echo nl2br(htmlspecialchars($donnees['date'])); ?>, <?php echo $donnees['pseudo']; ?></strong> says:<br /><?php echo htmlspecialchars($donnees['commentaire']); ?></p>
							</div>
						<?php
					}
					?>
					<!-- Formulaire de suppression de donn??es -->
					<form method="post" action="http://192.168.0.50/post/delete_note.php">
						<input type="hidden" name="id" value="<?php echo htmlspecialchars($donnees['id']) ; ?>">
						<input type="submit" class="submit_bouton" name="delCom" value="remove this comment">
					</form>
					<?php 
				}
				echo "<br />Nombre de commentaires: " . $nbr_comments;
				echo "<br /><br />Page: ";
				while ($i <= $nbr_pages){
					?><a href="http://192.168.0.50/note.php?page=<?php echo $i ; ?>"> <?php echo $i ; ?> </a><?php
					$i++;
				}
				$reponse->closeCursor();
			?>
		</div>
		<!-- post des commentaires -->
		<div class="post_section">
			<h4 id="envoyer_les_commentaires" style="margin-top: 100px;">Section d'envoie des commentaires</h4>
			<form method="post" action="http://192.168.0.50/post/note_post.php">
				<div>
					<label for="titre" style="font-size: 20px">Titre</label><br>
					<input type="text" name="titre" id="titre" maxlength="255" size="101%" /><br><br>
					<label for="commentaire" style="font-size: 20px;">Commentaire</label><br>
					<textarea id="commentaire" name="commentaire" cols="100%" rows="10" size="100%" ></textarea><br>
				</div>
				<div style="margin-top: 20px;">
					<input type="submit" value="Poster" name="bouton" style="padding: 6px">
				</div>
			</form>
		</div>
		<h4 id="informations_complementaires" style="margin-top: 100px;">Informations compl??mentaires sur la page</h4>
		<p>Si vous avez des probl??mes d'affichage sur le forum, c'est qu'il est n??cessaire de faire une mise ?? jour des ID. Il est int??ressant de faire cette mise ?? jour si vous supprimez beaucoup de commentaires. Ce n'est pas n??cessaire, mais c'est plus pratique en ce qui concerne l'affichage d'un nombre correct de commentaires</p>
		<a href="http://192.168.0.50/note_refresh.php">Mettre ?? jour les id dans la base de donn??e</a>
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
