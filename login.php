<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Login - C'nS</title>
	<meta charset="utf-8" />
	<link rel="icon" href="lapin.ico">
	<style>
		body{
			background-color: #000011;
			margin: 0px;
			color: #cccccc;
		}
		.erreur{
			color: #ff0000;
			font-size: 20px;
		}
	</style>
</head>
<body>
	<header>
		<h1>Code'nShill</h1>
	</header>
	<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=mywiki;charset=utf8', 'root', '');
	}
	catch(Exeption $e)
	{
		die('Erreur: ' . $e->getMessage());
	}
	$req = $bdd->query('SELECT * FROM users');
	while($data = $req->fetch())
	{
		if($_POST["pseudo"] == $data["pseudo"] && $_POST["password"] == $data["password"])
		{
			session_start();
			$_SESSION["name"] = $data["pseudo"];
			$_SESSION["role"] = $data["role"];
			$_SESSION["email"] = $data["email"];
			header('Location: http://192.168.0.50/logs.php');
		}
		else
		{
			// Do nothing
		}
	}
	if(isset($_SESSION["name"]))
	{
		// Do nothing
	}
	else
	{
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
		<p class="erreur">Erreur 401 : Utilisateur non authentifié !</p>
		<script>
			window.alert("Wrong password or username");
			document.location.href="http://192.168.0.50";
		</script>
		<?php
	}
	?>
</body>
</html>
