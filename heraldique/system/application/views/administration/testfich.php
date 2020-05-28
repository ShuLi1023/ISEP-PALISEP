<!-- Si l'administrateur est connect? -->
<?php if ($connecte == true){


?>

 <h4><a href="javascript:history.back()"><<< Retour sur le formulaire </a></h4>
 
 
  <fieldset style='background-color:white;'>
        <legend><strong><font color="#A42903">Modification des contenus</font></strong><a href="#" class="info"><img src="<?php echo base_url(); ?>resources/images/aide.gif"/><span><?php echo $bulle_contenus; ?></span></a></legend><br />
	<h3><center><a href='#arm' onclick='visibilite("arm");'>Armorial</a></center></h3><br /><br />

        <div id='arm' style='display:block;width:840px;'>
            <?php echo "<a href='".base_url()."administration?anc_onglet=contenus&la=a'>A</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=b'>B</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=c'>C</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=d'>D</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=e'>E</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=f'>F</a>
                     - <a href='".base_url()."administration?anc_onglet=contenus&la=g'>G</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=h'>H</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=i-j-k'>I/J/K</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=l'>L</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=m'>M</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=n'>N</a>
                     - <a href='".base_url()."administration?anc_onglet=contenus&la=/o-p-q'>O/P/Q</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=r'>R</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=s'>S</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=t'>T</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=u-v'>U/V</a> - <a href='".base_url()."administration?anc_onglet=contenus&la=w-x-y-z'>W/X/Y/Z</a>
            ";?>
            <table border='1' id="table_armorial" style="border-collapse:collapse; width:100%;">
                <thead>
                    <tr>
                        <th></th>
                        <th>Famille</th>
                        <th>Prénom</th>
                        <th>Titres/Dignités</th>
                        <th>Origine</th>
			<th>Date</th>
			<th>Siècle</th>
			<th>Fief</th>
                        <th>Région</th>
                        <th>Département</th>
			<th>Alliances</th>
			<th>Notes</th>
                        <th>Armes</th>
			<th>Cimiers</th>
			<th>Devise</th>
			<th>Emblème</th>
			<th>Lambrequins</th>
			<th>Tenant/Support</th>
			<th>Observations</th>
			<th>Références biblio.</th>
                    </tr>
                </thead>
                <tbody>
		<?php
			foreach($donnees_armorial as $data1) {
                            $id = "a_".$data1['id'];
                ?>
		<tr id="<?php echo $id; ?>">
			<td>
                            <a href='#' onclick="ConfirmMessage(<?php echo $data1['id']; ?>,6);"><img width="15px" src="<?php echo base_url() ?>resources/images/supprimer.png" /></a>
                        </td>
                        <td><a href='#' onclick="getFiche(<?php echo $data1['id']; ?>,'armorial');return false;" title=<?php echo $data1['id']; ?>><?php echo $data1['famille']; ?></a></td>
                        <td><?php if (!empty($data1['prenom'])){ echo $data1['prenom']; }?></td>
                        <td><?php if (!empty($data1['titres_dignites'])){ echo $data1['titres_dignites']; }?></td>
                        <td><?php if (!empty($data1['origine'])){ echo $data1['origine']; }?></td>
                        <td><?php if (!empty($data1['date'])){ echo $data1['date']; }?></td>
			<td><?php if (!empty($data1['siècle'])){ echo $data1['siècle']; }?></td>
			<td><?php if (!empty($data1['fief'])){ echo $data1['fief']; }?></td>
			<td><?php if (!empty($data1['région'])){ echo $data1['région']; }?></td>
                        <td><?php if (!empty($data1['départment'])){ echo $data1['départment']; }?></td>
                        <td><?php if (!empty($data1['alliances'])){ echo $data1['alliances']; }?></td>
			<td><?php if (!empty($data1['notes'])){ echo $data1['notes']; }?></td>
                        <td><?php if (!empty($data1['blasonnement_1'])){ echo $data1['blasonnement_1']; }?></td>
			<td><?php if (!empty($data1['cimiers'])){ echo $data1['cimiers']; }?></td>
			<td><?php if (!empty($data1['devise'])){ echo $data1['devise']; }?></td>
			<td><?php if (!empty($data1['embleme'])){ echo $data1['embleme']; }?></td>
			<td><?php if (!empty($data1['lambrequins'])){ echo $data1['lambrequins']; }?></td>
			<td><?php if (!empty($data1['support'])){ echo $data1['support']; }?></td>
			<td><?php if (!empty($data1['observations'])){ echo $data1['observations']; }?></td>
			<td><?php if (!empty($data1['ref_biblio'])){ echo $data1['ref_biblio']; }?></td>
		</tr>
		<?php } ?>
                </tbody>
	</table>
        </div><br /><br />

        <fieldset style='background-color:white;'>
        <legend><strong><font color="#A42903"><a href='#man_armorial' onclick='visibilite("man_armorial");'>>>Ajout manuel</a></font></strong></legend><br />
        <div id="man_armorial" style="display:none;">
        <?php if($booleen==""){ ?>
        <form method="get" action="">
            <div style="float:left;margin-left:20px;">
                <label style="float:left;width:190px;" for="famille">Famille :</label><input type="text" name="famille" id="famille" /><br /><br />
                <label style="float:left;width:190px;" for="prenom">Prénom :</label><input type="text" name="prenom" id="prenom" /><br /><br />
                <label style="float:left;width:190px;" for="titres_dignites">Titres/dignités :</label><input type="text" name="titres_dignites" id="titres_dignites" /><br /><br />
                <label style="float:left;width:190px;" for="origine">Origine :</label><input type="text" name="origine" id="origine" /><br /><br />
                <label style="float:left;width:190px;" for="date">Date :</label><input type="text" name="date" id="date" /><br /><br />
                <label style="float:left;width:190px;" for="fief">Fief :</label><input type="text" name="fief" id="fief" /><br /><br />
                <label style="float:left;width:190px;" for="region">Région :</label><input type="text" name="region" id="region" /><br /><br />
                <label style="float:left;width:190px;" for="department">Département :</label><input type="text" name="department" id="department" /><br /><br />
                <label style="float:left;width:190px;" for="alliances">Alliances :</label><input type="text" name="alliances" id="alliances" /><br /><br />
                <label style="float:left;width:190px;" for="notes">Notes :</label><input type="text" name="notes" id="notes" /><br /><br />
                <label style="float:left;width:190px;" for="blasonnement">Armes :</label><textarea cols="20" rows="4" name="blasonnement" id="blasonnement"></textarea><br /><br />

            </div>
            <div style="float:right;margin-right:20px;">
                <label style="float:left;width:190px;" for="cimiers">Cimiers :</label><textarea cols="20" rows="4" name="cimiers" id="cimiers"></textarea><br /><br />
                <label style="float:left;width:190px;" for="devise">Devise/Légende :</label><input type="text" name="devise" id="devise" /><br /><br />
                <label style="float:left;width:190px;" for="embleme">Emblème :</label><input type="text" name="embleme" id="embleme" /><br /><br />
                <label style="float:left;width:190px;" for="lambrequins">Lambrequins :</label><input type="text" name="lambrequins" id="lambrequins" /><br /><br />
                <label style="float:left;width:190px;" for="support">Tenant/support :</label><input type="text" name="support" id="support" /><br /><br />
                <label style="float:left;width:190px;" for="observations">Observations :</label><textarea cols="20" rows="4" name="observations" id="observations"></textarea><br /><br />
                <label style="float:left;width:190px;" for="ref_biblio">Références biblio. :</label><textarea cols="20" rows="4" name="ref_biblio" id="ref_biblio"></textarea><br /><br />
                <input type='hidden' name='anc_onglet' id='anc_onglet' value='contenus' />
                <input type="submit" name="manuel_armorial" value="Ajouter" />
            </div>
        </form>
        <?php }
                else{
                    echo $manuel;
                ?>
				
                <script>
                    visibilite("man_armorial");
                </script>
                <h4><a href="<?php echo base_url()."administration?anc_onglet=contenus#man_armorial"; ?>"><<< Retour sur le formulaire </a></h4>
                <?php
                }
                ?>
        </div>
        </fieldset><br /><br />
		
		
		<?php }else{ ?>
<!-- Si l'admin n'est pas connect? on le renvoit sur la page identification -->
<center><h3>Administration</h3></center>

<?php header("Location: ".base_url().'administration/identification'); ?>

<?php } ?>
<div id="fiche" title="Modification des informations"></div>
<!--<div id="loader"><center>Veuillez attendre le chargement du fichier</center><br /><center><img src="<?php echo base_url() ?>resources/images/ajax-loader.gif" /></center></div>-->
<script type="text/javascript">
	var anc_onglet = '<?php
	if(isset($_GET['anc_onglet']))
		echo $_GET['anc_onglet'];
	else
		echo 'admin';
        ?>';
	change_onglet(anc_onglet);
</script>