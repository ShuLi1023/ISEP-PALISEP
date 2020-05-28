<?php
	class recherche_publique extends Controller {  // Le nom de la classe est le nom du contrôleur avec une majuscule
		function index(){ 
			
			set_time_limit(0);// On enlève la limite d'exécution du script
			// Chargement des modèles utilisés dans le contrôleur (les modèles sont dans le dossier /system/application/models)
			$this->load->model('Model_recherche');			
			$this->load->model('Model_fiche');		
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Bouton de déconnexion qui met la variable $session = FALSE (càd non connecté)			
				|----------------------------------------------------------------------------------------------------
			*/
			/*	$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connecté) ou $session=FALSE (admin est pas connecté)
				if (isset($_GET['deconnexion']) && $_GET['deconnexion'] == 'Deconnexion') {
				$newdata = array(
				'logged_in'	=> FALSE,
				'statut'	=> NULL
				);
				$this->session->set_userdata($newdata); 
				$session = $this->session->userdata('logged_in');	// $session = FALSE
				
				header("Location: ".base_url()); 	// Redirection sur l'identification		
			}*/
			/*
				|----------------------------------------------------------------------------------------------------
			*/	
			
			$donnees = NULL ;		
			$donnees1 = NULL ;
			$donnees2 = NULL ;
			$donnees3 = NULL ; // Le tableau de données est vide par défaut
			$photos = NULL;	
			$requete = NULL ;
			$requete1 = NULL ;
			$requete2 = NULL ;
			$requete_a = NULL ;
			$requete_b = NULL ;
			$requete_c = NULL ;
			$req1 = array();
			$req2= array();
			/*
				|----------------------------------------------------------------------------------------------------
				| Recherche par ID 
				|----------------------------------------------------------------------------------------------------
			*/
			if (isset($_GET['recherche_id']) && $_GET['search'] != NULL ) {
				$donnees=$this->Model_fiche->fiche($_GET['search']);
				}elseif(isset($_GET['rechercher_id']) && $_GET['search'] == NULL){
				header("Location: ".base_url().'/recherche');
			}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			/*
				|----------------------------------------------------------------------------------------------------
				| Recherche par PATRONYME   (ET + ordre des mots non respectés)
				|----------------------------------------------------------------------------------------------------
			*/	
			if (isset($_GET['rechercher_patronyme']) && $_GET['patronyme'] != NULL ) {
				$mots = explode(' ',$_GET['patronyme'])	; // Récupération des mots-clé
				
				$requete_patro = 'a.patronyme REGEXP "('.$mots[0].')" ' ; 
				
				for($i=1; $i<count($mots) ; $i++){
					$requete_patro = $requete_patro.'AND a.patronyme REGEXP "('.$mots[$i].')" ' ;
					
				}
				$livre = null;
				
				$donnees = $this->Model_recherche->recherche_simple($requete_patro);
				
			}elseif(isset($_GET['rechercher_patronyme']) && $_GET['patronyme'] == NULL){ header("Location: ".base_url().'/recherche');}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			/*
				|----------------------------------------------------------------------------------------------------
				| Recherche par REGION (OU + ordre des mots non respectés)  -> non utilisé 
				|----------------------------------------------------------------------------------------------------
			*/
			if (isset($_GET['rechercher_region']) && $_GET['region'] != NULL ) {
				$mots = explode(' ',$_GET['region'])	; // Récupération des mots-clé
				// OU 	
				$requete_region = 'a.région_bis REGEXP "('.implode('|',$mots).')"';
				$donnees = $this->Model_recherche->recherche_simple($requete_region);
			}elseif(isset($_GET['rechercher_region']) && $_GET['region'] == NULL){ header("Location: ".base_url().'/recherche');}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			/*
				|----------------------------------------------------------------------------------------------------
				| Recherche par FIEF (ET + ordre des mots non respectés)
				|----------------------------------------------------------------------------------------------------
			*/
			if (isset($_GET['rechercher_fief']) && $_GET['fief'] != NULL ) {
				$mots = explode(' ',$_GET['fief'])	; // Récupération des mots-clé
				// OU 	
				// $requete_fief = 'a.fief REGEXP "('.implode('|',$mots).')" '; 
				$requete_fief = 'a.fief REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_fief = $requete_fief.'AND a.fief REGEXP "('.$mots[$i].')" ' ;
				}
				$donnees = $this->Model_recherche->recherche_simple($requete_fief);
			}elseif(isset($_GET['rechercher_fief']) && $_GET['fief'] == NULL){ header("Location: ".base_url().'/recherche');}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			/*
				|----------------------------------------------------------------------------------------------------
				| Recherche par DEPARTEMENT (OU + ordre des mots non respectés) -> non utilisé 
				|----------------------------------------------------------------------------------------------------
			*/
			if (isset($_GET['rechercher_departement']) && $_GET['departement'] != NULL ) {
				$mots = explode(' ',$_GET['departement'])	; // Récupération des mots-clé
				// OU 	
				$requete_departement = 'a.départment REGEXP "('.implode('|',$mots).')" '; 
				$donnees = $this->Model_recherche->recherche_simple($requete_departement);
			}elseif(isset($_GET['rechercher_departement']) && $_GET['departement'] == NULL){ header("Location: ".base_url().'/recherche');}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			/*
				|----------------------------------------------------------------------------------------------------
				| Recherche par SIECLE (1 ou plusieurs siècles choisis <=> Formulaire case à cocher) -> non utilisé 
				|----------------------------------------------------------------------------------------------------
			*/
			if (isset($_GET['rechercher_siecle']) && $_GET['siecle'] != NULL ) {
				$siecle = $_GET['siecle'];;
				/*
					$mots = explode(' ',$_GET['siecle'])	; // Récupération des mots-clé
					OU 	
					$requete_siecle = 'a.siècle REGEXP "('.implode('|',$mots).')" '; 
					$donnees = $this->Model_recherche->recherche_simple($requete_siecle);
					
				$requete_siecle = 'a.siècle ="'.$_GET['siecle'].'"';*/
				$requete_siecle = 'a.siècle = "'.$siecle[0].'"';
				for($i=1; $i<count($siecle); $i++){
					
					$requete_siecle=$requete_siecle.'OR a.siècle = "'.$siecle[$i].'"';
				} 
				$donnees = $this->Model_recherche->recherche_simple($requete_siecle);
			}elseif(isset($_GET['rechercher_siecle']) && $_GET['siecle'] == NULL){ header("Location: ".base_url().'/recherche');}
			
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			/*
				|----------------------------------------------------------------------------------------------------
				| Recherche par SIECLE (les siècles antérieurs au siècle choisi sont récupérerés) -> non utilisé 
				|----------------------------------------------------------------------------------------------------
			*/
			if (isset($_GET['rechercher_siecle2']) && $_GET['siecle2'] != NULL ) {
				
				if($_GET['siecle2'] == 'XIIe s.'){
					$requete_siecle = 'a.siècle ="'.$_GET['siecle2'].'"';
				}
				if($_GET['siecle2'] == 'XIIIe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle ="'.$_GET['siecle2'].'"';
				}
				if($_GET['siecle2'] == 'XIVe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle ="'.$_GET['siecle2'].'"';
				}
				if($_GET['siecle2'] == 'XVe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle ="'.$_GET['siecle2'].'"';
				}
				if($_GET['siecle2'] == 'XVIe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle ="'.$_GET['siecle2'].'"';
				}
				if($_GET['siecle2'] == 'XVIIe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle = "XVIe s." OR a.siècle ="'.$_GET['siecle2'].'"';
				}
				if($_GET['siecle2'] == 'XVIIIe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle = "XVIe s." OR a.siècle = "XVIIe s." OR a.siècle ="'.$_GET['siecle2'].'"';
				}
				if($_GET['siecle2'] == 'XIXe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle = "XVIe s." OR a.siècle = "XVIIe s." OR a.siècle = "XVIIIe s." OR a.siècle ="'.$_GET['siecle2'].'"';
				}
				if($_GET['siecle2'] == 'XXe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle = "XVIe s." OR a.siècle = "XVIIe s." OR a.siècle = "XVIIIe s." OR a.siècle = "XIXe s." OR a.siècle ="'.$_GET['siecle2'].'"';
				}
				if($_GET['siecle2'] == 'XXIe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle = "XVIe s." OR a.siècle = "XVIIe s." OR a.siècle = "XVIIIe s." OR a.siècle = "XIXe s." OR a.siècle = "XXe s." OR a.siècle ="'.$_GET['siecle2'].'"';
				}
				
				$donnees = $this->Model_recherche->recherche_simple($requete_siecle);
			}elseif(isset($_GET['rechercher_siecle2']) && $_GET['siecle2'] == NULL){ header("Location: ".base_url().'/recherche');}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			/*
				|----------------------------------------------------------------------------------------------------
				| Recherche par ARMES (formulaire croisé avec les champs : armes, fief, patronyme, siecle, département, région dénomination)
				|----------------------------------------------------------------------------------------------------
			*/
			if(isset($_GET['rechercher_ordre']) || isset($_GET['rechercher_desordre'])){
				
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ ARMES (ET) (recherche avec mots ordonnés non opérationnelle, à modifier...)
					|----------------------------------------------------------------------------------------------------
				*/
				if (isset($_GET['rechercher_desordre']) && $_GET['mot'] != NULL ) {// ET mots dans le désordre
					
					$expression = "";
					$signification = "";
					$autre1 = "";
					$autres2 = "";
					
					$mots = explode(' ',$_GET['mot'])	; // Récupération des mots-clé
					
					// Construction de $requete
					$requete_a = '((a.blasonnement_1 REGEXP "('.$mots[0].')" ';
					$requete_b = '((a.blasonnement_2 REGEXP "('.$mots[0].')" ';
					
					$resultats_arme = $this->Model_recherche->dico(addslashes($mots[0]),'equivalences');
					foreach ($resultats_arme as $row)
					{
						$expression = $row->expression;
						$signification = $row->signification;
						
						// On regarde si le mot est présent dans le dictionnaire
						if($mots[0]==$expression){
							$requete_a.= ' OR a.blasonnement_1 REGEXP "( '.$signification.' )" ';
							$requete_b.= ' OR a.blasonnement_2 REGEXP "( '.$signification.' )" ';
						}
						else if($mots[0]==$signification){
							$requete_a.= ' OR a.blasonnement_1 REGEXP "( '.$expression.' )" ';
							$requete_b.= ' OR a.blasonnement_2 REGEXP "( '.$expression.' )" ';
						}
					}
					
					$requete_a=$requete_a.")";
					$requete_b=$requete_b.")";
					
					for($i=1; $i<count($mots) ; $i++){
						
						$requete_a = $requete_a.' AND (a.blasonnement_1 REGEXP "('.$mots[$i].')" ';
						$requete_b = $requete_b.' AND (a.blasonnement_2 REGEXP "('.$mots[$i].')" ' ;
						
						$resultats_arme_bis = $this->Model_recherche->dico(addslashes($mots[$i]),'equivalences');
						foreach ($resultats_arme_bis as $row)
						{
							$expression_bis = $row->expression;
							$signification_bis = $row->signification;
							
							// On regarde si le mot est présent dans les équivalences
							if($mots[$i]==$expression_bis){
								
								$requete_a.= ' OR a.blasonnement_1 REGEXP "('.$signification_bis.')" ';
								$requete_b.= ' OR a.blasonnement_2 REGEXP "('.$signification_bis.')" ';
							}
							else if($mots[$i]==$signification_bis){
								
								$requete_a.= ' OR a.blasonnement_1 REGEXP "('.$expression_bis.')" ';
								$requete_b.= ' OR a.blasonnement_2 REGEXP "('.$expression_bis.')" ';
							}
						}
						
						$requete_a=$requete_a.")";
						$requete_b=$requete_b.")";
						
					}
					// $requete1 = '('.$requete_a.' OR '.$requete_b.' OR '.$requete_c.')';
					$req1[]=$requete_a.")";
					$req2[]=$requete_b.")";
				}
				// Ci-dessous la recherche avec mots ordonnés (à modifier...)
				if (isset($_GET['rechercher_ordre']) && $_GET['mot'] != NULL ) {// ET mots dans l'ordre
					
					$mots = explode(' ',$_GET['mot'])	; // Récupération des mots-clé
					if (count($mots)==1) {
						$requete_a = '((a.blasonnement_1 REGEXP "('.$mots[0].')" ';
						$requete_b = '((a.blasonnement_2 REGEXP "('.$mots[0].')" ';
						
						$resultats_arme = $this->Model_recherche->dico(addslashes($mots[0]),'equivalences');
						foreach ($resultats_arme as $row)
						{
							$expression = $row->expression;
							$signification = $row->signification;
							
							// On regarde si le mot est présent dans le dictionnaire
							if($mots[0]==$expression){
								$requete_a.= ' OR a.blasonnement_1 REGEXP "( '.$signification.' )" ';
								$requete_b.= ' OR a.blasonnement_2 REGEXP "( '.$signification.' )" ';
							}
							else if($mots[0]==$signification){
								$requete_a.= ' OR a.blasonnement_1 REGEXP "( '.$expression.' )" ';
								$requete_b.= ' OR a.blasonnement_2 REGEXP "( '.$expression.' )" ';
							}
						}
						$requete_a=$requete_a.")";
						$requete_b=$requete_b.")";
						
						$req1[]=$requete_a.")";
						$req2[]=$requete_b.")";
					}
					else if (count($mots)>1) {
						
						$requete_a = '(a.blasonnement_1 LIKE "%'.implode('%%',$mots).'%"' ; 
						$requete_b = '(a.blasonnement_2 LIKE "%'.implode('%%',$mots).'%"' ;
						
						for($i=0; $i<count($mots) ; $i++){
							
							$resultats_arme = $this->Model_recherche->dico(addslashes($mots[$i]),'equivalences');
							foreach ($resultats_arme as $row)
							{
								$expression = $row->expression;
								$signification = $row->signification;
								$mots2=$mots;			
								if($mots[$i]==$expression){
									$mots2[$i]=$signification;
									$requete_a.= ' OR a.blasonnement_1 LIKE "%'.implode('%%',$mots2).'%"' ; 
									$requete_b.= ' OR a.blasonnement_2 LIKE "%'.implode('%%',$mots2).'%"' ; 
									
									for($j=$i+1; $j<count($mots2) ; $j++){
										$resultats_arme_bis = $this->Model_recherche->dico(addslashes($mots2[$j]),'equivalences');
										foreach ($resultats_arme_bis as $row){
											$expression_bis = $row->expression;
											$signification_bis = $row->signification;
											$mots2_bis=$mots2;
											
											if($mots[$j]==$expression_bis){
												$mots2_bis[$j]=$signification_bis;
												$requete_a.= ' OR a.blasonnement_1 LIKE "%'.implode('%%',$mots2_bis).'%"' ; 
												$requete_b.= ' OR a.blasonnement_2 LIKE "%'.implode('%%',$mots2_bis).'%"' ; 
											}
											
											else if($mots[$j]==$signification_bis){
												$mots2_bis[$j]=$expression_bis;                                      
												$requete_a.= ' OR a.blasonnement_1 LIKE "%'.implode('%%',$mots2_bis).'%"' ; 
												$requete_b.= ' OR a.blasonnement_2 LIKE "%'.implode('%%',$mots2_bis).'%"' ; 
											}
										}
									}
								}
								else if($mots[$i]==$signification){
									$mots2[$i]=$expression;                                      
									$requete_a.= ' OR a.blasonnement_1 LIKE "%'.implode('%%',$mots2).'%"' ; 
									$requete_b.= ' OR a.blasonnement_2 LIKE "%'.implode('%%',$mots2).'%"' ;
									
									for($j=$i+1; $j<count($mots2) ; $j++){
										$resultats_arme_bis = $this->Model_recherche->dico(addslashes($mots2[$j]),'equivalences');
										foreach ($resultats_arme_bis as $row){
											$expression_bis = $row->expression;
											$signification_bis = $row->signification;
											$mots2_bis=$mots2;
											
											if($mots[$j]==$expression_bis){
												$mots2_bis[$j]=$signification_bis;
												$requete_a.= ' OR a.blasonnement_1 LIKE "%'.implode('%%',$mots2_bis).'%"' ; 
												$requete_b.= ' OR a.blasonnement_2 LIKE "%'.implode('%%',$mots2_bis).'%"' ; 
											}
											
											else if($mots[$j]==$signification_bis){
												$mots2_bis[$j]=$expression_bis;                                      
												$requete_a.= ' OR a.blasonnement_1 LIKE "%'.implode('%%',$mots2_bis).'%"' ; 
												$requete_b.= ' OR a.blasonnement_2 LIKE "%'.implode('%%',$mots2_bis).'%"' ; 
											}
										}
									}
								}
							}
						}
						
					}
					$req1[]=$requete_a.")";
					$req2[]=$requete_b.")";
				}
				
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ PATRONYME (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if ($_GET['mot_2'] != NULL ) {
					$mots = explode(' ',$_GET['mot_2'])	; // Récupération des mots-clé
					// ET
					$requete_patro = 'a.patronyme" REGEXP "('.$mots[0].') ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_patro = $requete_patro.'AND a.patronyme REGEXP "('.$mots[$i].')" ' ;
					}
					
					$req1[] = $requete_patro;
					$req2[] = $requete_patro;
					
				}
				
				/*
					|----------------------------------------------------------------------------------------------------
				*/

                /*
                    |----------------------------------------------------------------------------------------------------
                    | Champ Prénom (ET)
                    |----------------------------------------------------------------------------------------------------
                */

                if ($_GET['prenom'] != NULL) {
                    $string = $_GET['prenom'];

                    $requete_prenom = 'a.prenom like "%'.$string.'%"';

                    $req1[] = $requete_prenom;
                    $req2[] = $requete_prenom;

                }


                /*
                    |----------------------------------------------------------------------------------------------------
                */
                /*
					|----------------------------------------------------------------------------------------------------
					| Champ Titres et Dignités (ET)
					|----------------------------------------------------------------------------------------------------
				*/

                if ($_GET['titres_dignites'] != NULL) {
                    $string = $_GET['titres_dignites'];

                    $requete_dignites = 'a.titres_dignites like "%'.$string.'%"';

                    $req1[] = $requete_dignites;
                    $req2[] = $requete_dignites;

                }

                /*
                    |----------------------------------------------------------------------------------------------------
                */
				
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ ORIGINE (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if ($_GET['origine'] != NULL ) {
					$mots = explode(' ',$_GET['origine'])	; // Récupération des mots-clé
					// ET
					$requete_origine = 'a.origine REGEXP "('.$mots[0].')" ' ;
					for($i=1; $i<count($mots) ; $i++){
						$requete_origine = $requete_origine.'AND a.origine REGEXP "('.$mots[$i].')" ' ;
					}
					
					$req1[] = $requete_origine;
					$req2[] = $requete_origine;
					
				}
				
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ REGION (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if ($_GET['mot_3'] != NULL ) {
					
					$mots = explode('+',$_GET['mot_3'])	; // Récupération des mots-clé
					
					$requete_region = 'a.région_bis REGEXP "('.$mots[0].')" ' ;
					for($i=1; $i<count($mots) ; $i++){
						$requete_region = $requete_region.'AND a.région_bis REGEXP "('.$mots[$i].')" ' ;
					}
					
					$req1[] = $requete_region;
					$req2[] = $requete_region;
					
				}
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ DEVISE (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				
				if($_GET['devise'] != NULL ) {
                    $mots = explode(' ',$_GET['devise'])	; // Récupération des mots-clé
					// ET
					$requete_devise = 'a.devise REGEXP "('.$mots[0].')" ' ;
					for($i=1; $i<count($mots) ; $i++){
						$requete_devise = $requete_devise.'AND a.devise REGEXP "('.$mots[$i].')" ' ;
					}
					$req1[] = $requete_devise;
					$req2[] = $requete_devise;
				}
                /*
					|----------------------------------------------------------------------------------------------------
				*/
                
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ CIMIERS (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				
                if (isset($_GET['rechercher_desordre']) && $_GET['cimiers'] != NULL ) {// ET mots dans le désordre
                    $expression = "";
                    $signification = "";
					
                    if($_GET['cimiers'] != NULL ) {
						$mots = explode(' ',$_GET['cimiers'])	; // Récupération des mots-clé
						// ET
						$requete_cimiers = 'a.cimiers REGEXP "('.$mots[0].')" ' ;
						
						$resultats_cimiers = $this->Model_recherche->dico(addslashes($mots[0]),'equivalences');
						
						foreach ($resultats_cimiers as $row)
						{
							$expression = $row->expression;
							$signification = $row->signification;
						}
						
						// On regarde si le mot est présent dans le dictionnaire
						if($mots[0]==$expression){
							$requete_cimiers.= ' OR a.cimiers REGEXP "('.$signification.')" ';
						}
						else if($mots[0]==$signification){
							$requete_cimiers.= ' OR a.cimiers REGEXP "('.$expression.')" ';
						}
						
						for($i=1; $i<count($mots) ; $i++){
							$requete_cimiers = $requete_cimiers.'AND a.cimiers REGEXP "('.$mots[$i].')" ' ;
							
							$resultats_cimiers = $this->Model_recherche->dico(addslashes($mots[$i]),'equivalences');
							
							foreach ($resultats_cimiers as $row)
							{
								$expression = $row->expression;
								$signification = $row->signification;
							}
							
							// On regarde si le mot est présent dans le dictionnaire
							if($mots[$i]==$expression){
								$requete_cimiers.= ' OR a.cimiers REGEXP "('.$signification.')" ';
							}
							else if($mots[$i]==$signification){
								$requete_cimiers.= ' OR a.cimiers REGEXP "('.$expression.')" ';
							}
						}
						$req1[] = $requete_cimiers;
                        $req2[] = $requete_cimiers;
					}
				}
				// Ci-dessous la recherche avec mots ordonnés (à modifier...)
				if (isset($_GET['rechercher_ordre']) && $_GET['cimiers'] != NULL ) {
					$mots = explode(' ',$_GET['cimiers'])	; // Récupération des mots-clé
					// ET
					$requete_cimiers = 'a.cimiers REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_cimiers = $requete_cimiers.'AND a.cimiers REGEXP "('.$mots[$i].')" ' ;
					}
					
					$req1[] = $requete_cimiers;
					$req2[] = $requete_cimiers;
					
					$req1[]='a.patronyme REGEXP "('.implode('|',$mots).')" '; 
					$req2[]='a.patronyme REGEXP "('.implode('|',$mots).')" ';
					
					
				}
                /*
					|----------------------------------------------------------------------------------------------------
				*/
				
                /*
					|----------------------------------------------------------------------------------------------------
					| Champ EMBLEME (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				
				if($_GET['embleme'] != NULL ) {
                    $mots = explode(' ',$_GET['embleme'])	; // Récupération des mots-clé
					// ET
                    $requete_embleme = 'a.embleme REGEXP "('.$mots[0].')" ' ;
					
                    for($i=1; $i<count($mots) ; $i++){
                        $requete_embleme = $requete_embleme.'AND a.embleme REGEXP "('.$mots[$i].')" ' ;
						
					}
					
                    $req1[] = $requete_embleme;
                    $req2[] = $requete_embleme;
				}
                /*
					|----------------------------------------------------------------------------------------------------
				*/
				
                /*|----------------------------------------------------------------------------------------------------
					| Champ FIEF (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if ($_GET['fief'] != NULL ) {
					
					$mots = explode('+',$_GET['fief'])	; // Récupération des mots-clé
					
					//ET
					$requete_fief = 'a.fief REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_fief = $requete_fief.'AND a.fief REGEXP "('.$mots[$i].')" ' ;
					}
					
					$req1[] = $requete_fief;
					$req2[] = $requete_fief;
					
				}		
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ DEPARTEMENT (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if ($_GET['mot_5'] != NULL ) {
					
					$mots = explode('+',$_GET['mot_5'])	; // Récupération des mots-clé
					
					//ET
					$requete_departement = 'a.départment REGEXP "('.$mots[0].')" ' ; 
					for($i=1; $i<count($mots) ; $i++){
						$requete_departement = $requete_departement.'AND a.départment REGEXP "('.$mots[$i].')" ' ;
					}
					
					$req1[] = $requete_departement;
					$req2[] = $requete_departement;
					
				}
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ PAYS (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if ($_GET['pays'] != NULL ) {
					
					$mots = explode('+',$_GET['pays'])	; // Récupération des mots-clé
					//ET
					$requete_pays = 'a.pays REGEXP "('.$mots[0].')"' ;
					for($i=1; $i<count($mots) ; $i++){
						$requete_pays = $requete_pays.'AND a.pays REGEXP "('.$mots[$i].')"' ;
					}
					$req1[] = $requete_pays;
					$req2[] = $requete_pays;
					
				}
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ AIRE GEOGRAPHIQUE (ET)
					|----------------------------------------------------------------------------------------------------
				*/
				if ($_GET['aire'] != NULL ) {
					
					$mots = explode('+',$_GET['aire'])	; // Récupération des mots-clé
					//ET
					$requete_aire = 'a.aire REGEXP "('.$mots[0].')"' ;
					for($i=1; $i<count($mots) ; $i++){
						$requete_pays = $requete_pays.'AND a.aire REGEXP "('.$mots[$i].')"' ;
					}
					$req1[] = $requete_aire;
					$req2[] = $requete_aire;
					
				}
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ OBSERVATIONS
					|----------------------------------------------------------------------------------------------------
				*/			
				if ($_GET['observations'] != NULL ) {
					$mots = explode(' ',$_GET['observations'])	; // Récupération des mots-clé
					// ET
					$requete_observ = 'a.observations REGEXP "('.$mots[0].')" ' ;
					for($i=1; $i<count($mots) ; $i++){
						$requete_observ = $requete_observ.'AND a.observations REGEXP "('.$mots[$i].')" ' ;
					}
					
					$req1[] = $requete_observ;
					$req2[] = $requete_observ;
				}	
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				
                /*
					|----------------------------------------------------------------------------------------------------
					| Champ REF BIBLIO
					|----------------------------------------------------------------------------------------------------
				*/
				if ($_GET['ref_biblio'] != NULL ) {
					$mots = explode(' ',$_GET['ref_biblio'])	; // Récupération des mots-clé
					// ET
					$requete_ref = 'a.ref_biblio REGEXP "('.$mots[0].')" ' ;
					for($i=1; $i<count($mots) ; $i++){
						$requete_ref = $requete_ref.'AND a.ref_biblio REGEXP "('.$mots[$i].')" ' ;
					}
					
					$req1[] = $requete_ref;
					$req2[] = $requete_ref;
				}
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				
				/*
					|----------------------------------------------------------------------------------------------------
					| Champ SIECLE 
					|----------------------------------------------------------------------------------------------------
				*/
				if ($_GET['mot_6'] != NULL ) {
					
					$mots = explode('+',$_GET['mot_6'])	; // Récupération des mots-clé
					//ET
					$requete_aire = 'a.siècle REGEXP "('.$mots[0].')"' ;
					for($i=1; $i<count($mots) ; $i++){
						$requete_pays = $requete_pays.'AND a.siècle REGEXP "('.$mots[$i].')"' ;
					}
					$req1[] = $requete_aire;
					$req2[] = $requete_aire;
					
				}
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				
                /*----------------------------------------------------------------------------------------------------
					| Champ  REF/BIBLIO
					|----------------------------------------------------------------------------------------------------
				*/
				if ( $_GET['ref_biblio'] != NULL ) {
					$mots = explode(' ',$_GET['ref_biblio'])	; // Récupération des mots-clé
					//ET
					$requete_biblio = 'a.ref_biblio REGEXP "('.$mots[0].')" ' ;
					for($i=1; $i<count($mots) ; $i++){
						$requete_biblio = $requete_biblio.'AND a.ref_biblio REGEXP "('.$mots[$i].')" ' ;
					}
					$req1[] = $requete_biblio;
					$req2[] = $requete_biblio;
					
				}
				/*
					|----------------------------------------------------------------------------------------------------
				*/
				/*
					|----------------------------------------------------------------------------------------------------
					| Validation formulaire croisée + envoi de la requête SQL
					|----------------------------------------------------------------------------------------------------
				*/
				if($req1==NULL || $req2==NULL){
					header("Location: ".base_url().'/recherche');
					}else{
					$requete1=$req1[0];
					$requete2=$req2[0];
					for($i=1;$i<count($req1);$i++){
						$requete1=$requete1.' AND '.$req1[$i];
					}
					for($i=1;$i<count($req2);$i++){
						$requete2=$requete2.' AND '.$req2[$i];
					}
					
					$donnees1 = $this->Model_recherche->recherche_simple2($requete1.' ORDER BY length(a.blasonnement_1)');
					$donnees2 = $this->Model_recherche->recherche_simple2($requete2.' ORDER BY length(a.blasonnement_2)');
				}
			}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			
			/*|----------------------------------------------------------------------------------------------------
				| SI REQUETE TROP LONGUE (pour contrer l'arret du script sql par OVH)
				|----------------------------------------------------------------------------------------------------
			*/   $message_erreur = "";
			if(isset ($_GET['msg'])){
				$message_erreur = $_GET['msg'];
				if($message_erreur=="timeout"){
					$message_erreur = "VOTRE RECHERCHE N'EST PAS ASSEZ PRÉCISE, VEUILLEZ L'AFFINER";
				}
			}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			
			
			// On récupère toutes les photos, dans la vue on compare $photo->vedette_chandon et $data->patronyme 
			$photos=$this->Model_recherche->photo_liste(); // Utile pour affichage des icônes
			$siecles=$this->Model_recherche->siecle_liste();
			$denominations = $this->Model_recherche->denomination_liste();
			$communes = $this->Model_recherche->commune_liste();
			$pays = $this->Model_recherche->pays_liste();
			$regions = $this->Model_recherche->region_liste();
			$departements = $this->Model_recherche->departement_liste();
			$aire = $this->Model_recherche->aire_liste();
			$ref_biblios = $this->Model_recherche->ref_biblio_liste();
			
			
			// Tableau $data des variables à envoyer aux vues			
			$data = array(
			'connecte' => $session, // La variable $connecte est utilisée dans la vue footer.php 
			'donnees'=> $donnees,
			'donnees1'=> $donnees1,
			'donnees2'=> $donnees2,
			'donnees3'=> $donnees3,
			'photos' =>$photos,
			'siecles'=>$siecles,
			'denominations'=> $denominations,
			'pays'=>$pays,
			'communes'=>$communes,
			'regions'=>$regions,
			'departements'=>$departements,
			'aire'=>$aire,
			'ref_biblios'=>$ref_biblios,
			'message_erreur'=> $message_erreur
			
			);
			
			// Chargement des vues à afficher (attention à l'ordre) (les vues sont dans le dossier /system/application/views)	
			$this->load->view('layout/header',$data);				
			$this->load->view('recherche_publique',$data);	
			$this->load->view('layout/footer',$data);	
		}
		
        function maj_accents($mot,$champ){ //fonction pour les mots avec des majuscules accentuées dans la base de données
			
			$new_mot = str_replace ("é", "É", $mot);
			$new_mot = str_replace ("è", "È", $new_mot);
			$new_mot = str_replace ("ë", "Ë", $new_mot);
			$new_mot = str_replace ("ê", "Ê", $new_mot);
			$new_mot = str_replace ("à", "À", $new_mot);
			$new_mot = str_replace ("ô", "Ô", $new_mot);
			$new_mot = str_replace ("ö", "Ö", $new_mot);
			$new_mot = str_replace ("ǜ", "Û", $new_mot);
			$new_mot = str_replace ("ü", "Ü", $new_mot);
			$new_mot = strtoupper($new_mot);
			
			$requete = 'a.'.$champ.' REGEXP "('.$new_mot.')" COLLATE utf8_bin';
			
			return $requete;
			
		}
	}
	
	/* End of file welcome.php */
	/* Location: ./system/application/controllers/welcome.php */
?>
