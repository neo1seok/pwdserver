<?php
require_once ("library.php"); // library.php 파일 포함

$header = '오늘의 정보';

$sql = "SELECT tdc_uid, title FROM today_contents;";
$list_contents = json_encode(QueryString2Map($sql));


?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 위 3개의 메타 태그는 *반드시* head 태그의 처음에 와야합니다; 어떤 다른 콘텐츠들은 반드시 이 태그들 *다음에* 와야 합니다 -->
    <title><?php echo $header; ?></title>

    <!-- 부트스트랩 -->

		<!-- 합쳐지고 최소화된 최신 CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

		<!-- 부가적인 테마 -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">



    <!-- IE8 에서 HTML5 요소와 미디어 쿼리를 위한 HTML5 shim 와 Respond.js -->
    <!-- WARNING: Respond.js 는 당신이 file:// 을 통해 페이지를 볼 때는 동작하지 않습니다. -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
  </head>
</head>

<body>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> -->
    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

		<script src="../comm/js/util.js"></script>
		<script src="../comm/js/base64.js"></script>
		<script src="js/main.js"></script>

    <script type="text/javascript">


		var str_list_contents = `<?php echo $list_contents; ?>`;
		console.log(convert_to_safe_json_string(str_list_contents));
		var list_contents = JSON.parse(convert_to_safe_json_string(str_list_contents));
		function update_list(list_contents) {
			list_contents.forEach(function(item, index){
					$('#table_today_all tbody').append(`<tr>
						<th><a href="#" class='cla_show' id='${item.tdc_uid}'>${item.title}</a></th>
						<th><a href="#" class='cla_modify' id='${item.tdc_uid}'>수정</a> </th>
						<th><a href="#" class='cla_del' id='${item.tdc_uid}'>삭제</a> </th>
						</tr>`);


			})
		}


    $(function() {
      console.log('ready');

			var  map_container =
      { Header: "<?php echo $header; ?>", Discription: "이 페이지는 개인 정보를 저장하는 페이지 이다.",
        Links: [
            { Name: "정보 입력>>", Link: "#" ,Id:"toggle_add_webtoon"},
            { Name: "전체 목록>>", Link: "#" ,Id:"toggle_all"},
        ],


      };


      setup_nav('#navi','#main_container',map_container,'#nav_webtoon');



              var base_url = window.location.origin;

      var host = window.location.host;

      var pathArray = window.location.pathname.split( '/' );


                console.log(base_url);
                console.log( host);
                console.log( pathArray);


      update_list(list_contents);

			//$('#div_today').show();
			//$('#div_all').hide();
      $('#div_input').hide();
			$('#div_contents').hide();

			map_click();

// 			$('#toggle_today').click(function(){
// 				console.log('toggle_today');
//
// 				$('#div_today').toggle();
//
// 			});
// 			$('#toggle_all').click(function(){
// 				console.log('toggle_all');
//
// 				$('#div_all').toggle();
//
//
//
// 			});
// 			$('#toggle_add_webtoon').click(function(){
// 				console.log('toggle_all');
//
// 				$('#div_input').toggle();
//
//
//
// 			});
// 			$('.cla_show').click(function(){
// 				var id =this.id;
// 				console.log('click cla_show',id);
// 				var url = `dbupdate.php?option=get_contents&id=${id}`;
// 				//var url = ``;
// 				console.log(url);
// 				$.get( url, function( data ) {
// 					console.log('input result');
// 					console.log(data);
// 					var map_contents = JSON.parse(convert_to_safe_json_string(data));
// 					console.log('input END');
// 					if(map_contents.length == 0) return false;
// 					console.log(map_contents[0].title);
// 					$('#p_title').text(map_contents[0].title);
// 					$('#p_issue').text(map_contents[0].issue);
// 					$('#p_solution').text(map_contents[0].solution);
//
// 					$('#div_contents').show();
// 					$('#div_input').hide();
// 					//$('#div_contents').show();
//
// 				 });
// 			});
// 			$('.cla_del').click(function(){
// 				var id = this.id;
// 				console.log('click cla_del',id);
// 				if(!confirm('정말로 삭제하시겠습니까?')) return false;
//
// 				$.get( `dbupdate.php?option=delete&id=${id}`, function( data ) {
// 					console.log('input result');
// 					console.log(data);
// 					console.log('input END');
// 					if( convert_to_safe_json_string(data) == 'OK'){
// 						location.reload();
// 						console.log('location.reload');
//
// 					}
//
// 				 });
//
// 			});
// 			$('.cla_modify').click(function(){
// 				var id = this.id;
// 				console.log('click cla_modify',id);
// 				var url = `dbupdate.php?option=get_contents&id=${id}`;
// 				//var url = ``;
// 				//var url = ``;
// 				console.log(url);
// 				$.get( url, function( data ) {
// 					console.log('input result');
// 					console.log(data);
// 					var map_contents = JSON.parse(convert_to_safe_json_string(data));
// 					console.log('input END');
// 					if(map_contents.length == 0) return false;
// 					console.log(map_contents[0].title);
//
//
// 					$('#inputTitle').val(map_contents[0].title);
// 					$('#inputIssue').val(map_contents[0].issue);
// 					$('#inputSolution').val(map_contents[0].solution);
// 					$('#inputId').val(map_contents[0].tdc_uid);
//
// 					$('#div_contents').hide();
// 					$('#div_input').show();
//
//
//
// 				 });
//
// 			});
// 			$('#input_new').click(function(){
// 				console.log('click input_new');
// 				$('#inputTitle').val("");
// 				$('#inputIssue').val("");
// 				$('#inputSolution').val("");
// 				$('#inputId').val("");
//
// 				$('#div_contents').hide();
// 				$('#div_input').show();
//
// 			});
//
//
// 			$('#btnInput').click(function(){
//
// 				var inputTitle = $('#inputTitle').val();
// 				var inputIssue = $('#inputIssue').val();
// 				var inputSolution = $('#inputSolution').val();
// 				var inputId =$('#inputId').val();
//
// 				if( inputTitle == '' ){
// 					alert('값을 입력해 주세요');
// 					return;
// 				}
//
// 				var map_contents ={
// 					Title:inputTitle,
// 					Issue:inputIssue,
// 					Solution:inputSolution,
// 				}
// 				var json_contents = JSON.stringify(map_contents)
//
// //				JSON.stringify(map_contents);
//
//
//
// 				var b64_contents = utf8_to_b64( json_contents );
// 				console.log(json_contents);
// 				console.log(inputTitle,inputIssue,inputSolution);
// 				console.log(b64_contents);
//
// 				//alert('값을 입력해 주세요');
// 			//	return;
// 			 var url = `dbupdate.php?option=input&contents=${b64_contents}`;
// 				if(inputId !="" ){
// 						url = `dbupdate.php?option=modify&id=${inputId}&contents=${b64_contents}`;
// 				}
//
//
//
// 				//var url = ``;
// 				console.log(url);
// 				if(!confirm('입력 하시겠습니까?')) return false;
// 				$.get( url, function( data ) {
// 					console.log('input result');
// 					console.log(data);
// 					console.log('input END');
// 					if( convert_to_safe_json_string(data) == 'OK'){
// 						location.reload();
// 						console.log('location.reload');
//
// 					}
//
// 				 });
// 				 return false; //<- 이 문장으로 새로고침(reload)이 방지됨
//
//
//
//
// 			});
// 			//div_input

    });


    </script>
    <div id = 'navi'></div>
    <div id = 'main_container'></div>



		<div class="col-md-6" id='div_all' >
			<h2>전체 리스트</h2>
		<table id="table_today_all"  class="table table-striped">
			<thead>
				<tr>
					<th>제목</th>
					<th width=10>수정</th>
					<th width=10>삭제</th>
				</tr>
			</thead>
			<tbody>
		 </tbody>
		</table>
		<a id="input_new" href="#">새로운 글 입력 </a>

		</div>

		<div  class="container" id="div_input">


			<form class="form-signin">
				<h2 class="form-signin-heading">컨텐츠 입력</h2>
				<input type="hidden" id="inputId" class="form-control" value="">
				<label for="inputTitle" class="sr-only">Title</label>
				<input type="text" id="inputTitle" class="form-control" placeholder="Title" required autofocus>

				<label for="inputIssue" class="sr-only">Title</label>
				<TEXTAREA id=inputIssue NAME='cmd' ROWS=5 COLS=100 placeholder="ISSUE" class="form-control" tabindex='2'></TEXTAREA>

				<label for="inputSolution" class="sr-only">Password</label>
				<TEXTAREA id=inputSolution NAME='cmd' ROWS=10 COLS=100 placeholder="SOLUTION" class="form-control" tabindex='2'></TEXTAREA>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="remember-me"> Remember me
					</label>
				</div>
				<button id=btnInput class="btn btn-lg btn-primary btn-block" >입력</button>
			</form>

		</div> <!-- /container -->
		<div  class="container" id="div_contents">
			<article>
				<!-- READ HEADER -->
				<div class="read_header">
					<h2><span class="label label-default">제목</span></p></h2>
					<h3 id='p_title'></h3>
					<p class="time">2017.04.04 10:20</p>
					<p class="meta"></p>
				</div>
				<!-- /READ HEADER -->
				<!-- Extra Output -->
					<!-- /Extra Output -->
				<!-- READ BODY -->
				<div class="read_body">
					<h2> <span class="label label-default">이슈</span></h2>
					<p id='p_issue'></p>
					<h2> <span class="label label-default">솔루션</span></h2>
					<p id='p_solution'></p>


				</div>
				<!-- /READ BODY -->
				<!-- READ FOOTER -->
				<div class="read_footer">	</div>
				</div>
				<!-- /READ FOOTER -->
			</article>


		</div> <!-- /container -->

</body>
</html>
