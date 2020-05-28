<div class="corps">
    <br /><br /><h3><center>Contact</center></h3>

    <br /><br />

    <div class="navigation" style="margin-top: 20px;">
        <a href="http://www.heraldique.palisep.fr">Retour à l'accueil</a>
    </div>

    <fieldset style='background-color:white;'><legend><strong><font color="#A42903">Veuillez remplir le formulaire ci-dessus</font></strong></legend><br />
        <?php
            if($contact==""){
            
        ?>
        <form action="" method="POST">
            <label style="float:left;width:190px;" for="nom">Nom *:</label><input type="text" name="nom" id="nom" /><br /><br />
            <label style="float:left;width:190px;" for="email">E-mail *:</label><input type="text" name="email" id="email" /><br /><br />
            <label style="float:left;width:190px;" for="tel">Téléphone :</label><input type="text" name="tel" id="tel" /><br /><br />
            <label style="float:left;width:190px;" for="description">Description *:</label><textarea rows="10" cols="50" id="description" name="description"></textarea><br /><br />
            <center><input type="submit" value="Contactez-nous" name="contact"/></center>
        </form>
        <?php
            }
            else{
                echo $contact;
        ?>
        <h4><a href="javascript:history.back()"><<< Retour sur le formulaire </a></h4>
        <?php
            }
        ?>
    </fieldset>
</div>	