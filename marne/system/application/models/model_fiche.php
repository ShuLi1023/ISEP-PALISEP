<?php

class Model_fiche extends Model{ // Le nom de la classe est le nom du model avec une majuscule

	function fiche($id){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT a.id, a.patronyme, a.date, a.ville, a.siècle, a.titres_dignites, a.départment, a.genealogie, a.région, a.observations,
					a.province, a.prenom, a.sources, a.document, a.timbre, a.cimier, a.devise_cri, a.tenants_support, a.decoration, a.ornements_ext, a.emblemes, a.blasonnement_1, 
					a.blasonnement_2, a.blasonnement_3
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
