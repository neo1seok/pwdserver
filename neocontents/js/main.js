



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
    $.get( url, function( data ) {
      console.log('input result');
      console.log(data);
      var map_contents = JSON.parse(convert_to_safe_json_string(data));
      console.log('input END');
      if(map_contents.length == 0) return false;
      console.log(map_contents[0].title);
      $('#p_title').text(map_contents[0].title);
      $('#p_issue').text(map_contents[0].issue);
      $('#p_solution').text(map_contents[0].solution);

      $('#div_contents').show();
      $('#div_input').hide();
      //$('#div_contents').show();

     });
  });
  $('.cla_del').click(function(){
    var id = this.id;
    console.log('click cla_del',id);
    if(!confirm('정말로 삭제하시겠습니까?')) return false;

    $.get( `dbupdate.php?option=delete&id=${id}`, function( data ) {
      console.log('input result');
      console.log(data);
      console.log('input END');
      if( convert_to_safe_json_string(data) == 'OK'){
        location.reload();
        console.log('location.reload');

      }

     });

  });
  $('.cla_modify').click(function(){
    var id = this.id;
    console.log('click cla_modify',id);
    var url = `dbupdate.php?option=get_contents&id=${id}`;
    //var url = ``;
    //var url = ``;
    console.log(url);
    $.get( url, function( data ) {
      console.log('input result');
      console.log(data);
      var map_contents = JSON.parse(convert_to_safe_json_string(data));
      console.log('input END');
      if(map_contents.length == 0) return false;
      console.log(map_contents[0].title);


      $('#inputTitle').val(map_contents[0].title);
      $('#inputIssue').val(map_contents[0].issue);
      $('#inputSolution').val(map_contents[0].solution);
      $('#inputId').val(map_contents[0].tdc_uid);

      $('#div_contents').hide();
      $('#div_input').show();



     });

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



    //var url = ``;
    console.log(url);
    if(!confirm('입력 하시겠습니까?')) return false;
    $.get( url, function( data ) {
      console.log('input result');
      console.log(data);
      console.log('input END');
      if( convert_to_safe_json_string(data) == 'OK'){
        location.reload();
        console.log('location.reload');

      }

     });
     return false; //<- 이 문장으로 새로고침(reload)이 방지됨




  });


}
