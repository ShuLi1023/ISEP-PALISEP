<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Sparkling
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20100704

-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Palisep Livre</title>
<meta name="keywords" content="free templates, website templates, CSS, HTML" />
<meta name="description" content="free website template provided by templatemo.com" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<!-- Appel du fichier CSS -->
<link href="<?php echo base_url()?>resources/css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="<?php echo PALISEP ?>system/libraries/Javascript/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo PALISEP ?>system/libraries/Javascript/jquery.js"></script>
<script type="text/javascript" src="<?php echo PALISEP ?>system/libraries/Javascript/jquery-ui-1.8.18.custom.min.js"></script>

</head>

<body>
    
   <!-- Chargement en cours...<br />-->
    <?php
        if($pourcentage==0){
    ?>
   <center><div id='progressbar' style="width: 50%;margin-top:20%;"></div></center>
    <script type='text/javascript'>
        
		$( "#progressbar" ).progressbar({
			value: 0
		});
     </script>
    <?php
        }
        else {


     ?>
     <script type='text/javascript'>
                $( "#progressbar" ).progressbar({value: <?php echo $pourcentage; ?>});
    </script>
    <?php  } echo round($pourcentage); ?>

</body>

</html>