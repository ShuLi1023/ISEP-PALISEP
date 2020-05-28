<!-- Si l'administrateur est connecté -->
<?php if ($connecte == true){
	//$requete = $this->db->query("UPDATE armorial SET siècle='médiéval' WHERE siècle='XIIIe s.'"); 
	//$requete = $this->db->query("CREATE TABLE armorial4 AS SELECT * FROM armorial WHERE 21=2");
?>

<div class="corps">
	
	<h3><center>Espace d'administration</center></h3>
		
	<br /><br />
	
	<div class="onglets">
		<span class="onglet_0 onglet" id="onglet_admin" onclick="javascript:change_onglet('admin');">Administrateur</span>
        <span class="onglet_0 onglet" id="onglet_contenus" onclick="javascript:change_onglet('contenus');">Gestion des contenus</span>
        <span class="onglet_0 onglet" id="onglet_recherche" onclick="javascript:change_onglet('recherche');">Recherche ID</span>
        <span class="onglet_0 onglet" id="onglet_presentation" onclick="javascript:change_onglet('presentation');">Présentation</span>
		
	</div>
	
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
					<h4><a href="javascript:history.back()"><<< Retour sur le formulaire </a></h4>
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
						
					</fieldset><br /><br />
					
					<fieldset style='background-color:white;'>
						<legend><strong><font color="#A42903">Options Recherche Publique</font></strong><a href="#" class="info"><img src="<?php echo base_url(); ?>resources/images/aide.gif"/><span><?php echo $bulle_switchrecherche; ?></span></a></legend><br />
						Autoriser la recherche publique ?
						<form method="post" action="">
                            <select name="soap" id="soap">
                                <option <?php if ($current_publique == '1') {  ?> selected <?php } ?> value="1" name="yes">oui</option>
                                <option <?php if ($current_publique == '0') {  ?> selected <?php } ?> value="0" name="no">non</option>
                            </select>
                            <input type="submit" value="Valider">
                        </form>
                        <!-- Étrangement la valeur current_publique est l'inverse de celle qu'on pourrait attendre, elle ne s'actualise pas après la requête (elle est au dom avant la requête)... !-->
                        <?php if (isset($_POST['soap']) && $current_publique == '0') { echo 'La recherche publique a été activée.';} else if (isset($_POST['soap']) && $current_publique == '1') { echo 'La recherche publique a été désactivée.';}  ?>
					</fieldset>
				</div>
				
				<div class="contenu_onglet" id="contenu_onglet_recherche">
					<fieldset style='background-color:white;'>
						<legend><strong><font color="#A42903">Recherche par ID</font></strong></legend><br />
						
						<form method="get" action="">
							<label style="float:left;width:190px;" for="recherche_id"> Saisir une ID :</label>
							<input type="text" name="recherche_id" /><br /><br />
							<input type='hidden' name='anc_onglet' id='anc_onglet' value='recherche' />
							<input type="submit" name="submit" value="Rechercher" />
						</form>
						
						<?php 	if(isset($_GET['recherche_id']) && $_GET['recherche_id']!=="" && $idrecherche!==""){  ?>
							<br /> Entrée trouvée pour l'ID <strong><?php echo $_GET['recherche_id']; ?> :</strong><br /><br />
							<td><center><a style="font-size:200%;" href='#' onclick="getFiche(<?php echo $idrecherche; ?>,'armorial');return false;" title=<?php echo $idrecherche; ?>><?php if ($idtitre!= NULL) {echo $idtitre;}  else { echo $idtitre2;} ?></a></center></td>
							<?php	}
							
							if (isset($_GET['recherche_id']) && $idrecherche=="") { ?> 
							<br /> Désolé, mais il n'existe pas d'entrée pour cette ID. Vérifiez l'écriture et réessayez. ID saisi: <strong><?php if ($_GET['recherche_id']=="") {  echo 'Aucune';}  else {echo $_GET['recherche_id'];} ?></strong><br /><br />		
							
						<?php 	} ?>
						
					</fieldset>
				</div>
				
				
				<div class="contenu_onglet" id="contenu_onglet_contenus">
					
					<fieldset style='background-color:white;'>
						<legend><strong><font color="#A42903">Mise à jour de la base par le fichier Excel</font></strong><a href="#" class="info"><img src="<?php echo base_url(); ?>resources/images/aide.gif"/><span><?php echo $bulle_excel; ?></span></a></legend><br />
						
						<?php if(!isset($_FILES['familles']) && !isset($_FILES['mediatheque'])){ ?>
							<form method="post" action="<?php echo base_url()."administration?anc_onglet=contenus"; ?>" enctype="multipart/form-data">
								<label style="float:left;width:190px;" for="mediatheque">Objets :</label>
								<input type="file" name="mediatheque" id="mediatheque" />
								<input type='hidden' name='anc_onglet' id='anc_onglet' value='contenus' />
								<input type="submit" name="submit" value="Ajouter" /> &nbsp;<a href="<?php echo base_url(); ?>resources/fichiers/Excel_objets_type.xls">Générer un ficher Excel type</a>
							</form>
							
							<form method="post" action="<?php echo base_url()."administration?anc_onglet=contenus"; ?>" enctype="multipart/form-data">
								<label style="float:left;width:190px;" for="familles">Familles :</label>
								<input type="file" name="familles" id="familles" />
								<input type='hidden' name='anc_onglet' id='anc_onglet' value='contenus' />
								<input type="submit" name="submit" value="Ajouter" /> &nbsp;<a href="<?php echo base_url(); ?>resources/fichiers/Excel_armorial_type.xls">Générer un ficher Excel type</a>
							</form>
							
							<!--<form method="post" action="" enctype="multipart/form-data">
								<label style="float:left;width:190px;" for="excels">Word/Excel :</label>
								<input type="file" name="excels" id="excels" />
								<input type='hidden' name='anc_onglet' id='anc_onglet' value='contenus' />
								<input type="submit" name="submit" value="Ajouter" />
							</form>-->
							
							<?php } else{
							echo $transfert; ?>
							<h4><a href="javascript:history.back()"/><<< Retour sur le formulaire </a></h4>
								<?php
								}
								?>
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
								
								<fieldset style='background-color:white;'>
								<legend><strong><font color="#A42903">Dictionnaire</font></strong></legend><br />
								
								<a href="#dico_armes" onclick='visibilite("dico_armes");'>Générer un document Word des armes</a><br /><br />
								<div id="dico_armes" style="display:none;">
								<?php
								for($j=0;$j<=$nbre_lignes;$j++){
								?>
								<a href="<?php echo base_url(); ?>administration?hist=<?php echo 5000*$j;echo",";echo 5000*$j+4999;?>">Document Word des armes (part<?php echo $j+1; ?>)</a><br />
								<?php
								}
								?>
								</div>
								
								</fieldset><br /><br />
								
								<fieldset style='background-color:white;'>
								<legend><strong><font color="#A42903">Aire géographique</font></strong></legend><br />
								
								<table id="table_aire" border='1' style="border-collapse:collapse; width:50%;">
								<thead>
								<tr>
								<th></th>
								<th>Aire géographique</th>
								<th>Lieu</th>
								</tr>
								</thead>
								<tbody>
								<tr>
								<td></td>
								<td>Nord</td>
								<td></td>
								</tr>
								<tr>
								<td></td>
								<td>Centre</td>
								<td></td>
								</tr>
								<tr>
								<td></td>
								<td>Sud</td>
								<td></td>
								</tr>
								<tr>
								<td></td>
								<td>Est</td>
								<td></td>
								</tr>
								<tr>
								<td></td>
								<td>Ouest</td>
								<td></td>
								</tr>
								</tbody>
								</table>
								
								</fieldset><br /><br />
								
								<fieldset style='background-color:white;'>
								<legend><strong><font color="#A42903">Modification des contenus</font></strong><a href="#" class="info"><img src="<?php echo base_url(); ?>resources/images/aide.gif"/><span><?php echo $bulle_contenus; ?></span></a></legend><br />
                                <h3><center><a href='#arm' onclick='visibilite("arm");'>Armorial</a></center></h3><br /><br />

                                <div id='arm' style='display:block;width:840px;'>
                                <?php echo "<a href='".base_url()."administration?anc_onglet=contenus&la=a'>A</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=b'>B</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=c'>C</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=d'>D</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=e'>E</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=f'>F</a>
                                - <a href='".base_url()."administration?anc_onglet=contenus&la=g'>G</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=h'>H</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=i-j-k'>I/J/K</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=l'>L</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=m'>M</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=n'>N</a>
                                - <a href='".base_url()."administration?anc_onglet=contenus&la=/o-p-q'>O/P/Q</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=r'>R</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=s'>S</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=t'>T</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=u-v'>U/V</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=w-x-y-z'>W/X/Y/Z</a>
                                ";?>
                                <table border='1' id="table_armorial" style="border-collapse:collapse; width:100%;">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Famille</th>
                                        <th>Prénom</th>
                                        <th>Titres/Dignités</th>
                                        <th>Origine</th>
                                        <th>Date</th>
                                        <th>Siècle</th>
                                        <th>Fief</th>
                                        <th>Région</th>
                                        <th>Département</th>

                                        <th>Pays</th>
                                        <th>Aire</th>

                                        <th>Alliances</th>
                                        <th>Notes</th>
                                        <th>Armes</th>
                                        <th>Cimiers</th>
                                        <th>Devise</th>
                                        <th>Emblème</th>
                                        <th>Lambrequins</th>
                                        <th>Tenant/Support</th>
                                        <th>Observations</th>
                                        <th>Références biblio.</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($donnees_armorial as $data1) {
                                        $id = "a_".$data1['id'];
                                        ?>

                                        <tr id="<?php echo $id; ?>">
                                            <td>
                                                <a href='#' onclick="ConfirmMessage(<?php echo $data1['id']; ?>,6);"><img width="15px" src="<?php echo base_url() ?>resources/images/supprimer.png" /></a>
                                            </td>
                                            <td><a href='#' onclick="getFiche(<?php echo $data1['id']; ?>,'armorial');return false;" title=<?php echo $data1['id']; ?>><?php echo $data1['famille']; ?></a></td>
                                            <td><?php if (!empty($data1['prenom'])){ echo $data1['prenom']; }?></td>
                                            <td><?php if (!empty($data1['titres_dignites'])){ echo $data1['titres_dignites']; }?></td>
                                            <td><?php if (!empty($data1['origine'])){ echo $data1['origine']; }?></td>
                                            <td><?php if (!empty($data1['date'])){ echo $data1['date']; }?></td>
                                            <td><?php if (!empty($data1['siècle'])){ echo $data1['siècle']; }?></td>
                                            <td><?php if (!empty($data1['fief'])){ echo $data1['fief']; }?></td>
                                            <td><?php if (!empty($data1['région'])){ echo $data1['région']; }?></td>
                                            <td><?php if (!empty($data1['départment'])){ echo $data1['départment']; }?></td>

                                            <td><?php if (!empty($data1['pays'])){ echo $data1['pays']; }?></td>
                                            <td><?php if (!empty($data1['aire'])){ echo $data1['aire']; }?></td>

                                            <td><?php if (!empty($data1['alliances'])){ echo $data1['alliances']; }?></td>
                                            <td><?php if (!empty($data1['notes'])){ echo $data1['notes']; }?></td>
                                            <td><?php if (!empty($data1['blasonnement_1'])){ echo $data1['blasonnement_1']; }?></td>
                                            <td><?php if (!empty($data1['cimiers'])){ echo $data1['cimiers']; }?></td>
                                            <td><?php if (!empty($data1['devise'])){ echo $data1['devise']; }?></td>
                                            <td><?php if (!empty($data1['embleme'])){ echo $data1['embleme']; }?></td>
                                            <td><?php if (!empty($data1['lambrequins'])){ echo $data1['lambrequins']; }?></td>
                                            <td><?php if (!empty($data1['support'])){ echo $data1['support']; }?></td>
                                            <td><?php if (!empty($data1['observations'])){ echo $data1['observations']; }?></td>
                                            <td><?php if (!empty($data1['ref_biblio'])){ echo $data1['ref_biblio']; }?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                </div><br /><br />
								
								<fieldset style='background-color:white;'>
								<legend><strong><font color="#A42903"><a href='#man_armorial' onclick='visibilite("man_armorial");'>>>Ajout manuel</a></font></strong></legend><br />
								<div id="man_armorial" style="display:none;">
								<?php if($booleen==""){ ?>
								<form method="get" action="">
								<div style="float:left;margin-left:20px;">
								<label style="float:left;width:190px;" for="famille">Famille :</label><input type="text" name="famille" id="famille" /><br /><br />
								<label style="float:left;width:190px;" for="prenom">Prénom :</label><input type="text" name="prenom" id="prenom" /><br /><br />
								<label style="float:left;width:190px;" for="titres_dignites">Titres/dignités :</label><input type="text" name="titres_dignites" id="titres_dignites" /><br /><br />
								<label style="float:left;width:190px;" for="origine">Origine :</label><input type="text" name="origine" id="origine" /><br /><br />
								<label style="float:left;width:190px;" for="date">Date :</label><input type="text" name="date" id="date" /><br /><br />
								<label style="float:left;width:190px;" for="fief">Fief :</label><input type="text" name="fief" id="fief" /><br /><br />
								<label style="float:left;width:190px;" for="region">Région :</label><input type="text" name="region" id="region" /><br /><br />
								<label style="float:left;width:190px;" for="department">Département :</label><input type="text" name="department" id="department" /><br /><br />

                                <label style="float:left;width:190px;" for="pays">Pays :</label><input type="text" name="pays" id="pays" /><br /><br />
                                <label style="float:left;width:190px;" for="aire">Aire :</label><input type="text" name="aire" id="aire" /><br /><br />

                                <label style="float:left;width:190px;" for="alliances">Alliances :</label><input type="text" name="alliances" id="alliances" /><br /><br />
								<label style="float:left;width:190px;" for="notes">Notes :</label><input type="text" name="notes" id="notes" /><br /><br />
								<label style="float:left;width:190px;" for="blasonnement">Armes :</label><textarea cols="20" rows="4" name="blasonnement" id="blasonnement"></textarea><br /><br />
								
								</div>
								<div style="float:right;margin-right:20px;">
								<label style="float:left;width:190px;" for="cimiers">Cimiers :</label><textarea cols="20" rows="4" name="cimiers" id="cimiers"></textarea><br /><br />
								<label style="float:left;width:190px;" for="devise">Devise/Légende :</label><input type="text" name="devise" id="devise" /><br /><br />
								<label style="float:left;width:190px;" for="embleme">Emblème :</label><input type="text" name="embleme" id="embleme" /><br /><br />
								<label style="float:left;width:190px;" for="lambrequins">Lambrequins :</label><input type="text" name="lambrequins" id="lambrequins" /><br /><br />
								<label style="float:left;width:190px;" for="support">Tenant/support :</label><input type="text" name="support" id="support" /><br /><br />
								<label style="float:left;width:190px;" for="observations">Observations :</label><textarea cols="20" rows="4" name="observations" id="observations"></textarea><br /><br />
								<label style="float:left;width:190px;" for="ref_biblio">Références biblio. :</label><textarea cols="20" rows="4" name="ref_biblio" id="ref_biblio"></textarea><br /><br />
								<input type='hidden' name='anc_onglet' id='anc_onglet' value='contenus' />
								<input type="submit" name="manuel_armorial" value="Ajouter" />
								</div>
								</form>
								<?php }
								else{
								echo $manuel;
								?>
								<script>
								visibilite("man_armorial");
								</script>
								<h4><a href="<?php echo base_url()."administration?anc_onglet=contenus#man_armorial"; ?>"><<< Retour sur le formulaire </a></h4>
								<?php
								}
								?>
								</div>
								</fieldset><br /><br />
								
								<h3><center><a href='#obj' onclick='visibilite("obj");'>Objets/Livres</a></center></h3><br /><br />
								<div id='obj' style='display:block;width:840px;'>
								<?php echo "<a href='".base_url()."administration?anc_onglet=contenus&lo=a'>A</a> - <a href='".base_url()."administration?anc_onglet=contenus&lo=b'>B</a> - <a href='".base_url()."administration?anc_onglet=contenus&lo=c'>C</a> - <a href='".base_url()."administration?anc_onglet=contenus&lo=d'>D</a> - <a href='".base_url()."administration?anc_onglet=contenus&lo=e'>E</a> - <a href='".base_url()."administration?anc_onglet=contenus&lo=f'>F</a>
								- <a href='".base_url()."administration?anc_onglet=contenus&lo=g'>G</a> - <a href='".base_url()."administration?anc_onglet=contenus&lo=h-i-j-k'>H/I/J/K</a> - <a href='".base_url()."administration?anc_onglet=contenus&lo=l'>L</a> - <a href='".base_url()."administration?anc_onglet=contenus&lo=m'>M</a> - <a href='".base_url()."administration?anc_onglet=contenus&lo=n'>N</a>
								- <a href='".base_url()."administration?anc_onglet=contenus&lo=/o-p-q'>O/P/Q</a> - <a href='".base_url()."administration?anc_onglet=contenus&lo=r'>R</a> - <a href='".base_url()."administration?anc_onglet=contenus&lo=s'>S</a> - <a href='".base_url()."administration?anc_onglet=contenus&lo=t'>T</a> - <a href='".base_url()."administration?anc_onglet=contenus&lo=u-v'>U/V</a> - <a href='".base_url()."administration?anc_onglet=contenus&lo=w-x-y-z'>W/X/Y/Z</a>
								";?>
								<table border='1' id="table_objets" style="border-collapse:collapse;">
								<thead>
								<tr>
								<th></th>
								<th>Libellé image</th>
								<th>Vedette chandon</th>
								<th>Famille</th>
								<th>Individu</th>
								<th>Qualité</th>
								<th>Date</th>
								<th>Dénomination</th>
								<th>Titre</th>
								<th>Catégorie</th>
								<th>Matériau</th>
								<th>Références reproduction</th>
								<th>Biblio</th>
								<th>Remarques</th>
								<th>Auteurs</th>
								<th>Lieu édition</th>
								<th>Editeur</th>
								<th>Année édition</th>
								<th>Reliure</th>
								<th>Provenance</th>
								<th>Site</th>
								<th>Section</th>
								<th>Cote</th>
								<th>Folio emplacement</th>
								<th>Auteur cliché</th>
								<th>Type cliché</th>
								<th>Année cliché</th>
								<th>Pays</th>
								<th>Région</th>
								<th>Département</th>
								<th>Commune</th>
								<th>Village</th>
								<th>Edifice de conservation</th>
								<th>Emplacement dans l'édifice</th>
								<th>Photo</th>
								<th>N° INSEE commune</th>
								<th>Ref. IM</th>
								<th>Ref. PA</th>
								<th>Ref. IA</th>
								<th>Artificial number Decrock</th>
								</tr>
								</thead>
								<tbody>
								<?php
								foreach($donnees_objets as $data1) {
								$id = "o_".$data1['id'];
								
								$image = "";
								$images = explode(";", $data1['libellé_image']);
								for($i=0;$i<sizeof($images);$i++){
								$image.=$images[$i]." ";
								}
								?>
								<tr id="<?php echo $id; ?>">
								<td>
								<a href='#' onclick="ConfirmMessage(<?php echo $data1['id']; ?>,7);"><img width="15px" src="<?php echo base_url() ?>resources/images/supprimer.png" /></a>
								</td>
								<td>
								<div id="espace_photo<?php echo $data1['id']; ?>" style="display:block;">
								<a href='#' onclick="getFiche(<?php echo $data1['id']; ?>,'legende_photos');return false;" title=<?php echo $data1['id']; ?>><?php echo "<ul><li>".$image."</ul></li>"; ?></a><br /><br />
								<center><a href="#ajout_photo<?php echo $data1['id']; ?>" onclick="visibilite('ajout_photo<?php echo $data1['id']; ?>'); visibilite('espace_photo<?php echo $data1['id']; ?>')"><img width="20px" src="<?php echo base_url() ?>/resources/images/croix.png" alt="Ajouter d'autres photos" title="Ajouter d'autres photos"/></a></center>
								</div><br /><br />
								
								<div id="ajout_photo<?php echo $data1['id']; ?>" style="display:none;">
								<a href="#ajout_photo<?php echo $data1['id']; ?>" onclick="visibilite('ajout_photo<?php echo $data1['id']; ?>'); visibilite('espace_photo<?php echo $data1['id']; ?>')"><center><img width="20px" src="<?php echo base_url() ?>/resources/images/fleches_montantes.png" alt="Retour" title="Retour aux libellés"/></center></a><br /><br />
								<form method="post" action="" enctype="multipart/form-data">
								<input type="file" name="images_1" id="images_1" /><br />
								<center><span id="ajoutleschamps_2<?php echo $data1['id']; ?>"><a href="javascript:create_champ('ajoutleschamps',2,2<?php echo $data1['id']; ?>)" style="color:black;">Nouveau champs image</a></span></center><br /><br />
								<input type='hidden' name='id' id='id' value='<?php echo $data1['id']; ?>' />
								<input type='hidden' name='anc_onglet' id='anc_onglet' value='contenus' />
								<center><input type="submit" value="Ajouter" name="ajouter_photos_libelle"/></center>
								</form>
								</div>
								</td>
								<td><?php if (!empty($data1['vedette_chandon'])){ echo $data1['vedette_chandon']; }?></td>
								<td><?php if (!empty($data1['famille'])){ echo $data1['famille']; }?></td>
								<td><?php if (!empty($data1['individu'])){ echo $data1['individu']; }?></td>
								<td><?php if (!empty($data1['qualité'])){ echo $data1['qualité']; }?></td>
								<td><?php if (!empty($data1['date'])){ echo $data1['date']; }?></td>
								<td><?php if (!empty($data1['dénomination'])){ echo $data1['dénomination']; }?></td>
								<td><?php if (!empty($data1['titre'])){ echo $data1['titre']; }?></td>
								<td><?php if (!empty($data1['catégorie'])){ echo $data1['catégorie']; }?></td>
								<td><?php if (!empty($data1['matériau'])){ echo $data1['matériau']; }?></td>
								<td><?php if (!empty($data1['ref_reproductions'])){ echo $data1['ref_reproductions']; }?></td>
								<td><?php if (!empty($data1['biblio'])){ echo $data1['biblio']; }?></td>
								<td><?php if (!empty($data1['remarques'])){ echo $data1['remarques']; }?></td>
								<td><?php if (!empty($data1['auteurs'])){ echo $data1['auteurs']; }?></td>
								<td><?php if (!empty($data1['lieu_édition'])){ echo $data1['lieu_édition']; }?></td>
								<td><?php if (!empty($data1['editeur'])){ echo $data1['editeur']; }?></td>
								<td><?php if (!empty($data1['année_édition'])){ echo $data1['année_édition']; }?></td>
								<td><?php if (!empty($data1['reliure'])){ echo $data1['reliure']; }?></td>
								<td><?php if (!empty($data1['provenance'])){ echo $data1['provenance']; }?></td>
								<td><?php if (!empty($data1['site'])){ echo $data1['site']; }?></td>
								<td><?php if (!empty($data1['section'])){ echo $data1['section']; }?></td>
								<td><?php if (!empty($data1['cote'])){ echo $data1['cote']; }?></td>
								<td><?php if (!empty($data1['folio_emplacement'])){ echo $data1['folio_emplacement']; }?></td>
								<td><?php if (!empty($data1['auteur_cliché'])){ echo $data1['auteur_cliché']; }?></td>
								<td><?php if (!empty($data1['type_cliché'])){ echo $data1['type_cliché']; }?></td>
								<td><?php if (!empty($data1['année_cliché'])){ echo $data1['année_cliché']; }?></td>
								<td><?php if (!empty($data1['pays'])){ echo $data1['pays']; }?></td>
								<td><?php if (!empty($data1['région'])){ echo $data1['région']; }?></td>
								<td><?php if (!empty($data1['départment'])){ echo $data1['départment']; }?></td>
								<td><?php if (!empty($data1['commune'])){ echo $data1['commune']; }?></td>
								<td><?php if (!empty($data1['village'])){ echo $data1['village']; }?></td>
								<td><?php if (!empty($data1['edifice_conservation'])){ echo $data1['edifice_conservation']; }?></td>
								<td><?php if (!empty($data1['emplacement_dans_édifice'])){ echo $data1['emplacement_dans_édifice']; }?></td>
								<td><?php if (!empty($data1['photo'])){ echo $data1['photo']; }?></td>
								<td><?php if (!empty($data1['commune_INSEE_number'])){ echo $data1['commune_INSEE_number']; }?></td>
								<td><?php if (!empty($data1['ref_IM'])){ echo $data1['ref_IM']; }?></td>
								<td><?php if (!empty($data1['ref_PA'])){ echo $data1['ref_PA']; }?></td>
								<td><?php if (!empty($data1['ref_IA'])){ echo $data1['ref_IA']; }?></td>
								<td><?php if (!empty($data1['artificial_number_Decrock'])){ echo $data1['artificial_number_Decrock']; }?></td>
								</tr>
								<?php } ?>
								</tbody>
								</table>
								</div><br />/<br />
								
								<fieldset style='background-color:white;'>
								<legend><strong><font color="#A42903"><a href='#man_obj' onclick='visibilite("man_obj");'>>>Ajout manuel</a></font></strong></legend><br />
								<div id="man_obj" style="display:none;">
								<?php if($manuel==""){ ?>
								<form method="post" action="<?php echo base_url()."administration?anc_onglet=contenus"; ?>" enctype="multipart/form-data">
								<div style="float:left;margin-left:20px;">
								
								<label style="float:left;width:190px;" for="images_1">Images (fichier .jpg):</label><br />
								<input type="file" name="images_1" id="images_1" /><br />
								<center><span id="leschamps_2" style="float:left;"><a href="javascript:create_champ('leschamps',2,2)">Nouveau champs image</a></span></center><br /><br />
								
								<label style="float:left;width:190px;" for="vedette_chandon">Vedette chandon :</label><input type="text" name="vedette_chandon" id="vedette_chandon" /><br /><br />
								<label style="float:left;width:190px;" for="famille">Famille :</label><input type="text" name="famille" id="famille" /><br /><br />
								<label style="float:left;width:190px;" for="individu">Individu :</label><input type="text" name="individu" id="individu" /><br /><br />
								<label style="float:left;width:190px;" for="qualite">Qualité :</label><input type="text" name="qualite" id="qualite" /><br /><br />
								<label style="float:left;width:190px;" for="date">Date :</label><input type="text" name="date" id="date" /><br /><br />
								<label style="float:left;width:190px;" for="denomination">Dénomination :</label><input type="text" name="denomination" id="denomination" /><br /><br />
								<label style="float:left;width:190px;" for="titre">Titre :</label><input type="text" name="titre" id="titre" /><br /><br />
								<label style="float:left;width:190px;" for="categorie">Catégorie :</label><input type="text" name="categorie" id="categorie" /><br /><br />
								<label style="float:left;width:190px;" for="materiau">Matériau :</label><input type="text" name="materiau" id="materiau" /><br /><br />
								<label style="float:left;width:190px;" for="ref_reproductions">Ref. reproductions :</label><input type="text" name="ref_reproductions" id="ref_reproductions" /><br /><br />
								<label style="float:left;width:190px;" for="biblio">Bibliographie :</label><input type="text" name="biblio" id="biblio" /><br /><br />
								<label style="float:left;width:190px;" for="remarques">Remarques :</label><input type="text" name="remarques" id="remarques" /><br /><br />
								<label style="float:left;width:190px;" for="auteurs">Auteurs :</label><input type="text" name="auteurs" id="auteurs" /><br /><br />
								<label style="float:left;width:190px;" for="lieu_edition">Lieu édition :</label><input type="text" name="lieu_edition" id="lieu_edition" /><br /><br />
								<label style="float:left;width:190px;" for="editeur">Editeur :</label><input type="text" name="editeur" id="editeur" /><br /><br />
								<label style="float:left;width:190px;" for="annee_edition">Année édition :</label><input type="text" name="annee_edition" id="annee_edition" /><br /><br />
								<label style="float:left;width:190px;" for="reliure">Reliure :</label><input type="text" name="reliure" id="reliure" /><br /><br />
								
								</div>
								<div style="float:right;margin-right:20px;">
								<label style="float:left;width:190px;" for="provenance">Provenance :</label><input type="text" name="provenance" id="provenance" /><br /><br />
								<label style="float:left;width:190px;" for="site">Site :</label><input type="text" name="site" id="site" /><br /><br />
								<label style="float:left;width:190px;" for="section">Section :</label><input type="text" name="section" id="section" /><br /><br />
								<label style="float:left;width:190px;" for="cote">Cote :</label><input type="text" name="cote" id="cote" /><br /><br />
								<label style="float:left;width:190px;" for="folio_emplacement">Folio emplacement :</label><input type="text" name="folio_emplacement" id="folio_emplacement" /><br /><br />
								<label style="float:left;width:190px;" for="auteur_cliche">Auteur cliché :</label><input type="text" name="auteur_cliche" id="auteur_cliche" /><br /><br />
								<label style="float:left;width:190px;" for="type_cliche">Type cliché :</label><input type="text" name="type_cliche" id="type_cliche" /><br /><br />
								<label style="float:left;width:190px;" for="annee_cliche">Année cliché :</label><input type="text" name="annee_cliche" id="annee_cliche" /><br /><br />
								<label style="float:left;width:190px;" for="pays">Pays :</label><input type="text" name="pays" id="pays" /><br /><br />
								<label style="float:left;width:190px;" for="region">Région :</label><input type="text" name="region" id="region" /><br /><br />
								<label style="float:left;width:190px;" for="department">Département :</label><input type="text" name="department" id="department" /><br /><br />
								<label style="float:left;width:190px;" for="commune">Commune :</label><input type="text" name="commune" id="commune" /><br /><br />
								<label style="float:left;width:190px;" for="village">Village :</label><input type="text" name="village" id="village" /><br /><br />
								<label style="float:left;width:190px;" for="edifice_conservation">Edifice conservation :</label><input type="text" name="edifice_conservation" id="edifice_conservation" /><br /><br />
								<label style="float:left;width:190px;" for="emplacement_dans_edifice">Emplacement ds édifice :</label><input type="text" name="emplacement_dans_edifice" id="emplacement_dans_edifice" /><br /><br />
								<label style="float:left;width:190px;" for="photo">Photo :</label><input type="text" name="photo" id="photo" /><br /><br />
								<label style="float:left;width:190px;" for="commune_INSEE_number">Commune INSEE nb. :</label><input type="text" name="commune_INSEE_number" id="commune_INSEE_number" /><br /><br />
								<label style="float:left;width:190px;" for="ref_IM">Ref IM :</label><input type="text" name="ref_IM" id="ref_IM" /><br /><br />
								<label style="float:left;width:190px;" for="ref_PA">Ref PA :</label><input type="text" name="ref_PA" id="ref_PA" /><br /><br />
								<label style="float:left;width:190px;" for="ref_IA">Ref IA :</label><input type="text" name="ref_IA" id="ref_IA" /><br /><br />
								<input type='hidden' name='anc_onglet' id='anc_onglet' value='admin' />
								<input type="submit" name="manuel_objet" value="Ajouter" />
								</div>
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
								</fieldset><br /><br />
								
								</fieldset>
								
								</div>
								<div class="contenu_onglet" id="contenu_onglet_presentation">
								
								<fieldset style='background-color:white;'>
								<legend><strong><font color="#A42903">Modification de la présentation</font></strong></legend><br />
								
								<h3><center><a href='#' onclick='visibilite("presentation");'>Présentation</a></center></h3><br />
								<div id='mdp' style="display:block;">
								<?php foreach($presentation_heraldique as $presentation){ ?>
								<form method="POST" action="">
								<textarea name="update_presentation" id="tinymce_presentation" style="width:100%; height:300px;"><?php echo html_entity_decode($presentation->description); ?></textarea>
								<input type="submit" value="Modifier la présentation"/>
								</form>
								<?php } ?>
								</fieldset><br /><br />
								
								
								
								</div>
								</div>
								
								<?php }else{ ?>
								<!-- Si l'admin n'est pas connect� on le renvoit sur la page identification -->
								<center><h3>Administration</h3></center>
								
								<?php header("Location: ".base_url().'administration/identification'); ?>
								
								<?php } ?>
								<div id="fiche" title="Modification des informations"></div>
								<!--<div id="loader"><center>Veuillez attendre le chargement du fichier</center><br /><center><img src="<?php echo base_url() ?>resources/images/ajax-loader.gif" /></center></div>-->
								<script type="text/javascript">
								var anc_onglet = '<?php
								if(isset($_GET['anc_onglet']))
								echo $_GET['anc_onglet'];
								else
								echo 'admin';
								?>';
								change_onglet(anc_onglet);
								</script>													