<?php
  
   class admin extends Controller { 

         function identification (){

// Chargement des models utilisés dans le controller (les models sont dans le dossiers /system/application/models )
      $this->load->model('Model_administration');  
   
      /*
      |----------------------------------------------------------------------------------------------------
      | Bouton de Déconnexion (voir vue footer.php) qui met la variable $session = FALSE (cad non connecté)       
      |----------------------------------------------------------------------------------------------------
      */
         $session = $this->session->userdata('logged_in');  // $session=TRUE (admin est connecté) ou $session=FALSE (admin est pas connecté)
         if (isset($_POST['deconnexion']) && $_POST['deconnexion'] == 'Deconnexion') {
            $newdata = array(
               'logged_in' => FALSE
            );
            $this->session->set_userdata($newdata); 
            $session = $this->session->userdata('logged_in');  // $session = FALSE
            header("Location: ".base_url());    //redirection sur l'accueil      
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
      $identifiants = $this->Model_administration->identifiant();    // $identifiants : tous les identifiants enregistrés dans la bdd  
      //Initialisation des variables                     
      $newdata = array( // Variable de session (par défaut l'admin est pas connecté donc FALSE)
         'logged_in' => FALSE
      );
      $this->session->set_userdata($newdata);   
         
         if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') { // on vérifie que le formulaire a été envoyé
            if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) {
               foreach ($identifiants as $identifiant) { // on compare les identifiants envoyés avec ceux de la bdd
                  if (($identifiant->login == $_POST['login'] ) &&  ($identifiant->password == $_POST['pass'])) { // si les identifiants sont correctes, la variable de session logged_in passe à TRUE
                     $newdata = array(
                        'logged_in' => TRUE
                     );
                     $this->session->set_userdata($newdata); 
                     $session = $this->session->userdata('logged_in'); // $session = TRUE (l'admin est connecté)
                     header("Location: admin"); // redirection vers la page d'administration
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
      $this->load->view('identification',$data);
      //$this->load->view('layout/footer',$data);  
   }



      public function index() { 

         $this->load->model('Model_texthome');  

         $session = $this->session->userdata('logged_in');  // $session=TRUE (admin est connecté) ou $session=FALSE (admin est pas connecté)


         if($session == true){


            if (isset($_POST['deconnexion']) && $_POST['deconnexion'] == 'Deconnexion') {
               $newdata = array(
                  'logged_in' => FALSE,
                  'statut' => NULL
               );
               $this->session->set_userdata($newdata);
               $session = false;  // $session = FALSE

               header("Location: ".base_url());    //redirection sur l'accueil
            }


            /* Load form helper */ 
            $this->load->helper(array('form'));
            
            /* Load form validation library */ 
            $this->load->library('form_validation');
            
            /* Set validation rule for name field in the form */ 
           // $this->form_validation->set_rules('name', 'Name', 'required'); 
            
            if ($this->form_validation->run() == FALSE) { 

               $textHome = $this->Model_texthome->getTextHome();
               $armorial = "";
               $livre = "";
               $heraldique = "";
               $biblio = "";

               foreach ($textHome as $text) {

                   if ($text->name == 'armorial') {
                     $armorial = $text->description;
                   } else if ($text->name == 'livre') {
                     $livre = $text->description;
                   } else if ($text->name == 'heraldique') {
                     $heraldique = $text->description;
                   } else if ($text->name == 'biblio') {
                     $biblio = $text->description;
                   }
               }
               $data = array(
                  'connecte' => $session, 
                  'armorial' => $armorial,
                  'livre' => $livre,
                  'heraldique' => $heraldique,
                  'biblio' => $biblio
               );
               $this->load->view('admin', $data);

               if (isset($_POST['validateModifs']) && $_POST['validateModifs'] == 'Valider') {
                   if (isset($_POST['armorial']) && htmlentities($_POST['armorial']) != $armorial) {
                     $this->Model_texthome->updateText('armorial', str_replace("'", "\'", htmlentities($_POST['armorial'])));
                  }
                  if (isset($_POST['livre']) && htmlentities($_POST['livre']) != $livre) {
                     $this->Model_texthome->updateText('livre', str_replace("'", "\'", htmlentities($_POST['livre'])));
                  }
                  if (isset($_POST['heraldique']) && htmlentities($_POST['heraldique']) != $heraldique) {
                     $this->Model_texthome->updateText('heraldique', str_replace("'", "\'", htmlentities($_POST['heraldique'])));
                  }
                  if (isset($_POST['biblio']) && htmlentities($_POST['biblio']) != $biblio) {
                     $this->Model_texthome->updateText('biblio', str_replace("'", "\'", htmlentities($_POST['biblio'])));
                  }
                  redirect('', 'refresh'); 
               } 

            } 
            else { 
               $this->load->view('adminsucc'); 
            } 
         } else {
            $this->identification();
 
         }
      }

   }
?>