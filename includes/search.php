<?php
$word=$_GET['word'];
$parameter=str_replace(" ","+",$word);
$results=file_get_contents("http://ayar.co/remote_result.php?q=".$parameter);
$arr=explode("4: ",$results);  // maximum of 3 definitions
echo $arr[0];
?>
<br/><input type="button" value="Close" onclick="jQuery('#popup').fadeOut(300);">