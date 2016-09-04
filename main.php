<?php
require_once("library.php");  // library.php 파일 포함
defMeta();
setHome("");
echo '<h1>원석의 심플 홈피</h1>';
echo '<p>이 홈페이지는 신원석(neo1seok)의 집에 있는 라즈베리파이의 아파치 서버위에서  돌아가고 있습니다.</p>';

$maplist = QueryString2Map("SELECT seq, fnk_uid, title, link, updt_date, reg_date, comment FROM fav_link;");

foreach ($maplist as $map){
	$title = $map['title'];
	$link = $map['link'];
	echo "<p><a href='$link'>$title</a></p>";
	echo "\n";	
	
}

//#pagego('webtoon.php');

?>


<form name = 'input' method='post' action='insertlink.php'">

<input type='hidden' name='option'  readonly value='' />

<table>

<tr>
	<td>제목</td>
	<td><input type='text' name='title' tabindex='1'  /></td>
</tr>

<tr>
	<td>링크</td>
	<td><TEXTAREA NAME='link' ROWS=3 COLS=100 tabindex='2'>

</TEXTAREA></td>
	</tr>

</table>

<input type='submit' tabindex='3' value='링크추가' style='height:50px'/>
</form>


<form name = 'excute' method='post' action='comm/excuteshell.php'">

<input type='hidden' name='option'  readonly value='' />

<table>


<tr>
	<td>shell</td>
	<td><TEXTAREA NAME='cmd' ROWS=1 COLS=100 tabindex='2'></TEXTAREA></td>
	</tr>

</table>

<input type='submit' tabindex='3' value='실행' style='height:50px'/>
</form>

