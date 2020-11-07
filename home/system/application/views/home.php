<html>
<head>
	<title>Palisep</title>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link type="text/css" href="/resources/css/style.css" rel="stylesheet"/>
	<link type="text/css" href="/system/libraries/Javascript/jquery-ui-1.8.18.custom.css" rel="stylesheet"/>
	
	<style>
		
		body {
		margin: 0;
		}
		
		.images {
		display: flex;
		height: 10vh;
		flex-wrap: wrap;
		font-size: 0;
		}
		
		.image {
		height: 50%;
		width: 50%;
		opacity: 1;
		display:inline-block;
		}
		
		.image:hover {
		opacity: 0.3;
		}
		
		.text {
		position: absolute;
		width: 40vw;
		max-height: 50vh;
		transform: translate(-50%, -50%);
		font-family: Gabriola;
		opacity: 0;
		background-color: black;
		color: white;
		font-size: 3vmin;
		padding: 1vw 1vw;
		}
		
		.images:hover .text {
		opacity: 0.8;
		}
		
		.text:hover .image {
		opacity: 0.3;
		}
		
		.armorial {
		position: absolute;
		top: 0%;
		left: 0%;
		}
		
		.armes2 {
		position: absolute;
		bottom: 0%;
		left: 0px;
		}
		
		.livre {
		position: absolute;
		top: 0%;
		right: 0%;
		}
		
		.bibli2 {
		position: absolute;
		bottom: 0%;
		right: 0%;
		}
		
		.logo-aibl {
		position: absolute;
		width: 10%;
		bottom: 0.7vw;
		right: 50%;
		}
		
		.logo-isep {
		position: absolute;
		width: 9%;
		bottom: 0px;
		left: 50%;
		}
		
		.logo-palisep {
		position: absolute;
		width: 15%;
		top: 50%;
		left: 50%;
		transform:translate(-50%, -50%);
		}

		#adminButton {
			position: absolute;
			text-align: center;
			border-radius: 4px;
			box-shadow: 0px 0px 1px black;
			border: 0px solid black;
			color: white;
			background-color: #e79e61;
			cursor: pointer;
			height: 40px;
			width: 80%;
			left: 10%;
			margin-bottom: 30px;
		}

		#dialog_presentation{
			min-height: 400px !important;
		}
		
	</style>
	</meta>
</head>
<body>
	<div class="images">
		<img class="image" style="position: absolute; top: 0%; left: 0%;" src="/resources/images/accueil_armorial.jpg"/>
		<a href="http://europe.palisep.fr/recherche">
			<div class="text" style="top: 25%; left: 25%;">
				<?php echo $armorial ?>
			</div>
		</a>
	</div>
	<div class="images">
		<img class="image armes2" src="/resources/images/accueil_armes2.jpg"/>
		<a href="../heraldique">
			<div class="text" style="top: 75%; left: 25%;">
				<?php echo $heraldique ?>
			</div>
		</a>
	</div>
	<div class="images">
		<img class="image livre" src="/resources/images/accueil_livre.jpg"/>
		<a href="../livre2">
			<div class="text" style="top: 25%; left: 75%;">
				<?php echo $livre ?>
			</div>
		</a>
	</div>
	<div class="images">
		<img class="image bibli2" src="/resources/images/accueil_bibli2.jpg"/>
		<a href="../bibliotheque">
			<div class="text" style="top: 75%; left: 75%;">
				<?php echo $biblio ?>
			</div>
		</a>
	</div>
	<a href="http://www.aibl.fr">
		<img class="logo-aibl" src="/resources/images/accueil_logo-aibl.png"/>
	</a>
	<a href="http://www.isep.fr">"
		<img class="logo-isep" src="/resources/images/accueil_logo-isep.png"/>
	</a>
	<a href="#" id="show_presentation">
		<img class="logo-palisep" src="/resources/images/accueil_logo-palisep.png"/>
	</a>
	<div id="dialog_presentation" style=" font-size: 1.2vmax;" >
	
		Réalisé sous le haut patronage de l'Académie des Inscriptions et Belles-Lettres et avec les étudiants ingénieurs informaticiens de l'ISEP, le
		site www.palisep.fr, créé en 2010, présente déjà une considérable documentation en libre accès.</br>
		</br><p>Il se divise en quatre rubriques:</p>
		<ul style="text-indent: 0px;">
			<li><i><b>&#150; <u><a href="../europe/">Armorial monumental</u></u></i></b>, qui publie les campagnes 
			d'inventaire photographique héraldique réalisées grâce à des missions commandées par les collectivités territoriales et la Drac de 
		l'ex-région Champagne Ardenne ainsi que des relevés dans d'autres régions ou pays (env. 5000 entrées).</li>
		<li><i><b>&#150; <u><a href="../livre2/">L'héraldique et le livre</u></a></i></b>, qui publie des notices sur les fers de reliure et les 
		présences héraldiques ou emblématiques sur ou dans le livre manuscrit ou imprimé (env. 1300 notices).</li>
		<li><i><b>&#150; <u><a href="../heraldique/">Recherche d'armes</u></a></i></b>, qui recense des armoiries européennes sous forme de 
		blasonnements, fruit de dépouillements multiples (env. 198 000 entrées).</li>
		<li><i><b>&#150; <u><a href="../bibliotheque/">Bibliothèque</u></a></i></b>, qui permet avec un lien d'accéder aux versions numérisées et 
			mise en ligne d'une documentation manuscrite ou imprimées emblématique et héraldique par des organismes internationaux (Archives, 
		bibliothèques, etc.).</li>
	</ul>
	<form method="get" action="/admin/"> 
		<button id="adminButton" type="submit" style="text-align:center">Accès administrateur</button>
	</form>
</div>
<script>
	$( "#dialog_presentation" ).dialog({
		closeText: "Fermer",
		width: 550,
		title: "Présentation du site",
	}).dialog("close");
	$( "#show_presentation" ).click(function(){
		$( "#dialog_presentation" ).dialog({
			closeText: "Fermer",
			width: 550,
			title: "Présentation du site",
		}).dialog("open");
	});
</script>
</body>
</html>						