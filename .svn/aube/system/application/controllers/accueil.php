<?php

class Accueil extends Controller {

	
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
			//$session = True ;
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

	$photos=$this->Model_recherche->photo_liste(); 
// Tableau $data des variables à envoyer aux vues			
		$data = array(
			'connecte' => $session, // La variable $connecte est utilisé dans la vue footer.php 
			'photos' => $photos
		);
		
// Chargement des views à afficher (attention à l'ordre) (les views sont dans le dossiers /system/application/views )	
		$this->load->view('layout/header',$data);	
		$this->load->view('accueil',$data);
		$this->load->view('layout/footer',$data);	
		
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
?>
