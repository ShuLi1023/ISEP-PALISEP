<?php

class Model_legende_photos extends Model{ // Le nom de la classe est le nom du model avec une majuscule

	function infos($id){
	  $requete = 'SELECT l.id, l.libellé_image, l.vedette_chandon, l.auteur_cliché, l.type_cliché, l.année_cliché, l.pays, l.région, l.départment, l.commune, l.village, l.edifice_conservation, l.emplacement_dans_édifice, l.photo, l.commune_INSEE_number, l.ref_IM, l.ref_PA, l.ref_IA, l.artificial_number_Decrock, l.famille, l.individu, l.qualité, l.date, l.dénomination, l.titre, l.catégorie, l.matériau, l.ref_reproductions, l.biblio, l.auteurs, l.lieu_édition, l.editeur, l.année_édition, l.reliure, l.provenance, l.site, l.section, l.cote, l.folio_emplacement, a.blasonnement_1, a.devise, a.cimiers
FROM legende_photos l
LEFT OUTER JOIN armorial a
ON l.vedette_chandon = a.patronyme
WHERE l.id =  "'.$id.'"';

	  //	  echo $requete;
		$donnees = $this->db->query($requete);
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
	function fiche($vedette_chandon){
		$donnees = $this->db->query('
			SELECT a.id, a.patronyme
			FROM armorial a
			WHERE a.patronyme = "'.$vedette_chandon.'"
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
/*	function infos_pays($id){
		$donnees = $this->db->query('
			SELECT l.id, l.libellé_image, l.vedette_chandon , l.auteur_cliché, l.type_cliché, l.année_cliché, l.commune, l.village, l.edifice_conservation, l.emplacement_dans_édifice, 
					l.photo, l.commune_INSEE_number, l.ref_IM, l.ref_PA, l.ref_IA, l.artificial_number_Decrock, l.famille, l.individu, l.qualité, l.date, l.dénomination,
					l.titre, l.catégorie, l.matériau, l.ref_reproductions, l.biblio
			FROM legende_photos l, armorial a
			WHERE a.id = "'.$id.'"
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

	function infos_region($Region){
		$donnees = $this->db->query('
			SELECT l.id, l.libellé_image, l.vedette_chandon , l.auteur_cliché, l.type_cliché, l.année_cliché, l.commune, l.village, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.commune_INSEE_number, l.ref_IM, l.ref_PA, l.ref_IA, l.artificial_number_Decrock, l.famille, l.individu, l.qualité, l.date, l.dénomination,
					l.titre, l.catégorie, l.matériau, l.ref_reproductions, l.biblio,a.région, a.patronyme
			FROM legende_photos l, armorial a
			WHERE a.région = "'.$Region.'" and a.patronyme=l.vedette_chandon
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

	function infos_Departement($Departement){
		$donnees = $this->db->query('
			SELECT l.id, l.libellé_image, l.vedette_chandon , l.auteur_cliché, l.type_cliché, l.année_cliché, l.commune, l.village, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.commune_INSEE_number, l.ref_IM, l.ref_PA, l.ref_IA, l.artificial_number_Decrock, l.famille, l.individu, l.qualité, l.date, l.dénomination,
					l.titre, l.catégorie, l.matériau, l.ref_reproductions, l.biblio,a.départment, a.patronyme
			FROM legende_photos l, armorial a
			WHERE a.départment = "'.$Departement.'" and a.patronyme=l.vedette_chandon
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
*/
	function recherche_photo($requete){ // la fonction fiche() est utilisée dans le controller fiche.php
	  $requete_complete = '
			SELECT DISTINCT l.famille, l.id, l.libellé_image, l.vedette_chandon , l.auteur_cliché, l.type_cliché, l.année_cliché, l.commune, l.village, l.edifice_conservation, l.emplacement_dans_édifice,	l.photo, l.commune_INSEE_number, l.ref_IM, l.ref_PA, l.ref_IA, l.artificial_number_Decrock, l.individu, l.qualité, l.date, l.dénomination, l.titre, l.catégorie, l.matériau, l.ref_reproductions, l.biblio, l.cimiers
			FROM legende_photos l, armorial a
			WHERE '.$requete;
	  //	  echo $requete_complete;
	  $donnees = $this->db->query($requete_complete);
	  return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
	}

	function infos_commune($commune){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT l.id, l.libellé_image, l.vedette_chandon , l.auteur_cliché, l.type_cliché, l.année_cliché, l.commune, l.village, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.commune_INSEE_number, l.ref_IM, l.ref_PA, l.ref_IA, l.artificial_number_Decrock, l.famille, l.individu, l.qualité, l.date, l.dénomination,
					l.titre, l.catégorie, l.matériau, l.ref_reproductions, l.biblio
			FROM legende_photos l
			WHERE '.$commune.'
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

	function infos_Village($Village){
		$donnees = $this->db->query('
			SELECT l.id, l.libellé_image, l.vedette_chandon , l.auteur_cliché, l.type_cliché, l.année_cliché, l.commune, l.village, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.commune_INSEE_number, l.ref_IM, l.ref_PA, l.ref_IA, l.artificial_number_Decrock, l.famille, l.individu, l.qualité, l.date, l.dénomination,
					l.titre, l.catégorie, l.matériau, l.ref_reproductions, l.biblio
			FROM legende_photos l
			WHERE '.$Village.'
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

	function infos_Date($Date){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT l.id, l.libellé_image, l.vedette_chandon , l.auteur_cliché, l.type_cliché, l.année_cliché, l.commune, l.village, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.commune_INSEE_number, l.ref_IM, l.ref_PA, l.ref_IA, l.artificial_number_Decrock, l.famille, l.individu, l.qualité, l.date, l.dénomination,
					l.titre, l.catégorie, l.matériau, l.ref_reproductions, l.biblio
			FROM legende_photos l
			WHERE '.$Date.'
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

	function infos_Denomination($Denomination){
		$donnees = $this->db->query('
			SELECT l.id, l.libellé_image, l.vedette_chandon , l.auteur_cliché, l.type_cliché, l.année_cliché, l.commune, l.village, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.commune_INSEE_number, l.ref_IM, l.ref_PA, l.ref_IA, l.artificial_number_Decrock, l.famille, l.individu, l.qualité, l.date, l.dénomination,
					l.titre, l.catégorie, l.matériau, l.ref_reproductions, l.biblio
			FROM legende_photos l
			WHERE '.$Denomination.'
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

	function infos_Categorie($Categorie){
		$donnees = $this->db->query('
			SELECT l.id, l.libellé_image, l.vedette_chandon , l.auteur_cliché, l.type_cliché, l.année_cliché, l.commune, l.village, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.commune_INSEE_number, l.ref_IM, l.ref_PA, l.ref_IA, l.artificial_number_Decrock, l.famille, l.individu, l.qualité, l.date, l.dénomination,
					l.titre, l.catégorie, l.matériau, l.ref_reproductions, l.biblio
			FROM legende_photos l
			WHERE '.$Categorie.'
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

	function infos_Conservation($Conservation){
		$donnees = $this->db->query('
			SELECT l.id, l.libellé_image, l.vedette_chandon , l.auteur_cliché, l.type_cliché, l.année_cliché, l.commune, l.village, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.commune_INSEE_number, l.ref_IM, l.ref_PA, l.ref_IA, l.artificial_number_Decrock, l.famille, l.individu, l.qualité, l.date, l.dénomination,
					l.titre, l.catégorie, l.matériau, l.ref_reproductions, l.biblio, l.edifice_conservation
			FROM legende_photos l
			WHERE '.$Conservation.'
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }

	function infos_Materiau($matériau){
		$donnees = $this->db->query('
			SELECT l.id, l.libellé_image, l.vedette_chandon , l.auteur_cliché, l.type_cliché, l.année_cliché, l.commune, l.village, l.edifice_conservation, l.emplacement_dans_édifice,
					l.photo, l.commune_INSEE_number, l.ref_IM, l.ref_PA, l.ref_IA, l.artificial_number_Decrock, l.famille, l.individu, l.qualité, l.date, l.dénomination,
					l.titre, l.catégorie, l.matériau, l.ref_reproductions, l.biblio
			FROM legende_photos l
			WHERE  '.$matériau.'
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
	function armorial($vedette_chandon){ // la fonction fiche() est utilisée dans le controller fiche.php
		$donnees = $this->db->query('
			SELECT a.départment,a.région
			FROM armorial a
			WHERE a.patronyme="'.$vedette_chandon.'"
		');
        return $donnees->result(); // la fonction retourne les données stockés dans la variable $donnees
    }
}
?>
