<?PHP
$vars = "";
if(!isset($SIZE_MAP)){ $SIZE_MAP = "450"; }
if(!isset($DIR_MAP)){ $DIR_MAP=""; }// avec slash à la fin 
if(isset($URL_REDIR)){ $vars .= "&url_redir=$URL_REDIR"; }
if(isset($URL_TARGET)){ $vars .= "&url_target=$URL_TARGET"; }
if(isset($CODE)){ $vars .= "&code=$CODE"; }
if(isset($ROLL_BT)){ $vars .= "&roll_bt=$ROLL_BT"; }
if(isset($PRES_BT)){ $vars .= "&pres_bt=$PRES_BT"; }
if(isset($BG_COLOR)){ $vars .= "&bg_color=$BG_COLOR"; }
if(isset($BORDERS)){ $vars .= "&borders=$BORDERS"; }
//0xFBFCD1
echo "<!--URL utilisées dans l'animation-->
<!--<a href='http://map.comersis.com'>Free interactive map</a>-->
<!--texte utilisé dans l'animation-->
<!--Vector and interactive maps for website-->
";
echo "<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0'
width='$SIZE_MAP'
height='$SIZE_MAP'
id='France-free'
align='middle'>
        <param name='allowScriptAccess' value='sameDomain' />
        <param name='allowFullScreen' value='true' />
        <param name='movie' value='".$DIR_MAP."france-free.swf' />
        <param name='menu' value='false' />
        <param name='flashvars' value='$vars'>
        <param name='quality' value='best' />
        <param name='wmode' value='transparent' />
        <param name='bgcolor' value='#999999' />
        <embed src='".$DIR_MAP."france-free.swf'
menu='false'
flashvars='$vars'
quality='best'
wmode='transparent'
bgcolor='#999999'
width='$SIZE_MAP'
height='$SIZE_MAP'
name='France-free'
align='middle'
allowscriptaccess='sameDomain' 
allowFullScreen='true'
type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' /> 
</object>";

?>