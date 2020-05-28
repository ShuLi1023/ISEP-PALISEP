<?php
	error_reporting(0);
	
	class Administration extends Controller {
		
		function index(){
			
			// Chargement des modèles utilisés dans le contrôleur (les modèles sont dans le dossier /system/application/models)
			$this->load->model('Model_administration');
			$idr = "";
			/*
				|---------------------------------------------------------------------------------------------------
				| Traitement de l'update de la présentation
				|---------------------------------------------------------------------------------------------------
			*/
			
			if(isset($_POST['update_presentation']) && !empty($_POST['update_presentation'])){
				$new_presentation = htmlentities($_POST['update_presentation'], ENT_QUOTES);
				
				$this->Model_administration->update_presentation($new_presentation);
			}
			$presentation_europe=$this->Model_administration->get_presentation_text();
			
			/*
				|---------------------------------------------------------------------------------------------------------
			*/
			
			
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Bouton de déconnexion qui met la variable $session = FALSE (càd non connecté)			
				|----------------------------------------------------------------------------------------------------
			*/
			$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connecté) ou $session=FALSE (admin est pas connecté)
			if (isset($_POST['deconnexion']) && $_POST['deconnexion'] == 'Deconnexion') {
				$newdata = array(
				'logged_in'	=> FALSE,
				'connecte'	=> FALSE,
				'statut'	=> NULL
				);
				$this->session->set_userdata($newdata);
				$session = $this->session->userdata('logged_in');	// $session = FALSE
				
				header("Location: ".base_url()); 	// Redirection sur l'accueil		
			}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			
			/*
				|---------------------------------------------------------------------------------------------------
				| Traitement des fichiers uploadés
				|---------------------------------------------------------------------------------------------------
			*/
			$transfert = "";
			$nom = "";
            $index = "";
			if(isset($_FILES['mediatheque'])){
				$index = 'mediatheque';
				
				
				if($_FILES[$index]['name']==""){
					echo "KO";
					$transfert = "Vous n'avez choisi aucun fichier!";
				}
				else{
					echo "OK2";
					$resultat = $this->xls_csv($index); // On crée un fichier csv a partir du fichier uploadé
					$transfert = $resultat['transfert'];
					$nom = $resultat['name'];
					echo $nom;
					$liste = 'prenom, famille, titres_dignites, origine, siÃ¨cle, fief, pays, province, région, département, ville, alliances, notes, observations, sources, genealogie, document, cimier, devise_cri, blasonnement_1';
					$this->Model_administration->mise_a_jour($_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$nom,'armorial',$liste); // On insert les infos contenues dans le fichier xls dans la bdd
					// Suppression des fichiers excel uploadés
					$repertoire = opendir($_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/');
					$fichier_csv = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$nom;
					$fichier_xls = explode('.',$nom);
					$fichier_xls = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$fichier_xls[0].'.xls';
					unlink($fichier_csv);
					unlink($fichier_xls);
					closedir($repertoire);
				}
			}
			else if(isset($_FILES['images_1']) || isset($_FILES['images_2']) || isset($_FILES['images_3']) || isset($_FILES['images_4'])
			|| isset($_FILES['images_5']) || isset($_FILES['images_6']) || isset($_FILES['images_7']) || isset($_FILES['images_7'])
			|| isset($_FILES['images_8']) || isset($_FILES['images_9']) || isset($_FILES['images_10'])) // Si on uploade un fichier pour les images
			{
				$transfert = $this->insertion_images();
				$transfert = $this->compression();
			}
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Recherche par ID 
				|----------------------------------------------------------------------------------------------------
			*/
			$idrecherche = "";
			$idtitre = ""; $idtitre2 = "";
			if(isset($_POST['recherche_id']) && $_POST['recherche_id']!=""){
				$recherche_id = $_POST['recherche_id'];
				$idr = $this->Model_administration->getid($_POST['recherche_id']);
				foreach ($idr as $row)
				{
					$idrecherche = $row-> id;
					$idtitre = $row-> patronyme; $idtitre2 = $row-> famille;
				}
			}		
			
			
			
			/*
				|---------------------------------------------------------------------------------------------------
				| Traitement pour l'ajout manuel d'un contenu
				|---------------------------------------------------------------------------------------------------
			*/
			$manuel = "";
			$booleen_manuel = "";
			
			if(isset($_POST['submit_ajout_manuel_blason'])){
				
				if($_POST['patronyme']=="" && $_POST['prenom']=="" &&
				$_POST['famille']=="" && $_POST['titres_dignites']=="" && $_POST['origine']=="" &&
				$_POST['date']=="" && $_POST['siecle']=="" && $_POST['fief']=="" &&
				$_POST['pays']=="" && $_POST['province']=="" && $_POST['region']=="" &&
				$_POST['department']=="" && $_POST['ville']=="" && $_POST['alliances']=="" &&
				$_POST['notes']=="" && $_POST['sources']=="" &&
				$_POST['notes_armoriaux']=="" && $_POST['genealogie']=="" && $_POST['bibliographie']=="" &&
				$_POST['document']=="" && $_POST['timbre']=="" && $_POST['cimier']=="" &&
				$_POST['devise_cri']=="" && $_POST['tenants_support']=="" && $_POST['decoration']=="" &&
				$_POST['ornements_ext']=="" && $_POST['emblemes']=="" && $_POST['images_geneal']=="" && $_POST['images_doc']=="" &&
				$_POST['blasonnement_1']=="" && $_POST['blasonnement_2']=="" && $_POST['blasonnement_3']==""
				){
					
					$manuel = "Veuillez remplir au moins une case!";
					$booleen_manuel = true;
					$_SESSION['anc_onglet'] = "blason";
					
					} else if($_POST['patronyme']==""){
					$manuel = "Le champ \"Patronyme\" n'est pas rempli !";
					$booleen_manuel = true;
					$_SESSION['anc_onglet'] = "blason";
				}
				else {
					
					
					$patronyme = $_POST['patronyme'];
					$prenom = $_POST['prenom'];
					$famille = $_POST['famille'];
					$titres_dignites = $_POST['titres_dignites'];
					$origine = $_POST['origine'];
					$date = $_POST['date'];
					$siecle = $_POST['siecle'];
					$fief = $_POST['fief'];
					$pays = $_POST['pays'];
					$province = $_POST['province'];
					$region = $_POST['region'];
					$department = $_POST['department'];
					$ville = $_POST['ville'];
					$alliances = $_POST['alliances'];
					$armoiries = "";
					$notes = $_POST['notes'];
					$observations = "";
					$sources = $_POST['sources'];
					$le_clert = "";
					$armorial_gen_champagne = "";
					$notes_armoriaux = $_POST['notes_armoriaux'];
					$genealogie = $_POST['genealogie'];
					$document = $_POST['document'];
					$timbre = $_POST['timbre'];
					$cimier = $_POST['cimier'];
					$devise_cri = $_POST['devise_cri'];
					$tenants_support = $_POST['tenants_support'];
					$decoration = $_POST['decoration'];
					$ornements_ext = $_POST['ornements_ext'];
					$emblemes = $_POST['emblemes'];
					$images_geneal = $_POST['images_geneal'];
					$images_doc = $_POST['images_doc'];
					$blasonnement_1 = $_POST['blasonnement_1'];
					$blasonnement_2 = $_POST['blasonnement_2'];
					$blasonnement_3 = $_POST['blasonnement_3'];
					
					
					$this->db->query("INSERT INTO armorial VALUES ('', '', '$patronyme', '$prenom', '$famille', '$titres_dignites', '$origine', 
					'$date', '$siecle', '$fief', '$pays', '$province', '$region', '$department', '$ville', '$alliances', '$armoiries', 
					'$notes', '$observations', '$sources', '$le_clert', '$armorial_gen_champagne', '$notes_armoriaux', '$genealogie', 
					'$document', '$timbre', '$cimier', '$devise_cri', '$tenants_support', '$decoration', '$ornements_ext', '$emblemes', 
					'$images_geneal', '$images_doc', '$blasonnement_1', '$blasonnement_2', '$blasonnement_3')");
					
					$manuel = "L'ajout d'armorial a bien été effectué. Vous pouvez maintenant lui ajouter des photos.";
					$booleen_manuel = true;
					$_SESSION['anc_onglet'] = "blason";
				}
			}
			
			if(isset($_POST['submit_ajout_manuel_image'])){
				
				if($_FILES['images_1']['name']=="" && $_POST['vedette_chandon']=="" && $_POST['auteur_cliche']=="" &&
				$_POST['type_cliche']=="" && $_POST['annee_cliche']=="" && $_POST['pays']=="" &&
				$_POST['region']=="" && $_POST['department']=="" && $_POST['commune']=="" &&
				$_POST['village']=="" && $_POST['edifice_conservation']=="" && $_POST['emplacement_dans_edifice']=="" &&
				$_POST['photo']=="" && $_POST['commune_INSEE_number']=="" && $_POST['ref_IM']=="" && $_POST['ref_PA']=="" &&
				$_POST['ref_IA']=="" && $_POST['famille']=="" && $_POST['individu']=="" &&
				$_POST['qualite']=="" && $_POST['date']=="" && $_POST['denomination']=="" && $_POST['titre']=="" &&
				$_POST['categorie']=="" && $_POST['materiau']=="" && $_POST['ref_reproductions']=="" &&
				$_POST['biblio']=="" && $_POST['remarques']=="" && $_POST['auteurs']=="" &&
				$_POST['lieu_edition']=="" && $_POST['editeur']=="" && $_POST['annee_edition']=="" && $_POST['reliure']=="" &&
				$_POST['provenance']=="" && $_POST['site']=="" && $_POST['section']==""  && $_POST['cote']==""  &&
				$_POST['folio_emplacement']==""  && $_POST['cimiers']=="" && $_POST['blasonnement_1']==""&& $_POST['blasonnement_2']==""
				){
					
					$manuel = "Veuillez remplir au moins une case!";
					$booleen_manuel = true;
					$_SESSION['anc_onglet'] = "image";
					
					} else if($_POST['vedette_chandon']==""){
					$manuel = "Le champ \"Patronyme\" n'est pas rempli !";
					$booleen_manuel = true;
					$_SESSION['anc_onglet'] = "image";
				}
				else {
					
					$libelle_image = $this->images_bdd();
					
					$vedette_chandon = $_POST['vedette_chandon'];
					$auteur_cliche = $_POST['auteur_cliche'];
					$type_cliche = $_POST['type_cliche'];
					$annee_cliche = $_POST['annee_cliche'];
					$pays = $_POST['pays'];
					$region = $_POST['region'];
					$department = $_POST['department'];
					$commune = $_POST['commune'];
					$village = $_POST['village'];
					$edifice_conservation = $_POST['edifice_conservation'];
					$emplacement_dans_edifice = $_POST['emplacement_dans_edifice'];
					$photo = $_POST['photo'];
					$commune_INSEE_number = $_POST['commune_INSEE_number'];
					$ref_IM = $_POST['ref_IM'];
					$ref_PA = $_POST['ref_PA'];
					$ref_IA = $_POST['ref_IA'];
					$artificial_number_Decrock = "";
					$famille = $_POST['famille'];
					$individu = $_POST['individu'];
					$qualite = $_POST['qualite'];
					$date = $_POST['date'];
					$denomination = $_POST['denomination'];
					$titre = $_POST['titre'];
					$categorie = $_POST['categorie'];
					$materiau = $_POST['materiau'];
					$ref_reproductions = $_POST['ref_reproductions'];
					$biblio = $_POST['biblio'];
					$remarques = $_POST['remarques'];
					$auteurs = $_POST['auteurs'];
					$lieu_edition = $_POST['lieu_edition'];
					$editeur = $_POST['editeur'];
					$annee_edition = $_POST['annee_edition'];
					$reliure = $_POST['reliure'];
					$provenance = $_POST['provenance'];
					$site = $_POST['site'];
					$section = $_POST['section'];
					$cote = $_POST['cote'];
					$folio_emplacement = $_POST['folio_emplacement'];
					$cimiers = $_POST['cimiers'];
					$blasonnement_1 = $_POST['blasonnement_1'];
					$blasonnement_2 = $_POST['blasonnement_2'];
					
					
					$this->db->query("INSERT INTO legende_photos VALUES ('', '$libelle_image', '$vedette_chandon', '$auteur_cliche',
					'$type_cliche', '$annee_cliche', '$pays', '$region', '$department', '$commune', '$village', '$edifice_conservation', 
					'$emplacement_dans_edifice', '$photo', '$commune_INSEE_number', '$ref_IM', '$ref_PA', '$ref_IA', 
					'$artificial_number_Decrock', '$famille', '$individu', '$qualite', '$date', '$denomination', '$titre', 
					'$categorie', '$materiau', '$ref_reproductions', '$biblio', '$remarques', '', '', '$auteurs', '$lieu_edition', 
					'$editeur', '$annee_edition', '$reliure', '$provenance', '$site', '$section', '$cote', '$folio_emplacement', 
					'', '$cimiers', '$blasonnement_1', 'blasonnement_2')");
					
					$manuel = "L'ajout a bien été effectué";
					$booleen_manuel = true;
					$_SESSION['anc_onglet'] = "image";
				}
			}
			
			
			
			/*
				|---------------------------------------------------------------------------------------------------
				| Traitement pour l'affichage de la partie modification des données de la base
				|---------------------------------------------------------------------------------------------------
			*/
			
			// Traitement de suppression d'une ligne
			if(isset ($_POST['id_supp']) && isset ($_POST['tab_supp'])){
				$id_supp = $_POST['id_supp'];
				$table = $_POST['tab_supp'];
				$this->db->query("DELETE FROM $table WHERE id='$id_supp'");
			}
			
			// Affichage du tableau par la lettre choisie
			
			
			if(isset ($_POST['lc'])==true && isset ($_POST['anc_onglet'])==true){
				$_SESSION['lc'] = $_POST['lc'];
				$_SESSION['anc_onglet'] = $_POST['anc_onglet'];
			}
			$lettre_contenus = $_SESSION['lc'];
			
			if($lettre_contenus!=''){
				$donnees_modif = $this->Model_administration->affichage_table('armorial',$lettre_contenus);
				$donnees_images = $this->Model_administration->recuperation_photos($lettre_contenus);
			}
			else{
				$donnees_modif = $this->Model_administration->affichage_table('armorial','a'); // Requête pour récupérer toutes les données de la table 'legende/photos'
				$donnees_images = $this->Model_administration->recuperation_photos('a');
			}
			$donnees_modif = $donnees_modif->result_array();
			$donnees_images = $donnees_images->result_array();
			
			/*
				|---------------------------------------------------------------------------------------------------
				| Tableau des équivalences
				|---------------------------------------------------------------------------------------------------
			*/
			
			// Ajout d'une nouvelle équivalence
			if(isset($_POST['ajout_equivalence'])){
				
				$expression_1 = addslashes($_POST['mot_1']);
				$expression_2 = addslashes($_POST['mot_2']);
				
				if($expression_1!="" && $expression_2!=""){
					$this->Model_administration->ajoutExpression($expression_1,$expression_2,"equivalences");
				}
				else{
					
				}
			}
			
			// Récupération des données
			$equivalences = $this->Model_administration->getEquivalences();
			$equivalences = $equivalences->result_array();
			
			
			/*
				|---------------------------------------------------------------------------------------------------
				| Traitement pour le changement des codes d'accés
				|---------------------------------------------------------------------------------------------------
			*/
			$acces = "";
			
			
			$identifiants = $this->Model_administration->identifiant();
			
			
			
			if(isset($_POST['login']) && isset($_POST['mdp_actuel'])) // Lorsqu'on a rempli le 1er formulaire (avec les identifiants actuels)
			{
				$_SESSION['anc_onglet'] = "admin";
				if($_POST['login']=='' || $_POST['mdp_actuel']=='')
				{
					$acces = "Veuillez remplir toutes les cases!";
				}
				else
				{
					foreach ($identifiants as $row)
					{
						$login = $row->login;
						$mdp = $row-> password;
						$id = $row-> id;
						
						if ($_POST['login']==$login && $_POST['mdp_actuel']==$mdp){
							$acces = "true";
							$_SESSION['id_user'] = $id;
							break;
							} else {
							$acces = "Les identifiants sont incorrects";
						}
					}
					
					
				}
			}
			else if(isset($_POST['new_mdp']) && isset($_POST['new_mdp_bis'])) // Lorsqu'on a rempli le 2e formulaire (avec le nouveau mot de passe)
			{
				$id_user = $_SESSION['id_user'];
				
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
						$this->Model_administration->modif_mdp($mdp, $id_user);
						
						$acces = "Le mot de passe a bien été changé!";
					}
				}
			}
			
			
			
			// Tableau $data des variables à envoyer aux vues	
			$patronymes = $this->Model_administration->patronyme_liste();
			$data = array(
			'connecte' => $session, // La variable $connecte est utilisée dans la vue footer.php 
			'manuel' => $manuel,
			'booleen_manuel' => $booleen_manuel,
			'patronymes' => $patronymes,
			'donnees_modif' => $donnees_modif,
			'equivalences' => $equivalences,
			'donnees_images' => $donnees_images,
			'acces' => $acces,
			'presentation_europe'=>$presentation_europe,
			'idr' =>$idr,
			'idrecherche' => $idrecherche, 
			'idtitre' => $idtitre,
			'idtitre2' => $idtitre2
			
			);
			
			// Chargement des vues à afficher (attention à l'ordre) (les vues sont dans le dossier /system/application/views)	
			$this->load->view('layout/header',$data);
			$this->load->view('administration/administration',$data);
			$this->load->view('layout/footer',$data);
			
		}
		
		
		function xls_csv($index) // Fonction qui transforme un fichier excel en fichier csv (pour l'insertion de données dans la base)
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
					echo 'nom = ', $nom;
					if($resultat)
					{
						$transfert = htmlentities("Transfert réussi");
						
						Include($_SERVER['DOCUMENT_ROOT'].'/../Excel/reader.php'); // Inclusion de la biblio de traitement de fichiers excel
						
						$donnees = "";
						
						// Instanciation de la class permettant la lecture du fichier excel
						$data = new Spreadsheet_Excel_Reader();
						
						// Définition du type d'encodage de caractère à utiliser pour la sortie (ce qui va être affiché à l'écran)
						$data->setOutputEncoding('UTF-8');
						// Chargement du fichier excel à lire
						if (file_exists($nom)) {
							echo "fichier existe";
						}
						else{
							echo "fichier non présent";
						}
						$data->read('/home/palisep/www/europe/fichiers_tmp/Excel_Europe_type(1).xls');							
						error_reporting(0);
						// Parse l'intégralité du fichier excel
						for ($i = 0; $i <= $data->sheets[0]['numRows']; $i++) {
							for ($j = 0; $j <= $data->sheets[0]['numCols']; $j++) {
								$donnees.=$data->sheets[0]['cells'][$i][$j]."\t";
							}
							
							$donnees.="\r";
						}
						
						utf8_encode($donnees);
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
			'name' => $nom_csv,
			);
			
			return $data;
		}
		
		
		function identification (){
			
			// Chargement des modèles utilisés dans le contrôleur (les modèles sont dans le dossier /system/application/models)
			$this->load->model('Model_administration');
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Bouton de déconnexion (voir vue footer.php) qui met la variable $session = FALSE (càd non connecté)			
				|----------------------------------------------------------------------------------------------------
			*/
			$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connecté) ou $session=FALSE (admin est pas connecté)
			if (isset($_POST['deconnexion']) && $_POST['deconnexion'] == 'Deconnexion') {
				$newdata = array(
				'logged_in'	=> FALSE,
				'connecte'	=> FALSE,
				'statut'	=> NULL
				);
				$this->session->set_userdata($newdata);
				$session = $this->session->userdata('logged_in');	// $session = FALSE
				header("Location: ".base_url()); 	// Redirection sur l'identification		
			}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			/*
				|----------------------------------------------------------------------------------------------------
				| Formulaire de connexion (voir vue identification.php) qui met la variable $session = TRUE (càd connecté)			
				|----------------------------------------------------------------------------------------------------
			*/
			$error= NULL; // $error contiendra le message d'erreur d'identification 	
			$identifiants = $this->Model_administration->identifiant();		// $identifiants : tous les identifiants enregistrés dans la bdd 	
			// Initialisation des variables							
			$newdata = array( // Variable de session (par défaut l'admin est pas connecté donc FALSE)
			'logged_in' => FALSE,
			'statut' => NULL
			);
			$this->session->set_userdata($newdata);
			
			if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') { // On vérifie que le formulaire a été envoyé
				if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) {
					foreach ($identifiants as $identifiant) {	// On compare les identifiants envoyés avec ceux de la bdd
						if (($identifiant->login == $_POST['login'] ) && ($identifiant->password == $_POST['pass'])) { // Si les identifiants sont correctes, la variable de session logged_in passe à TRUE
							$newdata = array(
							'logged_in' => TRUE,
							'statut' => $identifiant->statut,
							);
							$this->session->set_userdata($newdata);
							$session = $this->session->userdata('logged_in'); // $session = TRUE (l'admin est connecté)
							header("Location: ".base_url()); // Redirection vers l'administration
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
			
			// Chargement des vues à afficher (attention à l'ordre) (les vues sont dans le dossier /system/application/views)	
			//$this->load->view('layout/header',$data);	
			$this->load->view('administration/identification',$data);
			//$this->load->view('layout/footer',$data);	
		}
		
		
		function utilisateur(){
			
			// Chargement des modèles utilisés dans le ôleu (les modèles sont dans le dossier /system/application/models)
			$this->load->model('Model_administration');
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Bouton de déconnexion (voir vue footer.php) qui met la variable $session = FALSE (càd non connecté)			
				|----------------------------------------------------------------------------------------------------
			*/
			$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connecté) ou $session=FALSE (admin est pas connecté)
			if (isset($_POST['deconnexion']) && $_POST['deconnexion'] == 'Deconnexion') {
				$newdata = array(
				'logged_in'	=> FALSE,
				'connecte'	=> FALSE,
				'statut'	=> NULL
				);
				$this->session->set_userdata($newdata);
				$session = $this->session->userdata('logged_in');	// $session = FALSE
				header("Location: ".base_url()); 	// Redirection sur l'identification		
			}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			
			// Tableau $data des variables à envoyer aux vues			
			$data = array(
			'connecte' => $session, // La variable $connecte est utilisée dans la vue footer.php et administration.php (et toutes les autres vues où on a besoin de savoir si l'admin est connecté ou pas)
			'error' => $error,
			);
			
			// Chargement des vues à afficher (attention à l'ordre) (les vues sont dans le dossier /system/application/views)	
			$this->load->view('layout/header',$data);
			$this->load->view('administration/utilisateur',$data);
			$this->load->view('layout/footer',$data);
		}
		
		
		
		function insertion_images() //Fonction qui enregistre les images ds le dossier temporaire
		{
			$transfert = "";
			for($i=1;$i<11;$i++){
				if(isset ($_FILES['images_'.$i]))
				{
					if ($_FILES['images_'.$i]['error'] > 0)
					{
						$transfert =  "Erreur lors du transfert";
					}
					else
					{
						$extension_upload = strtolower(  substr(  strrchr($_FILES['images_'.$i]['name'], '.')  ,1)  );
						if($extension_upload!='jpg' && $extension_upload!='JPG' && $extension_upload!='jpeg' && $extension_upload!='png' && $extension_upload!='JPEG' && $extension_upload!='zip')
						{
							$transfert = "Le fichier n'est pas au bon format";
						}
						else
						{
							//On copie le fichier
							$nom = $_SERVER['DOCUMENT_ROOT']."/fichiers_tmp/".$_FILES['images_'.$i]['name'];
							$resultat = move_uploaded_file($_FILES['images_'.$i]['tmp_name'],$nom);
							
							if($extension_upload=='zip') //Si c'est une archive
							{
								require_once( $_SERVER['DOCUMENT_ROOT'].'/../system/libraries/pclzip.lib.php');
								$archive = new PclZip($nom); //on crée un nouvel objet archive a partir su fichier uploadé
								
								if ($archive->extract($_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/') == 0) //on extrait ds le dossier spécifié
								{
									die("Error : ".$archive->errorInfo(true));
								}
								else //Si l'extraction c'est bien passée
								{
									$dirname = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/';
									$dir = opendir($dirname); //On ouvre le dossier des fichiers temporaires
									unlink($nom); //On supprime l'archive
									
									$dossier = explode(".",$_FILES['images_'.$i]['name']);
									$dossier = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$dossier[0].'/';
									$dir = opendir($dossier); //On ouvre le dossier issu de l'extraction
									
									while($file = readdir($dir))
									{
										if($file != '.' && $file != '..' && !is_dir($dossier.$file))
										{
											copy($dossier.$file, $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$file); //On déplace tous les fichiers
											unlink($dossier.$file); //On les supprime du dossier
										}
									}
									
									rmdir($dossier); //On supprime le dossier issu de l'extraction
									
									closedir($dir);
								}
							}
							
						}
					}
				}
			}
			return $transfert;
		}
		
		function compression() //Fonction qui compresse les images du dossier temporaire et les déplace ds le fichier "images"
		{
			
			//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
			$dirname = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/';
			$dir = opendir($dirname); //On ouvre le dossier temporaire
			
			$transfert = "";
			
			while($file = readdir($dir)) //On parcourt les fichiers
			{
				if($file != '.' && $file != '..' && !is_dir($dirname.$file))
				{
					$titre = explode(".",$file);
					
					// montagne.jpg : $titre[0] = montagne, $titre[1] = jpg
					
					//On configure les paramétres pour la compression
					$config['image_library'] = 'GD';
					$config['source_image'] = $dirname.$file; //Le fichier source
					$config['quality'] = '75%'; //La qualité du fichier aprés compression
					$config['new_image'] = $_SERVER['DOCUMENT_ROOT'].'/../europe/ressources/images/'.$titre[0].".jpg"; //Le nouveau fichier
					//$config['new_image'] = '/home/marine/Bureau/'.$titre[0].".jpg";
					$this->load->library('image_lib'); //On charge les fonctions image de CodeIgniter
					$this->image_lib->initialize($config);
					$this->image_lib->resize(); //On lance la compression
					if ( ! $this->image_lib->resize())
					echo $this->image_lib->display_errors();
					//$transfert = "";
					//			$transfert = "Une erreur s'est produite!";
					else
					$transfert = "";
					//	$transfert = "Photo(s) charg&eacute;e(s)";
					
					chmod($dirname.$file, 0777);
					unlink($dirname.$file); //On supprime les images du dossier temporaire
				}
			}
			return $transfert;
		}
		
		function images_bdd(){
			
			$libelle_image = "";
			
			if(isset($_FILES['images_1']) && $_FILES['images_1']!=""){
				$libelle_image_tab = explode(".",$_FILES['images_1']['name']);
				$libelle_image.=$libelle_image_tab[0];
			}
			
			if(isset($_FILES['images_2']) && $_FILES['images_2']!=""){
				$libelle_image_tab = explode(".",$_FILES['images_2']['name']);
				$libelle_image.=$libelle_image_tab[0].";";
			}
			
			if(isset($_FILES['images_3']) && $_FILES['images_3']!=""){
				$libelle_image_tab = explode(".",$_FILES['images_3']['name']);
				$libelle_image.=$libelle_image_tab[0].";";
			}
			
			if(isset($_FILES['images_4']) && $_FILES['images_4']!=""){
				$libelle_image_tab = explode(".",$_FILES['images_4']['name']);
				$libelle_image.=$libelle_image_tab[0].";";
			}
			
			if(isset($_FILES['images_5']) && $_FILES['images_5']!=""){
				$libelle_image_tab = explode(".",$_FILES['images_5']['name']);
				$libelle_image.=$libelle_image_tab[0].";";
			}
			
			if(isset($_FILES['images_6']) && $_FILES['images_6']!=""){
				$libelle_image_tab = explode(".",$_FILES['images_6']['name']);
				$libelle_image.=$libelle_image_tab[0].";";
			}
			
			if(isset($_FILES['images_7']) && $_FILES['images_7']!=""){
				$libelle_image_tab = explode(".",$_FILES['images_7']['name']);
				$libelle_image.=$libelle_image_tab[0].";";
			}
			
			if(isset($_FILES['images_8']) && $_FILES['images_8']!=""){
				$libelle_image_tab = explode(".",$_FILES['images_8']['name']);
				$libelle_image.=$libelle_image_tab[0].";";
			}
			
			if(isset($_FILES['images_9']) && $_FILES['images_9']!=""){
				$libelle_image_tab = explode(".",$_FILES['images_9']['name']);
				$libelle_image.=$libelle_image_tab[0].";";
			}
			
			if(isset($_FILES['images_10']) && $_FILES['images_10']!=""){
				$libelle_image_tab = explode(".",$_FILES['images_10']['name']);
				$libelle_image.=$libelle_image_tab[0].";";
			}
			
			return $libelle_image;
			
		}
		
		
	}
?>
