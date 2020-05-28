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
// Recherche par id 		
		if (isset($_POST['recherche_id']) && $_POST['search'] != NULL ) {	
			$donnees=$this->Model_fiche->fiche($_POST['search']);	
			// affichage des icones dans la liste de résultat	
		}elseif(isset($_POST['rechercher_id']) && $_POST['search'] == NULL){ header("Location: ".base_url().'/recherche');}
// Recherche de patronyme	
		if (isset($_POST['rechercher_patronyme']) && $_POST['patronyme'] != NULL ) {	
			$mots = explode(' ',$_POST['patronyme'])	; // recupération des mots clés

			//$requete_patro = 'a.patronyme LIKE "%'.implode('%%',$mots).'%" ';
			
				$requete_patro = 'a.famille REGEXP "('.$mots[0].')" ' ; 
				//$requete_patro = 'a.patronyme REGEXP "('.$mots[0].')" AND a.patronyme NOT REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_patro = $requete_patro.'AND a.famille REGEXP "('.$mots[$i].')" ' ;
					//$requete_patro = $requete_patro.'AND a.patronyme REGEXP "('.$mots[$i].')" AND a.patronyme NOT REGEXP "('.$mots[$i].')" ' ;
				}
			$donnees = $this->Model_recherche->recherche_simple($requete_patro.' ORDER BY length(a.famille)');
			//dans fonction mettre $requete_patro.' '.$requete_not_patro.'ORDER BY
		}elseif(isset($_POST['rechercher_patronyme']) && $_POST['patronyme'] == NULL){ header("Location: ".base_url().'/recherche');}
// Recherche de region
		if (isset($_POST['rechercher_region']) && $_POST['region'] != NULL ) {	
			$mots = explode(' ',$_POST['region'])	; // recupération des mots clés
			// OU 	
			$requete_region = 'a.région REGEXP "('.implode('|',$mots).')"'; 
			$donnees = $this->Model_recherche->recherche_simple($requete_region);
		}elseif(isset($_POST['rechercher_region']) && $_POST['region'] == NULL){ header("Location: ".base_url().'/recherche');}
// Recherche de fief
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
// Recherche de departement	
		if (isset($_POST['rechercher_departement']) && $_POST['departement'] != NULL ) {	
			$mots = explode(' ',$_POST['departement'])	; // recupération des mots clés
			// OU 	
			$requete_departement = 'a.départment REGEXP "('.implode('|',$mots).')" '; 
			$donnees = $this->Model_recherche->recherche_simple($requete_departement);
		}elseif(isset($_POST['rechercher_departement']) && $_POST['departement'] == NULL){ header("Location: ".base_url().'/recherche');}
// Recherche de siecle	
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

// Recherche de siecle	(méthode 2)
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


// Recherche  croisee sur la table armoirie
if(isset($_POST['rechercher_ordre']) || isset($_POST['rechercher_desordre'])){
	
	// Blasonnements 1, 2 et 3 
			if (isset($_POST['rechercher_desordre']) && $_POST['mot'] != NULL ) {
				
				$mots = explode(' ',$_POST['mot'])	; // recupération des mots clés
				
				//Construction de $requete
				$requete_a = 'a.blasonnement_1 REGEXP "('.$mots[0].')" ' ; 
				$requete_b = 'a.blasonnement_2 REGEXP "('.$mots[0].')" ' ; 
				$requete_c = 'a.blasonnement_3 REGEXP "('.$mots[0].')" ' ; 
				for($i=1; $i<count($mots) ; $i++){
					$requete_a = $requete_a.'AND a.blasonnement_1 REGEXP "('.$mots[$i].')" ' ;
					$requete_b = $requete_b.'AND a.blasonnement_2 REGEXP "('.$mots[$i].')" ' ;
					$requete_c = $requete_c.'AND a.blasonnement_3 REGEXP "('.$mots[$i].')" ' ;
				}
				//$requete1 = '('.$requete_a.' OR '.$requete_b.' OR '.$requete_c.')';
				$req1[]=$requete_a;
				$req2[]=$requete_b;
			}
			if (isset($_POST['rechercher_ordre']) && $_POST['mot'] != NULL ) {
				
				$mots = explode(' ',$_POST['mot'])	; // recupération des mots clés
			
				//Construction de $requete
			//	$requete1 = '(a.blasonnement_1 LIKE "%'.implode('%%',$mots).'%" OR a.blasonnement_2 LIKE "%'.implode('%%',$mots).'%" OR a.blasonnement_3 LIKE "%'.implode('%%',$mots).'%")';	
				$requete_a = 'a.blasonnement_1 LIKE "%'.implode('%%',$mots).'%"' ; 
				$requete_b = 'a.blasonnement_2 LIKE "%'.implode('%%',$mots).'%"' ; 
				$requete_c = 'a.blasonnement_3 LIKE "%'.implode('%%',$mots).'%" ' ; 
				
				$req1[]=$requete_a;
				$req2[]=$requete_b;
			}
			
	// Recherche avancée sur le champ patronyme
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
					
			// Recherche avancée sur le champ région
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
		// Recherche avancée sur le champ fief	
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
// Recherche avancée sur le champ departement
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
	// DENOMINATION		
			if ($_POST['Denomination'] != NULL ) {
                    $mots = explode(' ',$_POST['Denomination'])	; // recupération des mots clés
			// OU
			//$req[]= 'l.dénomination REGEXP "('.implode('|',$mots).')"';
			$req1[] = '(l.dénomination = "'.$_POST['Denomination'].'"AND l.famille = a.famille)';
			$req2[] = '(l.dénomination = "'.$_POST['Denomination'].'"AND l.famille = a.famille)';
			//$donnees=$this->Model_legende_photos->infos_Denomination($requete_Denomination);
		}	
					// Recherche avancée sur le champ siècle
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
					$donnees1 = $this->Model_recherche->recherche_simple2($requete1.'ORDER BY length(a.blasonnement_1)');
					$donnees2 = $this->Model_recherche->recherche_simple2($requete2.'ORDER BY length(a.blasonnement_2)');
				}
			}
		// on récupère toutes les photos, dans la vue on compare $photo->vedette_chandon et $data->patronyme 
		$photos=$this->Model_recherche->photo_liste(); // utile pour affichage des icones
		// liste des siècles
		$siecles=$this->Model_recherche->siecle_liste(); 
		$denominations = $this->Model_recherche->denomination_liste();
// Tableau $data des variables à envoyer aux vues			
		$data = array(
			'connecte' => $session, // La variable $connecte est utilisé dans la vue footer.php 
			'donnees'=> $donnees,
			'donnees1'=> $donnees1,
			'donnees2'=> $donnees2,
			'donnees3'=> $donnees3,
			'photos' =>$photos,
			'siecles'=>$siecles,
			'denominations'=> $denominations,
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
