<!-- Si l'administrateur est connecté -->
<?php if ($connecte == true ){ ?>

<!-- Verification statut admin-->
<?php if ($_SESSION['statut'] == 1 ){ ?>

<div style="float:left;">
<img src="<?php echo PALISEP ; ?>resources/images/Aix-en-Othe002=Hennequin.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Berulle004=France.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Brienne-le-Chateau001=Roffey.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Chaource045=Monstier.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/La-Motte-Tilly005=Terray.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Chaource045=Monstier.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/La-Motte-Tilly005=Terray.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Chaource-Part-006=Damoiseau.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Chauchigny001=Arnoult.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Chavanges003=Dauphin.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Cussangy015=Monstier.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Dienville002=Habsbourg.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Foucheres003=Amoncourt.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/La-Chaise001=Bury.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Maizieres-les-Brienne001 =France.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Poivres001=Crespy.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Rosnay-l-Hopital010=Marmier.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Rumilly-les-Vaudes016=Vendome.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Saint-Pouange003=Menisson.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-AD-007=Raigecourt.jpg" height="50px" width="40px"/><br />
</div>

<div style="float:right;">
<img src="<?php echo PALISEP ; ?>resources/images/Estissac001=La-Rochefoucauld.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Rosnay-l-Hopital011=Loys.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-XIX-003=Hennequin.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Chaource-Part-006=Damoiseau.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-mediatheque-017=Mole.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Chaource045=Monstier.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-cathedrale-023=Bareton.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-cathedrale-049=Dufour.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-cathedrale-240=Pyon-Festuot.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-I-007=Bersat.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-II-050=Clerey-Mole.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-II-058=Maillet-Vigneron.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-II-110=Maillet-Maison.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-IV-068=NI-NI.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-mediatheque-016=Du-Plessis.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-Part-013=Bauffremont.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-VI-004=Champagne-Navarre.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-VII-013=Troyes.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-VII-031=Pleurre.jpg" height="50px" width="40px"/><br />
<img src="<?php echo PALISEP ; ?>resources/images/Troyes-XIX-005=Blampignon.jpg" height="50px" width="40px"/><br />
</div>

<div class="corps">	

<h3><center>Espace d'administration</center></h3>

<br /><br /><br />

<!-- Partie pour changer le mot de passe d'accès -->
<fieldset>
	<legend><strong><font color="#A42903"><?php echo htmlentities("Modification des codes d'accès"); ?></font></strong></legend><br />
	<?php if($acces=="")
	{ ?>
	<form method="post" action="">
		<label style="float:left;width:190px;" for="login">Login :</label><input type="text" name="login" id="login" /><br /><br />
		<label style="float:left;width:190px;" for="mdp_actuel">Mot de passe actuel :</label><input type="password" name="mdp_actuel" id="mdp_actuel" /><br /><br />
		<input type="submit" name="submit" value="Valider" />
	</form>
	<?php 
	} 
	else if($acces=="true")
	{?>
	<form method="post" action="">
		<label style="float:left;width:190px;" for="new_mdp">Nouveau mot de passe :</label><input type="password" name="new_mdp" id="new_mdp" /><br /><br />
		<label style="float:left;width:190px;" for="new_mdp_bis">Saisissez de nouveau :</label><input type="password" name="new_mdp_bis" id="new_mdp_bis" /><br /><br />
		<input type="submit" name="submit" value="Valider" />
	</form>
	<?php
	}
	else
	{
		echo $acces;
	?>
	<h4><a href="javascript:history.back()"><<< Retour sur le formulaire </a></h4>
	<?php 
	} ?>
</fieldset>
<br /><br />

<!-- Partie de mise a jour de la base (insertion de fichiers excel) -->
<fieldset>
	<legend><strong><font color="#A42903"><?php echo htmlentities('Mise à jour de la base'); ?></font></strong></legend><br />
	
	<?php if(!isset($_FILES['mediatheque']) && !isset($_FILES['familles']) && !isset($_FILES['images']) && !isset($_FILES['not_mediatheque'])){ ?>
		<form method="post" action="" enctype="multipart/form-data">
			<label style="float:left;width:190px;" for="mediatheque"><?php echo htmlentities('Médiathèque'); ?> :</label>
			<input type="file" name="mediatheque" id="mediatheque" />
			<input type="submit" name="submit" value="Ajouter" />
		</form>
		<form method="post" action="" enctype="multipart/form-data">
			<label style="float:left;width:190px;" for="not_mediatheque"><?php echo htmlentities('Tout sauf médiathèque'); ?> :</label>
			<input type="file" name="not_mediatheque" id="not_mediatheque" />
			<input type="submit" name="submit" value="Ajouter" />
		</form>
		<form method="post" action="" enctype="multipart/form-data">
			<label style="float:left;width:190px;" for="familles">Familles :</label>
			<input type="file" name="familles" id="familles" />
			<input type="submit" name="submit" value="Ajouter" />
		</form>
		<form method="post" action="" enctype="multipart/form-data">	
			<label style="float:left;width:190px;" for="images">Images (fichier image ou dossier .zip):</label>
			<input type="file" name="images" id="images" />
			<input type="submit" name="submit" value="Ajouter" /><br /></br>
		</form>
	<?php } else{ 
		echo $transfert; ?>
		<h4><a href="javascript:history.back()"><<< Retour sur le formulaire </a></h4>
	<?php
		}
	?>
</fieldset><br /><br />

<?php } ?>

<!--Partie de modification des données de la base-->
<fieldset>
	<legend><strong><font color="#A42903"><?php echo htmlentities('Modification des données de la base'); ?></font></strong></legend><br />

	<h3><center><a href='#armorial' onclick='visibilite("armorial");'>Armorial/Familles</a></center></h3><br />
	
	<div id='armorial' style='display:block;width:1000px;overflow:auto;'><table border='1' style="border-collapse:collapse;">
		<tr>
			<th>Patronyme</th>
			<th>Origine (Ville)</th>
			<th>Origine (Province ou territoire)</th>

			<th><?php echo htmlentities('Prénom');?></th>
			<th><?php echo htmlentities('Titres et dignités');?></th>

			<th>Date</th>

			<th><?php echo htmlentities('Siècle');?></th>

			<th>Sources</th>
			<th>Observations</th>

			<th><?php echo htmlentities('Généalogie');?></th>

			<th>Document (support et illustrations)</th>
			<th>Ecu</th>
			<th>Timbre</th>
			<th>Cimier</th>
			<th>Devise/cri</th>
			<th>Tenants/Support</th>

			<th><?php echo htmlentities('Orde/Décoration');?></th>

			<th>Autres ornements</th>

			<th><?php echo htmlentities('Emblèmes');?></th>
			<th><?php echo htmlentities('Fichiers images généalogie');?></th>

			<th>Fichiers images documents</th>
		</tr>
		<?php foreach($donnees_armorial as $data1) { ?>
		<tr>
			<td><a href='#'  onclick="getFiche(<?php echo $data1['id']; ?>,'armorial');return false;" title=<?php echo $data1['id']; ?>><?php if (!empty($data1['patronyme'])){ echo $data1['patronyme']; }?></a></td>
			<td><?php if (!empty($data1['ville'])){ echo $data1['ville']; }?></td>
			<td><?php if (!empty($data1['province'])){ echo $data1['province']; }?></td>
			<td><?php if (!empty($data1['prenom'])){ echo $data1['prenom']; }?></td>
			<td><?php if (!empty($data1['titres_dignites'])){ echo $data1['titres_dignites']; }?></td>
			<td><?php if (!empty($data1['date'])){ echo $data1['date']; }?></td>
			<td><?php if (!empty($data1['sources'])){ echo $data1['sources']; }?></td>
			<td><?php if (!empty($data1['siecle'])){ echo $data1['siecle']; }?></td>
			<td><?php if (!empty($data1['observations'])){ echo $data1['observations']; }?></td>
			<td><?php if (!empty($data1['genealogie'])){ echo $data1['genealogie']; }?></td>
			<td><?php if (!empty($data1['document'])){ echo $data1['document']; }?></td>
			<td><?php if (!empty($data1['ecu'])){ echo $data1['ecu']; }?></td>
			<td><?php if (!empty($data1['timbre'])){ echo $data1['timbre']; }?></td>
			<td><?php if (!empty($data1['cimier'])){ echo $data1['cimier']; }?></td>
			<td><?php if (!empty($data1['devise_cri'])){ echo $data1['devise_cri']; }?></td>
			<td><?php if (!empty($data1['tenants_support'])){ echo $data1['tenants_support']; }?></td>
			<td><?php if (!empty($data1['decoration'])){ echo $data1['decoration']; }?></td>
			<td><?php if (!empty($data1['ornements_ext'])){ echo $data1['ornements_ext']; }?></td>
			<td><?php if (!empty($data1['emblemes'])){ echo $data1['emblemes']; }?></td>
			<td><?php if (!empty($data1['images_geneal'])){ echo $data1['images_geneal']; }?></td>
			<td><?php if (!empty($data1['images_doc'])){ echo $data1['images_doc']; }?></td>
		</tr>
		<?php } ?>
	</table>
	<br />
	<?php echo $pages_armorial;?>
	</div><br /><br /><br />
	
	<h3><center><a href='#photos' onclick='visibilite("photos");'>Objets/livres</a></center></h3><br />
	
	<div id='photos' style='display:block;width:1000px;overflow:auto;'><table border='1' style="border-collapse:collapse; width:100%;">
		<tr>
			<th><?php echo htmlentities('Libellé image'); ?></th>
			<th>Vedette armorial</th>
			<th><?php echo htmlentities('Auteur Cliché'); ?></th>
			<th><?php echo htmlentities('Type cliché'); ?></th>
			<th><?php echo htmlentities('Année du cliché'); ?></th>
			<th>Commune</th>
			<th>Edifice de conservation</th>
			<th>Emplacement</th>
			<th>Photo</th>
			<th><?php echo htmlentities('N° INSEE'); ?></th>
			<th>Ref. IM</th>
			<th>Ref. PA</th>
			<th>Ref. IA</th>
			<th><?php echo htmlentities('N° Art. Decroc'); ?></th>
			<th>Famille</th>
			<th>Individu</th>
			<th><?php echo htmlentities('Qualité'); ?></th>
			<th>Date</th>
			<th>Titre</th>
			<th>Auteurs</th>
			<th><?php echo htmlentities("Lieu d'édition"); ?></th>
			<th>Editeur</th>
			<th><?php echo htmlentities("Année d'édition"); ?></th>
			<th>Reliure</th>
			<th>Provenance</th>
			<th>Site</th>
			<th>Section</th>
			<th>Cote</th>
			<th>Folio/emplacement</th>
			<th><?php echo htmlentities('Dénomination'); ?></th>
			<th><?php echo htmlentities('Catégorie'); ?></th>
			<th><?php echo htmlentities('Matériau'); ?></th>
			<th>Ref. reproductions</th>
			<th>Biblio</th>
			<th>Remarques</th>
			<th>Cl. a refaire?</th>
		</tr>
		<?php 
		
			$libelle_image = utf8_encode('libellé_image');
			$auteur_cliche = utf8_encode('auteur_cliché');
			$type_cliche = utf8_encode('type_cliché');
			$annee_cliche = utf8_encode('année_cliché');
			$emplacement_dans_edifice = utf8_encode('emplacement_dans_édifice');
			$qualite = utf8_encode('qualité');
			$lieu_edition = utf8_encode('lieu_édition');
			$annee_edition = utf8_encode('année_édition');
			$denomination = utf8_encode('dénomination');
			$categorie = utf8_encode('catégorie');
			$materiau = utf8_encode('matériau');
			$cl_a_refaire = utf8_encode('cl_à_refaire');
		
			foreach($donnees_photos as $data1) { 
		?>
		<tr>
			<td><a href='#' onclick="getFiche(<?php echo $data1['id']; ?>,'legende_photos');return false;" title=<?php echo $data1['id']; ?>><?php if (!empty($data1[$auteur_cliche])){echo $data1[$libelle_image]; }?></a></td>
			<td><?php if (!empty($data1['vedette_chandon'])){ echo $data1['vedette_chandon']; }?></td>
			<td><?php if (!empty($data1[$auteur_cliche])){ echo $data1[$auteur_cliche]; }?></td>
			<td><?php if (!empty($data1[$type_cliche])){ echo $data1[$type_cliche]; }?></td>
			<td><?php if (!empty($data1[$annee_cliche])){ echo $data1[$annee_cliche]; }?></td>
			<td><?php if (!empty($data1['commune'])){ echo $data1['commune']; }?></td>
			<td><?php if (!empty($data1['edifice_conservation'])){ echo $data1['edifice_conservation']; }?></td>
			<td><?php if (!empty($data1[$emplacement_dans_edifice])){ echo $data1[$emplacement_dans_edifice]; }?></td>
			<td><?php if (!empty($data1['photo'])){ echo $data1['photo']; }?></td>
			<td><?php if (!empty($data1['commune_INSEE_number'])){ echo $data1['commune_INSEE_number']; }?></td>
			<td><?php if (!empty($data1['ref_IM'])){ echo $data1['ref_IM']; }?></td>
			<td><?php if (!empty($data1['ref_PA'])){ echo $data1['ref_PA']; }?></td>
			<td><?php if (!empty($data1['ref_IA'])){ echo $data1['ref_IA']; }?></td>
			<td><?php if (!empty($data1['artificial_number_Decrock'])){ echo $data1['artificial_number_Decrock']; }?></td>
			<td><?php if (!empty($data1['famille'])){ echo $data1['famille']; }?></td>
			<td><?php if (!empty($data1['individu'])){ echo $data1['individu']; }?></td>
			<td><?php if (!empty($data1[$qualite])){ echo $data1[$qualite]; }?></td>
			<td><?php if (!empty($data1['date'])){ echo $data1['date']; }?></td>
			<td><?php if (!empty($data1['titre'])){ echo $data1['titre']; }?></td>
			<td><?php if (!empty($data1['auteurs'])){ echo $data1['auteurs']; }?></td>
			<td><?php if (!empty($data1[$lieu_edition])){ echo $data1[$lieu_edition]; }?></td>
			<td><?php if (!empty($data1['editeur'])){ echo $data1['editeur']; }?></td>
			<td><?php if (!empty($data1[$annee_edition])){ echo $data1[$annee_edition]; }?></td>
			<td><?php if (!empty($data1['reliure'])){ echo $data1['reliure']; }?></td>
			<td><?php if (!empty($data1['provenance'])){ echo $data1['provenance']; }?></td>
			<td><?php if (!empty($data1['site'])){ echo $data1['site']; }?></td>
			<td><?php if (!empty($data1['section'])){ echo $data1['section']; }?></td>
			<td><?php if (!empty($data1['cote'])){ echo $data1['cote']; }?></td>
			<td><?php if (!empty($data1['folio_emplacement'])){ echo $data1['folio_emplacement']; }?></td>
			<td><?php if (!empty($data1[$denomination])){ echo $data1[$denomination]; }?></td>
			<td><?php if (!empty($data1[$categorie])){ echo $data1[$categorie]; }?></td>
			<td><?php if (!empty($data1[$materiau])){ echo $data1[$materiau]; }?></td>
			<td><?php if (!empty($data1['ref_reproductions'])){ echo $data1['ref_reproductions']; }?></td>
			<td><?php if (!empty($data1['biblio'])){ echo $data1['biblio']; }?></td>
			<td><?php if (!empty($data1['remarques'])){ echo $data1['remarques']; }?></td>
			<td><?php if (!empty($data1[$cl_a_refaire])){ echo $data1[$cl_a_refaire]; }?></td>
		</tr>
		<?php } ?>
	</table>
	<br />
	<?php echo $pages_photos;?>
	</div>
	
</fieldset>



<?php }else{ ?>
<!-- Si l'admin n'est pas connecté on le renvoit sur la page identification -->
<center><h3>Administration</h3></center>

<?php header("Location: ".base_url().'administration/identification'); ?>

<?php } ?>
<div id="fiche" title="Modification des informations"></div> <!--Div pour l'affichage de la fiche de modif
