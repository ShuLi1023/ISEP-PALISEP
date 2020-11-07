<html>
	<head>
        <title>Palisep</title>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0"/>
        <style>
			
			.armes2 {
			position: absolute;
			left: 0px;
			top: 50%;
			}
			
			.bibli2 {
			position: absolute;
			left: 50%;
			top: 50%;
			}
			
			body {
			margin: 0;
			}
			
			.images {
			display: flex;
			flex-wrap: wrap;
			font-size: 0;
			height: 10vh;
			}
			
			.image {
			opacity: 1;
			height: 50vh;
			width: 50vw;
			}
			
			.image:hover {
			opacity: 0.5;
			}
			
			.logo-aibl {
			position: absolute;
			bottom: 10px;
			right: 50%;
			}
			
			.logo-isep {
			position: absolute;
			bottom: 0px;
			left: 50%;
			}
			
			.logo-palisep {
			position: absolute;
			top: 50%;
			left: 50%;
			margin-top: -28px;
			margin-left: -113px;
			}
			
			.text {
			position: absolute;
			width: 40vw;
            font-family: Gabriola;
            opacity: 0.6;
            margin: 18%;
            background-color: black;
            color: white;
            font-size: 20px;
            padding: 10px 10px;
			}
			
		</style>
		</meta>
	</head>
    <body>
		<div class="images">
			<img class="image" src="resources/images/accueil_armorial.jpg"/>
			<a href="system/application/views/recherche.php">
				<div class="text" style="right: 78vh; bottom: 11.25vw;">
				Armorial historique et monumental européen publie les campagnes d'inventaire photographique héraldique réalisées grâce 
				à des missions commandées par les collectivités territoriales et la DRAC de l'ex-région Champagne Ardenne ainsi que des relevés dans 
				d'autres régions ou pays (env. 5000 entrées).
				</div>
			</a>
			<img class="image armes2" src="resources/images/accueil_armes2.jpg"/>
			<a href="heraldique">
				<!--<div class="text" style="right: 78vh; top: 13vw;">
				L‘héraldique recense des armoiries européennes sous forme de blasonnements, fruit de dépouillements multiples (env. 130 000 entrées).
				</div>-->
			</a>
			<img class="image" src="resources/images/accueil_livre.jpg"/>
			<!--<a href="livre2">
				<div class="text">L‘héraldique et le livre publie des notices sur les fers de reliure et les présences héraldiques ou emblématiques sur 
				ou dans le livre manuscrit ou imprimé (env. 1300 notices).
				</div>
			</a>-->
			<img class="image bibli2" src="resources/images/accueil_bibli2.jpg"/>
			<!--<a href="bibliotheque">
				<div class="text">
				La Bibliographie permet avec un lien d‘accéder aux versions numérisées et mises en ligne d‘une documentation manuscrite ou imprimée 
				emblématiques et héraldiques par des organismes internationaux (Archives, bibliothèques, etc…).
				</div>
			</a>-->
		</div>
		<a href="www.aibl.fr">
			<img class="logo-aibl" src="resources/images/accueil_logo-aibl.png"/>
		</a>
		<a href="www.isep.fr">"
			<img class="logo-isep" src="resources/images/accueil_logo-isep.png"/>
		</a>
		<img class="logo-palisep" src="resources/images/accueil_logo-palisep.jpg" />
	</body>
</html>          						