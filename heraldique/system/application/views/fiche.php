<!-- Si l'administrateur est connecté -->
<?php if ($connecte == true){ ?>

<?php foreach ($donnees as $data) {
 ?>
 <a href="javascript:history.back()">Retour à la liste des résultats d'armes et de familles</a>
 <center>
<h2 class="title"><?php { 
                        if ($data->patronyme != NULL) { echo ucfirst(mb_strtolower($data->patronyme,'UTF-8'));} else {echo ucfirst(mb_strtolower($data->famille,'UTF-8'));}} ?> </h2><br />

<?php foreach($photos as $photo){
?>

<a href="<?php echo base_url()?>legende_photos/photos/<?php echo $photo->id; ?>">
<img height="80px" src="<?php echo PALISEP ; ?>resources/images/<?php echo $photo->libellé_image; ?>.jpg"/>
</a>

<?php
	}
$i=0;?>

</center><br />
	<div class="fiche">
		<div style="float:left;margin-left:10%; width:30%;text-align: justify;">
			<strong>ID</strong> : <?php echo $data->id; ?><br /><br />
<?php
                        if ($data->patronyme != NULL) { ?>
			<strong>Patronyme</strong>: <?php echo $data->patronyme; ?> <br /><br />
<?php }
else {  ?> <strong>Famille</strong>: <?php echo $data->famille; ?> <br /><br />
<?php }?>
            
            <strong>Prénom</strong> : <?php echo $data->prenom; ?> <br /><br />
            <strong>Titres/dignités</strong> : <?php echo $data->titres_dignites; ?> <br /><br />

            <strong>Origine</strong> : <?php echo $data->origine; ?> <br /><br />
			<strong>Date</strong> : <?php echo $data->date; ?><br /><br />
			<strong>Période de présence</strong>: <?php echo $data->siècle; ?> <br /><br />
			<strong>Fief</strong>: <?php echo $data->fief; ?> <br /><br />
			<strong>Département</strong>: <?php echo $data->départment; ?> <br /><br />
			<strong>Région</strong>: <?php echo $data->région; ?> <br /><br />
			<strong>Alliances</strong>: <?php echo $data->alliances; ?> <br /><br />
			<strong>Généalogie</strong>: <div style="position:relative;left:11%;"><br />
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
                        <strong>Références / Bibliographie</strong>: <?php echo $data->ref_biblio; ?><br /><br />
			
			</div>
			<div style="float:right;margin-right:10%; width:30%;text-align: justify;">
			<strong>Blasonnements</strong>: <br /><br />
			<ul>		 	
					<?php if (!empty($data->blasonnement_1)){ $blasonnement= str_replace("_", ";", $data->blasonnement_1); echo '<li>'.$blasonnement.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_2)){ echo '<li>'.$data->blasonnement_2.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_3)){ echo '<li>'.$data->blasonnement_3.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_4)){ echo '<li>'.$data->blasonnement_4.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_5)){ echo '<li>'.$data->blasonnement_3.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_6)){ echo '<li>'.$data->blasonnement_3.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_7)){ echo '<li>'.$data->blasonnement_3.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_8)){ echo '<li>'.$data->blasonnement_4.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_9)){ echo '<li>'.$data->blasonnement_3.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_10)){ echo '<li>'.$data->blasonnement_3.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_11)){ echo '<li>'.$data->blasonnement_3.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_12)){ echo '<li>'.$data->blasonnement_3.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_13)){ echo '<li>'.$data->blasonnement_3.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_14)){ echo '<li>'.$data->blasonnement_3.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_15)){ echo '<li>'.$data->blasonnement_4.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_16)){ echo '<li>'.$data->blasonnement_3.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_17)){ echo '<li>'.$data->blasonnement_3.'</li><br />'; }?>
					<?php if (!empty($data->blasonnement_18)){ echo '<li>'.$data->blasonnement_3.'</li><br />'; }?>
				</ul><br />
                                <strong>Cimiers/Ornements extérieurs</strong>:<?php echo $data->cimiers; ?><br /><br />
                                <strong>Devise/Légende</strong>:<?php echo $data->devise; ?><br /><br />
                                <strong>Lambrequins</strong>:<?php echo $data->lambrequins; ?><br /><br />
                                <strong>Support</strong>:<?php echo $data->support; ?>
			</div>
		</div>
	<br />
	
	    <fieldset style='background-color:white; float:right;margin-right:10%;text-align: justify; margin-top:30px;'>		
		  <legend><strong><font color="#A42903"><a href='#arm' onclick='visibilite("arm");'>>>Modification contenu</a></font></strong></legend><br />
	        <div id='arm' style='display:none;width:840px;'>
	           
		<?php 		$id = "a_".$data['id']; 
		
		echo $data['id'];
		
		?> 	
				   
			 <a href='#' onclick="getFiche(<?php echo $data->id; ?>,'armorial');return false;" title=<?php echo $data['id']; ?>>Modifier la fiche <?php echo $data->id; ?></a>
			
        </div><br /><br />
		  </fieldset>
				
<?php } 
?>
<?php }else{ ?>
<!-- Si l'admin n'est pas connecté on le renvoit sur la page identification -->
	<?php header("Location: ".base_url().'administration/identification'); ?>
<?php } ?>
	