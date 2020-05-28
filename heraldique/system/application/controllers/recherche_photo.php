<?php
	
	class Recherche_photo extends Controller {  // Le nom de la classe est le nom du contrôleur avec une majuscule
		function index(){ 
			
			// Chargement des models utilisés dans le controller (les models sont dans le dossiers /system/application/models )
			$this->load->model('Model_recherche');			
			$this->load->model('Model_legende_photos');				
			/*
				|----------------------------------------------------------------------------------------------------
				| Bouton de déconnexion qui met la variable $session = FALSE (càd non connecté)			
				|----------------------------------------------------------------------------------------------------
			*/
			$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connecté) ou $session=FALSE (admin est pas connecté)
			if (isset($_GET['deconnexion']) && $_GET['deconnexion'] == 'Deconnexion') {
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
			
			$donnees = NULL ; // Le tableau de données est vide par défaut
			$req=array();
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Recherche d' ICONOGRAPHIES (commune, edifice de conservation, village, patronyme, date, denomination, catégorie, materiaux, armes)
				|----------------------------------------------------------------------------------------------------
			*/
			if (isset($_GET['rechercher_photo'])){
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ COMMUNE (Formulaire SELECT)
					|----------------------------------------------------------------------------------------------------
				*/
				if($_GET['Commune'] != NULL ) {
					$mots = explode(' ',$_GET['Commune'])	; // Récupération des mots-clé
					// OU
					$req[] = 'l.commune = "'.$_GET['Commune'].'"';
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
				if($_GET['Patronyme'] != NULL ) {
					$mots = explode(' ',$_GET['Patronyme'])	; // Récupération des mots-clé
					// ET
					$requete_patro = 'l.famille REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_patro = $requete_patro.'AND l.famille REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_patro;
					// $req[] = 'l.commune REGEXP "('.implode('|',$mots).')"';
					// $donnees=$this->Model_legende_photos->infos_commune($requete_Commune);
				}
				
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ CIMIERS / ORNEMENTS EXTÉRIEURS (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if($_GET['Cimiers'] != NULL ) {
					$mots = explode(' ',$_GET['Cimiers'])	; // Récupération des mots-clé
					// ET
					
					$requete_cimiers = 'a.cimiers REGEXP "('.$mots[0].')" ' ;
					
					$resultats_cimiers = $this->Model_recherche->dico_cimiers($mot);
					
					foreach ($resultats_cimiers as $row)
					{
						$expression = $row->expression;
						$signification = $row-> signification;
					}
					// On regarde si le mot est présent dans le dictionnaire
					if($mots[0]==$expression){
						$$requete_cimiers.= ' OR a.cimiers REGEXP "('.$signification.')" ';
					}
					else if($mots[0]==$signification){
						$$requete_cimiers.= ' OR a.cimiers REGEXP "('.$expression.')" ';
					}
					
					for($i=1; $i<count($mots) ; $i++){
						$requete_cimiers = $requete_cimiers.'AND a.cimiers REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_cimiers;
					// $req[] = 'l.commune REGEXP "('.implode('|',$mots).')"';
					// $donnees=$this->Model_legende_photos->infos_commune($requete_Commune);
				}
				
				
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ VILLAGE (ET) --> NON UTILISE
					|----------------------------------------------------------------------------------------------------
				*/
				/*if ( $_GET['Village'] != NULL ) {
					$mots = explode(' ',$_GET['Village'])	; // Récupération des mots-clé
					// OU
					//$req[] = 'l.village REGEXP "('.implode('|',$mots).')"';
					
					//ET 
					$requete_village = 'l.village REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
					$requete_village = $requete_village.'AND l.village REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_village;
					
					//$donnees=$this->Model_legende_photos->infos_Village($requete_Village);
				}*/
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ REGION (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if ( $_GET['region'] != NULL ) {
					$mots = explode(' ',$_GET['region'])	; // Récupération des mots-clé
					
					//ET 
					$requete_region = 'l.région REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_region = $requete_region.'AND l.région REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_region;
					
				}
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ DATE (formulaire select)
					|----------------------------------------------------------------------------------------------------
				*/
				// Recherche par id sur les photos
				if ( $_GET['Date'] != NULL ) {
					$mots = explode(' ',$_GET['Date'])	; // Récupération des mots-clé
					// OU
					// $req[] = 'l.date REGEXP "('.implode('|',$mots).')"';
					$req[] = 'l.date = "'.$_GET['Date'].'"';
					// $donnees=$this->Model_legende_photos->infos_Date($requete_Date);
				}
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ DENOMINATION (formulaire select)
					|----------------------------------------------------------------------------------------------------
				*/
				if ($_GET['Denomination'] != NULL ) {
					$mots = explode(' ',$_GET['Denomination'])	; // Récupération des mots-clé
					// OU
					// $req[]= 'l.dénomination REGEXP "('.implode('|',$mots).')"';
					$req[] = 'l.dénomination = "'.$_GET['Denomination'].'"';
					// $donnees=$this->Model_legende_photos->infos_Denomination($requete_Denomination);
				}
				
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ CATEGORIE (formulaire select) NON UTILISE
					|----------------------------------------------------------------------------------------------------
				*/
				/*	if ($_GET['Categorie'] != NULL ) {
					$mots = explode(' ',$_GET['Categorie'])	; // Récupération des mots-clé
					// OU
					// $req[] = 'l.catégorie REGEXP "('.implode('|',$mots).')"';
					$req[] = 'l.catégorie = "'.$_GET['Categorie'].'"';
					//$donnees=$this->Model_legende_photos->infos_Categorie($requete_Categorie);
				}*/
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ EDIFICE DE CONSERVATION (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if ( $_GET['Conservation'] != NULL ) {
					$mots = explode(' ',$_GET['Conservation'])	; // Récupération des mots-clé
					// OU
					//$req[]= 'l.edifice_conservation REGEXP "('.implode('|',$mots).')"';
					//ET
					$requete_edifice = 'l.edifice_conservation REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_edifice = $requete_edifice.'AND l.edifice_conservation REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_edifice;
					
					// $donnees=$this->Model_legende_photos->infos_Conservation($requete_Conservation);
				}
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ MATERIAU (formulaire select) NON UTILISE
					|----------------------------------------------------------------------------------------------------
				*/
				/*if ( $_GET['Materiau'] != NULL ) {
					$mots = explode(' ',$_GET['Materiau'])	; // Récupération des mots-clé
					OU
					$req[] = 'l.matériau REGEXP "('.implode('|',$mots).')"';
					$req[] = 'l.matériau = "'.$_GET['Materiau'].'"';
					$donnees=$this->Model_legende_photos->infos_Materiau($requete_Materiau);
				} */
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ ARMES (ET + mots dans le désordre)
					|----------------------------------------------------------------------------------------------------
				*/ 
				
				if ($_GET['mot'] != NULL ) {
					
					$mots = explode(' ',$_GET['mot'])	; // Récupération des mots-clé
					
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
					| Champ DEVISE/LEGENDE
					|----------------------------------------------------------------------------------------------------
				*/
				if($_GET['devise_legende'] != NULL ) {
					$mots = explode(' ',$_GET['devise_legende'])	; // Récupération des mots-clé
					// ET
					$requete_devise = 'a.devise REGEXP "('.$mots[0].')" ' ;
					for($i=1; $i<count($mots) ; $i++){
						$requete_cimiers = $requete_devise.'AND a.devise REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_devise;
				}
                /*
					|----------------------------------------------------------------------------------------------------
				*/
				
                /*
					|----------------------------------------------------------------------------------------------------
					| Champ SCEAU
					|----------------------------------------------------------------------------------------------------
				*/
				if(isset($_GET['sceau'])) {
					
					$requete_sceau = "((a.blasonnement_1 LIKE '% sceau%' OR a.blasonnement_2 LIKE '% sceau%' OR a.cimiers LIKE '% sceau%') AND l.vedette_chandon = a.patronyme)" ;
					
					$req[] = $requete_sceau;
				}
                /*
					|----------------------------------------------------------------------------------------------------
				*/
				
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ AUTEURS (ET)
					|----------------------------------------------------------------------------------------------------
				*/ 	
				if ( $_GET['auteur'] != NULL ) {
					$mots = explode(' ',$_GET['auteur'])	; // Récupération des mots-clé
					//ET 
					$requete_auteur = 'l.auteurs REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_auteur = $requete_auteur.'AND l.auteurs REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_auteur;
				}	
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ TITRE (ET)
					|----------------------------------------------------------------------------------------------------
				*/ 
				if ( $_GET['titre'] != NULL ) {
					$mots = explode(' ',$_GET['titre'])	; // Récupération des mots-clé
					//ET 
					$requete_titre = 'l.titre REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_titre = $requete_titre.'AND l.titre REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_titre;
				}	
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ LIEU EDITION (ET)
					|----------------------------------------------------------------------------------------------------
				*/	
				if ( $_GET['lieu_edition'] != NULL ) {
					$mots = explode(' ',$_GET['lieu_edition'])	; // Récupération des mots-clé
					//ET 
					$requete_lieu_edition = 'l.lieu_édition REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_lieu_edition = $requete_lieu_edition.'AND l.lieu_édition REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_lieu_edition;
				}	
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ ANNEE EDITION (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if ( $_GET['annee_edition'] != NULL ) {
					$mots = explode(' ',$_GET['annee_edition'])	; // Récupération des mots-clé
					//ET 
					$requete_annee_edition = 'l.année_édition REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_annee_edition = $requete_annee_edition.'AND l.année_édition REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_annee_edition;
				}	
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ EDITEUR (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if ( $_GET['editeur'] != NULL ) {
					$mots = explode(' ',$_GET['editeur'])	; // Récupération des mots-clé
					//ET 
					$requete_editeur = 'l.editeur REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_editeur = $requete_editeur.'AND l.editeur REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_editeur;
				}	
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ RELIURE (ET)
					|----------------------------------------------------------------------------------------------------
				*/	
				if ( $_GET['reliure'] != NULL ) {
					$mots = explode(' ',$_GET['reliure'])	; // Récupération des mots-clé
					//ET 
					$requete_reliure = 'l.reliure REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_reliure = $requete_reliure.'AND l.reliure REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_reliure;
				}	
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ PROVENANCE (ET)
					|----------------------------------------------------------------------------------------------------
				*/	
				if ( $_GET['provenance'] != NULL ) {
					$mots = explode(' ',$_GET['provenance'])	; // Récupération des mots-clé
					//ET 
					$requete_provenance = 'l.provenance REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_provenance = $requete_provenance.'AND l.provenance REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_provenance;
				}	
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ SITE (ET)
					|----------------------------------------------------------------------------------------------------
				*/	
				if ( $_GET['site'] != NULL ) {
					$mots = explode(' ',$_GET['site'])	; // Récupération des mots-clé
					//ET 
					$requete_site = 'l.site REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_site = $requete_site.'AND l.site REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_site;
				}	
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ SECTION (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if ( $_GET['section'] != NULL ) {
					$mots = explode(' ',$_GET['section'])	; // Récupération des mots-clé
					//ET 
					$requete_section = 'l.section REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_section = $requete_section.'AND l.section REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_section;
				}	
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ COTE (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if ( $_GET['cote'] != NULL ) {
					$mots = explode(' ',$_GET['cote'])	; // Récupération des mots-clé
					//ET 
					$requete_cote = 'l.cote REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_cote = $requete_cote.'AND l.cote REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_cote;
				}	
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ FOLIO (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if ( $_GET['folio'] != NULL ) {
					$mots = explode(' ',$_GET['folio'])	; // Récupération des mots-clé
					//ET 
					$requete_folio = 'l.folio_emplacement REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_folio = $requete_folio.'AND l.folio_emplacement REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_folio;
				}			
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ PAYS (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if ( $_GET['pays'] != NULL ) {
					$mots = explode(' ',$_GET['pays'])	; // Récupération des mots-clé
					//ET 
					$requete_pays = 'l.pays REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_pays = $requete_pays.'AND l.pays REGEXP "('.$mots[$i].')" ' ;
					}
					$req[] = $requete_pays;
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
					$livre = 'AND (l.dénomination = "bréviaire du diocèse de Troyes" 
					OR l.dénomination = "cachet" 
					OR l.dénomination = "contre-sceau" 
					OR l.dénomination = "dessin sur estampe" 
					OR l.dénomination = "dessin" 
					OR l.dénomination = "empreinte de sceau" 
					OR l.dénomination = "enluminure" 
					OR l.dénomination = "estampe" 
					OR l.dénomination = "ex-libris" 
					OR l.dénomination = "filigrane" 
					OR l.dénomination = "livre" 
					OR l.dénomination = "manuscrit" 
					OR l.dénomination = "miniature" 
					OR l.dénomination = "reliure" 
					OR l.dénomination = "timbre à sec"
					OR l.dénomination = "Lithographie"
					OR l.dénomination = "gravure"
					OR l.dénomination = "dessin à la plume"
					OR l.dénomination = "estampage"
					OR l.dénomination = "relevé"
					) ';
					$donnees = $this->Model_legende_photos->recherche_photo($requete);	
				}	
				/*
					|----------------------------------------------------------------------------------------------------
				*/
			}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			$dates = $this->Model_recherche->date_liste();
			$materiaux = $this->Model_recherche->materiau_liste();
			$categories =$this->Model_recherche->categorie_liste();
			$denominations = $this->Model_recherche->denomination_liste();
			$communes = $this->Model_recherche->commune_liste();
			$pays = $this->Model_recherche->pays_liste();
			
			// Tableau $data des variables à envoyer aux vues			
			$data = array(
			'connecte' => $session, // La variable $connecte est utilisée dans la vue footer.php 
			'donnees'=> $donnees, 
			'dates'=> $dates,
			'materiaux' => $materiaux,
			'categories' => $categories,
			'denominations'=> $denominations,
			'communes'=> $communes,
			'pays' => $pays
			);
			
			// Chargement des vues à afficher (attention à l'ordre) (les vues sont dans le dossier /system/application/views)	
			$this->load->view('layout/header',$data);				
			$this->load->view('recherche_photo',$data);	
			$this->load->view('layout/footer',$data);	
		}
	}
	
	/* End of file welcome.php */
	/* Location: ./system/application/controllers/welcome.php */
?>
