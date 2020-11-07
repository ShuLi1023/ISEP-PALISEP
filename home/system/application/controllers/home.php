<?php
  
   class home extends Controller { 
	
      public function index() { 

       $this->load->model('Model_texthome');  

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
          'armorial' => $armorial,
          'livre' => $livre,
          'heraldique' => $heraldique,
          'biblio' => $biblio
       );
       $this->load->view('home', $data);
      }

   }
?>