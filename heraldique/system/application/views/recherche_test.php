<html>
	<head>
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link type="text/css" href="resources/css/style.css" rel="stylesheet"/>
		<link type="text/css" href="system/libraries/Javascript/jquery-ui-1.8.18.custom.css" rel="stylesheet"/>
	</head>


<?php
	if ($connecte == true){ ?>
	<div class="corps_resultat">
		<!-- Affichage des résultats-->
		<h3 class="title"><center>Recherche d'Armes & de Familles</center></h3>
		<?php 
			/* ARMOIRIE MOTS ORDRE/DESORDRE*/
			if(isset($_GET['rechercher_desordre']) || isset($_GET['rechercher_ordre'])){ ?>
			<!--- <h4><a href="javascript:history.back()"><<< Retour sur le formulaire</a></h4> --->
			
			<h4 style="margin-left:70%">Nombre de Résultats : <?php 
				$nb1=0;
				$nb2=0;
				foreach($donnees1 as $data1) { 
					if($data1->blasonnement_1 != NULL){
					$nb1++;}
					
				}
				foreach($donnees2 as $data2) { 
					if($data2->blasonnement_2 != NULL){
					$nb2++;}				
				}			
				$nb =$nb1+ $nb2;
			echo $nb; ?></h4>
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
										<!-- patronyme-->
										<td ><li><strong><?php IF ($data1->patronyme!= NULL) { 
											echo anchor('fiche/armorial/'.$data1->id, ucfirst(mb_strtolower($data1->patronyme,'UTF-8')));
										} 
										ELSE {
											echo anchor('fiche/armorial/'.$data1->id, ucfirst(mb_strtolower($data1->famille,'UTF-8')));
										};?>
										</strong>	

										<!-- fief--><em><?php if (!empty($data1->région)){
											echo " - ".$data1->région;
										}
										if (!empty($data1->région_bis)){
											echo " - ".$data1->région_bis;
										} ?> </em>
										<font color="black" >
										<em>
										<?php
										if (!empty($data1->ref_biblio)){
											$source_abregee = explode(",", $data1->ref_biblio); $source_abregee = $source_abregee[0]; echo " - ".$source_abregee;
										}?></em></font></li>

										<!-- armorie--><strong>Armes : </strong><font color="green" ><?php if (!empty($data1->blasonnement_1)){
											$blasonnement = str_replace("_", ";", $data1->blasonnement_1);
											echo $blasonnement;
										}?></font>
										
										<!-- photos
											<br/>
											<?php foreach($photo as $photo){ 
												if ($photo->vedette_chandon == $data1->patronyme){ ?>
												
												
												<?php } 
											}  ?>-->
											<?php if(!empty($data1->cimiers)){ ?>
												<strong>Cimiers/Ornements ext.: </strong><font color="blue"><?php  echo $data1->cimiers; ?></font>
											<?php } ?>
										</td>
									</tr>
									
									<?php 
									}	} ?>
							</table>
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
										<!-- patronyme--><td width="40%"><li><strong><?php echo anchor('fiche/armorial/'.$data2->id, ucfirst(mb_strtolower($data2->patronyme,'UTF-8')));?></strong>, <!-- fief--><em><?php if (!empty($data2->fief)){ echo $data2->fief; }?></em></li>
											<!-- armorie--><strong>Armes : </strong><font color="green" ><?php if (!empty($data2->blasonnement_2)){ echo $data2->blasonnement_2; }?></font>
											
											<!-- photos-->
											<br/>
											<?php foreach($photos as $photo){ 
												if ($photo->vedette_chandon == $data2->patronyme){ ?>
												
												
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
			if(isset($_GET['rechercher_patronyme']) || isset($_GET['rechercher_region']) || isset($_GET['rechercher_fief']) || isset($_GET['rechercher_departement']) || isset($_GET['rechercher_siecle']) || isset($_GET['rechercher_siecle2']) || isset($_GET['recherche_id'])){ ?>
			<!--- <h4><a href="javascript:history.back()"><<< Retour sur le formulaire</a></h4> --->
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
		<?php //if(!isset($_GET['rechercher_ordre']) && !isset($_GET['rechercher_desordre']) && !isset($_GET['rechercher_patronyme']) && !isset($_GET['rechercher_region'])&& !isset($_GET['rechercher_fief'])&& !isset($_GET['rechercher_departement'])&& !isset($_GET['rechercher_siecle']) && !isset($_GET['rechercher_siecle2']) && !isset($_GET['recherche_id'])){ ?>
		<!-- Formulaire de recherche-->
		
		<br/> <br/>
		
		<div id="message_erreur" style="color:blue"></div>
		
		<?php
			if($message_erreur!=""){
				print ("<script language = \"JavaScript\">
				document.getElementById('message_erreur').innerHTML=\"$message_erreur\";
                </script>");
			}
		?>
		<?php
			
			$SIZE_MAP="600"; 
			$URL_REDIR="recherche.php"; 
			$ROLL_BT="#FF0066";
			$PRES_BT="#FE0933";
			
			//include("map.php");
		?>
		
		<!-- COLONNE GAUCHE-->
		<!-- 
			<div id="gauche">
		-->
		<!-- PATRONYME-->
		<!--
			<fieldset>
			<legend><strong>Recherche par Patronyme</strong></legend>
			<form action="recherche" method="get">
			<label class="label1"><strong>Patronyme</strong></label>
			<input type="text" name="patronyme"  <?php if (isset($_GET['patronyme'])){ ?>value="<?php echo $_GET['patronyme'] ;?>"<?php }; ?>/>
			<input type="submit" name="rechercher_patronyme" value="Rechercher" />
			</form>	
			</fieldset> 
			</div>
		-->
		
		<!-- COLONNE DROITE
		<div id="droite">-->
		<!-- COMMUNES FIEF
			<fieldset>
			<legend><strong>Recherche par Fief ou Commune</strong></legend>
			<form action="recherche" method="get">
			<label class="label1"><strong>Fief ou Commune</strong></label>
			<input type="text" name="fief"  <?php if (isset($_GET['fief'])){ ?>value="<?php echo $_GET['fief'] ;?>"<?php }; ?>/>
			<input type="submit" name="rechercher_fief" value="Rechercher" />
			</form>	
			</fieldset>
			<br/>
		<div>-->
		
		
		
		<!-- ARMES-->	
		
		<fieldset>
			
			<legend><strong> Recherche</strong></legend>
			<div id="recherchepararmes">
				<form action="recherche" method="get">
					<center>
						<div class="haut_armes">
							<label class="label2"><strong>Armes</strong></label><textarea style="float: right;" cols="30" rows="3" name="mot" ><?php if (isset($_GET['mot'])){ echo $_GET['mot'];} ?></textarea><br/><br/>
							<!--<label class="label2"><strong>Cimiers / Ornements extérieurs</strong></label><textarea style="float: right;" cols="30" rows="3" name="cimiers"></textarea><br/><br/>-->
							<label class="label2"><strong>Cimiers</strong></label><textarea style="float: right;" cols="30" rows="3" name="cimiers"><?php if (isset($_GET['cimiers'])){ echo $_GET['cimiers'];} ?></textarea><br/><br/>
						</div>
						<div class="bas_armes">
							<label class="label2"><strong>Devise / Légende</strong></label><textarea style="float: right;" cols="30" rows="3" name="devise"><?php if (isset($_GET['devise'])){ echo $_GET['devise'];} ?></textarea><br/><br/>
							<label class="label2"><strong>Emblème</strong></label><textarea style="float: right;" cols="30" rows="3" name="embleme"><?php if (isset($_GET['embleme'])){ echo $_GET['embleme'];} ?></textarea><br/><br/>
						</div>
					</div>
					<!-- colonne gauche -->
					<div id="recherchepararmes2">
						<div id="gauche_armes">
							
							<label class="label2" >Patronyme</label>
							<input style="float: right;" type="text" name="mot_2"  <?php if (isset($_GET['mot_2'])){ ?>value="<?php echo $_GET['mot_2'] ;?>"<?php }; ?>/><br/><br/>
							<label class="label2" >Origine</label>
							<input style="float: right;" type="text" name="origine"  <?php if (isset($_GET['origine'])){ ?>value="<?php echo $_GET['origine'] ;?>"<?php }; ?>/><br/><br/>
							
							<label class="label3">Siècle</label>
							<select name="mot_6" style="float: right;width: 180px;">
								<option selected value="<?php if (isset($_GET['mot_6'])){ echo $_GET['mot_6'];} ?>"><?php if (isset($_GET['mot_6'])){ echo $_GET['mot_6'];} ?> </option>
								<?php
									foreach($siecles as $siecle){ ?>
									<option value="<?php echo $siecle->siècle ; ?>"><?php echo $siecle->siècle ; ?></option>
								<?php } ?>
							</select> <br/><br/>
							
							<label class="label3">Dénomination</label>
							<select name="Denomination" style="float: right;width: 180px;">
								<option selected value="<?php if (isset($_GET['Denomination'])){ echo $_GET['Denomination'];} ?>">
								<?php if (isset($_GET['Denomination'])){ echo $_GET['Denomination'];} ?></option>
								<?php
									foreach($denominations as $denomination){ ?>
									<option value="<?php echo $denomination->dénomination ; ?>"><?php echo $denomination->dénomination ; ?></option>
								<?php } ?>
							</select> <br/><br/>
							
							<label class="label3" >Observations</label>
							<input style="float: right;" type="text" name="observations" <?php if (isset($_GET['observations'])){ ?>value="<?php echo $_GET['observations'] ;?>"<?php }; ?>/><br/><br/>
							
							<label class="label3">Références / Bibliographie</label>
							<select name="ref_biblio" style="float: right; width: 180px;">
								<option selected value="<?php if (isset($_GET['ref_biblio'])){ echo $_GET['ref_biblio'];} ?>">
								<?php if (isset($_GET['ref_biblio'])){ echo $_GET['ref_biblio'];} ?></option>
								<?php foreach ($ref_biblios as $ref_biblio){ ?>
									<option value="<?php echo $ref_biblio->ref_biblio ; ?>"><?php echo $ref_biblio->ref_biblio ; ?></option>
								<?php } ?>
							</select>
							<br/><br/>
							
							
							
							
						</div>
						<!-- colonne droite-->
						<div id="droite_armes">
							
							<label style="float:left;">Aire géographique</label>
							<select name="aire" style="float: right;width: 180px;">
								<option selected value="<?php if (isset($_GET['aire'])){ echo $_GET['aire'];} ?>"><?php if (isset($_GET['aire'])){ echo $_GET['aire'];} ?> </option>
								<?php
									foreach($aire as $aire){ ?>
									<option value="<?php echo $aire->aire ; ?>"><?php echo $aire->aire ; ?></option>-->
								<?php } ?>
							</select> <br/><br/>
							
							
							<label class="label2" >Pays</label>
							<select name="pays" style="float: right;width: 180px;">
								<option selected value="<?php if (isset($_GET['pays'])){ echo $_GET['pays'];} ?>"><?php if (isset($_GET['pays'])){ echo $_GET['pays'];} ?> </option>
								<?php
									foreach($pays as $pay){ ?>
									<option value="<?php echo $pay->pays ; ?>"><?php echo $pay->pays ; ?></option>
								<?php } ?>
							</select> <br/><br/>
							
							<label class="label2">Région</label>
							<select name="mot_3" style="float: right;width: 180px;">
								<option selected value="<?php if (isset($_GET['mot_3'])){ echo $_GET['mot_3'];} ?>"><?php if (isset($_GET['mot_3'])){ echo $_GET['mot_3'];} ?> </option>
								<?php
									foreach($regions as $region){ ?>
									<option value="<?php echo $region->région ; ?>"><?php echo $region->région ; ?></option>
								<?php } ?>
							</select> <br/><br/>
							
							<label class="label2">Département</label>
							<select name="mot_5" style="float: right;width: 180px;">
								<option selected value="<?php if (isset($_GET['mot_5'])){ echo $_GET['mot_5'];} ?>"><?php if (isset($_GET['mot_5'])){ echo $_GET['mot_5'];} ?> </option>
								<?php
									foreach($departements as $departement){ ?>
									<option value="<?php echo $departement->départment ; ?>"><?php echo $departement->départment ; ?></option>
								<?php } ?>
							</select> <br/><br/>
							
							
							
							<label class="label2">Fief / Communes</label>
							<select name="fief" style="float: right;width: 180px;">
								<option selected value="<?php if (isset($_GET['fief'])){ echo $_GET['fief'];} ?>"><?php if (isset($_GET['fief'])){ echo $_GET['fief'];} ?> </option>
								<?php
									foreach($communes as $commune){ ?>
									<option value="<?php echo $commune->commune ; ?>"><?php echo $commune->commune ; ?></option>
								<?php } ?>
							</select> <br/><br/>

							<label class="label2">Recherche géographique </label>
							<button type="bouton">
								<a href="#" id="show_test">Recherche géographique avancée</a>
							</button>
								
							</label>
							
						</div><br/><br/>

						<div id="dialog_test" style=" font-size: 1.2vmax;" >
							Réalisé sous le haut patronage de l'Académie des Inscriptions et Belles-Lettres et avec les étudiants ingénieurs informaticiens de l'ISEP, le
							site www.palisep.fr, créé en 2010, présente déjà une considérable documentation en libre accès.</br>
							</br><p>Il se divise en quatre rubriques:</p>
						</div>

					</div>
					<!-- boutons-->
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
						<br/><br/><br/>
						<div id="ordre" style="float:left;margin-top:60px;">
							<!-- ORDRE--><em><font>Mots ordonnés </font></em><input type="submit" name="rechercher_ordre" value="Rechercher">
							<a href="javascript:affichage('desordre','ordre');"><img style="border: none" src="<?php echo base_url()?>resources/images/echange.jpg" width="18px"/></a>
						</div>
						<div id="desordre" style="visibility:hidden;float:left;margin-top:60px;">
							<a href="javascript:affichage('ordre', 'desordre');"><img style="border: none" src="<?php echo base_url()?>resources/images/echange.jpg" width="18px"/></a>
							<!-- DESORDRE--><input type="submit" name="rechercher_desordre" value="Rechercher"><em><font> Mots désordonnés</font></em>
						</div>
					</div>				
				</center>
			</form>
			<br/><br/>
		</fieldset>
		
		<?php }else{ ?>
		<!-- Si l'admin n'est pas connecté on le renvoit sur la page identification -->
		<?php header("Location: ".base_url().'administration/identification'); ?>
	<?php } ?>
	
			<script>
			$( "#show_presentation" ).click(function(){
				$( "#dialog_presentation" ).dialog({
					closeText: "Fermer",
					width: 500,
					title: "Présentation du site",
				}).dialog("open");
			});
			</script>

			<script>
			$( "#show_test" ).click(function(){
				$( "#dialog_test" ).dialog({
					closeText: "Fermer",
					width: 550,
					title: "Test fenetre",
				}).dialog("open");
			});
			</script>

