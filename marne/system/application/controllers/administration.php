<?php
class Administration extends Controller {
	
	function index(){
		
		set_time_limit(0); //On supprime la limite d'ex�cution du script pour qu'il ne s'arrete pas en plein mileu
		
// Chargement des models utilis�s dans le controller (les models sont dans le dossiers /system/application/models )
		$this->load->model('Model_administration');	
		$this->load->model('Model_recherche');

		$this->load->library('pagination'); //Chargement de la librarie de pagination
		/*
		|----------------------------------------------------------------------------------------------------
		| Bouton de D�connexion qui met la variable $session = FALSE (cad non connect�)			
		|----------------------------------------------------------------------------------------------------
		*/
			$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connect�) ou $session=FALSE (admin est pas connect�)
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

		/*
		|---------------------------------------------------------------------------------------------------
		| Traitement pour le changement des codes d'acc�s
		|---------------------------------------------------------------------------------------------------
		*/
			$acces = "";
			
			$identifiants = $this->Model_administration->identifiant();
			
			foreach ($identifiants as $row)
			{
				$login = $row->login;
				$mdp = $row-> password;
			}
						
			if(isset($_POST['login']) && isset($_POST['mdp_actuel'])) //Lorsqu'on a rempli le 1er formulaire (avec les identifiants actuels)
			{
				if($_POST['login']=='' || $_POST['mdp_actuel']=='')
				{
					$acces = "Veuillez remplir toutes les cases!"; 
				}
				else
				{
					if($_POST['login']==$login && $_POST['mdp_actuel']==$mdp)
						$acces = "true";
					else
						$acces = "Les identifiants sont incorrects";
				}
			}
			else if(isset($_POST['new_mdp']) && isset($_POST['new_mdp_bis'])) //Lorsqu'on a rempli le 2e formulaire (avec le nouveau mot de passe)
			{
				if($_POST['new_mdp']=='' || $_POST['new_mdp_bis']=='')
				{
					$acces = "Veuillez remplir toutes les cases!"; 
				}
				else
				{
					if($_POST['new_mdp']!=$_POST['new_mdp_bis'])
						$acces = "Les deux ne correspondent pas!";
					else
					{
						$mdp = $_POST['new_mdp'];
						$this->Model_administration->modif_mdp($mdp);
						
						$acces = "Le mot de passe a bien &eacute;t&eacute; chang&eacute;!";
					}
				}
			}
		
		/*
		|----------------------------------------------------------------------------------------------------
		*/
		
		/*
		|---------------------------------------------------------------------------------------------------
		| Traitement des fichiers upload�s
		|---------------------------------------------------------------------------------------------------
		*/
			$transfert = "";
			$nom = "";
			
			
			if(isset($_FILES['mediatheque'])) //Si on upload un fichier pour la m�diatheque
			{
				if($_FILES['mediatheque']['name']=="")
				{
					$transfert = "Vous n'avez choisi aucun fichier!";
				}
				else
				{
					$resultat = $this->xls_csv('mediatheque'); //On cr�e un fichier csv a partir du fichier upload�
					$transfert = $resultat['transfert'];
					$nom = $resultat['nom'];
					$liste = utf8_encode('libell�_image,vedette_chandon,auteur_clich�,type_clich�,ann�e_clich�,commune,village,edifice_conservation,emplacement_dans_�difice,photo,commune_INSEE_number,ref_IM,ref_PA,ref_IA,artificial_number_Decrock,famille,individu,qualit�,date,titre,auteurs,lieu_�dition,editeur,ann�e_�dition,reliure,provenance,site,section,cote,folio_emplacement,@vide,d�nomination,cat�gorie,mat�riau,ref_reproductions,biblio,remarques,cl_�_refaire');
					$this->Model_administration->mise_a_jour($_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$nom,'legende_photos',$liste); //On insert les infos contenues ds le fichier xls dans la bdd
				
					//Suppression des fichiers excel upload�s
					$repertoire = opendir($_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/');
					$fichier_csv = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$nom;
					$fichier_xls = explode('.',$nom);
					$fichier_xls = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$fichier_xls[0].'.xls';
					unlink($fichier_csv);
					unlink($fichier_xls);
					closedir($repertoire);
				}
			}
			else if(isset($_FILES['not_mediatheque'])) //Si on upload un fichier pour la m�diatheque
			{
				if($_FILES['not_mediatheque']['name']=="")
				{
					$transfert = "Vous n'avez choisi aucun fichier!";
				}
				else
				{
					$resultat = $this->xls_csv('not_mediatheque'); //On cr�e un fichier csv a partir du fichier upload�
					$transfert = $resultat['transfert'];
					$nom = $resultat['nom'];
					$liste = utf8_encode('libell�_image,vedette_chandon,auteur_clich�,@vide,type_clich�,ann�e_clich�,commune,village,edifice_conservation,emplacement_dans_�difice,photo,commune_INSEE_number,ref_IM,ref_PA,ref_IA,artificial_number_Decrock,famille,individu,qualit�,date,d�nomination,titre,cat�gorie,mat�riau,@vide,ref_reproductions,biblio,remarques');
					$this->Model_administration->mise_a_jour($_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$nom,'legende_photos',$liste); //On insert les infos contenues ds le fichier xls dans la bdd
				
					//Suppression des fichiers excel upload�s
					$repertoire = opendir($_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/');
					$fichier_csv = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$nom;
					$fichier_xls = explode('.',$nom);
					$fichier_xls = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$fichier_xls[0].'.xls';
					unlink($fichier_csv);
					unlink($fichier_xls);
					closedir($repertoire);
				}
			}
			else if(isset($_FILES['familles'])) //Si on upload un fichier pour les familles
			{
				if($_FILES['familles']['name']=="")
				{
					$transfert = "Vous n'avez choisi aucun fichier!";
				}
				else
				{
					$resultat = $this->xls_csv('familles'); //On cr�e un fichier csv a partir du fichier upload�
					$transfert = $resultat['transfert'];
					$nom = $resultat['nom'];
					$liste = 'patronyme,ville,province,prenom,titres_dignites,date,siècle,sources,observations,genealogie,document,blasonnement_1,timbre,cimier,devise_cri,tenants_support,decoration,ornements_ext,emblemes,images_geneal,images_doc';
					$this->Model_administration->mise_a_jour($_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$nom,'armorial',$liste); //On insert les infos contenues ds le fichier xls dans la bdd
					$this->Model_administration->blasonnement();
				
					//Suppression des fichiers
					$repertoire = opendir($_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/');
					$fichier_csv = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$nom;
					$fichier_xls = explode('.',$nom);
					$fichier_xls = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$fichier_xls[0].'.xls';
					unlink($fichier_csv);
					unlink($fichier_xls);
					closedir($repertoire);
				}
			}
			else if(isset($_FILES['images'])) //Si on upload un fichier pour les images
			{
				if($_FILES['images']['name']=="")
				{
					$transfert = "Vous n'avez choisi aucun fichier!";
				}
				else
				{
					$transfert = $this->insertion_images();
					$transfert = $this->compression();
				}
			}
	
		/*
		|---------------------------------------------------------------------------------------------------------
		*/
		
		/*
		|---------------------------------------------------------------------------------------------------
		| Traitement pour l'affichage de la partie modification des donn�es de la base
		|---------------------------------------------------------------------------------------------------
		*/
		
			$requete_armorial = $this->db->get('armorial'); //requete pour r�cup�rer ttes les donn�es de la table 'armorial'
			$requete_photos = $this->db->get('legende_photos');
			
			$config['base_url'] = base_url()."administration/index/page_armorial";
			$config['uri_segment'] = 4;
			$config['total_rows'] = $requete_armorial->num_rows();
			$config['per_page'] = '50'; 
			$config['num_links'] = 20;
			$config['first_link'] = "<<";
			$config['last_link'] = ">>";
		
			$this->pagination->initialize($config); 
			
			// Passer par $php4var est important car le serveur sur ovh est en 4.4.9, et sans �a �a marche pas.
			$php4var=$this->db->get('armorial',$config['per_page'],$this->uri->segment(4));
			$donnees_armorial = $php4var->result_array();
			$pages_armorial = $this->pagination->create_links();
			
			$config['base_url'] = base_url()."administration/index/page_photos";
			$config['uri_segment'] = 4;
			$config['total_rows'] = $requete_photos->num_rows();
			$config['per_page'] = '50'; 
			$config['num_links'] = 20;
			$config['first_link'] = "<<";
			$config['last_link'] = ">>";
			
			$this->pagination->initialize($config); 
			
			$php4var2 = $this->db->get('legende_photos',$config['per_page'],$this->uri->segment(4));
			$donnees_photos = $php4var2->result_array();
			$pages_photos = $this->pagination->create_links();
		
		/*
		|---------------------------------------------------------------------------------------------------------
		*/
		
		

// Tableau $data des variables � envoyer aux vues			
		$data = array(
			'connecte' => $session, // La variable $connecte est utilis� dans la vue footer.php
			'acces' => $acces,			
			'transfert' => $transfert,
			'donnees_armorial' => $donnees_armorial,
			'donnees_photos' => $donnees_photos,
			'pages_armorial' => $pages_armorial,
			'pages_photos' => $pages_photos
		);

// Chargement des views � afficher (attention � l'ordre) (les views sont dans le dossiers /system/application/views )	
		$this->load->view('layout/header',$data);	
		$this->load->view('administration/administration',$data);
		$this->load->view('layout/footer',$data);	
		
	}

	function identification (){

// Chargement des models utilis�s dans le controller (les models sont dans le dossiers /system/application/models )
		$this->load->model('Model_administration');	
	
		/*
		|----------------------------------------------------------------------------------------------------
		| Bouton de D�connexion (voir vue footer.php) qui met la variable $session = FALSE (cad non connect�)			
		|----------------------------------------------------------------------------------------------------
		*/
			$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connect�) ou $session=FALSE (admin est pas connect�)
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
		/*
		|----------------------------------------------------------------------------------------------------
		| Formulaire de Connexion (voir vue identification.php) qui met la variable $session = TRUE (cad connect�)			
		|----------------------------------------------------------------------------------------------------
		*/	
		$error= NULL; // $error contiendra le message d'erreur d'identification 	
		$identifiants = $this->Model_administration->identifiant();		// $identifiants : tous les identifiants enregistr�s dans la bdd 	
		//Initialisation des variables							
		$newdata = array( // Variable de session (par d�faut l'admin est pas connect� donc FALSE)
			'logged_in' => FALSE,
			'statut' => NULL
		);
		$this->session->set_userdata($newdata);	
			
			if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') { // on v�rifie que le formulaire a �t� envoy�
				if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) {
					foreach ($identifiants as $identifiant) {	// on compare les identifiants envoy�s avec ceux de la bdd
						if (($identifiant->login == $_POST['login'] ) && ($identifiant->password == $_POST['pass'])) { // si les identifiants sont correctes, la variable de session logged_in passe � TRUE
							$newdata = array(
							   'logged_in' => TRUE,
							   'statut' => $identifiant->statut, 
						   );
							$this->session->set_userdata($newdata); 
							$session = $this->session->userdata('logged_in'); // $session = TRUE (l'admin est connect�)
							header("Location: ".base_url()); // redirection vers la page d'administration
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
			
// Tableau $data des variables � envoyer aux vues			
		$data = array(
			'connecte' => $session, // La variable $connecte est utilis�e dans la vue footer.php et administration.php (et toutes les autres vues o� on a besoin de savoir si l'admin est connect� ou pas)
			'error' => $error, // La variable $error est utilis�e dans la vue identification.php 
		);
		
// Chargement des views � afficher (attention � l'ordre) (les views sont dans le dossiers /system/application/views )	
		//$this->load->view('layout/header',$data);	
		$this->load->view('administration/identification',$data);
		//$this->load->view('layout/footer',$data);	
	}
function utilisateur(){

// Chargement des models utilis�s dans le controller (les models sont dans le dossiers /system/application/models )
		$this->load->model('Model_administration');	
	
		/*
		|----------------------------------------------------------------------------------------------------
		| Bouton de D�connexion (voir vue footer.php) qui met la variable $session = FALSE (cad non connect�)			
		|----------------------------------------------------------------------------------------------------
		*/
			$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connect�) ou $session=FALSE (admin est pas connect�)
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
	
		
// Tableau $data des variables � envoyer aux vues			
		$data = array(
			'connecte' => $session, // La variable $connecte est utilis�e dans la vue footer.php et administration.php (et toutes les autres vues o� on a besoin de savoir si l'admin est connect� ou pas)
			'error' => $error,
			'transfert' => $transfert,
		);
		
// Chargement des views � afficher (attention � l'ordre) (les views sont dans le dossiers /system/application/views )	
		$this->load->view('layout/header',$data);	
		$this->load->view('administration/utilisateur',$data);
		$this->load->view('layout/footer',$data);	
	}
	
function xls_csv($index)
{
	$transfert = "";
	$nom = "";
			
			
				if ($_FILES[$index]['error'] > 0)
				{
					$transfert =  "Erreur lors du transfert";
				}
				else
				{
					$extension_upload = strtolower(  substr(  strrchr($_FILES[$index]['name'], '.')  ,1)  );
					if($extension_upload!='xls')
					{
						$transfert = "Le fichier n'est pas au format excel";
					}
					else
					{
						$nom = $_SERVER['DOCUMENT_ROOT']."/fichiers_tmp/".$_FILES[$index]['name'];
						$resultat = move_uploaded_file($_FILES[$index]['tmp_name'],$nom);
						
						if($resultat)
						{
							$transfert = htmlentities("Transfert r�ussi");
							
							Include($_SERVER['DOCUMENT_ROOT'].'/../Excel/reader.php'); //Inclusion de la bliblio de traitemt de fichiers excel

							$donnees = "";
 
							// Instanciation de la class permettant la lecture du fichier excel
							$data = new Spreadsheet_Excel_Reader();
 
							// D�finition du type d�encodage de caract�re � utiliser pour la sortie (ce qui va �tre affich� � l��cran)
							//$data->setOutputEncoding('UTF-8');
 
							// Chargement du fichier excel � lire
							$data->read($nom);
 
							error_reporting(0);
 
							// Parse l�int�gralit� du fichier excel
							for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
								for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
									$donnees.=$data->sheets[0]['cells'][$i][$j]."\t";
								}
								$donnees.="\r";
							}

							//utf8_encode($donnees);
							
							$nom = explode(".",$_FILES[$index]['name']);
							$nom_csv = $nom[0].".csv";
							$nom = $_SERVER['DOCUMENT_ROOT']."/fichiers_tmp/".$nom_csv;

							$fichier = fopen($nom,"w+");
							fputs($fichier,$donnees);
							fclose($fichier);
							
							$transfert = "Mise a jour reussie!";
						}
						else 
						{
							$transfert = "Echec du transfert";
						}
					}
				}
			
	
	$data = array(
				'transfert' => $transfert,
				'nom' => $nom_csv,
				);
	
	return $data;
}

function insertion_images() //Fonction qui enregistre les images ds le dossier temporaire
{
	$transfert = "";
	
		if ($_FILES['images']['error'] > 0)
		{
			$transfert =  "Erreur lors du transfert";
		}
		else
		{
			$extension_upload = strtolower(  substr(  strrchr($_FILES['images']['name'], '.')  ,1)  );
			if($extension_upload!='jpg' && $extension_upload!='JPG' && $extension_upload!='jpeg' && $extension_upload!='JPEG' && $extension_upload!='zip')
			{
				$transfert = "Le fichier n'est pas au bon format";
			}
			else
			{
				//On copie le fichier
				$nom = $_SERVER['DOCUMENT_ROOT']."/fichiers_tmp/".$_FILES['images']['name'];
				$resultat = move_uploaded_file($_FILES['images']['tmp_name'],$nom);
				
				if($extension_upload=='zip') //Si c'est une archive
				{
					require_once( $_SERVER['DOCUMENT_ROOT'].'/../system/libraries/pclzip.lib.php');
					$archive = new PclZip($nom); //on cr�e un nouvel objet archive a partir su fichier upload�
					
					if ($archive->extract($_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/') == 0) //on extrait ds le dossier sp�cifi�
					{
						die("Error : ".$archive->errorInfo(true));
					}
					else //Si l'extraction c'est bien pass�e
					{
						$dirname = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'; 
						$dir = opendir($dirname); //On ouvre le dossier des fichiers temporaires
						unlink($nom); //On supprime l'archive
						
						$dossier = explode(".",$_FILES['images']['name']);
						$dossier = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$dossier[0].'/'; 
						$dir = opendir($dossier); //On ouvre le dossier issu de l'extraction
						
						while($file = readdir($dir)) 
						{
							if($file != '.' && $file != '..' && !is_dir($dossier.$file))
							{
								copy($dossier.$file, $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$file); //On d�place tous les fichiers
								unlink($dossier.$file); //On les supprime du dossier
							}
						}
						
						rmdir($dossier); //On supprime le dossier issu de l'extraction
						
						closedir($dir);
					}
				}
				
			}
		}
	
	return $transfert;
}

function compression() //Fonction qui compresse les images du dossier temporaire et les d�place ds le fichier "images"
{
	$this->load->library('image_lib'); //On charge les fonctions image de CodeIgniter
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	$dirname = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/';
	$dir = opendir($dirname); //On ouvre le dossier temporaire
	
	$transfert = "";
	
	while($file = readdir($dir)) //On parcourt les fichiers
	{
		if($file != '.' && $file != '..' && !is_dir($dirname.$file))
		{
			$titre = explode(".",$file);
			
			//On configure les param�tres pour la compression
			$config['image_library'] = 'GD';
			$config['source_image'] = $dirname.$file; //Le fichier source
			$config['quality'] = '75%'; //La qualit� du fichier apr�s compression
			$config['new_image'] = $_SERVER['DOCUMENT_ROOT'].'/ressources/images/'.$titre[0].".jpg"; //Le nouveau fichier
			
			$this->image_lib->initialize($config); 
			$this->image_lib->resize(); //On lance la compression
			if ( ! $this->image_lib->resize())
			
				$transfert = "Une erreur s'est produite!";
			else
				$transfert = "Photo(s) charg&eacute;e(s)";
			
			unlink($dirname.$file); //On supprime les images du dossier temporaire
		}
	}
	return $transfert;
}

}
?>
