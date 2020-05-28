<div class="corps">

  <!-- AFFICHAGE RESULTAT-->
  <!-- RESULTATS PATRONYME -->
  <?php
if(isset($_GET['rechercher_ordre']) || isset($_GET['rechercher_desordre'])){ 
?>
  
  <div class="navigation">
    <a href="http://www.livre2.palisep.fr/">Accueil</a>
    |
    <a href="javascript:history.back()"> Retour </a>
  </div>

  <h4 style="margin-left:70%">Nombre de Résultats : <?php echo count($donnees); ?></h4>
  <table border="1" bordercolor="#C9C9C9" frame="hsides" rules="rows" width="100%">
    <?php foreach($donnees as $data) { ?>
    <tr>
    <!-- patronyme-->
    <td width="40%">
      <li>
<strong><?php echo anchor('details/photos/'.$data->id, $data->patronyme); // exemple : id = 2507, patronyme = aumont
?>,</strong> 
	<em><?php if (!empty($data->commune)){ echo $data->commune.', '; }?></em> <em><?php if (!empty($data->village)){ echo $data->village; }?></em>
      </li>
	<!-- infos photos-->
<?php if ((!empty($data->denomination)) or (!empty($data->date)))
{
?>
	<strong>Détails : </strong>
<?php 
if (!empty($data->denomination)){ echo $data->denomination.', '; }
if (!empty($data->date)){ echo $data->date; }
}?>
</td>

      <!-- photos-->
      <?php
        $images = explode(";", $data->libelle_image);
        for($i = 0;$i<sizeof($images);$i++)
        {
            if($images[$i]!=""){
      ?>
      <td align="right" >
	<a href="<?php echo PALISEP ; ?>resources/images/<?php echo $images[$i]; ?>.jpg" rel="lightbox[roadtrip]">
	  <img height="100px" src="<?php echo PALISEP ; ?>resources/images/<?php echo $images[$i]; ?>.jpg"/>
	</a>
      </td>
      <?php
            }
        }
      ?>
    </tr>			 		 		 		 		 		 		 		 		 		 		 		 		 		
    <?php 
       }	?>
  </table>
  <?php 
     } 
     ?>

  <!-- FORMULAIRE DE RECHERCHE-->
  <!-- sinon affichage du formulaire -->
  <?php if(!isset($_GET['rechercher_ordre']) && !isset($_GET['rechercher_desordre'])){  ?> 
  <!--   <h3 class="title"><center>Recherche d'Iconographies</center></h3> -->
  <a href="http://www.livre2.palisep.fr/" class="navigation" >Accueil</a>
  <br/>

  <!-- COMMUNE-->
  <fieldset id="fieldset-recherche" >
    <!-- <legend><strong>Recherche d'Iconographies</strong></legend><br />-->
    <form action="recherche_photo" method="get">
      
      <!-- COLONNE GAUCHE -->
      <div id="gauche_photos">
	<!-- PAYS-->
	<label class="label1"><strong>Pays</strong></label>
	<input type="text" name="pays"  <?php if (isset($_GET['pays'])){ ?>value="<?php echo $_GET['pays'] ;?>"<?php }; ?> /> 	
	<br /><br/>	
	<!-- REGION-->
	<label class="label1"><strong>Région</strong></label>
	<input type="text" name="region" <?php if (isset($_GET['region'])){ ?>value="<?php echo $_GET['region'] ;?>"<?php }; ?> />
	<br /><br /> 			
	<!-- COMMUNE-->
	<label class="label1"><strong>Commune</strong></label>
	<!--<input type="text" name="Date"  <?php if (isset($_GET['search'])){ ?>value="<?php echo $_GET['search'] ;?>"<?php }; ?> />-->
	<select name="Commune" style="width: 180px;">
	  <option selected value="<?php if (isset($_GET['Commune'])){ echo $_GET['Commune'];} ?>"><?php if (isset($_GET['Commune'])){ echo $_GET['Commune'];} ?> </option>
	  <?php foreach($communes as $commune){ ?>
	  <option value="<?php echo $commune->commune ; ?>"><?php echo $commune->commune ; ?></option>
	  <?php } ?>
	</select>
	<br /><br />

	<!-- CONSERVATION-->
	<label class="label1"><strong>Edifice de Conservation</strong></label>
	<input type="text" name="Conservation"  <?php if (isset($_GET['Conservation'])){ ?>value="<?php echo $_GET['Conservation'] ;?>"<?php }; ?> />
	<br /><br/>

	<!-- DENOMINATION-->
	<label class="label1"><strong>Dénomination</strong></label>
	<!--<input type="text" name="Denomination"  <?php if (isset($_GET['search'])){ ?>value="<?php echo $_GET['search'] ;?>"<?php }; ?> /> -->
	<select name="Denomination" style="width: 180px;">
	  <option value=""> </option>
	  <option value="bréviaire du diocèse de Troyes">bréviaire du diocèse de Troyes</option>
	  <option value="cachet">cachet</option>
	  <option value="contre-sceau">contre-sceau</option>
	  <option value="dessin sur estampe">dessin sur estampe</option>
	  <option value="dessin">dessin</option>
	  <option value="empreinte de sceau">empreinte de sceau</option>
	  <option value="enluminure">enluminure</option>
	  <option value="estampe">estampe</option>
	  <option value="ex-libris">ex-libris</option>
	  <option value="filigrane">filigrane</option>
	  <option value="livre">livre</option>
	  <option value="manuscrit">manuscrit</option>
	  <option value="miniature">miniature</option>
	  <option value="reliure">reliure</option>
	  <option value="timbre à sec">timbre à sec</option>
	  <!--<?php foreach($denominations as $denomination){ ?>
	      <option value="<?php echo $denomination->denomination ; ?>"><?php echo $denomination->denomination ; ?></option>
	      <?php } ?> -->
	</select>
	<br /><br />		

	
      </div>		
      <!-- COLONNE DROITE -->
      <div id="droite_photos">

	<!-- PATRONYME-->
	<label class="label1"><strong>Patronyme</strong></label>
	<input type="text" name="Patronyme"  <?php if (isset($_GET['Patronyme'])){ ?>value="<?php echo $_GET['Patronyme'] ;?>"<?php }; ?> /> 	
	<br /><br/>
        <!-- BIOGRAPHIE-->
        <label class="label1"><strong>Biographie</strong></label>
	<input type="text" name="biographie" <?php if (isset($_GET['biographie'])){ ?>value="<?php echo $_GET['biographie'] ;?>"<?php }; ?>  />
	<br /><br/>
	<!--ARMES -->
	
	<script language="JavaScript">
	  function affichage(eltAafficher, eltAcacher)
	  {
	  var eltAfficher = document.getElementById(eltAafficher);
	  eltAfficher.style.display="inline";
	  var eltAcacher = document.getElementById(eltAcacher);
	  eltAcacher.style.display="none";
	  
	  if(eltAafficher=='ordre')
	  document.getElementById('bouton_submit').name = 'rechercher_ordre';
	  else if(eltAafficher=='desordre')
	  document.getElementById('bouton_submit').name = 'rechercher_desordre';

	  }
	</script>

	<div>
	  <label class="label1" >
	    <strong>Armes</strong>
	  </label>


	  <input id="mot"  type="text" name="mot"<?php if (isset($_GET['mot'])){ ?>value="<?php echo $_GET['mot'] ;?>"<?php }; ?>/>
	  
	  <span id="bouton-dico">
	    <a href='#' onclick='getDico();return false;' title='dictionnaire des figures héraldiques'>
	      <img src='<?php echo base_url()?>resources/images/dictionnary-icon.png' width="20px;"/>
	    </a>
	  </span>
	  
	  <span id="ordre" class="boutons-ordre">
	    <a href="javascript:affichage('desordre','ordre');" title='mots en ordre'>
	      <img  src="<?php echo base_url()?>resources/images/echange-transparent.png" width="18px"/>
	    </a>
	  </span>
	  
	  <span id="desordre" class="boutons-ordre">
	    <a href="javascript:affichage('ordre', 'desordre');" title='mots en désordre'>
	      <img  src="<?php echo base_url()?>resources/images/echange-transparent.png" width="18px"/>
	    </a>
	  </span>
	</div>


	
	<br />
	
	<!--CIMIERS/ORNEMENTS EXT-->
	<label class="label1" ><strong>Cimiers&nbsp;/&nbsp;Ornements extérieurs</strong></label>
	<input type="text" name="cimiers" <?php if (isset($_GET['cimiers'])){ ?>value="<?php echo $_GET['cimiers'] ;?>"<?php }; ?>/>
	<br /><br /><br />
	
	<!--DEVISE LEGENDE -->
	<label class="label1" ><strong>Devise / Légende</strong></label>
	<input type="text" name="devise_legende"<?php if (isset($_GET['devise_legende'])){ ?>value="<?php echo $_GET['devise_legende'] ;?>"<?php }; ?>/>
	<br /><br />
	
	<!-- EMBLEME-->
	
	<label class="label1"><strong>Emblème</strong></label>
	<input type="text" name="embleme"  <?php if (isset($_GET['embleme'])){ ?>value="<?php echo $_GET['embleme'] ;?>"<?php }; ?> />
	<br /><br />		



      </div> <!-- fin colonne droite-->	
      <br /><br /><br /><br />
      <!-- COLONNE GAUCHE 2-->
      <div id="gauche_2">
	<!-- AUTEURS-->
	<label class="label1"><strong>Auteur(s)</strong></label>
	<input type="text" name="auteur" <?php if (isset($_GET['auteur'])){ ?>value="<?php echo $_GET['auteur'] ;?>"<?php }; ?> />
	<br /><br />		
	<!-- TITRE-->
	<label class="label1"><strong>Titre</strong></label>
	<input type="text" name="titre" <?php if (isset($_GET['titre'])){ ?>value="<?php echo $_GET['titre'] ;?>"<?php }; ?> />
	<br /><br />		
	<!-- LIEU EDITION -->
	<label class="label1"><strong>Lieu d'édition</strong></label>
	<!--<input type="text" name="Date"  <?php if (isset($_GET['search'])){ ?>value="<?php echo $_GET['search'] ;?>"<?php }; ?> />-->
	<select name="lieu_edition" style="width: 180px;">
	  <option value=""> </option>
	  <?php foreach($lieu_edition as $lieu){ ?>
	  <option value="<?php echo $lieu->lieu_edition ; ?>"><?php echo $lieu->lieu_edition ; ?></option>
	  <?php } ?>
	</select>
	<br /><br />
	<!-- EDITEUR-->
	<label class="label1"><strong>Editeur</strong></label>
	<input type="text" name="editeur" <?php if (isset($_GET['editeur'])){ ?>value="<?php echo $_GET['editeur'] ;?>"<?php }; ?> />
	<br /><br />
	<!-- ANNEE EDITION-->
	<label class="label1"><strong>Année d'édition</strong></label>
	<!--<input type="text" name="Date"  <?php if (isset($_GET['search'])){ ?>value="<?php echo $_GET['search'] ;?>"<?php }; ?> />-->
	<select name="annee_edition" style="width: 180px;">
	  <option value=""> </option>
	  <?php foreach($annee_edition as $annee){ ?>
	  <option value="<?php echo $annee->annee_edition ; ?>"><?php echo $annee->annee_edition ; ?></option>
	  <?php } ?>
	</select>
	<br /><br />
	<!-- RELIURE-->
	<label class="label1"><strong>Reliure</strong></label>
	<input type="text" name="reliure" <?php if (isset($_GET['reliure'])){ ?>value="<?php echo $_GET['reliure'] ;?>"<?php }; ?> />
	<br /><br />
      </div>
      <!-- #####-->

      <!-- COLONNE DROITE 2-->
      <div id="droite_2">
	<!-- PROVENANCE-->
	<label class="label1"><strong>Provenance</strong></label>
	<input type="text" name="provenance" <?php if (isset($_GET['provenance'])){ ?>value="<?php echo $_GET['provenance'] ;?>"<?php }; ?> />
	<br /><br />
	<!-- SITE-->
	<label class="label1"><strong>Site</strong></label>
	<input type="text" name="site" <?php if (isset($_GET['site'])){ ?>value="<?php echo $_GET['site'] ;?>"<?php }; ?> />
	<br /><br />
	<!-- SECTION-->
	<label class="label1"><strong>Section</strong></label>
	<input type="text" name="section" <?php if (isset($_GET['section'])){ ?>value="<?php echo $_GET['section'] ;?>"<?php }; ?> />
	<br /><br />
	<!-- COTE-->
	<label class="label1"><strong>Cote</strong></label>
	<input type="text" name="cote" <?php if (isset($_GET['cote'])){ ?>value="<?php echo $_GET['cote'] ;?>"<?php }; ?> />
	<br /><br />
	<!-- FOLIO-->
	<label class="label1"><strong>Emplacement</strong></label>
	<input type="text" name="folio" <?php if (isset($_GET['folio'])){ ?>value="<?php echo $_GET['folio'] ;?>"<?php }; ?> />
	<br /><br />

        <label class="label1"><strong>Bibliographie</strong></label>
	<input type="text" name="bibliographie" <?php if (isset($_GET['bibliographie'])){ ?>value="<?php echo $_GET['bibliographie'] ;?>"<?php }; ?> />
	<br /><br />
      </div>
      <!-- #####-->		
      
      <div style="text-align:center;">
	<br /><br /><br />

	<!--
	<input id='bouton_submit' type="submit" 
		style="    
			border: 0;
			padding-top: 250px;
			padding-bottom: 270px;
			float: right;
			position: relative;
			width: 75px;
			right: 0px;
			margin-top: -610px;
			color: white;
			background-color: #008080;
			cursor: pointer;
			border-radius: 4px;
			box-shadow: 1px 1px 4px dimgrey;
			"
		 name="rechercher_ordre" value="Rechercher" />
	-->	 

    <!--
	<button type="submit" id='bouton_submit' name="rechercher_ordre" value="Rechercher"
                  style="
                        padding-top: 205px;
                        padding-bottom: 205px;
                        float: right;
                        position: relative;
                        width: 75px;
                        right: 0px;
                        margin-top: -610px;
                        color: white;
                        background-color: #008080;
                        cursor: pointer;
                        border-radius: 4px;
                        box-shadow: 1px 1px 4px dimgrey;
                        "
  >

                  <span>R</span><br />
                  <span>E</span><br />
                  <span>C</span><br />
                  <span>H</span><br />
                  <span>E</span><br />
                  <span>R</span><br />
                  <span>C</span><br />
                  <span>H</span><br />
                  <span>E</span><br />
                  <span>R</span>
  </button>
  -->
          <button type="submit" id='bouton_submit' name="rechercher_ordre" value="Rechercher"
                  style="
                        padding-top: 115px;
                        padding-bottom: 96px;
                        float: right;
                        position: relative;
                        width: 60px;
                        right: 0px;
                        margin-top: -590px;
                        border: 2px solid #A7430F;
                        border-radius: 5px;
                        box-shadow: 2px 0px #A7430F;
                        font-family: Garamond;
                        color: #A7430F;
                        background-color: transparent;
                        cursor: pointer;
                        "
          >
              <div style=
                   "font-size: 200%;
                   font-weight: bold;
                        ">
                  <span>R</span><br />
                  <span>E</span><br />
                  <span>C</span><br />
                  <span>H</span><br />
                  <span>E</span><br />
                  <span>R</span><br />
                  <span>C</span><br />
                  <span>H</span><br />
                  <span>E</span><br />
                  <span>R</span>
              </div>
          </button>

      </div>
      
    </form>
    <br />
  </fieldset><br />
							     <?php } ?>

</div>
