<?php
require_once("library.php");  // library.php 파일 포함
//defMeta();
setHome("");

$maplist = QueryString2Map("SELECT seq, fnk_uid, title, link, updt_date, reg_date, comment FROM fav_link where type = 'MAIN' order by seq;");
//$maplist = QueryString2Map("SELECT seq, fnk_uid, title, link, updt_date, reg_date, comment FROM fav_link  order by seq;");
// $list_aa = array();

foreach ($maplist as $map){
	$title = $map['title'];
	$link = $map['link'];
	$list_bb = array();
	array_push($list_bb, $title, $link);
	array_push($list_aa, $list_bb);
	echo "<p><a href='$link'>$title</a></p>";
	echo "\n";

}

?>
