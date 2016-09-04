<?php




function pagego($url){
	echo "<meta http-equiv='refresh' content='0;url=$url'>";
}


function appendLn($str){
	echo $str;
	echo "\n";	
}
function pnl(){
	echo "<br />\n";
}

function defMeta(){
	echo '<!DOCTYPE html>';
	echo "\n";
	echo '<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">';
	echo "\n";
	echo '<meta charset="utf-8" />';
	echo "\n";
	echo '<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, height=device-height">';
	echo "\n";
	
	echo '<head>';
	echo "\n";
	echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
	echo "\n";
	echo '</head>';
	echo "\n";
	
}


?>	