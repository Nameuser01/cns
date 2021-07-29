<?php
session_start();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Orientation - C'nS</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="http://192.168.0.50/css/header.css" />
	<link rel="stylesheet" href="http://192.168.0.50/css/body.css" />
	<link rel="stylesheet" href="http://192.168.0.50/css/menu.css" />
	<link rel="stylesheet" href="http://192.168.0.50/css/footer.css" />
	<link rel="icon" href="img/lapin.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<?php
if(isset($_SESSION['name'])){
?>
<body>
	<header>
		<div class="top_infos">
			<div><h1>Code'nShill - Orientation</h1></div>
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
		<!-- ajouter la bdd -->
	</section>
	<footer>
		<?php
			include("fonctions/footer.php");
		?>
	</footer>
</body>
<?php
}
else{
	include("fonctions/ipsend.php");
}
?>
</html>