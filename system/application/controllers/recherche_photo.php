<?php

class Recherche_photo extends Controller {  // Le nom de la classe est le nom du controller avec une majuscule
	function index(){ 

// Chargement des models utilisÃ©s dans le controller (les models sont dans le dossiers /system/application/models )
		$this->load->model('Model_recherche');			
		$this->load->model('Model_legende_photos');				
		/*
		|----------------------------------------------------------------------------------------------------
		| Bouton de DÃ©connexion qui met la variable $session = FALSE (cad non connectÃ©)			
		|----------------------------------------------------------------------------------------------------
		*/
			$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connectÃ©) ou $session=FALSE (admin est pas connectÃ©)
			if (isset($_POST['deconnexion']) && $_POST['deconnexion'] == 'Deconnexion') {
				$newdata = array(
					'logged_in' => FALSE
				);
				$this->session->set_userdata($newdata); 
				$session = $this->session->userdata('logged_in');	// $session = FALSE
				
				header("Location: ".base_url()); 	//redirection sur l'accueil		
			}
		/*
		|----------------------------------------------------------------------------------------------------
		*/	
		
	$donnees = NULL ; // le tableau de donnÃ©es est vide par dÃ©faut
	$req=array();
		
// Recherche par id sur les photos	
/*		if (isset($_POST['rechercher_Pays']) && $_POST['Pays'] != NULL ) {
                    	$mots = explode(' ',$_POST['Pays'])	; // recupération des mots clés
			// OU
			$requete_Pays = 'a.région REGEXP "('.implode('|',$mots).')"';
			$donnees=$this->Model_legende_photos->infos_pays($requete_Pays);
		}

// Recherche par id sur les photos
		if (isset($_POST['rechercher_Region']) && $_POST['Region'] != NULL ) {
                    	$mots = explode(' ',$_POST['region'])	; // recupération des mots clés
			// OU
			$requete_region = 'a.région REGEXP "('.implode('|',$mots).')"';
			$donnees=$this->Model_legende_photos->infos_region($requete_region);
		}

// Recherche par id sur les photos
		if (isset($_POST['rechercher_Departement']) && $_POST['Departement'] != NULL ) {
                    	$mots = explode(' ',$_POST['Departement'])	; // recupération des mots clés
			// OU
			$requete_Departement = 'a.région REGEXP "('.implode('|',$mots).')"';
			$donnees=$this->Model_legende_photos->infos_Departement($requete_Departement);
		}*/

// Recherche par id sur les photos
		if (isset($_POST['rechercher_photo'])){
			
			if($_POST['Commune'] != NULL ) {
            $mots = explode(' ',$_POST['Commune'])	; // recupération des mots clés
			// OU
			$req[] = 'l.commune = "'.$_POST['Commune'].'"';
			//$req[] = 'l.commune REGEXP "('.implode('|',$mots).')"';
			//$donnees=$this->Model_legende_photos->infos_commune($requete_Commune);
		}

		if($_POST['Patronyme'] != NULL ) {
            $mots = explode(' ',$_POST['Patronyme'])	; // recupération des mots clés
			// ET
				$requete_patro = 'l.famille REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_patro = $requete_patro.'AND l.famille REGEXP "('.$mots[$i].')" ' ;
				}
			$req[] = $requete_patro;
			//$req[] = 'l.commune REGEXP "('.implode('|',$mots).')"';
			//$donnees=$this->Model_legende_photos->infos_commune($requete_Commune);
		}
// Recherche par id sur les photos
		if ( $_POST['Village'] != NULL ) {
                    	$mots = explode(' ',$_POST['Village'])	; // recupération des mots clés
			// OU
			//$req[] = 'l.village REGEXP "('.implode('|',$mots).')"';
			
			//ET 
			$requete_village = 'l.village REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_village = $requete_village.'AND l.village REGEXP "('.$mots[$i].')" ' ;
				}
			$req[] = $requete_village;
			
			//$donnees=$this->Model_legende_photos->infos_Village($requete_Village);
		}
// Recherche par id sur les photos
		if ( $_POST['Date'] != NULL ) {
                    	$mots = explode(' ',$_POST['Date'])	; // recupération des mots clés
			// OU
			//$req[] = 'l.date REGEXP "('.implode('|',$mots).')"';
			$req[] = 'l.date = "'.$_POST['Date'].'"';
			//$donnees=$this->Model_legende_photos->infos_Date($requete_Date);
		}
// Recherche par id sur les photos
		if ($_POST['Denomination'] != NULL ) {
                    	$mots = explode(' ',$_POST['Denomination'])	; // recupération des mots clés
			// OU
			//$req[]= 'l.dénomination REGEXP "('.implode('|',$mots).')"';
			$req[] = 'l.dénomination = "'.$_POST['Denomination'].'"';
			//$donnees=$this->Model_legende_photos->infos_Denomination($requete_Denomination);
		}

// Recherche par id sur les photos
		if ($_POST['Categorie'] != NULL ) {
                    	$mots = explode(' ',$_POST['Categorie'])	; // recupération des mots clés
			// OU
			//$req[] = 'l.catégorie REGEXP "('.implode('|',$mots).')"';
			$req[] = 'l.catégorie = "'.$_POST['Categorie'].'"';
			//$donnees=$this->Model_legende_photos->infos_Categorie($requete_Categorie);
		}
// Recherche par id sur les photos
		if ( $_POST['Conservation'] != NULL ) {
             $mots = explode(' ',$_POST['Conservation'])	; // recupération des mots clés
			// OU
			//$req[]= 'l.edifice_conservation REGEXP "('.implode('|',$mots).')"';
			//ET
			$requete_edifice = 'l.edifice_conservation REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_edifice = $requete_edifice.'AND l.edifice_conservation REGEXP "('.$mots[$i].')" ' ;
				}
			$req[] = $requete_edifice;
			
			//$donnees=$this->Model_legende_photos->infos_Conservation($requete_Conservation);
		}
// Recherche par id sur les photos
		if ( $_POST['Materiau'] != NULL ) {
                    	$mots = explode(' ',$_POST['Materiau'])	; // recupération des mots clés
			// OU
			//$req[] = 'l.matériau REGEXP "('.implode('|',$mots).')"';
			$req[] = 'l.matériau = "'.$_POST['Materiau'].'"';
			//$donnees=$this->Model_legende_photos->infos_Materiau($requete_Materiau);
		}
// Blasonnements 1, 2 et 3 

			if ($_POST['mot'] != NULL ) {
				
				$mots = explode(' ',$_POST['mot'])	; // recupération des mots clés

				$requete_a = 'a.blasonnement_1 REGEXP "('.$mots[0].')" ' ; 
				$requete_b = 'a.blasonnement_2 REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_a = $requete_a.'AND a.blasonnement_1 REGEXP "('.$mots[$i].')" ' ;
					$requete_b = $requete_b.'AND a.blasonnement_2 REGEXP "('.$mots[$i].')" ' ;
				}

				$req[]='(('.$requete_a.' OR '.$requete_b.') AND l.vedette_chandon = a.patronyme)';
			}
		if($req==NULL){
			 header("Location: ".base_url().'/recherche_photo');
			}else{
			$requete=$req[0];
				for($i=1;$i<count($req);$i++){
					$requete=$requete.' AND '.$req[$i];
				}
				$donnees = $this->Model_legende_photos->recherche_photo($requete);	
			}	
	}

	$dates = $this->Model_recherche->date_liste();
	$materiaux = $this->Model_recherche->materiau_liste();
	$categories =$this->Model_recherche->categorie_liste();
	$denominations = $this->Model_recherche->denomination_liste();
        $communes = $this->Model_recherche->commune_liste();

// Tableau $data des variables Ã  envoyer aux vues			
		$data = array(
			'connecte' => $session, // La variable $connecte est utilisÃ© dans la vue footer.php 
			'donnees'=> $donnees, 
			'dates'=> $dates,
			'materiaux' => $materiaux,
			'categories' => $categories,
			'denominations'=> $denominations,
                        'communes'=> $communes,
		);
				
// Chargement des views Ã  afficher (attention Ã  l'ordre) (les views sont dans le dossiers /system/application/views )	
		$this->load->view('layout/header',$data);				
		$this->load->view('recherche_photo',$data);	
		$this->load->view('layout/footer',$data);	
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
?>
