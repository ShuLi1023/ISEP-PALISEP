<?php
  
   class admin extends Controller { 
	
      public function index() { 
         /* Load form helper */ 
         $this->load->helper(array('form'));
			
         /* Load form validation library */ 
         $this->load->library('form_validation');
			
         /* Set validation rule for name field in the form */ 
        // $this->form_validation->set_rules('name', 'Name', 'required'); 
			
         if ($this->form_validation->run() == FALSE) { 
         $this->load->view('admin'); 
         } 
         else { 
            $this->load->view('adminsucc'); 
         } 
      }
   }
?>