<?php

class Fiche_modif extends Controller {

	function index($id = '',$table = ''){ //On a en param�tres l'id et le nom de la table qui ont �t� pass�s en GET

		// Chargement des models utilis�s dans le controller (les models sont dans le dossiers /system/application/models )
		$this->load->model('Model_fiche_modif');
        $this->load->model('Model_administration');

		$update = "";
		$donnees = "";

		if(isset($_POST['patronyme'])) //Modification m�diath�que
		{
			$patronyme = addslashes($_POST['patronyme']);  //Pour chaque input on ajoute des slashes pour prot�ger les apostrophes et on encode en utf8
			$pays = addslashes($_POST['pays']);
                        $region = addslashes($_POST['region']);
                        $departement = addslashes($_POST['departement']);
                        $commune = addslashes($_POST['commune']);
                        $edifice_conservation = addslashes($_POST['edifice_conservation']);
                        $denomination = addslashes($_POST['denomination']);
                        $categorie = addslashes($_POST['categorie']);
                        $materiau = addslashes($_POST['materiau']);
                        $ref_reproduction = addslashes($_POST['ref_reproduction']);
                        $auteur_cliche = addslashes($_POST['auteur_cliche']);
                        $type_cliche = addslashes($_POST['type_cliche']);
                        $annee_cliche = addslashes($_POST['annee_cliche']);
                        $photo = addslashes($_POST['photo']);
                        $ref_im = addslashes($_POST['ref_im']);
                        $ref_pa = addslashes($_POST['ref_pa']);
                        $ref_ia = addslashes($_POST['ref_ia']);
                        $embleme = addslashes($_POST['embleme']);
                        $individu = addslashes($_POST['individu']);
                        $biographie = addslashes($_POST['biographie']);
                        $parente = addslashes($_POST['parente']);
                        $date = addslashes($_POST['date']);
                        $armes = addslashes($_POST['armes']);
                        $cimiers = addslashes($_POST['cimiers']);
                        $devise = addslashes($_POST['devise']);
                        $bibliographie = addslashes($_POST['bibliographie']);												$notes = addslashes($_POST['notes']);
                        $auteurs = addslashes($_POST['auteurs']);
                        $titre = addslashes($_POST['titre']);
                        $lieu_edition = addslashes($_POST['lieu_edition']);
                        $editeur = addslashes($_POST['editeur']);
                        $annee_edition = addslashes($_POST['annee_edition']);
                        $reliure = addslashes($_POST['reliure']);
                        $provenance = addslashes($_POST['provenance']);
                        $site = addslashes($_POST['site']);
                        $section = addslashes($_POST['section']);
                        $cote = addslashes($_POST['cote']);
                        $folio_emplacement = addslashes($_POST['folio_emplacement']);

			$this->db->query("UPDATE details SET
														patronyme='$patronyme',
														pays='$pays',
														region='$region',
														departement='$departement',
														commune='$commune',
														edifice_conservation='$edifice_conservation',
														denomination='$denomination',
														categorie='$categorie',
														materiau='$materiau',
														ref_reproduction='$ref_reproduction',
														auteur_cliche='$auteur_cliche',
														type_cliche='$type_cliche',
														annee_cliche='$annee_cliche',
														photo='$photo',
														cimiers='$cimiers',
                                                                                                                armes='$armes',
														devise='$devise',
                                                                                                                embleme='$embleme',
                                                                                                                individu='$individu',
                                                                                                                date='$date',
														bibliographie='$bibliographie',
														biographie='$biographie',
                                                                                                                parente='$parente',
                                                                                                                auteurs='$auteurs',
														titre='$titre',
														lieu_edition='$lieu_edition',
														editeur='$editeur',
														annee_edition='$annee_edition',
														reliure='$reliure',
														provenance='$provenance',
														site='$site',
														section='$section',
														cote='$cote',
														folio_emplacement='$folio_emplacement',																												notes='$notes'
														WHERE id='$id'");


			//On regarde si des images ont été cochées
                        $images = $_POST['all_pictures'];
                        $image = explode(";",$images);
                        $new_images = $images;
                        $lettre = "";

                        for($i=0;$i<sizeof($image);$i++){
                            if(isset($_POST[$image[$i]]) && $image[$i]!=""){
                                //On retire les nom des images à supprimer du libelle_image de la bdd
                                $new_images = str_replace($image[$i].";", "", $new_images);

                                $dirname = $_SERVER['DOCUMENT_ROOT'].'/../resources/images/';
                                $dir = opendir($dirname); //On ouvre le dossier images
                                while($file = readdir($dir)) //On parcourt les fichiers
                                {
                                    if($file != '.' && $file != '..' && !is_dir($dirname.$file) && $file==$image[$i].".jpg")
                                    {
                                        chmod($dirname.$file, 0777);
                                        unlink($dirname.$file); //On supprime l'image du ftp
                                    }
                                }

                            }
                        }

                        $this->Model_fiche_modif->supImage($id,$new_images); //On modifie le libelle_image ds la bdd

                        $lettre = substr($patronyme, 0, 1);

                        header("Location: ".base_url()."administration?anc_onglet=contenus&lc=".$lettre); //On redirige vers la page administration

		}
		else
		{
			$donnees = $this->Model_fiche_modif->recherche_infos($id,$table); //On recherche les informations concernant la table
			$partenaires = $this->Model_administration->get_partenaires();
            $presentation_livre2=$this->Model_administration->get_presentation_text();

			// Tableau $data des variables � envoyer aux vues
                        $data = array(
                            'donnees' => $donnees,
                            'table' => $table,
                            'update' => $update,
                            'partenaires'=> $partenaires,
                            'presentation_livre2'=> $presentation_livre2
		);

		// Chargement des views � afficher (attention � l'ordre) (les views sont dans le dossiers /system/application/views )
		$this->load->view('administration/fiche_modif',$data);
		}




	}

}

?>
