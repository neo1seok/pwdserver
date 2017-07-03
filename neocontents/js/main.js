


function mainController($scope, $window) {
 console.log('myApp');
 console.log('chipInit',$window.list_contents);;
 $scope.list_contents = $window.list_contents
$scope.bodyInit= function() {



}
$scope.get_contents= function(tdc_uid) {

console.log('get_contents',tdc_uid);

}
$scope.modify= function(tdc_uid) {

console.log('modify',tdc_uid);



}
$scope.delete= function(tdc_uid) {

console.log('delete',tdc_uid);

}

};



function map_click(){
  //
  // $('#toggle_contents').click(function(){
  //   console.log('toggle_today');
  //
  //   $('#div_contents').toggle();
  //
  // });
  // $('#toggle_list').click(function(){
  //   console.log('toggle_all');
  //
  //   $('#div_all').toggle();
  //
  //
  //
  // });
  // $('#toggle_input').click(function(){
  //   console.log('toggle_all');
  //
  //   $('#div_input').toggle();
  //
  //
  //
  // });

  $('.cla_show').click(function(){
    var id =this.id;
    console.log('click cla_show',id);
    var url = `dbupdate.php?option=get_contents&id=${id}`;
    //var url = ``;
    console.log(url);
    $.ajax({
    type: 'post',
    dataType: 'json',
    url: 'dbupdate.php',
    data: {option:'get_contents', id:id},
    success: function (data) {
        console.log(data);
        console.log(data.length);
        var map_contents= data;
        if(map_contents.length == 0) return false;

        var issue = map_contents[0].issue.replace(/(?:\r\n|\r|\n)/g, '<br />');
        var solution = map_contents[0].solution.replace(/(?:\r\n|\r|\n)/g, '<br />');

        console.log(map_contents[0].title);
        $('#p_title').text(map_contents[0].title);
        $('#p_issue').html(issue);
        $('#p_solution').html(solution);

        $('#div_contents').show();
        $('#div_input').hide();
        $(location).attr('href', '#div_contents')
    },
    error: function (request, status, error) {
        console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
    }
});

    // $.get( url, function( data ) {
    //   console.log('input result');
    //   console.log(data);
    //   var map_contents = JSON.parse(convert_to_safe_json_string(data));
    //   console.log('input END');
    //   if(map_contents.length == 0) return false;
    //   console.log(map_contents[0].title);
    //   $('#p_title').text(map_contents[0].title);
    //   $('#p_issue').text(map_contents[0].issue);
    //   $('#p_solution').text(map_contents[0].solution);
    //
    //   $('#div_contents').show();
    //   $('#div_input').hide();
    //   //$('#div_contents').show();
    //
    //  });

  });
  $('.cla_del').click(function(){
    var id = this.id;
    console.log('click cla_del',id);
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
          //
          // console.log(map_contents[0].title);
          // $('#inputTitle').val(map_contents[0].title);
          // $('#inputIssue').val(map_contents[0].issue);
          // $('#inputSolution').val(map_contents[0].solution);
          // $('#inputId').val(map_contents[0].tdc_uid);
          //
          // $('#div_contents').hide();
          //  $('#div_input').show();
          //  $(location).attr('href', '#div_input')
      },
      error: function (request, status, error) {
          console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
      }
    });




    // $.get( `dbupdate.php?option=delete&id=${id}`, function( data ) {
    //   console.log('input result');
    //   console.log(data);
    //   console.log('input END');
    //   if( convert_to_safe_json_string(data) == 'OK'){
    //     location.reload();
    //     console.log('location.reload');
    //
    //   }
    //
    //  });

  });
  $('.cla_modify').click(function(){
    var id = this.id;
    console.log('click cla_modify',id);
    var url = `dbupdate.php?option=get_contents&id=${id}`;
    //var url = ``;
    //var url = ``;
    console.log(url);
    $.ajax({
      type: 'post',
      dataType: 'json',
      url: 'dbupdate.php',
      data: {option:'get_contents', id:id},
      success: function (data) {
          console.log(data);
          console.log(data.length);
          var map_contents= data;
          if(map_contents.length == 0) return false;

          console.log(map_contents[0].title);
          $('#inputTitle').val(map_contents[0].title);
          $('#inputIssue').val(map_contents[0].issue);
          $('#inputSolution').val(map_contents[0].solution);
          $('#inputId').val(map_contents[0].tdc_uid);

          $('#div_contents').hide();
           $('#div_input').show();
           $(location).attr('href', '#div_input')
      },
      error: function (request, status, error) {
          console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
      }
    });

    //
    // $.get( url, function( data ) {
    //   console.log('input result');
    //   console.log(data);
    //   var map_contents = JSON.parse(convert_to_safe_json_string(data));
    //   console.log('input END');
    //   if(map_contents.length == 0) return false;
    //   console.log(map_contents[0].title);
    //
    //
    //   $('#inputTitle').val(map_contents[0].title);
    //   $('#inputIssue').val(map_contents[0].issue);
    //   $('#inputSolution').val(map_contents[0].solution);
    //   $('#inputId').val(map_contents[0].tdc_uid);
    //
    //   $('#div_contents').hide();
    //   $('#div_input').show();
    //
    //
    //
    //  });

  });
  $('#input_new').click(function(){
    console.log('click input_new');
    $('#inputTitle').val("");
    $('#inputIssue').val("");
    $('#inputSolution').val("");
    $('#inputId').val("");

    $('#div_contents').hide();
    $('#div_input').show();

  });


  $('#btnInput').click(function(){

    var inputTitle = $('#inputTitle').val();
    var inputIssue = $('#inputIssue').val();
    var inputSolution = $('#inputSolution').val();
    var inputId =$('#inputId').val();

    if( inputTitle == '' ){
      alert('값을 입력해 주세요');
      return;
    }

    var map_contents ={
      Title:inputTitle,
      Issue:inputIssue,
      Solution:inputSolution,
    }
    var json_contents = JSON.stringify(map_contents)

  //				JSON.stringify(map_contents);



    var b64_contents = utf8_to_b64( json_contents );
    console.log(json_contents);
    console.log(inputTitle,inputIssue,inputSolution);
    console.log(b64_contents);

    //alert('값을 입력해 주세요');
  //	return;
   var url = `dbupdate.php?option=input&contents=${b64_contents}`;
    if(inputId !="" ){
        url = `dbupdate.php?option=modify&id=${inputId}&contents=${b64_contents}`;
    }
    var option = "input";
    if(inputId !="" ){
      var option = "modify";
    }
    console.log(option);
    if(!confirm('입력 하시겠습니까?')) return false;

    $.ajax({
      type: 'post',
      dataType: 'json',
      url: 'dbupdate.php',
      data: {option:option, contents:json_contents,id:inputId},
      success: function (data) {
          console.log(data);
          console.log(data.length);
          var result= data;
          if(result.RESULT != 'OK') {
            return false;
          }

          location.reload();
          console.log('location.reload');
          //
          // console.log(map_contents[0].title);
          // $('#inputTitle').val(map_contents[0].title);
          // $('#inputIssue').val(map_contents[0].issue);
          // $('#inputSolution').val(map_contents[0].solution);
          // $('#inputId').val(map_contents[0].tdc_uid);
          //
          // $('#div_contents').hide();
          //  $('#div_input').show();
          //  $(location).attr('href', '#div_input')
      },
      error: function (request, status, error) {
          console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
      }
    });




    //
    // //var url = ``;
    //
    // $.get( url, function( data ) {
    //   console.log('input result');
    //   console.log(data);
    //   console.log('input END');
    //   if( convert_to_safe_json_string(data) == 'OK'){
    //     location.reload();
    //     console.log('location.reload');
    //
    //   }
    //
    //  });

     return false; //<- 이 문장으로 새로고침(reload)이 방지됨




  });


}
