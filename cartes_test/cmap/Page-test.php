<?PHP
//  Exemple de script PHP de récupération des données transmises par la carte  
if(isset($_GET['dpt'])){
$dpt = $_GET['dpt'];
}else{
//   departement par défaut si la variable   
//   $dpt n'est pas renseugnée               
$dpt="";


}
?>
<html>
<head>
<title>Page Test France - Multi Links</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
Body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #333333;
	line-height: 20px;
}
td {
	line-height: 20px;
	font-size: 12px;

}

-->
</style>
</head>
<body>
<table width="950" border="0" cellspacing="4" cellpadding="0">
  <tr> 
    <td width="600">
	<?PHP
	$CODE=$dpt;
	//$SIZE_MAP="400";
	//$BG_COLOR="0xFBFCD1";
	include("map.php");
	?></td>
    <td> <table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:solid 1px">
        <tr>
          <td align="center" bgcolor="#D0DC81">Exemple de r&eacute;cup&eacute;ration 
            des infos</td>
        </tr>
        <tr> 
          <td> 
            <?PHP
	//    Affichage des données récupérées   
	echo "<h4>Cliquez sur la carte - $dpt</h4>";
	
	
	?>
          </td>
        </tr>
      </table>
<p>Cette carte existe en plusieurs versions : </p>
      <ul>
        <li>France et dom tom.</li>
        <li>France -xml sans base de donn&eacute;es sql.</li>
        <li>France PHP datas avec vos donn&eacute;es.</li>
      </ul>
      <p>Nous personnalisons &eacute;galement vos cartes selon vos besoins, votre 
        graphisme, votre base de donn&eacute;es... A partir de 9.90 euros.</p>
      <p><a href="http://www.cmap.comersis.com" target="_blank">http://www.cmap.comersis.com</a></p>
      <p> 
        <input name="install" type="button" value="Installation" onClick="location.href='Installation.htm'">
      </p>
      <p>&nbsp; </p>
      <p>&nbsp;</p></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
