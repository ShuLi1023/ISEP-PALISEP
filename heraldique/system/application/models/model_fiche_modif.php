<?php

class Model_fiche_modif extends Model{ // Le nom de la classe est le nom du model avec une majuscule

	function recherche_infos($id,$table){ //récup infos sur un contenu
	
		$liste = $this->db->query("SELECT * FROM ".$table." WHERE id = '$id'");
		return $liste->row_array(); 
	}

        function supImage($id,$new_name){ //update libellé image
            $this->db->query("UPDATE legende_photos SET libellé_image='$new_name' WHERE id='".$id."'");
        }

}

?>