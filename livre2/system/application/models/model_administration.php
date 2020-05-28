<?php

class Model_administration extends Model{

	function get_partenaires(){
		$partenaires = $this->db->query('
			SELECT * FROM partenaire
		');
		return $partenaires->result();
	}

	function insert_partenaire($nom, $url){
		$this->db->query("INSERT INTO partenaire (nom,url) VALUES ('".$nom."','".$url."')");
	}

	function delete_partenaire($id){
		$this->db->query("DELETE FROM partenaire WHERE id=".$id."");
	}
    
	function identifiant(){
		$identifiants = $this->db->query('
			SELECT * 
			FROM utilisateurs
		');
        return $identifiants->result();
	}

        function getMail(){
            $mail = $this->db->query("SELECT mail FROM utilisateurs WHERE id=1");
            return $mail->result();
        }

        function changeMail($new_mail){
            $this->db->query("UPDATE utilisateurs SET mail='$new_mail' WHERE id='1'");
        }
	
	function mise_a_jour($fichier,$table,$liste)
	{	
	  if ($_SERVER['SERVER_ADDR']=='127.0.0.1')
	    {
	      $requete = $this->db->query("LOAD DATA INFILE '".$fichier."'
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
	
	function modif_mdp($mdp)
	{
		$this->db->query("UPDATE utilisateurs SET password='$mdp' WHERE id='1'");
	}

    function suppression($id){
        $this->db->query("DELETE * FROM details WHERE id='".$id."'");
    }

    function getPhotos($id){
        $requete = $this->db->query("SELECT libelle_image FROM details WHERE id='".$id."'");
        return $requete->result_array();
    }

    function miseAjourImages($libelle, $id){
        $libelle_old = "";
        $requete = $this->db->query("SELECT libelle_image FROM details WHERE id='".$id."'");

        foreach ($requete->result() as $row)
        {
            $libelle_old = $row->libelle_image;
        }

        $taille = strlen($libelle_old);

        
        if($libelle_old!=""){
            if($libelle_old[$taille-1]!=";")
                $libelle_old = $libelle_old.";";
        }

        $libelle_new = $libelle_old.$libelle;
        $this->db->query("UPDATE details SET libelle_image='$libelle_new' WHERE id='".$id."'");
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
        $idr = $this->db->query("SELECT a.id, a.libelle_image, a.patronyme, a.auteur_cliche, a.type_cliche, a.annee_cliche, a.pays, a.region, a.departement, a.commune, a.edifice_conservation, a.photo, a.ref_Im, a.ref_pa, a.ref_Ia, a.Individu, a.biographie, a.parente, a.date, a.denomination,
					a.titre, a.categorie, a.materiau, a.ref_reproduction, a.bibliographie, a.embleme, a.auteurs, a.lieu_edition, a.editeur, a.annee_edition, a.reliure, a.provenance, a.site, a.section,
					a.cote, a.folio_emplacement, a.cimiers, a.armes, a.notes, a.devise
			FROM details a WHERE a.id = ".$recherche_id." ");
            return $idr->result();  }
}
?>
