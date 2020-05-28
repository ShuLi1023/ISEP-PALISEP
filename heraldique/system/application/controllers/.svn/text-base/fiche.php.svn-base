<?php

class Fiche extends Controller {

	function index(){

		
	}
	
	function armorial($id=NULL){

// Chargement des models utilisés dans le controller (les models sont dans le dossiers /system/application/models )
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

		//Initialisation des variables (utile si aucun id est spécifié)
		$donnees = NULL;
		$photos = NULL;

		if($id!=NULL){
			$donnees=$this->Model_fiche->fiche($id);
			foreach($donnees as $donnee){
				$photos=$this->Model_fiche->photo($donnee->patronyme);
				$genealogies=$this->Model_fiche->genealogie($donnee->id);
			}
		}
		
	// Tableau $data des variables à envoyer aux vues			
		$data = array(
			'donnees' => $donnees, 
			'photos' => $photos,
			'genealogies' => $genealogies,
			'connecte' => $session,
		);
	
// Chargement des views à afficher (attention à l'ordre) (les views sont dans le dossiers /system/application/views )	
		$this->load->view('layout/header',$data);	
		$this->load->view('fiche',$data);
		$this->load->view('layout/footer',$data);	
		
	}
}

?>
