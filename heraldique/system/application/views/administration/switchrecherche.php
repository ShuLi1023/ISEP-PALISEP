<?php
//vérifier si la recherche publique est actuellement autorisée
$recherche_publique_state = $this->db->query("SELECT SSTATE FROM SWITCH WHERE SNAME = 'PSEARCH'");
$row = $recherche_publique_state->row();
$current_publique = $row->SSTATE;


if ($current_publique == '1' ) {
    echo anchor('recherche', 'Recherche publique');
} else {
    echo '<div id="recherche"> <a> D&eacute;sol&eacute;, la recherche publique n\'est pas disponible.</a> </div>';
}
?>