<?php

class Model_administration extends Model{
	function identifiant(){ //récuération des identifiants
		$identifiants = $this->db->query('
			SELECT * 
			FROM utilisateurs
		');
        return $identifiants->result();
	}

        function getMail(){ //récup de l'adresse mail admin
            $mail = $this->db->query("SELECT mail FROM utilisateurs WHERE id=1");
            return $mail->result();
        }

        function changeMail($new_mail){ //update de l'adresse mail admin
            $this->db->query("UPDATE utilisateurs SET mail='$new_mail' WHERE id='1'");
        }

	function mise_a_jour($fichier,$table,$liste) //insertion de contenus ds la base par fichiers csv
	{
	  if ($_SERVER['SERVER_ADDR']=='127.0.0.1') //distinction entre local et server car synthaxes différentes ds les 2 cas
	    {
	      $requete = $this->db->query("LOAD DATA INFILE '".$fichier."'
									INTO TABLE ".$table."
                                    CHARACTER SET UTF8
									FIELDS TERMINATED BY '\t'
									LINES TERMINATED BY '\r'
                                                                        IGNORE 2 LINES
									(".$liste.")");
									echo mysql_error();
	    }
	  else
	    {
	      $requete = $this->db->query("LOAD DATA LOCAL INFILE '".$fichier."'
									INTO TABLE ".$table."
                                    CHARACTER SET UTF8
									FIELDS TERMINATED BY '\t'
									LINES TERMINATED BY '\r'
                                                                        IGNORE 2 LINES
									(".$liste.")");
	    }


	}

	function affichage_table($table,$lettre) //récupération données d'une table
	{
		$lettre = explode("-", $lettre);
                $donnees = "patronyme LIKE '".$lettre[0]."%' ";

                for($i=1;$i<sizeof($lettre);$i++){
                    $donnees.=" OR patronyme LIKE '".$lettre[$i]."%' ";
                }

                $requete = $this->db->query("SELECT * FROM ".$table." WHERE ".$donnees." ORDER BY patronyme");
		return $requete;
	}

	function modif_mdp($mdp) //update mdp admin
	{
		$this->db->query("UPDATE utilisateurs SET password='$mdp' WHERE id='1'");
	}

        function miseAjourImages($libelle, $id){ //modif colonne "libellé image" si ajout/suppression d'image(s) au contenu
            $libelle_old = "";
            $requete = $this->db->query("SELECT libellé_image FROM legende_photos WHERE id='".$id."'");

            foreach ($requete->result() as $row)
            {
                $libelle_old = $row->libellé_image;
            }

            $taille = strlen($libelle_old);


            if($libelle_old!=""){
                if($libelle_old[$taille-1]!=";")
                    $libelle_old = $libelle_old.";";
            }

            $libelle_new = $libelle_old.$libelle;
            $this->db->query("UPDATE legende_photos SET libellé_image='$libelle_new' WHERE id='".$id."'");
        }

        function getArmes($start,$end){ //récup des armes
            $armes = $this->db->query("SELECT blasonnement_1, patronyme FROM armorial LIMIT ".$start." , ".$end);
            return $armes;
        }

        function getEquivalences(){ //récup des équivalences
            $equivalences = $this->db->query("SELECT * FROM equivalences");
            return $equivalences;
        }

        function getDicoEcu(){
            $dico = $this->db->query("SELECT * FROM dictionnaire_ecu");
            return $dico;
        }

        function getDicoRegion(){
            $dico = $this->db->query("SELECT * FROM dictionnaire_region");
            return $dico;
        }

        function ajoutExpression($mot_1, $mot_2,$table){ //ajout expression équivalences
            $this->db->query("INSERT INTO ".$table."(expression, signification) VALUES ('$mot_1','$mot_2')");
        }

        function supression($table,$id){ //supression contenu
            $this->db->query("DELETE FROM ".$table." WHERE id='".$id."'");
        }

        function affich_table($table,$lettre){ //récup contenu par lettre de début de patronyme

                $patronyme = "";

		$lettre = explode("-", $lettre);
                $donnees = "famille LIKE '".utf8_encode($lettre[0])."%'";
                

                for($i=1;$i<sizeof($lettre);$i++){
                    $donnees.=" OR famille LIKE '".utf8_encode($lettre[$i])."%'";
                    
                }

                
                $requete = $this->db->query("SELECT * FROM ".$table." WHERE ".$donnees." ORDER BY famille");
		return $requete;
	}

        function getPhotos($id){ //récup libelé image
            $requete = $this->db->query("SELECT libellé_image FROM legende_photos WHERE id='".$id."'");
            return $requete->result_array();
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
 	/*	|----------------------------------------------------------------------------------------------------
		| Recherche par ID 
		|----------------------------------------------------------------------------------------------------*/
	        function getid($recherche_id){ //récup de l'adresse id admin
            $idr = $this->db->query("SELECT a.id, a.patronyme , a.famille, a.origine, a.date, a.siècle, a.fief, a.région, a.région_bis, a.départment, a.alliances, a.armoiries, 
					a.notes, a.ref_biblio, a.le_clert, a.armorial_gen_champagne AS champ, a.notes_armoriaux AS not_armor, a.blasonnement_1,
					a.blasonnement_2, a.blasonnement_3, a.blasonnement_4, a.blasonnement_5, a.blasonnement_6, 
					a.blasonnement_7, a.blasonnement_8, a.blasonnement_9, a.blasonnement_10, a.blasonnement_11, a.blasonnement_12, a.blasonnement_13, 
					a.blasonnement_14, a.blasonnement_15, a.blasonnement_16, a.blasonnement_17, a.blasonnement_18, a.cimiers, a.devise, a.lambrequins, a.support
			FROM armorial a WHERE a.id = ".$recherche_id." ");
            return $idr->result();  }
}
?>
