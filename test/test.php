<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">

<?php
<<<<<<< HEAD
//phpinfo();
echo $_SERVER['HTTP_HOST'];

$indicesServer = array('PHP_SELF',
		'argv',
		'argc',
		'GATEWAY_INTERFACE',
		'SERVER_ADDR',
		'SERVER_NAME',
		'SERVER_SOFTWARE',
		'SERVER_PROTOCOL',
		'REQUEST_METHOD',
		'REQUEST_TIME',
		'REQUEST_TIME_FLOAT',
		'QUERY_STRING',
		'DOCUMENT_ROOT',
		'HTTP_ACCEPT',
		'HTTP_ACCEPT_CHARSET',
		'HTTP_ACCEPT_ENCODING',
		'HTTP_ACCEPT_LANGUAGE',
		'HTTP_CONNECTION',
		'HTTP_HOST',
		'HTTP_REFERER',
		'HTTP_USER_AGENT',
		'HTTPS',
		'REMOTE_ADDR',
		'REMOTE_HOST',
		'REMOTE_PORT',
		'REMOTE_USER',
		'REDIRECT_REMOTE_USER',
		'SCRIPT_FILENAME',
		'SERVER_ADMIN',
		'SERVER_PORT',
		'SERVER_SIGNATURE',
		'PATH_TRANSLATED',
		'SCRIPT_NAME',
		'REQUEST_URI',
		'PHP_AUTH_DIGEST',
		'PHP_AUTH_USER',
		'PHP_AUTH_PW',
		'AUTH_TYPE',
		'PATH_INFO',
		'ORIG_PATH_INFO') ;

echo '<table cellpadding="10">' ;
foreach ($indicesServer as $arg) {
	if (isset($_SERVER[$arg])) {
		echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
=======
require_once("../comm/library.php");
$a = 1; /* global scope */

function test()
{
	global $_ENV;
	echo $_ENV["test"]; /* reference to local scope variable */
}

test();

exit();
class Sendmail {
	/* smtp 의 호스트 설정 : 아래는 gmail 일경우 */
	var $host="ssl://smtp.gmail.com";
	/* smtp 계정 아이디 입력 */
	var $smtp_id="example@gmail.com";
	/* smtp 계정 비밀번호 입력 */
	var $smtp_pw="password";

	/* 디버그모드 - 활성 :1, 비활성 : 0; */
	var $debug = 1;
	/* 문자 인코딩 종류 설정*/
	var $charset="UTF-8";
	/* 메일의 기본 타입을 설정 */
	var $ctype="text/plain";


	/* 아래 3개의 변수는 수정 금지 */
	var $fp;
	var $lastmsg;
	var $parts=array();


	/* 기본설정대신 초기화 할 값이 있다면 클래스 초기화시 배열로 값을넘겨준다. */
	function Sendmail($data=false) {

		if($data!=false)
		{
			if(is_array($data)){
				/* 각각 배열의 정보는 기본설정 변수명과 같으니 그곳을 참고하길 바란다 */
				$this->host = !empty($data['host'])?$data['host']:$this->host;
				$this->smtp_id = !empty($data['smtp_id'])?$data['smtp_id']:$this->smtp_id;
				$this->smtp_pw = !empty($data['smtp_pw'])?$data['smtp_pw']:$this->smtp_pw;
				$this->debug = !empty($data['debug'])?$data['debug']:$this->debug;
				$this->charset = !empty($data['charset'])?$data['charset']:$this->charset;
				$this->ctype = !empty($data['ctype'])?$data['ctype']:$this->ctype;
			}
		}
	}

	/*  smtp 통신을 한다. */
	function dialogue($code, $cmd) {
		fputs($this->fp, $cmd."\r\n");
		$line = fgets($this->fp, 1024);
		preg_match("/^([0-9]+).(.*)$/", $line, $matches);
		$this->lastmsg = $matches[0];
		if($this->debug) {
			echo htmlspecialchars($cmd)."
".$this->lastmsg."
";
			flush();
		}
		if($matches[1] != $code) return false;
		return true;
	}
	/*   smptp 서버에 접속을 한다. */
	function connect($host='') {
		if($this->debug) {
			echo "SMTP(".$host.") Connecting...";
			flush();
		}
		if(!$host) $host = $this->host;
		if(!$this->fp = fsockopen($host, 465, $errno, $errstr, 10)) {
			$this->lastmsg = "SMTP(".$host.") 서버접속에 실패했습니다.[".$errno.":".$errstr."]";
			return false;
		}
		$line = fgets($this->fp, 1024);
		preg_match("/^([0-9]+).(.*)$/", $line, $matches);
		$this->lastmsg = $matches[0];
		if($matches[1] != "220") return false;
		if($this->debug) {
			echo $this->lastmsg."
";
			flush();
		}
		$this->dialogue(250, "HELO phpmail");
		return true;
	}
	/*  stmp 서버와의 접속을 끊는다. */
	function close() {
		$this->dialogue(221, "QUIT");
		fclose($this->fp);
		return true;
	}
	/*  메시지를 보낸다. */
	function smtp_send($email, $from, $data,$cc_mail,$bcc_mail,$rel_to=false) {

		$id = $this->smtp_id;
		$pwd = $this->smtp_pw;


			
		/* 이메일 형식 검사 구간*/
		if(!$mail_from = $this->get_email($from)) return false;
		if(!$rcpt_to = $this->get_email($email)) return false;



		/* smtp  검사 구간 */
		if(!$this->dialogue(334, "AUTH LOGIN")) { return false; }
		if(!$this->dialogue(334, base64_encode($id)))  return false;
		if(!$this->dialogue(235, base64_encode($pwd)))  return false;
		if(!$this->dialogue(250, "MAIL FROM:".$mail_from)) return false;
		if(!$this->dialogue(250, "RCPT TO:".$rcpt_to)) {
			$this->dialogue(250, "RCPT TO:");
			$this->dialogue(354, "DATA");
			$this->dialogue(250, ".");
			return false;
		}

		if($rel_to==false){ $rel_to=$email;}


		$this->dialogue(354, "DATA");
		$mime = "Message-ID: <".$this->get_message_id().">\r\n";
		$mime .= "From: ".$from."\r\n";
		$mime .= "To: ".$rel_to."\r\n";
		 
		/* CC 메일 이 있을경우 */
		if($cc_mail!=false){

			$mime .= "Cc: ".$cc_mail. "\r\n";

		}
		/* BCC 메일 이 있을경우 */
		if($bcc_mail!=false) $mime .= "Bcc: ".$bcc_mail. "\r\n";



		fputs($this->fp, $mime);
		fputs($this->fp, $data);
		$this->dialogue(250, ".");




	}
	/* Message ID 를 얻는다. */
	function get_message_id() {
		$id = date("YmdHis",time());
		mt_srand((float) microtime() * 1000000);
		$randval = mt_rand();
		$id .= $randval."@phpmail";
		return $id;
	}
	/* Boundary 값을 얻는다. */
	function get_boundary() {
		$uniqchr = uniqid(time());
		$one = strtoupper($uniqchr[0]);
		$two = strtoupper(substr($uniqchr,0,8));
		$three = strtoupper(substr(strrev($uniqchr),0,8));
		return "----=_NextPart_000_000${one}_${two}.${three}";
}

/* 첨부파일이 있을 경우 이 함수를 이용해 파일을 첨부한다. */
function attach($path, $name="", $ctype="application/octet-stream") {
	if(is_file($path)) {
		$fp = fopen($path, "r");
		$message = fread($fp, filesize($path));
		fclose($fp);
		$this->parts[] = array ("ctype" => $ctype, "message" => $message, "name" => $name);

			
	} else return false;
}
/*  Multipart 메시지를 생성시킨다. */
function build_message($part) {
	$msg = "Content-Type: ".$part['ctype'];
	if($part['name']) $msg .= "; name=\"".$part['name']."\"";
	$msg .= "\r\nContent-Transfer-Encoding: base64\r\n";
	$msg .= "Content-Disposition: attachment; filename=\"".$part['name']."\"\r\n\r\n";
	$msg .= chunk_split(base64_encode($part['message']));
	return $msg;
}

/*  SMTP에 보낼 DATA를 생성시킨다. */
function build_data($subject, $body) {
	$boundary = $this->get_boundary();
	$attcnt = sizeof($this->parts);
	$mime= "Subject: ".$subject."\r\n";
	$mime .= "Date: ".date ("D, j M Y H:i:s T",time())."\r\n";
	$mime .= "MIME-Version: 1.0\r\n";
	if($attcnt > 0) {
		$mime .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"\r\n\r\n".
				"This is a multi-part message in MIME format.\r\n\r\n";
		$mime .= "--".$boundary."\r\n";
>>>>>>> 52e91995418d32a8bcf77d7123b6b9e431f1db8e
	}
	else {
		echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
	}
}
echo '</table>' ;
$baseroot =$_SERVER['DOCUMENT_ROOT'];
require_once("$baseroot/comm/library.php");
pnl();
require '../vendor/autoload.php';
if(!session_id()) {
	session_start();
}
$fb = new Facebook\Facebook([
		'app_id' => '180688449037103',
		'app_secret' => 'd99c9928a1e4c92d150d6ea249730def',
		'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes']; // optional
$loginUrl = $helper->getLoginUrl('http://neo1seok.iptime.org:8080/test/testcallback.php?option=aaa', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

echo "
		<div id='fb-root'></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = '//connect.facebook.net/ko_KR/sdk.js#xfbml=1&version=v2.7&appId=180688449037103';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
		
		<div class='fb-login-button' data-max-rows='1' data-size='xlarge' data-show-faces='false' data-auto-logout-link='false'></div>";

$a = 1; /* global scope */
$today = date('Y-m-d.H:m:s');     // 17:16:18 m is mon
echo $today;
pnl();
//phpinfo();
//test();
$to_time = strtotime($today);
usleep(1000000);
$from_time = strtotime(date('Y-m-d.H:m:s'));
echo $to_time - $from_time;

echo round(abs($to_time - $from_time) / 60,2). " minute";

exit();

?>	