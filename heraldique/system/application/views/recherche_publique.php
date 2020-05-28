<div class="corps_resultat">
<!-- Affichage des résultats-->
<?php
//vérifier si la recherche publique est actuellement autorisée
$recherche_publique_state = $this->db->query("SELECT SSTATE FROM SWITCH WHERE SNAME = 'PSEARCH'");
$row = $recherche_publique_state->row();
$current_publique = $row->SSTATE;


if ($current_publique == '1' ) {

    /* ARMOIRIE MOTS ORDRE/DESORDRE*/
    if(isset($_GET['rechercher_desordre']) || isset($_GET['rechercher_ordre'])){ ?>
        <h4><a href="javascript:history.back()"><<< Retour sur le formulaire</a></h4>

        <h4 style="margin-left:70%">Nombre de Résultats : <?php
            $nb1=0;
            $nb2=0;
            foreach($donnees1 as $data1) {
                if($data1->blasonnement_1 != NULL){
                    $nb1++;}

            }
            foreach($donnees2 as $data2) {
                if($data2->blasonnement_2 != NULL){
                    $nb2++;}

            }


            $nb =$nb1+ $nb2;
            echo $nb; ?> (note : certains résultats ne sont pas disponibles en recherche publique)</h4>
        <center><table >
                <tr rules="rows">
                    <?php if($donnees1 != NULL){?>
                        <!-- tri b1-->
                        <td valign="top" >
                            <!-- ########################-->
                            <table border="1" bordercolor="#C9C9C9" frame="hsides" rules="rows">
                                <caption><strong>Version 1 des Armoiries</strong></caption>
                                <?php	foreach($donnees1 as $data1) {
                                    if($data1->blasonnement_1 != NULL){

                                        $source_abregee = "";
                                        if (!empty($data1->ref_biblio))
                                        {
                                            $source_abregee = explode(",", $data1->ref_biblio);
                                            $source_abregee = $source_abregee[0];
                                        }

                                        if (strpos($source_abregee, 'RIETSTAP') !== false || strpos($source_abregee, 'ROLLAND') !== false) {
                                            ?>
                                            <tr>
                                                <!-- patronyme--><td ><li><strong><?php IF ($data1->patronyme!= NULL) { echo anchor('fiche/armorial/'.$data1->id, ucfirst(mb_strtolower($data1->patronyme,'UTF-8')));} ELSE { echo anchor('fiche/armorial/'.$data1->id, ucfirst(mb_strtolower($data1->famille,'UTF-8')));
                                                            };?></strong> <!-- fief--><em><?php if (!empty($data1->région)){ echo " - ".$data1->région; } if (!empty($data1->ref_biblio)){ $source_abregee = explode(",", $data1->ref_biblio); $source_abregee = $source_abregee[0]; echo " - ".$source_abregee; }?></em></li>
                                                    <!-- armorie--><strong>Armes 1 : </strong><font color="green" ><?php if (!empty($data1->blasonnement_1)){ $blasonnement = str_replace("_", ";", $data1->blasonnement_1); echo $blasonnement; }?></font>

                                                    <!-- photos
            <br />
            <?php foreach($photos as $photo){
                                                        if ($photo->vedette_chandon == $data1->patronyme){ ?>

                    <a href="<?php echo PALISEP ; ?>resources/images/<?php echo $photo->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
                        <img height="100px" src="<?php echo PALISEP ; ?>resources/images/<?php echo $photo->libellé_image; ?>.jpg"/>
                    </a>
                <?php }
                                                    } ?>-->
                                                    <?php if(!empty($data1->cimiers)){ ?>
                                                        <strong>Cimiers/Ornements ext.: </strong><font color="blue"><?php  echo $data1->cimiers; ?></font>
                                                    <?php } ?>
                                                </td>
                                            </tr>

                                            <?php
                                        }	}} ?>
                            </table>
                            <!-- ########################""-->
                        </td>
                    <?php } ?>

                    <?php if($donnees2 != NULL){?>
                        <!-- tri b2-->
                        <td valign="top">
                            <!-- ########################-->
                            <table style="margin-left:30px"border="1" bordercolor="#C9C9C9" frame="hsides" rules="rows" >
                                <caption><strong>Version 2 des Armoiries</strong></caption>
                                <?php	foreach($donnees2 as $data2) {
                                    if($data2->blasonnement_2 != NULL){
                                        ?>
                                        <tr>
                                            <!-- patronyme--><td width="40%"><li><strong><?php echo anchor('fiche/armorial/'.$data2->id, ucfirst(mb_strtolower($data2->patronyme,'UTF-8')));?></strong>, <!-- fief--><em><?php if (!empty($data2->fief)){ echo $data2->fief; }?></em></li>
                                                <!-- armorie--><strong>Armes 2 : </strong><font color="green" ><?php if (!empty($data2->blasonnement_2)){ echo $data2->blasonnement_2; }?></font>

                                                <!-- photos-->
                                                <br />
                                                <?php foreach($photos as $photo){
                                                    if ($photo->vedette_chandon == $data2->patronyme){ ?>

                                                        <a href="<?php echo PALISEP ; ?>resources/images/<?php echo $photo->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
                                                            <img height="100px" src="<?php echo PALISEP ; ?>resources/images/<?php echo $photo->libellé_image; ?>.jpg"/>
                                                        </a>
                                                    <?php }
                                                } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }	} ?>
                            </table>
                            <!-- ########################""-->
                        </td>
                    <?php } ?>
                </tr>
            </table></center>
        <?php
    }
    ?>
    <!-- RESULTATS PATRONYME -->
    <?php
    if(isset($_GET['rechercher_patronyme']) || isset($_GET['rechercher_region']) || isset($_GET['rechercher_fief']) || isset($_GET['rechercher_departement']) || isset($_GET['rechercher_siecle']) || isset($_GET['rechercher_siecle2']) || isset($_GET['recherche_id'])){ ?>
        <h4><a href="javascript:history.back()"><<< Retour sur le formulaire</a></h4>
        <h4 style="margin-left:70%">Nombre de Résultats : <?php echo count($donnees); ?></h4>
        <center><table border="1" bordercolor="#C9C9C9" frame="hsides" rules="rows">
                <?php foreach($donnees as $data) { ?>
                    <tr>
                        <!-- patronyme--><td width="40%"><li><strong><?php echo anchor('fiche/armorial/'.$data->id, ucfirst (mb_strtolower($data->famille,'UTF-8')));?></strong></li>
                            <!-- fief--><em><?php if (!empty($data->fief)){ echo $data->fief; }?></em></td>
                        <!-- photos-->
                        <td align="right" >
                            <?php foreach($photos as $photo){
                                if ($photo->vedette_chandon == $data->patronyme){ ?>

                                    <a href="<?php echo PALISEP ; ?>resources/images/<?php echo $photo->libellé_image; ?>.jpg" rel="lightbox[roadtrip]">
                                        <img height="100px" src="<?php echo PALISEP ; ?>resources/images/<?php echo $photo->libellé_image; ?>.jpg"/>
                                    </a>
                                <?php }
                            } ?>
                        </td>
                    </tr>
                    <?php
                }	?>
            </table></center>
        <?php
    }
    ?>
    </div>
    <div class="corps">
    <!-- sinon affichage du formulaire -->
    <?php if(!isset($_GET['rechercher_ordre']) && !isset($_GET['rechercher_desordre']) && !isset($_GET['rechercher_patronyme']) && !isset($_GET['rechercher_region'])&& !isset($_GET['rechercher_fief'])&& !isset($_GET['rechercher_departement'])&& !isset($_GET['rechercher_siecle']) && !isset($_GET['rechercher_siecle2']) && !isset($_GET['recherche_id'])){ ?>
        <!-- Formulaire de recherche-->
        <h3 class="title"><center>Recherche d'Armes & de Familles</center></h3>
        <br /> <br />

        <div id="message_erreur" style="color:blue"></div>

        <?php
        if($message_erreur!=""){
            print ("<script language = \"JavaScript\">
                        document.getElementById('message_erreur').innerHTML=\"$message_erreur\";
                    </script>");
        }
        ?>

        <!-- COLONNE GAUCHE-->
        <!--
        <div id="gauche">
        -->
        <!-- PATRONYME-->
        <!--
        <fieldset>
                <legend><strong>Recherche par Patronyme</strong></legend>
        <form action="recherche" method="get">
        <label class="label1"><strong>Patronyme</strong></label>
                <input type="text" name="patronyme"  <?php if (isset($_GET['patronyme'])){ ?>value="<?php echo $_GET['patronyme'] ;?>"<?php }; ?>/>
                <input type="submit" name="rechercher_patronyme" value="Rechercher" />
            </form>
        </fieldset>
    </div>
    -->

        <!-- COLONNE DROITE
        <div id="droite">-->
        <!-- COMMUNES FIEF
        <fieldset>
                <legend><strong>Recherche par Fief ou Commune</strong></legend>
        <form action="recherche" method="get">
        <label class="label1"><strong>Fief ou Commune</strong></label>
                <input type="text" name="fief"  <?php if (isset($_GET['fief'])){ ?>value="<?php echo $_GET['fief'] ;?>"<?php }; ?>/>
                <input type="submit" name="rechercher_fief" value="Rechercher" />
            </form>
        </fieldset>
        <br />
    <div>-->



        <!-- ARMES-->

        <fieldset style='background-color:white;'>

            <legend><strong> Recherche</strong></legend>
            <div id="recherchepararmes">
                <form action="recherche" method="get">
                    <center>
                        <div class="haut_armes">
                            <label class="label2"><strong>Armes</strong></label><textarea style="float: right;" cols="30" rows="3" name="mot"></textarea><br /><br />
                            <!--<label class="label2"><strong>Cimiers / Ornements extérieurs</strong></label><textarea style="float: right;" cols="30" rows="3" name="cimiers"></textarea><br /><br />-->
                            <label class="label2"><strong>Cimiers</strong></label><textarea style="float: right;" cols="30" rows="3" name="cimiers"></textarea><br /><br />
                        </div>
                        <div class="bas_armes">
                            <label class="label2"><strong>Devise / Légende</strong></label><textarea style="float: right;" cols="30" rows="3" name="devise" ></textarea><br /><br />
                            <label class="label2"><strong>Emblème</strong></label><textarea style="float: right;" cols="30" rows="3" name="embleme"></textarea><br /><br />
                        </div>
            </div>
            <!-- colonne gauche -->
            <div id="recherchepararmes2">
                <div id="gauche_armes">

                    <label class="label2" >Patronyme</label>
                    <input style="float: right;" type="text" name="mot_2"  <?php if (isset($_GET['mot_2'])){ ?>value="<?php echo $_GET['mot_2'] ;?>"<?php }; ?>/><br /><br />

                    <label class="label2" >Prénom</label>
                    <input style="float: right;" type="text" name="prenom"  <?php if (isset($_GET['prenom'])){ ?>value="<?php echo $_GET['prenom'] ;?>"<?php }; ?>/><br/><br/>
                    <label class="label2" >Titres/Dignités</label>
                    <input style="float: right;" type="text" name="titres_dignites"  <?php if (isset($_GET['titres_dignites'])){ ?>value="<?php echo $_GET['titres_dignites'] ;?>"<?php }; ?>/><br/><br/>

                    <label class="label2" >Origine</label>
                    <input style="float: right;" type="text" name="origine"  <?php if (isset($_GET['origine'])){ ?>value="<?php echo $_GET['origine'] ;?>"<?php }; ?>/><br /><br />

                    <label class="label3">Siècle</label>
                    <select name="mot_6" style="float: right;width: 180px;">
                        <option value=""> </option>
                        <?php
                        foreach($siecles as $siecle){ ?>
                            <option value="<?php echo $siecle->siècle ; ?>"><?php echo $siecle->siècle ; ?></option>
                        <?php } ?>
                    </select> <br /><br />

                    <label class="label3">Dénomination</label>
                    <select name="Denomination" style="float: right;width: 180px;">
                        <option value=""> </option>
                        <?php
                        foreach($denominations as $denomination){ ?>
                            <option value="<?php echo $denomination->dénomination ; ?>"><?php echo $denomination->dénomination ; ?></option>
                        <?php } ?>
                    </select> <br /><br />

                    <!--<label style="float:left;" >Références / Bibliographie</label><input style="float: right;" type="text" name="ref_biblio" <?php if (isset($_GET['ref_biblio'])){ ?>value="<?php echo $_GET['ref_biblio'] ;?>"<?php }; ?>/><br /><br /> -->
                    <label class="label3">Références / Bibliographie</label>
                    <select name="ref_biblio" style="float: right; width: 180px;">
                        <option selected value="<?php if (isset($_GET['ref_biblio'])){ echo $_GET['ref_biblio'];} ?>">
                            <?php if (isset($_GET['ref_biblio'])){ echo $_GET['ref_biblio'];} ?></option>
                        <?php foreach ($ref_biblios as $ref_biblio) { if( strpos($ref_biblio->ref_biblio, 'RIETSTAP') !== false || strpos($ref_biblio->ref_biblio, 'ROLLAND') !== false) { ?>
                            <option value="<?php echo $ref_biblio->ref_biblio ; ?>"><?php echo $ref_biblio->ref_biblio ; ?></option>
                        <?php } } ?>
                    </select>
                    <br/><br/>



                </div>
                <!-- colonne droite-->
                <div id="droite_armes">

                    <label style="float:left;">Aire géographique</label>
                    <select name="aire" style="float: right;width: 180px;">
                        <option value=""> </option>
                        <option value="France">France</option>
                        <option value="Pays-Bas">Pays-Bas</option>
                        <option value="Germanie">Germanie</option>
                        <option value="Suisse">Suisse</option>
                        <option value="Italie">Italie</option>
                        <option value="Espagne - Portugal">Espagne - Portugal</option>
                        <option value="Pologne - Russie">Pologne - Russie</option>
                        <option value="Scandinavie">Scandinavie</option>
                        <option value="Royaume-Uni">Royaume-Uni</option>
                        <option value="Europe Orientale">Europe Orientale</option>
                        <option value="Autres Mondes">Autres Mondes</option>
                    </select> <br /><br />


                    <label class="label2" >Pays</label>
                    <select name="pays" style="float: right;width: 180px;">
                        <option value=""> </option>
                        <?php
                        foreach($pays as $pay){ ?>
                            <option value="<?php echo $pay->pays ; ?>"><?php echo $pay->pays ; ?></option>
                        <?php } ?>
                    </select> <br /><br />

                    <label class="label2">Région</label>
                    <select name="mot_3" style="float: right;width: 180px;">
                        <option value=""> </option>
                        <?php
                        foreach($regions as $region){ ?>
                            <option value="<?php echo $region->région ; ?>"><?php echo $region->région ; ?></option>
                        <?php } ?>
                    </select> <br /><br />

                    <label class="label2">Département</label>
                    <select name="mot_5" style="float: right;width: 180px;">
                        <option value=""> </option>
                        <?php
                        foreach($departements as $departement){ ?>
                            <option value="<?php echo $departement->départment ; ?>"><?php echo $departement->départment ; ?></option>
                        <?php } ?>
                    </select> <br /><br />



                    <label class="label2">Fief / Communes</label>
                    <select name="fief" style="float: right;width: 180px;">
                        <option value=""> </option>
                        <?php
                        foreach($communes as $commune){ ?>
                            <option value="<?php echo $commune->commune ; ?>"><?php echo $commune->commune ; ?></option>
                        <?php } ?>
                    </select> <br /><br />

                    <label class="label3" >Observations</label><input style="float: right;" type="text" name="observations" <?php if (isset($_GET['observations'])){ ?>value="<?php echo $_GET['observations'] ;?>"<?php }; ?>/><br /><br />

                </div><br /><br />
            </div>
            <!-- boutons-->
            <script language="JavaScript">
                function affichage(eltAafficher, eltAcacher)
                {
                    var eltAfficher = document.getElementById(eltAafficher);
                    eltAfficher.style.visibility="visible";
                    var eltAcacher = document.getElementById(eltAcacher);
                    eltAcacher.style.visibility="hidden";
                }
            </script>
            <div style="margin-left : 25%">
                <br /><br /><br />
                <div id="ordre" style="float:left;margin-top:60px;">
                    <!-- ORDRE--><em><font>Mots ordonnés </font></em><input type="submit" name="rechercher_ordre" value="Rechercher">
                    <a href="javascript:affichage('desordre','ordre');"><img style="border: none" src="<?php echo base_url()?>resources/images/echange.jpg" width="18px"/></a>
                </div>
                <div id="desordre" style="visibility:hidden;float:left;margin-top:60px;">
                    <a href="javascript:affichage('ordre', 'desordre');"><img style="border: none" src="<?php echo base_url()?>resources/images/echange.jpg" width="18px"/></a>
                    <!-- DESORDRE--><input type="submit" name="rechercher_desordre" value="Rechercher"><em><font> Mots désordonnés</font></em>
                </div>
            </div>
            </center>
            </form>
            <br /><br />
        </fieldset>


        <!-- SIECLE

        <fieldset style="float:left;margin-left:14%">
        Note : il est possible de sélectionner plusieurs siècles (note à supprimer)
                <legend><strong>Recherche par Siècle d'Extinction</strong></legend>
        <form action="recherche" method="get">
        <font color="#A42903">
            <strong>XIIe s.</strong><input type="checkbox" value="XIIe s." name="siecle[]" />
            <strong>XIIIe s.</strong><input type="checkbox" value="XIIIe s." name="siecle[]" />
            <strong>XIVe s.</strong><input type="checkbox" value="XIVe s." name="siecle[]" />
            <strong>XVe s.</strong><input type="checkbox" value="XVe s." name="siecle[]" />
            <strong>XVIe s.</strong><input type="checkbox" value="XVIe s." name="siecle[]" />
            <strong>XVIIe s.</strong><input type="checkbox" value="XVIIe s." name="siecle[]" />
            <strong>XVIIIe s.</strong><input type="checkbox" value="XVIIIe s." name="siecle[]" />
            <strong>XIXe s.</strong><input type="checkbox" value="XIXe s." name="siecle[]" />
            <strong>XXe s.</strong><input type="checkbox" value="XXe s." name="siecle[]" />
            <strong>XXIe s.</strong><input type="checkbox" value="XXIe s." name="siecle[]" /></font> -->
        <!--	<input type="text" name="siecle" size="70" <?php if (isset($_GET['siecle'])){ ?>value="<?php echo $_GET['siecle'] ;?>"<?php }; ?>/>
            <br /><center><input type="submit" name="rechercher_siecle" value="Rechercher " /></center>
        </form>
    </fieldset><br /><br /> -->
        <!-- SIECLE 2-->
        <!--
        <fieldset style="float:left;margin-left:14%">
        Note : La recherche récupère automatiquement tous les siécles antérieurs au siècle choisi (Note à Supprimer !)<br />
                <legend><strong>Recherche par Siècle d'Extinction</strong></legend>
        <form action="recherche" method="get">
            <label style="float:left;width:110px;">Siècle</label>
                    <select name="siecle2">
                    <option value=""> </option>
                    <option value="XIIe s.">XIIe s.</option>
                    <option value="XIIIe s.">XIIIe s.</option>
                    <option value="XIVe s.">XIVe s.</option>
                    <option value="XVe s.">XVe s.</option>
                    <option value="XVIe s.">XVIe s.</option>
                    <option value="XVIIe s.">XVIIe s.</option>
                    <option value="XVIIIe s.">XVIIIe s.</option>
                    <option value="XIXe s.">XIXe s.</option>
                    <option value="XXe s.">XXe s.</option>
                    <option value="XXIe s.">XXIe s.</option>
                    </select>
                <input type="submit" name="rechercher_siecle2" value="Rechercher" />
            </form>
        </fieldset>
        <br />
        -->

        <!--
    <fieldset>
            <legend><strong>Recherche par région</strong></legend><br />
    <form action="recherche" method="get">
            <label style="float:left;width:175px;"><strong>Mots clés de la région</strong></label>
            <input type="text" name="region" size="30" <?php if (isset($_GET['region'])){ ?>value="<?php echo $_GET['region'] ;?>"<?php }; ?>/>
            <input type="submit" name="rechercher_region" value="Rechercher les familles de la région" />
        </form>
        <br />

    </fieldset><br />

    <fieldset>
            <legend><strong>Recherche par Département</strong></legend><br />
    <form action="recherche" method="get">
    <label style="float:left;width:175px;"><strong>Mots clés du Département</strong></label>

            <input type="text" name="departement" size="30" <?php if (isset($_GET['departement'])){ ?>value="<?php echo $_GET['departement'] ;?>"<?php }; ?>/>
            <input type="submit" name="rechercher_departement" value="Rechercher les familles du département" />
        </form>
        <br />
    </fieldset><br />

        <br/>


    <div>
        <form action="recherche" method="get">
            <label style="float:left;width:175px;"><strong>Recherche par id armorial</strong></label>
            <input type="text" name="search" size="30" <?php if (isset($_GET['search'])){ ?>value="<?php echo $_GET['search'] ;?>"<?php }; ?> />
            <input type="submit" name="recherche_id" value="Rechercher par Id">
        </form>
        <br/>
    </div>
    -->
<?php }
} else {
    echo '<div id="recherche"> <a> D&eacute;sol&eacute;, la recherche publique n\'est pas disponible.</a> </div>';
}
?>