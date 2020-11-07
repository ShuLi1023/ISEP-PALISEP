<?php

class Model_fiche_modif extends Model{ // Le nom de la classe est le nom du model avec une majuscule

	function recherche_infos($id,$table){
	
		$liste = $this->db->query("SELECT * FROM ".$table." WHERE id = '$id'");
		return $liste->row_array(); 
	}
	
	

    function update_legende_photos($id, $patronyme){
    	$query = $this->db->query("SELECT patronyme FROM armorial WHERE id='$id'");
    	$data = $query->row_array();
    	$old_patronyme = $data['patronyme'];
    	
    	if($old_patronyme != $patronyme){
    		$this->db->query("UPDATE legende_photos SET vedette_chandon = '$patronyme' WHERE vedette_chandon = '$old_patronyme'");
    	}
    }

}

?>