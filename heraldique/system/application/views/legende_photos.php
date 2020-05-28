<!-- Si l'administrateur est connecté -->
<?php if ($connecte == true){ ?>

<?php foreach ($donnees as $data) 
{?>

<a href="javascript:history.back()">Retour à la liste des résultats d'iconographie</a>
<center>
<h2 class="title"><?php {echo ucfirst(mb_strtolower($data->vedette_chandon,'UTF-8'));} ?> </h2><br />


<a href="<?php echo PALISEP ; ?>resources/images/<?php echo $data->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
<img width="80px" src="<?php echo PALISEP ; ?>resources/images/<?php echo $data->libellé_image; ?>.jpg"/>
</a><br />

<?php foreach($id as $id){
echo anchor('fiche/armorial/'.$id->id, 'Retour à la fiche armes et famille');
} ?>



</center><br />
	<div class="fiche">
	<?php if($data->auteurs!=NULL){?>
		<div style="float:left;margin-left:25%; width:23%;">
			
			<strong>Pays</strong> : <?php echo $data->pays; ?><br /><br />
			<strong>Région</strong> : <?php echo $data->région; ?><br /><br />
			<strong>Département</strong> : <?php echo $data->départment; ?><br /><br />
			<strong>Commune</strong>: <?php echo $data->commune; ?> <br /><br />
			<!--<strong>Village</strong>: <?php echo $data->village; ?> <br /><br />-->
			<strong>Edifice de conservation</strong>: <?php echo $data->edifice_conservation; ?> <br /><br />
			<!--<strong>Emplacement dans l'édifice</strong>: <?php echo $data->emplacement_dans_édifice; ?> <br /><br />
			<strong>Numéro artificiel Decrock</strong>:  <?php echo $data->artificial_number_Decrock; ?><br /><br />
			<strong>Numéro INSEE de la commune</strong>: <?php echo $data->commune_INSEE_number; ?> <br /><br />-->
						
			<!--</div>
			<div style="float:left;margin-left:1%;width:15%;">-->
			<strong>Famille / Institution</strong>:  <?php echo $data->famille; ?><br /><br />
			<strong>Individu</strong>:  <?php echo $data->individu; ?><br /><br />
			<strong>Qualité</strong>:  <?php echo $data->qualité; ?><br /><br />
			<!--<strong>Date</strong>:  <?php echo $data->date; ?><br /><br />
			<strong>Dénomination</strong>:  <?php echo $data->dénomination; ?><br /><br />
			<strong>Catégorie</strong>:  <?php echo $data->catégorie; ?><br /><br />
			<strong>Matériau</strong>:  <?php echo $data->matériau; ?><br /><br />-->
			<strong>Bibliographie</strong>:  <?php echo $data->biblio; ?><br /><br />
			</div>
											
			<div style="float:left; margin-left:4%;width:20%;">
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
		
			<div style="float:left; margin-left:1%;width:17%;>
			<a href="" onclick="javascript:visibilite('id_div_1'); return false;" ><strong><u>Référence de reproduction</u></strong></a><br /><br />
			<div id="id_div_1" style="display:none;">
			<strong>ID</strong> : <?php echo $data->id; ?><br /><br />
			<strong>Référence de la reproduction</strong>:  <?php echo $data->ref_reproductions; ?><br /><br />
			<strong>Auteur du cliché</strong>: <?php echo $data->auteur_cliché; ?> <br /><br />
			<strong>Type du cliché</strong> :<?php echo $data->type_cliché; ?> <br /><br />
			<strong>Année du cliché</strong> : <?php echo $data->année_cliché; ?><br /><br />
			<strong>Type de photo</strong>: <?php echo $data->photo; ?> <br /><br />
			<strong>Référence IM</strong>: <?php echo $data->ref_IM; ?> <br /><br />
			<strong>Référence PA</strong>: <?php echo $data->ref_PA; ?> <br /><br />
			<strong>Référence IA</strong>: <?php echo $data->ref_IA; ?> <br /><br />
			</div>
			</div>
			
		<?php }
		else {?>
		<div style="float:left;margin-left:27%; width:23%;">
			
			<strong>Pays</strong> : <?php echo $data->pays; ?><br /><br />
			<strong>Région</strong> : <?php echo $data->région; ?><br /><br />
			<strong>Département</strong> : <?php echo $data->départment; ?><br /><br />
			<strong>Commune</strong>: <?php echo $data->commune; ?> <br /><br />
			<!--<strong>Village</strong>: <?php echo $data->village; ?> <br /><br />-->
			<strong>Edifice de conservation</strong>: <?php echo $data->edifice_conservation; ?> <br /><br />
			<!--<strong>Emplacement dans l'édifice</strong>: <?php echo $data->emplacement_dans_édifice; ?> <br /><br />
			<strong>Numéro artificiel Decrock</strong>:  <?php echo $data->artificial_number_Decrock; ?><br /><br />
			<strong>Numéro INSEE de la commune</strong>: <?php echo $data->commune_INSEE_number; ?> <br /><br />-->
						
			</div>
			<div style="float:left;margin-left:0.1%;width:20%;">
			<strong>Famille / Institution</strong>:  <?php echo $data->famille; ?><br /><br />
			<strong>Individu</strong>:  <?php echo $data->individu; ?><br /><br />
			<strong>Qualité</strong>:  <?php echo $data->qualité; ?><br /><br />
			<!--<strong>Date</strong>:  <?php echo $data->date; ?><br /><br />
			<strong>Dénomination</strong>:  <?php echo $data->dénomination; ?><br /><br />
			<strong>Titre</strong>:  <?php echo $data->titre; ?><br /><br />
			<strong>Catégorie</strong>:  <?php echo $data->catégorie; ?><br /><br />
			<strong>Matériau</strong>:  <?php echo $data->matériau; ?><br /><br />-->
			<strong>Bibliographie</strong>:  <?php echo $data->biblio; ?><br /><br />
			</div>
			
			<div style="float:left; margin-left:1%;width:17%;">
			<a href="#" onclick="javascript:visibilite('id_div_1'); return false;" ><strong><u>Référence de reproduction</u></strong></a><br /><br />
			<div id="id_div_1" style="display:none;">
			<strong>ID</strong> : <?php echo $data->id; ?><br /><br />
			<strong>Référence de la reproduction</strong>:  <?php echo $data->ref_reproductions; ?><br /><br />
			<strong>Auteur du cliché</strong>: <?php echo $data->auteur_cliché; ?> <br /><br />
			<strong>Type du cliché</strong> :<?php echo $data->type_cliché; ?> <br /><br />
			<strong>Année du cliché</strong> : <?php echo $data->année_cliché; ?><br /><br />
			<strong>Type de photo</strong>: <?php echo $data->photo; ?> <br /><br />
			<strong>Référence IM</strong>: <?php echo $data->ref_IM; ?> <br /><br />
			<strong>Référence PA</strong>: <?php echo $data->ref_PA; ?> <br /><br />
			<strong>Référence IA</strong>: <?php echo $data->ref_IA; ?> <br /><br />
			</div>
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
