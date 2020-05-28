<?php
class Model_recherche extends Model { // Le nom de la classe est le nom du modèle avec une majuscule

	// recherche_mot_2 
	function recherche_mot_2($requete){ 
		$liste = $this->db->query ('
			SELECT a.id, a.id_armorial, a.patronyme, a.famille , a.origine, a.date, a.siècle, a.fief, a.alliances, a.armoiries, a.région,
					a.région_bis, a.notes, a.le_clert, a.armorial_gen_champagne AS champ, a.notes_armoriaux AS not_armor, a.blasonnement_1, 
					a.blasonnement_2, a.blasonnement_3,a.pays,a.aire,
			FROM armorial a
			WHERE '.$requete.'
			ORDER BY length(a.blasonnement_1),length(a.blasonnement_2),length(a.blasonnement_3)
		');
        return $liste->result(); 
	}
// $requete contient la fin de la requete SQL 
	function recherche_mot($requete1,$requete2, $requete3,$requete4, $requete5, $requete6,$order_by){ 
		$liste = $this->db->query('
			SELECT a.id, a.id_armorial, a.patronyme ,a.famille , a.origine, a.date, a.siècle, a.fief, a.alliances, a.armoiries, a.région,
					a.région_bis, a.notes, a.le_clert, a.armorial_gen_champagne AS champ, a.notes_armoriaux AS not_armor, a.blasonnement_1, 
					a.blasonnement_2, a.blasonnement_3,a.départment,a.pays,a.aire,
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
			SELECT a.id, a.id_armorial, a.patronyme ,a.famille , a.origine, a.date, a.siècle, a.fief, a.alliances, a.armoiries, a.région,
					a.région_bis, a.notes, a.ref_biblio, a.le_clert, a.armorial_gen_champagne AS champ, a.notes_armoriaux AS not_armor, a.blasonnement_1,
					a.blasonnement_2, a.blasonnement_3,a.départment, a.cimiers, a.lambrequins, a.support, a.devise,a.pays,a.aire,
			FROM armorial a
			WHERE '.$requete.'
		');
        return $liste->result(); 
	}
	function recherche_simple2($requete){ //FROM armorial a LEFT OUTER JOIN legende_photos l ON a.famille = l.famille
		$liste = $this->db->query('
			SELECT a.id, a.id_armorial, a.patronyme ,a.famille , a.origine, a.date, a.siècle, a.fief, a.alliances, a.région,
					a.région_bis, a.notes, a.ref_biblio, a.blasonnement_1,a.pays,a.aire,
					a.blasonnement_2,a.départment, a.cimiers, a.lambrequins, a.support, a.devise
			FROM armorial a LEFT OUTER JOIN legende_photos l ON a.famille = l.famille
			WHERE '.$requete.' LIMIT 1000
		');
        return $liste->result(); 
	}

	function dico($mot, $table){
        $donnees = $this->db->query("SELECT * FROM ".$table." WHERE expression='".$mot."' OR signification='".$mot."'");
        return $donnees->result();
    }

	function photo_liste(){ // La fonction fiche() est utilisée dans le contrôleur fiche.php
		$donnees = $this->db->query('
			SELECT l.libellé_image,l.vedette_chandon
			FROM legende_photos l
		');
        return $donnees->result(); // La fonction retourne les données stockées dans la variable $donnees
    }
	function siecle_liste(){ // La fonction fiche() est utilisée dans le contrôleur fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT siècle
			FROM armorial
		');
        return $donnees->result(); // La fonction retourne les données stockées dans la variable $donnees
    }
	function denomination_liste(){ // La fonction fiche() est utilisée dans le contrôleur fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT dénomination
			FROM legende_photos
			ORDER BY dénomination
		');
        return $donnees->result(); // La fonction retourne les données stockées dans la variable $donnees
    }
	function categorie_liste(){ // La fonction fiche() est utilisée dans le contrôleur fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT catégorie
			FROM legende_photos
			ORDER BY catégorie
		');
        return $donnees->result(); // La fonction retourne les données stockées dans la variable $donnees
    }
	function materiau_liste(){ // La fonction fiche() est utilisée dans le contrôleur fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT matériau
			FROM legende_photos
			ORDER BY matériau
		');
        return $donnees->result(); // La fonction retourne les données stockées dans la variable $donnees
    }
	function date_liste(){ // La fonction fiche() est utilisée dans le contrôleur fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT date
			FROM legende_photos
			ORDER BY date
		');
        return $donnees->result(); // La fonction retourne les données stockées dans la variable $donnees
    }
	function commune_liste(){ // La fonction fiche() est utilisée dans le contrôleur fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT commune
			FROM legende_photos
			ORDER BY commune
		');
        return $donnees->result(); // La fonction retourne les données stockées dans la variable $donnees
    }

    function pays_liste(){ // La fonction fiche() est utilisée dans le contrôleur fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT pays
			FROM armorial
			ORDER BY pays
		');
        return $donnees->result(); // La fonction retourne les données stockées dans la variable $donnees
    }

    function region_liste(){ // La fonction fiche() est utilisée dans le contrôleur fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT région
			FROM armorial
			ORDER BY région
		');
        return $donnees->result(); // La fonction retourne les données stockées dans la variable $donnees
    }

    function region_liste_legPhotos(){ // La fonction fiche() est utilisée dans le contrôleur fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT région
			FROM legende_photos
			ORDER BY région
		');
        return $donnees->result(); // La fonction retourne les données stockées dans la variable $donnees
    }

    function departement_liste(){ // La fonction fiche() est utilisée dans le contrôleur fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT départment
			FROM armorial
			ORDER BY départment
		');
        return $donnees->result(); // La fonction retourne les données stockées dans la variable $donnees
    }
	
	function aire_liste(){ // La fonction fiche() est utilisée dans le contrôleur fiche.php
		$donnees = $this->db->query('
			SELECT DISTINCT aire
			FROM armorial
			ORDER BY aire
		');
        return $donnees->result(); // La fonction retourne les données stockées dans la variable $donnees
		}

	function ref_biblio_liste(){ // La fonction ref_biblio_liste() est utilisée dans le controleur recherche_test.php
		$donnees = $this->db->query("
			SELECT DISTINCT ref_biblio
			FROM armorial
			WHERE départment != 'Marne'
			ORDER BY ref_biblio
			");
		return $donnees->result(); 
	}

}
?>
