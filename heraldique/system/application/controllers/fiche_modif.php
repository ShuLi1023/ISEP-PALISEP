<?php	
		
	class Fiche_modif extends Controller {		
				
		function index(){ // Gestion de la modif d'un contenu via l'admin			
						
			// Chargement des modèles utilisés dans le contrôleur (les modèles sont dans le dossier /system/application/models)			
			$this->load->model('Model_fiche_modif');			
						
			$update = "";			
			$donnees = "";			
			$table = "";			
			$id = "";			
			$contenu = "";			
			$lettre = "";			
						
			if(isset($_GET['famille'])) // Modification			
			{				
				if(isset($_GET['blasonnement'])){ // S'il s'agit d'armorial					
										
					$table = "armorial";					
					$id = $_GET['id'];					
					$contenu = "la";					
										
					// Récupération des données entrées					
					$famille = addslashes($_GET['famille']);					
					$prenom = addslashes($_GET['prenom']);					
					$titres_dignites = addslashes($_GET['titres_dignites']);					
					$origine = addslashes($_GET['origine']);					
					$date = addslashes($_GET['date']);					
					$siecle = addslashes($_GET['siecle']);					
					$fief = addslashes($_GET['fief']);					
					$region = addslashes($_GET['region']);										$region_bis = addslashes($_GET['region_bis']);					
					$departement = addslashes($_GET['departement']);					
					$alliances = addslashes($_GET['alliances']);					
					$notes = addslashes($_GET['notes']);					
					$blasonnement = addslashes($_GET['blasonnement']);					
					$cimiers = addslashes($_GET['cimiers']);					
					$devise = addslashes($_GET['devise']);					
					$lambrequins = addslashes($_GET['lambrequins']);					
					$support = addslashes($_GET['support']);					
					$embleme = addslashes($_GET['embleme']);					
					$observations = addslashes($_GET['observations']);					
					$ref_biblio = addslashes($_GET['ref_biblio']);					
										
					// Requête					
					$requete = "patronyme='$famille',					
					famille='$famille',					
					prenom='$prenom',					
					titres_dignites='$titres_dignites',					
					origine='$origine',					
					date='$date',					
					siècle='$siecle',					
					fief='$fief',					
					région='$region',										région_bis='$region_bis',					
					départment='$departement',					
					alliances='$alliances',					
					notes='$notes',					
					blasonnement_1='$blasonnement',					
					cimiers='$cimiers',					
					devise='$devise',					
					embleme='$embleme',					
					lambrequins='$lambrequins',					
					support='$support',					
					embleme='$embleme',					
					observations='$observations',					
					ref_biblio='$ref_biblio'";					
										
					$lettre = substr($famille, 0, 1);					
										
										
					}else if(isset($_GET['vedette_chandon'])){ // S'il s'agit des objets					
										
					$table = "legende_photos";					
					$id = $_GET['id'];					
					$contenu = "lo";					
										
					// Récupération des données entrées					
					$famille = addslashes($_GET['famille']);  // Pour chaque input, on ajoute des slashes pour protéger les apostrophes et on encode en utf8					
					$vedette_chandon = addslashes($_GET['vedette_chandon']);					
					$individu = addslashes($_GET['individu']);					
					$qualite = addslashes($_GET['qualite']);					
					$date = addslashes($_GET['date']);					
					$denomination = addslashes($_GET['denomination']);					
					$titre = addslashes($_GET['titre']);					
					$categorie = addslashes($_GET['categorie']);					
					$materiau = addslashes($_GET['materiau']);					
					$ref_reproductions = addslashes($_GET['ref_reproductions']);					
					$biblio = addslashes($_GET['biblio']);					
					$remarques = addslashes($_GET['remarques']);					
					$auteurs = addslashes($_GET['auteurs']);					
					$lieu_edition = addslashes($_GET['lieu_edition']);					
					$editeur = addslashes($_GET['editeur']);					
					$annee_edition = addslashes($_GET['annee_edition']);					
					$reliure = addslashes($_GET['reliure']);					
					$provenance = addslashes($_GET['provenance']);					
					$site = addslashes($_GET['site']);					
					$section = addslashes($_GET['section']);					
					$cote = addslashes($_GET['cote']);					
					$folio_emplacement = addslashes($_GET['folio_emplacement']);					
					$auteur_cliche = addslashes($_GET['auteur_cliche']);					
					$type_cliche = addslashes($_GET['type_cliche']);					
					$annee_cliche = addslashes($_GET['annee_cliche']);					
					$pays = addslashes($_GET['pays']);					
					$region = addslashes($_GET['region']);					
					$departement = addslashes($_GET['departement']);					
					$commune = addslashes($_GET['commune']);					
					$village = addslashes($_GET['village']);					
					$auteur_cliche = addslashes($_GET['auteur_cliche']);					
					$emplacement_dans_edifice = addslashes($_GET['emplacement_dans_edifice']);					
					$photo = addslashes($_GET['photo']);					
					$commune_INSEE_number = addslashes($_GET['commune_INSEE_number']);					
					$ref_IM = addslashes($_GET['ref_IM']);					
					$ref_PA = addslashes($_GET['ref_PA']);					
					$ref_IA = addslashes($_GET['ref_IA']);					
										
					//requete					
					$requete = "famille='$famille',					
					vedette_chandon='$vedette_chandon',					
					individu='$individu',					
					qualité='$qualite',					
					date='$date',					
					dénomination='$denomination',					
					titre='$titre',					
					catégorie='$categorie',					
					matériau='$materiau',					
					ref_reproductions='$ref_reproductions',					
					biblio='$biblio',					
					remarques='$remarques',					
					auteurs='$auteurs',					
					lieu_édition='$lieu_edition',					
					editeur='$editeur',					
					année_édition='$annee_edition',					
					reliure='$reliure',					
					provenance='$provenance',					
					site='$site',					
					section='$section',					
					cote='$cote',					
					folio_emplacement='$folio_emplacement',					
					auteur_cliché='$auteur_cliche',					
					type_cliché='$type_cliche',					
					année_cliché='$annee_cliche',					
					pays='$pays',					
					région='$region',					
					départment='$departement',					
					commune='$commune',					
					village='$village',					
					auteur_cliché='$auteur_cliche',					
					emplacement_dans_édifice='$emplacement_dans_edifice',					
					photo='$photo',					
					commune_INSEE_number='$commune_INSEE_number',					
					ref_IM='$ref_IM',					
					ref_PA='$ref_PA',					
					ref_IA='$ref_IA'";					
										
										
				}				
								
				$lettre = substr($famille, 0, 1);				
								
				$this->db->query("UPDATE ".$table." SET ".$requete." WHERE id='$id'");				
								
				if(isset($_GET['vedette_chandon'])){					
					// On regarde si des images ont été cochées					
					$images = $_GET['all_pictures'];					
					$image = explode(";",$images);					
					$new_images = $images;					
										
					for($i=0;$i<sizeof($image);$i++){						
						if(isset($_GET[$image[$i]]) && $image[$i]!=""){							
							// On retire les nom des images à supprimer du libelle_image de la bdd							
							$new_images = str_replace($image[$i].";", "", $new_images);							
														
							$dirname = $_SERVER['DOCUMENT_ROOT'].'/../ressources/images/';							
							$dir = opendir($dirname); // On ouvre le dossier images							
							while($file = readdir($dir)) // On parcourt les fichiers							
							{								
								if($file != '.' && $file != '..' && !is_dir($dirname.$file) && $file==$image[$i].".jpg")								
								{									
									chmod($dirname.$file, 0777);									
									unlink($dirname.$file); // On supprime l'image du ftp									
								}								
							}							
														
						}						
					}					
										
					$this->Model_fiche_modif->supImage($id,$new_images); // On modifie le libelle_image ds la bdd					
										
				}				
								
				header("Location: ".base_url()."administration?anc_onglet=contenus&req=".$id."&".$contenu."=".$lettre); // On redirige vers la page administration				
								
			}			
			else			
			{				
				$table = $_GET['tab'];				
				$id = $_GET['id'];				
								
				$donnees = $this->Model_fiche_modif->recherche_infos($id,$table); // On recherche les informations concernant la table				
								
				// Tableau $data des variables à envoyer aux vues							
				$data = array(				
				'donnees' => $donnees,				
				'table' => $table,				
				'update' => $update				
				);				
								
				// Chargement des vues à afficher (attention à l'ordre) (les vues sont dans le dossier /system/application/views)					
				$this->load->view('administration/fiche_modif',$data);				
				$this->load->view('fiche_modif',$data);				
			}			
						
						
						
						
		}		
				
	}	
		
?>				