<?php
	class Majbdd extends Controller {
		
		function save(){
			
			$colonne = "";
			$table = "";
			
			$old_id = explode("_", $_POST['row_id']);
			$id = $old_id[1];
			
			if($old_id[0]=="a"){
				
				$table = "armorial";
				
				if($_POST['column']==1)
				$colonne = "famille";
				else if($_POST['column']==2)
				$colonne = "prenom";
				else if($_POST['column']==3)
				$colonne = "titres_dignites";
				else if($_POST['column']==4)
				$colonne = "origine";
				else if($_POST['column']==5)
				$colonne = "date";
				else if($_POST['column']==6)
				$colonne = "siècle";
				else if($_POST['column']==7)
				$colonne = "fief";
				else if($_POST['column']==8)
				$colonne = "aire";
				else if($_POST['column']==9)
				$colonne = "pays";
				else if($_POST['column']==10)
				$colonne = "région";
				else if($_POST['column']==11)
				$colonne = "départment";
				else if($_POST['column']==12)
				$colonne = "alliances";
				else if($_POST['column']==13)
				$colonne = "notes";
				else if($_POST['column']==14)
				$colonne = "blasonnement_1";
				else if($_POST['column']==15)
				$colonne = "cimiers";
				else if($_POST['column']==16)
				$colonne = "devise";
				else if($_POST['column']==17)
				$colonne = "embleme";
				else if($_POST['column']==18)
				$colonne = "lambrequins";
				else if($_POST['column']==19)
				$colonne = "support";
				else if($_POST['column']==20)
				$colonne = "observations";
				else if($_POST['column']==21)
				$colonne = "ref_biblio";
			}
			else if($old_id[0]=="o"){
				
				$table = "legende_photos";
				
				if($_POST['column']==1)
				$colonne = "libellé_image";
				else if($_POST['column']==2)
				$colonne = "vedette_chandon";
				else if($_POST['column']==3)
				$colonne = "famille";
				else if($_POST['column']==4)
				$colonne = "individu";
				else if($_POST['column']==5)
				$colonne = "qualité";
				else if($_POST['column']==6)
				$colonne = "date";
				else if($_POST['column']==7)
				$colonne = "dénomination";
				else if($_POST['column']==8)
				$colonne = "titre";
				else if($_POST['column']==9)
				$colonne = "catégorie";
				else if($_POST['column']==10)
				$colonne = "matériau";
				else if($_POST['column']==11)
				$colonne = "ref_reproductions";
				else if($_POST['column']==12)
				$colonne = "biblio";
				else if($_POST['column']==13)
				$colonne = "remarques";
				else if($_POST['column']==14)
				$colonne = "auteurs";
				else if($_POST['column']==15)
				$colonne = "lieu_édition";
				else if($_POST['column']==16)
				$colonne = "editeur";
				else if($_POST['column']==17)
				$colonne = "année_édition";
				else if($_POST['column']==18)
				$colonne = "reliure";
				else if($_POST['column']==19)
				$colonne = "provenance";
				else if($_POST['column']==20)
				$colonne = "site";
				else if($_POST['column']==21)
				$colonne = "section";
				else if($_POST['column']==21)
				$colonne = "cote";
				else if($_POST['column']==22)
				$colonne = "folio_emplacement";
				else if($_POST['column']==23)
				$colonne = "auteur_cliché";
				else if($_POST['column']==24)
				$colonne = "type_cliché";
				else if($_POST['column']==25)
				$colonne = "année_cliché";
				else if($_POST['column']==26)
				$colonne = "pays";
				else if($_POST['column']==27)
				$colonne = "région";
				else if($_POST['column']==28)
				$colonne = "départment";
				else if($_POST['column']==29)
				$colonne = "commune";
				else if($_POST['column']==30)
				$colonne = "village";
				else if($_POST['column']==31)
				$colonne = "edifice_conservation";
				else if($_POST['column']==32)
				$colonne = "emplacement_dans_édifice";
				else if($_POST['column']==33)
				$colonne = "photo";
				else if($_POST['column']==34)
				$colonne = "commune_INSEE_number";
				else if($_POST['column']==35)
				$colonne = "ref_IM";
				else if($_POST['column']==36)
				$colonne = "ref_PA";
				else if($_POST['column']==37)
				$colonne = "ref_IA";
				else if($_POST['column']==38)
				$colonne = "artificial_number_Decrock";
			}
			
			$query = "
			UPDATE ".$table."
			SET
			".$colonne." =
            '".mysql_real_escape_string($_POST['value'])."'
			WHERE
			id = ".$id;
			
			$rResult = mysql_query($query) or die(mysql_error());
			
			echo $_POST['value'];
			
		}
	}
?>
