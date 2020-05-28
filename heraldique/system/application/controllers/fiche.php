<?php
	
	class Fiche extends Controller {
		
		function index(){
			
			
		}
		
		function armorial($id=NULL){
			
			// Chargement des modèles utilisés dans le contrôleur (les modèles sont dans le dossier /system/application/models)
			$this->load->model('Model_fiche');	
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Bouton de Déconnexion qui met la variable $session = FALSE (càd non connecté)			
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
				
				header("Location: ".base_url()); 	// Redirection sur l'identification		
			}
			/*
				|----------------------------------------------------------------------------------------------------
			*/		
			
			// Initialisation des variables (utile si aucun id est spécifié)
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
			
			// Chargement des vues à afficher (attention à l'ordre) (les vues sont dans le dossier /system/application/view)	
			$this->load->view('layout/header',$data);	
			$this->load->view('fiche',$data);
			$this->load->view('layout/footer',$data);	
			
		}
	}
	
?>
