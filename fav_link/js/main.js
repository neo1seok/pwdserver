


function mainController($scope, $window,$http) {
 console.log('myApp');
 // console.log('chipInit',$window.list_contents);;
 // $scope.list_contents = $window.list_contents
 $scope.shwoContents = false;
 $scope.warning = "";
 $scope.msg = "";
 $scope.contents_title = "Insert New CONTENTS:";
$scope.check_save = false;
$scope.showlist = true ;
$scope.option =document.option;
console.log(document.option);
 console.log($scope.list_contents);
$scope.bodyInit= function() {



  $http.post('dbupdate.php', $.param({option:'get_contents'}) ,{ headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}})
  //$http.get("/giant_auth/admin?cmd=MODIFY_MASTERKEY_CHIP&sn="+$scope.sn+"&msk_uid="+msk_uid)
    .then(function (response) {
      console.log('get_contents');
      console.log(response.data);

      $scope.list_contents = response.data.list_contents;
      $scope.map_list_contents = make_map_from_list(response.data.list_contents,"fnk_uid");
      console.log($scope.map_list_contents);




    },function errorCallback(response) {
      $scope.warning = response.status;
    }
  );



}
$scope.editContents= function(fnk_uid) {

console.log('get_contents 23',fnk_uid);
$scope.uid = fnk_uid;
$scope.contents_title = "UPDATE CONTENTS:";
  var map_contents= $scope.map_list_contents[fnk_uid];
  console.log(map_contents);


    $scope.title = map_contents.title;
    $scope.link=map_contents.link;
    $scope.shwoContents = true;
    $scope.showlist = false;



}



$scope.editable= function(fnk_uid) {
  console.log('editable',$scope.check_save);
//  $scope.edit = $scope.check_save;

}
$scope.delete= function(fnk_uid) {

console.log('delete',fnk_uid);



var id = fnk_uid;

if(!confirm('정말로 삭제하시겠습니까?')) return false;

$.ajax({
  type: 'post',
  dataType: 'json',
  url: 'dbupdate.php',
  data: {option:'delete',id:id},
  success: function (data) {
      console.log(data);
      console.log(data.length);
      var result= data;
      if(result.RESULT != 'OK') {
        return false;
      }

      location.reload();
      console.log('location.reload');

  },
  error: function (request, status, error) {
      console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
  }
});

}

$scope.newcontents= function() {

  console.log('newcontents');
  $scope.shwoContents = true;
  $scope.check_save = true;
  $scope.uid = '';
  $scope.title = '';
  $scope.link= '';

  $scope.showlist = false;
  $scope.contents_title = "Insert New CONTENTS:";



}
$scope.test= function() {

  console.log('newcontents');
  $scope.shwoContents = true;
  $scope.check_save = true;
  $scope.uid = '';
  $scope.title = 'aaaaaaaaaa2';
  $scope.issue= 'aaaaaaaaaaa \'aaaaaaaaaaaaaaa ';
  $scope.solution= '';
  $scope.showlist = false;



}

$scope.save= function(fnk_uid) {

  console.log('save');
  // $scope.shwoContents = true;
  // $scope.check_save = true;
  // $scope.uid = '';
  // $scope.title = '';
  // $scope.issue= '';
  // $scope.solution= '';
  //
  //

  var inputTitle = $scope.title;
  var inputLink = $scope.link;
  var inputId =fnk_uid;

  if( inputTitle == '' ){
    alert('값을 입력해 주세요');
    return;
  }

  var map_contents ={
    Title:inputTitle,
    Link:inputLink,

  }
  var json_contents = JSON.stringify(map_contents)

  console.log(json_contents);

  var option = "input";
  if(inputId !="" ){
    var option = "modify";
  }
  console.log(option);
  if(!confirm('입력 하시겠습니까?')) return false;


  $http.post('dbupdate.php', $.param({option:option, contents:json_contents,id:inputId}) ,{ headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}})
  //$http.get("/giant_auth/admin?cmd=MODIFY_MASTERKEY_CHIP&sn="+$scope.sn+"&msk_uid="+msk_uid)
    .then(function (response) {
      console.log('save result');
      console.log(response.data);
      console.log(response.data.length);
      var result= response.data;
      if(result.RESULT != 'OK') {
        return false;
      }

      location.reload();
      console.log('location.reload');


    },function errorCallback(response) {
      console.log('response',response);
      $scope.warning = response;
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
