



function sha256_from_hexstr(hex_str){
  var str = hex2a(hex_str);
  console.log(str);

  //
  return Sha256.hash(hex_str,{ msgFormat: 'hex-bytes', outFormat: 'hex' });
	//return crypto_util.sha256(neoutil.Text2HexString(passwd) + rn)
}

function calc_passwd(passwd,rn){
  return sha256_from_hexstr(toHex(passwd) + rn);
	//return crypto_util.sha256(neoutil.Text2HexString(passwd) + rn)
}

function calc_access_code(passwd,rn,prev_value,server_rn){

  console.log('calc_access_code')
	console.log('passwd',passwd)
	console.log('rn', rn)
	console.log('prev_value',prev_value )
	console.log('server_rn', server_rn)

  hashpwd = calc_passwd(passwd,rn)
  console.log('hashpwd',hashpwd)
  inputhash = hashpwd + server_rn+Sha256.hash(prev_value)//crypto_util.sha256(neoutil.Text2HexString(prev_value))
  console.log('prev_value',prev_value)
  console.log(inputhash)
  return sha256_from_hexstr(inputhash)
}








function mainController($scope, $window,$http) {
 console.log('myApp');
 // console.log('chipInit',$window.list_contents);;
 // $scope.list_contents = $window.list_contents
 $scope.shwoContents = true;
 $scope.warning = "";
 $scope.msg = "";
 $scope.contents_title = "Insert New CONTENTS:";
$scope.check_save = false;

$scope.hint = '';

$scope.bodyInit= function() {

  //alert('bodyInit returl_url cookie='+document.cookie);

  $http.post('/comm/login_handler.php', $.param({
      option: 'access_info'
    }), {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      }
    })
    //$http.get("/giant_auth/admin?cmd=MODIFY_MASTERKEY_CHIP&sn="+$scope.sn+"&msk_uid="+msk_uid)
    .then(function(response) {
      console.log('get_contents');
      console.log(response.data);

      $scope.pre_key = response.data.pre_key;
      $scope.server_rn = response.data.server_rn;
      $scope.rn_per_hashid = response.data.rn_per_hashid;



    }, function errorCallback(response) {
      $scope.warning = response.status;
    });



	$scope.map_list_contents = {
		'1':{
			'title':'title',
			'updt_date':'updt_date',
		}

	};

  $scope.id = getCookie('id');
  $scope.pwd = getCookie('pwd');







}


$scope.login= function() {

  $scope.warning = "";

  console.log('login',$scope.id,$scope.pwd,$scope.hint);
  if($scope.id =='' || $scope.pwd ==''|| $scope.hint == ''){
    $scope.warning ="값이 비어 있습니다. ";
    return;
  }



     hash_id = Sha256.hash($scope.id);
     rn = $scope.rn_per_hashid[hash_id];
     console.log('rn',rn);
     console.log('test',toHex('teHIJKGst'));


    access_code = calc_access_code($scope.pwd,rn,$scope.hint,$scope.server_rn)
    console.log('access_code',access_code);



  $http.post('/comm/login_handler.php', $.param({
      id:'neo1seok',
      access_code:access_code
    }), {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      }
    })
    //$http.get("/giant_auth/admin?cmd=MODIFY_MASTERKEY_CHIP&sn="+$scope.sn+"&msk_uid="+msk_uid)
    .then(function(response) {
      console.log('get_contents');
      console.log(response.data);

      if(response.data.result != 'OK'){
        $scope.warning = response.data.error;
        return;
      }


      setCookie('id',$scope.id,1);
      console.log('login returl_url cookie='+document.cookie);
      setCookie('pwd',$scope.pwd,1);
      console.log('login returl_url cookie='+document.cookie);
      url = getCookie('returl_url');

      //alert("url  ="+url);// Returns full URL
      //alert('returl_url cookie='+getCookie('returl_url'));
      if(url != "")
        console.log('url',url);
      else {
        url = '/';

      }

      document.location.href = url;








    }, function errorCallback(response) {
      $scope.warning = response.status;
    });









}






$scope.test= function() {
  console.log('test',id);

}
$scope.test= function() {
  console.log('test',id);

}
$scope.test= function() {
  console.log('test',id);

}
$scope.test= function() {
  console.log('test',id);

}
$scope.test= function() {
  console.log('test',id);

}
$scope.test= function() {
  console.log('test',id);

}
$scope.test= function() {
  console.log('test',id);

}




};
