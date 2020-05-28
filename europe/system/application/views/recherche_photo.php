<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
		
				<div id="content">

<div class="corps">

<!-- AFFICHAGE RESULTAT-->
<!-- RESULTATS PATRONYME -->
<?php 
if(isset($_POST['rechercher_photo_ordre']) || isset($_POST['rechercher_photo_desordre'])){ ?>
        
	<h4><a href="javascript:history.back()"><<< Retour sur le formulaire </a></h4>
	<h4 style="margin-left:70%">Nombre de Résultats : <?php echo count($donnees); ?></h4>
<table border="1" bordercolor="#C9C9C9" frame="hsides" rules="rows" width="100%">
	<?php foreach($donnees as $data) { ?>
		<tr>
		<!-- patronyme--><td width="40%"><li><strong><?php echo anchor('legende_photos/photos/'.$data->id, $data->famille);?></strong>, <em><?php if (!empty($data->commune)){ echo $data->commune; }?></em>, <em><?php if (!empty($data->village)){ echo $data->village; }?></em></li>
		<!-- infos photos--><strong>Détails : </strong><?php if (!empty($data->dénomination)){ echo $data->dénomination; }?>, <?php if (!empty($data->date)){ echo $data->date; }?></td>
		<!-- photos-->
		<td align="right" >
				<a href="<?php echo PALISEP ; ?>europe/resources/images/<?php echo $data->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
					<img height="100px" src="<?php echo PALISEP ; ?>europe/resources/images/<?php echo $data->libellé_image; ?>.jpg"/>
				</a>
		</td>
		</tr>			 		 		 		 		 		 		 		 		 		 		 		 		 		
	<?php 
	}	?>
	</table>
<?php 
} 
//else {			//condition formulaire
?>
	<h3 class="title"><center>Recherche d'Iconographies</center></h3>
<br/>
<!--<fieldset>
		<legend><strong> Recherche par Pays</strong></legend><br />
                <form action="recherche_photo" method="post">
                <label style="float:left;width:175px;"><strong>Mots clés du Pays</strong></label>
		<input type="text" name="Pays" size="30" <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> /><br/>
		<input type="submit" name="rechercher_Pays" value="Rechercher les familles dans ce Pays" />
	</form>
	<br />
</fieldset><br />
<fieldset>
		<legend><strong> Recherche par région</strong></legend><br />
                <form action="recherche_photo" method="post">
                <label style="float:left;width:175px;"><strong>Mots clés de la région </strong></label>
		<input type="text" name="Region" size="30" <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> />
		<input type="submit" name="rechercher_Region" value="Rechercher les familles de la Region" />
	</form>
	<br />
</fieldset><br />

<fieldset>
		<legend><strong> Recherche par département</strong></legend><br />
                <form action="recherche_photo" method="post">
                <label style="float:left;width:175px;"><strong>Mots clés du département</strong></label>
		<input type="text" name="Departement" size="30" <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> />
		<input type="submit" name="rechercher_Departement" value="Rechercher les familles du département" />
	</form>
	<br />
</fieldset><br />-->

<fieldset >
		<!--<legend><strong>Recherche d'Iconographies</strong></legend> --><br />
	<form action="recherche_photo" method="post">
	
	<!-- COLONNE GAUCHE -->
	<div id="gauche_photos">
	
<!-- PAYS-->
	
		<label class="label1"><strong>Pays</strong></label>
		<!--<input type="text" name="Date"  <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> />-->
		<select name="pays" style="width:125px;">
				<option selected value="<?php if (isset($_POST['pays'])){ echo $_POST['pays'];} ?>"><?php if (isset($_POST['pays'])){ echo $_POST['pays'];} ?> </option>
				<option value=""> </option>
		<?php foreach($pays as $p){ ?>
				<option value="<?php echo $p->pays ; ?>"><?php echo $p->pays ; ?></option>
		<?php } ?>
		</select>
		<br /><br />
<!-- REGION-->
	
		<label class="label1"><strong>Région</strong></label>
		<!--<input type="text" name="Date"  <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> />-->
		<select name="region" style="width:125px;">
				<option selected value="<?php if (isset($_POST['region'])){ echo $_POST['region'];} ?>"><?php if (isset($_POST['region'])){ echo $_POST['region'];} ?> </option>
				<option value=""> </option>
		<?php foreach($regions as $region){ ?>
				<option value="<?php echo $region->région ; ?>"><?php echo $region->région ; ?></option>
		<?php } ?>
		</select>
		<br /><br />
<!-- COMMUNE-->
	
		<label class="label1"><strong>Commune</strong></label>
		<!--<input type="text" name="Date"  <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> />-->
		<select name="Commune" style="width:125px;">
						<option selected value="<?php if (isset($_POST['Commune'])){ echo $_POST['Commune'];} ?>"><?php if (isset($_POST['Commune'])){ echo $_POST['Commune'];} ?> </option>
				<option value=""> </option>
		<?php foreach($communes as $commune){ ?>
				<option value="<?php echo $commune->commune ; ?>"><?php echo $commune->commune ; ?></option>
		<?php } ?>
		</select>
		<br /><br />
<!-- VILLAGE-->
		<label class="label1"><strong>Village</strong></label>
		<input type="text" name="Village" <?php if (isset($_POST['Village'])){ ?>value="<?php echo $_POST['Village'] ;?>"<?php }; ?> />
		<br /><br />
		
<!-- CONSERVATION-->
		<label class="label1"><strong>Edifice </strong>(de Conservation)</label>
		<input type="text" name="Conservation"  <?php if (isset($_POST['Conservation'])){ ?>value="<?php echo $_POST['Conservation'] ;?>"<?php }; ?> />
		<br /><br/>

<!-- PATRONYME-->
		
		<label class="label1"><strong>Patronyme</strong></label>
		<input type="text" name="Patronyme"  <?php if (isset($_POST['Patronyme'])){ ?>value="<?php echo $_POST['Patronyme'] ;?>"<?php }; ?> /> 	
		<br /><br/>
<!-- DATE-->
	
		<label class="label1"><strong>Date</strong></label>
		<!--<input type="text" name="Date"  <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> />-->
		<select name="Date" style="width:125px;">
				<option selected value="<?php if (isset($_POST['Date'])){ echo $_POST['Date'];} ?>"><?php if (isset($_POST['Date'])){ echo $_POST['Date'];} ?> </option>
				<option value=""> </option>
		<?php foreach($dates as $date){ ?>
				<option value="<?php echo $date->date ; ?>"><?php echo $date->date ; ?></option>
		<?php } ?>
		</select>
		<br /><br />	
		
	</div>		
	<!-- COLONNE DROITE -->
	<div id="droite_photos">	
		
				
<!-- DENOMINATION-->

		<label class="label1"><strong>Dénomination</strong></label>
		<!--<input type="text" name="Denomination"  <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> /> -->
		<select name="Denomination" style="width:225px;">
				<option selected value="<?php if (isset($_POST['Denomination'])){ echo $_POST['Denomination'];} ?>"><?php if (isset($_POST['Denomination'])){ echo $_POST['Denomination'];} ?> </option>
				<option value=""> </option>
		<?php foreach($denominations as $denomination){ ?>
				<option value="<?php echo $denomination->dénomination ; ?>"><?php echo $denomination->dénomination ; ?></option>
		<?php } ?>
		</select>
		<br /><br />
				
<!-- CATEGORIE-->
		<label class="label1"><strong>Catégorie</strong></label>
		<!--<input type="text" name="Categorie"  <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> /> -->
		<select name="Categorie" style="width:225px;">
				<option selected value="<?php if (isset($_POST['Categorie'])){ echo $_POST['Categorie'];} ?>"><?php if (isset($_POST['Categorie'])){ echo $_POST['Categorie'];} ?> </option>
				<option value=""> </option>
		<?php foreach($categories as $categorie){ ?>
				<option value="<?php echo $categorie->catégorie ; ?>"><?php echo $categorie->catégorie ; ?></option>
		<?php } ?>
		</select>
	<br /><br />

<!-- MATERIAU-->
		
		<label class="label1"><strong>Matériau</strong></label>
		<!--<input type="text" name="Materiau"  <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> /> -->
		<select name="Materiau" style="width:225px;">
				<option selected value="<?php if (isset($_POST['Materiau'])){ echo $_POST['Materiau'];} ?>"><?php if (isset($_POST['Materiau'])){ echo $_POST['Materiau'];} ?> </option>
				<option value=""> </option>
		<?php foreach($materiaux as $materiau){ ?>
				<option value="<?php echo $materiau->matériau ; ?>"><?php echo $materiau->matériau ; ?></option>
		<?php } ?>
		</select>
		<br /><br />
		
<!--ARMES -->
		<label class="label1" ><strong>Armes</strong></label>
		<input type="text" name="mot" size="40px"<?php if (isset($_POST['mot'])){ ?>value="<?php echo $_POST['mot'] ;?>"<?php }; ?>/>
		<div id="button_ordre" data-ordre="ordre" style="display:inline-block;">
			<img style="border: none" src="<?php echo base_url()?>resources/images/echange.jpg" width="18px"/>
			<em><font id="text_ordre">Mots ordonnés</font></em>
		</div>
		<br /><br />
		<label class="label1" ><strong>Sceau</strong></label>
		  <input type="checkbox" name="sceau" value="sceau"> 

	</div>	
		
	<div style="text-align:center;">
		<br /><br /><br />
		<input type="submit" id="search_button" name="rechercher_photo_ordre" value="Rechercher" />
	</div>
	
		</form>
	<br />
	</fieldset><br /> 

<!-- </div>-->
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

<script type="text/javascript">
	$('#button_ordre').click(function(){
		if($(this).data('ordre') == 'ordre'){
			$(this).data('ordre','desordre');
			$('#search_button').attr('name','rechercher_photo_desordre');
			$('#text_ordre').text('Mots désordonnés');
			console.log('ordre : '+$('#search_button').attr('name'));
		} else {
			$(this).data('ordre','ordre');
			$('#search_button').attr('name','rechercher_photo_ordre');
			$('#text_ordre').text('Mots ordonnés');
			console.log('ordre : '+$('#search_button').attr('name'));
		}
	});
</script>
