<?php
session_start();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<title>Orientation - C'nS</title>
	<meta charset="utf-8"/>
	<!-- <link rel="stylesheet" href="http://192.168.0.50/main.css" /> -->
	<link rel="icon" href="lapin.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>
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