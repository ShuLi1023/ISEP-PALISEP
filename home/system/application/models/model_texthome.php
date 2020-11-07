<?php

class Model_texthome extends Model {
	function getTextHome(){
		$textHome = $this->db->query('
		SELECT * 
		FROM texthome
		');
    return $textHome->result();
	}

    function updateText($name, $description){
    	$this->db->query("UPDATE texthome SET description='$description' WHERE name='$name'");
	}
}
?>
