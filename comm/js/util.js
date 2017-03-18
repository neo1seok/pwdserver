

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
