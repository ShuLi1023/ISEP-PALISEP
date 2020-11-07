<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
		
				<div id="content">
				
<?php foreach ($donnees as $data) {
 ?>
 <a href="javascript:history.go(-2)">Retour à la liste des résultats d'armes et de familles</a>
 <center>
<h2 class="title"><?php if ($data->patronyme != NULL) { echo ucfirst(mb_strtolower($data->patronyme,'UTF-8'));} else {echo ucfirst(mb_strtolower($data->famille,'UTF-8'));} ?> </h2><br />

<?php foreach($photos as $photo){
?>

<a href="<?php echo base_url()?>legende_photos/photos/<?php echo $photo->id; ?>">
<img height="80px" src="<?php echo base_url() ?>resources/images/<?php echo $photo->libellé_image; ?>.jpg"/>
</a>

<?php
	}
$i=0;?>

</center><br />
	<div class="fiche">
		<div style="float:left;margin-left:2%; width:40%;">
			<strong>ID</strong> : <?php echo $data->id; ?><br /><br />
			<strong>Patronyme</strong> : <?php echo $data->patronyme; ?> <br /><br />
			<strong>Prénom</strong> : <?php echo $data->prenom; ?> <br /><br />
			<strong>Famille</strong> : <?php echo $data->famille; ?> <br /><br />
			<strong>Titres & dignités</strong> : <?php echo $data->titres_dignites; ?> <br /><br />
			<strong>Origine</strong> :<?php echo $data->origine; ?> <br /><br />
			<strong>Alliances</strong> : <?php echo $data->alliances; ?> <br /><br />
			<strong>Date</strong> : <?php echo $data->date; ?><br /><br />
			<strong>Siècle d'extinction de la présence</strong>: <?php echo $data->siècle; ?> <br /><br />
			<strong>Fief</strong> : <?php echo $data->fief; ?> <br /><br />
			<strong>Pays</strong> : <?php echo $data->pays; ?> <br /><br />
			<strong>Province</strong> : <?php echo $data->province; ?> <br /><br />
			<strong>Région</strong> : <?php echo $data->région; ?> <br /><br />
			<strong>Département</strong> : <?php echo $data->départment; ?> <br /><br />
			<strong>Ville</strong> : <?php echo $data->ville; ?> <br /><br />
			<strong>Notes & observations</strong> : <?php echo $data->notes; ?> <br /><br />
			<strong>Généalogie</strong> : <div style="position:relative;left:11%;"><br />
			<?php foreach($genealogies as $genealogie){	
			if ($i==0){?>
			<a href="<?php echo PALISEP ; ?>resources/images/genealogie/<?php echo $genealogie->nom_image; ?>.jpg" rel="lightbox[généalogie]">
			<img ALIGN="middle" style="margin-left:5px;border-width:1px;border-style:ridge;border-color:black;" width="50px" src="<?php echo PALISEP ; ?>resources/images/genealogie/<?php echo $genealogie->nom_image; ?>.jpg"/>					
			</a> 
			<?php
			
			}
			else{?>
				<a href="<?php echo PALISEP ; ?>resources/images/genealogie/<?php echo $genealogie->nom_image; ?>.jpg" rel="lightbox[généalogie]">
				<img ALIGN="middle" style="margin-left:5px;position:absolute;left:<?php echo 4*$i+60;?>px;border-width:1px;border-style:ridge;border-color:black;" width="50px" src="<?php echo PALISEP ; ?>resources/images/genealogie/<?php echo $genealogie->nom_image; ?>.jpg"/>					
				</a> 
				
			<?php }
			$i++;
			} ?>
			</div>
			<br /><br />
			</div>
			<div style="float:right;margin-right:2%; width:40%;">
			<strong>Sources</strong>: <?php echo $data->sources; ?> <br /><br />			
			<strong>Généalogie</strong>: <?php echo $data->genealogie; ?> <br /><br />
			<strong>Document</strong>: <?php echo $data->document; ?> <br /><br />
			<strong>Notes armoriaux</strong>: <?php echo $data->notes_armoriaux; ?> <br /><br />
			<strong>Timbre</strong>: <?php echo $data->timbre; ?> <br /><br />
			<strong>Cimier</strong>: <?php echo $data->cimier; ?> <br /><br />
			<strong>Devise, cri</strong>: <?php echo $data->devise_cri; ?> <br /><br />
			<strong>Tenants, support</strong>: <?php echo $data->tenants_support; ?> <br /><br />
			<strong>Décoration</strong>: <?php echo $data->decoration; ?> <br /><br />
			<strong>Ornements extérieurs</strong>: <?php echo $data->ornements_ext; ?> <br /><br />
			<strong>Emblèmes</strong>: <?php echo $data->emblemes; ?> <br /><br />
			<strong>Notes</strong>: <?php echo $data->notes; ?> <br /><br />
			
			
			<strong>Blasonnements</strong>: <br /><br />
			<ul>		 	
					<?php if (!empty($data->blasonnement_1)){ echo '<li>'.$data->blasonnement_1.'</li>'; }?><br />	
					<?php if (!empty($data->blasonnement_2)){ echo '<li>'.$data->blasonnement_2.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_3)){ echo '<li>'.$data->blasonnement_3.'</li>'; }?><br />					
				</ul>
			</div>
		</div>
	<br />
				
<?php } 
?>

<!-- fermeture des balises ouvertes dans la vue header.php-->
<div style="clear: both;">&nbsp;</div>
</div>

<!-- fermeture des balises ouvertes dans la vue header.php-->
<div style="clear: both;">&nbsp;</div>
</div>
</div>
</div><!-- page -->