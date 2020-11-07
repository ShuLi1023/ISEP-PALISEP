<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Palisep</title>
<meta name="keywords" content="free templates, website templates, CSS, HTML" />
<meta name="description" content="free website template provided by templatemo.com" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
</head>
<body style="margin: 0;
	padding: 0;
	background: #FFFDEA;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #464032;">


<div style="margin:50px">
	
	<?php
		if (!isset($_GET['livre']))
		{ ?>
		
<center>
	<h1>Oeuvres</h1>
	<!-- <a href="test.html" ><font color="#A42903"><h3>TEST</h3></font></a><br /> -->
	<a href="index.php?livre=jalouneix" ><font color="#A42903"><h3>L'Héraldique du Limousin du XIIème au XXIème siècle</h3></font></a><br />
	<a href="index.php?livre=armorial-de-la-sarthe"><font color="#A42903"><h3>Armorial de la Sarthe</h3></font></a><br />
	<a href="index.php?livre=jougla" ><font color="#A42903"><h3>Jougla</h3></font></a><br />
	<a href="http://annebhd.free.fr/heraldique/biblio_herald.htm" ><font color="#A42903"><h3>Bibliographie</h3></font></a><br />
 </center>
 
	<?php 
		} 
		elseif (isset($_GET['livre']) AND $_GET['livre']=="jalouneix")
		{
	?>
	
	<center>
	<h1>L'Héraldique du Limousin du XIIème au XXIème siècle</h1>
	<h2>Thèse de doctorat par Jacques JALOUNEIX</h2>
	<a href="jalouneix/partie1.pdf" target="_blank"><font color="#A42903">
		<h3>Première partie</h3>
		<p>OBSERVATIONS GÉNÉRALES SUR L’HÉRALDIQUE LIMOUSINE DES ORIGINES A NOS JOURS</p></font>
	</a><br />
	<a href="jalouneix/partie2.pdf" target="_blank"><font color="#A42903">
		<h3>Deuxième partie</h3>
		<p>ARMORIAL GÉNÉRAL DU LIMOUSIN DU XIIe AU XXIe SIECLE FAMILLES, COMMUNAUTÉS, TABLE HÉRALDIQUE</p></font>
	</a><br />
	<a href="jalouneix/partie3.pdf" target="_blank"><font color="#A42903">
		<h3>Troisième partie</h3>
		<p>ANNEXES</p></font>
	</a><br />
  </center>

	<?php 
		} 
		elseif (isset($_GET['livre']) AND $_GET['livre']=="armorial-de-la-sarthe")
		{
	?>
<center>
	<a href="armorial-de-la-sarthe.pdf" target="_blank"><font color="#A42903">
		<h2>Armorial de la Sarthe</h2>
	</a><br />
  </center>
	
	<?php
	}
	elseif (isset($_GET['livre']) AND $_GET['livre']=="jougla")

	{
	?>
	<center>
	<h1>Jougla</h1>
	<h2>Jougla</h2>
	<a href="jougla/tome_01.pdf" target="_blank">
		<font color="#A42903">
			<h3>Tome 1</h3>
		</font>
	</a><br />
	
	<a href="jougla/tome_02.pdf" target="_blank">
		<font color="#A42903">
			<h3>Tome 2</h3>
		</font>
	</a><br />
	
	<a href="jougla/tome_03.pdf" target="_blank">
		<font color="#A42903">
			<h3>Tome 3</h3>
		</font>
	</a><br />
	
	<a href="jougla/tome_04.pdf" target="_blank">
		<font color="#A42903">
			<h3>Tome 4</h3>
		</font>
	</a><br />
	
	<a href="jougla/tome_05.pdf" target="_blank">
		<font color="#A42903">
			<h3>Tome 5</h3>
		</font>
	</a><br />
	
	<a href="jougla/tome_06.pdf" target="_blank">
		<font color="#A42903">
			<h3>Tome 6</h3>
		</font>
	</a><br />
	
	<a href="jougla/tome_07.pdf" target="_blank">
		<font color="#A42903">
			<h3>Tome 7</h3>
		</font>
	</a><br />
	
  </center>
  
  <?php
  }
  ?>
  
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<center>	
<i><a href="../" ><font color="#A42903"><h3>Retour à Palisep Accueil</h3></font></a></i><br />
<img src="../resources/images/chevalier.jpg" height="400px" >
</center>

</div>
</body>
</html>
