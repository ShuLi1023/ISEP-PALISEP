<!-- Si l'administrateur est connecté -->
<?php if ($connecte == true){ ?>

<?php foreach ($donnees as $data) 
{?>
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
<a href="javascript:history.back()">Retour à la liste des résultats d'iconographie</a>
<center>
<h2 class="title"><?php {echo ucfirst(mb_strtolower($data->vedette_chandon,'UTF-8'));} ?> </h2><br />


<a href="<?php echo base_url()?>ressources/images/<?php echo $data->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
<img width="80px" src="<?php echo base_url()?>ressources/images/<?php echo $data->libellé_image; ?>.jpg"/>
</a><br />

<?php foreach($id as $id){
echo anchor('fiche/armorial/'.$id->id, 'Retour à la fiche armes et famille');
} ?>



</center><br />
	<div class="fiche">
	<?php if($data->auteurs!=NULL){?>
		<div style="float:left;margin-left:14%; width:20%;">
			<strong>Pays</strong> : France<br /><br />
			<strong>Région</strong> : <?php echo $data->région; ?><br /><br />
			<strong>Département</strong> : <?php echo $data->départment; ?><br /><br />
			<strong>Commune</strong>: <?php echo $data->commune; ?> <br /><br />
			<strong>Village</strong>: <?php echo $data->village; ?> <br /><br />
			<strong>Edifice de conservation</strong>: <?php echo $data->edifice_conservation; ?> <br /><br />
			<strong>Emplacement dans l'édifice</strong>: <?php echo $data->emplacement_dans_édifice; ?> <br /><br />
			<strong>Numéro artificiel Decrock</strong>:  <?php echo $data->artificial_number_Decrock; ?><br /><br />
			<strong>Numéro INSEE de la commune</strong>: <?php echo $data->commune_INSEE_number; ?> <br /><br />
						
			</div>
			<div style="float:left;margin-left:1%;width:15%;">
			<strong>Famille</strong>:  <?php echo $data->famille; ?><br /><br />
			<strong>Individu</strong>:  <?php echo $data->individu; ?><br /><br />
			<strong>Qualité</strong>:  <?php echo $data->qualité; ?><br /><br />
			<strong>Date</strong>:  <?php echo $data->date; ?><br /><br />
			<strong>Dénomination</strong>:  <?php echo $data->dénomination; ?><br /><br />
			<strong>Catégorie</strong>:  <?php echo $data->catégorie; ?><br /><br />
			<strong>Matériau</strong>:  <?php echo $data->matériau; ?><br /><br />
			<strong>Bibliographie</strong>:  <?php echo $data->biblio; ?><br /><br />
			</div>
			
			<div style="float:left; margin-left:1%;width:17%;">
			<strong>Référence de la reproduction</strong>:  <?php echo $data->ref_reproductions; ?><br /><br />
			<strong>Auteur du cliché</strong>: <?php echo $data->auteur_cliché; ?> <br /><br />
			<strong>Type du cliché</strong> :<?php echo $data->type_cliché; ?> <br /><br />
			<strong>Année du cliché</strong> : <?php echo $data->année_cliché; ?><br /><br />
			<strong>Type de photo</strong>: <?php echo $data->photo; ?> <br /><br />
			<strong>Référence IM</strong>: <?php echo $data->ref_IM; ?> <br /><br />
			<strong>Référence PA</strong>: <?php echo $data->ref_PA; ?> <br /><br />
			<strong>Référence IA</strong>: <?php echo $data->ref_IA; ?> <br /><br />
			</div>
			<div style="float:left; margin-left:1%;width:20%;">
		
			<strong>Auteur(s)</strong>:  <?php echo $data->auteurs; ?><br /><br />
			<strong>Titre</strong>:  <?php echo $data->titre; ?><br /><br />
			<strong>Lieu d'édition</strong>:  <?php echo $data->lieu_édition; ?><br /><br />
			<strong>Editeur</strong>:  <?php echo $data->editeur; ?></strong><br /><br />
			<strong>Année d'édition</strong>:  <?php echo $data->année_édition; ?><br /><br />
			<strong>Reliure</strong>:  <?php echo $data->reliure; ?><br /><br />
			<strong>Provenance</strong>:  <?php echo $data->provenance; ?><br /><br />
			<strong>Site</strong>:  <?php echo $data->site; ?><br /><br />
			<strong>Section</strong>:  <?php echo $data->section; ?><br /><br />
			<strong>Cote</strong>:  <?php echo $data->cote; ?><br /><br />
			<strong>Folio ou emplacement</strong>:  <?php echo $data->folio_emplacement; ?><br /><br />
		
		</div>
		<?php }
		else {?>
		<div style="float:left;margin-left:20%; width:%;">
			<strong>Pays</strong> : France<br /><br />
			<strong>Région</strong> : <?php echo $data->région; ?><br /><br />
			<strong>Département</strong> : <?php echo $data->départment; ?><br /><br />
			<strong>Commune</strong>: <?php echo $data->commune; ?> <br /><br />
			<strong>Village</strong>: <?php echo $data->village; ?> <br /><br />
			<strong>Edifice de conservation</strong>: <?php echo $data->edifice_conservation; ?> <br /><br />
			<strong>Emplacement dans l'édifice</strong>: <?php echo $data->emplacement_dans_édifice; ?> <br /><br />
			<strong>Numéro artificiel Decrock</strong>:  <?php echo $data->artificial_number_Decrock; ?><br /><br />
			<strong>Numéro INSEE de la commune</strong>: <?php echo $data->commune_INSEE_number; ?> <br /><br />
						
			</div>
			<div style="float:left;margin-left:1%;width:20%;">
			<strong>Famille</strong>:  <?php echo $data->famille; ?><br /><br />
			<strong>Individu</strong>:  <?php echo $data->individu; ?><br /><br />
			<strong>Qualité</strong>:  <?php echo $data->qualité; ?><br /><br />
			<strong>Date</strong>:  <?php echo $data->date; ?><br /><br />
			<strong>Dénomination</strong>:  <?php echo $data->dénomination; ?><br /><br />
			<strong>Titre</strong>:  <?php echo $data->titre; ?><br /><br />
			<strong>Catégorie</strong>:  <?php echo $data->catégorie; ?><br /><br />
			<strong>Matériau</strong>:  <?php echo $data->matériau; ?><br /><br />
			<strong>Bibliographie</strong>:  <?php echo $data->biblio; ?><br /><br />
			</div>
			
			<div style="float:left; margin-left:1%;width:20%;">
			<strong>Référence de la reproduction</strong>:  <?php echo $data->ref_reproductions; ?><br /><br />
			<strong>Auteur du cliché</strong>: <?php echo $data->auteur_cliché; ?> <br /><br />
			<strong>Type du cliché</strong> :<?php echo $data->type_cliché; ?> <br /><br />
			<strong>Année du cliché</strong> : <?php echo $data->année_cliché; ?><br /><br />
			<strong>Type de photo</strong>: <?php echo $data->photo; ?> <br /><br />
			<strong>Référence IM</strong>: <?php echo $data->ref_IM; ?> <br /><br />
			<strong>Référence PA</strong>: <?php echo $data->ref_PA; ?> <br /><br />
			<strong>Référence IA</strong>: <?php echo $data->ref_IA; ?> <br /><br />
			</div>
		<?php }?>
			
		</div>
	<br />
				
<?php }
	
?>
<?php }else{ ?>
<!-- Si l'admin n'est pas connecté on le renvoit sur la page identification -->
	<?php header("Location: ".base_url().'administration/identification'); ?>
<?php } ?>
