<?php
	class Model_recherche extends Model{ // Le nom de la classe est le nom du model avec une majuscule
		
		// recherche_mot_2 --> Test Charlotte 
		function recherche_mot_2($requete){ 
			$liste = $this->db->query('
			SELECT a.id, a.id_armorial, a.patronyme, a.famille , a.origine, a.date, a.siècle, a.fief, a.alliances, a.armoiries, a.région,
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
			SELECT a.id, a.id_armorial, a.patronyme ,a.famille , a.origine, a.date, a.siècle, a.fief, a.alliances, a.armoiries, a.région,
			a.notes, a.le_clert, a.armorial_gen_champagne AS champ, a.notes_armoriaux AS not_armor, a.blasonnement_1, 
			a.blasonnement_2, a.blasonnement_3,a.départment
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
			a.notes, a.le_clert, a.armorial_gen_champagne AS champ, a.notes_armoriaux AS not_armor, a.blasonnement_1, 
			a.blasonnement_2, a.blasonnement_3,a.départment
			FROM armorial a
			WHERE '.$requete.'
		');
        return $liste->result(); 
		}
		function recherche_simple2($requete){ 
		$liste = $this->db->query('
		SELECT DISTINCT a.id, a.id_armorial, a.patronyme ,a.famille , a.origine, a.date, a.siècle, a.fief, a.alliances, a.armoiries, a.région,
		a.notes, a.le_clert, a.armorial_gen_champagne AS champ, a.notes_armoriaux AS not_armor, a.blasonnement_1, 
		a.blasonnement_2, a.blasonnement_3,a.départment
		FROM armorial a, legende_photos l
		WHERE '.$requete.'
		');
        return $liste->result(); 
		}
		function photo_liste(){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
		SELECT l.libellé_image,l.vedette_chandon
		FROM legende_photos l
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
		SELECT DISTINCT dénomination
		FROM legende_photos
		WHERE legende_photos.départment = "Aube" 
		ORDER BY dénomination
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
		}
		function categorie_liste(){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
		SELECT DISTINCT catégorie
		FROM legende_photos
		WHERE legende_photos.départment = "Aube" 
		ORDER BY catégorie
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
		}
		function materiau_liste(){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
		SELECT DISTINCT matériau
		FROM legende_photos
		WHERE legende_photos.départment = "Aube" 
		ORDER BY matériau
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
		}
		function date_liste(){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
		SELECT DISTINCT date
		FROM legende_photos
		WHERE legende_photos.départment = "Aube" 
		ORDER BY date
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
		}
		function commune_liste(){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
		SELECT DISTINCT commune
		FROM legende_photos
		WHERE legende_photos.départment = "Aube" 
		ORDER BY commune
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
		}
		}
		?>
				