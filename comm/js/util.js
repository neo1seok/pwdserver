

function convert_to_safe_json_string(str){
  var s = str;
  //console.log('convert_to_safe_json_string');

  //s = s.replace(String.fromCharCode(65279), "" );
  s = s.replace(/\\n/g, "\\n")
                 .replace(/\\'/g, "\\'")
                 .replace(/\\"/g, '\\"')
                 .replace(/\\&/g, "\\&")
                 .replace(/\\r/g, "\\r")
                 .replace(/\\t/g, "\\t")
                 .replace(/\\b/g, "\\b")
                 .replace(/\\f/g, "\\f");
  // remove non-printable and other non-valid JSON chars
  s = s.replace(/[\u0000-\u0019]+/g,"");
  s = s.replace(/[\ufeff]*/gi,"");
  return s;
}
function toHex(str) {
    var result = '';
    for (var i=0; i<str.length; i++) {
      result += str.charCodeAt(i).toString(16);
    }
    return result;
  }

function test(){
  var ret ='test';
  return ret;
}
function get_navigation(navinfo){


  var linkarray = '';
  navinfo.Links.forEach(function (value, index, ar) {


      linkarray += `<li id="${value.Id}"><a class="navbar-brand"  href="${value.Link}" >${value.Name}</a></li>\n`;
  });
  // navinfo.ActiveLinks.forEach(function (value, index, ar) {
  //
  //
  //     linkarrayActive += ` <li class="active"><a class="navbar-brand" href="${value.Link}" >${value.Name}</a></li>\n`;
  // });
//  console.log(linkarray);

// var ret = `  <nav class="navbar navbar-inverse navbar-fixed-top">
//         <div class="container">
//           <div class="navbar-header">
//             <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
//               <span class="sr-only">Toggle navigation</span>
//               <span class="icon-bar"></span>
//               <span class="icon-bar"></span>
//               <span class="icon-bar"></span>
//             </button>
//             <div id ="nav_Link">${linkarray}</div>
//                 </div>
//           <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
//             <form class="navbar-form navbar-right">
//               <div class="form-group">
//                 <input type="text" placeholder="Email" class="form-control">
//               </div>
//               <div class="form-group">
//                 <input type="password" placeholder="Password" class="form-control">
//               </div>
//               <button type="submit" class="btn btn-success">Sign in</button>
//             </form>
//           </div><!--/.navbar-collapse -->
//         </div>
//       </nav>`;
var ret_old =
      `
      <nav class="navbar navbar-inverse navbar-fixed-top">
       <div class="container-fluid">
         <div class="navbar-header">
           <a class="navbar-brand" href="${navinfo.Title.Link}">${navinfo.Title.Name}</a>
         </div>
         <ul class="nav navbar-nav">
         ${linkarray}
         </ul>
         <form class="navbar-form navbar-left">
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Search">
           </div>
           <button type="submit" class="btn btn-default">Submit</button>
         </form>
       </div>
     </nav>
      `;
var ret =
      `
      <nav class="navbar navbar-inverse">
       <div class="container-fluid">
         <div class="navbar-header">
           <a class="navbar-brand" href="${navinfo.Title.Link}">${navinfo.Title.Name}</a>
         </div>
         <ul class="nav navbar-nav">
         ${linkarray}
         </ul>

       </div>
     </nav>
      `;
      return ret;
}
function get_container(container_info){
  var linkarray = '';
  container_info.Links.forEach(function (value, index, ar) {
    var attrb= "";
    var isattr = "Id" in value
    if (isattr){
        attrb = `id = "${value.Id}"`;
          console.log("Attrb");
    }
    console.log(" ${attrb}");
      linkarray += `<a class="btn btn-info btn-lg" ${attrb} href="${value.Link}" >${value.Name}</a>\n`;
  });

  var ret = `    <div class="jumbotron">
          <div class="container">
          <br/>
            <h1>${container_info.Header}</h1>
            <p>${container_info.Discription}.</p>
            <p>${linkarray}</p>
          </div>
        </div>`;
        return ret;
}
function setup_nav(sel_nav,sel_cont,map_container,active_sel_id){
  var navinfo = {
    Title:{ Name: "neo1seok main", Link: window.location.origin +"/" },
  Links:[
    { Name: "MAIN", Link: window.location.origin +"/" ,Id:"nav_main"},
      { Name: "WEBTOON", Link: window.location.origin +"/webtoon/",Id:"nav_webtoon" },
      { Name: "오늘의 정보", Link: window.location.origin +"/neocontents/",Id:"nav_contents" },
      { Name: "개인 PW정보", Link: window.location.origin +"/pwdserver/",Id:"nav_pwd" },

      // { Name: "MAIN", Link: window.location.origin +"/" },
      //   { Name: "WEBTOON", Link: window.location.origin +"/webtoon/" },
      //     { Name: "개인 PW정보", Link: window.location.origin +"/pwdserver/" },

  ]};


  $(sel_nav).append(get_navigation(navinfo));
  $(sel_cont).append(get_container(map_container));

  $(active_sel_id).addClass( "active" );


}
function map_toggle_click(toggle_list_map) {
  toggle_list_map.forEach(function (value, index, ar) {
    $(value.Btn).click(function(){
      console.log('toggle',value.Btn);
        $(value.Div).toggle();

    });

  });
}
function all_toggle_click(btn,toggle_list_map) {
  $(btn).click(function(){
    console.log('all_toggle_click');
    var isShowOne = false;
    console.log(isShowOne);
    toggle_list_map.forEach(function (value, index, ar) {
      if($(value.Div).is(":visible")){
        isShowOne = true;
        return;
      }
      //#$(value.Div).toggle();
    });
    console.log(isShowOne);

    if(isShowOne){
      funct = function(div){
        console.log(div,'hide');
        $(div).hide();
      }
    }
    else{
      funct = function(div){
        console.log(div,'show');
        $(div).show();

      }

    }
    toggle_list_map.forEach(function (value, index, ar) {
      console.log(value.Div);
      funct(value.Div);
    });


  });


}
