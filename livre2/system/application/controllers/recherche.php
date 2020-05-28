<?php
class recherche extends Controller {  // Le nom de la classe est le nom du controller avec une majuscule
	function index(){ 

// Chargement des models utilisés dans le controller (les models sont dans le dossiers /system/application/models )
		$this->load->model('Model_recherche');			
		$this->load->model('Model_fiche');		
		
		/*
		|----------------------------------------------------------------------------------------------------
		| Bouton de Déconnexion qui met la variable $session = FALSE (cad non connecté)			
		|----------------------------------------------------------------------------------------------------
		*/
			$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connecté) ou $session=FALSE (admin est pas connecté)
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

$donnees = NULL ;		
$donnees1 = NULL ;
$donnees2 = NULL ;
$donnees3 = NULL ; // le tableau de données est vide par défaut
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
		if (isset($_POST['recherche_id']) && $_POST['search'] != NULL ) {	
			$donnees=$this->Model_fiche->fiche($_POST['search']);	
		}elseif(isset($_POST['rechercher_id']) && $_POST['search'] == NULL){ 
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
		if (isset($_POST['rechercher_patronyme']) && $_POST['patronyme'] != NULL ) {	
			$mots = explode(' ',$_POST['patronyme'])	; // recupération des mots clés

			//$requete_patro = 'a.patronyme LIKE "%'.implode('%%',$mots).'%" ';
			
				$requete_patro = 'a.famille REGEXP "('.$mots[0].')" ' ; 
				//$requete_patro = 'a.patronyme REGEXP "('.$mots[0].')" AND a.patronyme NOT REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_patro = $requete_patro.'AND a.famille REGEXP "('.$mots[$i].')" ' ;
					//$requete_patro = $requete_patro.'AND a.patronyme REGEXP "('.$mots[$i].')" AND a.patronyme NOT REGEXP "('.$mots[$i].')" ' ;
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
										) AND l.famille = a.famille ';
			$donnees = $this->Model_recherche->recherche_simple2($requete_patro.''.$livre);
			//dans fonction mettre $requete_patro.' '.$requete_not_patro.'ORDER BY
		}elseif(isset($_POST['rechercher_patronyme']) && $_POST['patronyme'] == NULL){ header("Location: ".base_url().'/recherche');}
/*
|----------------------------------------------------------------------------------------------------
*/
/*
|----------------------------------------------------------------------------------------------------
| Recherche par REGION (OU + ordre des mots non respectés)  -> non utilisé 
|----------------------------------------------------------------------------------------------------
*/
		if (isset($_POST['rechercher_region']) && $_POST['region'] != NULL ) {	
			$mots = explode(' ',$_POST['region'])	; // recupération des mots clés
			// OU 	
			$requete_region = 'a.région REGEXP "('.implode('|',$mots).')"'; 
			$donnees = $this->Model_recherche->recherche_simple($requete_region);
		}elseif(isset($_POST['rechercher_region']) && $_POST['region'] == NULL){ header("Location: ".base_url().'/recherche');}
/*
|----------------------------------------------------------------------------------------------------
*/
/*
|----------------------------------------------------------------------------------------------------
| Recherche par FIEF (ET + ordre des mots non respectés)
|----------------------------------------------------------------------------------------------------
*/
		if (isset($_POST['rechercher_fief']) && $_POST['fief'] != NULL ) {	
			$mots = explode(' ',$_POST['fief'])	; // recupération des mots clés
			// OU 	
			//$requete_fief = 'a.fief REGEXP "('.implode('|',$mots).')" '; 
			$requete_fief = 'a.fief REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_fief = $requete_fief.'AND a.fief REGEXP "('.$mots[$i].')" ' ;
				}
			$donnees = $this->Model_recherche->recherche_simple($requete_fief);
		}elseif(isset($_POST['rechercher_fief']) && $_POST['fief'] == NULL){ header("Location: ".base_url().'/recherche');}
/*
|----------------------------------------------------------------------------------------------------
*/
/*
|----------------------------------------------------------------------------------------------------
| Recherche par DEPARTEMENT (OU + ordre des mots non respectés) -> non utilisé 
|----------------------------------------------------------------------------------------------------
*/
		if (isset($_POST['rechercher_departement']) && $_POST['departement'] != NULL ) {	
			$mots = explode(' ',$_POST['departement'])	; // recupération des mots clés
			// OU 	
			$requete_departement = 'a.départment REGEXP "('.implode('|',$mots).')" '; 
			$donnees = $this->Model_recherche->recherche_simple($requete_departement);
		}elseif(isset($_POST['rechercher_departement']) && $_POST['departement'] == NULL){ header("Location: ".base_url().'/recherche');}
/*
|----------------------------------------------------------------------------------------------------
*/
/*
|----------------------------------------------------------------------------------------------------
| Recherche par SIECLE (1 ou plusieurs siècles choisis <=> Formulaire case à cocher) -> non utilisé 
|----------------------------------------------------------------------------------------------------
*/
			if (isset($_POST['rechercher_siecle']) && $_POST['siecle'] != NULL ) {	
				$siecle = $_POST['siecle'];;
				/*
				$mots = explode(' ',$_POST['siecle'])	; // recupération des mots clés
				// OU 	
				$requete_siecle = 'a.siècle REGEXP "('.implode('|',$mots).')" '; 
				$donnees = $this->Model_recherche->recherche_simple($requete_siecle);
				*/
				/*$requete_siecle = 'a.siècle ="'.$_POST['siecle'].'"';*/
				$requete_siecle = 'a.siècle = "'.$siecle[0].'"';
				for($i=1; $i<count($siecle); $i++){
						
						$requete_siecle=$requete_siecle.'OR a.siècle = "'.$siecle[$i].'"';
				} 
				$donnees = $this->Model_recherche->recherche_simple($requete_siecle);
			}elseif(isset($_POST['rechercher_siecle']) && $_POST['siecle'] == NULL){ header("Location: ".base_url().'/recherche');}

/*
|----------------------------------------------------------------------------------------------------
*/
/*
|----------------------------------------------------------------------------------------------------
| Recherche par SIECLE (les siècles antérieurs au siècle choisi sont récupérerés) -> non utilisé 
|----------------------------------------------------------------------------------------------------
*/
			if (isset($_POST['rechercher_siecle2']) && $_POST['siecle2'] != NULL ) {	
				
				if($_POST['siecle2'] == 'XIIe s.'){
					$requete_siecle = 'a.siècle ="'.$_POST['siecle2'].'"';
				}
				if($_POST['siecle2'] == 'XIIIe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle ="'.$_POST['siecle2'].'"';
				}
				if($_POST['siecle2'] == 'XIVe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle ="'.$_POST['siecle2'].'"';
				}
				if($_POST['siecle2'] == 'XVe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle ="'.$_POST['siecle2'].'"';
				}
				if($_POST['siecle2'] == 'XVIe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle ="'.$_POST['siecle2'].'"';
				}
				if($_POST['siecle2'] == 'XVIIe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle = "XVIe s." OR a.siècle ="'.$_POST['siecle2'].'"';
				}
				if($_POST['siecle2'] == 'XVIIIe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle = "XVIe s." OR a.siècle = "XVIIe s." OR a.siècle ="'.$_POST['siecle2'].'"';
				}
				if($_POST['siecle2'] == 'XIXe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle = "XVIe s." OR a.siècle = "XVIIe s." OR a.siècle = "XVIIIe s." OR a.siècle ="'.$_POST['siecle2'].'"';
				}
				if($_POST['siecle2'] == 'XXe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle = "XVIe s." OR a.siècle = "XVIIe s." OR a.siècle = "XVIIIe s." OR a.siècle = "XIXe s." OR a.siècle ="'.$_POST['siecle2'].'"';
				}
				if($_POST['siecle2'] == 'XXIe s.'){
					$requete_siecle = 'a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle = "XVIe s." OR a.siècle = "XVIIe s." OR a.siècle = "XVIIIe s." OR a.siècle = "XIXe s." OR a.siècle = "XXe s." OR a.siècle ="'.$_POST['siecle2'].'"';
				}
				
				$donnees = $this->Model_recherche->recherche_simple($requete_siecle);
			}elseif(isset($_POST['rechercher_siecle2']) && $_POST['siecle2'] == NULL){ header("Location: ".base_url().'/recherche');}
/*
|----------------------------------------------------------------------------------------------------
*/
/*
|----------------------------------------------------------------------------------------------------
| Recherche par ARMES ( Formulaire croisé avec les champs : armes, fief, patronyme, siecle, département, région dénomination )
|----------------------------------------------------------------------------------------------------
*/
if(isset($_POST['rechercher_ordre']) || isset($_POST['rechercher_desordre'])){
	
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
				$requete_a = '((a.blasonnement_1 REGEXP "('.$mots[0].')" ';
				$requete_b = '((a.blasonnement_2 REGEXP "('.$mots[0].')" ';
                                $resultats_arme = $this->Model_recherche->dico(addslashes($mots[0]),'equivalences');
                                foreach ($resultats_arme as $row)
                                {
                                    $expression = $row->expression;
                                    $signification = $row->signification;

                                    //On regarde si le mot est présent dans le dictionnaire
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

                                            //On regarde si le mot est présent dans les équivalences
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
				//$requete1 = '('.$requete_a.' OR '.$requete_b.' OR '.$requete_c.')';
				$req1[]=$requete_a.")";
				$req2[]=$requete_b.")";
			}
//Ci-dessous la recherche avec mots ordonn�s (� modifier...)
			if (isset($_GET['rechercher_ordre']) && $_GET['mot'] != NULL ) {// ET mots dans l'ordre
				
                                				$mots = explode(' ',$_GET['mot'])	; // recup�ration des mots cl�s
				if (count($mots)==1) {
				$requete_a = '((a.blasonnement_1 REGEXP "('.$mots[0].')" ';
				$requete_b = '((a.blasonnement_2 REGEXP "('.$mots[0].')" ';

                                $resultats_arme = $this->Model_recherche->dico(addslashes($mots[0]),'equivalences');
                                foreach ($resultats_arme as $row)
                                {
                                    $expression = $row->expression;
                                    $signification = $row->signification;

                                    //On regarde si le mot est présent dans le dictionnaire
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
			if ($_POST['mot_2'] != NULL ) {
				$mots = explode(' ',$_POST['mot_2'])	; // recupération des mots clés
			// ET
				$requete_patro = 'a.famille REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_patro = $requete_patro.'AND a.famille REGEXP "('.$mots[$i].')" ' ;
				}
			
			$req1[] = $requete_patro;
			$req2[] = $requete_patro;
			
			//$req1[]='a.famille REGEXP "('.implode('|',$mots).')" '; 
			//$req2[]='a.famille REGEXP "('.implode('|',$mots).')" '; 
			
			}


		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ CIMIERS (ET)
		|----------------------------------------------------------------------------------------------------
		*/
			if ($_POST['cimiers'] != NULL ) {
				$mots = explode(' ',$_POST['cimiers'])	; // recupération des mots clés
			// ET
				$requete_cimiers = 'a.cimiers REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_cimiers = $requete_cimiers.'AND a.cimiers REGEXP "('.$mots[$i].')" ' ;
				}
			
			$req1[] = $requete_cimiers;
			$req2[] = $requete_cimiers;
			
			//$req1[]='a.famille REGEXP "('.implode('|',$mots).')" '; 
			//$req2[]='a.famille REGEXP "('.implode('|',$mots).')" '; 
			
			}

		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ DEVISE (ET)
		|----------------------------------------------------------------------------------------------------
		*/
			if ($_POST['devise'] != NULL ) {
				$mots = explode(' ',$_POST['devise'])	; // recupération des mots clés
			// ET
				$requete_devise = 'a.devise REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_devise = $requete_devise.'AND a.devise REGEXP "('.$mots[$i].')" ' ;
				}
			
			$req1[] = $requete_devise;
			$req2[] = $requete_devise;
			
			//$req1[]='a.famille REGEXP "('.implode('|',$mots).')" '; 
			//$req2[]='a.famille REGEXP "('.implode('|',$mots).')" '; 
			
			}

					
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ REGION (ET)
		|----------------------------------------------------------------------------------------------------
		*/
			if ($_POST['mot_3'] != NULL ) {
				
				$mots = explode('+',$_POST['mot_3'])	; // recupération des mots clés	
			// OU 
			//$req1[] = 'a.région REGEXP "('.implode('|',$mots).')" '; 
			//$req2[] = 'a.région REGEXP "('.implode('|',$mots).')" '; 
			
			// ET
				$requete_region = 'a.région REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_region = $requete_region.'AND a.région REGEXP "('.$mots[$i].')" ' ;
				}
			
			$req1[] = $requete_region;
			$req2[] = $requete_region;
			
			}
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ FIEF (ET)
		|----------------------------------------------------------------------------------------------------
		*/
			if ($_POST['mot_4'] != NULL ) {
				
				$mots = explode('+',$_POST['mot_4'])	; // recupération des mots clés	
			// OU
				//$req1[]='a.fief REGEXP "('.implode('|',$mots).')" ';
				//$req2[] ='a.fief REGEXP "('.implode('|',$mots).')" ';
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
			if ($_POST['mot_5'] != NULL ) {
				
				$mots = explode('+',$_POST['mot_5'])	; // recupération des mots clés	
			// OU 
			//$req1[]='a.départment REGEXP "('.implode('|',$mots).')" ';
			//$req2[] ='a.départment REGEXP "('.implode('|',$mots).')" ';
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
			if ($_POST['pays'] != NULL ) {
				
			$mots = explode('+',$_POST['pays'])	; // recupération des mots clés	
			//ET
			$requete_pays = 'l.pays REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_pays = $requete_pays.'AND l.pays REGEXP "('.$mots[$i].')" AND l.famille = a.famille' ;
				}
			$req1[] = $requete_pays;
			$req2[] = $requete_pays;
			
			}
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ DENOMINATION 
		|----------------------------------------------------------------------------------------------------
		*/			
			if ($_POST['Denomination'] != NULL ) {
                    $mots = explode(' ',$_POST['Denomination'])	; // recupération des mots clés
			// OU
			//$req[]= 'l.dénomination REGEXP "('.implode('|',$mots).')"';
			$req1[] = '(l.dénomination = "'.$_POST['Denomination'].'"AND l.famille = a.famille)';
			$req2[] = '(l.dénomination = "'.$_POST['Denomination'].'"AND l.famille = a.famille)';
			//$donnees=$this->Model_legende_photos->infos_Denomination($requete_Denomination);
		}	
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		/*
		|----------------------------------------------------------------------------------------------------
		| Champ SIECLE 
		|----------------------------------------------------------------------------------------------------
		*/
			if ($_POST['mot_6'] != NULL ) {
				$mots = explode('+',$_POST['mot_6'])	; // recupération des mots clés
			// OU 
			//	$req1[] = 'a.siècle REGEXP "('.implode('|',$mots).')" ';
			//	$req2[] ='a.siècle REGEXP "('.implode('|',$mots).')" ';
			
			if($_POST['mot_6'] == 'XIIe s.'){
					$requete_siecle = '(a.siècle ="'.$_POST['mot_6'].'")';
				}
				if($_POST['mot_6'] == 'XIIIe s.'){
					$requete_siecle = '(a.siècle = "XIIe s." OR a.siècle ="'.$_POST['mot_6'].'")';
				}
				if($_POST['mot_6'] == 'XIVe s.'){
					$requete_siecle = '(a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle ="'.$_POST['mot_6'].'")';
				}
				if($_POST['mot_6'] == 'XVe s.'){
					$requete_siecle = '(a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle ="'.$_POST['mot_6'].'")';
				}
				if($_POST['mot_6'] == 'XVIe s.'){
					$requete_siecle = '(a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle ="'.$_POST['mot_6'].'")';
				}
				if($_POST['mot_6'] == 'XVIIe s.'){
					$requete_siecle = '(a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle = "XVIe s." OR a.siècle ="'.$_POST['mot_6'].'")';
				}
				if($_POST['mot_6'] == 'XVIIIe s.'){
					$requete_siecle = '(a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle = "XVIe s." OR a.siècle = "XVIIe s." OR a.siècle ="'.$_POST['mot_6'].'")';
				}
				if($_POST['mot_6'] == 'XIXe s.'){
					$requete_siecle = '(a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle = "XVIe s." OR a.siècle = "XVIIe s." OR a.siècle = "XVIIIe s." OR a.siècle ="'.$_POST['mot_6'].'")';
				}
				if($_POST['mot_6'] == 'XXe s.'){
					$requete_siecle = '(a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle = "XVIe s." OR a.siècle = "XVIIe s." OR a.siècle = "XVIIIe s." OR a.siècle = "XIXe s." OR a.siècle ="'.$_POST['mot_6'].'")';
				}
				if($_POST['mot_6'] == 'XXIe s.'){
					$requete_siecle = '(a.siècle = "XIIe s." OR a.siècle = "XIIIe s." OR a.siècle = "XIVe s." OR a.siècle = "XVe s." OR a.siècle = "XVIe s." OR a.siècle = "XVIIe s." OR a.siècle = "XVIIIe s." OR a.siècle = "XIXe s." OR a.siècle = "XXe s." OR a.siècle ="'.$_POST['mot_6'].'")';
				}
				$req1[] = $requete_siecle;
				$req2[] = $requete_siecle;
			
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
										) AND l.famille = a.famille ';
					$donnees1 = $this->Model_recherche->recherche_simple2($requete1.''.$livre.'ORDER BY length(a.blasonnement_1)');
					$donnees2 = $this->Model_recherche->recherche_simple2($requete2.''.$livre.'ORDER BY length(a.blasonnement_2)');
				}
			}
		/*
		|----------------------------------------------------------------------------------------------------
		*/
/*
|----------------------------------------------------------------------------------------------------
*/
		// on récupère toutes les photos, dans la vue on compare $photo->vedette_chandon et $data->patronyme 
		$photos=$this->Model_recherche->photo_liste(); // utile pour affichage des icones
		// liste des siècles
		$siecles=$this->Model_recherche->siecle_liste();
		$partenaires = $this->Model_administration->get_partenaires();
		$presentation_livre2=$this->Model_administration->get_presentation_text();
		
		//$denominations = $this->Model_recherche->denomination_liste();
// Tableau $data des variables à envoyer aux vues			
		$data = array(
			'connecte' => $session, // La variable $connecte est utilisé dans la vue footer.php 
			'donnees'=> $donnees,
			'donnees1'=> $donnees1,
			'donnees2'=> $donnees2,
			'donnees3'=> $donnees3,
			'photos' =>$photos,
			'siecles'=>$siecles,
			//'denominations'=> $denominations,
			'partenaires'=> $partenaires,
			'presentation_livre2'=> $presentation_livre2
				);

		
				
// Chargement des views à afficher (attention à l'ordre) (les views sont dans le dossiers /system/application/views )	
		$this->load->view('layout/header',$data);				
		$this->load->view('recherche',$data);	
		$this->load->view('layout/footer',$data);	
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
?>
