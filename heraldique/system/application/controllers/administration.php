<?php
	class Administration extends Controller {
		
		function index(){
            set_time_limit(0); // On met la limite d'exécution de script à 0
			
			// Chargement des modèles utilisés dans le contrôleur (les modèles sont dans le dossier /system/application/models)
			$this->load->model('Model_administration');
			$this->load->model('Model_recherche');
			$transfert = "";
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
			$presentation_heraldique=$this->Model_administration->get_presentation_text();
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Bouton de déconnexion qui met la variable $session = FALSE (cad non connecté)			
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
			</ul>
			Pour les objets/livres:
			<ul>
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
			$bulle_switchrecherche = "Choisissez si vous voulez autoriser la recherche publique";
			/*
				|---------------------------------------------------------------------------------------------------------
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
			
			if(isset($_POST['login']) && isset($_POST['mdp_actuel'])) // Lorsqu'on a rempli le 1er formulaire (avec les identifiants actuels)
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
			else if(isset($_POST['new_mdp']) && isset($_POST['new_mdp_bis'])) // Lorsqu'on a rempli le 2e formulaire (avec le nouveau mot de passe)
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
			*/
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Recherche par ID 
				|----------------------------------------------------------------------------------------------------
			*/
			$idrecherche = "";
			$idtitre = ""; $idtitre2 = "";
			if(isset($_GET['recherche_id']) && $_GET['recherche_id']!=""){
				$recherche_id = $_GET['recherche_id'];
				$idr = $this->Model_administration->getid($_GET['recherche_id']);
				foreach ($idr as $row)
				{
					$idrecherche = $row-> id;
					$idtitre = $row-> famille; $idtitre2 = $row-> patronyme;
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
				|----------------------------------------------------------------------------------------------------
			*/
			
			/*
				|---------------------------------------------------------------------------------------------------
				| Récupération de l'adresse mail admin
				|---------------------------------------------------------------------------------------------------
			*/
			if(isset($_GET['new_mail'])){
				$new_mail = $_GET['new_mail'];
				$this->Model_administration->changeMail($new_mail);
			}
			
			$mail = $this->Model_administration->getMail();
			foreach ($mail as $row)
			{
				$mail = $row-> mail;
			}
			
			/*
				|---------------------------------------------------------------------------------------------------
				| Options recherche publique
				|---------------------------------------------------------------------------------------------------
			*/
            $recherche_publique_state = $this->db->query("SELECT SSTATE FROM SWITCH WHERE SNAME = 'PSEARCH'");
            $row = $recherche_publique_state->row();
            $current_publique = $row->SSTATE;

            //if(!empty($_POST['soap']))
            if(isset($_POST['soap']))
            {
                $soap = $_POST['soap'];
                $soapsql=$this->db->query("UPDATE SWITCH SET SSTATE='$soap' WHERE SNAME='PSEARCH'");

            }
            else{}
			
			
			/*
				|---------------------------------------------------------------------------------------------------
				| Traitement des fichiers uploadés
				|---------------------------------------------------------------------------------------------------
			*/
			$transfert = "";
			//echo "OK";
			$nom = "";
			$index = "";
			
			if(isset($_FILES['familles']) || isset($_FILES['mediatheque'])) // Si on uploade un fichier pour la médiathèque ou pour armorial
			{
				if(isset($_FILES['familles'])){
					$index = 'familles';
					$liste = "patronyme,famille,prenom,titres_dignites,origine,date,siècle,fief,aire,pays,région,région_bis,départment,alliances,notes,blasonnement_1,cimiers,devise,embleme,lambrequins,support,observations,ref_biblio";
					$table = "armorial";
					
				}
				else if(($_FILES['mediatheque'])){
					$index = 'mediatheque';
					$liste = "libellé_image,vedette_chandon,auteur_cliché,pays,région,départment,commune,village,edifice_conservation,emplacement_dans_édifice,photo,commune_INSEE_number,ref_IM,ref_PA,ref_IA,famille,individu,qualité,date,dénomination,titre,catégorie,matériau,ref_reproductions,biblio,remarques,auteurs,lieu_édition,editeur,année_édition,reliure,provenance,site,section,cote,folio_emplacement";
					$table = "legende_photos";
				}
				
				if($_FILES[$index]['name']=="")
				{echo "KO";
					$transfert = "Vous n'avez choisi aucun fichier!";
				}
				else
				{
					//echo "OK2";
					$resultat = $this->xls_csv($index); //On crée un fichier csv a partir du fichier uploadé
					$transfert = $resultat['transfert'];
					$nom = $resultat['nom'];
					
					$this->Model_administration->mise_a_jour($_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$nom,$table,$liste); // On insert les infos contenues dans le fichier xls dans la bdd
					
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
			/*elseif (isset($_FILES['excels'])) {
				$fichier = $_SERVER['DOCUMENT_ROOT']."/Rietstap.csv";
				$table = "armorial";
				$liste = "patronyme,origine,blasonnement_1,cimiers,devise,lambrequins,support";
				$this->Model_administration->mise_a_jour ($fichier,$table,$liste);
			}*/
			
			/*
				|---------------------------------------------------------------------------------------------------------
			*/
			
			/*
				|---------------------------------------------------------------------------------------------------
				| Supresssion expressions/contenus
				|---------------------------------------------------------------------------------------------------
			*/
			if(isset($_GET['sup'])){
				$table = "";
				$id = $_GET['id'];
				if($_GET['sup']==1){
					$table = "equivalences";
				}
				else if($_GET['sup']==5){
					$table = "dictionnaire_region";
				}
				else if($_GET['sup']==6){
					$table = "armorial";
				}
				else if($_GET['sup']==7){ // Il faudra aussi supprimer les images associées
					$table = "legende_photos";
					
					$photos = $this->Model_administration->getPhotos($id);// On supprime les images du FTP
					
					foreach ($photos as $row)
					{
						$libelle = $row['libellé_image'];
						
					}
					
					if($libelle!=""){ //On supprime les images associées au contenu
						$photo = explode(";", $libelle);
						
						for($i=0;$i<sizeof($photo);$i++){
							if($photo[$i]!=""){
								$dirname = $_SERVER['DOCUMENT_ROOT'].'/../ressources/images/';
								$dir = opendir($dirname); // On ouvre le dossier images
								while($file = readdir($dir)) // On parcourt les fichiers
								{
									if($file != '.' && $file != '..' && !is_dir($dirname.$file) && $file==$photo[$i].".jpg")
									{
										chmod($dirname.$file, 0777);
										unlink($dirname.$file); // On supprime l'image
									}
								}
							}
						}
					}
				}
				
				$this->Model_administration->supression($table,$id);
			}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			
			/*
				|---------------------------------------------------------------------------------------------------
				| Tableau des équivalences
				|---------------------------------------------------------------------------------------------------
			*/
			
			// Ajout d'une nouvelle équivalence
			if(isset($_GET['ajout_equivalence'])){
				
				$expression_1 = addslashes($_GET['mot_1']);
				$expression_2 = addslashes($_GET['mot_2']);
				
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
				|----------------------------------------------------------------------------------------------------
			*/
			
			/*
				|---------------------------------------------------------------------------------------------------
				| Ajouts manuels de contenus
				|---------------------------------------------------------------------------------------------------
			*/
			$manuel = "";
			$booleen = "";
			
			// Partie armorial
			if(isset($_GET['manuel_armorial'])){
				
				if($_GET['famille']=="" && $_GET['prenom']=="" && $_GET['titres_dignites']=="" &&
				$_GET['origine']=="" && $_GET['date']=="" && $_GET['fief']=="" &&
				$_GET['aire']=="" && $_GET['pays']=="" &&
				$_GET['region']=="" && $_GET['region_bis']=="" && $_GET['department']=="" && $_GET['alliances']=="" &&
				$_GET['notes']=="" && $_GET['blasonnement']=="" && $_GET['cimiers']=="" && $_GET['devise']=="" &&
				$_GET['embleme']=="" && $_GET['lambrequins']=="" && $_GET['support']=="" && $_GET['observations']=="" &&
				$_GET['ref_biblio']==""){
					
					$manuel = "Veuillez remplir au moins une case!";
					$booleen = true;
					
				}
				else{

					$famille = addslashes($_GET['famille']);
					$prenom = addslashes($_GET['prenom']);
					$titres_dignites = addslashes($_GET['titres_dignites']);
					$origine = addslashes($_GET['origine']);
					$date = addslashes($_GET['date']);
					$fief = addslashes($_GET['fief']);
					$aire = addslashes($_GET['aire']);
					$pays = addslashes($_GET['pays']);
					$region = addslashes($_GET['region']);
					//$region_bis = addslashes($_GET['region_bis']);
					$department = addslashes($_GET['department']);
					$alliances = addslashes($_GET['alliances']);
					$notes = addslashes($_GET['notes']);
					$blasonnement = addslashes($_GET['blasonnement']);
					$cimiers = addslashes($_GET['cimiers']);
					$devise = addslashes($_GET['devise']);
					$embleme = addslashes($_GET['embleme']);
					$lambrequins = addslashes($_GET['lambrequins']);
					$support = addslashes($_GET['support']);
					$observations = addslashes($_GET['observations']);
					$ref_biblio = addslashes($_GET['ref_biblio']);

					$_GET['la'] = substr($famille, 0, 1); // Pour revenir sur le tableau à la lettre du nouveau contenu

                    // Remplacement de région par région_bis dans le INSERT INTO
                    // Suppression de $region
                    // Rajout de patronyme = $famille
                    $this->db->query("INSERT INTO armorial (famille,prenom,titres_dignites,origine,date,fief,aire,pays,région_bis,
					départment,alliances,notes,blasonnement_1,cimiers,devise,embleme,lambrequins,support,observations,ref_biblio) VALUES('$famille','$prenom','$titres_dignites',
					'$origine','$date','$fief','$aire','$pays','$region','$department','$alliances','$notes','$blasonnement',
					'$cimiers','$devise','$embleme','$lambrequins','$support','$observations','$ref_biblio')");

					$manuel = "L'ajout a bien été effectué";
					$booleen = true;
				}
				
			}
			else if(isset($_POST['manuel_objet'])){// Partie objets
				
				$libelle_image = $this->images_bdd();
				
				$vedette_chandon = addslashes($_POST['vedette_chandon']);
				$famille = addslashes($_POST['famille']);
				$individu = addslashes($_POST['individu']);
				$qualite = addslashes($_POST['qualite']);
				$date = addslashes($_POST['date']);
				$denomination = addslashes($_POST['denomination']);
				$titre = addslashes($_POST['titre']);
				$categorie = addslashes($_POST['categorie']);
				$ref_reproductions = addslashes($_POST['ref_reproductions']);
				$biblio = addslashes($_POST['biblio']);
				$remarques = addslashes($_POST['remarques']);
				$auteurs = addslashes($_POST['auteurs']);
				$lieu_edition = addslashes($_POST['lieu_edition']);
				$editeur = addslashes($_POST['editeur']);
				$annee_edition = addslashes($_POST['annee_edition']);
				$reliure = addslashes($_POST['reliure']);
				$provenance = addslashes($_POST['provenance']);
				$site = addslashes($_POST['site']);
				$section = addslashes($_POST['section']);
				$cote = addslashes($_POST['cote']);
				$folio_emplacement = addslashes($_POST['folio_emplacement']);
				$auteur_cliche = addslashes($_POST['auteur_cliche']);
				$type_cliche = addslashes($_POST['type_cliche']);
				$annee_cliche = addslashes($_POST['annee_cliche']);
				$pays = addslashes($_POST['pays']);
				$region = addslashes($_POST['region']);
				$department = addslashes($_POST['department']);
				$commune = addslashes($_POST['commune']);
				$village = addslashes($_POST['village']);
				$edifice_conservation = addslashes($_POST['edifice_conservation']);
				$emplacement_dans_edifice = addslashes($_POST['emplacement_dans_edifice']);
				$photo = addslashes($_POST['photo']);
				$commune_INSEE_number = addslashes($_POST['commune_INSEE_number']);
				$ref_IM = addslashes($_POST['ref_IM']);
				$ref_PA = addslashes($_POST['ref_PA']);
				$ref_IA = addslashes($_POST['ref_IA']);
				
				$this->db->query("INSERT INTO legende_photos (libellé_image,vedette_chandon,famille,individu,qualité,date,dénomination,
				titre,catégorie,ref_reproductions,biblio,remarques,auteurs,lieu_édition,editeur,
				année_édition,reliure,provenance,site,section,cote,folio_emplacement,auteur_cliché,type_cliché,
				année_cliché,pays,région,départment,commune,village,edifice_conservation,emplacement_dans_édifice,photo,commune_INSEE_number,
				ref_IM,ref_PA,ref_IA) VALUES('$libelle_image','$vedette_chandon','$famille',
				'$individu','$qualite','$date','$denomination','$titre','$categorie','$ref_reproductions','$biblio',
				'$remarques','$auteurs','$lieu_edition','$editeur','$annee_edition','$reliure','$provenance','$site','$section','$cote',
				'$folio_emplacement','$auteur_cliche','$type_cliche','$annee_cliche','$pays','$region','$department','$commune','$village','$edifice_conservation',
				'$emplacement_dans_edifice','$photo','$commune_INSEE_number','$ref_IM','$ref_PA','$ref_IA')");
				
				$manuel = "L'ajout a bien été effectué";
				$booleen = true;
			}
			
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			
			/*
				|---------------------------------------------------------------------------------------------------
				| Traitement de l'ajout d'images à un contenu existant
				|---------------------------------------------------------------------------------------------------
			*/
			
			if(isset($_POST['ajouter_photos_libelle'])){
				
				$id_contenu = $_POST['id'];
				
				// On insert les images dans le dossier images
				$transfert = $this->insertion_images();
				$transfert = $this->compression();
				
				// On insert les libellés dans la bdd
				$libelle_image = $this->images_bdd();
				$this->Model_administration->miseAjourImages($libelle_image, $id_contenu);
				
			}
			
			/*
				|---------------------------------------------------------------------------------------------------------
			*/
			
			/*
				|---------------------------------------------------------------------------------------------------
				| Traitement pour l'affichage de la partie modification des données de la base
				|---------------------------------------------------------------------------------------------------
			*/
			$lettre_armorial = '';
			$lettre_objets = '';
			
			// Affichage tableau armorial
			if(isset ($_GET['la'])){
				$lettre_armorial = $_GET['la'];
			}
			
			if($lettre_armorial!=''){
				$donnees_armorial = $this->Model_administration->affich_table('armorial',$lettre_armorial);
			}
			else{
				$donnees_armorial = $this->Model_administration->affich_table('armorial','a'); // Requête pour récupérer toutes les données de la table 'legende/photos'
			}
			$donnees_armorial = $donnees_armorial->result_array();
			
			// Affichage tableau objets
			if(isset ($_GET['lo'])){
				$lettre_objets = $_GET['lo'];
			}
			
			if($lettre_objets!=''){
				$donnees_objets = $this->Model_administration->affich_table('legende_photos',$lettre_objets);
			}
			else{
				$donnees_objets = $this->Model_administration->affich_table('legende_photos','a'); // Requête pour récupérer toutes les données de la table 'legende/photos'
			}
			$donnees_objets = $donnees_objets->result_array();
			
			/*
				|---------------------------------------------------------------------------------------------------------
			*/
			
			/*
				|---------------------------------------------------------------------------------------------------
				| Historique des mots armes 
				|---------------------------------------------------------------------------------------------------
			*/
			
			$query = $this->db->query('SELECT * FROM armorial');
			
			$entrees = $query->num_rows();
			
			$nbre_lignes = abs($entrees/5000);
			
			if(isset($_GET['hist'])){
				$historique = explode(",", $_GET['hist']);
				$this->historique($historique[0],$historique[1]);
			}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			else if(!isset($_GET['exc'])){
				// Tableau $data des variables à envoyer aux vues
				$data = array(
				'connecte' => $session, // La variable $connecte est utilisée dans la vue footer.php
				'acces' => $acces,
				'visites' => $visites,
				'date' => $date,
				'mail' => $mail,
				'equivalences' => $equivalences,
				'transfert' => $transfert,
				'donnees_armorial' => $donnees_armorial,
				'donnees_objets' => $donnees_objets,
				'manuel' => $manuel,
				'booleen' => $booleen,
				'nbre_lignes' => $nbre_lignes,
				'entrees' =>$entrees,
				'bulle_identifiants' => $bulle_identifiants,
				'bulle_visites' => $bulle_visites,
				'bulle_mail' => $bulle_mail,
				'bulle_excel' => $bulle_excel,
				'bulle_contenus' => $bulle_contenus,
				'bulle_ajout' =>$bulle_ajout,
				'bulle_switchrecherche' =>$bulle_switchrecherche,
				'presentation_heraldique'=>$presentation_heraldique,
				'idr' =>$idr,
				'idrecherche' => $idrecherche,
				'idtitre' => $idtitre,
				'idtitre2' => $idtitre2,
				'current_publique' => $current_publique // recherche publique activée ou non
				);
				
				// Chargement des vues à afficher (attention à l'ordre) (les vues sont dans le dossier /system/application/views)
				$this->load->view('layout/header',$data);	
				$this->load->view('administration/administration',$data);
				$this->load->view('layout/footer',$data);
			}
			
		}
		
		function identification (){ // Fonction qui gère la connexion/déconnexion
			
			// Chargement des modèles utilisés dans le controller (les modèles sont dans le dossier /system/application/models)
			$this->load->model('Model_administration');	
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Bouton de déconnexion (voir vue footer.php) qui met la variable $session = FALSE (càd non connecté)			
				|----------------------------------------------------------------------------------------------------
			*/
			$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connecté) ou $session=FALSE (admin est pas connecté)
			if (isset($_GET['deconnexion']) && $_GET['deconnexion'] == 'Deconnexion') {
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
			'logged_in' => FALSE
			);
			$this->session->set_userdata($newdata);	
			
			if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') { // On vérifie que le formulaire a été envoyé
				if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) {
					foreach ($identifiants as $identifiant) {	// On compare les identifiants envoyés avec ceux de la bdd
						if (($identifiant->login == $_POST['login'] ) && ($identifiant->password == $_POST['pass'])) { // Si les identifiants sont correctes, la variable de session logged_in passe à TRUE
							$newdata = array(
							'logged_in' => TRUE
							);
							$this->session->set_userdata($newdata); 
							$session = $this->session->userdata('logged_in'); // $session = TRUE (l'admin est connecté)
							header("Location: ".base_url()); // Redirection vers la page d'administration
						}
					}
					$error='<div class="error"><strong>Identifiants incorrects</strong></div>';		
				}
				else {
					$error='<div class="error"><strong>Identifiants incorrects</strong></div>';			
				}				
			}
			if(isset($_GET['lost'])){ // Si l'administrateur a oublié le mdp
				$this->send_password();
				$error = '<div class="error"><strong>Le mot de passe vous a été envoyé par email</strong></div>';
			}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			
			// Tableau $data des variables à envoyer aux vues			
			$data = array(
			'connecte' => $session, // La variable $connecte est utilisée dans la vue footer.php et administration.php (et toutes les autres vues où on a besoin de savoir si l'admin est connecté ou pas)
			'error' => $error // La variable $error est utilis�e dans la vue identification.php
			
			);
			
			// Chargement des vues à afficher (attention à l'ordre) (les vues sont dans le dossier /system/application/views)	
			//$this->load->view('layout/header',$data);	
			$this->load->view('administration/identification',$data);
			// $this->load->view('layout/footer',$data);	
		}
		
        function historique($start,$end){ // Fonction qui gère la production d'un fichier word avec tous les mots utilisés pour les armes
			// On récupère les armes
			$tableau = "";
			$mots = "";
			$patronyme_fiche = "";
			$premiere_lettre = "";
			$new_mot = "";
			$memoire[] = "";
			$test = 0;
			$test1 = "";
			$hauteur = "";
			
			$lettres[][] = "";
			$lettres[0][0]="A";
			$lettres[1][0]="B";
			$lettres[2][0]="C";
			$lettres[3][0]="D";
			$lettres[4][0]="E";
			$lettres[5][0]="F";
			$lettres[6][0]="G";
			$lettres[7][0]="H";
			$lettres[8][0]="I";
			$lettres[9][0]="J";
			$lettres[10][0]="K";
			$lettres[11][0]="L";
			$lettres[12][0]="M";
			$lettres[13][0]="N";
			$lettres[14][0]="O";
			$lettres[15][0]="P";
			$lettres[16][0]="Q";
			$lettres[17][0]="R";
			$lettres[18][0]="S";
			$lettres[19][0]="T";
			$lettres[20][0]="U";
			$lettres[21][0]="V";
			$lettres[22][0]="W";
			$lettres[23][0]="X";
			$lettres[24][0]="Y";
			$lettres[25][0]="Z";
			
			$patronyme[0][0] = "";
			$patronyme[1][0] = "";
			$patronyme[2][0] = "";
			$patronyme[3][0] = "";
			$patronyme[4][0] = "";
			$patronyme[5][0] = "";
			$patronyme[6][0] = "";
			$patronyme[7][0] = "";
			$patronyme[8][0] = "";
			$patronyme[9][0] = "";
			$patronyme[10][0] = "";
			$patronyme[11][0] = "";
			$patronyme[12][0] = "";
			$patronyme[13][0] = "";
			$patronyme[14][0] = "";
			$patronyme[15][0] = "";
			$patronyme[16][0] = "";
			$patronyme[17][0] = "";
			$patronyme[18][0] = "";
			$patronyme[19][0] = "";
			$patronyme[20][0] = "";
			$patronyme[21][0] = "";
			$patronyme[22][0] = "";
			$patronyme[23][0] = "";
			$patronyme[24][0] = "";
			$patronyme[25][0] = "";
			
			$armes = $this->Model_administration->getArmes($start,$end);
			$armes = $armes ->result();
			
			foreach ($armes as $row)
			{
				$mots = $row-> blasonnement_1;
				$mots = explode(" ", $mots);
				
				
				$patronyme_fiche = $row-> patronyme;
				
				for($i=0;$i<sizeof($mots);$i++){ // On parcourt l'expression
					
					$test = 0;
					
					for($k=0;$k<sizeof($memoire);$k++){ // On vérifie que le mot n'a pas déjà été traité
						if($mots[$i]==$memoire[$k]){
							$test = 1;
							break;
						}
					}
					
					$new_mot = str_replace(",","",str_replace("_","",$mots[$i]));
					$premiere_lettre = substr($new_mot, 0, 1);
					
					for($j=0;$j<sizeof($lettres);$j++){
						
						switch (strtolower($premiere_lettre)){
							case strtolower($lettres[$j][0]):
							$taille = sizeof($lettres[$j]);
							$lettres[$j][$taille]=$new_mot;
							$patronyme[$j][$taille]=$patronyme_fiche;
							break;
						}
					}
					
				}
				
			}
			
			$tableau = "<center><table border='1' width='50%' style='text-align:center;border-collapse:collapse;'>
			<thead>
			<tr style='background-color:black;color:white;'>
			<th>Lettre</th>
			<th>Mot</th>
			<th>Patronyme</th>
			</tr>
			</thead>
			<tbody>";
			
			
			for($j=0;$j<sizeof($lettres);$j++){
				if(isset($lettres[$j][1])){
					$hauteur = sizeof($lettres[$j])-1;
					$tableau.= "<tr>
					<td rowspan=".$hauteur.">".$lettres[$j][0]."</td><td>".utf8_decode($lettres[$j][1])."</td><td>".$patronyme[$j][0]."</td>
					</tr>";
					for($i=1;$i<sizeof($lettres[$j])-1;$i++){
						$tableau.="<tr>
						<td>".utf8_decode($lettres[$j][$i+1])."</td><td>".$patronyme[$j][$i]."</td>
						</tr>";
					}
				}
			}
			
			
			$tableau.="</tbody>
			</table>";
			
			$data = array(
			'tableau' => $tableau,
			);
			
			$this->load->view('administration/armes',$data);
			
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
					
					if($resultat)
					{
						$transfert = htmlentities("Transfert r�ussi");
						
						Include($_SERVER['DOCUMENT_ROOT'].'/../Excel/reader.php'); // Inclusion de la biblio de traitement de fichiers excel
						
						$donnees = "";
						
						// Instanciation de la classe permettant la lecture du fichier excel
						$data = new Spreadsheet_Excel_Reader();
						
						// Définition du type d�encodage de caractère à utiliser pour la sortie (ce qui va être affiché à l'écran)
						$data->setOutputEncoding('UTF-8');
                        $data->setUTFEncoder('mb');
						
						// Chargement du fichier excel à lire
						$data->read($nom);
						
						error_reporting(0);
						
						// Parse l'intégralité du fichier excel
						for ($i = 0; $i <= $data->sheets[0]['numRows']; $i++) {
							for ($j = 0; $j <= $data->sheets[0]['numCols']; $j++) {
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
		
        function send_password(){ // Fonction pour renvoyer le mot de passe dans la boite email admin enregistrée
			
			$identifiants = $this->Model_administration->identifiant();
			foreach ($identifiants as $identifiant) {	// On compare les identifiants envoyés avec ceux de la bdd
				$mdp = $identifiant->password;
				$login = $identifiant->login;
			}
			
			$mail = $this->Model_administration->getMail(); // Récupération de l'adresse mail administrateur
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
			//===== Déclaration des messages au format texte et au format HTML.
			$message_html = "<html><head></head><body>
			<b>Rappel des identifiants: </b><br />
			Les identifiants pour accéder au site 'Héraldique' (www.livre.palisep.fr) sont les suivants<br />
			Login: <b>".$login."</b><br />
			Mot de passe : <b>".$mdp."</b><br />";
			
			//==========
			
			//===== Création de la boundary.
			$boundary = "-----=".md5(rand());
			$boundary_alt = "-----=".md5(rand());
			//==========
			
			//===== Définition du sujet.
			$sujet = "Renvoi du mot de passe 'Héraldique'";
			//=========
			
			//===== Création du header de l'e-mail.
			$header = "From: \"Palisep\"<admin@palisep.fr>".$passage_ligne;
			$header.= "Reply-to: \"WeaponsB\" <admin@palisep.fr>".$passage_ligne;
			$header.= "MIME-Version: 1.0".$passage_ligne;
			$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
			//==========
			
			//===== Création du message.
			$message = $passage_ligne."--".$boundary.$passage_ligne;
			$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
			$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
			
			//===== Ajout du message au format HTML.
			$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
			$message.= $passage_ligne.$message_html.$passage_ligne;
			//==========
			
			//===== On ferme la boundary alternative.
			$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
			//==========
			
			$message.= $passage_ligne."--".$boundary.$passage_ligne;
			
			//===== Envoi de l'e-mail.
			mail($mail_admin,$sujet,$message,$header);
			//==========
			
		}
		
		function insertion_images() // Fonction qui enregistre les images dans le dossier temporaire
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
							// On copie le fichier
							$nom = $_SERVER['DOCUMENT_ROOT']."/fichiers_tmp/".$_FILES['images_'.$i]['name'];
							$resultat = move_uploaded_file($_FILES['images_'.$i]['tmp_name'],$nom);
							
							if($extension_upload=='zip') // Si c'est une archive
							{
								require_once( $_SERVER['DOCUMENT_ROOT'].'/../system/libraries/pclzip.lib.php');
								$archive = new PclZip($nom); // On crée un nouvel objet archive à partir du fichier uploadé
								
								if ($archive->extract($_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/') == 0) //on extrait ds le dossier sp�cifi�
								{
									die("Error : ".$archive->errorInfo(true));
								}
								else // Si l'extraction s'est bien passée
								{
									$dirname = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/';
									$dir = opendir($dirname); // On ouvre le dossier des fichiers temporaires
									unlink($nom); // On supprime l'archive
									
									$dossier = explode(".",$_FILES['images_'.$i]['name']);
									$dossier = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$dossier[0].'/';
									$dir = opendir($dossier); // On ouvre le dossier issu de l'extraction
									
									while($file = readdir($dir))
									{
										if($file != '.' && $file != '..' && !is_dir($dossier.$file))
										{
											copy($dossier.$file, $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/'.$file); // On déplace tous les fichiers
											unlink($dossier.$file); // On les supprime du dossier
										}
									}
									
									rmdir($dossier); // On supprime le dossier issu de l'extraction
									
									closedir($dir);
								}
							}
							
						}
					}
				}
			}
			return $transfert;
		}
		
		function compression() // Fonction qui compresse les images du dossier temporaire et les déplace dans le dossier "images"
		{
			
			error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
			$dirname = $_SERVER['DOCUMENT_ROOT'].'/fichiers_tmp/';
			$dir = opendir($dirname); // On ouvre le dossier temporaire
			
			$transfert = "";
			
			while($file = readdir($dir)) // On parcourt les fichiers
			{
				if($file != '.' && $file != '..' && !is_dir($dirname.$file))
				{
					$titre = explode(".",$file);
					
					// montagne.jpg : $titre[0] = montagne, $titre[1] = jpg
					
					// On configure les paramètres pour la compression
					$config['image_library'] = 'GD';
					$config['source_image'] = $dirname.$file; // Le fichier source
					$config['quality'] = '75%'; //La qualit� du fichier apr�s compression
					$config['new_image'] = $_SERVER['DOCUMENT_ROOT'].'/../ressources/images/'.$titre[0].".jpg"; // Le nouveau fichier
					// $config['new_image'] = '/home/marine/Bureau/'.$titre[0].".jpg";
					$this->load->library('image_lib'); // On charge les fonctions image de CodeIgniter
					$this->image_lib->initialize($config);
					$this->image_lib->resize(); // On lance la compression
					if ( ! $this->image_lib->resize())
					echo $this->image_lib->display_errors();
					// $transfert = "";
					// $transfert = "Une erreur s'est produite!";
					else
					$transfert = "";
					// $transfert = "Photo(s) charg&eacute;e(s)";
					
					chmod($dirname.$file, 0777);
					unlink($dirname.$file); // On supprime les images du dossier temporaire
				}
			}
			return $transfert;
		}
		
		function images_bdd(){ //Fonction qui récupère les titres des images insérées pour les mettre dans la colonne "libellé image" de la base
			
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
		
	}
?>
