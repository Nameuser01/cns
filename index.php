<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Code'nShill - C'nS</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="http://192.168.0.50/main.css" />
	<link rel="icon" href="lapin.ico">
	<!-- <META HTTP-EQUIV="Refresh" CONTENT="5" /> -->
	<style>
		#menu{
			display: flex;
			flex-direction: row;
			justify-content: center;
			margin-top: 10%;
		}
		.submit{
			padding: 3px;
		}
		footer{
			margin-top: 20%;
		}
	</style>
</head>
<body>
	<header>
		<h1>Code'nShill</h1>
		<h4>Vous devez vous authentifier pour entrer sur le site</h4>
		<h4>Contactez l'administrateur pour devenir membre</h4>
	</header>
	<section>
		<div id="menu">
			<form action="http://192.168.0.50/login.php" method="post">
				<div>
					<center><label for="pseudo">Enter your name:</label></center>
					<input type="text" name="pseudo" id="pseudo" required style="padding: 10px"><br />
				</div><br />
				<div>
					<center><label for="password">Enter your password:</label></center>
					<input type="password" name="password" id="password" required style="padding:10px"><br />
				</div>
				<div class="submit">
					<center><input type="submit" value="Enter" name="submit" style="padding-bottom:10px; padding-top: 10px; padding-right:45px; padding-left: 45px; border-radius: 10px; margin-top: 20px"></center>
				</div>
			</form>
		</div>
	</section>
	<footer>
	<?php include("fonctions/footer.php"); ?>
	</footer>
</body>
</html>
