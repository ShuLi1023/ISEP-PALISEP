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
<title>Palisep Marne</title>
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
<link type="text/css" href="<?php echo PALISEP ?>system/libraries/Javascript/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo PALISEP ?>system/libraries/Javascript/jquery.js"></script>
<script type="text/javascript" src="<?php echo PALISEP ?>system/libraries/Javascript/jquery-ui-1.8.18.custom.min.js"></script>

<!-- Script qui permet de masquer/afficher un div -->
<script type="text/javascript">
function visibilite(thingId){
	var targetElement;
	targetElement = document.getElementById(thingId) ;
	if (targetElement.style.display == "none"){
		targetElement.style.display = "" ;
	} else {
		targetElement.style.display = "none" ;
	}
}

function getFiche(id,table) //Afficher la fiche de modification
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
	xmlhttp.open("GET",'<?php echo base_url() ?>fiche_modif/index/'+id+'/'+table,true);
	xmlhttp.send();
}

function getDico() //Afficher du dico
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
		document.getElementById("dico").innerHTML = xmlhttp.responseText;
		$( "#dico" ).dialog( "open" );
		}
	}
	xmlhttp.open("GET",'<?php echo base_url() ?>dico',true);
	xmlhttp.send();
}

function dico(texte)
{
	var element = document.getElementById('mot');
	element.value+=texte+" ";
}
	
function effacer()
{
	var element = document.getElementById('mot').value;
	var mots = element.split(' ');
	var taille = mots.length;
	var new_mot = "";
	for(i=0;i<taille-2;i++)
	{
		new_mot+=mots[i]+' ';
	}
	document.getElementById('mot').value = new_mot;
}

$(document).ready(function(){

	$(function() {
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
	
	$(function() {
		$( "#dico" ).dialog({
			autoOpen: false,
			resizable: true,
			
			position: "center",
			show: "blind",
			hide: "explode"
		});
	});

});


</script>	

</head>
<body>
<div id="wrapper">
	
	<!-- Bouton de déconnexion -->
	<div style="width:940px; margin-top:5px; position:absolute">
		<?php if ($connecte == true){ ?>	
				<form action="administration" method="post">
					<input style="margin-left:800px"type="submit" name="deconnexion" value="Deconnexion" id="deconnexion" > 
				</form>
		<?php }	?>
	</div>
	<!-- ####################### -->
	<div id="header">
		<div id="logo">
		<a href="<?php echo base_url()?>" ><img src="<?php echo base_url()?>resources/images/marne.png" id="marne"></a>
		<a href="<?php echo PALISEP ; ?>" ><img src="<?php echo base_url()?>resources/images/palisep.png" id="palisep"></a>
	</div>
	</div>
		<!-- Onglets -->
			<div id="menu">
				<ul>
					<li><a></a></li>
					<li><a></a></li>
					<li><?php echo anchor('accueil', 'Accueil');?>
					<li><a></a></li>
					<li><?php echo anchor('recherche', 'Recherche d\'Armes & de Familles ');?></li>
					<li><a></a></li>
					<li><?php echo anchor('recherche_photo', 'Recherche d\'Iconographies');?></li>
					<li><a></a></li>
					<li><?php echo anchor('administration', 'Administration');?></li>
				</ul>
			</div>
		</div>	
	</div>
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
		
<div id="content">		
