<?php if($table=='legende_photos'){ 

	if($update=="") //On affiche le formulaire tant qu'il n'y a pas de traitement en cours
	{
		//On encode les index du tableau "donnees" en utf8 a cause des accents qu'ils contiennent
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
	
?>
		<center><img width="100px" src="<?php echo base_url() ; ?>resources/images/<?php echo $donnees[$libelle_image]; ?>.jpg"/></center>
		<center><?php echo $donnees[$libelle_image]; ?></center><br /><br />

		<form method="post" action="<?php echo base_url() ?>fiche_modif/index/<?php echo $donnees['id']; ?>/legende_photos">
		<div style="float:left;margin-left:50px;">	
			<label style="float:left;width:190px;" for="vedette_chandon">Vedette armorial :</label><input type="text" name="vedette_chandon" id="vedette_chandon" value="<?php echo htmlentities(utf8_decode($donnees['vedette_chandon'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="auteur_cliche"><?php echo htmlentities('Auteur Cliché'); ?> :</label><input type="text" name="auteur_cliche" id="auteur_cliche" value="<?php echo htmlentities(utf8_decode($donnees[$auteur_cliche])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="type_cliche"><?php echo htmlentities('Type cliché'); ?> :</label><input type="text" name="type_cliche" id="type_cliche" value="<?php echo htmlentities(utf8_decode($donnees[$type_cliche])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="annee_cliche"><?php echo htmlentities('Année du cliché'); ?> :</label><input type="text" name="annee_cliche" id="annee_cliche" value="<?php echo htmlentities(utf8_decode($donnees[$annee_cliche])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="commune">Commune :</label><input type="text" name="commune" id="commune" value="<?php echo htmlentities(utf8_decode($donnees['commune'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="edifice_conservation">Edifice de conservation :</label><input type="text" name="edifice_conservation" id="edifice_conservation" value="<?php echo htmlentities(utf8_decode($donnees['edifice_conservation'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="emplacement_dans_edifice">Emplacement :</label><input type="text" name="emplacement_dans_edifice" id="emplacement_dans_edifice" value="<?php echo htmlentities(utf8_decode($donnees[$emplacement_dans_edifice])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="photo">Photo :</label><input type="text" name="photo" id="photo" value="<?php echo htmlentities(utf8_decode($donnees['photo'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="ref_IM">Ref. IM :</label><input type="text" name="ref_IM" id="ref_IM" value="<?php echo htmlentities(utf8_decode($donnees['ref_IM'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="ref_PA">Ref. PA :</label><input type="text" name="ref_PA" id="ref_PA" value="<?php echo htmlentities(utf8_decode($donnees['ref_PA'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="ref_IA">Ref. IA :</label><input type="text" name="ref_IA" id="ref_IA" value="<?php echo utf8_decode($donnees['ref_IA']); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="artificial_number_Decrock"><?php echo htmlentities('N° Art. Decroc'); ?> :</label><input type="text" name="artificial_number_Decrock" id="artificial_number_Decrock" value="<?php echo htmlentities(utf8_decode($donnees['artificial_number_Decrock'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="famille">Famille :</label><input type="text" name="famille" id="famille" value="<?php echo htmlentities(utf8_decode($donnees['famille'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="individu">Individu :</label><input type="text" name="individu" id="individu" value="<?php echo htmlentities(utf8_decode($donnees['individu'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="qualite"><?php echo htmlentities('Qualité'); ?> :</label><input type="text" name="qualite" id="qualite" value="<?php echo htmlentities(utf8_decode($donnees[$qualite])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="date">Date :</label><input type="text" name="date" id="date" value="<?php echo htmlentities(utf8_decode($donnees['date'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="titre">Titre :</label><input type="text" name="titre" id="titre" value="<?php echo htmlentities(utf8_decode($donnees['titre'])); ?>"/><br /><br />
		</div>
		<div style="float:right;margin-right:50px;">	
			<label style="float:left;width:190px;" for="auteurs">Auteurs :</label><input type="text" name="auteurs" id="auteurs" value="<?php echo htmlentities(utf8_decode($donnees['auteurs'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="lieu_edition"><?php echo htmlentities("Lieu d'édition"); ?> :</label><input type="text" name="lieu_edition" id="lieu_edition" value="<?php echo htmlentities(utf8_decode($donnees[$lieu_edition])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="editeur">Editeur :</label><input type="text" name="editeur" id="editeur" value="<?php echo htmlentities(utf8_decode($donnees['editeur'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="annee_edition"><?php echo htmlentities("Année d'édition"); ?> :</label><input type="text" name="annee_edition" id="annee_edition" value="<?php echo htmlentities(utf8_decode( $donnees[$annee_edition])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="reliure">Reliure :</label><input type="text" name="reliure" id="reliure" value="<?php echo htmlentities(utf8_decode($donnees['reliure'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="provenance">Provenance :</label><input type="text" name="provenance" id="provenance" value="<?php echo htmlentities(utf8_decode($donnees['provenance'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="site">Site :</label><input type="text" name="site" id="site" value="<?php echo htmlentities(utf8_decode($donnees['site'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="section">Section :</label><input type="text" name="section" id="section" value="<?php echo htmlentities(utf8_decode($donnees['section'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="cote">Cote :</label><input type="text" name="cote" id="cote" value="<?php echo htmlentities(utf8_decode($donnees['cote'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="folio_emplacement">Folio/emplacement :</label><input type="text" name="folio_emplacement" id="folio_emplacement" value="<?php echo htmlentities(utf8_decode($donnees['folio_emplacement'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="denomination"><?php echo htmlentities('Dénomination'); ?> :</label><input type="text" name="denomination" id="denomination" value="<?php echo htmlentities(utf8_decode($donnees[$denomination])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="categorie"><?php echo htmlentities('Catégorie'); ?> :</label><input type="text" name="categorie" id="categorie" value="<?php echo htmlentities(utf8_decode($donnees[$categorie])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="materiau"><?php echo htmlentities('Matériau'); ?> :</label><input type="text" name="materiau" id="materiau" value="<?php echo htmlentities(utf8_decode($donnees[$materiau])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="ref_reproductions">Ref. reproductions :</label><input type="text" name="ref_reproductions" id="ref_reproductions" value="<?php echo htmlentities(utf8_decode($donnees['ref_reproductions'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="biblio">Biblio :</label><input type="text" name="biblio" id="biblio" value="<?php echo htmlentities(utf8_decode($donnees['biblio'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="remarques">Remarques :</label><input type="text" name="remarques" id="remarques" value="<?php echo htmlentities(utf8_decode($donnees['remarques'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="cl_a_refaire">Cl. a refaire? :</label><input type="text" name="cl_a_refaire" id="cl_a_refaire" value="<?php echo htmlentities(utf8_decode($donnees[$cl_a_refaire])); ?>"/><br /><br />
			<input type="submit" name="submit" value="Modifier" />
		</div>
		</form>
	
	<?php 
	}
	else //On affiche le résultat de la mise à jour
	{
		echo $update;
	}
}
else if($table=='armorial'){ 
	
	if($update=="")
	{
		$siecle = utf8_encode('siècle');
?>
		<center><?php echo $donnees['patronyme']; ?></center><br /><br />
		
		<form method="post" action="">
		<div style="float:left;margin-left:30px;">
			<label style="float:left;width:190px;" for="ville">Origine (Ville):</label><input type="text" name="ville" id="ville" value="<?php echo htmlentities(utf8_decode($donnees['ville'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="province">Origine (Province ou territoire) :</label><input type="text" name="province" id="province" value="<?php echo htmlentities(utf8_decode($donnees['province'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="prenom"><?php echo htmlentities('Prénom'); ?> :</label><input type="text" name="prenom" id="prenom" value="<?php echo htmlentities(utf8_decode($donnees['prenom'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="titres_dignites"><?php echo htmlentities('Titres et dignités'); ?> :</label><TEXTAREA rows="6" name="titres_dignites" id="titres_dignites"><?php echo htmlentities(utf8_decode($donnees['titres_dignites'])); ?></TEXTAREA><br /><br />
			<label style="float:left;width:190px;" for="date">Date :</label><input type="text" name="date" id="date" value="<?php echo htmlentities(utf8_decode($donnees['date'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="siecle"><?php echo htmlentities('Siècle'); ?> :</label><input type="siecle" name="siecle" id="siecle" value="<?php echo htmlentities(utf8_decode($donnees['siecle'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="sources">Sources :</label><TEXTAREA rows="6" name="sources" id="sources" ><?php echo htmlentities(utf8_decode($donnees['sources'])); ?></TEXTAREA><br /><br />
			<label style="float:left;width:190px;" for="observations">Observations :</label><input type="text" name="observations" id="observations" value="<?php echo htmlentities(utf8_decode($donnees['observations'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="genealogie"><?php echo htmlentities('Généalogie'); ?> :</label><input type="text" name="genealogie" id="genealogie" value="<?php echo htmlentities(utf8_decode($donnees['genealogie'])); ?>"/><br /><br />
		</div>
		<div style="float:right;margin-right:30px;margin-left:5x;">	
			<label style="float:left;width:190px;" for="document">Document (support et illustrations) :</label><input type="text" name="document" id="document" value="<?php echo htmlentities(utf8_decode($donnees['document'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="ecu">Ecu :</label><TEXTAREA rows="6" name="ecu" id="ecu"><?php echo htmlentities(utf8_decode($donnees['ecu'])); ?></TEXTAREA><br /><br />
			<label style="float:left;width:190px;" for="timbre">Timbre :</label><input type="text" name="timbre" id="timbre" value="<?php echo htmlentities(utf8_decode($donnees['timbre'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="cimier">Cimier :</label><input type="text" name="cimier" id="cimier" value="<?php echo htmlentities(utf8_decode($donnees['cimier'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="devise_cri">Devise/cri :</label><input type="text" name="devise_cri" id="devise_cri" value="<?php echo htmlentities(utf8_decode($donnees['devise_cri'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="tenants_support">Tenants/Support :</label><input type="text" name="tenants_support" id="tenants_support" value="<?php echo htmlentities(utf8_decode($donnees['tenants_support'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="decoration"><?php echo htmlentities('Orde/Décoration'); ?> :</label><input type="text" name="decoration" id="decoration" value="<?php echo htmlentities(utf8_decode($donnees['decoration'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="ornements_ext">Autres ornements :</label><input type="text" name="ornements_ext" id="ornements_ext" value="<?php echo htmlentities(utf8_decode($donnees['ornements_ext'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="emblemes"><?php echo htmlentities('Emblèmes'); ?> :</label><input type="text" name="emblemes" id="emblemes" value="<?php echo htmlentities(utf8_decode($donnees['emblemes'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="images_geneal"><?php echo htmlentities('Fichiers images généalogie'); ?> :</label><input type="text" name="images_geneal" id="images_geneal" value="<?php echo htmlentities(utf8_decode($donnees['images_geneal'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="images_doc">Fichiers images documents :</label><input type="text" name="images_doc" id="images_doc" value="<?php echo htmlentities(utf8_decode($donnees['images_doc'])); ?>"/><br /><br />
		</div>
			<br /><br />
			<center><input type="submit" name="submit" value="Modifier" /></center>
		</form>
		
<?php	
	}
	else
	{
		echo $update;
	}
} ?>