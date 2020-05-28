<!-- fermeture des balises ouvertes dans la vue header.php-->

<!-- Texte du bas de la page -->
</div> <!-- page -->

<div id="dialog_partenaires" title="Partenaires">
  <ul>
    <?php foreach($partenaires as $partenaire){ ?>
      <li><a href="<?php echo $partenaire->url ; ?>" target=_blank><?php echo $partenaire->nom ; ?></a></li>
    <?php } ?>
  </ul>
</div>

<div id="dialog_presentation" title="Présentation">
  <?php 
    foreach($presentation_livre2 as $presentation){
      echo html_entity_decode($presentation->description);
    } 
  ?>

</div>

<div id="footer">
  <p>
    <a href="http://palisep.fr/">Accueil</a>
    <a href="http://www.mediatheque.grand-troyes.fr" target=_blank>Médiathèque Grand Troyes</a>
    <a href="#" id="show_partners">Partenaires</a>
    <a href="http://www.aibl.fr/" target="blank"><img style="width:250px; position:relative; bottom:-20px;" src="<?php echo base_url()?>resources/images/Log-AIBL.png" /></a>
    <a href="#" id="show_presentation">Présentation</a>
    <a href="<?php echo base_url()?>contact">Contact</a>
    <a href="<?php echo base_url()?>administration" ><img src="<?php echo base_url()?>resources/images/palisep.png" id="palisep"/></a>
  </p>
  <!-- ##### -->
  
</div> <!-- footer -->

<div id="partenaires" title="Partenaires"></div> <!-- div pour l'affichage des partenaires en ajax -->
<div id="dico" title="Dictionnaire des figures héraldiques"></div> <!-- div pour l'affichage du dictionnaire en ajax -->

</div> <!-- bibliotheque -->
</body>
</html>
