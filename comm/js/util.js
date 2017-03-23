

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
function get_navigation(){

var ret = `  <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div id="main_menu">
            <a class="navbar-brand" href="${window.location.origin}/" >MAIN</a>
            <a class="navbar-brand" href="${window.location.origin}/webtoon/" >WEBTOON</a>
            <a class="navbar-brand" href="${window.location.origin}/pwdserver/" >개인 PW정보</a>
            </div>
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
function setup_nav(sel){

  var movies = [
  { Name: "MAIN", Link: "${window.location.origin}/" },
  { Name: "WEBTOON", Link: "${window.location.origin}/webtoon/" },
  { Name: "개인 PW정보", Link: "${window.location.origin}/pwdserver/" }
  ];

  var markup = "<a class=\"navbar-brand\" href=\"${Link}/\" >${Name}</a>";






    $(sel).append(get_navigation());

    /* Compile the markup as a named template */
  	$.template( "movieTemplate", markup );
    console.log($.tmpl( "movieTemplate", movies ));


    /* Render the template with the movies data and insert
  	   the rendered HTML under the "movieList" element */
  	$.tmpl( "movieTemplate", movies )
  	  .appendTo( "#main_menu" );

}
