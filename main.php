<?php
require_once("library.php");  // library.php 파일 포함
defMeta();
setHome("");
echo '<h1>원석의 심플 홈피</h1>';
echo '<p>이 홈페이지는 신원석(neo1seok)의 집에 있는 라즈베리파이의 아파치 서버위에서  돌아가고 있습니다.</p>';

$maplist = QueryString2Map("SELECT seq, fnk_uid, title, link, updt_date, reg_date, comment FROM fav_link;");
$list_aa = array();

foreach ($maplist as $map){
	$title = $map['title'];
	$link = $map['link'];
	$list_bb = array();
	array_push($list_bb, $title, $link);
	array_push($list_aa, $list_bb);
	echo "<p><a href='$link'>$title</a></p>";
	echo "\n";

}
$str_json_maplist = json_encode($maplist);

//#pagego('webtoon.php');

?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript">
function convert_to_safe_json_string(str){
	var s = str;
	s = s.replace(/\\n/g, "\\n")
	               .replace(/\\'/g, "\\'")
	               .replace(/\\"/g, '\\"')
	               .replace(/\\&/g, "\\&")
	               .replace(/\\r/g, "\\r")
	               .replace(/\\t/g, "\\t")
	               .replace(/\\b/g, "\\b")
	               .replace(/\\f/g, "\\f");
	// remove non-printable and other non-valid JSON chars
	s = s.replace(/[\u0000-\u0019]+/g,"");
	return s;
}
var  str_maplist = '<?php echo $str_json_maplist; ?>';
//console.log(str_maplist);
//console.log(convert_to_safe_json_string(str_maplist));

var maplist  = $.parseJSON( convert_to_safe_json_string(str_maplist));
var a = 5;
var b = 10;
console.log(`Fifteen is ${a + b} and\nnot ${2 * a + b}.`);

$(document).ready(function(){
	$.each( maplist, function( i, val ) {
		$('#link_table').append(`<tr><th><a href='${val.link}'>${ val.title }</a> </th><th>TEST</th></tr>`);
		console.log(val.title);
		console.log(val.link);
	});
	$('#btn_excute').click(function(){
		console.log('btn_excute');
		var strcmd= $('#txt_cmd').val();
		console.log(strcmd);
		 $.get( "comm/excuteshell.php?cmd="+strcmd, function( data ) {
			 console.log(data);
		 		$('#txt_result').append( data );
		 		//alert( "Load was performed." );
		 	});

	});
});


</script>

<table id="link_table">
		<tr><th>HTMLa</th></tr>
		<tr><th>CSS</th></tr>
		<tr><th>javascript</th></tr>
		<tr class="selected"><th>jQuery</th></tr>
		<tr><th>PHP</th></tr>
		<tr><th>mysql</th></tr>
</table>
<form name = 'input' method='post' action='insertlink.php'>

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

<!--
<form name = 'excute' method='post' action='comm/excuteshell.php'>
-->
<input type='hidden' name='option'  readonly value='' />

<table>


<tr>
	<td>shell</td>
	<td><TEXTAREA id=txt_cmd NAME='cmd' ROWS=1 COLS=100 tabindex='2'></TEXTAREA></td>
	</tr>

</table>
<button id="btn_excute" type="submit" tabindex='3'  name="button" style='height:50px' >실행</button>
<p id=txt_result></p>
<!--<input type='submit' tabindex='3' value='실행' style='height:50px'/>
</form>-->
