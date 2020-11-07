<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
		
				<div id="content">


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
		<td valign="top" style="width:50%;">	
		<!-- ########################-->
		<table border="1" bordercolor="#C9C9C9" frame="hsides" rules="rows">
		<caption><strong>Version 1 des Armoiries</strong></caption>
		<?php	foreach($donnees1 as $data1) { 
			if($data1->blasonnement_1 != NULL){
			?>
		<tr>
		<!-- patronyme--><td ><li><strong><?php IF ($data1->patronyme!= NULL) { 
	echo anchor('fiche/armorial/'.$data1->id, ucfirst(mb_strtolower($data1->patronyme,'UTF-8')));
	} 
	ELSE { echo anchor('fiche/armorial/'.$data1->id, ucfirst(mb_strtolower($data1->famille,'UTF-8')));}
;?></strong>, <!-- fief--><em><?php if (!empty($data1->fief)){ echo $data1->fief; }?></em></li>
		<!-- armorie--><strong>Armes 1 : </strong><font color="green" ><?php if (!empty($data1->blasonnement_1)){ echo $data1->blasonnement_1; }?></font>
		
		<!-- photos1-->
		<br />
		<?php foreach($photos as $photo){ 
			if ($photo->vedette_chandon == $data1->patronyme){ ?>
			
				<a href="<?php echo PALISEP ; ?>europe/resources/images/<?php echo $photo->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
					<img height="100px" src="<?php echo PALISEP ; ?>europe/resources/images/<?php echo $photo->libellé_image; ?>.jpg"/>
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
		<!-- patronyme1--><td width="40%"><li><strong><?php IF ($data2->patronyme!= NULL) { 
	echo anchor('fiche/armorial/'.$data2->id, ucfirst(mb_strtolower($data2->patronyme,'UTF-8')));
	} 
	ELSE { echo anchor('fiche/armorial/'.$data2->id, ucfirst(mb_strtolower($data2->famille,'UTF-8')));}
;?></strong>, <!-- fief--><em><?php if (!empty($data2->fief)){ echo $data2->fief; }?></em></li>
		<!-- armorie--><strong>Armes 2 : </strong><font color="green" ><?php if (!empty($data2->blasonnement_2)){ echo $data2->blasonnement_2; }?></font>
		
		<!-- photos2-->
		<br />
		<?php foreach($photos as $photo){ 
			if ($photo->vedette_chandon == $data2->patronyme){ ?>
			
				<a href="<?php echo PALISEP ; ?>europe/resources/images/<?php echo $photo->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
					<img height="100px" src="<?php echo PALISEP ; ?>europe/resources/images/<?php echo $photo->libellé_image; ?>.jpg"/>
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
		<!-- patronyme2--><td width="40%"><li><strong><?php IF ($data->patronyme!= NULL) { 
	echo anchor('fiche/armorial/'.$data->id, ucfirst(mb_strtolower($data->patronyme,'UTF-8')));
	} 
	ELSE { echo anchor('fiche/armorial/'.$data->id, ucfirst(mb_strtolower($data->famille,'UTF-8')));}
;?></strong></li>
		<!-- fief--><em><?php if (!empty($data->fief)){ echo $data->fief; }?></em></td>
		<!-- photos3-->
		<td align="right" >
		<?php foreach($photos as $photo){ 
		if ($data->patronyme!= NULL) { if ($photo->vedette_chandon == $data->patronyme){ ?>
			
				<a href="<?php echo PALISEP ; ?>europe/resources/images/<?php echo $photo->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
					<img height="100px" src="<?php echo PALISEP ; ?>europe/resources/images/<?php echo $photo->libellé_image; ?>.jpg"/>
				</a>
			<?php } 
				}
			else { if ($photo->vedette_chandon == $data->famille){ ?>
			
				<a href="<?php echo PALISEP ; ?>europe/resources/images/<?php echo $photo->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
					<img height="100px" src="<?php echo PALISEP ; ?>europe/resources/images/<?php echo $photo->libellé_image; ?>.jpg"/>
				</a> <?php }
			} 
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
<h3 class="title"><center>Recherche d'Armes & de Familles</center></h3>
<?php } else{ ?>
<br /> <br /> 
<h3 class="title"><center> Nouvelle Recherche </center></h3>
<?php }?> 
<!-- Formulaire de recherche-->


<br /> <br /> 

<!-- COLONNE GAUCHE-->
<div id="gauche">
	<!-- PATRONYME-->
	<fieldset>
			<legend><strong>Recherche par Patronyme</strong></legend>
	<form action="recherche" method="post">	
	<label class="label1"><strong>Patronyme/Famille</strong></label>
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
		<label class="label1"><strong>Armes</strong></label>
		<input type="text" name="mot" size="60%" <?php if (isset($_POST['mot'])){ ?>value="<?php echo $_POST['mot'] ;?>"<?php }; ?>/>
		<div id="button_ordre" data-ordre="ordre" style="display:inline-block;">
			<img style="border: none" src="<?php echo base_url()?>resources/images/echange.jpg" width="18px"/>
			<em><font id="text_ordre">Mots ordonnés</font></em>
		</div>
		<br /><br />

	<!-- colonne gauche -->
	<div id="gauche_armes">
		<label class="label2" >Patronyme</label>
			<input type="text" name="mot_2"  <?php if (isset($_POST['mot_2'])){ ?>value="<?php echo $_POST['mot_2'] ;?>"<?php }; ?>/><br /><br />
		<label class="label2">Fief / Communes</label>
			<input type="text" name="mot_4"  <?php if (isset($_POST['mot_4'])){ ?>value="<?php echo $_POST['mot_4'] ;?>"<?php }; ?>/><br /><br />
		<label class="label2">Siècle</label>
		<select name="mot_6">
 <option selected value="<?php if (isset($_POST['mot_6'])){ echo $_POST['mot_6'];} ?>"><?php if (isset($_POST['mot_6'])){ echo $_POST['mot_6'];} ?> </option>
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
        <label class="label2">Sceau</label> <input type="checkbox" name="sceau" value="sceau">
	</div>
	<!-- colonne droite-->
	<div id="droire_armes">
		<label class="label2">Pays</label>
			<select name="pays">
					<option selected value="<?php if (isset($_POST['pays'])){ echo $_POST['pays'];} ?>"><?php if (isset($_POST['pays'])){ echo $_POST['pays'];} ?> </option>
					<option value=""> </option>
			<?php foreach($pays as $pays){ ?>
					<option value="<?php echo $pays->pays ; ?>"><?php echo $pays->pays ; ?></option>
			<?php } ?>
					<option value="Allemagne">Allemagne</option>
					<option value="Autriche">Autriche</option>
					<option value="Belgique">Belgique</option>
					<option value="Bulgarie">Bulgarie</option>
					<option value="Chypre">Chypre</option>
					<option value="Danemark">Danemark</option>
					<option value="Espagne">Espagne</option>
					<option value="Estonie">Estonie</option>
					<option value="Finlande">Finlande</option>
					<option value="Grèce">Grèce</option>
					<option value="Hongrie">Hongrie</option>
					<option value="Irlande">Irlande</option>
					<option value="Italie">Italie</option>
					<option value="Lettonie">Lettonie</option>
					<option value="Lituanie">Lituanie</option>
					<option value="Luxembourg">Luxembourg</option>
					<option value="Malte">Malte</option>
					<option value="Pays-Bas">Pays-Bas</option>
					<option value="Pologne">Pologne</option>
					<option value="Portugal">Portugal</option>
					<option value="Roumanie">Roumanie</option>
					<option value="Slovénie">Slovénie</option>
					<option value="Suède">Suède</option>
					<option value="République Slovaque">République Slovaque</option>
					<option value="République Tchèque">République Tchèque</option>
					<option value="Royaume-Uni">Royaume-Uni</option>
			</select><br /><br />
		<label class="label2">Département</label>
			<select name="mot_5">
                    <option selected value="<?php if (isset($_POST['mot_5'])){ echo $_POST['mot_5'];} ?>"><?php if (isset($_POST['mot_5'])){ echo $_POST['mot_5'];} ?> </option>
					<option value=""> </option>
			<?php foreach($departements as $departement){ ?>
					<option value="<?php echo $departement->départment ; ?>"><?php echo $departement->départment ; ?></option>
			<?php } ?>
			</select><br /><br />
		<label class="label2">Région</label>
		 	<select name="mot_3">
			        <option selected value="<?php if (isset($_POST['mot_3'])){ echo $_POST['mot_3'];} ?>"><?php if (isset($_POST['mot_3'])){ echo $_POST['mot_3'];} ?> </option>
					<option value=""> </option>
			<?php foreach($regions as $region){ ?>
					<option value="<?php echo $region->région ; ?>"><?php echo $region->région ; ?></option>
			<?php } ?>
			</select><br /><br />
		 <label class="label2">Dénomination</label>
			<select name="Denomination">
					<option selected value="<?php if (isset($_POST['Denomination'])){ echo $_POST['Denomination'];} ?>"><?php if (isset($_POST['Denomination'])){ echo $_POST['Denomination'];} ?> </option>
					<option value=""> </option>
			<?php foreach($denominations as $denomination){ ?>
					<option value="<?php echo $denomination->dénomination ; ?>"><?php echo $denomination->dénomination ; ?></option>
			<?php } ?>
			</select> <br /><br />
	</div>
	
	<script type="text/javascript">
		$('#button_ordre').click(function(){
			if($(this).data('ordre') == 'ordre'){
				$(this).data('ordre','desordre');
				$('#search_button').attr('name','rechercher_desordre');
				$('#text_ordre').text('Mots désordonnés');
				console.log('ordre : '+$('#search_button').attr('name'));
			} else {
				$(this).data('ordre','ordre');
				$('#search_button').attr('name','rechercher_ordre');
				$('#text_ordre').text('Mots ordonnés');
				console.log('ordre : '+$('#search_button').attr('name'));
			}
		});
	</script>
	<!--boutons -->
			<center>
				<div>
					<input type="submit" name="rechercher_ordre" id="search_button" value="Rechercher">
				</div>
			</center>
		</div>
		
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
<?php //} ?> 
 <div>

 <!-- fermeture des balises ouvertes dans la vue header.php-->
<div style="clear: both;">&nbsp;</div>
</div>

<!-- fermeture des balises ouvertes dans la vue header.php-->
<div style="clear: both;">&nbsp;</div>
</div>
</div>
</div><!-- page -->
