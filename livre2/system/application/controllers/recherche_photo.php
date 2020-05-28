<?php

class Recherche_photo extends Controller {  // Le nom de la classe est le nom du controller avec une majuscule
	function index(){ 

// Chargement des models utilisÃ©s dans le controller (les models sont dans le dossiers /system/application/models )
		$this->load->model('Model_recherche');			
		$this->load->model('Model_details');
		$this->load->model('Model_administration');				
		/*
		|----------------------------------------------------------------------------------------------------
		| Bouton de DÃ©connexion qui met la variable $session = FALSE (cad non connectÃ©)			
		|----------------------------------------------------------------------------------------------------
		*/
			$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connectÃ©) ou $session=FALSE (admin est pas connectÃ©)
			if (isset($_GET['deconnexion']) && $_GET['deconnexion'] == 'Deconnexion') {
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
		
/*
|----------------------------------------------------------------------------------------------------
| Recherche d' ICONOGRAPHIES (commune, edifice de conservation, village, patronyme, date, denomination, categorie, materiaux, armes)
|----------------------------------------------------------------------------------------------------
*/
	if(isset($_GET['rechercher_ordre']) || isset($_GET['rechercher_desordre'])){
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ COMMUNE (Formulaire SELECT)
		|----------------------------------------------------------------------------------------------------
		*/
			if($_GET['Commune'] != NULL ) {
            $mots = explode(' ',$_GET['Commune'])	; // recupération des mots clés
			// OU
			$req[] = 'l.commune = "'.$_GET['Commune'].'"';
			//$req[] = 'l.commune REGEXP "('.implode('|',$mots).')"';
			//$donnees=$this->Model_details->infos_commune($requete_Commune);
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
                    $mots = explode(' ',$_GET['Patronyme'])	; // recupération des mots clés
			// ET
				$autre = $this->maj_patronymes($mots[0]);

                                $requete_patro = '(l.patronyme REGEXP "('.$mots[0].')" OR '.$autre.' )' ;

				for($i=1; $i<count($mots) ; $i++){
                                        $autre = $this->maj_patronymes($mots[$i]);
					$requete_patro = $requete_patro.'AND (l.patronyme REGEXP "('.$mots[$i].')" OR '.$autre.')';
				}

			$req[] = $requete_patro;//.' COLLATE utf8_bin';
			//$req[] = 'l.commune REGEXP "('.implode('|',$mots).')"';
			//$donnees=$this->Model_details->infos_commune($requete_Commune);
		}
		/*
		|----------------------------------------------------------------------------------------------------
		*/

                /*
		|----------------------------------------------------------------------------------------------------
		| Champ BIOGRAPHIE (ET)
		|----------------------------------------------------------------------------------------------------
		*/
		if($_GET['biographie'] != NULL ) {
            $mots = explode(' ',$_GET['biographie'])	; // recupération des mots clés
			// ET
				$requete_bio = 'l.biographie REGEXP "('.$mots[0].')" ' ;
				for($i=1; $i<count($mots) ; $i++){
					$requete_bio = $requete_bio.'AND l.biographie REGEXP "('.$mots[$i].')" ' ;
				}
			$req[] = $requete_bio;
			//$req[] = 'l.commune REGEXP "('.implode('|',$mots).')"';
			//$donnees=$this->Model_details->infos_commune($requete_Commune);
		}
		/*
		|----------------------------------------------------------------------------------------------------
		*/

		/*
		|----------------------------------------------------------------------------------------------------
		| Champ CIMIERS (ET)
		|----------------------------------------------------------------------------------------------------
		*/
		if($_GET['cimiers'] != NULL ) {
            $mots = explode(' ',$_GET['cimiers'])	; // recupération des mots clés
			// ET
				$requete_cimiers = 'l.cimiers REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_cimiers = $requete_cimiers.'AND l.cimiers REGEXP "('.$mots[$i].')" ' ;
				}
			$req[] = $requete_cimiers;
		}
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
                /*
		|----------------------------------------------------------------------------------------------------
		| Champ DEVISE/LEGENDE (ET)
		|----------------------------------------------------------------------------------------------------
		*/
		if($_GET['devise_legende'] != NULL ) {
                $mots = explode(' ',$_GET['devise_legende'])	; // recupération des mots clés
			// ET
				$requete_devise = 'l.devise REGEXP "('.$mots[0].')" ' ;
				for($i=1; $i<count($mots) ; $i++){
					$requete_devise = $requete_devise.'AND l.devise REGEXP "('.$mots[$i].')" ' ;
				}
			$req[] = $requete_devise;
		}
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ EMBLÈME (ET)
		|----------------------------------------------------------------------------------------------------
		*/
		if($_GET['embleme'] != NULL ) {
            $mots = explode(' ',$_GET['embleme'])	; // recupération des mots clés
			// ET
				$requete_embleme = 'l.embleme REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_embleme = $requete_embleme.'AND l.embleme REGEXP "('.$mots[$i].')" ' ;
				}
			$req[] = $requete_embleme;
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
                    	$mots = explode(' ',$_GET['Village'])	; // recupération des mots clés
			// OU
			//$req[] = 'l.village REGEXP "('.implode('|',$mots).')"';
			
			//ET 
			$requete_village = 'l.village REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_village = $requete_village.'AND l.village REGEXP "('.$mots[$i].')" ' ;
				}
			$req[] = $requete_village;
			
			//$donnees=$this->Model_details->infos_Village($requete_Village);
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
                    	$mots = explode(' ',$_GET['region'])	; // recupération des mots clés

			//ET 
			$requete_region = 'l.region REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_region = $requete_region.'AND l.region REGEXP "('.$mots[$i].')" ' ;
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
		/* if ( $_GET['Date'] != NULL ) { */
                /*     	$mots = explode(' ',$_GET['Date'])	; // recupération des mots clés */
		/* 	// OU */
		/* 	//$req[] = 'l.date REGEXP "('.implode('|',$mots).')"'; */
		/* 	$req[] = 'l.date = "'.$_GET['Date'].'"'; */
		/* 	//$donnees=$this->Model_details->infos_Date($requete_Date); */
		/* } */
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ DENOMINATION (formulaire select)
		|----------------------------------------------------------------------------------------------------
		*/
		if ($_GET['Denomination'] != NULL ) {
                    	$mots = explode(' ',$_GET['Denomination'])	; // recupération des mots clés
			// OU
			//$req[]= 'l.denomination REGEXP "('.implode('|',$mots).')"';
			$req[] = 'l.denomination = "'.$_GET['Denomination'].'"';
			//$donnees=$this->Model_details->infos_Denomination($requete_Denomination);
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
                    	$mots = explode(' ',$_GET['Categorie'])	; // recupération des mots clés
			// OU
			//$req[] = 'l.categorie REGEXP "('.implode('|',$mots).')"';
			$req[] = 'l.categorie = "'.$_GET['Categorie'].'"';
			//$donnees=$this->Model_details->infos_Categorie($requete_Categorie);
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
             $mots = explode(' ',$_GET['Conservation'])	; // recupération des mots clés
			// OU
			//$req[]= 'l.edifice_conservation REGEXP "('.implode('|',$mots).')"';
			//ET
			$requete_edifice = 'l.edifice_conservation REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_edifice = $requete_edifice.'AND l.edifice_conservation REGEXP "('.$mots[$i].')" ' ;
				}
			$req[] = $requete_edifice;
			
			//$donnees=$this->Model_details->infos_Conservation($requete_Conservation);
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
                    	$mots = explode(' ',$_GET['Materiau'])	; // recupération des mots clés
			// OU
			//$req[] = 'l.materiau REGEXP "('.implode('|',$mots).')"';
			$req[] = 'l.materiau = "'.$_GET['Materiau'].'"';
			//$donnees=$this->Model_details->infos_Materiau($requete_Materiau);
		} */
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ ARMES (ET)
		|----------------------------------------------------------------------------------------------------
		*/ 

				if (isset($_GET['rechercher_desordre']) && $_GET['mot'] != NULL ) {// ET mots dans le désordre
				
				$expression = "";
                $signification = "";
                $autre1 = "";
                $autres2 = "";

                                $mots = explode(' ',$_GET['mot'])	; // recupération des mots clés
                              
				//Construction de $requete
				$requete_a = '((l.armes REGEXP "('.$mots[0].')" ';
                                $resultats_arme = $this->Model_recherche->dico(addslashes($mots[0]),'equivalences');
                                foreach ($resultats_arme as $row)
                                {
                                    $expression = $row->expression;
                                    $signification = $row->signification;

                                    //On regarde si le mot est présent dans le dictionnaire
                                    if($mots[0]==$expression){
                                        $requete_a.= ' OR l.armes REGEXP "( '.$signification.' )" ';
                                    }
                                    else if($mots[0]==$signification){
                                        $requete_a.= ' OR l.armes REGEXP "( '.$expression.' )" ';
                                    }
                                }

                                $requete_a=$requete_a.")";

				for($i=1; $i<count($mots) ; $i++){
                                       
					$requete_a = $requete_a.' AND (l.armes REGEXP "('.$mots[$i].')" ';

                                        $resultats_arme_bis = $this->Model_recherche->dico(addslashes($mots[$i]),'equivalences');
                                        foreach ($resultats_arme_bis as $row)
                                        {
                                            $expression_bis = $row->expression;
                                            $signification_bis = $row->signification;

                                            //On regarde si le mot est présent dans les équivalences
                                            if($mots[$i]==$expression_bis){

                                                $requete_a.= ' OR l.armes REGEXP "('.$signification_bis.')" ';
                                            }
                                            else if($mots[$i]==$signification_bis){
                                                
                                                $requete_a.= ' OR l.armes REGEXP "('.$expression_bis.')" ';
                                            }
                                        }

                                $requete_a=$requete_a.")";
                                        
				}
				//$requete1 = '('.$requete_a.' OR '.$requete_b.' OR '.$requete_c.')';
				$req[]=$requete_a.")";
			}
//Ci-dessous la recherche avec mots ordonn�s (� modifier...)
			if (isset($_GET['rechercher_ordre']) && $_GET['mot'] != NULL ) {// ET mots dans l'ordre
				
                                				$mots = explode(' ',$_GET['mot'])	; // recup�ration des mots cl�s
				if (count($mots)==1) {
				$requete_a = '((l.armes REGEXP "('.$mots[0].')" ';

                                $resultats_arme = $this->Model_recherche->dico(addslashes($mots[0]),'equivalences');
                                foreach ($resultats_arme as $row)
                                {
                                    $expression = $row->expression;
                                    $signification = $row->signification;

                                    //On regarde si le mot est présent dans le dictionnaire
                                    if($mots[0]==$expression){
                                        $requete_a.= ' OR l.armes REGEXP "( '.$signification.' )" ';
                                    }
                                    else if($mots[0]==$signification){
                                        $requete_a.= ' OR l.armes REGEXP "( '.$expression.' )" ';
                                    }
                                }
				$requete_a=$requete_a.")";

				$req[]=$requete_a.")";
				}
				else if (count($mots)>1) {
				
				$requete_a = '(l.armes LIKE "%'.implode('%%',$mots).'%"' ; 
	
		for($i=0; $i<count($mots) ; $i++){

					$resultats_arme = $this->Model_recherche->dico(addslashes($mots[$i]),'equivalences');
					foreach ($resultats_arme as $row)
					{
							$expression = $row->expression;
                            $signification = $row->signification;
							$mots2=$mots;			
							if($mots[$i]==$expression){
								$mots2[$i]=$signification;
								$requete_a.= ' OR l.armes LIKE "%'.implode('%%',$mots2).'%"' ; 
								
								for($j=$i+1; $j<count($mots2) ; $j++){
									$resultats_arme_bis = $this->Model_recherche->dico(addslashes($mots2[$j]),'equivalences');
									foreach ($resultats_arme_bis as $row){
											$expression_bis = $row->expression;
											$signification_bis = $row->signification;
											$mots2_bis=$mots2;
											
											if($mots[$j]==$expression_bis){
												$mots2_bis[$j]=$signification_bis;
												$requete_a.= ' OR l.armes LIKE "%'.implode('%%',$mots2_bis).'%"' ; 
												}
												
											else if($mots[$j]==$signification_bis){
												$mots2_bis[$j]=$expression_bis;                                      
												$requete_a.= ' OR l.armes LIKE "%'.implode('%%',$mots2_bis).'%"' ; 
												}
									}
								}
							}
							else if($mots[$i]==$signification){
								$mots2[$i]=$expression;                                      
								$requete_a.= ' OR l.armes LIKE "%'.implode('%%',$mots2).'%"' ; 
								
								for($j=$i+1; $j<count($mots2) ; $j++){
									$resultats_arme_bis = $this->Model_recherche->dico(addslashes($mots2[$j]),'equivalences');
									foreach ($resultats_arme_bis as $row){
											$expression_bis = $row->expression;
											$signification_bis = $row->signification;
											$mots2_bis=$mots2;
											
											if($mots[$j]==$expression_bis){
												$mots2_bis[$j]=$signification_bis;
												$requete_a.= ' OR l.armes LIKE "%'.implode('%%',$mots2_bis).'%"' ; 
												}
												
											else if($mots[$j]==$signification_bis){
												$mots2_bis[$j]=$expression_bis;                                      
												$requete_a.= ' OR l.armes LIKE "%'.implode('%%',$mots2_bis).'%"' ; 
												}
									}
								}
							}
					}
					}
    				
			}
				$req[]=$requete_a.")";

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
                $mots = explode(' ',$_GET['auteur'])	; // recupération des mots clés
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
                $mots = explode(' ',$_GET['titre'])	; // recupération des mots clés
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
                $mots = explode(' ',$_GET['lieu_edition'])	; // recupération des mots clés
			//ET 
			$requete_lieu_edition = 'l.lieu_edition REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_lieu_edition = $requete_lieu_edition.'AND l.lieu_edition REGEXP "('.$mots[$i].')" ' ;
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
                $mots = explode(' ',$_GET['annee_edition'])	; // recupération des mots clés
			//ET 
			$requete_annee_edition = 'l.annee_edition REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_annee_edition = $requete_annee_edition.'AND l.annee_edition REGEXP "('.$mots[$i].')" ' ;
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
                $mots = explode(' ',$_GET['editeur'])	; // recupération des mots clés
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
                $mots = explode(' ',$_GET['reliure'])	; // recupération des mots clés
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
                $mots = explode(' ',$_GET['provenance'])	; // recupération des mots clés
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
                $mots = explode(' ',$_GET['site'])	; // recupération des mots clés
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
                $mots = explode(' ',$_GET['section'])	; // recupération des mots clés
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
                $mots = explode(' ',$_GET['cote'])	; // recupération des mots clés
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
                $mots = explode(' ',$_GET['folio'])	; // recupération des mots clés
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
                $mots = explode(' ',$_GET['pays'])	; // recupération des mots clés
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

                /*----------------------------------------------------------------------------------------------------
		| Champ BIBLIOGRAPHIE (ET)
		|----------------------------------------------------------------------------------------------------
		*/
		if ( $_GET['bibliographie'] != NULL ) {
                $mots = explode(' ',$_GET['bibliographie'])	; // recupération des mots clés
			//ET
			$requete_biblio = 'l.bibliographie REGEXP "('.$mots[0].')" ' ;
				for($i=1; $i<count($mots) ; $i++){
					$requete_biblio = $requete_biblio.'AND l.bibliographie REGEXP "('.$mots[$i].')" ' ;
				}
			$req[] = $requete_biblio;
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
				$livre="";
				/*				$livre = 'AND (l.denomination = "bréviaire du diocèse de Troyes" 
										OR l.denomination = "cachet" 
										OR l.denomination = "contre-sceau" 
										OR l.denomination = "dessin sur estampe" 
										OR l.denomination = "dessin" 
										OR l.denomination = "empreinte de sceau" 
										OR l.denomination = "enluminure" 
										OR l.denomination = "estampe" 
										OR l.denomination = "ex-libris" 
										OR l.denomination = "filigrane" 
										OR l.denomination = "livre" 
										OR l.denomination = "manuscrit" 
										OR l.denomination = "miniature" 
										OR l.denomination = "reliure" 
										OR l.denomination = "timbre à sec"
										OR l.denomination = "Lithographie"
										OR l.denomination = "gravure"
										OR l.denomination = "dessin à la plume"
										OR l.denomination = "estampage"
										OR l.denomination = "relevé"
										) ';*/
				
				$donnees = $this->Model_details->recherche_photo($requete.''.$livre);	
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
        $lieu_edition = $this->Model_recherche->lieu_edition_liste();
        $annee_edition = $this->Model_recherche->annee_edition_liste();
    $partenaires = $this->Model_administration->get_partenaires();
	$presentation_livre2=$this->Model_administration->get_presentation_text();

// Tableau $data des variables Ã  envoyer aux vues			
		$data = array(
			'connecte' => $session, // La variable $connecte est utilisÃ© dans la vue footer.php 
			'donnees'=> $donnees, 
			'dates'=> $dates,
			'materiaux' => $materiaux,
			'categories' => $categories,
			'denominations'=> $denominations,
                        'communes'=> $communes,
                        'lieu_edition' => $lieu_edition,
                        'annee_edition' => $annee_edition,
			'partenaires'=> $partenaires,
			'presentation_livre2'=> $presentation_livre2
		);

		
				
// Chargement des views Ã  afficher (attention Ã  l'ordre) (les views sont dans le dossiers /system/application/views )	
		$this->load->view('layout/header',$data);				
		$this->load->view('recherche_photo',$data);	
		$this->load->view('layout/footer',$data);	
	}



 function maj_patronymes($mot){ //fonction pour les patronymes avec des majuscules accentuées dans la base de données

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
     
     $requete = 'l.patronyme REGEXP "('.$new_mot.')" COLLATE utf8_bin';

     return $requete;
     
 }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
?>
