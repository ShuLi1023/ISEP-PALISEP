﻿<!-- Si l'administrateur est connecté -->
<?php if ($connecte == true){ ?>
<!--
<div style="float:left;">
<img src="<?php echo base_url()?>ressources/images/Aix-en-Othe002=Hennequin.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Berulle004=France.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Brienne-le-Chateau001=Roffey.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Chaource045=Monstier.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/La-Motte-Tilly005=Terray.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Chaource045=Monstier.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/La-Motte-Tilly005=Terray.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Chaource-Part-006=Damoiseau.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Chauchigny001=Arnoult.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Chavanges003=Dauphin.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Cussangy015=Monstier.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Dienville002=Habsbourg.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Foucheres003=Amoncourt.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/La-Chaise001=Bury.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Maizieres-les-Brienne001 =France.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Poivres001=Crespy.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Rosnay-l-Hopital010=Marmier.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Rumilly-les-Vaudes016=Vendome.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Saint-Pouange003=Menisson.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-AD-007=Raigecourt.jpg" height="50px" width="40px"/><br />
</div>
<div style="float:right;">
<img src="<?php echo base_url()?>ressources/images/Estissac001=La-Rochefoucauld.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Rosnay-l-Hopital011=Loys.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-XIX-003=Hennequin.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Chaource-Part-006=Damoiseau.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-mediatheque-017=Mole.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Chaource045=Monstier.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-cathedrale-023=Bareton.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-cathedrale-049=Dufour.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-cathedrale-240=Pyon-Festuot.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-I-007=Bersat.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-II-050=Clerey-Mole.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-II-058=Maillet-Vigneron.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-II-110=Maillet-Maison.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-IV-068=NI-NI.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-mediatheque-016=Du-Plessis.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-Part-013=Bauffremont.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-VI-004=Champagne-Navarre.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-VII-013=Troyes.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-VII-031=Pleurre.jpg" height="50px" width="40px"/><br />
<img src="<?php echo base_url()?>ressources/images/Troyes-XIX-005=Blampignon.jpg" height="50px" width="40px"/><br />
</div>
-->
<?php foreach ($donnees as $data) {
 ?>
 <a href="javascript:history.go(-1)">Retour à la liste des résultats d'armes et de familles</a>
 <center>
<h2 class="title"><?php {echo strtr(ucwords(mb_strtolower($data->patronyme,'UTF-8'))," De "," de ");} ?> </h2><br />

<?php foreach($photos as $photo){
?>

<a href="<?php echo base_url()?>legende_photos/photos/<?php echo $photo->id; ?>" target="_blank">
<img height="80px" src="<?php echo base_url()?>ressources/images/<?php echo $photo->libellé_image; ?>.jpg"/>
</a>

<?php
	}
$i=0;?>

</center><br />
	<div class="fiche">
		<div style="float:left;margin-left:2%; width:40%;">
			<strong>ID</strong> : <?php echo $data->id; ?><br /><br />
			<strong>Patronyme</strong>: <?php echo $data->patronyme; ?> <br /><br />
			<strong>Origine</strong> :<?php echo $data->origine; ?> <br /><br />
			<strong>Date</strong> : <?php echo $data->date; ?><br /><br />
			<strong>Siècle d'extinction de la présence</strong>: <?php echo $data->siècle; ?> <br /><br />
			<strong>Fief</strong>: <?php echo $data->fief; ?> <br /><br />
			<strong>Département</strong>: <?php echo $data->départment; ?> <br /><br />
			<strong>Région</strong>: <?php echo $data->région; ?> <br /><br />
			<strong>Alliances</strong>: <?php echo $data->alliances; ?> <br /><br />
			<strong>Généalogie</strong>: <div style="position:relative;left:11%;"><br />
			<?php foreach($genealogies as $genealogie){	
			if ($i==0){?>
			<a href="<?php echo base_url()?>ressources/images/genealogie/<?php echo $genealogie->nom_image; ?>.jpg" rel="lightbox[généalogie]">
			<img ALIGN="middle" style="margin-left:5px;border-width:1px;border-style:ridge;border-color:black;" width="50px" src="<?php echo base_url()?>ressources/images/genealogie/<?php echo $genealogie->nom_image; ?>.jpg"/>					
			</a> 
			<?php
			
			}
			else{?>
				<a href="<?php echo base_url()?>ressources/images/genealogie/<?php echo $genealogie->nom_image; ?>.jpg" rel="lightbox[généalogie]">
				<img ALIGN="middle" style="margin-left:5px;position:absolute;left:<?php echo 4*$i+60;?>px;border-width:1px;border-style:ridge;border-color:black;" width="50px" src="<?php echo base_url()?>ressources/images/genealogie/<?php echo $genealogie->nom_image; ?>.jpg"/>					
				</a> 
				
			<?php }
			$i++;
			} ?>
			</div>
			<br /><br />
			
			<strong>Armoiries</strong>: <?php echo $data->armoiries; ?> <br /><br />
			<strong>Notes</strong>: <?php echo $data->notes; ?> <br /><br />
			<strong>Le Clert</strong>: <?php echo $data->le_clert; ?> <br /><br />
			<strong>Armorial général de Champagne</strong>: <?php echo $data->champ; ?> <br /><br />
			<strong>Notes sur les armoriaux</strong>: <?php echo $data->not_armor; ?> <br /><br />
			
			</div>
			<div style="float:right;margin-right:2%; width:40%;">
			<strong>Blasonnements</strong>: <br /><br />
			<ul>		 	
					<?php if (!empty($data->blasonnement_1)){ echo '<li>'.$data->blasonnement_1.'</li>'; }?><br />	
					<?php if (!empty($data->blasonnement_2)){ echo '<li>'.$data->blasonnement_2.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_3)){ echo '<li>'.$data->blasonnement_3.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_4)){ echo '<li>'.$data->blasonnement_4.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_5)){ echo '<li>'.$data->blasonnement_3.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_6)){ echo '<li>'.$data->blasonnement_3.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_7)){ echo '<li>'.$data->blasonnement_3.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_8)){ echo '<li>'.$data->blasonnement_4.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_9)){ echo '<li>'.$data->blasonnement_3.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_10)){ echo '<li>'.$data->blasonnement_3.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_11)){ echo '<li>'.$data->blasonnement_3.'</li>'; }?><br />	
					<?php if (!empty($data->blasonnement_12)){ echo '<li>'.$data->blasonnement_3.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_13)){ echo '<li>'.$data->blasonnement_3.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_14)){ echo '<li>'.$data->blasonnement_3.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_15)){ echo '<li>'.$data->blasonnement_4.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_16)){ echo '<li>'.$data->blasonnement_3.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_17)){ echo '<li>'.$data->blasonnement_3.'</li>'; }?><br />
					<?php if (!empty($data->blasonnement_18)){ echo '<li>'.$data->blasonnement_3.'</li>'; }?><br />						
				</ul>
			</div>
		</div>
	<br />
				
<?php } 
?>
<?php }else{ ?>
<!-- Si l'admin n'est pas connecté on le renvoit sur la page identification -->
	<?php header("Location: ".base_url().'administration/identification'); ?>
<?php } ?>
