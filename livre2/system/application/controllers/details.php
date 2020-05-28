<?php

class Details extends Controller {

	function index(){	
		
	}
	
	function photos($id = NULL){

// Chargement des models utilisés dans le controller (les models sont dans le dossiers /system/application/models )
	$this->load->model('Model_details');
	$this->load->model('Model_administration');	
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

			$donnees=$this->Model_details->infos($id);
			foreach($donnees as $donnee){
				$armorials=$this->Model_details->armorial($donnee->patronyme);
				$id=$this->Model_details->fiche($donnee->patronyme);
			}
		}

$partenaires = $this->Model_administration->get_partenaires();
$presentation_livre2=$this->Model_administration->get_presentation_text();

// Tableau $data des variables à envoyer aux vues			
		$data = array(
			'donnees' => $donnees, 
			'armorials' => $armorials,
			'id'=> $id,
			'connecte' => $session,
			'partenaires'=> $partenaires,
			'presentation_livre2'=> $presentation_livre2
		);
	
// Chargement des views à afficher (attention à l'ordre) (les views sont dans le dossiers /system/application/views )	
		$this->load->view('layout/header',$data);	
		$this->load->view('details',$data);
		$this->load->view('layout/footer',$data);	
		
	}

}
?>
