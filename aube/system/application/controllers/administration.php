<?php
	class Administration extends Controller {
		
		function index(){
			
			// Chargement des models utilisés dans le controller (les models sont dans le dossiers /system/application/models )
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Bouton de Déconnexion qui met la variable $session = FALSE (cad non connecté)			
				|----------------------------------------------------------------------------------------------------
			*/
			$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connecté) ou $session=FALSE (admin est pas connecté)
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
			
			// Tableau $data des variables à envoyer aux vues			
			$data = array(
			'connecte' => $session, // La variable $connecte est utilisé dans la vue footer.php 
			);
			
			// Chargement des views à afficher (attention à l'ordre) (les views sont dans le dossiers /system/application/views )	
			$this->load->view('layout/header',$data);	
			$this->load->view('administration/administration',$data);
			$this->load->view('layout/footer',$data);	
			
		}
		
	function identification (){
	
	// Chargement des models utilisés dans le controller (les models sont dans le dossiers /system/application/models )
	$this->load->model('Model_administration');	
	
	/*
	|----------------------------------------------------------------------------------------------------
	| Bouton de Déconnexion (voir vue footer.php) qui met la variable $session = FALSE (cad non connecté)			
	|----------------------------------------------------------------------------------------------------
	*/
	$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connecté) ou $session=FALSE (admin est pas connecté)
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
	/*
	|----------------------------------------------------------------------------------------------------
	| Formulaire de Connexion (voir vue identification.php) qui met la variable $session = TRUE (cad connecté)			
	|----------------------------------------------------------------------------------------------------
	*/	
	$error= NULL; // $error contiendra le message d'erreur d'identification 	
	$identifiants = $this->Model_administration->identifiant();		// $identifiants : tous les identifiants enregistrés dans la bdd 	
	//Initialisation des variables							
	$newdata = array( // Variable de session (par défaut l'admin est pas connecté donc FALSE)
	'logged_in' => FALSE,
	'statut' => NULL
	);
	$this->session->set_userdata($newdata);	
	
	if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') { // on vérifie que le formulaire a été envoyé
	if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) {
	foreach ($identifiants as $identifiant) {	// on compare les identifiants envoyés avec ceux de la bdd
	if (($identifiant->login == $_POST['login'] ) && ($identifiant->password == $_POST['pass'])) { // si les identifiants sont correctes, la variable de session logged_in passe à TRUE
	$newdata = array(
	'logged_in' => TRUE,
	'statut' => $identifiant->statut, 
	);
	$this->session->set_userdata($newdata); 
	$session = $this->session->userdata('logged_in'); // $session = TRUE (l'admin est connecté)
	header("Location: ".base_url()); // redirection vers la page d'administration
	}
	}
	$error='<div class="error"><strong>Identifiants incorrects</strong></div>';		
	}
	else {
	$error='<div class="error"><strong>Identifiants incorrects</strong></div>';			
	}				
	}
	/*
	|----------------------------------------------------------------------------------------------------
	*/
	
	// Tableau $data des variables à envoyer aux vues			
	$data = array(
	'connecte' => $session, // La variable $connecte est utilisée dans la vue footer.php et administration.php (et toutes les autres vues où on a besoin de savoir si l'admin est connecté ou pas)
	'error' => $error, // La variable $error est utilisée dans la vue identification.php 
	);
	
	// Chargement des views à afficher (attention à l'ordre) (les views sont dans le dossiers /system/application/views )	
	//$this->load->view('layout/header',$data);	
	$this->load->view('administration/identification',$data);
	//$this->load->view('layout/footer',$data);	
	}
	function utilisateur(){
	
	// Chargement des models utilisés dans le controller (les models sont dans le dossiers /system/application/models )
	$this->load->model('Model_administration');	
	
	/*
	|----------------------------------------------------------------------------------------------------
	| Bouton de Déconnexion (voir vue footer.php) qui met la variable $session = FALSE (cad non connecté)			
	|----------------------------------------------------------------------------------------------------
	*/
	$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connecté) ou $session=FALSE (admin est pas connecté)
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
	
	// Tableau $data des variables à envoyer aux vues			
	$data = array(
	'connecte' => $session, // La variable $connecte est utilisée dans la vue footer.php et administration.php (et toutes les autres vues où on a besoin de savoir si l'admin est connecté ou pas)
	'error' => $error,
	);
	
	// Chargement des views à afficher (attention à l'ordre) (les views sont dans le dossiers /system/application/views )	
	$this->load->view('layout/header',$data);	
	$this->load->view('administration/utilisateur',$data);
	$this->load->view('layout/footer',$data);	
	}
	}
	?>
		