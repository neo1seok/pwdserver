function update_from_showlist($scope, response) {

  $scope.list_header = [];
  $scope.map_list_contents = {};
  $scope.map_list_header_contents = {};



  $scope.list_contents = response.data.list_contents;
  $scope.list_header_contents = response.data.list_header_contents;

  $.each(response.data.list_contents, function(key, value) {
    //if(Number(version) > Number(value.version)) return;
    console.log(value.site, value.pwd_uid);
    $scope.map_list_contents[value.pwd_uid] = value

  });

  $.each(response.data.list_header_contents, function(key, value) {
    //if(Number(version) > Number(value.version)) return;
    console.log(value.title);
    $scope.list_header.push(value.title);
    $scope.map_list_header_contents[value.phd_uid] = value;

  });

  console.log($scope.list_header);

  console.log($scope.map_list_contents);


}


function mainController($scope, $window, $http) {
  console.log('myApp');


  $scope.page_state = $window.page_state
  $scope.user_id = $window.user_id
  $scope.user_name = $window.user_name
  $scope.discription = '';
  $scope.list_header = [];
  $scope.map_list_contents = {};
  $scope.map_list_header_contents = {};


  $scope.showlist = false;
  $scope.showPwdForm = false;
  $scope.showHeaderForm = false;


  $scope.msg = "";
  $scope.warning = "";
  $scope.contents_title = "사이트입력:";
  $scope.contents_header_title = "헤더입력:";
  $scope.check_save = false;


  //console.log($scope.shwoContents);
  $scope.bodyInit = function() {

    console.log('bodyInit', $scope.page_state);
    if ($scope.page_state != 'OK') {
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




    $http.post('showlist.php', $.param({
        option: 'all'
      }), {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
      })
      //$http.get("/giant_auth/admin?cmd=MODIFY_MASTERKEY_CHIP&sn="+$scope.sn+"&msk_uid="+msk_uid)
      .then(function(response) {
        console.log('get_contents');
        console.log(response.data);


        update_from_showlist($scope, response);

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


      }, function errorCallback(response) {
        $scope.warning = response.status;
      });




  }


  $scope.editContents = function(uid) {
    console.log('editContents', uid);
    console.log($scope.map_list_contents);
    var contents = {
      pwd_uid: '',
      site: '',
      title: '',
      ptail: '',
      id: '',
      etc: '',

    }
    if (uid != '') {
      contents = $scope.map_list_contents[uid];
      $scope.check_save = false;



    } else {
      $scope.check_save = true;
    }

    $scope.showlist = false;
    $scope.showPwdForm = false;
    $scope.showHeaderForm = false;



    console.log(contents);
    //$scope.check_save = true;
    $scope.pwd_uid = contents.pwd_uid;
    $scope.site = contents.site;
    $scope.header = contents.title;
    $scope.ptail = contents.ptail;
    $scope.id = contents.id;
    $scope.etc = contents.etc;
    $scope.showPwdForm = true;
    $scope.showlist = false;

  };

  $scope.editheader = function(uid) {

    console.log('editheader');
    var header_info = {
      phd_uid: '',
      title: '',
      hint: '',
      special_letter: '',
    }

    if (uid != '') {
      header_info = $scope.map_list_header_contents[uid]
      $scope.check_save_header = false;
    } else {
      $scope.check_save_header = true;
    }


    $scope.showlist = false;
    $scope.showPwdForm = false;
    $scope.showHeaderForm = false;


    $scope.phd_uid = header_info.phd_uid;
    $scope.title = header_info.title;
    $scope.hint = header_info.hint;
    $scope.special_letter = header_info.special_letter;



    $scope.showHeaderForm = true;
    $scope.check_save = true;



    $scope.showlist = false;



  }
  $scope.test = function() {

    console.log('newcontents');

    $http.post('showlist.php', $.param({
        option: 'find',
        keyword: '옥션'
      }), {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
      })
      //$http.get("/giant_auth/admin?cmd=MODIFY_MASTERKEY_CHIP&sn="+$scope.sn+"&msk_uid="+msk_uid)
      .then(function(response) {
        console.log('get_contents');
        console.log(response.data);
        update_from_showlist($scope, response);

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


      }, function errorCallback(response) {
        $scope.warning = response.status;
      });


  }

  $scope.update = function() {

    console.log('update');

    var option = 'insert';

    console.log($scope.pwd_uid, $scope.site,
      $scope.ptail, $scope.id, $scope.etc, $scope.header);

    console.log($scope.header);

    console.log('newcontents');
    $scope.showPwdForm = true;
    $scope.check_save = true;
    $scope.showlist = false;

    param = {
      pwd_uid: $scope.pwd_uid,
      site: $scope.site,
      ptail: $scope.ptail,
      id: $scope.id,
      etc: $scope.etc,
      phd_uid: $scope.header.phd_uid,
    }
    if(!confirm('PWD정보 업데이트를 하시겠습니까?')) return false;

    $http.post('update_site.php', $.param(param), {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
      })
      //$http.get("/giant_auth/admin?cmd=MODIFY_MASTERKEY_CHIP&sn="+$scope.sn+"&msk_uid="+msk_uid)
      .then(function(response) {
        console.log('update_header');
        console.log(response.data);
        console.log(response.data.result);
        if(response.data.result == "ok"){
          location.reload();

        }
        else{
          $scope.warning = response.data.error;
        }




      }, function errorCallback(response) {
        $scope.warning = response.status;
      });





  }
  $scope.update_header = function() {

    console.log('update_header');

    if(!confirm('헤더 업데이트를 하시겠습니까?')) return false;

    var option = 'insert';

    console.log($scope.pwd_uid, $scope.site,
      $scope.ptail, $scope.id, $scope.etc, $scope.header);

    console.log($scope.header);

    console.log('newcontents');
    $scope.showPwdForm = true;
    $scope.check_save = true;
    $scope.showlist = false;

    param = {
      phd_uid: $scope.phd_uid,
      title: $scope.title,
      hint: $scope.hint,
      special_letter: $scope.special_letter,
    }

    $http.post('update_header.php', $.param(param), {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
      })
      //$http.get("/giant_auth/admin?cmd=MODIFY_MASTERKEY_CHIP&sn="+$scope.sn+"&msk_uid="+msk_uid)
      .then(function(response) {
        console.log('update_header');
        console.log(response.data);
        if(response.data.result == "ok"){
          location.reload();

        }
        else{
          $scope.warning = response.data.error;
        }





      }, function errorCallback(response) {
        $scope.warning = response.status;
      });





  }
  $scope.find = function() {

    console.log('search');

    if(!confirm('검색 하시겠습니까?')) return false;

    $http.post('showlist.php', $.param({
        option: 'find',
        keyword: $scope.keyword
      }), {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
      })
      //$http.get("/giant_auth/admin?cmd=MODIFY_MASTERKEY_CHIP&sn="+$scope.sn+"&msk_uid="+msk_uid)
      .then(function(response) {
        console.log('showlist find');
        console.log(response.data);
        update_from_showlist($scope, response);

        $scope.showlist = false;
        $scope.showPwdForm = false;
        $scope.showHeaderForm = false;

        $scope.showlist = true;

        //$scope.list_contents=response.data.list_contents;


      }, function errorCallback(response) {
        $scope.warning = response.status;
      });


  }

  $scope.all_update = function() {

    location.reload();

  }

  $scope.toggle = function(id) {
    console.log('toggle', id);


    switch (id) {
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
        if ($scope.shwoContents || $scope.showlist) {
          $scope.shwoContents = false;
          $scope.showlist = false;

        } else {
          $scope.shwoContents = true;
          $scope.showlist = true;
        }

        break;
      default:

    }

  }



};
