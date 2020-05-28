<?php

class Recherche_photo extends Controller {  // Le nom de la classe est le nom du controller avec une majuscule
	function index(){ 

// Chargement des models utilisÃ©s dans le controller (les models sont dans le dossiers /system/application/models )
		$this->load->model('Model_recherche');			
		$this->load->model('Model_legende_photos');		

		set_time_limit(0); //On supprime la limite d'exécution du script pour qu'il ne s'arrete pas en plein mileu
		/*
		|----------------------------------------------------------------------------------------------------
		| Bouton de DÃ©connexion qui met la variable $session = FALSE (cad non connectÃ©)			
		|----------------------------------------------------------------------------------------------------
		*/
			$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connectÃ©) ou $session=FALSE (admin est pas connectÃ©)
			if (isset($_POST['deconnexion']) && $_POST['deconnexion'] == 'Deconnexion') {
				$newdata = array(
					'logged_in' => FALSE,
					'statut' => NULL
				);
				$this->session->set_userdata($newdata); 
				$session = $this->session->userdata('logged_in');	// $session = FALSE
				
				header("Location: ".base_url()); 	//redirection sur l'accueil		
			}
		/*
		|----------------------------------------------------------------------------------------------------
		*/	
		
	$donnees = NULL ;
	$req=array();

/*
|----------------------------------------------------------------------------------------------------
| Recherche d' ICONOGRAPHIES (commune, edifice de conservation, village, patronyme, date, denomination, catégorie, materiaux, armes)
|----------------------------------------------------------------------------------------------------
*/
		if (isset($_POST['rechercher_photo'])){
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ COMMUNE (Formulaire SELECT)
		|----------------------------------------------------------------------------------------------------
		*/
			if($_POST['Commune'] != NULL ) {
				
            $mots = explode(' ',$_POST['Commune'])	; 
			$req[] = 'l.commune = "'.$_POST['Commune'].'"';
			//$req[] = 'l.commune REGEXP "('.implode('|',$mots).')"';
			//$donnees=$this->Model_legende_photos->infos_commune($requete_Commune);
		}
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ PATRONYME (ET)
		|----------------------------------------------------------------------------------------------------
		*/
		if($_POST['Patronyme'] != NULL ) {
            $mots = explode(' ',$_POST['Patronyme'])	; // recupération des mots clés

				$requete_patro = 'l.famille REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_patro = $requete_patro.'AND l.famille REGEXP "('.$mots[$i].')" ' ;
				}
			$req[] = $requete_patro;
		}
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ VILLAGE (ET)
		|----------------------------------------------------------------------------------------------------
		*/
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
		}
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ DATE (formulaire select)
		|----------------------------------------------------------------------------------------------------
		*/
		if ( $_POST['Date'] != NULL ) {
            $mots = explode(' ',$_POST['Date'])	; // recupération des mots clés
			// OU
			//$req[] = 'l.date REGEXP "('.implode('|',$mots).')"';
			$req[] = 'l.date = "'.$_POST['Date'].'"';
		}
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ DENOMINATION (formulaire select)
		|----------------------------------------------------------------------------------------------------
		*/
		if ($_POST['Denomination'] != NULL ) {
            $mots = explode(' ',$_POST['Denomination'])	; // recupération des mots clés
			// OU
			//$req[]= 'l.dénomination REGEXP "('.implode('|',$mots).')"';
			$req[] = 'l.dénomination = "'.$_POST['Denomination'].'"';
		}

		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ CATEGORIE (formulaire select)
		|----------------------------------------------------------------------------------------------------
		*/
		if ($_POST['Categorie'] != NULL ) {
            $mots = explode(' ',$_POST['Categorie'])	; // recupération des mots clés
			// OU
			//$req[] = 'l.catégorie REGEXP "('.implode('|',$mots).')"';
			$req[] = 'l.catégorie = "'.$_POST['Categorie'].'"';
		}
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ EDIFICE DE CONSERVATION (ET)
		|----------------------------------------------------------------------------------------------------
		*/
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
		}
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ MATERIAU (formulaire select)
		|----------------------------------------------------------------------------------------------------
		*/
		if ( $_POST['Materiau'] != NULL ) {
                    	$mots = explode(' ',$_POST['Materiau'])	; // recupération des mots clés
			// OU
			//$req[] = 'l.matériau REGEXP "('.implode('|',$mots).')"';
			$req[] = 'l.matériau = "'.$_POST['Materiau'].'"';
		}
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ ARMES (ET + mots dans le désordre)
		|----------------------------------------------------------------------------------------------------
		*/
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
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Validation formulaire croisée
		|----------------------------------------------------------------------------------------------------
		*/
		if($req==NULL){
			 header("Location: ".base_url().'/recherche_photo');
			}else{
			$requete=$req[0];
				for($i=1;$i<count($req);$i++){
					$requete=$requete.' AND '.$req[$i];
				}
				$donnees = $this->Model_legende_photos->recherche_photo($requete.'AND a.départment = "Marne" AND l.départment = "Marne"');	
			}	
		/*
		|----------------------------------------------------------------------------------------------------
		*/
	}
/*
|----------------------------------------------------------------------------------------------------
*/

// Données pour les menus déroulants dynamiques
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
