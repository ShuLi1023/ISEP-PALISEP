<?php

class Model_administration extends Model{   //ARMORIAL
    function identifiant(){
		$identifiants = $this->db->query('
			SELECT * 
			FROM utilisateurs
		');
		return $identifiants->result();
	}

	function patronyme_liste(){
		$patronymes = $this->db->query('
			SELECT patronyme 
			FROM armorial');
		return $patronymes->result();
function mise_a_jour($fichier,$table,$liste) //insertion de contenus ds la base par fichiers csv
	{
	  if ($_SERVER['SERVER_ADDR']=='127.0.0.1') //distinction entre local et server car synthaxes différentes ds les 2 cas
	    {
	      $requete = $this->db->query("LOAD DATA INFILE '".$fichier."'
									INTO TABLE ".$table."
									FIELDS TERMINATED BY '\t'
									LINES TERMINATED BY '\r'
                                                                        IGNORE 2 LINES
									(".$liste.")");
	    }
	  else
	    {
	      $requete = $this->db->query("LOAD DATA LOCAL INFILE '".$fichier."'
									INTO TABLE ".$table."
									FIELDS TERMINATED BY '\t'
									LINES TERMINATED BY '\r'
                                                                        IGNORE 2 LINES
									(".$liste.")");
	    }


	}
	}

	function affichage_table($table,$lettre)
	{
		$lettre = explode("-", $lettre);
		$donnees = "RTRIM( LTRIM( patronyme ) ) LIKE '".$lettre[0]."%' ";

		for($i=1;$i<sizeof($lettre);$i++){
			$donnees.=" OR RTRIM( LTRIM( patronyme ) ) LIKE '".$lettre[$i]."%' ";
		}

		$requete = $this->db->query("SELECT * FROM ".$table." WHERE ".$donnees." ORDER BY patronyme");
		return $requete;
	}

	function recuperation_photos($lettre)
	{
		$lettre = explode("-", $lettre);

		$donnees = "RTRIM( LTRIM( vedette_chandon ) ) LIKE '".$lettre[0]."%' ";

		for($i=1;$i<sizeof($lettre);$i++){
			$donnees.=" OR RTRIM( LTRIM( vedette_chandon ) ) LIKE '".$lettre[$i]."%' ";
		}

		$requete = $this->db->query("SELECT id, libellé_image, vedette_chandon FROM legende_photos WHERE ".$donnees);
		return $requete;

	}

	function modif_mdp($mdp, $id)
	{
		$this->db->query("UPDATE utilisateurs SET password='$mdp' WHERE id='$id'");
	}

	function get_presentation_text(){
		$presentation = $this->db->query('
			SELECT * 
			FROM presentation WHERE id = 1
		');
		return $presentation->result();
	}

	function update_presentation($text){
		$this->db->query("UPDATE presentation SET description = '".$text."' WHERE id=1");
	}
        function getEquivalences(){ //récup des équivalences
            $equivalences = $this->db->query("SELECT * FROM equivalences");
            return $equivalences;
        }
		function ajoutExpression($mot_1, $mot_2,$table){ //ajout expression équivalences
            $this->db->query("INSERT INTO ".$table."(expression, signification) VALUES ('$mot_1','$mot_2')");
        }
		function supression($table,$id){ //supression contenu
            $this->db->query("DELETE FROM ".$table." WHERE id='".$id."'");
        }
	 	/*	|----------------------------------------------------------------------------------------------------
		| Recherche par ID 
		|----------------------------------------------------------------------------------------------------*/
	        function getid($recherche_id){ //récup de l'adresse id admin
            $idr = $this->db->query("SELECT a.id, a.patronyme , a.famille, a.titres_dignites, a.origine, a.date, a.siècle, a.fief, a.pays, a.province, a.région, a.départment, a.ville, a.alliances, a.armoiries, 
					a.notes, a.observations, a.sources, a.le_clert, a.armorial_gen_champagne, a.notes_armoriaux, a.genealogie, a.document, a.timbre, a.cimier, a.devise_cri, a.tenants_support, a.decoration,
					a.ornements_ext, a.emblemes, a.images_geneal, a.images_doc, a.blasonnement_1,
					a.blasonnement_2, a.blasonnement_3
			FROM armorial a WHERE a.id = ".$recherche_id." ");
            return $idr->result();  }
}
?>
