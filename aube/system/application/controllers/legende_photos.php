<?php
	
	class Legende_photos extends Controller {
		
		function index(){	
			
		}
		
		function photos($id = NULL){
			
			// Chargement des models utilisés dans le controller (les models sont dans le dossiers /system/application/models )
			$this->load->model('Model_legende_photos');	
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
			
			//Initialisation des variables (utile si aucun id est spécifié)
			$donnees = NULL;
			$photos = NULL;
			
			if($id!=NULL){
				$donnees=$this->Model_legende_photos->infos($id);
				foreach($donnees as $donnee){
				$armorials=$this->Model_legende_photos->armorial($donnee->vedette_chandon);
				$id=$this->Model_legende_photos->fiche($donnee->vedette_chandon);
				}
				}
				
				// Tableau $data des variables à envoyer aux vues			
				$data = array(
				'donnees' => $donnees, 
				'armorials' => $armorials,
				'id'=> $id,
				'connecte' => $session
				);
				
				// Chargement des views à afficher (attention à l'ordre) (les views sont dans le dossiers /system/application/views )	
				$this->load->view('layout/header',$data);	
				$this->load->view('legende_photos',$data);
				$this->load->view('layout/footer',$data);	
				
				}
				
				}
				?>
								