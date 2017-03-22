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
$curpage = getcurpage();

//#pagego('webtoon.php');

?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 위 3개의 메타 태그는 *반드시* head 태그의 처음에 와야합니다; 어떤 다른 콘텐츠들은 반드시 이 태그들 *다음에* 와야 합니다 -->
    <title>원석의 홈페이지</title>


		<!-- 합쳐지고 최소화된 최신 CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

		<!-- 부가적인 테마 -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

		<style type="text/css">

		ul {
			list-style-type: none;
			padding-right: 20px;
		padding-left: 0px;
		}


		li {
		 display: inline;
		 padding: 0 20px;
		 border-right:  1px solid #999;
		}
		li[class=\"st\"]{
		 display: inline;
		 padding: 0 10px;
		}
		.st {
		 display: inline;
		 padding: 0 10px;
		}
		</style>

    <!-- IE8 에서 HTML5 요소와 미디어 쿼리를 위한 HTML5 shim 와 Respond.js -->
    <!-- WARNING: Respond.js 는 당신이 file:// 을 통해 페이지를 볼 때는 동작하지 않습니다. -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <script src="https://www.w3schools.com/lib/w3data.js"></script>


  <body>




				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
				<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> -->
				<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
				<script src="comm/js/util.js"></script>
				<script type="text/javascript">
        w3IncludeHTML();

				function update_link(maplist){
					var index = 0;




					//$('#go_webtoon').text(maplist[0].title);

					//go_webtoon go_pwd
					$.each( maplist, function( i, val ) {

						var del_link ='';
						if(i <= 1){

							//$('.class_dir_btn').append(`<lis class='st'><a class="btn btn-success btn-lg" id='${ val.fnk_uid }' href="${val.link}" role="button">${ val.title }</a></lis>`);
							return;
						}
						if(i >2) del_link= `<a class='class_del' id='${ val.fnk_uid }' href=#>삭제</a>`;
						//console.log(index);
						//console.log(del_link);

						$('#link_table tbody').append(`<tr id='${ val.fnk_uid }_tr'><th><a class='class_link_user' id='${ val.fnk_uid }_link' href='${val.link}'>${ val.title }</a> </th><th>${del_link}</th></tr>`);
						index ++;
						//console.log(val.fnk_uid);
						//console.log(val.link);
					});
				}

				var  str_maplist = '<?php echo $str_json_maplist; ?>';
				//console.log(str_maplist);
				//console.log(convert_to_safe_json_string(str_maplist));

				var maplist  = $.parseJSON( convert_to_safe_json_string(str_maplist));
				var a = 5;
				var b = 10;
				//console.log(`Fifteen is ${a + b} and\nnot ${2 * a + b}.`);

				$(document).ready(function(){
					update_link(maplist);
        //  var navi = get_navigation('');

        var base_url = window.location.origin;

var host = window.location.host;

var pathArray = window.location.pathname.split( '/' );


          console.log(base_url);
          console.log( host);
          console.log( pathArray);
          var  map_container =
          { Header: "원석의 심플 홈피", Discription: "이 홈페이지는 신원석(neo1seok)의 집에 있는 라즈베리파이의 아파치 서버위에서 돌아가고 있습니다.",
            Links: [
                { Name: "FAV LINK>>", Link: "#",Id:"toggle_link" },
                { Name: "ADD LINK>>", Link: "#" ,Id:"toggle_add_link"},
                { Name: "EXCUTE SHELL>>", Link: "#" ,Id:"toggle_excute"},
            ],


          };


          setup_nav('#navi','#main_container',map_container);

          //console.log(navi);
        //  $('#navi').append(get_navigation());
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


        <div id = 'navi'></div>
        <div id = 'main_container'></div>


        <!-- <div class="jumbotron">
              <div class="container">
                <h1>원석의 심플 홈피</h1>
                <p>이 홈페이지는 신원석(neo1seok)의 집에 있는 라즈베리파이의 아파치 서버위에서  돌아가고 있습니다.</p>

                <ul class='class_dir_btn'></ul>

                <p><a class="btn btn-info btn-lg" id='toggle_link' href="#" role="button">FAV LINK »</a></p>
                <p><a class="btn btn-info btn-lg" id='toggle_add_link' href="#" role="button">ADD LINK »</a></p>
                <p><a class="btn btn-info btn-lg" id='toggle_excute' href="#" role="button">EXCUTE SHELL »</a></p>
              </div>
            </div> -->


				<div class="col-md-6" id='div_link' >
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

  </body>
</html>
