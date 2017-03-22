

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
function get_navigation(links){


  var linkarray = '';
  links.forEach(function (value, index, ar) {


      linkarray += `<a class="navbar-brand" href="${value.Link}" >${value.Name}</a>\n`;
  });
//  console.log(linkarray);

var ret = `  <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div id ="nav_Link">${linkarray}</div>
                </div>
          <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
            <form class="navbar-form navbar-right">
              <div class="form-group">
                <input type="text" placeholder="Email" class="form-control">
              </div>
              <div class="form-group">
                <input type="password" placeholder="Password" class="form-control">
              </div>
              <button type="submit" class="btn btn-success">Sign in</button>
            </form>
          </div><!--/.navbar-collapse -->
        </div>
      </nav>`;
      return ret;
}
function get_container(container_info){
  var linkarray = '';
  container_info.Links.forEach(function (value, index, ar) {
    var attrb= "";
    var isattr = "Attrib" in value
    if (isattr){
        attrb = value.Attrb;
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
function setup_nav(sel_nav,sel_cont,map_container){
  var links = [
  { Name: "MAIN", Link: window.location.origin +"/" },
    { Name: "WEBTOON", Link: window.location.origin +"/webtoon/" },
      { Name: "개인 PW정보", Link: window.location.origin +"/pwdserver/" },

  ];


  $(sel_nav).append(get_navigation(links));
  $(sel_cont).append(get_container(map_container));


}
