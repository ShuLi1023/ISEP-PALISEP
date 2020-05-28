<script>
    $( "#loader" ).dialog("close");
</script>
<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    //Vue qui affiche un lien vers le fichier word des armes
    header("Content-type: application/msword");
    header("Content-Disposition: attachment; filename=Recapitulatif_armes_".date("d-m-Y").".doc");
    header("Pragma: no-cache");
    header("Expires: 0");

    $titre = utf8_decode("Récapitulatif des mots utilisés pour les armes");
    $contenu = "<center><h1>".$titre."</h1></center><br /><br />";

    echo $contenu.$tableau;

?>
