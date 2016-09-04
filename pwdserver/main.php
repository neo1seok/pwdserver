<!--  <!DOCTYPE html>
<meta charset="utf-8" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, height=device-height">-->

<?php
include("library.php");  // library.php 파일 포함
defMeta();
setHome("");

checkSession();


echo date("Y-m-d H:i:s") . "<br />\n";
$yoil = array("일","월","화","수","목","금","토");
echo($yoil[date('w')]);

// session_start();
// if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
// 	echo "<meta http-equiv='refresh' content='0;url=login.php'>";
// 	exit;
// }

?>


<p><a href='update.php?option=insert'>추가</a></p>
<p><a href='insert_header.php'>헤더추가</a></p>

<meta charset="utf-8" />
<form method='post' action='search.php'>
<table>
<tr>
	<td><input type='text' name='keyword' tabindex='1'/></td>
	<td><input type='submit' tabindex='2' value='검색'/></td>
</tr>
</table>
</form>

<ul>
<lis class="st"><a href='showlist.php?uids=all'>전체리스트보기</a></lis>
<lis class="st"><a href='webtoon.php'>웹툰보기</a></lis>
<li><a href='login.php?option=logout'>로그아웃</a></li>
</ul>
