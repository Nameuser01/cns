<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
}
catch(Exeption $e)
{
	die('Erreur : ' . $e->getMessage());
}
$name=$_SESSION['name'];
$req_auth=$bdd->query("SELECT identifiant FROM users WHERE pseudo='$name'");
$auth=$req_auth->fetch();
if(isset($_SESSION['identifiant']) AND $_SESSION['identifiant'] == $auth['identifiant'])
{
?>
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
							<a class="option" href="http://192.168.0.50/orientation.php">[Orientation]</a><br />
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
							<a class="option" href="http://192.168.0.50/ytb.php?tag=toute">Vidéos Youtube</a><br />
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
							<a class="option" href="http://192.168.0.50/cpp.php">[Projets C++]</a><br />
							<a class="option" href="http://192.168.0.50/test_menu.php">test menus</a><br />
							<a class="option" href="http://192.168.0.50/hack.php">Hack</a><br />
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
							<a class="option" href="http://192.168.0.50/profil.php">Profil</a><br />
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
<?php
}
else
{
	header('Location: http://192.168.0.50');
}
?>