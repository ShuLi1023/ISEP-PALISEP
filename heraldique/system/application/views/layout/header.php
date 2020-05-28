<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
	<!--
		Design by Free CSS Templates
		http://www.freecsstemplates.org
		Released for free under a Creative Commons Attribution 2.5 License
		
		Name       : Sparkling   
		Description: A two-column, fixed-width design with dark color scheme.
		Version    : 1.0
		Released   : 20100704
		
	-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Palisep Héraldique</title>
		<meta name="keywords" content="free templates, website templates, CSS, HTML" />
		<meta name="description" content="free website template provided by templatemo.com" />
		<meta http-equiv="Content-Script-Type" content="text/javascript" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<!-- Appel du fichier CSS -->
		<link href="<?php echo base_url()?>resources/css/style.css" rel="stylesheet" type="text/css" />
		<!-- Appel des fichiers pour la visionneuse flash lightbox -->
		<script type="text/javascript" charset="UTF-8" src="<?php echo base_url()?>resources/lightbox/js/lightbox_plus_min.js"></script>
		
		<link rel="stylesheet" href="<?php echo base_url()?>resources/lightbox/js/lightbox.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url()?>resources/lightbox/js/jojo.css" type="text/css" media="screen" />
		<link type="text/css" href="<?php echo PALISEP ?>system/libraries/Javascript/jquery-ui-1.8.18.custom.css" rel="stylesheet" /> <!--appel du css jquery-->
		<link type="text/css" href="<?php echo PALISEP ?>system/libraries/Javascript/DataTable/media/css/jquery.dataTables.css" rel="stylesheet" /> <!--appel du css utilisé pr le plugin DataTable (tableaux de l'admin)-->
		
		<script type="text/javascript" src="<?php echo PALISEP ?>system/libraries/Javascript/jquery.js"></script>
		<script type="text/javascript" src="<?php echo PALISEP ?>system/libraries/Javascript/jquery-ui-1.8.18.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo PALISEP ?>system/libraries/Javascript/DataTable/media/js/jquery.dataTables.js"></script>
		<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
		<script type="text/javascript">
			tinyMCE.init({
				// General options
				mode : "exact",
				elements : "tinymce_presentation",
				// theme : "advanced",
				//plugins : "image link",
				menubar : false,
				toolbar: "undo redo | formatselect | bold italic underline | bullist numlist | alignleft aligncenter alignright alignjustify | hr",
				
			});
		</script>
		<!-- Scripts javascript -->
		<script type="text/javascript">
			function visibilite(thingId){ //fonction qui affiche/cache une div
				var targetElement;
				targetElement = document.getElementById(thingId) ;
				if (targetElement.style.display == "none"){
					targetElement.style.display = "" ;
					} else {
					targetElement.style.display = "none" ;
				}
			}
			
			function change_onglet(name) //fonction qui gère l'affichage des onglets ds l'admin'
			{
				document.getElementById('onglet_'+anc_onglet).className = 'onglet_0 onglet';
				document.getElementById('onglet_'+name).className = 'onglet_1 onglet';
				document.getElementById('contenu_onglet_'+anc_onglet).style.display = 'none';
				document.getElementById('contenu_onglet_'+name).style.display = 'block';
				anc_onglet = name;
			}
			
			function getFiche(id,table) //Afficher la fiche de modification ds l'admin'
			{
				if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				}
				else
				{// code for IE6, IE5
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById("fiche").innerHTML = xmlhttp.responseText;
						$( "#fiche" ).dialog( "open" );
					}
				}
				xmlhttp.open("GET",'<?php echo base_url() ?>fiche_modif?id='+id+'&tab='+table,true);
				xmlhttp.send();
			}
			
			function create_champ(element,i,id) { //Création d'un champs supplémentaire d'ajout d'image
				
				var i2 = i + 1;
				var id2 = id+1;
				
				document.getElementById(element+'_'+id).innerHTML = '<input type="file" name="images_'+i+'"></span>';
				document.getElementById(element+'_'+id).innerHTML += (i < 10) ? '<br /><center><span id="'+element+'_'+id2+'"><a style="color:black;" href="javascript:create_champ(\''+element+'\','+i2+','+id2+')">Nouveau champs image</a><br /><br /></span></center>' : '';
			}
			
			$(document).ready(function(){
				
				$(function() { //paramétrage de l'affichage de la fiche des partenaires
					$( "#partenaires" ).dialog({
						autoOpen: false,
						resizable: true,
						height: 500,
						width: 700,
						position: "center",
						show: "blind",
						hide: "explode"
					});
				});
				
				$('#table_objets').dataTable({ //paramétrage du tableau objets/livres de l'admin'
					
					"oLanguage": {
						"sLengthMenu": "Afficher _MENU_ entrées par page",
						"sZeroRecords": "Aucun résultat trouvé - désolé",
						"sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ résultats",
						"sInfoEmpty": "Affichage de 0 à 0 sur 0 résultats",
						"sInfoFiltered": "(filtrés de _MAX_ résultats)",
						"sSearch": "Recherche",
						"oPaginate": {
							"sFirst":    "Premier",
							"sPrevious": "Précédent(s)",
							"sNext": "Suivant(s)",
							"sLast": "Dernier"
						}
					},
					
					"sScrollY": 500,
					"sScrollX": 400,
					"sPaginationType": "full_numbers"
				});
				
				$('#table_armorial').dataTable( { //paramétrage du tableau armorial de l'admin'
					
					"oLanguage": {
						"sLengthMenu": "Afficher _MENU_ entrées par page",
						"sZeroRecords": "Aucun résultat trouvé - désolé",
						"sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ résultats",
						"sInfoEmpty": "Affichage de 0 à 0 sur 0 résultats",
						"sInfoFiltered": "(filtrés de _MAX_ résultats)",
						"sSearch": "Recherche",
						"oPaginate": {
							"sFirst":    "Premier",
							"sPrevious": "Précédent(s)",
							"sNext":     "Suivant(s)",
							"sLast":     "Dernier"
						}
					},
					
					"sScrollY": 500,
					"sScrollX": 400,
					"sPaginationType": "full_numbers"
				} );
				
				$('#table_eq').dataTable( { //paramétrage du tableau equivalences de l'admin'
					
					"oLanguage": {
						"sLengthMenu": "Afficher _MENU_ entrées par page",
						"sZeroRecords": "Aucun résultat trouvé - désolé",
						"sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ résultats",
						"sInfoEmpty": "Affichage de 0 à 0 sur 0 résultats",
						"sInfoFiltered": "(filtrés de _MAX_ résultats)",
						"sSearch": "Recherche",
						"oPaginate": {
							"sFirst":    "Premier",
							"sPrevious": "Précédent(s)",
							"sNext":     "Suivant(s)",
							"sLast":     "Dernier"
						}
					},
					
					"sScrollY": 300,
					"sScrollX": 400,
					"sPaginationType": "full_numbers"
				} );
				
				$('#table_aire').dataTable( { //paramétrage du tableau aire géographique de l'admin'
					
					"oLanguage": {
						"sLengthMenu": "Afficher _MENU_ entrées par page",
						"sZeroRecords": "Aucun résultat trouvé - désolé",
						"sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ résultats",
						"sInfoEmpty": "Affichage de 0 à 0 sur 0 résultats",
						"sInfoFiltered": "(filtrés de _MAX_ résultats)",
						"sSearch": "Recherche",
						"oPaginate": {
							"sFirst":    "Premier",
							"sPrevious": "Précédent(s)",
							"sNext":     "Suivant(s)",
							"sLast":     "Dernier"
						}
					},
					
					"sScrollY": 300,
					"sScrollX": 400,
					"sPaginationType": "full_numbers"
				} );
				
				$(function() { //gestion du resize des tableaux qd l'onglet "contenus" est cliqué (évite les problèmes de taille de colonne farfelue)
					$("#onglet_contenus").click(function () {
						$('#table_objets').dataTable().fnAdjustColumnSizing();
						$('#table_armorial').dataTable().fnAdjustColumnSizing();
						$('#table_eq').dataTable().fnAdjustColumnSizing();
						$('#table_aire').dataTable().fnAdjustColumnSizing();
					});
				});
				
				$(function() {
					$("#dico_armes").click(function () {
						$( "#loader" ).dialog("open");
					});
				});
				
				$(function() { //affichage de la fiche de modif d'un contenu'
					$( "#fiche" ).dialog({
						autoOpen: false,
						resizable: true,
						height: 600,
						width: 900,
						position: "center",
						show: "blind",
						hide: "explode"
					});
				});
				
				$(function() { //affichage du dico armes
					$( "#dico" ).dialog({
						autoOpen: false,
						resizable: true,
                        height: 500,
						width: 900,
						position: "left",
						show: "blind",
						hide: "explode",
						width: 500
					});
				});
				
				$( "#show_presentation" ).click(function(){
					$( "#dialog_presentation" ).dialog("open");
				});
				
				$( "#dialog_presentation" ).dialog({ 
					autoOpen: false,
					width: 550,
					position:"center"
					
				});
				
				$(function() {
					$( "#loader" ).dialog({
                        draggable: false,
                        position: "center",
                        width: 400,
                        resizable: false,
                        autoOpen: false,
						modal:true,
                        closeOnEscape: false,
                        open: function(event, ui) { jQuery('.ui-dialog-titlebar-close').hide(); }
					});
				});
				
			});
			
			function ConfirmMessage(id,table) { //affichage de la fenetre de confirmation de supression d'un contenu'
				if (confirm("Etes-vous sûr de vouloir supprimer?")) { // Clic sur OK
					window.location = "<?php echo base_url(); ?>administration?anc_onglet=contenus&sup="+table+"&id="+id;
				}
			}
		</script>	
		
	</head>
	<body>
		<div id="dialog_presentation" title="Présentation" style="display:none">
			<?php 
				foreach($presentation_heraldique as $presentation){
					echo html_entity_decode($presentation->description);
				} 
			?>
			
		</div>
		<div id="wrapper">
			
			<!-- Bouton de déconnexion -->
			<div style="width:940px; margin-top:5px; position:absolute">
				<?php if ($connecte == true){ ?>	
					<form action="administration" method="post">
						<input style="margin-left:800px"type="submit" name="deconnexion" value="Deconnexion" id="deconnexion" > 
					</form>
				<?php } ?>
			</div>
			
			<div style="width:940px; margin-left:580px;margin-top:80px; position:absolute">
				<a href="<?php echo PALISEP ?>" ><img src="<?php echo base_url()?>resources/images/palisep.png" id="palisep"></a>
			</div>
			
			<!-- ####################### -->
			<div id="header">
				<center><div id="logo">
					<a href="<?php echo base_url()?>" ><img src="<?php echo base_url()?>resources/images/heraldique.png" id="aube"></a>
				</div></center>
			</div>
			<!-- Onglets -->
			<div id="menu">
				<ul>
					
					<li><a></a>
                        <li><a href="<?php echo base_url()?>">Accueil</a></li>
						<li><a></a></li><li><a></a></li>
						<li><?php echo anchor('recherche', 'Recherche d\'Armes & de Familles ');?></li>
						<li><a></a></li><li><a></a></li>
						<li><?php echo anchor('administration', 'Administration');?></li>
						<li><a></a></li><li><a></a></li><li><a href="#" id="show_presentation">Présentation</a></li>
					</ul>
				</div>
			</div>	
		</div>
		<div id="page">
			<div id="page-bgtop">
				<div id="page-bgbtm">
					
					<div id="content">		
					</div>
				</div>
			</div>
		</div>
	</body>
</html>


