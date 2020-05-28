<?php

class Model_administration extends Model{
	function identifiant(){
		$identifiants = $this->db->query('
			SELECT * 
			FROM utilisateurs
		');
        return $identifiants->result();
	}
	
	function mise_a_jour($fichier,$table,$liste)
	{	
	  if ($_SERVER['SERVER_ADDR']=='127.0.0.1')
	    {
	      $requete = $this->db->query("LOAD DATA LOCAL INFILE '".$fichier."'
									INTO TABLE ".$table."
									FIELDS 
										TERMINATED BY '\t'
									LINES
										TERMINATED BY '\r'
									IGNORE 1 LINES
									(".$liste.")");
	    }
	  else
	    {
	      $requete = $this->db->query("LOAD DATA LOCAL INFILE '".$fichier."'
									INTO TABLE ".$table."
									FIELDS 
										TERMINATED BY '\t'
									LINES
										TERMINATED BY '\r'
									IGNORE 1 LINES
									(".$liste.")");
	    }
	      
		$departement = "départment";
		$region = "région";
		$this->db->query("UPDATE legende_photos SET ".$departement."='Marne'");
		$this->db->query("UPDATE armorial SET ".$departement."='Marne', ".$region."='Champagne-Ardenne'");
	}
	
	function affichage_table($table)
	{
		$requete = $this->db->query("SELECT * FROM ".$table);
		return $requete; 
	}
	
	function modif_mdp($mdp)
	{
		$this->db->query("UPDATE utilisateurs SET password='$mdp' WHERE id='1'");
	}
	
	function blasonnement() 
	{
		$requete = $this->db->query("SELECT id, blasonnement_1 FROM armorial");
		$resultats = $requete->result();
		
		foreach ( $resultats as $row)
		{
			$id = $row->id;
			$blasonnement = $row->blasonnement_1;
			$blasonnements = explode('_', $blasonnement);
		
		
			if(isset($blasonnements[0]))
			{
				$blasonnements[0] = addslashes($blasonnements[0]);
				$sql1 = $this->db->query("UPDATE armorial SET blasonnement_1='$blasonnements[0]' WHERE id='$id'");
			}
		
			if(isset($blasonnements[1]))
			{
				$blasonnements[1] = addslashes($blasonnements[1]);
				$sql2 = $this->db->query("UPDATE armorial SET blasonnement_2='$blasonnements[1]' WHERE id='$id'");
			}
		
			if(isset($blasonnements[2]))
			{
				$blasonnements[2] = addslashes($blasonnements[2]);
				$sql3 = $this->db->query("UPDATE armorial SET blasonnement_3='$blasonnements[2]' WHERE id='$id'");
			}
		
			if(isset($blasonnements[3]))
			{
				$blasonnements[3] = addslashes($blasonnements[3]);
				$sql4 = $this->db->query("UPDATE armorial SET blasonnement_4='$blasonnements[3]' WHERE id='$id'");
			}
		
			if(isset($blasonnements[4]))
			{
				$blasonnements[4] = addslashes($blasonnements[4]);
				$sql5 = $this->db->query("UPDATE armorial SET blasonnement_5='$blasonnements[4]' WHERE id='$id'");
			}
		
		}
	}
}
?>
