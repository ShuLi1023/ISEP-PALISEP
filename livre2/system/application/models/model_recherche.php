<?php
class Model_recherche extends Model{ // Le nom de la classe est le nom du model avec une majuscule

	// recherche_mot_2 --> Test Charlotte 
	function recherche_mot_2($requete){ 
		$liste = $this->db->query('
			SELECT a.id, a.id_armorial, a.patronyme, , a.origine, a.date, a.siècle, a.fief, a.alliances, a.armoiries, a.region,
					a.notes, a.le_clert, a.armorial_gen_champagne AS champ, a.notes_armoriaux AS not_armor, a.blasonnement_1, 
					a.blasonnement_2, a.blasonnement_3
			FROM armorial a
			WHERE '.$requete.'
			ORDER BY length(a.blasonnement_1),length(a.blasonnement_2),length(a.blasonnement_3)
		');
        return $liste->result(); 
	}
// $requete contient la fin de la requete SQL 
	function recherche_mot($requete1,$requete2, $requete3,$requete4, $requete5, $requete6,$order_by){ 
		$liste = $this->db->query('
			SELECT a.id, a.id_armorial, a.patronyme ,, a.origine, a.date, a.siècle, a.fief, a.alliances, a.armoiries, a.region,
					a.notes, a.le_clert, a.armorial_gen_champagne AS champ, a.notes_armoriaux AS not_armor, a.blasonnement_1, 
					a.blasonnement_2, a.blasonnement_3,a.departement
			FROM armorial a
			WHERE '.$requete1.'
			'.$requete2.'
			'.$requete3.'
			'.$requete4.'
			'.$requete5.'
			'.$requete6.'
			'.$order_by.'
		');
        return $liste->result(); 
	}
	function recherche_simple($requete){ 
		$liste = $this->db->query('
			SELECT a.id, a.id_armorial, a.patronyme ,, a.origine, a.date, a.siècle, a.fief, a.alliances, a.armoiries, a.region,
					a.notes, a.le_clert, a.armorial_gen_champagne AS champ, a.notes_armoriaux AS not_armor, a.blasonnement_1, 
					a.blasonnement_2, a.blasonnement_3,a.departement
			FROM armorial a
			WHERE '.$requete.'
		');
        return $liste->result(); 
	}
function recherche_simple2($requete){ 
		$liste = $this->db->query('
			SELECT DISTINCT a.id, a.id_armorial, a.patronyme , a.origine, a.date, a.siècle, a.fief, a.alliances, a.armoiries, a.region,
					a.notes, a.le_clert, a.armorial_gen_champagne AS champ, a.notes_armoriaux AS not_armor, a.blasonnement_1, 
					a.blasonnement_2, a.blasonnement_3,a.departement, a.cimiers, a.devise,a.ref_biblio
			FROM armorial a, details l
			WHERE '.$requete.'
		');
        return $liste->result(); 
	}
	function photo_liste(){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT l.libelle_image,l.patronyme
			FROM details l
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
	function siecle_liste(){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT siècle
			FROM armorial
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
	function denomination_liste(){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT denomination
			FROM details
			ORDER BY denomination
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
	function categorie_liste(){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT categorie
			FROM details
			ORDER BY categorie
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
	function materiau_liste(){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT materiau
			FROM details
			ORDER BY materiau
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
	function date_liste(){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT date
			FROM details
			ORDER BY date
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
        function dico($mot, $table){
               $donnees = $this->db->query("SELECT * FROM ".$table." WHERE expression='".$mot."' OR signification='".$mot."'");
        return $donnees->result();
    }
	function commune_liste(){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT commune
			FROM details
			ORDER BY commune
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

    function lieu_edition_liste(){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT lieu_edition
			FROM details
			ORDER BY lieu_edition
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

    function annee_edition_liste(){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT annee_edition
			FROM details
			ORDER BY annee_edition
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
}
?>
