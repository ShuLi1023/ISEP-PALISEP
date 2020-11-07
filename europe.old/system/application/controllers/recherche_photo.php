<?php
	
	class Recherche_photo extends Controller {  // Le nom de la classe est le nom du contrôleur avec une majuscule
		function index(){ 
			
			// Chargement des modèles utilisés dans le controller (les modèles sont dans le dossier /system/application/models )
			$this->load->model('Model_recherche');			
			$this->load->model('Model_legende_photos');	
			$this->load->model('Model_administration');
			$presentation_europe=$this->Model_administration->get_presentation_text();
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Bouton de déconnexion qui met la variable $session = FALSE (cad non connecté)			
				|----------------------------------------------------------------------------------------------------
			*/
			$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connecté) ou $session=FALSE (admin est pas connecté)
			if (isset($_POST['deconnexion']) && $_POST['deconnexion'] == 'Deconnexion') {
				$newdata = array(
				'logged_in'	=> FALSE,
				'statut'	=> NULL
				);
				$this->session->set_userdata($newdata); 
				$session = $this->session->userdata('logged_in');	// $session = FALSE
				
				header("Location: ".base_url()); 	// Redirection sur l'identification		
			}
			/*
				|----------------------------------------------------------------------------------------------------
			*/	
			
			$donnees = NULL ;
			$req=array();
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Recherche d'ICONOGRAPHIES (commune, édifice de conservation, village, patronyme, date, dénomination, catégorie, matériaux, armes)
				|----------------------------------------------------------------------------------------------------
			*/
			if (isset($_POST['rechercher_photo_ordre']) || isset($_POST['rechercher_photo_desordre'])){
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ PAYS (formulaire SELECT)
					|----------------------------------------------------------------------------------------------------
				*/
				if($_POST['pays'] != NULL ) {
					
					$mots = explode(' ',$_POST['pays'])	; 
					$req[] = 'l.pays = "'.$_POST['pays'].'"';
					// $req[] = 'l.commune REGEXP "('.implode('|',$mots).')"';
					// $donnees=$this->Model_legende_photos->infos_commune($requete_Commune);
				}
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ REGION (formulaire SELECT)
					|----------------------------------------------------------------------------------------------------
				*/
				if($_POST['region'] != NULL ) {
					
					$mots = explode(' ',$_POST['region'])	; 
					$req[] = 'l.région = "'.$_POST['region'].'"';
					// $req[] = 'l.commune REGEXP "('.implode('|',$mots).')"';
					// $donnees=$this->Model_legende_photos->infos_commune($requete_Commune);
				}
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ COMMUNE (formulaire SELECT)
					|----------------------------------------------------------------------------------------------------
				*/
				if($_POST['Commune'] != NULL ) {
					
					$mots = explode(' ',$_POST['Commune'])	; 
					$req[] = 'l.commune = "'.$_POST['Commune'].'"';
					// $req[] = 'l.commune REGEXP "('.implode('|',$mots).')"';
					// $donnees=$this->Model_legende_photos->infos_commune($requete_Commune);
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
					$mots = explode(' ',$_POST['Patronyme'])	; // Récupération des mots clés
					
					$requete_patro = 'l.vedette_chandon REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_patro = $requete_patro.'AND l.vedette_chandon REGEXP "('.$mots[$i].')" ' ;
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
					$mots = explode(' ',$_POST['Village'])	; // Récupération des mots clés
					// OU
					// $req[] = 'l.village REGEXP "('.implode('|',$mots).')"';
					// ET 
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
					$mots = explode(' ',$_POST['Date'])	; // Récupération des mots clés
					// OU
					// $req[] = 'l.date REGEXP "('.implode('|',$mots).')"';
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
					$mots = explode(' ',$_POST['Denomination'])	; // Récupération des mots clés
					// OU
					// $req[]= 'l.dénomination REGEXP "('.implode('|',$mots).')"';
					$req[] = 'l.dénomination = "'.$_POST['Denomination'].'"';
				}
				
				// $requete_sceau = "";
				// if($_POST['sceau'] != NULL ) {	
				// $requete_sceau = 'l.dénomination LIKE "sceau" OR l.catégorie LIKE "sceau"';
				//}
				// $req[] = $requete_sceau;
				
				
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ CATEGORIE (formulaire SELECT)
					|----------------------------------------------------------------------------------------------------
				*/
				if ($_POST['Categorie'] != NULL ) {
					$mots = explode(' ',$_POST['Categorie'])	; // R&cupération des mots-clé
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
					$mots = explode(' ',$_POST['Conservation'])	; // Récupération des mots clés
					// OU
					// $req[]= 'l.edifice_conservation REGEXP "('.implode('|',$mots).')"';
					// ET
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
					| Champ MATERIAU (formulaire SELECT)
					|----------------------------------------------------------------------------------------------------
				*/
				if ( $_POST['Materiau'] != NULL ) {
					$mots = explode(' ',$_POST['Materiau'])	; // Récupération des mots clés
					// OU
					// $req[] = 'l.matériau REGEXP "('.implode('|',$mots).')"';
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
				if (isset($_POST['rechercher_photo_desordre']) && $_POST['mot'] != NULL ) {
					
					$mots = explode(' ',$_POST['mot'])	; // Récupération des mots-clé
					
					$requete_a = 'a.blasonnement_1 REGEXP "('.$mots[0].')" ' ; 
					$requete_b = 'a.blasonnement_2 REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_a = $requete_a.'AND a.blasonnement_1 REGEXP "('.$mots[$i].')" ' ;
						$requete_b = $requete_b.'AND a.blasonnement_2 REGEXP "('.$mots[$i].')" ' ;
					}
					
					$req[]='(('.$requete_a.' OR '.$requete_b.') AND l.vedette_chandon = a.patronyme)';
				}
				if (isset($_POST['rechercher_photo_ordre']) && $_POST['mot'] != NULL ) {
					
					$mots = explode(' ',$_POST['mot'])	; // Récupération des mots-clé
					
					$requete_a = 'a.blasonnement_1 LIKE "%'.implode('%%',$mots).'%"'; 
					$requete_b = 'a.blasonnement_2 LIKE "%'.implode('%%',$mots).'%"'; 
					
					$req[]='(('.$requete_a.' OR '.$requete_b.') AND l.vedette_chandon = a.patronyme)';
				}
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Validation du formulaire croisé
					|----------------------------------------------------------------------------------------------------
				*/
				if($req==NULL){
					header("Location: ".base_url().'/recherche_photo');
					}else{
					$requete=$req[0];
					for($i=1;$i<count($req);$i++){
						$requete=$requete.' AND '.$req[$i];
					}
					$donnees = $this->Model_legende_photos->recherche_photo($requete);	
				}	
				/*
					|----------------------------------------------------------------------------------------------------
				*/
			}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			
			// Données pour les menus déroulant dynamiques
			$dates = $this->Model_recherche->date_liste();
			$materiaux = $this->Model_recherche->materiau_liste();
			$categories =$this->Model_recherche->categorie_liste();
			$denominations = $this->Model_recherche->denomination_liste();
			$communes = $this->Model_recherche->commune_liste();
			$pays = $this->Model_recherche->pays_liste();
			$regions = $this->Model_recherche->region_liste();
			
			// Tableau $data des variables à envoyer aux vues			
			$data = array(
			'connecte' => $session, // La variable $connecte est utilisée dans la vue footer.php 
			'donnees'=> $donnees, 
            'presentation_europe'=>$presentation_europe,
			'dates'=> $dates,
			'materiaux' => $materiaux,
			'categories' => $categories,
			'denominations'=> $denominations,
			'communes'=> $communes,
			'pays'=> $pays,
			'regions'=> $regions
			);
			
			// Chargement des views à afficher (attention à l'ordre) (les vues sont dans le dossier /system/application/views)	
			$this->load->view('layout/header',$data);				
			$this->load->view('recherche_photo',$data);	
			$this->load->view('layout/footer',$data);	
		}
	}
	
	/* End of file welcome.php */
	/* Location: ./system/application/controllers/welcome.php */
?>
