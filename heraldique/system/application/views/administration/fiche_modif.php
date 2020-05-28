<?php if($table=='armorial'){

	if($update=="") //On affiche le formulaire tant qu'il n'y a pas de traitement en cours
	{
	
?>
                <center><strong>
                <?php
                    echo $donnees['famille'];
                ?>
                    </strong>
                </center>

                <br /><br />
		<form id="form_modif" method="get" action="<?php echo base_url() ?>fiche_modif">
		<div style="float:left;margin-left:15px;">

                      
			<label style="float:left;width:190px;" for="famille">Famille :</label><input type="text" name="famille" id="famille" value="<?php echo htmlentities(utf8_decode($donnees['famille'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="prenom">Prénom :</label><input type="text" name="prenom" id="prenom" value="<?php echo htmlentities(utf8_decode($donnees['prenom'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="titres_dignites">Titres/Dignités :</label><input type="text" name="titres_dignites" id="titres_dignites" value="<?php echo htmlentities(utf8_decode($donnees['titres_dignites'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="origine">Origine :</label><input type="text" name="origine" id="origine" value="<?php echo htmlentities(utf8_decode($donnees['origine'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="date">Date :</label><input type="text" name="date" id="date" value="<?php echo htmlentities(utf8_decode($donnees['date'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="siecle">Siècle :</label><input type="text" name="siecle" id="siecle" value="<?php echo htmlentities(utf8_decode($donnees['siècle'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="fief">Fief :</label><input type="text" name="fief" id="fief" value="<?php echo htmlentities(utf8_decode($donnees['fief'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="region">Région :</label><input type="text" name="region" id="region" value="<?php echo htmlentities(utf8_decode($donnees['région'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="departement">Département :</label><input type="text" name="departement" id="departement" value="<?php echo htmlentities(utf8_decode($donnees['départment'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="alliances">Alliances :</label><input type="text" name="alliances" id="alliances" value="<?php echo htmlentities(utf8_decode($donnees['alliances'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="notes">Notes :</label><input type="text" name="notes" id="notes" value="<?php echo htmlentities(utf8_decode($donnees['notes'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="blasonnement">Armes :</label><textarea cols="20" rows="4" name="blasonnement" id="blasonnement"><?php echo htmlentities(utf8_decode($donnees['blasonnement_1'])); ?></textarea><br /><br />

                </div>
		<div style="float:right;margin-right:15px;">
                    <label style="float:left;width:190px;" for="cimiers">Cimiers/Ornements ext. :</label><textarea cols="20" rows="4" name="cimiers" id="cimiers"><?php echo htmlentities(utf8_decode($donnees['cimiers'])); ?></textarea><br /><br />
			<label style="float:left;width:190px;" for="devise">Devise/Légende :</label><input type="text" name="devise" id="devise" value="<?php echo htmlentities(utf8_decode($donnees['devise'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="embleme">Emblème :</label><input type="text" name="embleme" id="embleme" value="<?php echo htmlentities(utf8_decode($donnees['embleme'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="lambrequins">Lambrequins :</label><input type="text" name="lambrequins" id="lambrequins" value="<?php echo htmlentities(utf8_decode($donnees['lambrequins'])); ?>"/><br /><br />
			<label style="float:left;width:190px;" for="support">Tenant/Support :</label><input type="text" name="support" id="support" value="<?php echo htmlentities(utf8_decode($donnees['support'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="embleme">Emblème :</label><input type="text" name="embleme" id="embleme" value="<?php echo htmlentities(utf8_decode($donnees['embleme'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="observations">Observations :</label><textarea cols="20" rows="4" name="observations" id="observations"><?php echo htmlentities(utf8_decode($donnees['observations'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="ref_biblio">Références/Biblio. :</label><textarea cols="20" rows="4" name="ref_biblio" id="ref_biblio"><?php echo htmlentities(utf8_decode($donnees['ref_biblio'])); ?></textarea><br /><br />
                        <input type="hidden" name="id" value="<?php echo $donnees['id']; ?>" />

			<input type="submit" name="submit" value="Modifier" />
		</div>
		</form>
	
	<?php 
	}
	else //On affiche le r�sultat de la mise � jour
	{
		echo $update;
	}
}
else if($table=='legende_photos'){

    if($update=="") //On affiche le formulaire tant qu'il n'y a pas de traitement en cours
	{
        
?>
        <p style="color:red;">*Cochez les images que vous souhaitez supprimer</p>
        <form id="form_modif" method="get" action="<?php echo base_url() ?>fiche_modif">
        <div>
        <center>
                <?php
                    $images = explode(";", $donnees['libellé_image']);
                    for($i = 0; $i<sizeof($images);$i++)
                    {
                        if($images[$i]!=""){
                ?>      
                            <img width="100px" src="<?php echo PALISEP ; ?>resources/images/<?php echo $images[$i]; ?>.jpg"/>
                            <center><input type="checkbox" name="<?php echo $images[$i]; ?>"></center>
                <?php
                        }
                    }
                ?>
        </center>
        </div>
        <br /><br />
        <div style="float:left;margin-left:20px;">
            
            <label style="float:left;width:190px;" for="vedette_chandon">Vedette chandon :</label><input type="text" name="vedette_chandon" id="vedette_chandon" value="<?php echo htmlentities(utf8_decode($donnees['vedette_chandon'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="famille">Famille :</label><input type="text" name="famille" id="famille" value="<?php echo htmlentities(utf8_decode($donnees['famille'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="individu">Individu :</label><input type="text" name="individu" id="individu" value="<?php echo htmlentities(utf8_decode($donnees['individu'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="qualite">Qualité :</label><input type="text" name="qualite" id="qualite" value="<?php echo htmlentities(utf8_decode($donnees['qualité'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="date">Date :</label><input type="text" name="date" id="date" value="<?php echo htmlentities(utf8_decode($donnees['date'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="denomination">Dénomination :</label><input type="text" name="denomination" id="denomination" value="<?php echo htmlentities(utf8_decode($donnees['dénomination'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="titre">Titre :</label><input type="text" name="titre" id="titre" value="<?php echo htmlentities(utf8_decode($donnees['titre'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="region">Catégorie :</label><input type="text" name="categorie" id="categorie" value="<?php echo htmlentities(utf8_decode($donnees['catégorie'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="materiau">Matériau :</label><input type="text" name="materiau" id="materiau" value="<?php echo htmlentities(utf8_decode($donnees['matériau'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="ref_reproductions">Réf. reproduction :</label><input type="text" name="ref_reproductions" id="ref_reproductions" value="<?php echo htmlentities(utf8_decode($donnees['ref_reproductions'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="biblio">Biblio. :</label><textarea cols="20" rows="4" name="biblio" id="biblio"><?php echo htmlentities(utf8_decode($donnees['biblio'])); ?></textarea><br /><br />
            <label style="float:left;width:190px;" for="remarques">Remarques :</label><textarea cols="20" rows="4" name="remarques" id="remarques"><?php echo htmlentities(utf8_decode($donnees['remarques'])); ?></textarea><br /><br />
            <label style="float:left;width:190px;" for="auteurs">Auteurs :</label><input type="text" name="auteurs" id="auteurs" value="<?php echo htmlentities(utf8_decode($donnees['auteurs'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="lieu_edition">Lieu d'édition :</label><input type="text" name="lieu_edition" id="lieu_edition" value="<?php echo htmlentities(utf8_decode($donnees['lieu_édition'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="editeur">Editeur :</label><input type="text" name="editeur" id="editeur" value="<?php echo htmlentities(utf8_decode($donnees['editeur'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="annee_edition">Année d'édition :</label><input type="text" name="annee_edition" id="annee_edition" value="<?php echo htmlentities(utf8_decode($donnees['année_édition'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="reliure">Reliure :</label><input type="text" name="reliure" id="reliure" value="<?php echo htmlentities(utf8_decode($donnees['reliure'])); ?>"/><br /><br />
            
        </div>

        <div style="float:right;margin-right:20px;">

            <label style="float:left;width:190px;" for="provenance">Provenance :</label><input type="text" name="provenance" id="provenance" value="<?php echo htmlentities(utf8_decode($donnees['provenance'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="site">Site :</label><input type="text" name="site" id="site" value="<?php echo htmlentities(utf8_decode($donnees['site'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="section">Section :</label><input type="text" name="section" id="section" value="<?php echo htmlentities(utf8_decode($donnees['section'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="cote">Cote :</label><input type="text" name="cote" id="cote" value="<?php echo htmlentities(utf8_decode($donnees['cote'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="folio_emplacement">Folio emplacement :</label><input type="text" name="folio_emplacement" id="folio_emplacement" value="<?php echo htmlentities(utf8_decode($donnees['folio_emplacement'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="auteur_cliche">Auteur cliché :</label><input type="text" name="auteur_cliche" id="auteur_cliche" value="<?php echo htmlentities(utf8_decode($donnees['auteur_cliché'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="type_cliche">Type cliché :</label><input type="text" name="type_cliche" id="type_cliche" value="<?php echo htmlentities(utf8_decode($donnees['type_cliché'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="annee_cliche">Année cliché :</label><input type="text" name="annee_cliche" id="annee_cliche" value="<?php echo htmlentities(utf8_decode($donnees['année_cliché'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="pays">Pays :</label><input type="text" name="pays" id="pays" value="<?php echo htmlentities(utf8_decode($donnees['pays'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="region">Région :</label><input type="text" name="region" id="region" value="<?php echo htmlentities(utf8_decode($donnees['région'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="departement">Département :</label><input type="text" name="departement" id="departement" value="<?php echo htmlentities(utf8_decode($donnees['départment'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="commune">Commune :</label><input type="text" name="commune" id="commune" value="<?php echo htmlentities(utf8_decode($donnees['commune'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="village">Village :</label><input type="text" name="village" id="village" value="<?php echo htmlentities(utf8_decode($donnees['village'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="edifice_conservation">Edifice conservation  :</label><input type="text" name="auteur_cliche" id="edifice_conservation" value="<?php echo htmlentities(utf8_decode($donnees['edifice_conservation'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="emplacement_dans_edifice">Emplacement ds édifice  :</label><input type="text" name="emplacement_dans_edifice" id="emplacement_dans_edifice" value="<?php echo htmlentities(utf8_decode($donnees['emplacement_dans_édifice'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="photo">Photo  :</label><input type="text" name="photo" id="photo" value="<?php echo htmlentities(utf8_decode($donnees['photo'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="commune_INSEE_number">N° INSEE commune  :</label><input type="text" name="commune_INSEE_number" id="commune_INSEE_number" value="<?php echo htmlentities(utf8_decode($donnees['commune_INSEE_number'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="ref_IM">Ref. IM  :</label><input type="text" name="ref_IM" id="ref_IM" value="<?php echo htmlentities(utf8_decode($donnees['ref_IM'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="ref_PA">Ref. PA  :</label><input type="text" name="ref_PA" id="ref_PA" value="<?php echo htmlentities(utf8_decode($donnees['ref_PA'])); ?>"/><br /><br />
            <label style="float:left;width:190px;" for="ref_IA">Ref. IA  :</label><input type="text" name="ref_IA" id="ref_IA" value="<?php echo htmlentities(utf8_decode($donnees['ref_IA'])); ?>"/><br /><br />
            <input type='hidden' name='anc_onglet' id='anc_onglet' value='contenus' />
            <input type="hidden" name="id" value="<?php echo $donnees['id']; ?>" />
            <input type="hidden" name="all_pictures" value="<?php echo $donnees['libellé_image']; ?>" />
            
            <input type="submit" name="submit" value="Modifier" />
        </div>
        </form>
<?php
    }
}
?>