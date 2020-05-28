<!-- Si l'administrateur est connect� -->
<?php if ($connecte == true ){ ?>

<!-- Verification statut admin-->
<?php //if ($_SESSION['statut'] == 1 ){ ?>

<div class="corps">	

<br /><br /><h3><center>Espace d'administration</center></h3>

<br /><br />

<div class="navigation">
    <a href="http://www.livre2.palisep.fr">Retour à l'accueil</a>
</div>

<div class="onglets">
	<span class="onglet_0 onglet" id="onglet_admin" onclick="javascript:change_onglet('admin');">Administrateur</span>
    <span class="onglet_0 onglet" id="onglet_contenus" onclick="javascript:change_onglet('contenus');">Gestion des contenus</span>
	<span class="onglet_0 onglet" id="onglet_recherche" onclick="javascript:change_onglet('recherche');">Recherche ID</span>

</div>

<!-- Partie pour changer le mot de passe d'accés -->
<div class="contenu_onglets">

<div class="contenu_onglet" id="contenu_onglet_admin">
<fieldset style='background-color:white;'>
    <legend><strong><font color="#A42903">Identifiants</font></strong><a href="#" class="info"><img src="<?php echo base_url(); ?>resources/images/aide.gif"/><span><?php echo $bulle_identifiants; ?></span></a></legend><br />
	<?php if($acces=="")
	{ ?>
	<form method="post" action="">
		<label style="float:left;width:190px;" for="login">Login :</label><input type="text" name="login" id="login" /><br /><br />
		<label style="float:left;width:190px;" for="mdp_actuel">Mot de passe actuel :</label><input type="password" name="mdp_actuel" id="mdp_actuel" /><br /><br />
		<input type='hidden' name='anc_onglet' id='anc_onglet' value='admin' />
                <input type="submit" name="submit" value="Valider" />
	</form>
	<?php 
	} 
	else if($acces=="true")
	{?>
	<form method="post" action="">
		<label style="float:left;width:190px;" for="new_mdp">Nouveau mot de passe :</label><input type="password" name="new_mdp" id="new_mdp" /><br /><br />
		<label style="float:left;width:190px;" for="new_mdp_bis">Saisissez de nouveau :</label><input type="password" name="new_mdp_bis" id="new_mdp_bis" /><br /><br />
		<input type='hidden' name='anc_onglet' id='anc_onglet' value='admin' />
                <input type="submit" name="submit" value="Valider" />
	</form>
	<?php
	}
	else
	{
		echo $acces;
	?>
	<h4><a onclick="window.history.go(-2)"><<< Retour sur le formulaire </a></h4>
	<?php 
	} ?>
</fieldset><br /><br />

<fieldset style='background-color:white;'>
        <legend><strong><font color="#A42903">Compteur de visites</font></strong><a href="#" class="info"><img src="<?php echo base_url(); ?>resources/images/aide.gif"/><span><?php echo $bulle_visites; ?></span></a></legend><br />
        Le site a été visité <strong><?php echo $visites; ?></strong> fois depuis le <strong><?php echo $date; ?></strong> <br /><br />
        <form method="get" action="">
            <input type='hidden' name='anc_onglet' id='anc_onglet' value='admin' />
        <input type="submit" value="Réinitialiser le compteur" name="compteur"/>
        </form>
</fieldset><br /><br />

        
<fieldset style='background-color:white;'>
        <legend><strong><font color="#A42903">Modification de l'adresse mail</font></strong><a href="#" class="info"><img src="<?php echo base_url(); ?>resources/images/aide.gif"/><span><?php echo $bulle_mail; ?></span></a></legend><br />
        L'adresse mail administrateur configurée est : <strong><?php echo $mail; ?></strong><br /><br />

        <form method="get" action="">
            <label style="float:left;width:190px;" for="new_mail">Nouvelle adresse mail :</label><input type="text" name="new_mail" id="new_mail" /><br /><br />
            <input type='hidden' name='anc_onglet' id='anc_onglet' value='admin' />
            <input type="submit" name="submit" value="Changer" />
        </form>

</fieldset>

<fieldset style='background-color:white;margin-top: 30px;'>
        <legend><strong><font color="#A42903">Modification des partenaires</font></strong><a href="#" class="info"><img src="<?php echo base_url(); ?>resources/images/aide.gif"/><span><?php echo $bulle_partenaire; ?></span></a></legend><br />

        <ul>
			<?php foreach($partenaires as $partenaire){ ?>
				<li><button class="delete_partenaire" data-partenaireid="<?php echo $partenaire->id ; ?>">Supprimer</button><?php echo $partenaire->nom ; ?> (<a href="<?php echo $partenaire->url ; ?>" target=_blank><?php echo $partenaire->url ; ?></a>)</li>
			<?php } ?>
		</ul>
		<form method="post" action="">
			<input type="text" name="new_pn" placeholder="Nom"></input>
			<input type="text" name="new_purl" placeholder="Url du site"></input>
			<input type="submit" value="Ajouter un partenaire"/>
		</form>
</fieldset>

<fieldset style='background-color:white;margin-top: 30px;'>
		<legend><strong><font color="#A42903">Modification de la présentation</font></strong></legend><br />
        
        <?php foreach($presentation_livre2 as $presentation){ ?>
	        <form method="POST" action="">
				<textarea name="update_presentation" id="tinymce_presentation" style="width:100%; height:300px;"><?php echo html_entity_decode($presentation->description); ?></textarea>
        		<input type="submit" value="Modifier la présentation"/>
        	</form>
        <?php } ?>
</fieldset>



</div>


<!-- Partie de mise a jour de la base (insertion de fichiers excel) -->
<div class="contenu_onglet" id="contenu_onglet_contenus">
<fieldset style='background-color:white;'>
	<legend><strong><font color="#A42903">Mise à jour de la base par le fichier Excel</font></strong><a href="#" class="info"><img src="<?php echo base_url(); ?>resources/images/aide.gif"/><span><?php echo $bulle_excel; ?></span></a></legend><br />
	
   <?php if(!isset($_FILES['mediatheque']) ){ ?>
		<form method="post" action="" enctype="multipart/form-data">
			<label style="float:left;width:190px;" for="mediatheque">Objets/livres :</label>
			<input type="file" name="mediatheque" id="mediatheque" />
                        <input type='hidden' name='anc_onglet' id='anc_onglet' value='contenus' />
                        <input type="submit" name="submit" value="Ajouter" />&nbsp;<a href="<?php echo base_url(); ?>resources/fichiers/modele_excel2.xls">Générer un ficher Excel type</a>
		</form>
		
	<?php } else{ 
		echo $transfert; ?>
		<h4><a href="javascript:history.back()"><<< Retour sur le formulaire </a></h4>
	<?php
		}
	?>
</fieldset><br /><br />

<?php //} ?>

<!--Partie de modification des donn�es de la base-->
<fieldset style='background-color:white;'>
	<legend><strong><font color="#A42903">Modification des contenus</font></strong><a href="#" class="info"><img src="<?php echo base_url(); ?>resources/images/aide.gif"/><span><?php echo $bulle_contenus; ?></span></a></legend><br />
	<h3><center><a href='#photos' onclick='visibilite("photos");'>Objets/livres</a></center></h3><br /><br />

        <?php echo "<a href='".base_url()."administration?anc_onglet=contenus&lc=a'>A</a> - <a href='".base_url()."administration?anc_onglet=contenus&lc=b'>B</a> - <a href='".base_url()."administration?anc_onglet=contenus&lc=c'>C</a> - <a href='".base_url()."administration?anc_onglet=contenus&lc=d'>D</a> - <a href='".base_url()."administration?anc_onglet=contenus&lc=e'>E</a> - <a href='".base_url()."administration?anc_onglet=contenus&lc=f'>F</a>
                     - <a href='".base_url()."administration?anc_onglet=contenus&lc=g'>G</a> - <a href='".base_url()."administration?anc_onglet=contenus&lc=h-i-j-k'>H/I/J/K</a> - <a href='".base_url()."administration?anc_onglet=contenus&lc=l'>L</a> - <a href='".base_url()."administration?anc_onglet=contenus&lc=m'>M</a> - <a href='".base_url()."administration?anc_onglet=contenus&lc=n'>N</a>
                     - <a href='".base_url()."administration?anc_onglet=contenus&lc=o-p-q'>O/P/Q</a> - <a href='".base_url()."administration?anc_onglet=contenus&lc=r'>R</a> - <a href='".base_url()."administration?anc_onglet=contenus&lc=s'>S</a> - <a href='".base_url()."administration?anc_onglet=contenus&lc=t'>T</a> - <a href='".base_url()."administration?anc_onglet=contenus&lc=u-v'>U/V</a> - <a href='".base_url()."administration?anc_onglet=contenus&lc=w-x-y-z'>W/X/Y/Z</a>
        "?>
	<div id='photos' style='display:block;width:820px;'><table id="table_obj" border='1' style="border-collapse:collapse; width:100%;">
                <thead>
                <tr>
			<th></th>

                        <th>Libellé image</th>
                        <th>Patronyme</th>
			<th>Individu</th>
                        <th>Date</th>
                        <th>Biographie</th>
                        <th>Parenté</th>
			<th>Pays</th>
			<th>Région</th>
			<th>Département</th>
			<th>Commune</th>
                        <th>Armes</th>
                        <th>Emblème</th>
			<th>Cimiers/Ornements extérieurs</th>
			<th>Devise/Légende</th>
			<th>Edifice de conservation</th>
			<th>Dénomination</th>
			<th>Catégorie</th>
			<th>Matériau</th>
			<th>Référence de la reproduction</th>
			<th>Auteur du cliché</th>
			<th>Type du cliché</th>
			<th>Année du cliché</th>
			<th>Type de photo</th>
			<th>Référence IM</th>
			<th>Référence PA</th>
			<th>Référence IA</th>
			<th>Notes</th>
                        <th>Bibliographie</th>
			<th>Auteur(s)</th>
			<th>Titre</th>
			<th>Lieu d'édition</th>
			<th>Editeur</th>
			<th>Année d'édition</th>
			<th>Reliure</th>
			<th>Provenance</th>
			<th>Site</th>
			<th>Section</th>
			<th>Cote</th>
                        <th>Folio ou emplacement</th>
		</tr>
                </thead>
                <tbody>
		<?php 
		
			foreach($donnees_photos as $data1) {

                        $image = "";
                        $images = explode(";", $data1['libelle_image']);
                        for($i=0;$i<sizeof($images);$i++){
                            $image.=$images[$i]." ";
                        }
                        
                ?>
				
		<tr>
                    <td>
                        <a href='#' onclick="getFiche(<?php echo $data1['id']; ?>,'details');return false;" title="<?php echo $data1['id']; ?>">Modifier</a>
                        <br /><br /><br /><br />
                    	<a href='#' onclick="ConfirmMessage(<?php echo $data1['id']; ?>);"><img width="15px" src="<?php echo base_url() ?>resources/images/supprimer.png" /></a>
                    </td>
                    <td>
                        <div id="espace_photo<?php echo $data1['id']; ?>" style="display:block;">
                            <?php if ($image != " "){ ?>
                            	<ul><?php echo "<li>".$image."</li>"; ?></ul>
                            <?php } ?>
                            <br /><br />
                            <center><a href="#ajout_photo<?php echo $data1['id']; ?>" onclick="visibilite('ajout_photo<?php echo $data1['id']; ?>'); visibilite('espace_photo<?php echo $data1['id']; ?>')"><img width="20px" src="<?php echo base_url() ?>/resources/images/croix.png" alt="Ajouter d'autres photos" title="Ajouter d'autres photos"/></a></center>
                        </div><br /><br />
                        
                        <div id="ajout_photo<?php echo $data1['id']; ?>" style="display:none;">
                            <a href="#ajout_photo<?php echo $data1['id']; ?>" onclick="visibilite('ajout_photo<?php echo $data1['id']; ?>'); visibilite('espace_photo<?php echo $data1['id']; ?>')"><img width="20px" src="<?php echo base_url() ?>/resources/images/fleches_montantes.png" alt="Retour" title="Retour aux libellés"/></a><br /><br />
                            <form method="post" action="" enctype="multipart/form-data">
                                <input type="file" name="images_1" id="images_1" /><br />
                                <center><span id="ajoutleschamps_2<?php echo $data1['id']; ?>"><a href="javascript:create_champ('ajoutleschamps',2,2<?php echo $data1['id']; ?>)" style="color:black;">Nouveau champs image</a></span></center><br /><br />
                                <input type='hidden' name='id' id='id' value='<?php echo $data1['id']; ?>' />
                                <input type='hidden' name='anc_onglet' id='anc_onglet' value='contenus' />
                                <center><input type="submit" value="Ajouter" name="ajouter_photos_libelle"/></center>
                            </form>
                        </div>

                    </td>
					<td><?php if (!empty($data1['patronyme'])){ echo htmlentities(utf8_decode($data1['patronyme'])); }?></td>
					<td><?php if (!empty($data1['individu'])){ echo htmlentities(utf8_decode($data1['individu'])); }?></td>
                    <td><?php if (!empty($data1['date'])){ echo htmlentities(utf8_decode($data1['date'])); }?></td>
                    <td><?php if (!empty($data1['biographie'])){ echo htmlentities(utf8_decode($data1['biographie'])); }?></td>
                    <td><?php if (!empty($data1['parente'])){ echo htmlentities(utf8_decode($data1['parente'])); }?></td>
                    <td><?php if (!empty($data1['pays'])){ echo htmlentities(utf8_decode($data1['pays'])); }?></td>
					<td><?php if (!empty($data1['region'])){ echo htmlentities(utf8_decode($data1['region'])); }?></td>
					<td><?php if (!empty($data1['departement'])){ echo htmlentities(utf8_decode($data1['departement'])); }?></td>
					<td><?php if (!empty($data1['commune'])){ echo htmlentities(utf8_decode($data1['commune'])); }?></td>
                    <td><?php if (!empty($data1['armes'])){ echo htmlentities(utf8_decode($data1['armes'])); }?></td>
                    <td><?php if (!empty($data1['embleme'])){ echo htmlentities(utf8_decode($data1['embleme'])); }?></td>
					<td><?php if (!empty($data1['cimiers'])){ echo htmlentities(utf8_decode($data1['cimiers'])); }?></td>
					<td><?php if (!empty($data1['devise'])){ echo htmlentities(utf8_decode($data1['devise'])); }?></td>
					<td><?php if (!empty($data1['edifice_conservation'])){ echo htmlentities(utf8_decode($data1['edifice_conservation'])); }?></td>
					<td><?php if (!empty($data1['denomination'])){ echo htmlentities(utf8_decode($data1['denomination'])); }?></td>
					<td><?php if (!empty($data1['categorie'])){ echo htmlentities(utf8_decode($data1['categorie'])); }?></td>
					<td><?php if (!empty($data1['materiau'])){ echo htmlentities(utf8_decode($data1['materiau'])); }?></td>
					<td><?php if (!empty($data1['ref_reproduction'])){ echo htmlentities(utf8_decode($data1['ref_reproduction'])); }?></td>
					<td><?php if (!empty($data1['auteur_cliche'])){ echo htmlentities(utf8_decode($data1['auteur_cliche'])); }?></td>
					<td><?php if (!empty($data1['type_cliche'])){ echo htmlentities(utf8_decode($data1['type_cliche'])); }?></td>
					<td><?php if (!empty($data1['annee_cliche'])){ echo htmlentities(utf8_decode($data1['annee_cliche'])); }?></td>
					<td><?php if (!empty($data1['photo'])){ echo htmlentities(utf8_decode($data1['photo'])); }?></td>
					<td><?php if (!empty($data1['ref_im'])){ echo htmlentities(utf8_decode($data1['ref_im'])); }?></td>
					<td><?php if (!empty($data1['ref_pa'])){ echo htmlentities(utf8_decode($data1['ref_pa'])); }?></td>
					<td><?php if (!empty($data1['ref_ia'])){ echo htmlentities(utf8_decode($data1['ref_ia'])); }?></td>
					<td><?php if (!empty($data1['notes'])){ echo htmlentities(utf8_decode($data1['notes'])); }?></td>
					<td><?php if (!empty($data1['bibliographie'])){ echo htmlentities(utf8_decode($data1['bibliographie'])); }?></td>
					<td><?php if (!empty($data1['auteurs'])){ echo htmlentities(utf8_decode($data1['auteurs'])); }?></td>
					<td><?php if (!empty($data1['titre'])){ echo htmlentities(utf8_decode($data1['titre'])); }?></td>
					<td><?php if (!empty($data1['lieu_edition'])){ echo htmlentities(utf8_decode($data1['lieu_edition'])); }?></td>
					<td><?php if (!empty($data1['editeur'])){ echo htmlentities(utf8_decode($data1['editeur'])); }?></td>
					<td><?php if (!empty($data1['annee_edition'])){ echo htmlentities(utf8_decode($data1['annee_edition'])); }?></td>
					<td><?php if (!empty($data1['reliure'])){ echo htmlentities(utf8_decode($data1['reliure'])); }?></td>
					<td><?php if (!empty($data1['provenance'])){ echo htmlentities(utf8_decode($data1['provenance'])); }?></td>
					<td><?php if (!empty($data1['site'])){ echo htmlentities(utf8_decode($data1['site'])); }?></td>
					<td><?php if (!empty($data1['section'])){ echo htmlentities(utf8_decode($data1['section'])); }?></td>
					<td><?php if (!empty($data1['cote'])){ echo htmlentities(utf8_decode($data1['cote'])); }?></td>
                    <td><?php if (!empty($data1['folio_emplacement'])){ echo htmlentities(utf8_decode($data1['folio_emplacement'])); }?></td>
		</tr>
		<?php } ?>
                </tbody>
	</table>
	<br />
	</div>
	
</fieldset><br /><br />

<fieldset style='background-color:white;'>
	<legend><strong><font color="#A42903">Ajout d'un contenu</font></strong><a href="#" class="info"><img src="<?php echo base_url(); ?>resources/images/aide.gif"/><span><?php echo $bulle_ajout; ?></span></a></legend><br />
        <h3><center><a href='#photos' onclick='visibilite("modif");'>Ajout manuel d'un contenu</a></center></h3><br />
        <div id='modif' style="display:block;">
            <?php if($booleen_manuel==""){ ?>
        <form method="post" action="<?php echo base_url()."administration?anc_onglet=contenus"; ?>" enctype="multipart/form-data">
		<div style="display:inline-block;margin-left:30px;">
			<label style="float:left;width:190px;" for="images_1">Images (fichier .jpg):</label><br />
			<input type="file" name="images_1" id="images_1" /><br />
                        <center><span id="leschamps_2" style="float:left;"><a href="javascript:create_champ('leschamps',2,2)">Nouveau champs image</a></span></center><br /><br />

                        <label style="float:left;width:190px;" for="patronyme">Patronyme :</label><input style="width:159px;"type="text" name="patronyme" id="patronyme" /><br /><br />
                        <label style="float:left;width:190px;" for="pays">Pays :</label><input style="width:159px;"type="text" name="pays" id="pays" /><br /><br />
                        <label style="float:left;width:190px;" for="region">Région :</label><input style="width:159px;"type="text" name="region" id="region" /><br /><br />
                        <label style="float:left;width:190px;" for="departement">Département :</label><input style="width:159px;"type="text" name="departement" id="departement" /><br /><br />
                        <label style="float:left;width:190px;" for="commune">Commune :</label><input style="width:159px;"type="text" name="commune" id="commune" /><br /><br />
                        <label style="float:left;width:190px;" for="edifice_conservation">Edifice de conservation :</label><textarea cols="20" rows="4" name="edifice_conservation" id="edifice_conservation" ></textarea><br /><br />
                        <label style="float:left;width:190px;" for="denomination">Dénomination :</label><input style="width:159px;"type="text" name="denomination" id="denomination"/><br /><br />
                        <label style="float:left;width:190px;" for="categorie">Catégorie :</label><input style="width:159px;"type="text" name="categorie" id="categorie" /><br /><br />
                        <label style="float:left;width:190px;" for="materiau">Matériau :</label><input style="width:159px;"type="text" name="materiau" id="materiau" /><br /><br />
                        <label style="float:left;width:190px;" for="ref_reproduction">Référence de la reproduction :</label><input style="width:159px;"type="text" name="ref_reproduction" id="ref_reproduction" /><br /><br />
                        <label style="float:left;width:190px;" for="auteur_cliche">Auteur du cliché :</label><input style="width:159px;"type="text" name="auteur_cliche" id="auteur_cliche" /><br /><br />
                        <label style="float:left;width:190px;" for="type_cliche">Type du cliché :</label><input style="width:159px;"type="text" name="type_cliche" id="type_cliche" /><br /><br />
                        <label style="float:left;width:190px;" for="annee_cliche">Année du cliché :</label><input style="width:159px;"type="text" name="annee_cliche" id="annee_cliche" /><br /><br />
                        <label style="float:left;width:190px;" for="photo">Type de photo :</label><input style="width:159px;"type="text" name="photo" id="photo" /><br /><br />
                        <label style="float:left;width:190px;" for="ref_im">Référence IM :</label><input style="width:159px;"type="text" name="ref_im" id="ref_im" /><br /><br />
                        <label style="float:left;width:190px;" for="ref_pa">Référence PA :</label><input style="width:159px;"type="text" name="ref_pa" id="ref_pa" /><br /><br />
                        <label style="float:left;width:190px;" for="ref_ia">Référence IA :</label><input style="width:159px;"type="text" name="ref_ia" id="ref_ia" /><br /><br />
                        <label style="float:left;width:190px;" for="individu">Individu :</label><input style="width:159px;"type="text" name="individu" id="individu" /><br /><br />
                        <label style="float:left;width:190px;" for="biographie">Biographie :</label><textarea cols="20" rows="4" name="biographie" id="biographie" ></textarea><br /><br />
                        <label style="float:left;width:190px;" for="parente">Parenté :</label><textarea cols="20" rows="4" name="parente" id="parente" ></textarea><br /><br />
                        <label style="float:left;width:190px;" for="embleme">Emblème :</label><textarea cols="20" rows="4" name="embleme" id="embleme" ></textarea><br /><br />

                </div>
		<div style="display:inline-block; margin-left:50px; vertical-align:top;">
                        <label style="float:left;width:190px;" for="armes">Armes :</label><textarea cols="20" rows="8" name="armes" id="armes" ></textarea><br /><br />
                        <label style="float:left;width:190px;" for="cimiers">Ornements extérieurs :</label><textarea cols="20" rows="4" name="cimiers" id="cimiers" ></textarea><br /><br />
                        <label style="float:left;width:190px;" for="notes">Notes :</label><textarea cols="20" rows="4" name="notes" id="notes" ></textarea><br /><br />
                        <label style="float:left;width:190px;" for="devise">Devise/Légende :</label><input style="width:159px;"type="text" name="devise" id="devise" /><br /><br />
                        <label style="float:left;width:190px;" for="bibliographie">Bibliographie :</label><textarea cols="20" rows="4" name="bibliographie" id="bibliographie" ></textarea><br /><br />
                        <label style="float:left;width:190px;" for="auteurs">Auteur(s) :</label><input style="width:159px;"type="text" name="auteurs" id="auteurs" /><br /><br />
                        <label style="float:left;width:190px;" for="titre">Titre :</label><textarea cols="20" rows="4" name="titre" id="titre" ></textarea><br /><br />
                        <label style="float:left;width:190px;" for="lieu_edition">Lieu d'édition :</label><input style="width:159px;"type="text" name="lieu_edition" id="lieu_edition" /><br /><br />
                        <label style="float:left;width:190px;" for="editeur">Editeur :</label><input style="width:159px;"type="text" name="editeur" id="editeur" /><br /><br />
                        <label style="float:left;width:190px;" for="annee_edition">Année d'édition :</label><input style="width:159px;"type="text" name="annee_edition" id="annee_edition" /><br /><br />
                        <label style="float:left;width:190px;" for="reliure">Reliure :</label><input style="width:159px;"type="text" name="reliure" id="reliure" /><br /><br />
                        <label style="float:left;width:190px;" for="provenance">Provenance :</label><textarea cols="20" rows="4" name="provenance" id="provenance" ></textarea><br /><br />
                        <label style="float:left;width:190px;" for="site">Site :</label><textarea cols="20" rows="4" name="site" id="site" ></textarea><br /><br />
                        <label style="float:left;width:190px;" for="section">Section :</label><input style="width:159px;"type="text" name="section" id="section" /><br /><br />
                        <label style="float:left;width:190px;" for="cote">Cote :</label><input style="width:159px;"type="text" name="cote" id="cote" /><br /><br />
                        <label style="float:left;width:190px;" for="folio_emplacement">Folio ou emplacement :</label><input style="width:159px;"type="text" name="folio_emplacement" id="folio_emplacement" /><br /><br />
						<input type='hidden' name='anc_onglet' id='anc_onglet' value='contenus' />
                        
		</div>

		<div style="text-align:center; margin-bottom:10px; margin-top:10px;"><input type="submit" name="submit_ajout_manuel" value="Ajouter" /></div>

		</form>
                <?php }
                else{
                    echo $manuel;
                ?>
                <h4><a href="javascript:history.back()"><<< Retour sur le formulaire </a></h4>
                <?php
                }
                ?>
                </div>
</fieldset>
 </fieldset><br /><br />

    <fieldset style='background-color:white;'>

        <legend><strong><font color="#A42903">Tableau des équivalences</font></strong></legend><br />

        <table border='1' style="border-collapse:collapse;width:100%;" id="table_eq">
            <thead>
            <tr>
                <th></th>
                <th>Expression 1</th>
                <th>Expression 2</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach($equivalences as $data){

                $id = "eq_".$data['id'];
            ?>
            <tr id="<?php echo $id; ?>">
                <td><a href="administration?anc_onglet=contenus&sup=1&id=<?php echo $data['id']; ?>"><img width="15px" src="<?php echo base_url() ?>resources/images/supprimer.png" title="Supprimer" /></a></td>
                <td><?php echo $data['expression']; ?></td>
                <td><?php echo $data['signification']; ?></td>
            </tr>
            <?php
                }
            ?>
            </tbody>
            </table>
            <center><div id="new_equivalence" style="display:none;">
                <form method="get" action="">
                    <input type="text" name="mot_1" size="31"/><input type="text" name="mot_2" size="31"/><br />
                    <input type='hidden' name='anc_onglet' id='anc_onglet' value='contenus' />
                    <input type="submit" name="ajout_equivalence" value="Ajouter l'équivalence" />
                </form>
                </div></center>
        <center><div id="ajout" style="display:block;"><a href="#ajout" onclick="visibilite('ajout');visibilite('new_equivalence');"><img width="15px" src="<?php echo base_url() ?>resources/images/croix.png" title="Ajouter une équivalence"/></a></div></center>


    </fieldset><br /><br />
</div>
															<!-- recherche par ID -->
<div class="contenu_onglet" id="contenu_onglet_recherche">
        <fieldset style='background-color:white;'>
              <legend><strong><font color="#A42903">Recherche par ID</font></strong></legend><br />

        <form method="post" action="">
            <label style="float:left;width:190px;" for="recherche_id"> Saisir une ID :</label>
			<input type="text" name="recherche_id" /><br /><br />
            <input type='hidden' name='anc_onglet' id='anc_onglet' value='recherche' />
            <input type="submit" name="submit" value="Rechercher" />
        </form>

	<?php 	if(isset($_POST['recherche_id']) && $_POST['recherche_id']!=="" && $idrecherche!==""){  ?>
      <br /> Entrée trouvée pour l'ID <strong><?php echo $_POST['recherche_id']; ?> :</strong><br /><br />
		<td><center><a style="font-size:200%;" href='#' onclick="getFiche(<?php echo $idrecherche; ?>,'details');return false;" title=<?php echo $idrecherche; ?>><?php echo $idtitre; ?></a></center></td>
	<?php	}
	
			if (isset($_POST['recherche_id']) && $idrecherche=="") { ?> 
		      <br /> Désolé, mais il n'existe pas d'entrée pour cette ID. Vérifiez l'écriture et réessayez. ID saisi: <strong><?php if ($_POST['recherche_id']=="") {  echo 'Aucune';}  else {echo $_POST['recherche_id'];} ?></strong><br /><br />		
		
	<?php 	} ?>
		
		</fieldset>	
</div>


</div>
</div>

<?php }else{ ?>
<!-- Si l'admin n'est pas connect� on le renvoit sur la page identification -->
<center><h3>Administration</h3></center>

<?php header("Location: ".base_url().'administration/identification'); ?>

<?php } ?>
<div id="fiche" title="Modification des informations"></div> <!--Div pour l'affichage de la fiche de modif -->
<script type="text/javascript">
	var anc_onglet = '<?php
	if(isset($_GET['anc_onglet']))
		echo $_GET['anc_onglet'];
	else
		echo 'admin';?>';
	change_onglet(anc_onglet);
</script>