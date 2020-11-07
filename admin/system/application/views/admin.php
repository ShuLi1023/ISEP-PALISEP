<!--<div id="hidden_admin"><a href="<?php echo base_url()?>administration" id="hidden_admin_perspective"></a></div>-->


<html>
<head>
	<title>Palisep</title>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<style>
		
		body{
            text-align:center;
            background-image:url(resources/images/background.jpg);
		}
        *{
            font-family: Verdana;
        }

		.button{
            text-decoration: none;
            color: black;
            text-align: center;
			border-radius: 4px;
			box-shadow: 0px 0px 5px darkgrey;
			border: 0px solid black;
			color: white;
			background-color: #e79e61;
			cursor: pointer;
			width: 80%;
            padding: 10px;
            margin: 5px;
        }

        #title{
            text-align:center;
            color: rgb(164, 41, 3);
        }

        #presentationPortail{
            margin: 10px;
            padding-bottom: 10px;
        }
        #blockAdmin{
            position: relative;
            box-shadow: 1px 2px 5px darkgrey;
            background-color: #faebd7;
            height: 250px;
            padding: 20px;
            width: 80%;
            left: 10%;
            border-radius: 5px;
        }

        #textesAccueil{
            margin-top:20px;
            position: relative;
            box-shadow: 1px 2px 5px darkgrey;
            background-color: #faebd7;
            height: 780px;
            padding: 20px;
            width: 80%;
            left: 10%;
            border-radius: 5px;
        }
		
        #palisepLogo{
            padding-left: 120px;
            height: 80px;
        }

        .textAccueil {
            width: 500px;
            height: 120px;
        }

        .deco {
            margin-top: 15px;
        }

        #head {
            float: right;
        }

	</style>
	</meta>
</head>
<body>
    <div id="blockAdmin">
        <div id="presentationPortail">
            <div id="head">
              <a class="" href="/">Accueil</a>

              <?php if ($connecte == true){ ?>
              <form class="deco" action="" method="POST">
                <input type="submit" name="deconnexion" value="Deconnexion" id="deconnexion" /> 
              </form>
              <?php } ?>
            </div>
            <!--<h1 id="title" >Portail administration</h1> -->
            <img id="palisepLogo" src="resources/images/palisep.png"></img>
            <p id="textAdmin" > Quelle partie souhaitez-vous administrer ?</p>
        </div>
    
        <a id="heraldique" class="button" href="http://www.livre2.palisep.fr/administration/identification"> L'Héraldique et le livre  </a>
        <a id="armorial" class="button" href="http://www.heraldique.palisep.fr/administration/identification"> Armorial monumental</a>
        <a id="rechercheArmes" class="button" href="http://www.europe.palisep.fr/administration/identification"> Recherche d'armes</a>
        
 


    </div>

    <?php if ($connecte == true){ ?>

    <div id="textesAccueil">
        <h3>Textes de l'accueil</h3>

        <form action="" method="post">
            <p>Armorial monumental</p>
            <textarea class="textAccueil" name="armorial"><?php echo $armorial ?></textarea>

            <p>L'héraldique et le livre</p>
            <textarea class="textAccueil" name="livre"><?php echo $livre ?></textarea>

            <p>Recherche d'armes</p>
            <textarea class="textAccueil" name="heraldique"><?php echo $heraldique ?></textarea>

            <p>Bibliothèque</p>
            <textarea class="textAccueil" name="biblio"><?php echo $biblio ?></textarea>

            <p></p>
            <input type="submit" name="validateModifs" value="Valider">
        </form>

    </div>
    <?php } ?>


<script>
</script>
</body>
</html>	