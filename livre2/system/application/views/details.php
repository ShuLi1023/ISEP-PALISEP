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
    <a href="javascript:history.back()">Retour</a>
  </div>
  <center>
    <h2 class="title">
      <?php echo strtr(ucwords(mb_strtolower($data->patronyme, 'UTF-8'))," De "," de "); ?>
    </h2>
    <br />
    <?php
        $images = explode(";", $data->libelle_image);
        for($i=0;$i<sizeof($images);$i++)
        {
            if($images[$i]!=""){

    ?>
            <a href="<?php echo PALISEP ; ?>resources/images/<?php echo $images[$i]; ?>.jpg" rel="lightbox[roadtrip]">
                <img width="80px" src="<?php echo PALISEP ; ?>resources/images/<?php echo $images[$i]; ?>.jpg"/>
            </a>
    <?php
            }

        }
    ?>
  </center>
  <br />
  <div class="fiche">
    <div style="float:left; width:30%; margin-left:20px;text-align: justify;"> <!-- 2 × 8 = 100 - (30 + 1 + 30 + 1 + 30) -->
      <?php 
      affiche("Pays", $data->pays);
      affiche("Région", $data->region);
      affiche("Département", $data->departement);
      affiche("Commune", $data->commune);
      affiche("Edifice de conservation", $data->edifice_conservation);
      affiche("Dénomination", $data->denomination);
      affiche("Catégorie", $data->categorie);
      affiche("Matériau", $data->materiau);
      ?>
      <a href="" onclick="javascript:visibilite('id_div_1'); return false;" >
	<strong>Référence de reproduction&nbsp;</strong></a><br /><br />
      <div id="id_div_1" style="display:none;text-align: justify;">
	<?php
	affiche("ID", $data->id);
	affiche("Référence de la reproduction", $data->ref_reproduction);
	affiche("Auteur du cliché", $data->auteur_cliche);
	affiche("Type du cliché", $data->type_cliche);
	affiche("Année du cliché", $data->annee_cliche);
	affiche("Type de photo", $data->photo);
	affiche("Référence IM", $data->ref_im);
	affiche("Référence PA", $data->ref_pa);
	affiche("Référence IA", $data->ref_ia);
	?>
      </div>
    </div>
    <div style="float:left;margin-left:30px; width:30%;text-align: justify;">
      <?php
      affiche("Famille / Institution&nbsp;", $data->patronyme);
      affiche("Individu", $data->individu);
      affiche("Biographie", $data->biographie);
      affiche("Parenté", $data->parente);
      affiche("Emblème", $data->embleme);
      affiche("Armes", $data->armes);
      affiche("Ornements ext&eacute;rieurs", $data->cimiers);
      affiche("Devise/L&eacute;gende", $data->devise);
      affiche("Notes", $data->notes);
      affiche("Bibliographie", $data->bibliographie);
      ?>
    </div>
    <div style="float:left; margin-left:30px;width:30%;text-align: justify;">
      <?php
      affiche("Auteur(s)", $data->auteurs);
      affiche("Titre", $data->titre);
      affiche("Lieu d&apos;édition", $data->lieu_edition);
      affiche("Editeur", $data->editeur);
      affiche("Année d&apos;édition", $data->annee_edition);
      affiche("Reliure", $data->reliure);
      affiche("Provenance", $data->provenance);
      affiche("Site", $data->site);
      affiche("Section", $data->section);
      affiche("Cote", $data->cote);
      affiche("Folio ou emplacement", $data->folio_emplacement);
      ?>
	  
	 <strong>ID</strong> : <?php echo $data->id; ?><br /><br />
    </div>
    <div style="clear:both;"></div>
  </div>
</div>
<?php } ?>
