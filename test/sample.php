<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 위 3개의 메타 태그는 *반드시* head 태그의 처음에 와야합니다; 어떤 다른 콘텐츠들은 반드시 이 태그들 *다음에* 와야 합니다 -->
    <title>TITLE</title>

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
  </head>
</head>
<body>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> -->
    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="../comm/js/util.js"></script>

    <script type="text/javascript">


    $(function() {
      var  map_container =
      { Header: "SAMPLE", Discription: "sample Discription",
        Links: [
            { Name: "SAMPLE>>", Link: "#",Id:"toggle_link" },
            { Name: "SAMPLE>>", Link: "#" ,Id:"toggle_add_link"},
            { Name: "SAMPLE1>>", Link: "#" ,Id:"toggle_excute"},
        ],


      };


      setup_nav('#navi','#main_container',map_container);
      console.log('ready');

    });


    </script>
    <div id = 'navi'></div>
      <div id = 'main_container'></div>
    <!-- <div class="jumbotron">
          <div class="container">
            <h1>TITLE</h1>
            <p>DICCRIPT.</p>
            <p><a class="btn btn-info btn-lg" id='toggle_link' href="#" role="button">FAV LINK »</a></p>
          </div>
        </div> -->

        <div  class="container" id="div_input">

          <form class="form-signin">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>

            <label for="txt_cmd" class="sr-only">Password</label>
            <TEXTAREA id=txt_cmd NAME='cmd' ROWS=5 COLS=100 class="form-control" tabindex='2'></TEXTAREA>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me"> Remember me
              </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
          </form>

        </div> <!-- /container -->
</body>
</html>
