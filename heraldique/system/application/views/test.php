<html>
	<head>
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link type="text/css" href="resources/css/style.css" rel="stylesheet"/>
		<link type="text/css" href="system/libraries/Javascript/jquery-ui-1.8.18.custom.css" rel="stylesheet"/>
	</head>

	<body>

		Test affichage aires et régions 

		<div id="dialog_presentation" style=" font-size: 1.2vmax;" >
			Réalisé sous le haut patronage de l'Académie des Inscriptions et Belles-Lettres et avec les étudiants ingénieurs informaticiens de l'ISEP, le
			site www.palisep.fr, créé en 2010, présente déjà une considérable documentation en libre accès.</br>
			</br><p>Il se divise en quatre rubriques:</p>
			<ul style="text-indent: 0px;">
				<li><i><b>&#150; <u><a href="www.europe.palisep.fr/recherche">Armorial monumental</u></a></u></i></b>, qui publie les campagnes 
				d'inventaire photographique héraldique réalisées grâce à des missions commandées par les collectivités territoriales et la Drac de 
			l'ex-région Champagne Ardenne ainsi que des relevés dans d'autres régions ou pays (env. 5000 entrées).</li>
			<li><i><b>&#150; <u><a href="livre2/">L'héraldique et le livre</u></a></i></b>, qui publie des notices sur les fers de reliure et les 
			présences héraldiques ou emblématiques sur ou dans le livre manuscrit ou imprimé (env. 1300 notices).</li>
			<li><i><b>&#150; <u><a href="heraldique/">Recherche d'armes</u></a></i></b>, qui recense des armoiries européennes sous forme de 
			blasonnements, fruit de dépouillements multiples (env. 130 000 entrées).</li>
			<li><i><b>&#150; <u><a href="bibliotheque/">Bibliothèque</u></a></i></b>, qui permet avec un lien d'accéder aux versions numérisées et 
				mise en ligne d'une documentation manuscrite ou imprimées emblématique et héraldique par des organismes internationaux (Archives, 
			bibliothèques, etc.).</li>
			</ul>
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