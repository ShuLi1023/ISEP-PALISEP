<div id="page">
    <div id="page-bgtop">
		<div id="page-bgbtm">
			<div id="content">
				<!-- Si l'administrateur est connecté -->

				<?php if ($connecte == true ){ ?>
					<!-- Verification statut admin-->
					<?php // if ($_SESSION['statut'] == 1 ){ ?>

					<div class="corps">

						<h3 style="text-align:center;">Espace d'administration</h3>
						<br />
						<div class="onglets">
							<span class="onglet_0 onglet" id="onglet_modif" onclick="javascript:change_onglet('modif');">Modification de contenu</span>
							<span class="onglet_0 onglet" id="onglet_blason" onclick="javascript:change_onglet('blason');">Ajout blason / famille</span>
							<span class="onglet_0 onglet" id="onglet_image" onclick="javascript:change_onglet('image');">Ajout image</span>
							<span class="onglet_0 onglet" id="onglet_admin" onclick="javascript:change_onglet('admin');">Administration</span>
							<span class="onglet_0 onglet" id="onglet_recherche" onclick="javascript:change_onglet('recherche');">Recherche ID</span>
							<span class="onglet_0 onglet" id="onglet_presentation" onclick="javascript:change_onglet('presentation');">Modifier la présentation</span>
						</div>
						<div class="contenu_onglets">

							<!--Partie d'ajout de blason-->
							<div class="contenu_onglet" id="contenu_onglet_blason">
								<fieldset style='background-color:white;'>
									<legend><strong><font color="#A42903">Ajout d'un blason</font></strong></legend><br />
									<h3><center><a href='#' onclick='visibilite("blason");'>Ajout manuel d'un blason ou d'une famille</a></center></h3><br />
									<div id='blason' style="display:block;">
										<?php if($booleen_manuel==""){ ?>
											<form method="post" action="<?php echo base_url()."administration"; ?>" enctype="multipart/form-data">
												<div style="float:left;margin-left:20px;">

													<label style="float:left;width:190px;" for="patronyme">Patronyme <i style="color:red;">(obligatoire)</i> :</label><input type="text" name="patronyme" id="patronyme" /><br /><br />
													<label style="float:left;width:190px;" for="prenom">Prénom :</label><input type="text" name="prenom" id="prenom" /><br /><br />
													<label style="float:left;width:190px;" for="famille">Famille :</label><input type="text" name="famille" id="famille" /><br /><br />
													<label style="float:left;width:190px;" for="titres_dignites">Titres & dignités :</label><input type="text" name="titres_dignites" id="titres_dignites" /><br /><br />
													<label style="float:left;width:190px;" for="origine">Origine :</label><input type="text" name="origine" id="origine" /><br /><br />
													<label style="float:left;width:190px;" for="alliances">Alliances :</label><input type="text" name="alliances" id="alliances" /><br /><br />
													</br>
													<label style="float:left;width:190px;" for="date">Date :</label><input type="text" name="date" id="date" /><br /><br />
													<label style="float:left;width:190px;" for="siecle">Siècle :</label><input type="text" name="siecle" id="siecle" /><br /><br />
													<label style="float:left;width:190px;" for="fief">Fief :</label><input type="text" name="fief" id="fief" /><br /><br />
													<label style="float:left;width:190px;" for="pays">Pays :</label><input type="text" name="pays" id="pays" /><br /><br />
													<label style="float:left;width:190px;" for="province">Province :</label><input type="text" name="province" id="province" /><br /><br />
													<label style="float:left;width:190px;" for="region">Région :</label><input type="text" name="region" id="region" /><br /><br />
													<label style="float:left;width:190px;" for="department">Département :</label><input type="text" name="department" id="department" /><br /><br />
													<label style="float:left;width:190px;" for="ville">Ville :</label><input type="text" name="ville" id="ville" /><br /><br />
													</br>
													<label style="float:left;width:190px;" for="notes">Notes & observations :</label><textarea cols="20" rows="4" name="notes" id="notes" ></textarea><br /><br />
													<label style="float:left;width:190px;" for="images_geneal">Images genealogie :</label><input type="text" name="images_geneal" id="images_geneal" /><br /><br />
													<label style="float:left;width:190px;" for="images_doc">Images doc :</label><input type="text" name="images_doc" id="images_doc" /><br /><br />
												</div>
												<div style="float:right;margin-right:20px;">
													<label style="float:left;width:190px;" for="sources">Sources :</label><input type="text" name="sources" id="sources"/><br /><br />
													<label style="float:left;width:190px;" for="genealogie">Généalogie :</label><input type="text" name="genealogie" id="genealogie" /><br /><br />
													<label style="float:left;width:190px;" for="document">Document :</label><input type="text" name="document" id="document" /><br /><br />
													</br>
													<label style="float:left;width:190px;" for="notes_armoriaux">Notes armoriaux :</label><textarea cols="20" rows="4" name="notes_armoriaux" id="notes_armoriaux" ></textarea><br /><br />
													<label style="float:left;width:190px;" for="timbre">Timbre :</label><input type="text" name="timbre" id="timbre" /><br /><br />
													<label style="float:left;width:190px;" for="cimier">Cimier :</label><input type="text" name="cimier" id="cimier" /><br /><br />
													<label style="float:left;width:190px;" for="devise_cri">Devise, cri :</label><input type="text" name="devise_cri" id="devise_cri" /><br /><br />
													<label style="float:left;width:190px;" for="tenants_support">Tenants, support :</label><input type="text" name="tenants_support" id="tenants_support" /><br /><br />
													<label style="float:left;width:190px;" for="decoration">Décoration :</label><input type="text" name="decoration" id="decoration" /><br /><br />
													<label style="float:left;width:190px;" for="ornements_ext">Ornements extérieurs :</label><input type="text" name="ornements_ext" id="ornements_ext" /><br /><br />
													<label style="float:left;width:190px;" for="emblemes">Emblèmes :</label><input type="text" name="emblemes" id="emblemes" /><br /><br />
													<label style="float:left;width:190px;" for="blasonnement_1">blasonnement_1 :</label><textarea cols="20" rows="4" name="blasonnement_1" id="blasonnement_1" ></textarea><br /><br />
													<label style="float:left;width:190px;" for="blasonnement_2">blasonnement_2 :</label><textarea cols="20" rows="4" name="blasonnement_2" id="blasonnement_2" ></textarea><br /><br />
													<label style="float:left;width:190px;" for="blasonnement_3">blasonnement_3 :</label><textarea cols="20" rows="4" name="blasonnement_3" id="blasonnement_3" ></textarea><br /><br />
													</br>
													<input type='hidden' name='anc_onglet' id='anc_onglet' value='blason' />
													<input type="submit" name="submit_ajout_manuel_blason" value="Ajouter" />
												</div>
											</form>
										<?php } else {  ?>
											<?php echo $manuel; ?>
											<h4><a href="javascript:history.back()"><<< Retour sur le formulaire </a></h4>
										<?php } ?>

									</div>
								</fieldset>
							</div>

							<!--Partie d'ajout d'image-->
							<div class="contenu_onglet" id="contenu_onglet_image">
								<fieldset style='background-color:white;'>
									<legend><strong><font color="#A42903">Ajout d'image</font></strong></legend><br />
									<h3><center><a href='#' onclick='visibilite("image");'>Ajout manuel d'image �  un blason ou une famille</a></center></h3><br />
									<div id='image' style="display:block;">
										<?php if($booleen_manuel==""){ ?>
											<form method="post" action="<?php echo base_url()."administration"; ?>" enctype="multipart/form-data">
												<div style="margin-left:20px;">
													<label style="float:left;width:190px;" for="vedette_chandon">Patronyme <i style="color:red;">(obligatoire)</i> :</label>
													<select name="vedette_chandon" width="600" style="width: 600px">
														<?php foreach($patronymes as $patronyme){ ?>
															<option value="<?php echo $patronyme->patronyme; ?>"><?php echo $patronyme->patronyme; ?></option>
														<?php } ?>
													</select><br /><br />
												</div>
												<div style="float:left;margin-left:20px;">
													<label style="float:left;width:190px;" for="images_1">Image (fichier .jpg):</label>
													<input type="file" name="images_1" id="images_1" /><br /><br />
													<center><span id="leschamps_2" style="float:left;"><a href="javascript:create_champ('leschamps',2,2)">Nouveau champ image</a></span></center><br /><br />
													</br>
													<label style="float:left;width:190px;" for="auteur_cliche">Auteur cliché :</label><input type="text" name="auteur_cliche" id="pays" /><br /><br />
													<label style="float:left;width:190px;" for="type_cliche">Type cliché :</label><input type="text" name="type_cliche" id="type_cliche" /><br /><br />
													<label style="float:left;width:190px;" for="annee_cliche">Année cliché :</label><input type="text" name="annee_cliche" id="annee_cliche" /><br /><br />
													<label style="float:left;width:190px;" for="pays">Pays :</label><input type="text" name="pays" id="pays" /><br /><br />
													<label style="float:left;width:190px;" for="region">Région :</label><input type="text" name="region" id="region" /><br /><br />
													<label style="float:left;width:190px;" for="department">Département :</label><input type="text" name="department" id="department" /><br /><br />
													<label style="float:left;width:190px;" for="commune">Commune :</label><input type="text" name="commune" id="commune" /><br /><br />
													<label style="float:left;width:190px;" for="village">Village :</label><input type="text" name="village" id="village" /><br /><br />
													<label style="float:left;width:190px;" for="edifice_conservation">Edifice de conservation :</label><textarea cols="20" rows="4" name="edifice_conservation" id="edifice_conservation" ></textarea><br /><br />
													<label style="float:left;width:190px;" for="emplacement_dans_edifice">Emplacement dans l'édifice :</label><textarea cols="20" rows="4" name="emplacement_dans_edifice" id="emplacement_dans_edifice" ></textarea><br /><br />
													<label style="float:left;width:190px;" for="photo">Type de photo :</label><input type="text" name="photo" id="photo"/><br /><br />

													</br>
													<label style="float:left;width:190px;" for="commune_INSEE_number">Numéro INSEE de la commune :</label><input type="text" name="commune_INSEE_number" id="commune_INSEE_number" /><br /><br />
													<label style="float:left;width:190px;" for="ref_IM">Référence IM :</label><input type="text" name="ref_IM" id="ref_IM" /><br /><br />
													<label style="float:left;width:190px;" for="ref_PA">Référence PA :</label><input type="text" name="ref_PA" id="ref_PA" /><br /><br />
													<label style="float:left;width:190px;" for="ref_IA">Référence IA :</label><input type="text" name="ref_IA" id="ref_IA" /><br /><br />
													</br>
													<label style="float:left;width:190px;" for="famille">Famille :</label><input type="text" name="famille" id="famille" /><br /><br />
													<label style="float:left;width:190px;" for="individu">Individu :</label><input type="text" name="individu" id="individu" /><br /><br />
													<label style="float:left;width:190px;" for="qualite">Biographie :</label><input type="text" name="qualite" id="qualite" /><br /><br />
													<label style="float:left;width:190px;" for="date">Date :</label><input type="text" name="date" id="date" /><br /><br />
													<label style="float:left;width:190px;" for="denomination">Dénomination :</label><input type="text" name="denomination" id="denomination" /><br /><br />
													<label style="float:left;width:190px;" for="titre">Titre :</label><input type="text" name="titre" id="titre" /><br /><br />
												</div>
												<div style="float:right;margin-right:20px;">
													<label style="float:left;width:190px;" for="categorie">Catégorie :</label><input type="text" name="categorie" id="categorie" /><br /><br />
													<label style="float:left;width:190px;" for="materiau">Matériau :</label><input type="text" name="materiau" id="materiau" /><br /><br />
													<label style="float:left;width:190px;" for="cimiers">Cimiers :</label><textarea cols="20" rows="4" name="cimiers" id="cimiers" ></textarea><br /><br />
													<label style="float:left;width:190px;" for="blasonnement_1">Blasonnement_1 :</label><textarea cols="20" rows="4" name="blasonnement_1" id="blasonnement_1" ></textarea><br /><br />
													<label style="float:left;width:190px;" for="blasonnement_2">Blasonnement_2 :</label><textarea cols="20" rows="4" name="blasonnement_2" id="blasonnement_2" ></textarea><br /><br />

													</br>
													<label style="float:left;width:190px;" for="ref_reproductions">reférence reproductions :</label><input type="text" name="ref_reproductions" id="ref_reproductions" /><br /><br />
													<label style="float:left;width:190px;" for="biblio">bibliographie :</label><textarea cols="20" rows="4" name="biblio" id="biblio" ></textarea><br /><br />
													<label style="float:left;width:190px;" for="remarques">Remarques :</label><textarea cols="20" rows="4" name="remarques" id="remarques" ></textarea><br /><br />
													</br>
													<label style="float:left;width:190px;" for="auteurs">Auteur(s) :</label><input type="text" name="auteurs" id="auteurs" /><br /><br />
													<label style="float:left;width:190px;" for="lieu_edition">Lieu d'édition :</label><input type="text" name="lieu_edition" id="lieu_edition" /><br /><br />
													<label style="float:left;width:190px;" for="editeur">Editeur :</label><input type="text" name="editeur" id="editeur" /><br /><br />
													<label style="float:left;width:190px;" for="annee_edition">Année d'édition :</label><input type="text" name="annee_edition" id="annee_edition" /><br /><br />
													<label style="float:left;width:190px;" for="reliure">Reliure :</label><input type="text" name="reliure" id="reliure" /><br /><br />
													<label style="float:left;width:190px;" for="provenance">Provenance :</label><textarea cols="20" rows="4" name="provenance" id="provenance" ></textarea><br /><br />
													<label style="float:left;width:190px;" for="site">Site :</label><textarea cols="20" rows="4" name="site" id="site" ></textarea><br /><br />
													<label style="float:left;width:190px;" for="section">Section :</label><input type="text" name="section" id="section" /><br /><br />
													<label style="float:left;width:190px;" for="cote">Numéro ou cote :</label><input type="text" name="cote" id="cote" /><br /><br />
													<label style="float:left;width:190px;" for="folio_emplacement">Folio ou emplacement :</label><input type="text" name="folio_emplacement" id="folio_emplacement" /><br /><br />



													<input type='hidden' name='anc_onglet' id='anc_onglet' value='image' />
													<input type="submit" name="submit_ajout_manuel_image" value="Ajouter" />
												</div>
											</form>
										<?php } else {  ?>
											<?php echo $manuel; ?>
											<h4><a href="javascript:history.back()"><<< Retour sur le formulaire </a></h4>
										<?php } ?>

									</div>
								</fieldset>
							</div>

							<!--Partie de modification des donnees de la base-->
							<div class="contenu_onglet" id="contenu_onglet_modif">
								<fieldset style="background-color:white;">
									<legend><strong><font color="#A42903">Modification de contenu</font></strong></legend>
									<h3><center><a href='#photos' onclick='visibilite("modif");'>Modification manuelle de contenu</a></center></h3><br />
									<div id='modif' style="display:block;">

										<form method="post" action="<?php echo base_url(); ?>administration" id="lc_form">
											<a href='#' onclick="change_lc('a');">A</a> - <a href='#' onclick="change_lc('b');">B</a> - <a href='#' onclick="change_lc('c');">C</a> - <a href='#' onclick="change_lc('d');">D</a> - <a href='#' onclick="change_lc('e');">E</a>
											- <a href='#' onclick="change_lc('f');">F</a> - <a href='#' onclick="change_lc('g');">G</a> - <a href='#' onclick="change_lc('h-i-j-k');">H/I/J/K</a> - <a href='#' onclick="change_lc('l');">L</a> - <a href='#' onclick="change_lc('m');">M</a>
											- <a href='#' onclick="change_lc('n');">N</a> - <a href='#' onclick="change_lc('o-p-q');">O/P/Q</a> - <a href='#' onclick="change_lc('r');">R</a> - <a href='#' onclick="change_lc('s');">S</a> - <a href='#' onclick="change_lc('t');">T</a>
											- <a href='#' onclick="change_lc('u-v');">U/V</a> - <a href='#' onclick="change_lc('w-x-y-z');">W/X/Y/Z</a>
											<input type="hidden" name="lc" id="lc" value="" />
											<input type="hidden" name="anc_onglet" value="modif" />
										</form>
										<div id='photos' style='display:block;width:820px;'>
											<table id="table_obj" border='1' style="border-collapse:collapse; width:100%;">
												<thead>
												<tr>
													<th></th>
													<th>Patronyme</th>
													<th>Photos</th>
													<th>Prenom</th>
													<th>Famille</th>
													<th>Titres & dignités</th>
													<th>Origine</th>
													<th>Alliances</th>
													<th>Date</th>
													<th>Siècle</th>
													<th>Fief</th>
													<th>Pays</th>
													<th>Province</th>
													<th>Région</th>
													<th>Département</th>
													<th>Ville</th>
													<th>Notes & observations</th>
													<th>Images genealogie</th>
													<th>Images doc</th>
													<th>Sources</th>
													<th>Généalogie</th>
													<th>Document</th>
													<th>Notes armoriaux</th>
													<th>Timbre</th>
													<th>Cimier</th>
													<th>Devise, cri</th>
													<th>Tenants, support</th>
													<th>Décoration</th>
													<th>Ornements extérieurs</th>
													<th>Emblèmes</th>
													<th>blasonnement_1</th>
													<th>blasonnement_2</th>
													<th>blasonnement_3</th>
												</tr>
												</thead>
												<tbody>
												<?php foreach($donnees_modif as $data1) {
													$images='';?>
													<tr>
														<td>
															<a href='#' onclick="getFiche(<?php echo $data1['id']; ?>,'armorial');return false;" title="<?php echo $data1['id']; ?>">Modifier</a>
															<br /><br /><br /><br />
															<a href='#' onclick="ConfirmMessage(<?php echo $data1['id']; ?>);"><img width="15px" src="<?php echo base_url() ?>ressources/images/supprimer.png" /></a>
															<form method="post" action="<?php echo base_url(); ?>administration" id="supp_form_<?php echo $data1['id']; ?>">
																<input type="hidden" name="tab_supp" value="armorial"/>
																<input type="hidden" name="id_supp" value="<?php echo $data1['id']; ?>"/>
															</form>
														</td>
														<td><?php if (!empty($data1['patronyme'])){ echo $data1['patronyme']; }?></td>
														<td>
															<div id="espace_photo<?php echo $data1['id']; ?>" style="display:block;">
																<?php foreach($donnees_images as $image){ ?>
																	<?php if($image['vedette_chandon']==$data1['patronyme']){
																		?>
																		<a href='#' onclick="getFiche(<?php echo $image['id']; ?>,'legende_photos');return false;" title="Modifier photo n°<?php echo $image['id']; ?>"><img src="<?php echo base_url(); ?>ressources/images/<?php echo $image['libellé_image']; ?>.jpg" width="50px" /></a><br /><br />
																	<?php }
																} ?>

														</td>
														<td><?php if (!empty($data1['prenom'])){ echo $data1['prenom']; }?></td>
														<td><?php if (!empty($data1['famille'])){ echo $data1['famille']; }?></td>
														<td><?php if (!empty($data1['titres_dignites'])){ echo $data1['titres_dignites']; }?></td>
														<td><?php if (!empty($data1['origine'])){ echo $data1['origine']; }?></td>
														<td><?php if (!empty($data1['alliances'])){ echo $data1['alliances']; }?></td>
														<td><?php if (!empty($data1['date'])){ echo $data1['date']; }?></td>
														<td><?php if (!empty($data1['siecle'])){ echo $data1['siecle']; }?></td>
														<td><?php if (!empty($data1['fief'])){ echo $data1['fief']; }?></td>
														<td><?php if (!empty($data1['pays'])){ echo $data1['pays']; }?></td>
														<td><?php if (!empty($data1['province'])){ echo $data1['province']; }?></td>
														<td><?php if (!empty($data1['region'])){ echo $data1['region']; }?></td>
														<td><?php if (!empty($data1['department'])){ echo $data1['department']; }?></td>
														<td><?php if (!empty($data1['ville'])){ echo $data1['ville']; }?></td>
														<td><?php if (!empty($data1['notes'])){ echo $data1['notes']; }?></td>
														<td><?php if (!empty($data1['images_geneal'])){ echo $data1['images_geneal']; }?></td>
														<td><?php if (!empty($data1['images_doc'])){ echo $data1['images_doc']; }?></td>
														<td><?php if (!empty($data1['sources'])){ echo $data1['sources']; }?></td>
														<td><?php if (!empty($data1['genealogie'])){ echo $data1['genealogie']; }?></td>
														<td><?php if (!empty($data1['document'])){ echo $data1['document']; }?></td>
														<td><?php if (!empty($data1['notes_armoriaux'])){ echo $data1['notes_armoriaux']; }?></td>
														<td><?php if (!empty($data1['timbre'])){ echo $data1['timbre']; }?></td>
														<td><?php if (!empty($data1['cimier'])){ echo $data1['cimier']; }?></td>
														<td><?php if (!empty($data1['devise_cri'])){ echo $data1['devise_cri']; }?></td>
														<td><?php if (!empty($data1['tenants_support'])){ echo $data1['tenants_support']; }?></td>
														<td><?php if (!empty($data1['decoration'])){ echo $data1['decoration']; }?></td>
														<td><?php if (!empty($data1['ornements_ext'])){ echo $data1['ornements_ext']; }?></td>
														<td><?php if (!empty($data1['emblemes'])){ echo $data1['emblemes']; }?></td>
														<td><?php if (!empty($data1['blasonnement_1'])){ echo $data1['blasonnement_1']; }?></td>
														<td><?php if (!empty($data1['blasonnement_2'])){ echo $data1['blasonnement_2']; }?></td>
														<td><?php if (!empty($data1['blasonnement_3'])){ echo $data1['blasonnement_3']; }?></td>
													</tr>
												<?php } ?>
												</tbody>
											</table>
										</div>
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
                <td><a href="administration?anc_onglet=contenus&sup=1&id=<?php echo $data['id']; ?>"><img width="15px" src="<?php echo base_url() ?>ressources/images/supprimer.png" id="supp_form_<?php echo $data['id'];?>" title="Supprimer" />
		<input type="hidden" name="tab_supp" value="equivalences"/>
		<input type="hidden" name="id_supp" value="<?php echo $data['id']; ?>"/>
</a></td>
                <td><?php echo $data['expression']; ?></td>
                <td><?php echo $data['signification']; ?></td>
            </tr>
            <?php
                }
            ?>
            </tbody>
            </table>
            <center><div id="new_equivalence" style="display:none;">
                <form method="post" action="">
                    <input type="text" name="mot_1" size="31"/><input type="text" name="mot_2" size="31"/><br />
                    <input type='hidden' name='anc_onglet' id='anc_onglet' value='contenus' />
                    <input type="submit" name="ajout_equivalence" value="Ajouter l'équivalence" />
                </form>
                </div></center>
        <center><div id="ajout" style="display:block;"><a href="#ajout" onclick="visibilite('ajout');visibilite('new_equivalence');"><img width="15px" src="<?php echo base_url() ?>ressources/images/croix.png" title="Ajouter une équivalence"/></a></div></center>


    </fieldset><br /><br />				
								
<fieldset style="background-color:white;">
<legend><strong><font color="#A42903">Ajout de contenu par fichier Excel</font></strong></legend>
 <?php if(!isset($_FILES['mediatheque'])){ ?>
	<form method="post" action="" enctype="multipart/form-data">
			<label style="float:left;width:190px;" for="mediatheque">Armorial :</label>
			<input type="file" name="mediatheque" id="mediatheque" />
                        <input type='hidden' name='anc_onglet' id='anc_onglet' value='modif' />
                        <input type="submit" name="submit" value="Ajouter" /> &nbsp;<a href="<?php echo base_url(); ?>ressources/fichiers/Excel_Europe_type.xls">Générer un ficher Excel type (non fini)</a>
		</form>
<?php } else{
		echo "Vous n'avez pas saisi de fichier!"; ?>
		<h4><a href="javascript:history.back()"><<< Retour sur le formulaire </a></h4>
	<?php
		}
	?>
</fieldset>
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
		<td><center><a style="font-size:200%;" href='#' onclick="getFiche(<?php echo $idrecherche; ?>,'armorial');return false;" title=<?php echo $idrecherche; ?>><?php if ($idtitre!= NULL) {echo $idtitre;}  else { echo $idtitre2;} ?></a></center></td>
	<?php	}
	
			if (isset($_POST['recherche_id']) && $idrecherche=="") { ?> 
		      <br /> Désolé, mais il n'existe pas d'entrée pour cette ID. Vérifiez l'écriture et réessayez. ID saisi: <strong><?php if ($_POST['recherche_id']=="") {  echo 'Aucune';}  else {echo $_POST['recherche_id'];} ?></strong><br /><br />		
		
	<?php 	} ?>
		
		</fieldset> </div>

							<!-- Partie administration-->
							<div class="contenu_onglet" id="contenu_onglet_admin">
								<fieldset style='background-color:white;'>
									<legend><strong><font color="#A42903">Administration</font></strong></legend><br />

									<h3><center><a href='#' onclick='visibilite("mdp");'>Changement de mot de passe</a></center></h3><br />
									<div id='mdp' style="display:block;">
										<?php if($acces==""){ ?>
											<form method="post" action="">
												<label style="float:left;width:190px;" for="login">Login :</label><input type="text" name="login" id="login" /><br /><br />
												<label style="float:left;width:190px;" for="mdp_actuel">Mot de passe actuel :</label><input type="password" name="mdp_actuel" id="mdp_actuel" /><br /><br />
												<input type='hidden' name='anc_onglet' id='anc_onglet' value='admin' />
												<input type="submit" name="submit" value="Valider" />
											</form>
										<?php }
										elseif($acces=="true"){ ?>
											<form method="post" action="">
												<label style="float:left;width:190px;" for="new_mdp">Nouveau mot de passe :</label><input type="password" name="new_mdp" id="new_mdp" /><br /><br />
												<label style="float:left;width:190px;" for="new_mdp_bis">Saisissez de nouveau :</label><input type="password" name="new_mdp_bis" id="new_mdp_bis" /><br /><br />
												<input type='hidden' name='anc_onglet' id='anc_onglet' value='admin' />
												<input type="submit" name="submit" value="Valider" />
											</form>
										<?php }
										else {
											echo $acces; ?>
											<h4><a onclick="window.history.go(-2)"><<< Retour sur le formulaire </a></h4>
										<?php } ?>
									</div>
								</fieldset>
							</div>

							
							
							<!-- Partie presentation-->
							<div class="contenu_onglet" id="contenu_onglet_presentation">
								<fieldset style='background-color:white;'>
									<legend><strong><font color="#A42903">Modification de la présentation</font></strong></legend><br />

									<h3><center><a href='#' onclick='visibilite("presentation");'>Présentation</a></center></h3><br />
									<div id='mdp' style="display:block;">
										<?php foreach($presentation_europe as $presentation){ ?>
											<form method="POST" action="">
												<textarea name="update_presentation" id="tinymce_presentation" style="width:100%; height:300px;"><?php echo html_entity_decode($presentation->description); ?></textarea>
												<input type="submit" value="Modifier la présentation"/>
											</form>
										<?php } ?>
								</fieldset>
							</div>

						</div>
					</div>
				<?php }
				else { ?>
					<!-- Si l'admin n'est pas connecté on le renvoit sur la page identification -->
					<center><h3>Administration</h3></center>

					<?php header("Location: ".base_url().'administration/identification'); ?>

				<?php }
				//} ?>
				<div id="fiche" title="Modification des informations"></div> <!--Div pour l'affichage de la fiche de modif -->

				<script type="text/javascript">
					var anc_onglet = '<?php
						if(isset($_SESSION['anc_onglet']))
							echo $_SESSION['anc_onglet'];
						else
							echo 'modif';?>';

					change_onglet(anc_onglet);

					function change_lc(lettre){
						document.getElementById("lc").value=lettre;
						document.getElementById("lc_form").submit();
					}


				</script>

				<!-- fermeture des balises ouvertes dans la vue header.php-->
				<div style="clear: both;">&nbsp;</div>
			</div>

			<!-- fermeture des balises ouvertes dans la vue header.php-->
			<div style="clear: both;">&nbsp;</div>
		</div>
	</div>
</div>

</div><!-- page -->
