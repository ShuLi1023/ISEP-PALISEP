<?php
	
	class Accueil extends Controller {
		
		
		function index(){
			
			// Chargement des modèles utilisés dans le contrôleur (les modèles sont dans le dossier /system/application/models)
			$this->load->model('Model_recherche');			
			$this->load->model('Model_fiche');		
			$this->load->model('Model_administration');		
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Bouton de déconnexion qui met la variable $session = FALSE (càd non connecté)			
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
				
				header("Location: ".base_url()); 	// Redirection sur la page d'identification		
			}
			/*
				|----------------------------------------------------------------------------------------------------
			*/		
			
			$photos=$this->Model_recherche->photo_liste(); 
			$presentation_europe=$this->Model_administration->get_presentation_text();
			
			// Tableau $data des variables à envoyer aux vues			
			$data = array(
			'connecte' => $session, // La variable $connecte est utilisée dans la vue footer.php 
			'photos' => $photos,
            'presentation_europe'=> $presentation_europe
			);
			
			// Chargement des vues à afficher (attention à l'ordre) (les vues sont dans le dossier /system/application/views)	
			$this->load->view('layout/header',$data);	
			$this->load->view('accueil',$data);
			$this->load->view('layout/footer',$data);	
			
		}
	}
	
	/* End of file welcome.php */
	/* Location: ./system/application/controllers/welcome.php */
?>
