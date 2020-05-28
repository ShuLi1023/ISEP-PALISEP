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
		<title>Palisep</title>
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
		
	</head>
	<body>
		<div id="wrapper">
			<div id="page">
				<div id="page-bgtop">
					<div id="page-bgbtm">
						
						<div id="content">		
							
							<!-- IDENTIFICATION-->
							
							<!-- Si l'admin n'est pas connecté-->
							<?php if ($connecte == false) { ?>
								
								<div style="margin: 0;padding:0;">
									<!--<center><h3>Identification</h3></center>-->
									
									<!-- Message d'erreur d'identification -->
									<?php echo $error; ?>
										
										<br/>
										<br/>
										<!-- formulaire de connexion--> 
									<a href="<?php echo PALISEP ; ?>" ><img src="<?php echo base_url()?>resources/images/palisep.png"  style="height:35px; margin-bottom: 0px; margin-left:382px; border: none; "></a>
									<br/>
									<br/>
									<center>
										<div style="width:400px;" >
											<fieldset>
												<legend><strong><font color="#A42903">IDENTIFICATION</font></strong></legend>
												<br />
											
											<form action="" method="post">
											<!-- Champ de saisie du login-->
											<label style="float:left;width:90px;"> Pseudonyme</label><input type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"><br /><br />
											
											<!-- Champ de saisie du password -->
											<label style="float:left;width:90px;"> Mot de passe</label>  <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>">
											
											<br /><br />
											<!-- Bouton Connexion-->
											<center><input type="submit" name="connexion" value="Connexion"></center>
											</form>		
											<br />
											</fieldset>
											</div>
											</center>
											<!-- ####-->
											
											<?php }else{ ?>
											
											<!-- Si l'admin est connecté -->
											<?php header("Location: ".base_url()."administration"); ?> <?php } ?>
											</div>
											
											<!-- fermeture des balises ouvertes dans la vue header.php-->
											<div style="clear: both;">&nbsp;</div>
											</div>
											
											<!-- Menu de Gauche -->
											<div id="sidebar">
											</div>
											<!-- ##### -->
											
											<!-- fermeture des balises ouvertes dans la vue header.php-->
											<div style="clear: both;">&nbsp;</div>
											</div>
											</div>
											</div>
											
											<!-- ##### -->
											</body>
											</html>
											
											
											
																		