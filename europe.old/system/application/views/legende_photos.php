<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
		
				<div id="content">
<!-- Si l'administrateur est connecté -->

<?php foreach ($donnees as $data) 
{?>

<a href="javascript:history.back()">Retour à la liste des résultats d'iconographie</a>
<center>
<h2 class="title"><?php {echo ucfirst(mb_strtolower($data->vedette_chandon,'UTF-8'));} ?> </h2><br />


<a href="<?php echo base_url() ?>resources/images/<?php echo $data->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
<img width="80px" src="<?php echo base_url() ?>resources/images/<?php echo $data->libellé_image; ?>.jpg"/>
</a><br />

<?php foreach($id as $id){
echo anchor('fiche/armorial/'.$id->id, 'Retour à la fiche armes et famille ');
} ?>



</center><br />
	<div class="fiche">
	<?php if($data->auteurs!=NULL){?>
		<div style="float:left;margin-left:14%; width:20%;">
			<strong>ID</strong> : <?php echo $data->id; ?><br /><br />
			<strong>Pays</strong> : <?php echo $data->pays; ?><br /><br />
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
			<strong>Famille / Institution</strong>:  <?php echo $data->famille; ?><br /><br />
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
		<div style="float:left;margin-left:24px; margin-right:24px; width:29%;">
			
			<strong>Pays</strong> : <?php echo $data->pays; ?><br /><br />
			<strong>Région</strong> : <?php echo $data->région; ?><br /><br />
			<strong>Département</strong> : <?php echo $data->départment; ?><br /><br />
			<strong>Commune</strong>: <?php echo $data->commune; ?> <br /><br />
			<strong>Village</strong>: <?php echo $data->village; ?> <br /><br />
			<strong>Edifice de conservation</strong>: <?php echo $data->edifice_conservation; ?> <br /><br />
			<strong>Emplacement dans l'édifice</strong>: <?php echo $data->emplacement_dans_édifice; ?> <br /><br />
			<strong>Numéro artificiel Decrock</strong>:  <?php echo $data->artificial_number_Decrock; ?><br /><br />
			<strong>Numéro INSEE de la commune</strong>: <?php echo $data->commune_INSEE_number; ?> <br /><br />
						
			</div>
			<div style="float:left;margin-right:30px;width:29%;">
			<strong>Famille / Institution</strong>:  <?php echo $data->famille; ?><br /><br />
			<strong>Individu</strong>:  <?php echo $data->individu; ?><br /><br />
			<strong>Qualité</strong>:  <?php echo $data->qualité; ?><br /><br />
			<strong>Date</strong>:  <?php echo $data->date; ?><br /><br />
			<strong>Dénomination</strong>:  <?php echo $data->dénomination; ?><br /><br />
			<strong>Titre</strong>:  <?php echo $data->titre; ?><br /><br />
			<strong>Catégorie</strong>:  <?php echo $data->catégorie; ?><br /><br />
			<strong>Matériau</strong>:  <?php echo $data->matériau; ?><br /><br />
			<strong>Bibliographie</strong>:  <?php echo $data->biblio; ?><br /><br />
			</div>
			
			<div style="float:left; width:29%;">
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


<!-- fermeture des balises ouvertes dans la vue header.php-->
<div style="clear: both;">&nbsp;</div>
</div>

<!-- fermeture des balises ouvertes dans la vue header.php-->
<div style="clear: both;">&nbsp;</div>
</div>
</div>
</div><!-- page -->
