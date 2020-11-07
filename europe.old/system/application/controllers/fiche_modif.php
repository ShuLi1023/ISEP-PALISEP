<?php
	
	class Fiche_modif extends Controller {
		
		function index($id = '',$table = ''){ // On a en paramètre l'id et le nom de la table qui ont été passés en GET
			
			// Chargement des modèles utilisés dans le contrôleur (les modèles sont dans le dossier /system/application/models)
			$this->load->model('Model_fiche_modif');
			$this->load->model('Model_administration');
			
			$update = "";
			$donnees = "";
			
			if($table=="armorial"){
				if(isset($_POST['patronyme'])) // Modification médiathèque
				{
					$patronyme = addslashes($_POST['patronyme']);
					$prenom = addslashes($_POST['prenom']);
					$famille = addslashes($_POST['famille']);
					$titres_dignites = addslashes($_POST['titres_dignites']);
					$origine = addslashes($_POST['origine']);
					$date = addslashes($_POST['date']);
					$siecle = addslashes($_POST['siecle']);
					$fief = addslashes($_POST['fief']);
					$pays = addslashes($_POST['pays']);
					$province = addslashes($_POST['province']);
					$region = addslashes($_POST['region']);
					$department = addslashes($_POST['department']);
					$ville = addslashes($_POST['ville']);
					$alliances = addslashes($_POST['alliances']);
					$armoiries = "";
					$notes = addslashes($_POST['notes']);
					$observations = "";
					$sources = addslashes($_POST['sources']);
					$le_clert = "";
					$armorial_gen_champagne = "";
					$notes_armoriaux = addslashes($_POST['notes_armoriaux']);
					$genealogie = addslashes($_POST['genealogie']);
					$document = addslashes($_POST['document']);
					$timbre = addslashes($_POST['timbre']);
					$cimier = addslashes($_POST['cimier']);
					$devise_cri = addslashes($_POST['devise_cri']);
					$tenants_support = addslashes($_POST['tenants_support']);
					$decoration = addslashes($_POST['decoration']);
					$ornements_ext = addslashes($_POST['ornements_ext']);
					$emblemes = addslashes($_POST['emblemes']);
					$images_geneal = addslashes($_POST['images_geneal']);
					$images_doc = addslashes($_POST['images_doc']);
					$blasonnement_1 = addslashes($_POST['blasonnement_1']);
					$blasonnement_2 = addslashes($_POST['blasonnement_2']);
					$blasonnement_3 = addslashes($_POST['blasonnement_3']);
					
					$this->Model_fiche_modif->update_legende_photos($id, $patronyme);
					
					$this->db->query("UPDATE armorial SET
                    patronyme = '$patronyme',
                    prenom = '$prenom',
                    famille = '$famille',
                    titres_dignites = '$titres_dignites',
                    origine = '$origine',
                    date = '$date',
                    siècle = '$siecle',
                    fief = '$fief',
                    pays = '$pays',
                    province = '$province',
                    région = '$region',
                    départment = '$department',
                    ville = '$ville',
                    alliances = '$alliances',
                    armoiries = '',
                    notes = '$notes',
                    observations = '',
                    sources = '$sources',
                    le_clert = '',
                    armorial_gen_champagne = '',
                    notes_armoriaux = '$notes_armoriaux',
                    genealogie = '$genealogie',
                    document = '$document',
                    timbre = '$timbre',
                    cimier = '$cimier',
                    devise_cri = '$devise_cri',
                    tenants_support = '$tenants_support',
                    decoration = '$decoration',
                    ornements_ext = '$ornements_ext',
                    emblemes = '$emblemes',
                    images_geneal = '$images_geneal',
                    images_doc = '$images_doc',
                    blasonnement_1 = '$blasonnement_1',
                    blasonnement_2 = '$blasonnement_2',
                    blasonnement_3 = '$blasonnement_3'
					WHERE id='$id'");
					
					
					$_SESSION['anc_onglet'] = "modif";
					$_SESSION['lc'] = substr($patronyme, 0, 1);
					header("Location: ".base_url()."administration"); // On redirige vers la page d'administration
					
				}
				else
				{
					$donnees = $this->Model_fiche_modif->recherche_infos($id,$table); // On recherche les informations concernant la table
					
					
					// Tableau $data des variables à envoyer aux vues			
					$data = array(
					'donnees'	=> $donnees,
					'table'		=> $table,
					'update'	=> $update,
					
					
					);
					
					// Chargement des vues à afficher (attention à l'ordre) (les vues sont dans le dossier /system/application/views)	
					$this->load->view('administration/fiche_modif',$data);
				}
			}
			
			elseif($table="legende_photos"){
				
				if(isset($_POST['vedette_chandon'])) // Modification médiathèque
				{
					
					
					$vedette_chandon = addslashes($_POST['vedette_chandon']);
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
					$artificial_number_Decrock = "";
					$famille = addslashes($_POST['famille']);
					$individu = addslashes($_POST['individu']);
					$qualite = addslashes($_POST['qualite']);
					$date = addslashes($_POST['date']);
					$denomination = addslashes($_POST['denomination']);
					$titre = addslashes($_POST['titre']);
					$categorie = addslashes($_POST['categorie']);
					$materiau = addslashes($_POST['materiau']);
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
					$cimiers = addslashes($_POST['cimiers']);
					$blasonnement_1 = addslashes($_POST['blasonnement_1']);
					$blasonnement_2 = addslashes($_POST['blasonnement_2']);
					
					
					
					$this->db->query("UPDATE legende_photos SET
                    vedette_chandon = '$vedette_chandon',
                    auteur_cliché = '$auteur_cliche',
                    type_cliché = '$type_cliche',
                    année_cliché = '$annee_cliche',
                    pays = '$pays',
                    région = '$region',
                    départment = '$department',
                    commune = '$commune',
                    village = '$village',
                    edifice_conservation = '$edifice_conservation',
                    emplacement_dans_édifice = '$emplacement_dans_edifice',
                    photo = '$photo',
                    commune_INSEE_number = '$commune_INSEE_number',
                    ref_IM = '$ref_IM',
                    ref_PA = '$ref_PA',
                    ref_IA = '$ref_IA',
                    artificial_number_Decrock = '',
                    famille = '$famille',
                    individu = '$individu',
                    qualité = '$qualite',
                    date = '$date',
                    dénomination = '$denomination',
                    titre = '$titre',
                    catégorie = '$categorie',
                    matériau = '$materiau',
                    ref_reproductions = '$ref_reproductions',
                    biblio = '$biblio',
                    remarques = '$remarques',
                    auteurs = '$auteurs',
                    lieu_édition = '$lieu_edition',
                    editeur = '$editeur',
                    année_édition = '$annee_edition',
                    reliure = '$reliure',
                    provenance = '$provenance',
                    site = '$site',
                    section = '$section',
                    cote = '$cote',
                    folio_emplacement = '$folio_emplacement',
                    cimiers = '$cimiers',
                    blasonnement_1 = '$blasonnement_1',
                    blasonnement_2 = '$blasonnement_2'                    
					WHERE id='$id'");
					
					
					$_SESSION['anc_onglet'] = "modif";
					$_SESSION['lc'] = substr($vedette_chandon, 0, 1);
					header("Location: ".base_url()."administration"); //On redirige vers la page d'administration
					
				}
				else
				{
					$donnees = $this->Model_fiche_modif->recherche_infos($id,$table); // On recherche les informations concernant la table
					
					
					// Tableau $data des variables à envoyer aux vues           
					$data = array(
					'donnees' => $donnees,
					'table' => $table,
					'update' => $update,
					
					
					);
					
					// Chargement des vues à afficher (attention à l'ordre) (les vues sont dans le dossier /system/application/views)   
					$this->load->view('administration/fiche_modif',$data);
				}
			}
			
		}
		
	}
	
?>