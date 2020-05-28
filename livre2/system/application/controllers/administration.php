<?php
class Administration extends Controller {

	function index(){

		set_time_limit(0); //On supprime la limite d'ex�cution du script pour qu'il ne s'arrete pas en plein mileu
                // Chargement des models utilis�s dans le controller (les models sont dans le dossiers /system/application/models )
		$this->load->model('Model_administration');
		$this->load->model('Model_recherche');
		$idr= "";
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
		| Traitement pour le changement des codes d'accés
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

						$acces = "Le mot de passe a bien été changé!";
					}
				}
			}

		/*
		|----------------------------------------------------------------------------------------------------
		| Recherche par ID
		|----------------------------------------------------------------------------------------------------
		*/
			$idrecherche = "";
			$idtitre = "";
                    if(isset($_POST['recherche_id']) && $_POST['recherche_id']!=""){
                        $recherche_id = $_POST['recherche_id'];
                        $idr = $this->Model_administration->getid($_POST['recherche_id']);
                    foreach ($idr as $row)
						{
						$idrecherche = $row-> id;
						$idtitre = $row-> patronyme;
						}
                    }



		        /*
		|---------------------------------------------------------------------------------------------------
		| Réinitilisation du compteur
		|---------------------------------------------------------------------------------------------------
		*/

						 if(isset($_GET['compteur'])){
                            $fichier=fopen("compteur.txt","w");
                            $date = date("d-m-Y");
                            fwrite($fichier,"0 ".$date);
                            fclose($fichier);
                        }

                        $fichier = fopen("compteur.txt","r+");
                        $infos = fgets($fichier,255);
                        $infos = explode(" ", $infos);
                        $visites = $infos[0];
                        $date = $infos[1];
                        fclose($fichier);


                /*

		*/

                /*
		|---------------------------------------------------------------------------------------------------
		| Récupération de l'adresse mail admin
		|---------------------------------------------------------------------------------------------------
		*/
            $mail = $this->Model_administration->getMail();
            foreach ($mail as $row)
			{
				$mail = $row-> mail;
			}

            if(isset($_GET['new_mail'])){
                $new_mail = $_GET['new_mail'];
                $this->Model_administration->changeMail($new_mail);
            }

                /*
		|----------------------------------------------------------------------------------------------------
		*/

                /*
		|---------------------------------------------------------------------------------------------------
		| Traitement de la suppression d'un contenu
		|---------------------------------------------------------------------------------------------------
		*/

        $id = "";
        $photos = "";
        $photo = "";
        $libelle = "";

        if(isset($_GET['ids'])){
            $id = $_GET['ids'];
        }

        if($id!=''){
            $this->suppr($id); //On supprime le contenu ds la bdd
            $photos = $this->Model_administration->getPhotos($id);//On supprime les images du FTP

            foreach ($photos as $row)
			{
				$libelle = $row['libelle_image'];

			}

            if($libelle!=""){
            $photo = explode(";", $libelle);

            for($i=0;$i<sizeof($photo);$i++){
                if($photo[$i]!=""){
                    $dirname = $_SERVER['DOCUMENT_ROOT'].'/../resources/images/';
                    $dir = opendir($dirname); //On ouvre le dossier images
                    while($file = readdir($dir)) //On parcourt les fichiers
                    {
                        if($file != '.' && $file != '..' && !is_dir($dirname.$file) && $file==$photo[$i].".jpg")
                        {
                            chmod($dirname.$file, 0777);
                            unlink($dirname.$file); //On supprime l'image
                        }
                    }
                }
            }

            }

        }
    if(isset($_GET['sup'])){
                          $table = "";
                          $id = $_GET['id'];
                          if($_GET['sup']==1){
                            $table = "equivalences";
                            $this->Model_administration->supression($table,$id);}
                          }
				     /*
		|---------------------------------------------------------------------------------------------------
		| Tableau des équivalences
		|---------------------------------------------------------------------------------------------------
		*/

                        //Ajout d'une nouvelle équivalence
                        if(isset($_GET['ajout_equivalence'])){

                            $expression_1 = addslashes($_GET['mot_1']);
                            $expression_2 = addslashes($_GET['mot_2']);

                            if($expression_1!="" && $expression_2!=""){
                                $this->Model_administration->ajoutExpression($expression_1,$expression_2,"equivalences");
                            }
                            else{

                            }
                        }

                        //Récupération des données
                        $equivalences = $this->Model_administration->getEquivalences();
                        $equivalences = $equivalences->result_array();
                /*
		|----------------------------------------------------------------------------------------------------
		*/
		       /*
		|---------------------------------------------------------------------------------------------------
		| Traitement de la suppression d'un partenaire
		|---------------------------------------------------------------------------------------------------
		*/

        $partenaire_id = "";

        if(isset($_GET['pid_d'])){
            $partenaire_id = $_GET['pid_d'];
        }

        if($partenaire_id!=''){
            $this->Model_administration->delete_partenaire($partenaire_id); //On supprime le partenaire ds la bdd
        }
                 /*
		|---------------------------------------------------------------------------------------------------------
		*/

		       /*
		|---------------------------------------------------------------------------------------------------
		| Traitement de l'ajout de partenaires
		|---------------------------------------------------------------------------------------------------
		*/

        $new_partenaire_nom = "";
        $new_partenaire_url = "";

        if(isset($_POST['new_pn']) && isset($_POST['new_purl']) && !empty($_POST['new_pn']) && !empty($_POST['new_purl'])){
            $new_partenaire_nom = $_POST['new_pn'];
            $new_partenaire_url = $_POST['new_purl'];

	        $this->Model_administration->insert_partenaire($new_partenaire_nom, $new_partenaire_url); //On supprime le partenaire ds la bdd
        }

        /*
		|---------------------------------------------------------------------------------------------------
		| Traitement de l'update de la présentation
		|---------------------------------------------------------------------------------------------------
		*/

        if(isset($_POST['update_presentation']) && !empty($_POST['update_presentation'])){
            $new_presentation = htmlentities($_POST['update_presentation'], ENT_QUOTES);

	        $this->Model_administration->update_presentation($new_presentation);
        }
		if(isset($_POST['update2_presentation']) && !empty($_POST['update2_presentation'])){
            $new_presentation2 = htmlentities($_POST['update2_presentation'], ENT_QUOTES);

	        $this->Model_administration->update2_presentation($new_presentation2);
        }


                 /*
		|---------------------------------------------------------------------------------------------------------
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
					$liste = 'pays, region, departement, commune, edifice_conservation, denomination, categorie, materiau, ref_reproduction, auteur_cliche, annee_cliche, patronyme, individu, parente, biographie, armes, cimiers, devise, titre, auteurs, lieu_edition, editeur, annee_edition, reliure, provenance, site, section, cote, folio_emplacement, bibliographie, notes ';
					$this->Model_administration->mise_a_jour($_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$nom,'details',$liste); //On insert les infos contenues ds le fichier xls dans la bdd

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
			else if(isset($_FILES['images_1']) || isset($_FILES['images_2']) || isset($_FILES['images_3']) || isset($_FILES['images_4'])
                                || isset($_FILES['images_5']) || isset($_FILES['images_6']) || isset($_FILES['images_7']) || isset($_FILES['images_7'])
                                || isset($_FILES['images_8']) || isset($_FILES['images_9']) || isset($_FILES['images_10'])) //Si on upload un fichier pour les images
			{
					$transfert = $this->insertion_images();
					$transfert = $this->compression();
			}

		/*
		|---------------------------------------------------------------------------------------------------------
		*/

                /*
		|---------------------------------------------------------------------------------------------------
		| Traitement pour l'ajout manuel d'un contenu
		|---------------------------------------------------------------------------------------------------
		*/
                        $manuel = "";
                        $booleen_manuel = "";

                        if(isset($_POST['submit_ajout_manuel'])){

                            if($_FILES['images_1']['name']=="" && $_POST['patronyme']=="" && $_POST['pays']=="" &&
                                    $_POST['region']=="" && $_POST['departement']=="" && $_POST['commune']=="" &&
                                    $_POST['edifice_conservation']=="" && $_POST['denomination']=="" && $_POST['materiau']=="" &&
                                    $_POST['ref_reproduction']=="" && $_POST['auteur_cliche']=="" && $_POST['type_cliche']=="" &&
                                    $_POST['annee_cliche']=="" && $_POST['photo']=="" && $_POST['ref_im']=="" && $_POST['ref_pa']=="" &&
                                    $_POST['ref_ia']=="" && $_POST['individu']=="" && $_POST['biographie']=="" && $_POST['embleme']=="" &&
                                    $_POST['armes']=="" && $_POST['cimiers']=="" && $_POST['devise']=="" && $_POST['bibliographie']=="" &&
                                    $_POST['auteurs']=="" && $_POST['titre']=="" && $_POST['categorie']=="" &&
                                    $_POST['lieu_edition']=="" && $_POST['editeur']=="" && $_POST['annee_edition']=="" && $_POST['reliure']=="" &&
                                    $_POST['provenance']=="" && $_POST['site']=="" && $_POST['section']=="" && $_POST['cote']=="" &&
                                    $_POST['folio_emplacement']==""
                               )
                            {

                                $manuel = "Veuillez remplir au moins une case!";
                                $booleen_manuel = true;

                        }
                        else{
                            $libelle_image = $this->images_bdd();
                            $patronyme = $_POST['patronyme'];
                            $pays = $_POST['pays'];
                            $region = $_POST['region'];
                            $departement = $_POST['departement'];
                            $commune = $_POST['commune'];
                            $edifice_conservation = $_POST['edifice_conservation'];
                            $denomination = $_POST['denomination'];
                            $categorie = $_POST['categorie'];
                            $materiau = $_POST['materiau'];
                            $ref_reproduction = $_POST['ref_reproduction'];
                            $auteur_cliche = $_POST['auteur_cliche'];
                            $type_cliche = $_POST['type_cliche'];
                            $annee_cliche = $_POST['annee_cliche'];
                            $photo = $_POST['photo'];
                            $ref_im = $_POST['ref_im'];
                            $ref_pa = $_POST['ref_pa'];
                            $ref_ia = $_POST['ref_ia'];
                            $individu = $_POST['individu'];
                            $parente = $_POST['parente'];
                            $biographie = $_POST['biographie'];
                            $embleme = $_POST['embleme'];
                            $armes = $_POST['armes'];
                            $cimiers = $_POST['cimiers'];
                            $devise = $_POST['devise'];
                            $notes = $_POST['notes'];
                            $bibliographie = $_POST['bibliographie'];
                            $auteurs = $_POST['auteurs'];
                            $titre = $_POST['titre'];
                            $lieu_edition = $_POST['lieu_edition'];
                            $editeur = $_POST['editeur'];
                            $annee_edition = $_POST['annee_edition'];
                            $reliure = $_POST['reliure'];
                            $provenance = $_POST['provenance'];
                            $site = $_POST['site'];
                            $section = $_POST['section'];
                            $cote = $_POST['cote'];
                            $folio_emplacement = $_POST['folio_emplacement'];
               $this->db->query("INSERT INTO details VALUES ('','" . mysql_real_escape_string($libelle_image) . "','" . mysql_real_escape_string($patronyme) . "','$auteur_cliche', '$type_cliche', '$annee_cliche',
                                            '$pays','$region', '$departement', '$commune', '$edifice_conservation', '$photo', '$ref_im', '$ref_pa', '$ref_ia',
                                            '" . mysql_real_escape_string($individu) . "', '" . mysql_real_escape_string($biographie) . "', '" . mysql_real_escape_string($parente) . "','', '$denomination', '" . mysql_real_escape_string($titre) . "', '$categorie', '" . mysql_real_escape_string($materiau) . "', '$ref_reproduction', '$bibliographie',
                                            '$embleme', '$auteurs', '$lieu_edition', '$editeur', '$annee_edition', '$reliure', '$provenance', '$site', '$section', '$cote',
                                            '$folio_emplacement', '" . mysql_real_escape_string($cimiers) . "', '" . mysql_real_escape_string($armes) . "', '" . mysql_real_escape_string($notes) . "', '" . mysql_real_escape_string($devise) . "')");
                            $manuel = "L'ajout a bien été effectué";
                            $booleen_manuel = true;
                        }
                        }

                 /*
		|---------------------------------------------------------------------------------------------------------
		*/

                /*
		|---------------------------------------------------------------------------------------------------
		| Traitement de l'ajout d'images à un contenu existant
		|---------------------------------------------------------------------------------------------------
		*/

                    if(isset($_POST['ajouter_photos_libelle'])){

                        $id_contenu = $_POST['id'];

                        //On insert les images dans le doosier images
                        $transfert = $this->insertion_images();
			$transfert = $this->compression();

                        //On insert les libellés ds la bdd
                        $libelle_image = $this->images_bdd();
                        $this->Model_administration->miseAjourImages($libelle_image, $id_contenu);

                    }

                /*
		|---------------------------------------------------------------------------------------------------------
		*/

                /*
		|---------------------------------------------------------------------------------------------------
		| Traitement pour l'affichage de la partie modification des donn�es de la base
		|---------------------------------------------------------------------------------------------------
		*/
                        $lettre_contenus = '';

                        if(isset ($_GET['lc'])){
                            $lettre_contenus = $_GET['lc'];
                        }

                        if($lettre_contenus!=''){
                            $donnees_photos = $this->Model_administration->affichage_table('details',$lettre_contenus);
                        }
			else{
                            $donnees_photos = $this->Model_administration->affichage_table('details','a'); //requete pour r�cup�rer ttes les donn�es de la table 'legende/photos'
                        }
                        $donnees_photos = $donnees_photos->result_array();

		/*
		|---------------------------------------------------------------------------------------------------------
		*/

                 /*
		|---------------------------------------------------------------------------------------------------
		| Textes info bulles
		|---------------------------------------------------------------------------------------------------
		*/
                    $bulle_identifiants = "Pour changer de mot de passe:
                                        <ul>
                                            <li>Saisissez le login et le mot de passe ACTUELS</li>
                                            <li>Saisissez 2 fois votre nouveau mot de passe</li>
                                        </ul>";

                    $bulle_visites = "Le nombre indique le nombre de visites effectuées sur le site la date indiquée<br />
                                        En cliquant sur \"Réinitialiser le compteur\", le compte sera repris de zéro et <br />la date remplacée par la date courante.";

                    $bulle_mail = "Entrez la nouvelle adresse mail puis cliquez sur \"changer\"";

                    $bulle_excel = "Pour insérer des contenus via un fichier Excel:
                                    <ul>
                                        <li>Cliquez sur \"Générer...\" et enregistrez le fichier</li>
                                        <li>Ouvrez le fichier précédemment téléchargé et remplissez-le</li>
                                        <li>Cliquez sur \"Ajouter un fichier\"/\"Parcourir\" (en fonction<br />
                                            du navigateur) et sélectionnez le fichier rempli</li>
                                        <li>Cliquez sur \"Ajouter\"</li>
                                    </ul>";

                    $bulle_contenus = "<ul>
                                       <li> Le tableau affiche les contenus de la base, organisés par ordre alphabétique.<br />
                                            Pour atteindre la lettre souhaitée, cliquez sur l'un des liens au-dessus du tableau.<br />
                                            L'affichage se fait sur plusieurs pages: \"Afficher ... entrées par page\" permet de <br />
                                            paramétrer cet affichage et les chiffres en bas du tableau de naviguer entre les pages.<br />
                                            La barre de recherche à droite permet de faire une recherche sur toutes les colonnes.
                                       </li><br />
                                       <li>
                                            <img width='15px' src='".base_url()."ressources/images/supprimer.png' /> (dans la colonne de gauche) permet de supprimer le contenu correpondant.
                                       </li><br />
                                       <li>Dans la colonne \"Libellé image\":
                                        <ul>
                                            <li>En cliquant sur °, la fiche de modification du contenu correspondant apparait;<br />
                                            effectuez les modification souhaitées sur les différents champs; si des images sont<br />
                                            associées au contenu, elles apparaissent en haut de la fiche avec des cases à cocher;<br >
                                            cochez les cases de celles que vous souhaitez supprimer; une fois toutes les modifications<br />
                                            effectuées, cliquez \"Modifier\" en bas de la fiche pour les valider.
                                            </li><br />
                                            <li><img width='20px' src='".base_url()."/ressources/images/croix.png'/> permet de faire apparaître le module d'ajout d'images à un contenu: si svous voulez<br />
                                             voulez ajouter plusieurs images, il suffit de cliquer sur \"Nouveau champs image\", pour<br />
                                             chaque champ, cliquez sur \"Ajouter un fichier\"/\"Parcourir\" (en fonction du navigateur),<br />
                                             sélectionnez l'image, une fois que toutes les images à ajouter ont été sélectionnées,<br />
                                             cliquez sur \"Ajouter\".
                                            </li><br />
                                            <li><img width='20px' src='".base_url()."/ressources/images/fleches_montantes.png'/> permet de cacher le module d'ajout d'images.</li>
                                        </ul>
                                       </ul>";
                    $bulle_ajout = "Pour ajouter manuellement un contenu:<br />
                                    <ul>
                                    <li>Remplissez la fiche</li>
                                    <li>Pour ajouter une image, cliquez sur \"Ajouter un fichier\"/\"Parcourir\" (en fonction du navigateur)<br />
                                    et sélectionnez votre image; pour ajouter plusieurs images, cliquez sur \"Nouveau champs image\"<br />
                                    pour ajouter des champs.</li>
                                    <li>Une fois la fiche remplie et les images sélectionnées, cliquez sur \"Ajouter\"</li>
                                    </ul>";

                    $bulle_partenaire = "Cliquez ici pour gérer les partenaires";
                /*
		|---------------------------------------------------------------------------------------------------------
		*/

		$partenaires = $this->Model_administration->get_partenaires();
		$presentation_livre2=$this->Model_administration->get_presentation_text();


// Tableau $data des variables � envoyer aux vues
		$data = array(
			'connecte' => $session, // La variable $connecte est utilis� dans la vue footer.php
                        'manuel' => $manuel,
                        'booleen_manuel' => $booleen_manuel,
			'acces' => $acces,
			'transfert' => $transfert,
		        'equivalences' => $equivalences,
			'donnees_photos' => $donnees_photos,
			'mail' => $mail,
                        'visites' => $visites,
                        'date' => $date,
                        'bulle_identifiants' => $bulle_identifiants,
                        'bulle_visites' => $bulle_visites,
                        'bulle_mail' => $bulle_mail,
                        'bulle_excel' => $bulle_excel,
                        'bulle_contenus' => $bulle_contenus,
                        'bulle_ajout' =>$bulle_ajout,
                        'bulle_partenaire' => $bulle_partenaire,
                        'partenaires'=> $partenaires,
                        'presentation_livre2'=>$presentation_livre2,
						'idr' =>$idr,
						'idrecherche' => $idrecherche,
						'idtitre' => $idtitre
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
					$error='<div class="error_login"><strong>Identifiants incorrects</strong></div>';
				}
				else {
					$error='<div class="error_login"><strong>Identifiants incorrects</strong></div>';
				}
			}
                        if(isset($_GET['lost'])){ //Si l'administrateur a oublié le mdp
                                    $this->send_password();
                                    $error = '<div class="error_login"><strong>Le mot de passe vous a été envoyé par email</strong></div>';
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
		//$this->load->view('layout/footer',$data);
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
							$data->setOutputEncoding('UTF-8');

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
				'nom' => $nom_csv,
				);

	return $data;
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

						$dossier = explode(".",$_FILES['images_'.$i]['name']);
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
            }
        }
	return $transfert;
}

function compression() //Fonction qui compresse les images du dossier temporaire et les d�place ds le fichier "images"
{

	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	$dirname = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/';
	$dir = opendir($dirname); //On ouvre le dossier temporaire

	$transfert = "";

	while($file = readdir($dir)) //On parcourt les fichiers
	{
		if($file != '.' && $file != '..' && !is_dir($dirname.$file))
		{
			$titre = explode(".",$file);


			// montagne.jpg : $titre[0] = montagne, $titre[1] = jpg

			//On configure les param�tres pour la compression
			$config['image_library'] = 'GD';
			$config['source_image'] = $dirname.$file; //Le fichier source
			$config['quality'] = '75%'; //La qualit� du fichier apr�s compression
			$config['new_image'] = $_SERVER['DOCUMENT_ROOT'].'/../resources/images/'.$titre[0].".jpg"; //Le nouveau fichier
                        //$config['new_image'] = '/home/marine/Bureau/'.$titre[0].".jpg";

			$this->load->library('image_lib'); //On charge les fonctions image de CodeIgniter
			$this->image_lib->initialize($config);
			$this->image_lib->resize(); //On lance la compression
			if ( ! $this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			} else {
				$transfert = "";
			}


			  //$transfert = "";
			  //			$transfert = "Une erreur s'est produite!";


			  //	$transfert = "Photo(s) charg&eacute;e(s)";

			// move_uploaded_file($dirname.$file, $_SERVER['DOCUMENT_ROOT'].'/ressources/images/'.$titre[0].".jpg");

			chmod($dirname.$file, 0777);
                        unlink($dirname.$file); //On supprime les images du dossier temporaire
		}
	}
	return $transfert;
}

function suppr($id){ //fonction pour supprimer un contenu du tableau

    $this->db->query("DELETE FROM details WHERE id='".$id."'");

}

function images_bdd(){

    $libelle_image = "";

    if(isset($_FILES['images_1']) && $_FILES['images_1']!=""){
        $libelle_image_tab = explode(".",$_FILES['images_1']['name']);
        $libelle_image.=$libelle_image_tab[0].";";
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

function send_password(){

            $identifiants = $this->Model_administration->identifiant();
            foreach ($identifiants as $identifiant) {	// on compare les identifiants envoy�s avec ceux de la bdd
                $mdp = $identifiant->password;
                $login = $identifiant->login;
            }

            $mail = $this->Model_administration->getMail(); //Récupération de l'adresse mail administrateur
            foreach ($mail as $row)
			{
				$mail_admin = $row-> mail;
			}


            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail_admin)) // On filtre les serveurs qui présentent des bogues.
                        {
                            $passage_ligne = "\r\n";
                        }
                        else
                        {
                            $passage_ligne = "\n";
                        }
                        //=====Déclaration des messages au format texte et au format HTML.
                        $message_html = "<html><head></head><body>
                            <b>Rappel des identifiants: </b><br />
                            Les identifiants pour accéder à l'administration du site 'Héraldique et le livre' (www.livre2.palisep.fr) sont les suivants<br />
                            Login: <b>".$login."</b><br />
                            Mot de passe : <b>".$mdp."</b><br />";

                        //==========

                        //=====Création de la boundary.
                        $boundary = "-----=".md5(rand());
                        $boundary_alt = "-----=".md5(rand());
                        //==========

                        //=====Définition du sujet.
                        $sujet = "Renvoi du mot de passe 'Héraldique et le livre'";
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
                        mail($mail_admin,$sujet,$message,$header);
                        //==========

        }

}
?>
