<?php


$dbname = "neo_pwinfo";

//Connect DB
$connect = @mysql_connect("localhost:3306","neo1seok","tofhdna1pi") or die("DB접속에러");

//Select DB
@mysql_select_db($dbname,$connect) or die("DB선택에러");

$strQuery = "SELECT seq, fnk_uid, title, link, updt_date, reg_date, comment FROM fav_link where type = 'MAIN' order by seq;"

$result = @mysql_query($strQuery) or die($die_string(mysql_error(),$strQuery));

$data=@mysql_fetch_row($result);

mysql_close($connect);

$map = $data[0];
$title = $map['title'];
$link = $map['link'];

echo $title;
?>
