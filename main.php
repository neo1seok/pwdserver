<?php
require_once("library.php");  // library.php 파일 포함
//defMeta();
setHome("");

$maplist = QueryString2Map("SELECT seq, fnk_uid, title, link, updt_date, reg_date, comment FROM fav_link;");
// $list_aa = array();
//
// foreach ($maplist as $map){
// 	$title = $map['title'];
// 	$link = $map['link'];
// 	$list_bb = array();
// 	array_push($list_bb, $title, $link);
// 	array_push($list_aa, $list_bb);
// 	echo "<p><a href='$link'>$title</a></p>";
// 	echo "\n";
//
// }
$str_json_maplist = json_encode($maplist);

//#pagego('webtoon.php');

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> -->
<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>



<script type="text/javascript">
function convert_to_safe_json_string(str){
	var s = str;
	//console.log('convert_to_safe_json_string');

	//s = s.replace(String.fromCharCode(65279), "" );
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
	s = s.replace(/[\ufeff]*/gi,"");
	return s;
}
function update_link(maplist){
	var index = 0;
	$.each( maplist, function( i, val ) {
		var del_link ='';
		if(index >2) del_link= `<a class='class_del' id='${ val.fnk_uid }' href=#>삭제</a>`;
		//console.log(index);
		//console.log(del_link);

		$('#link_table tbody').append(`<tr id='${ val.fnk_uid }_tr'><th><a class='class_link_user' id='${ val.fnk_uid }_link' href='${val.link}'>${ val.title }</a> </th><th>${del_link}</th></tr>`);
		index ++;
		//console.log(val.fnk_uid);
		//console.log(val.link);
	});
}
function toHex(str) {
    var result = '';
    for (var i=0; i<str.length; i++) {
      result += str.charCodeAt(i).toString(16);
    }
    return result;
  }
var  str_maplist = '<?php echo $str_json_maplist; ?>';
//console.log(str_maplist);
//console.log(convert_to_safe_json_string(str_maplist));

var maplist  = $.parseJSON( convert_to_safe_json_string(str_maplist));
var a = 5;
var b = 10;
console.log(`Fifteen is ${a + b} and\nnot ${2 * a + b}.`);

$(document).ready(function(){
	update_link(maplist);
	$('#div_link').hide();
	$('#div_add_link').hide();
	$('#div_excute_shell').hide();

	$('.class_del').click(function(){
		console.log('class_del');
		var link_id = `${this.id}_link`;
		tr_id = `${this.id}_tr`;
		console.log(link_id);
		console.log(tr_id);
		var ret = confirm($('#'+link_id).text()+' 항목을 지우시겠습니까?');
		console.log(ret);
		if(!ret) return;
		del_result = 'FAIL';
		var resp = $.get( "del_link.php?uid="+this.id, function( data ) {
				console.log('get del_link');
				console.log(data);
				console.log(toHex(data));
				data = convert_to_safe_json_string(data)

				console.log(toHex(data));

				if( data =='OK'){
					console.log(tr_id);
					$('#'+tr_id).remove();
				}
			//console.log(data.html());
			//var map_Presult  = $.parseJSON( convert_to_safe_json_string(data));
			//console.log(map_Presult);
			 $('#txt_result').append( data );
			 //del_result = data;
			 //console.log(data);
			 //alert( "Load was performed." );
			 //return 'FUCK';
		 });
		//$('#'+tr_id).remove();


		//console.log($(this).val);



	});
	$('#btn_excute').click(function(){
		console.log('btn_excute');
		var strcmd= $('#txt_cmd').val();
		console.log(strcmd);
		 $.get( "comm/excuteshell.php?cmd="+strcmd, function( data ) {
			 console.log('get ');
			 //$(data).html();

		 		$('#txt_result').append( data );
		 		//alert( "Load was performed." );
		 	});

	});

	$('#toggle_link').click(function(){
		console.log('toggle_link');

		$('#div_link').toggle();

	});
	$('#toggle_add_link').click(function(){
		console.log('toggle_add_link');

		$('#div_add_link').toggle();

	});
	$('#toggle_excute').click(function(){
		console.log('toggle_excute');

		$('#div_excute_shell').toggle();

	});
});


</script>

<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>


<div class="jumbotron">
      <div class="container">
				<h1>원석의 심플 홈피</h1>
        <p>이 홈페이지는 신원석(neo1seok)의 집에 있는 라즈베리파이의 아파치 서버위에서  돌아가고 있습니다.</p>
        <p><a class="btn btn-info btn-sm" id='toggle_link' href="#" role="button">FAV LINK »</a></p>
				<p><a class="btn btn-info btn-sm" id='toggle_add_link' href="#" role="button">ADD LINK »</a></p>
				<p><a class="btn btn-info btn-sm" id='toggle_excute' href="#" role="button">EXCUTE SHELL »</a></p>
      </div>
    </div>


<div id='div_link' >

<div class="col-md-6">
<table id="link_table" class="table table-striped">
	<thead>
		<tr>
			<th>제목</th>
			<th>삭제</th>
		</tr>
	</thead>
	<tbody>
 </tbody>
</table>
</div>
</div>
<div id='div_add_link' >

<form name = 'input' method='post' action='insertlink.php'>

<input type='hidden' name='option'  readonly value='' />

<table>
<tr>
	<td class="label label-success">제목</td>
	<td><input type='text' name='title' tabindex='1'  /></td>
</tr>

<tr>
	<td class="label label-success">링크</td>
	<td><TEXTAREA NAME='link' ROWS=3 COLS=100 tabindex='2'>

</TEXTAREA></td>
	</tr>

</table>

<input type='submit' tabindex='3' value='링크추가' style='height:50px'/>
</form>
</div>
<div id='div_excute_shell' >
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
<button class='btn btn-lg btn-primary' id="btn_excute" type="submit" tabindex='3'  name="button" style='height:50px' >실행</button>
<p id=txt_result></p>
<!--<input type='submit' tabindex='3' value='실행' style='height:50px'/>
</form>-->
</div>
