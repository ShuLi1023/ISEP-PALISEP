<?php

class Model_administration extends Model{
		function identifiant(){
		$identifiants = $this->db->query('
			SELECT * 
			FROM utilisateurs
		');
        return $identifiants->result();
	}
}
?>
