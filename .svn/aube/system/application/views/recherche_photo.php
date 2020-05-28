
<!-- Si l'administrateur est connecté -->
<?php if (True){ ?>

<div class="corps">

<!-- AFFICHAGE RESULTAT-->
<!-- RESULTATS PATRONYME -->
<?php 
if(isset($_POST['rechercher_photo'])){ ?>
        
	<h4><a href="javascript:history.back()"><<< Retour sur le formulaire </a></h4>
	<h4 style="margin-left:70%">Nombre de Résultats : <?php echo count($donnees); ?></h4>
<table border="1" bordercolor="#C9C9C9" frame="hsides" rules="rows" width="100%">
	<?php foreach($donnees as $data) { ?>
		<tr>
		<!-- patronyme--><td width="40%"><li><strong><?php echo anchor('legende_photos/photos/'.$data->id, $data->famille);?></strong>, <em><?php if (!empty($data->commune)){ echo $data->commune; }?></em>, <em><?php if (!empty($data->village)){ echo $data->village; }?></em></li>
		<!-- infos photos--><strong>Détails : </strong><?php if (!empty($data->dénomination)){ echo $data->dénomination; }?>, <?php if (!empty($data->date)){ echo $data->date; }?></td>
		<!-- photos-->
		<td align="right" >
				<a href="<?php echo PALISEP ; ?>ressources/images/<?php echo $data->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
					<img height="100px" src="<?php echo PALISEP ; ?>ressources/images/<?php echo $data->libellé_image; ?>.jpg"/>
				</a>
		</td>
		</tr>			 		 		 		 		 		 		 		 		 		 		 		 		 		
	<?php 
	}	?>
	</table>
<?php 
} 
?>

<!-- FORMULAIRE DE RECHERCHE-->
<!-- sinon affichage du formulaire -->
<?php if(!isset($_POST['rechercher_photo'])){ ?> 

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
	
<!-- COMMUNE-->
	
		<label class="label1"><strong>Commune</strong></label>
		<!--<input type="text" name="Date"  <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> />-->
		<select name="Commune">
				<option value=""> </option>
		<?php foreach($communes as $commune){ ?>
				<option value="<?php echo $commune->commune ; ?>"><?php echo $commune->commune ; ?></option>
		<?php } ?>
		</select>
		<br /><br />
<!-- VILLAGE-->
		<label class="label1"><strong>Village</strong></label>
		<input type="text" name="Village" <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> />
		<br /><br />
		
<!-- CONSERVATION-->
		<label class="label1"><strong>Edifice </strong>(de Conservation)</label>
		<input type="text" name="Conservation"  <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> />
		<br /><br/>

<!-- PATRONYME-->
		
		<label class="label1"><strong>Patronyme</strong></label>
		<input type="text" name="Patronyme"  <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> /> 	
		<br /><br/>
<!-- DATE-->
	
		<label class="label1"><strong>Date</strong></label>
		<!--<input type="text" name="Date"  <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> />-->
		<select name="Date">
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
		<select name="Denomination">
				<option value=""> </option>
		<?php foreach($denominations as $denomination){ ?>
				<option value="<?php echo $denomination->dénomination ; ?>"><?php echo $denomination->dénomination ; ?></option>
		<?php } ?>
		</select>
		<br /><br />
				
<!-- CATEGORIE-->
		<label class="label1"><strong>Catégorie</strong></label>
		<!--<input type="text" name="Categorie"  <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> /> -->
		<select name="Categorie">
				<option value=""> </option>
		<?php foreach($categories as $categorie){ ?>
				<option value="<?php echo $categorie->catégorie ; ?>"><?php echo $categorie->catégorie ; ?></option>
		<?php } ?>
		</select>
	<br /><br />

<!-- MATERIAU-->
		
		<label class="label1"><strong>Matériau</strong></label>
		<!--<input type="text" name="Materiau"  <?php if (isset($_POST['search'])){ ?>value="<?php echo $_POST['search'] ;?>"<?php }; ?> /> -->
		<select name="Materiau" >
				<option value=""> </option>
		<?php foreach($materiaux as $materiau){ ?>
				<option value="<?php echo $materiau->matériau ; ?>"><?php echo $materiau->matériau ; ?></option>
		<?php } ?>
		</select>
		<br /><br />
		
<!--ARMES -->
		<label class="label1" ><strong>Armes</strong></label>
		<input type="text" name="mot" size="40px"<?php if (isset($_POST['mot'])){ ?>value="<?php echo $_POST['mot'] ;?>"<?php }; ?>/>
		<br /><br />
		
	</div>	
		
	<div style="margin-left:50%;">
		<br /><br /><br />
		<input type="submit" name="rechercher_photo" value="Rechercher" />
	</div>
	
		</form>
	<br />
	</fieldset><br /> 

<!-- </div>-->
<?php } ?> 


<?php }else{ ?>
<!-- Si l'admin n'est pas connecté on le renvoit sur la page identification -->
	<?php header("Location: ".base_url().'administration/identification'); ?>
<?php } ?>

<div>


