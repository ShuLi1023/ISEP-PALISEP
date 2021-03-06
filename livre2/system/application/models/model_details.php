<?php

class Model_details extends Model{ // Le nom de la classe est le nom du model avec une majuscule

	function infos($id){
	  $requete = 'SELECT l.id, l.libelle_image, l.patronyme, l.auteur_cliche, l.type_cliche, l.annee_cliche, l.pays, l.region, l.departement, l.commune, l.edifice_conservation, l.photo, l.ref_im, l.ref_pa, l.ref_ia, l.individu, l.biographie, l.parente, l.date, l.denomination, l.titre, l.categorie, l.materiau, l.ref_reproduction, l.bibliographie, l.auteurs, l.lieu_edition, l.editeur, l.annee_edition, l.reliure, l.provenance, l.site, l.section, l.cote, l.folio_emplacement, l.notes,l.armes, l.devise, l.cimiers, l.embleme
FROM details l
WHERE l.id =  "'.$id.'"';

	  //	  echo $requete;
		$donnees = $this->db->query($requete);
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
	function fiche($patronyme){
		$donnees = $this->db->query('
			SELECT d.id, d.patronyme
			FROM details d
			WHERE d.patronyme = "'.$patronyme.'"
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
	function recherche_photo($requete){ // la fonction fiche() est utilisée dans le controller fiche.php
	  $requete_complete = '
			SELECT DISTINCT l.id, l.libelle_image, l.patronyme , l.auteur_cliche, l.type_cliche, l.annee_cliche, l.commune, l.edifice_conservation,	l.photo, l.ref_im, l.ref_pa, l.ref_ia, l.individu, l.biographie, l.date, l.denomination, l.titre, l.categorie, l.materiau, l.ref_reproduction, l.bibliographie, l.cimiers, l.embleme
			FROM details l
			WHERE '.$requete.' ORDER BY length(armes) asc';
	  //	  echo $requete_complete;
	  $donnees = $this->db->query($requete_complete);
	  return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
	}

	function infos_commune($commune){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT l.id, l.libelle_image, l.patronyme , l.auteur_cliche, l.type_cliche, l.annee_cliche, l.commune, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.ref_im, l.ref_pa, l.ref_ia, l.individu, l.biographie, l.date, l.denomination,
					l.titre, l.categorie, l.materiau, l.ref_reproduction, l.bibliographie
			FROM details l
			WHERE '.$commune.'
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

	function infos_Village($Village){
		$donnees = $this->db->query('
			SELECT l.id, l.libelle_image, l.patronyme , l.auteur_cliche, l.type_cliche, l.annee_cliche, l.commune, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.ref_im, l.ref_pa, l.ref_ia, l.individu, l.biographie, l.date, l.denomination,
					l.titre, l.categorie, l.materiau, l.ref_reproduction, l.bibliographie
			FROM details l
			WHERE '.$Village.'
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

	function infos_Date($Date){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT l.id, l.libelle_image, l.patronyme , l.auteur_cliche, l.type_cliche, l.annee_cliche, l.commune, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.ref_im, l.ref_pa, l.ref_ia, l.individu, l.biographie, l.date, l.denomination,
					l.titre, l.categorie, l.materiau, l.ref_reproduction, l.bibliographie
			FROM details l
			WHERE '.$Date.'
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

	function infos_Denomination($Denomination){
		$donnees = $this->db->query('
			SELECT l.id, l.libelle_image, l.patronyme , l.auteur_cliche, l.type_cliche, l.annee_cliche, l.commune, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.ref_im, l.ref_pa, l.ref_ia, l.individu, l.biographie, l.date, l.denomination,
					l.titre, l.categorie, l.materiau, l.ref_reproduction, l.bibliographie
			FROM details l
			WHERE '.$Denomination.'
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

	function infos_Categorie($Categorie){
		$donnees = $this->db->query('
			SELECT l.id, l.libelle_image, l.patronyme , l.auteur_cliche, l.type_cliche, l.annee_cliche, l.commune, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.ref_im, l.ref_pa, l.ref_ia, l.individu, l.biographie, l.date, l.denomination,
					l.titre, l.categorie, l.materiau, l.ref_reproduction, l.bibliographie
			FROM details l
			WHERE '.$Categorie.'
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

	function infos_Conservation($Conservation){
		$donnees = $this->db->query('
			SELECT l.id, l.libelle_image, l.patronyme , l.auteur_cliche, l.type_cliche, l.annee_cliche, l.commune, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.ref_im, l.ref_pa, l.ref_ia, l.individu, l.biographie, l.date, l.denomination,
					l.titre, l.categorie, l.materiau, l.ref_reproduction, l.bibliographie, l.edifice_conservation
			FROM details l
			WHERE '.$Conservation.'
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

	function infos_Materiau($materiau){
		$donnees = $this->db->query('
			SELECT l.id, l.libelle_image, l.patronyme , l.auteur_cliche, l.type_cliche, l.annee_cliche, l.commune, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.ref_im, l.ref_pa, l.ref_ia, l.individu, l.biographie, l.date, l.denomination,
					l.titre, l.categorie, l.materiau, l.ref_reproduction, l.bibliographie
			FROM details l
			WHERE  '.$materiau.'
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
	function armorial($patronyme){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT d.departement,d.region
			FROM details d
			WHERE d.patronyme="'.$patronyme.'"
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
}
?>
