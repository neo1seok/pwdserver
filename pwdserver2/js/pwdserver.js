
function update_from_showlist($scope,response){

	$scope.list_header = [];
	$scope.map_list_contents = {};
	$scope.map_list_header_contents = {};



	$scope.list_contents=response.data.list_contents;
	$scope.list_header_contents=response.data.list_header_contents;

	$.each(response.data.list_contents, function(key,value) {
			//if(Number(version) > Number(value.version)) return;
			console.log(value.site,value.pwd_uid);
			$scope.map_list_contents[value.pwd_uid]=value

	});

	$.each(response.data.list_header_contents, function(key,value) {
			//if(Number(version) > Number(value.version)) return;
			console.log(value.title);
			$scope.list_header.push(value.title);
			$scope.map_list_header_contents[value.phd_uid]= value;

	});

	console.log($scope.list_header);

	console.log($scope.map_list_contents);


}

function mainController($scope, $window,$http) {
 console.log('myApp');


 $scope.page_state = $window.page_state
 $scope.user_id = $window.user_id
 $scope.user_name = $window.user_name
 $scope.discription = '';
$scope.list_header = [];
$scope.map_list_contents = {};
$scope.map_list_header_contents = {};

 $scope.showPwdForm = false;
 $scope.showHeaderForm = false;
$scope.shwoLoginForm = false;
$scope.showlist = false ;

 $scope.msg = "";
 $scope.warning = "";
 $scope.contents_title = "Insert New CONTENTS:";
$scope.check_save = false;


 //console.log($scope.shwoContents);
$scope.bodyInit= function() {

  console.log('bodyInit',$scope.page_state);
  if($scope.page_state != 'OK'){
    $scope.shwoLoginForm = true;

    switch ($scope.page_state) {
      case 'LOGIN_TIME_OUT':
        $scope.warning = '세션 시간 초과';

        break;
      case 'NOT_LOGIN':
      $scope.discription = '로그인 필요 ';
        break;
      default:

    }


    return;
  }
	$scope.discription = `${$scope.user_name} (${$scope.user_id})님 반갑습니다.`;




  $http.post('showlist.php', $.param({option:'all'}) ,{ headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}})
  //$http.get("/giant_auth/admin?cmd=MODIFY_MASTERKEY_CHIP&sn="+$scope.sn+"&msk_uid="+msk_uid)
    .then(function (response) {
      console.log('get_contents');
      console.log(response.data);


			update_from_showlist($scope,response);

		// 	$scope.list_contents=response.data.list_contents;
		// 	$scope.list_header_contents=response.data.list_header_contents;
		//
		// 	$.each($scope.list_header_contents, function(key,value) {
		// //if(Number(version) > Number(value.version)) return;
		// console.log(value.title);
		// $scope.list_header.push(value.title);

		// });
		console.log($scope.list_header);




      // var map_contents= response.data;
      // if(map_contents.length == 0) return false;
      //
      //
      // $scope.title = map_contents[0].title;
      // $scope.issue=map_contents[0].issue;
      // $scope.solution=map_contents[0].solution;
      // $scope.shwoContents = true;
      // $scope.showlist = false;


    },function errorCallback(response) {
      $scope.warning = response.status;
    }
  );




}


$scope.editContents= function(uid) {
	console.log('editContents',uid);
	console.log($scope.map_list_contents);

	var contents = $scope.map_list_contents[uid];
	console.log(contents);
	$scope.shwoContents = true;
	$scope.check_save = true;
	$scope.pwd_uid = contents.pwd_uid;
	$scope.site = contents.site;
	$scope.header = contents.title;
	$scope.ptail= contents.ptail;
	$scope.id= contents.id;
	$scope.etc = contents.etc;

};
$scope.test= function() {

  console.log('newcontents');

	$http.post('showlist.php', $.param({option:'find',keyword:'옥션'}) ,{ headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}})
	//$http.get("/giant_auth/admin?cmd=MODIFY_MASTERKEY_CHIP&sn="+$scope.sn+"&msk_uid="+msk_uid)
		.then(function (response) {
			console.log('get_contents');
			console.log(response.data);
			update_from_showlist($scope,response);

			//$scope.list_contents=response.data.list_contents;

			// var map_contents= response.data;
			// if(map_contents.length == 0) return false;
			//
			//
			// $scope.title = map_contents[0].title;
			// $scope.issue=map_contents[0].issue;
			// $scope.solution=map_contents[0].solution;
			// $scope.shwoContents = true;
			// $scope.showlist = false;


		},function errorCallback(response) {
			$scope.warning = response.status;
		}
	);


}
$scope.newcontents= function() {

  console.log('newcontents');
  $scope.shwoContents = true;
  $scope.check_save = true;
  $scope.uid = '';
  $scope.title = '';
  $scope.issue= '';
  $scope.solution= '';
  $scope.showlist = false;



}
$scope.find= function() {

  console.log('search');

	$http.post('showlist.php', $.param({option:'find',keyword:$scope.keyword}) ,{ headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}})
	//$http.get("/giant_auth/admin?cmd=MODIFY_MASTERKEY_CHIP&sn="+$scope.sn+"&msk_uid="+msk_uid)
		.then(function (response) {
			console.log('showlist find');
			console.log(response.data);
			update_from_showlist($scope,response);

			//$scope.list_contents=response.data.list_contents;


		},function errorCallback(response) {
			$scope.warning = response.status;
		}
	);


}

$scope.toggle= function(id) {
  console.log('toggle',id);


  switch(id) {
    case 'toggle_input':
    console.log('1');
      $scope.shwoContents = !$scope.shwoContents;

        break;
    case 'toggle_list':
        console.log('2');
        $scope.showlist = !$scope.showlist;
        break;
    case 'toggle_all':
      console.log('3');
      if( $scope.shwoContents || $scope.showlist){
        $scope.shwoContents = false;
        $scope.showlist = false;

      }
      else{
        $scope.shwoContents = true;
        $scope.showlist = true;
      }

        break;
    default:

}

}



};
