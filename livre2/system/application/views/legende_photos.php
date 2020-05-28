<?php // le nettoyage a été fait sur cette page, consulter svn pour savoir ce que j'ai viré en masse.

function affiche($titre, $donnee)
{
      
  if ($donnee != NULL)
    {
      echo '<strong>'.$titre.'&nbsp;: </strong>'.$donnee.'<br /><br />';
    }
}


foreach ($donnees as $data) {

  ?>



<div id="resultats" >
  <div class="navigation">
    <a href="http://www.livre2.palisep.fr/">Accueil</a>
    | 
    <a href="http://www.livre2.palisep.fr/recherche_photo">Retour sur le formulaire</a>
  </div>
  <center>
    <h2 class="title">
      <?php {echo ucfirst(mb_strtolower($data->vedette_chandon,'UTF-8'));} ?>
    </h2>
    <br />
    <a href="<?php echo PALISEP ; ?>resources/images/<?php echo $data->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
      <img width="80px" src="<?php echo PALISEP ; ?>resources/images/<?php echo $data->libellé_image; ?>.jpg"/>
    </a>
  </center>
  <br />
  <div class="fiche">
    <div style="float:left; width:30%; margin-left:15px"> <!-- 2 × 8 = 100 - (30 + 1 + 30 + 1 + 30) -->
      <?php 
      affiche("Pays", $data->pays);
      affiche("Région", $data->région);
      affiche("Département", $data->départment);
      affiche("Commune", $data->commune);
      affiche("Edifice de conservation", $data->edifice_conservation);
      affiche("Dénomination", $data->dénomination);
      affiche("Catégorie", $data->catégorie);
      affiche("Matériau", $data->matériau);
      ?>
      <a href="" onclick="javascript:visibilite('id_div_1'); return false;" >
	<strong>Référence de reproduction&nbsp;</strong></a><br /><br />
      <div id="id_div_1" style="display:none;">
	<?php
	affiche("ID", $data->id);
	affiche("Référence de la reproduction", $data->ref_reproductions);
	affiche("Auteur du cliché", $data->auteur_cliché);
	affiche("Type du cliché", $data->type_cliché);
	affiche("Année du cliché", $data->année_cliché);
	affiche("Type de photo", $data->photo);
	affiche("Référence IM", $data->ref_IM);
	affiche("Référence PA", $data->ref_PA);
	affiche("Référence IA", $data->ref_IA);
	?>
      </div>
    </div>
    <div style="float:left;margin-left:20px; width:30%;">
      <?php
      affiche("Famille / Institution&nbsp;", $data->famille);
      affiche("Individu", $data->individu);
      affiche("Biographie", $data->qualité);
      affiche("Date", $data->date);
      affiche("Armes", $data->blasonnement_1);
      affiche("Ornements ext&eacute;rieurs", $data->cimiers);
      affiche("Devise/L&eacute;gende", $data->devise);
      affiche("Notes", "");
      affiche("Bibliographie", $data->biblio);
      ?>
    </div>
    <div style="float:left; margin-left:20px;width:30%;">
      <?php
      affiche("Auteur(s)", $data->auteurs);
      affiche("Titre", $data->titre);
      affiche("Lieu d&apos;édition", $data->lieu_édition);
      affiche("Editeur", $data->editeur);
      affiche("Année d&apos;édition", $data->année_édition);
      affiche("Reliure", $data->reliure);
      affiche("Provenance", $data->provenance);
      affiche("Site", $data->site);
      affiche("Section", $data->section);
      affiche("Cote", $data->cote);
      affiche("Folio ou emplacement", $data->folio_emplacement);
      ?>
    </div>
    <div style="clear:both;"></div>
  </div>
</div>
<?php } ?>
