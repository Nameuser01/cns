<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Hack</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
		echo "On essaie ici de créer un cookie via une page random qui va mener vers cns dans le but de rentrer avec un identifiant qui n'appartient pas à la bdd";
		session_start();
		$_SESSION["name"] = "admin";
		?>
		<p>Cliquez</p><a href="http://192.168.0.50/home.php" target="_blank"> ici </a><p>pour être redirigé vers la page home de cns.</p>
</body>
</html>