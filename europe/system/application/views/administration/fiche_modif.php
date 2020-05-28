<?php 

/*-----------------------------------------------------------------------
----------Modification de famille/blason---------------------------------
-------------------------------------------------------------------------*/
if($table=='armorial'){



	if($update=="") //On affiche le formulaire tant qu'il n'y a pas de traitement en cours
	{
	
            ?>
            <form id="form_modif" method="post" action="<?php echo base_url() ?>fiche_modif/index/<?php echo $donnees['id']; ?>/armorial">
                
                <br /><br />
		
		<div style="display:inline-block;margin-left:8px;">

                        

                        <label style="float:left;width:190px;" for="patronyme">Patronyme :</label><input type="text" name="patronyme" id="patronyme" value="<?php echo htmlentities(utf8_decode($donnees['patronyme'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="prenom">Prénom :</label><input type="text" name="prenom" id="prenom" value="<?php echo htmlentities(utf8_decode($donnees['prenom'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="famille">Famille :</label><input type="text" name="famille" id="famille" value="<?php echo htmlentities(utf8_decode($donnees['famille'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="titres_dignites">Titres & dignités :</label><input type="text" name="titres_dignites" id="titres_dignites" value="<?php echo htmlentities(utf8_decode($donnees['titres_dignites'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="origine">Origine :</label><input type="text" name="origine" id="origine" value="<?php echo htmlentities(utf8_decode($donnees['origine'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="alliances">Alliances :</label><input type="text" name="alliances" id="alliances" value="<?php echo htmlentities(utf8_decode($donnees['alliances'])); ?>" /><br /><br />
</br>
                        <label style="float:left;width:190px;" for="date">Date :</label><input type="text" name="date" id="date" value="<?php echo htmlentities(utf8_decode($donnees['date'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="siecle">Siècle :</label><input type="text" name="siecle" id="siecle" value="<?php echo htmlentities(utf8_decode($donnees['siècle'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="fief">Fief :</label><input type="text" name="fief" id="fief" value="<?php echo htmlentities(utf8_decode($donnees['fief'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="pays">Pays :</label><input type="text" name="pays" id="pays" value="<?php echo htmlentities(utf8_decode($donnees['pays'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="province">Province :</label><input type="text" name="province" id="province" value="<?php echo htmlentities(utf8_decode($donnees['province'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="region">Région :</label><input type="text" name="region" id="region" value="<?php echo htmlentities(utf8_decode($donnees['région'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="department">Département :</label><input type="text" name="department" id="department" value="<?php echo htmlentities(utf8_decode($donnees['départment'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="ville">Ville :</label><input type="text" name="ville" id="ville" value="<?php echo htmlentities(utf8_decode($donnees['ville'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="notes">Notes & observations :</label><textarea cols="20" rows="4" name="notes" id="notes"><?php echo htmlentities(utf8_decode($donnees['notes'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="images_geneal">Images_geneal :</label><input type="text" name="images_geneal" id="images_geneal" value="<?php echo htmlentities(utf8_decode($donnees['images_geneal'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="images_doc">Images_doc :</label><input type="text" name="images_doc" id="images_doc" value="<?php echo htmlentities(utf8_decode($donnees['images_doc'])); ?>"/><br /><br />
                    </div>
                    <div style="display:inline-block;margin-left:121px;vertical-align:top;">
                        <label style="float:left;width:190px;" for="sources">Sources :</label><input type="text" name="sources" id="sources" value="<?php echo htmlentities(utf8_decode($donnees['sources'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="genealogie">Genealogie :</label><input type="text" name="genealogie" id="genealogie" value="<?php echo htmlentities(utf8_decode($donnees['genealogie'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="document">Document :</label><input type="text" name="document" id="document" value="<?php echo htmlentities(utf8_decode($donnees['document'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="notes_armoriaux">Notes armoriaux :</label><textarea cols="20" rows="4" name="notes_armoriaux" id="notes_armoriaux"><?php echo htmlentities(utf8_decode($donnees['notes_armoriaux'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="timbre">Timbre :</label><input type="text" name="timbre" id="timbre" value="<?php echo htmlentities(utf8_decode($donnees['timbre'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="cimier">Cimier :</label><input type="text" name="cimier" id="cimier" value="<?php echo htmlentities(utf8_decode($donnees['cimier'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="devise_cri">Devise, cri :</label><input type="text" name="devise_cri" id="devise_cri" value="<?php echo htmlentities(utf8_decode($donnees['devise_cri'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="tenants_support">Tenants, support :</label><input type="text" name="tenants_support" id="tenants_support" value="<?php echo htmlentities(utf8_decode($donnees['tenants_support'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="decoration">Décoration :</label><input type="text" name="decoration" id="decoration" value="<?php echo htmlentities(utf8_decode($donnees['decoration'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="ornements_ext">Ornements extérieurs :</label><input type="text" name="ornements_ext" id="ornements_ext" value="<?php echo htmlentities(utf8_decode($donnees['ornements_ext'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="emblemes">Emblèmes :</label><input type="text" name="emblemes" id="emblemes" value="<?php echo htmlentities(utf8_decode($donnees['emblemes'])); ?>"/><br /><br />                        <label style="float:left;width:190px;" for="notes">Notes :</label><textarea cols="20" rows="4" name="notes" id="notes"><?php echo htmlentities(utf8_decode($donnees['notes'])); ?></textarea><br /><br />                       
                        <label style="float:left;width:190px;" for="blasonnement_1">blasonnement_1 :</label><textarea cols="20" rows="4" name="blasonnement_1" id="blasonnement_1" ><?php echo htmlentities(utf8_decode($donnees['blasonnement_1'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="blasonnement_2">blasonnement_2 :</label><textarea cols="20" rows="4" name="blasonnement_2" id="blasonnement_2" ><?php echo htmlentities(utf8_decode($donnees['blasonnement_2'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="blasonnement_3">blasonnement_3 :</label><textarea cols="20" rows="4" name="blasonnement_3" id="blasonnement_3" ><?php echo htmlentities(utf8_decode($donnees['blasonnement_3'])); ?></textarea><br /><br />
                    
                

                        
		</div>
        <div style="text-align:center;"><input type="submit" name="submit" value="Modifier" /></div>
		</form>
	
	<?php 
	}
	else //On affiche le r�sultat de la mise � jour
	{
		echo $update;
	}
}
/*-----------------------------------------------------------------------
----------Modification de photos-----------------------------------------
-------------------------------------------------------------------------*/
elseif ($table == 'legende_photos'){

    if($update=="") //On affiche le formulaire tant qu'il n'y a pas de traitement en cours
    {
    
            ?>
            <br/>
            <center><img src="<?php echo base_url(); ?>resources/images/<?php echo $donnees['libellé_image']; ?>.jpg"/><br/></center>
            
            <?php //Suppression de la photo ?>
            <a href="#" onclick="ConfirmMessage(<?php echo $donnees['id']; ?>);"><img src="<?php echo base_url(); ?>resources/images/supprimer.png" width="15px"/><font color="#A42903"> Supprimer la photo et sa description</font></a>
            <form method="post" action="<?php echo base_url(); ?>administration" id="supp_form_<?php echo $donnees['id']; ?>">
                <input type="hidden" name="tab_supp" value="legende_photos"/>
                <input type="hidden" name="id_supp" value="<?php echo $donnees['id']; ?>"/>
            </form>
            <form id="form_modif" method="post" action="<?php echo base_url() ?>fiche_modif/index/<?php echo $donnees['id']; ?>/legende_photos">
                
                <br />
        
        <div style="display:inline-block;margin-left:8px;">


                        <label style="float:left;width:190px;" for="vedette_chandon">Patronyme :</label> <?php echo htmlentities(utf8_decode($donnees['vedette_chandon'])); ?><input type="hidden" name="vedette_chandon" id="vedette_chandon" value="<?php echo htmlentities(utf8_decode($donnees['vedette_chandon'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="auteur_cliche">Auteur cliché :</label><input type="text" name="auteur_cliche" id="auteur_cliche" value="<?php echo htmlentities(utf8_decode($donnees['auteur_cliché'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="type_cliche">Type cliché :</label><input type="text" name="type_cliche" id="type_cliche" value="<?php echo htmlentities(utf8_decode($donnees['type_cliché'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="annee_cliche">Année cliché :</label><input type="text" name="annee_cliche" id="annee_cliche" value="<?php echo htmlentities(utf8_decode($donnees['année_cliché'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="pays">Pays :</label><input type="text" name="pays" id="pays" value="<?php echo htmlentities(utf8_decode($donnees['pays'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="region">Région :</label><input type="text" name="region" id="region" value="<?php echo htmlentities(utf8_decode($donnees['région'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="department">Département :</label><input type="text" name="department" id="department" value="<?php echo htmlentities(utf8_decode($donnees['départment'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="commune">Commune :</label><input type="text" name="commune" id="commune" value="<?php echo htmlentities(utf8_decode($donnees['commune'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="village">Village :</label><input type="text" name="village" id="village" value="<?php echo htmlentities(utf8_decode($donnees['village'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="edifice_conservation">Edifice de conservation :</label><textarea cols="20" rows="4" name="edifice_conservation" id="edifice_conservation" ><?php echo htmlentities(utf8_decode($donnees['edifice_conservation'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="emplacement_dans_edifice">Emplacement dans l'édifice :</label><textarea cols="20" rows="4" name="emplacement_dans_edifice" id="emplacement_dans_edifice" ><?php echo htmlentities(utf8_decode($donnees['emplacement_dans_édifice'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="photo">Type de photo :</label><input type="text" name="photo" id="photo" value="<?php echo htmlentities(utf8_decode($donnees['photo'])); ?>" /><br /><br />
</br>
                        <label style="float:left;width:190px;" for="commune_INSEE_number">Numéro INSEE de la commune :</label><input type="text" name="commune_INSEE_number" id="commune_INSEE_number" value="<?php echo htmlentities(utf8_decode($donnees['commune_INSEE_number'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="ref_IM">Référence IM :</label><input type="text" name="ref_IM" id="ref_IM" value="<?php echo htmlentities(utf8_decode($donnees['ref_IM'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="ref_PA">Référence PA :</label><input type="text" name="ref_PA" id="ref_PA" value="<?php echo htmlentities(utf8_decode($donnees['ref_PA'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="ref_IA">Référence IA :</label><input type="text" name="ref_IA" id="ref_IA" value="<?php echo htmlentities(utf8_decode($donnees['ref_IA'])); ?>" /><br /><br />
</br>
                        <label style="float:left;width:190px;" for="famille">Famille :</label><input type="text" name="famille" id="famille" value="<?php echo htmlentities(utf8_decode($donnees['famille'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="individu">Individu :</label><input type="text" name="individu" id="individu" value="<?php echo htmlentities(utf8_decode($donnees['individu'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="qualite">Biographie :</label><input type="text" name="qualite" id="qualite" value="<?php echo htmlentities(utf8_decode($donnees['qualité'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="date">Date :</label><input type="text" name="date" id="date" value="<?php echo htmlentities(utf8_decode($donnees['date'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="denomination">Dénomination :</label><input type="text" name="denomination" id="denomination" value="<?php echo htmlentities(utf8_decode($donnees['dénomination'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="titre">Titre :</label><input type="text" name="titre" id="titre" value="<?php echo htmlentities(utf8_decode($donnees['titre'])); ?>" /><br /><br />
                    </div>
                    <div style="display:inline-block;margin-left:121px;vertical-align:top;">
    
                        <label style="float:left;width:190px;" for="categorie">Catégorie :</label><input type="text" name="categorie" id="categorie" value="<?php echo htmlentities(utf8_decode($donnees['catégorie'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="materiau">Matériau :</label><input type="text" name="materiau" id="materiau" value="<?php echo htmlentities(utf8_decode($donnees['matériau'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="cimiers">Cimiers :</label><textarea cols="20" rows="4" name="cimiers" id="cimiers"><?php echo htmlentities(utf8_decode($donnees['cimiers'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="blasonnement_1">Blasonnement_1 :</label><textarea cols="20" rows="4" name="blasonnement_1" id="blasonnement_1"><?php echo htmlentities(utf8_decode($donnees['blasonnement_1'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="blasonnement_2">Blasonnement_2 :</label><textarea cols="20" rows="4" name="blasonnement_2" id="blasonnement_2"><?php echo htmlentities(utf8_decode($donnees['blasonnement_2'])); ?></textarea><br /><br />

                        <label style="float:left;width:190px;" for="ref_reproductions">Référence reproductions :</label><input type="text" name="ref_reproductions" id="ref_reproductions" value="<?php echo htmlentities(utf8_decode($donnees['ref_reproductions'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="biblio">Bibliographie :</label><textarea cols="20" rows="4" name="biblio" id="biblio"><?php echo htmlentities(utf8_decode($donnees['biblio'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="remarques">Remarques :</label><textarea cols="20" rows="4" name="remarques" id="remarques"><?php echo htmlentities(utf8_decode($donnees['remarques'])); ?></textarea><br /><br />
<br/>
                        <label style="float:left;width:190px;" for="auteurs">Auteur(s) :</label><input type="text" name="auteurs" id="auteurs" value="<?php echo htmlentities(utf8_decode($donnees['auteurs'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="lieu_edition">Lieu d'édition :</label><input type="text" name="lieu_edition" id="lieu_edition" value="<?php echo htmlentities(utf8_decode($donnees['lieu_édition'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="editeur">Editeur :</label><input type="text" name="editeur" id="editeur" value="<?php echo htmlentities(utf8_decode($donnees['editeur'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="annee_edition">Année d'édition :</label><input type="text" name="annee_edition" id="annee_edition" value="<?php echo htmlentities(utf8_decode($donnees['année_édition'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="reliure">Reliure :</label><input type="text" name="reliure" id="reliure" value="<?php echo htmlentities(utf8_decode($donnees['reliure'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="provenance">Provenance :</label><textarea cols="20" rows="4" name="provenance" id="provenance"><?php echo htmlentities(utf8_decode($donnees['provenance'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="site">Site :</label><textarea cols="20" rows="4" name="site" id="site"><?php echo htmlentities(utf8_decode($donnees['site'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="section">Section :</label><input type="text" name="section" id="section" value="<?php echo htmlentities(utf8_decode($donnees['section'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="cote">Numéro ou cote :</label><input type="text" name="cote" id="cote" value="<?php echo htmlentities(utf8_decode($donnees['cote'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="folio_emplacement">Folio ou emplacement :</label><input type="text" name="folio_emplacement" id="folio_emplacement" value="<?php echo htmlentities(utf8_decode($donnees['folio_emplacement'])); ?>" /><br /><br />
                    
                

                        
        </div>
        <div style="text-align:center;"><input type="submit" name="submit" value="Modifier" /></div>
        </form>
    
    <?php 
    }
    else //On affiche le r�sultat de la mise � jour
    {
        echo $update;
    }
}
?>


