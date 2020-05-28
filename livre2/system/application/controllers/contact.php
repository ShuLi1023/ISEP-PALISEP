<?php
class Contact extends Controller {

    function index(){

        $session = $this->session->userdata('logged_in');
        $this->load->model('Model_administration');

        $contact = "";

        if(isset ($_POST['contact'])){

            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            $description = $_POST['description'];
            
            if($nom=="" && $email=="" && $description==""){ //On vérifie que les champs obligatoires sont remplis
                $contact = "Veuillez compléter tous les champs obligatoires!";
            }
            else{
                //On vérifie que les champs sont au bon format
                if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)){ //On vérifie l'adresse mail

                    if(preg_match('#[0-9]{10}#',$tel) && $tel!="" || $tel==""){ //On vérifie le numéro de téléphone

                        $mail = $this->Model_administration->getMail();
                        foreach ($mail as $row)
			{
				$mail = $row-> mail;
			}
                        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
                        {
                            $passage_ligne = "\r\n";
                        }
                        else
                        {
                            $passage_ligne = "\n";
                        }
                        //=====Déclaration des messages au format texte et au format HTML.
                        $message_html = "<html><head></head><body>
                            <b>Demande de contact envoyée par: </b>".
                            $nom."<br />
                            <b>Adresse mail: </b>".$email."<br />";

                        if($tel!=""){
                            $message_html.="<b>Téléphone: </b>".$tel."<br /><br />";
                        }

                        $message_html.="<b>Contenu : </b><br /><br />
                            ".nl2br($description)."</body></html>";
                        //==========

                        //=====Création de la boundary.
                        $boundary = "-----=".md5(rand());
                        $boundary_alt = "-----=".md5(rand());
                        //==========

                        //=====Définition du sujet.
                        $sujet = "[Demande de contact]".$nom;
                        //=========

                        //=====Création du header de l'e-mail.
                        $header = "From: \"Palisep\"<admin@palisep.fr>".$passage_ligne;
                        $header.= "Reply-to: \"WeaponsB\" <admin@palisep.fr>".$passage_ligne;
                        $header.= "MIME-Version: 1.0".$passage_ligne;
                        $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
                        //==========

                        //=====Création du message.
                        $message = $passage_ligne."--".$boundary.$passage_ligne;
                        $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
                        $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

                        //=====Ajout du message au format HTML.
                        $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
                        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
                        $message.= $passage_ligne.$message_html.$passage_ligne;
                        //==========

                        //=====On ferme la boundary alternative.
                        $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
                        //==========

                        $message.= $passage_ligne."--".$boundary.$passage_ligne;

                        //=====Envoi de l'e-mail.
                        mail($mail,$sujet,$message,$header);
                        //==========

                        $contact = "Votre demande a été envoyée";

                    }
                    else{
                        $contact = "Le numéro de téléphone n'est pas au bon format";
                    }
                }
                else{
                    $contact = "l'adresse email n'est pas au bon format!";
                }

            }

        }

        $partenaires = $this->Model_administration->get_partenaires();
        $presentation_livre2=$this->Model_administration->get_presentation_text();

        $data = array(
            'connecte' => $session, // La variable $connecte est utilis� dans la vue footer.php
            'contact' => $contact,
            'partenaires'=> $partenaires,
            'presentation_livre2'=> $presentation_livre2
        );


        $this->load->view('layout/header', $data);
        $this->load->view('contact');
        $this->load->view('layout/footer', $data);
    }
    
}
?>
