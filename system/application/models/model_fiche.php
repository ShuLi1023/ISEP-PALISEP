<?php

class Model_fiche extends Model{ // Le nom de la classe est le nom du model avec une majuscule

	function fiche($id){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT a.id, a.patronyme , a.origine, a.date, a.siècle, a.fief,a.région, a.départment, a.alliances, a.armoiries, 
					a.notes, a.le_clert, a.armorial_gen_champagne AS champ, a.notes_armoriaux AS not_armor, a.blasonnement_1, 
					a.blasonnement_2, a.blasonnement_3, a.blasonnement_4, a.blasonnement_5, a.blasonnement_6, 
					a.blasonnement_7, a.blasonnement_8, a.blasonnement_9, a.blasonnement_10, a.blasonnement_11, a.blasonnement_12, a.blasonnement_13, 
					a.blasonnement_14, a.blasonnement_15, a.blasonnement_16, a.blasonnement_17, a.blasonnement_18
			FROM armorial a
			WHERE a.id='.$id.'
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
	
	// Rectification:(function photo à supprimer !) J'ai pris deux fonctions différentes car dans le cas où il n'y aurait pas de photo pour ce blason, ça n'afficherait rien.
	function photo($patronyme){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT l.id,l.libellé_image,l.vedette_chandon
			FROM legende_photos l
			WHERE l.vedette_chandon="'.$patronyme.'"
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
	function genealogie($id){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT g.id,g.nom_image
			FROM généalogie g
			WHERE g.id_patronyme='.$id.'
		');
       return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
}
?>
