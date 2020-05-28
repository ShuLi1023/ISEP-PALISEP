


<div class="corps_resultat">
	<!-- Affichage des résultats-->
	<?php 
		/* ARMOIRIE MOTS ORDRE/DESORDRE*/
		if(isset($_POST['rechercher_desordre']) || isset($_POST['rechercher_ordre'])){ ?>
		<h4><a href="javascript:history.back()"><<< Retour sur le formulaire</a></h4>
			<h4 style="margin-left:70%">Nombre de Résultats : <?php echo count($donnees1) + count($donnees2); ?></h4>
			<center><table >	
				<tr rules="rows">
					<?php if($donnees1 != NULL){?>
						<!-- tri b1-->
						<td valign="top" >	
							<!-- ########################-->
							<table border="1" bordercolor="#C9C9C9" frame="hsides" rules="rows">
								<caption><strong>Version 1 des Armoiries</strong></caption>
								<?php	foreach($donnees1 as $data1) { 
									if($data1->blasonnement_1 != NULL){
									?>
									<tr>
										<!-- patronyme--><td ><li><strong><?php echo anchor('fiche/armorial/'.$data1->id, ucfirst(mb_strtolower($data1->famille,'UTF-8')));?></strong>, <!-- fief--><em><?php if (!empty($data1->fief)){ echo $data1->fief; }?></em></li>
											<!-- armorie--><strong>Armes 1 : </strong><font color="green" ><?php if (!empty($data1->blasonnement_1)){ echo $data1->blasonnement_1; }?></font>
											
											<!-- photos-->
											<br />
											<?php foreach($photos as $photo){ 
												if ($photo->vedette_chandon == $data1->patronyme){ ?>
												
												<a href="<?php echo PALISEP ; ?>resources/images/<?php echo $photo->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
													<img height="100px" src="<?php echo PALISEP ; ?>resources/images/<?php echo $photo->libellé_image; ?>.jpg"/>
												</a>
												<?php } 
											} ?> 
										</td>
									</tr>			 		 		 		 		 		 		 		 		 		 		 		 		 		
								<?php 
								}	} ?>
								</table>
								<!-- ########################""-->
								</td> 		 		 		 		 		 		 		 		 		 		 		 		 
								<?php } ?>
								
								<?php if($donnees2 != NULL){?>
								<!-- tri b2-->
								<td valign="top">	
								<!-- ########################-->
								<table style="margin-left:30px"border="1" bordercolor="#C9C9C9" frame="hsides" rules="rows" >
								<caption><strong>Version 2 des Armoiries</strong></caption>
								<?php	foreach($donnees2 as $data2) { 
								if($data2->blasonnement_2 != NULL){
								?>
								<tr>
								<!-- patronyme--><td width="40%"><li><strong><?php echo anchor('fiche/armorial/'.$data2->id, ucfirst(mb_strtolower($data2->famille,'UTF-8')));?></strong>, <!-- fief--><em><?php if (!empty($data2->fief)){ echo $data2->fief; }?></em></li>
								<!-- armorie--><strong>Armes 2 : </strong><font color="green" ><?php if (!empty($data2->blasonnement_2)){ echo $data2->blasonnement_2; }?></font>
								
								<!-- photos-->
								<br />
								<?php foreach($photos as $photo){ 
								if ($photo->vedette_chandon == $data2->patronyme){ ?>
								
								<a href="<?php echo PALISEP ; ?>resources/images/<?php echo $photo->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
								<img height="100px" src="<?php echo PALISEP ; ?>resources/images/<?php echo $photo->libellé_image; ?>.jpg"/>
								</a>
								<?php } 
								} ?> 
								</td>
								</tr>			 		 		 		 		 		 		 		 		 		 		 		 		 		
								<?php 
								}	} ?>
								</table>
								<!-- ########################""-->
								</td> 		 		 		 		 		 		 	
								<?php } ?>
								</tr>
								</table></center>
								<?php 		
								}
								?>
								<!-- RESULTATS PATRONYME -->
								<?php 
								if(isset($_POST['rechercher_patronyme']) || isset($_POST['rechercher_region']) || isset($_POST['rechercher_fief']) || isset($_POST['rechercher_departement']) || isset($_POST['rechercher_siecle']) || isset($_POST['rechercher_siecle2']) || isset($_POST['recherche_id'])){ ?>
								<h4><a href="javascript:history.back()"><<< Retour sur le formulaire</a></h4>
								<h4 style="margin-left:70%">Nombre de Résultats : <?php echo count($donnees); ?></h4>
								<center><table border="1" bordercolor="#C9C9C9" frame="hsides" rules="rows">
								<?php foreach($donnees as $data) { ?>
								<tr>
								<!-- patronyme--><td width="40%"><li><strong><?php echo anchor('fiche/armorial/'.$data->id, ucfirst (mb_strtolower($data->famille,'UTF-8')));?></strong></li>
								<!-- fief--><em><?php if (!empty($data->fief)){ echo $data->fief; }?></em></td>
								<!-- photos-->
								<td align="right" >
								<?php foreach($photos as $photo){ 
								if ($photo->vedette_chandon == $data->patronyme){ ?>
								
								<a href="<?php echo PALISEP ; ?>resources/images/<?php echo $photo->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
								<img height="100px" src="<?php echo PALISEP ; ?>resources/images/<?php echo $photo->libellé_image; ?>.jpg"/>
								</a>
								<?php } 
								} ?> 
								</td>
								</tr>			 		 		 		 		 		 		 		 		 		 		 		 		 		
								<?php 
								}	?>
								</table></center>
								<?php 
								} 
								?>
								</div>
								<div class="corps">
								<!-- sinon affichage du formulaire -->
								<?php if(!isset($_POST['rechercher_ordre']) && !isset($_POST['rechercher_desordre']) && !isset($_POST['rechercher_patronyme']) && !isset($_POST['rechercher_region'])&& !isset($_POST['rechercher_fief'])&& !isset($_POST['rechercher_departement'])&& !isset($_POST['rechercher_siecle']) && !isset($_POST['rechercher_siecle2']) && !isset($_POST['recherche_id'])){ ?> 
								<!-- Formulaire de recherche-->
								
								<h3 class="title"><center>Recherche d'Armes & de Familles</center></h3>
								<br /> <br /> 
								
								<!-- COLONNE GAUCHE-->
								<div id="gauche">
								<!-- PATRONYME-->
								<fieldset>
								<legend><strong>Recherche par Patronyme</strong></legend>
								<form action="recherche" method="post">	
								<label class="label1"><strong>Patronyme</strong></label>
								<input type="text" name="patronyme"  <?php if (isset($_POST['patronyme'])){ ?>value="<?php echo $_POST['patronyme'] ;?>"<?php }; ?>/>
								<input type="submit" name="rechercher_patronyme" value="Rechercher" />
								</form>	
								</fieldset> 
								</div>
								<div id="droite">
								<!-- COLONNE DROITE-->
								
								<!-- COMMUNES FIEF-->
								<fieldset>
								<legend><strong>Recherche par Fief ou Commune</strong></legend>
								<form action="recherche" method="post">
								<label class="label1"><strong>Fief ou Commune</strong></label>
								<input type="text" name="fief"  <?php if (isset($_POST['fief'])){ ?>value="<?php echo $_POST['fief'] ;?>"<?php }; ?>/>
								<input type="submit" name="rechercher_fief" value="Rechercher" />
								</form>	
								</fieldset>
								<br />
								<div>
								
								
								<!-- ARMES-->	
								
								<fieldset>
								<legend><strong> Recherche par Armes</strong></legend>
								<form action="recherche" method="post">	
								<center>
								<label class="label1"><strong>Armes</strong></label>
								<input type="text" name="mot" size="60%" <?php if (isset($_POST['mot'])){ ?>value="<?php echo $_POST['mot'] ;?>"<?php }; ?>/><br /><br />
								
								<!-- colonne gauche -->
								<div id="gauche_armes">
								<label class="label2" >Patronyme</label>
								<input type="text" name="mot_2"  <?php if (isset($_POST['mot_2'])){ ?>value="<?php echo $_POST['mot_2'] ;?>"<?php }; ?>/><br /><br />
								<label class="label2">Fief / Communes</label>
								<input type="text" name="mot_4"  <?php if (isset($_POST['mot_4'])){ ?>value="<?php echo $_POST['mot_4'] ;?>"<?php }; ?>/><br /><br />
								<label class="label2">Siècle</label>
								<select name="mot_6">
								<option value=""> </option>
								<option value="XIIe s.">XIIe s.</option>
								<option value="XIIIe s.">XIIIe s.</option>
								<option value="XIVe s.">XIVe s.</option>
								<option value="XVe s.">XVe s.</option>
								<option value="XVIe s.">XVIe s.</option>
								<option value="XVIIe s.">XVIIe s.</option>
								<option value="XVIIIe s.">XVIIIe s.</option>
								<option value="XIXe s.">XIXe s.</option>
								<option value="XXe s.">XXe s.</option>
								<option value="XXIe s.">XXIe s.</option>
								</select> <br /><br />
								</div>
								<!-- colonne droite-->
								<div id="droire_armes">
								<label class="label2">Département</label>
								<input type="text" name="mot_5"  <?php if (isset($_POST['mot_5'])){ ?>value="<?php echo $_POST['mot_5'] ;?>"<?php }; ?>/><br /><br />
								<label class="label2">Région</label>
								<input type="text" name="mot_3"  <?php if (isset($_POST['mot_3'])){ ?>value="<?php echo $_POST['mot_3'] ;?>"<?php }; ?>/><br /><br />
								<label class="label2">Dénomination</label>
								<select name="Denomination">
								<option value=""> </option>
								<?php foreach($denominations as $denomination){ ?>
								<option value="<?php echo $denomination->dénomination ; ?>"><?php echo $denomination->dénomination ; ?></option>
								<?php } ?>
								</select> <br /><br />
								</div>
								
								<!--boutons -->
								
								
								<script language="JavaScript">
								function affichage(eltAafficher, eltAcacher)
								{
								var eltAfficher = document.getElementById(eltAafficher);
								eltAfficher.style.visibility="visible";
								var eltAcacher = document.getElementById(eltAcacher);
								eltAcacher.style.visibility="hidden";
								}
								</script>
								<div style="margin-left : 25%">
								<div id="ordre" style="float:left">
								<!-- ORDRE--><em><font>Mots ordonnés </font></em><input type="submit" name="rechercher_ordre" value="Rechercher">
								<a href="javascript:affichage('desordre','ordre');"><img style="border: none" src="<?php echo base_url()?>resources/images/echange.jpg" width="18px"/></a>
								</div>
								<div id="desordre" style="visibility:hidden;float:left;">
								<a href="javascript:affichage('ordre', 'desordre');"><img style="border: none" src="<?php echo base_url()?>resources/images/echange.jpg" width="18px"/></a>
								<!-- DESORDRE--><input type="submit" name="rechercher_desordre" value="Rechercher"><em><font> Mots désordonnés</font></em>
								</div>
								</div>
								</center>
								</form>
								<br /><br />
								</fieldset>
								
								<!-- SIECLE 
								
								<fieldset style="float:left;margin-left:14%">
								Note : il est possible de sélectionner plusieurs siècles (note à supprimer)
								<legend><strong>Recherche par Siècle d'Extinction</strong></legend>
								<form action="recherche" method="post">
								<font color="#A42903">
								<strong>XIIe s.</strong><input type="checkbox" value="XIIe s." name="siecle[]" />
								<strong>XIIIe s.</strong><input type="checkbox" value="XIIIe s." name="siecle[]" />
								<strong>XIVe s.</strong><input type="checkbox" value="XIVe s." name="siecle[]" />
								<strong>XVe s.</strong><input type="checkbox" value="XVe s." name="siecle[]" />
								<strong>XVIe s.</strong><input type="checkbox" value="XVIe s." name="siecle[]" />
								<strong>XVIIe s.</strong><input type="checkbox" value="XVIIe s." name="siecle[]" />
								<strong>XVIIIe s.</strong><input type="checkbox" value="XVIIIe s." name="siecle[]" />
								<strong>XIXe s.</strong><input type="checkbox" value="XIXe s." name="siecle[]" />
								<strong>XXe s.</strong><input type="checkbox" value="XXe s." name="siecle[]" />
								<strong>XXIe s.</strong><input type="checkbox" value="XXIe s." name="siecle[]" /></font> -->
								<!--	<input type="text" name="siecle" size="70" <?php if (isset($_POST['siecle'])){ ?>value="<?php echo $_POST['siecle'] ;?>"<?php }; ?>/>  
								<br /><center><input type="submit" name="rechercher_siecle" value="Rechercher " /></center>
								</form>	
								</fieldset><br /><br /> -->
								<!-- SIECLE 2-->
								<!-- 
								<fieldset style="float:left;margin-left:14%">
								Note : La recherche récupère automatiquement tous les siécles antérieurs au siècle choisi (Note à Supprimer !)<br />
								<legend><strong>Recherche par Siècle d'Extinction</strong></legend>
								<form action="recherche" method="post">
								<label style="float:left;width:110px;">Siècle</label>
								<select name="siecle2">
								<option value=""> </option>
								<option value="XIIe s.">XIIe s.</option>
								<option value="XIIIe s.">XIIIe s.</option>
								<option value="XIVe s.">XIVe s.</option>
								<option value="XVe s.">XVe s.</option>
								<option value="XVIe s.">XVIe s.</option>
								<option value="XVIIe s.">XVIIe s.</option>
								<option value="XVIIIe s.">XVIIIe s.</option>
								<option value="XIXe s.">XIXe s.</option>
								<option value="XXe s.">XXe s.</option>
								<option value="XXIe s.">XXIe s.</option>
								</select>
								<input type="submit" name="rechercher_siecle2" value="Rechercher" />
								</form>	
								</fieldset>
								<br />
								-->
								
								<!-- 
								<fieldset>
								<legend><strong>Recherche par région</strong></legend><br />
								<form action="recherche" method="post">	
								<label style="float:left;width:175px;"><strong>Mots clés de la région</strong></label>
								<input type="text" name="region" size="30" <?php if (isset($_POST['region'])){ ?>value="<?php echo $_POST['region'] ;?>"<?php }; ?>/>
								<input type="submit" name="rechercher_region" value="Rechercher les familles de la région" />
								</form>	
								<br />
								
								</fieldset><br />
								
								<fieldset>
								<legend><strong>Recherche par Département</strong></legend><br />
								<form action="recherche" method="post">	
								<label style="float:left;width:175px;"><strong>Mots clés du Département</strong></label>
								
								<input type="text" name="departement" size="30" <?php if (isset($_POST['departement'])){ ?>value="<?php echo $_POST['departement'] ;?>"<?php }; ?>/>
								<input type="submit" name="rechercher_departement" value="Rechercher les familles du département" />
								</form>	
								<br />
								</fieldset><br />
								
								<br/>
								
								
								<div>
								<form action="recherche" method="post">	
								<label style="float:left;width:175px;"><strong>Recherche par id armorial</strong></label>
								<input type="text" name="search" size="30" <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> />
								<input type="submit" name="recherche_id" value="Rechercher par Id">
								</form>		
								<br/>
								</div>
								-->
								<?php } ?> 
								<div>
																