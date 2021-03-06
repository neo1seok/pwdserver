function convert_to_safe_json_string(str) {
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
  s = s.replace(/[\u0000-\u0019]+/g, "");
  s = s.replace(/[\ufeff]*/gi, "");
  return s;
}

function toHex(str) {
  var result = '';
  for (var i = 0; i < str.length; i++) {
    result += str.charCodeAt(i).toString(16);
  }

  return result.toUpperCase();
}

function hex2a(hexx) {
  var hex = hexx.toString(); //force conversion
  var str = '';
  for (var i = 0; i < hex.length; i += 2)
    str += String.fromCharCode(parseInt(hex.substr(i, 2), 16));
  return str;
}

function test() {
  var ret = 'test';
  return ret;
}

function go_login_form(page_states,windows,returl_url){
  console.log('go_login_form');
  console.log('go_login_form cookie='+document.cookie);
  if(page_states == "OK") return;
  console.log(windows);

  setCookie('returl_url',returl_url,1);
  //alert('go_login_form cookie='+document.cookie);
  //alert('returl_url cookie='+getCookie('returl_url'));
  window.location = "/comm/loginform.html";

}
function get_navigation(navinfo) {


  var linkarray = '';
  navinfo.Links.forEach(function(value, index, ar) {


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

function get_container(container_info) {
  var linkarray = '';
  container_info.Links.forEach(function(value, index, ar) {
    var attrb = "";
    var isattr = "Id" in value
    if (isattr) {
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

function setup_nav(sel_nav, sel_cont, map_container, active_sel_id) {
  var navinfo = {
    Title: {
      Name: "neo1seok main",
      Link: "/"
    },
    Links: [
      // {
      //   Name: "MAIN",
      //   Link: "/",
      //   Id: "nav_main"
      // },
      {
        Name: "WEBTOON",
        Link: "/webtoon/",
        Id: "nav_webtoon"
      },
      {
        Name: "오늘의 정보",
        Link: "/neocontents/",
        Id: "nav_contents"
      },
      {
        Name: "FAV LINK",
        Link: "/fav_link/",
        Id: "nav_fav_link"
      },
      {
        Name: "개인 PW정보(로그인필요)",
        Link:"/pwdserver/",
        Id: "nav_pwd"
      },

      {
        Name: "FAV LINK(개인링크)",
        Link: "/fav_link/main.php?option=priv_link",
        Id: "nav_fav_link_priv"
      },
      {
        Name: "개인 PW정보 예전방식(로그인필요)",
        Link: "/pwdserver_old/",
        Id: "nav_pwd_old"
      },
      {
        Name: "LOG_IN",
        Link: "/comm/loginform.html",
        Id: ""
      },
      {
        Name: "LOG_OUT",
        Link: "/comm/log_out.html",
        Id: ""
      },


      // { Name: "MAIN", Link: window.location.origin +"/" },
      //   { Name: "WEBTOON", Link: window.location.origin +"/webtoon/" },
      //     { Name: "개인 PW정보", Link: window.location.origin +"/pwdserver/" },

    ]
  };


  $(sel_nav).append(get_navigation(navinfo));
  $(sel_cont).append(get_container(map_container));

  $(active_sel_id).addClass("active");


}

function map_toggle_click(toggle_list_map) {
  toggle_list_map.forEach(function(value, index, ar) {
    $(value.Btn).click(function() {
      console.log('toggle', value.Btn);
      $(value.Div).toggle();

    });

  });
}

function all_toggle_click(btn, toggle_list_map) {
  $(btn).click(function() {
    console.log('all_toggle_click');
    var isShowOne = false;
    console.log(isShowOne);
    toggle_list_map.forEach(function(value, index, ar) {
      if ($(value.Div).is(":visible")) {
        isShowOne = true;
        return;
      }
      //#$(value.Div).toggle();
    });
    console.log(isShowOne);

    if (isShowOne) {
      funct = function(div) {
        console.log(div, 'hide');
        $(div).hide();
      }
    } else {
      funct = function(div) {
        console.log(div, 'show');
        $(div).show();

      }

    }
    toggle_list_map.forEach(function(value, index, ar) {
      console.log(value.Div);
      funct(value.Div);
    });


  });


}


function make_map_from_list(list_contents, key_name) {

  var ret_map = {};
  $.each(list_contents, function(key, value) {
    //if(Number(version) > Number(value.version)) return;
    //console.log(value.site,value.pwd_uid);
    //console.log(value);
    ret_map[value[key_name]] = value

  });
  return ret_map;
}

function setCookie(cname, cvalue, exdays) {

  var d = new Date();

  d.setDate(d.getDate() + exdays); //1일 뒤 이 시간

  var expires = "expires=" + d.toGMTString();

  //console.log('expires',expires);

  document.cookie = cname + "=" + cvalue + "; " + expires+"; path=/";

}

// 쿠키명 (cname), 쿠키 값(cvalue), 쿠키 만료 날짜(exdays)





function getCookie(cname) {

  var name = cname + "=";

  var ca = document.cookie.split(';');

  for (var i = 0; i < ca.length; i++) {

    var c = ca[i];

    while (c.charAt(0) == ' ') c = c.substring(1);

    if (c.indexOf(name) == 0) return c.substring(name.length, c.length);

  }

  return "";

}
