<?php
require_once ("library.php"); // library.php 파일 포함

checkSession();
$header = '패스워드 정보';

#$sql = "SELECT tdc_uid, title ,updt_date FROM today_contents order by updt_date desc;";
$incondition = '';
$sql = "SELECT pwd_uid,site, B.title as header,ptail as tail ,B.phd_uid FROM passwd A,pheader B where A.phd_uid = B.phd_uid $incondition;";
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
    <script 		src="js/util.js" type="text/javascript"></script>
    <script 		src="js/company.js" type="text/javascript"></script>

    <script type="text/javascript">


		var str_list_contents = `<?php echo $list_contents; ?>`;
		console.log(convert_to_safe_json_string(str_list_contents));
		var list_contents = JSON.parse(convert_to_safe_json_string(str_list_contents));
		function update_list(list_contents) {
			list_contents.forEach(function(item, index){
					$('#table_today_all tbody').append(`<tr>
						<th><a href="#" class='cla_site' id='${item.pwd_uid}'>${item.site}</a></th>
            <th>${item.header}</th>
            <th>${item.tail}</th>
						</tr>`);


			})
		}


    $(function() {
      console.log('ready 1');

			var  map_container =
      { Header: "<?php echo $header; ?>", Discription: "이 페이지는 개인 정보를 저장하는 페이지 이다.",
        Links: [
            { Name: "입력>>", Link: "#" ,Id:"toggle_input"},
            { Name: "전체 목록>>", Link: "#" ,Id:"toggle_list"},
						{ Name: "정보>>", Link: "#" ,Id:"toggle_contents"},
						{ Name: "전체토글>>", Link: "#" ,Id:"toggle_all"},
        ],


      };





      setup_nav('#navi','#main_container',map_container,'#nav_contents');
      update_list(list_contents);

			//$('#div_today').show();
			//$('#div_all').hide();
      $('#div_input').hide();
			$('#div_contents').hide();

			var toggle_map =
			[
					{ Btn: "#toggle_contents", Div:"#div_contents",IsShow:false},
					{ Btn: "#toggle_list", Div:"#div_list",IsShow:false},
					{ Btn: "#toggle_input", Div:"#div_input",IsShow:false},
			]

			map_toggle_click(toggle_map);
			all_toggle_click('#toggle_all',toggle_map);

			// $('#toggle_all').click(function(){
			// 	all_toggle_click(toggle_map);
			//
		  // });

			map_click();


    });


    </script>
    <div id = 'navi'></div>
    <div id = 'main_container'></div>



		<div class="col-md-6" id='div_list' >
			<h2>전체 리스트</h2>
		<table id="table_today_all"  class="table table-striped">
			<thead>
				<tr>
					<th>사이트</th>
					<th width=10>헤더이름</th>
					<th width=10>태일이름</th>
				</tr>
			</thead>
			<tbody>
		 </tbody>
		</table>
		<a id="input_new" href="#">새로운 글 입력 </a>

		</div>

		<div  class="container" id="div_input" name="div_input">

      <h1>GIANT 2 회사 정보 입력</h1>

        <div class="">
        <button type="button" id='generate' class="btn btn-lg btn-primary">샘플 발생</button>
        </div>

        <form id ='factorykey_form' name = 'default_form'>
          <div class="form-group"></div>

        </form>
        <form id ='default_form' name = 'default_form'>
          <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">회사 선택
          <span class="caret"></span></button>
          <ul class="dropdown-menu" id = 'company_no_select'>
          </ul>
          </div>

          <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">FACTORY KEY ID 선택
          <span class="caret"></span></button>
          <ul class="dropdown-menu" id = 'factory_key_id_select'>
          </ul>
        </div>

        </form>
        <form id ='url_form' name = 'reg_form'>
          <div class="form-group"></div>

        </form>

		</div> <!-- /container -->
		<div  class="container" id="div_search" name="div_search">
      <form class="form-signin">
				<h2 class="form-signin-heading">컨텐츠 검색</h2>
				<input type="hidden" id="inputId" class="form-control" value="">
				<label for="inputTitle" class="sr-only">Title</label>
				<input type="text" id="inputTitle" class="form-control" placeholder="Title" required autofocus>
				<button id=btnSearch class="btn btn-lg btn-primary btn-block" >입력</button>
			</form>


		</div> <!-- /container -->

</body>
</html>
