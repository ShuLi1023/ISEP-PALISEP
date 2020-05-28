<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=Excel_armorial_type.csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    $contenu = "Famille;Prénom;Titres/Dignités;Origine;Date;Siècle;Fief;Aire géographie;Pays;Région;Région_bis;Département;Alliances;Notes;Armes;Cimiers/Ornements ext;Devise/Légende;Emblème;Lambrequins;Tenant/Support;Observations;Dénomination;Ref_biblio;\n";

    echo $contenu;

?>
