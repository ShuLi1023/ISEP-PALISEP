<?php if($table=='details'){



	if($update=="") //On affiche le formulaire tant qu'il n'y a pas de traitement en cours
	{

            ?>
            <p style="color:red;">*Cochez les images que vous souhaitez supprimer</p>
            <form id="form_modif" method="post" action="<?php echo base_url() ?>fiche_modif/index/<?php echo $donnees['id']; ?>/details">

                    <div>
                        <center>
                <?php
                    $images = explode(";", $donnees['libelle_image']);
                    for($i = 0; $i<sizeof($images);$i++)
                    {
                        if($images[$i]!=""){
                ?>
                    <!--
                    <img width="100px" src="http://livre2.palisep.fr/resources/images/<?php echo $images[$i]; ?>.jpg"/>
                        <center><input type="checkbox" name="<?php echo $images[$i]; ?>"></center>
                    -->
                            <img width="100px" src="http://palisep.fr/resources/images/<?php echo $images[$i]; ?>.jpg"/>
                            <center><input type="checkbox" name="<?php echo $images[$i]; ?>"></center>

                <?php
                        }
                    }
                ?>
                        </center>
                    </div>


                <br /><br />

		<div style="display:inline-block;margin-left:8px;">

                        <!--<label style="float:left;width:190px;" for="images_1">Images (fichier .jpg):</label><br />
			<input type="file" name="images_1" id="images_1" /><br /><br />-->

                        <label style="float:left;width:190px;" for="patronyme">Patronyme :</label><input type="text" name="patronyme" id="patronyme" value="<?php echo htmlentities(utf8_decode($donnees['patronyme'])); ?>"/><br /><br />
                        <label style="float:left;width:190px;" for="pays">Pays :</label><input type="text" name="pays" id="pays" value="<?php echo htmlentities(utf8_decode($donnees['pays'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="region">Région :</label><input type="text" name="region" id="region" value="<?php echo htmlentities(utf8_decode($donnees['region'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="departement">Département :</label><input type="text" name="departement" id="departement" value="<?php echo htmlentities(utf8_decode($donnees['departement'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="commune">Commune :</label><input type="text" name="commune" id="commune" value="<?php echo htmlentities(utf8_decode($donnees['commune'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="edifice_conservation">Edifice de conservation :</label><input type="text" name="edifice_conservation" id="edifice_conservation" value="<?php echo htmlentities(utf8_decode($donnees['edifice_conservation'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="denomination">Dénomination :</label><input type="text" name="denomination" id="denomination" value="<?php echo htmlentities(utf8_decode($donnees['denomination'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="categorie">Catégorie :</label><input type="text" name="categorie" id="categorie" value="<?php echo htmlentities(utf8_decode($donnees['categorie'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="materiau">Matériau :</label><input type="text" name="materiau" id="materiau" value="<?php echo htmlentities(utf8_decode($donnees['materiau'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="ref_reproduction">Référence de la reproduction :</label><input type="text" name="ref_reproduction" id="ref_reproduction" value="<?php echo htmlentities(utf8_decode($donnees['ref_reproduction'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="auteur_cliche">Auteur du cliché :</label><input type="text" name="auteur_cliche" id="auteur_cliche" value="<?php echo htmlentities(utf8_decode($donnees['auteur_cliche'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="type_cliche">Type du cliché :</label><input type="text" name="type_cliche" id="type_cliche" value="<?php echo htmlentities(utf8_decode($donnees['type_cliche'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="annee_cliche">Année du cliché :</label><input type="text" name="annee_cliche" id="annee_cliche" value="<?php echo htmlentities(utf8_decode($donnees['annee_cliche'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="photo">Type de photo :</label><input type="text" name="photo" id="photo" value="<?php echo htmlentities(utf8_decode($donnees['photo'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="ref_im">Référence IM :</label><input type="text" name="ref_im" id="ref_im" value="<?php echo htmlentities(utf8_decode($donnees['ref_im'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="ref_pa">Référence PA :</label><input type="text" name="ref_pa" id="ref_pa" value="<?php echo htmlentities(utf8_decode($donnees['ref_pa'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="ref_ia">Référence IA :</label><input type="text" name="ref_ia" id="ref_ia" value="<?php echo htmlentities(utf8_decode($donnees['ref_ia'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="embleme">Emblème :</label><textarea cols="20" rows="4" name="embleme" id="embleme"><?php echo htmlentities(utf8_decode($donnees['embleme'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="cote">Cote :</label><input type="text" name="cote" id="cote" value="<?php echo htmlentities(utf8_decode($donnees['cote'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="individu">Individu :</label><input type="text" name="individu" id="individu" value="<?php echo htmlentities(utf8_decode($donnees['individu'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="biographie">Biographie :</label><textarea cols="20" rows="15" name="biographie" id="biographie"><?php echo htmlentities(utf8_decode($donnees['biographie'])); ?></textarea><br /><br />

                </div>
		<div style="display:inline-block;margin-left:77px;vertical-align:top;">
                                            <label style="float:left;width:190px;" for="parente">Parenté :</label><textarea cols="20" rows="4" name="parente" id="parente"><?php echo htmlentities(utf8_decode($donnees['parente'])); ?></textarea><br /><br />

                        <label style="float:left;width:190px;" for="date">Date :</label><input type="text" name="date" id="date" value="<?php echo htmlentities(utf8_decode($donnees['date'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="armes">Armes :</label><textarea cols="20" rows="4" name="armes" id="armes"><?php echo htmlentities(utf8_decode($donnees['armes'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="cimiers">Ornements extérieurs :</label><textarea cols="20" rows="4" name="cimiers" id="cimiers"><?php echo htmlentities(utf8_decode($donnees['cimiers'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="devise">Devise/Légende :</label><textarea cols="20" rows="4" name="devise" id="devise"><?php echo htmlentities(utf8_decode($donnees['devise'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="bibliographie">Bibliographie :</label><textarea cols="20" rows="4" name="bibliographie" id="bibliographie"><?php echo htmlentities(utf8_decode($donnees['bibliographie'])); ?></textarea><br /><br />						<label style="float:left;width:190px;" for="notes">Notes :</label><textarea cols="20" rows="4" name="notes" id="notes"><?php echo htmlentities(utf8_decode($donnees['notes'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="auteurs">Auteur(s) :</label><textarea cols="20" rows="4" name="auteurs" id="auteurs"><?php echo htmlentities(utf8_decode($donnees['auteurs'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="titre">Titre :</label><textarea cols="20" rows="4" name="titre" id="titre"><?php echo htmlentities(utf8_decode($donnees['titre'])); ?></textarea><br /><br />
                        <label style="float:left;width:190px;" for="lieu_edition">Lieu d'édition :</label><input type="text" name="lieu_edition" id="lieu_edition" value="<?php echo htmlentities(utf8_decode($donnees['lieu_edition'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="editeur">Editeur :</label><input type="text" name="editeur" id="editeur" value="<?php echo htmlentities(utf8_decode($donnees['editeur'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="annee_edition">Année d'édition :</label><input type="text" name="annee_edition" id="annee_edition" value="<?php echo htmlentities(utf8_decode($donnees['annee_edition'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="reliure">Reliure :</label><input type="text" name="reliure" id="reliure" value="<?php echo htmlentities(utf8_decode($donnees['reliure'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="provenance">Provenance :</label><input type="text" name="provenance" id="provenance" value="<?php echo htmlentities(utf8_decode($donnees['provenance'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="site">Site :</label><input type="text" name="site" id="site" value="<?php echo htmlentities(utf8_decode($donnees['site'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="folio_emplacement">Folio ou emplacement :</label><input type="text" name="folio_emplacement" id="folio_emplacement" value="<?php echo htmlentities(utf8_decode($donnees['folio_emplacement'])); ?>" /><br /><br />
                        <label style="float:left;width:190px;" for="section">Section :</label><input type="text" name="section" id="section" value="<?php echo htmlentities(utf8_decode($donnees['section'])); ?>" /><br /><br />
                        <input type="hidden" name="all_pictures" value="<?php echo $donnees['libelle_image']; ?>" />

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
