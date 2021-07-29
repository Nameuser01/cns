<!doctype html>
<html lang='fr'>
	<head>
		<title>Test menu déroulant</title>
		<link rel="icon" href="lapin.ico">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta http-equiv="refresh" content="5">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<style>
			body{
				margin: 0;
			}
			ul{/*Style du texte uniquement*/
				list-style:none;
			}
			.deroulant{
				height: 0px;
				overflow: hidden;
				opacity: 0;
				/*position: absolute;*/
				/*display: none;*/
				/*margin-left: px;*/
				margin-top: 10px;
				transition: 2s;
				background-color: #cccccc;
				border: 1px solid purple;
			}
			.option{
				float: left;
				position: relative;
				/*left: 10px;*/
				margin: 0 5px;
				border: 1px solid green;
				padding: 5px 20px 5px 20px;
			}
			.listonglet{
				display: flex;
				justify-content: left;
				/*background-color: #cccccc;*/
				border: 1px solid red;
			}
			.onglet{
				font-weight: 600;
				margin: 10px 50px 10px 50px;
				/*background-color: #cccccc;*/
				border: 1px solid yellow;
			}
/*			.listoption{
				border: 1px solid black;
			}*/
		</style>
	</head>
	<body>
		<header>
			<nav>
				<ul class="listonglet">
					<li>
						<div class="onglet">
							medias
						</div>
						<div class="deroulant">
							<ul class="listoption">
								<li class="option">option 3</li><br />
								<li class="option">option 4</li><br />
								<li class="option"><a href="http://192.168.0.50/home.php">Home</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="onglet">
							<a href="https://twitch.tv">Twitch</a>
						</div>
						<div class="deroulant">
							<ul class="listoption">
								<li class="option">option 2</li><br />
								<li class="option">option 3</li><br />
								<li class="option">option 4</li><br />
							</ul>
						</div>
					</li>
					<li>
						<div class="onglet">
							Onglet 3
						</div>
						<div class="deroulant">
							<ul class="listoption">
								<li class="option">option 1</li><br />
								<li class="option">option 2</li><br />
								<li class="option">option 3</li><br />
								<li class="option">option 4</li><br />
							</ul>
						</div>
					</li>
		</header>
	</body>
	<script>
		$('.listonglet li').mouseenter(function(){
			$(this).children('.deroulant').css('transition','1s')
			$(this).children('.deroulant').css('opacity','1')
			$(this).children('.deroulant').css('height','auto')
		})
		$('.listonglet li').mouseleave(function(){
			$(this).children('.deroulant').css('opacity','0')
			$(this).children('.deroulant').css('height','0px')
		})
		myFunction()
	</script>
</html>