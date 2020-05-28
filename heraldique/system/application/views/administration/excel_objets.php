<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


    header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=Excel_objets_type.csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    $contenu = "Vedette chandon;Famille;Individu;Qualité;Date;Dénomination;Titre;Catégorie;Matériau;Références reproduction;Bibilo;Remarques;Auteurs;Lieu édition;Editeur;Année édition;Reliure;Provenance;Site;Section;Cote;Folio emplacement;Auteur cliché;Pays;Région;Département;Commune;Village;Edifice de conservation;Emplacement dans édifice;Photo;N°INSEE commune;Ref. IM; Ref. PA;Ref. IA;\n";

    echo $contenu;
?>
