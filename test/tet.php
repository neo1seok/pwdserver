﻿<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">

<?php
echo "query()함수를 이용한 테이블 생성 0008<br />";
// 24시간제
echo date("Y-m-d H:i:s") . "<br />\n";
$test = "FUCK";
include "sample.php";

exit;
function test($msg){
	echo "test";
	echo "<br/>\n";
	echo $msg;
	echo "<br/>\n";
}

test();
test("msg");

$user_id = 'VISIT';
$catagory = 'A';
$ret = strpos($user_id, 'VISIT');
echo "<br/>\n";
echo $ret;
echo "<br/>\n";
echo $catagory;
echo "<br/>\n";


if (0 === strpos($user_id, 'VISIT') && $catagory =='PWD') {
	echo 'test';
	exit;
}

exit;
phpinfo();
$output = shell_exec('dir');
echo "<pre>$output</pre>";

exit;



function viewQueryResult($dbname,$strQuery){

	//Connect DB
	$connect = @mysql_connect("localhost:3306","neo1seok","tofhdna1pi") or die("DB접속에러");

	//Select DB
	@mysql_select_db($dbname,$connect) or die("DB선택에러");

	//Print Query Result
	$result = @mysql_query($strQuery) or die("SQL error");

	// 테이블 시작
	echo "<table border>";

	// 머릿글 출력
	echo "<tr>";
	while($field=@mysql_fetch_field ($result)){
		echo "<th>";
		//print_r($field);
		echo $field->name;
		echo "</th>";
	}
	echo "</tr>";

	// 데이터 출력
	while($data=@mysql_fetch_row($result)){
		echo "<tr>";
		for($i=0;$i<(count($data));$i++){
			echo "<td>";
			echo $data[$i];
			echo "</td>";
		}
		echo "</tr>";
	}

	// 테이블 끝
	echo "</table>";
} 
function createTable(){
	
 
$host = 'localhost';
$user = 'ictk';
$pw = '#ictk1234';
$dbName = 'giant_nfc';
$mysqli = new mysqli($host, $user, $pw, $dbName);
 
$sql = "CREATE TABLE myclass_tb (";
$sql = $sql."id varchar(12) not null,";
$sql = $sql."name varchar(8) not null,";
$sql = $sql."sex char(2),";
$sql = $sql."age int,";
$sql = $sql."point int,";
$sql = $sql."address varchar(7),";
$sql = $sql."primary key(id));";
 
if($mysqli->query($sql)){
 echo '테이블 생성 완료';
}else{
 echo '테이블 생성 실패';
}
 
 
$sql = "insert into myclass_tb values";
$sql = $sql."('dooly', '둘리', '남', 10, 100, 'korea')";
if($mysqli->query($sql)){
 echo 'insert 완료';
}else{
 echo 'insert 실패';
}
 
 
$sql = "insert into myclass_tb values";
$sql = $sql."('asimo', '아시모', '남', 18, 200, 'honda')";
$mysqli->query($sql);
 
$sql = "insert into myclass_tb values";
$sql = $sql."('partner', '파트너', '남', 8, 180, 'toyota')";
$mysqli->query($sql);
 
$sql = "insert into myclass_tb values";
$sql = $sql."('hades', '하데스', '남', 45, 350, 'greece')";
$mysqli->query($sql);
 
$sql = "insert into myclass_tb values";
$sql = $sql."('lee', '이연희', '여', 20, 600, 'korea')";
$mysqli->query($sql);
	
	
}	

viewQueryResult("neo_pwinfo","SELECT site, B.title,ptail, id, A.etc
FROM neo_pwinfo.passwd A,neo_pwinfo.pheader B where A.phd_uid = B.phd_uid;");


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
	}
	$mime .= "Content-Type: ".$this->ctype."; charset=\"".$this->charset."\"\r\n".
			"Content-Transfer-Encoding: base64\r\n\r\n" . chunk_split(base64_encode($body));

	if($attcnt > 0) {
		$mime .= "\r\n\r\n--".$boundary;
		for($i=0; $i<$attcnt; $i++) {
			$mime .= "\r\n".$this->build_message($this->parts[$i])."\r\n\r\n--".$boundary;
		}
		$mime .= "--\r\n";
	}

	return $mime;
}
/* MX 값을 찾는다. */
function get_mx_server($email) {

	if(!preg_match("/([\._0-9a-zA-Z-]+)@([0-9a-zA-Z-]+\.[a-zA-Z\.]+)/", $email, $matches)) return false;
	getmxrr($matches[2], $host);
	if(!$host) $host[0] = $matches[2];
	return $host;
}
/*  이메일의 형식이 맞는지 체크한다. */
function get_email($email) {
	if(!preg_match("/([\._0-9a-zA-Z-]+)@([0-9a-zA-Z-]+\.[a-zA-Z\.]+)/", $email, $matches)) return false;
	return "<".$matches[0].">";
}
/* 메일을 전송한다. */
function send_mail($to, $from, $subject, $body,$cc_mail=false,$bcc_mail=false) {


	$from.=" <".$this->smtp_id.">";

	if(!is_array($to)){
		$rel_to=$to;
		$to = explode(",",$to);
	}
	else{
		$rel_to=implode(',',$to);
	}


	$data = $this->build_data($subject, $body);
	if($this->host == "auto") {
		foreach($to as $email) {
			if($host = $this->get_mx_server($email)) {
				for($i=0, $max=count($host); $i<$max; $i++) {
					if($conn = $this->connect($host[$i])) break;
				}
				if($conn) {
					$this->smtp_send($email, $from, $data,$cc_mail,$bcc_mail);
					$this->close();
				}
			}
		}
	} else {


			
		foreach($to as $key=>$email){
			$this->connect($this->host);
			$this->smtp_send($email, $from, $data,$cc_mail,$bcc_mail,$rel_to);
			$this->close();
		}
			
		if($cc_mail!=false){
			$this->cc_email($rel_to,$from,$data,$cc_mail,$bcc_mail);
		}
		if($bcc_mail!=false){
			$this->bcc_email($rel_to,$from,$data,$cc_mail,$bcc_mail);
		}
	}
}

function cc_email($rel_to,$from,$data,$cc_mail,$bcc_mail)
{
	if(!is_array($cc_mail)) $cc = explode(",",$cc_mail);

	foreach($cc as $email){
		$this->connect($this->host);
		$this->smtp_send($email, $from, $data,$cc_mail,$bcc_mail,$rel_to);
		$this->close();
	}
}
function bcc_email($rel_to,$from,$data,$cc_mail,$bcc_mail){

	if(!is_array($bcc_mail)) $bcc = explode(",",$bcc_mail);

	foreach($bcc as $email){
		$this->connect($this->host);
		$this->smtp_send($email, $from, $data,$cc_mail,$bcc_mail,$rel_to);
		$this->close();
	}

}
}

function sendMail($EMAIL, $NAME, $mailto, $SUBJECT, $CONTENT){
	//$EMAIL : 답장받을 메일주소
	//$NAME : 보낸이
	//$mailto : 보낼 메일주소
	//$SUBJECT : 메일 제목
	//$CONTENT : 메일 내용
	$admin_email = $EMAIL;
	$admin_name = $NAME;

	$header = "Return-Path: ".$admin_email."\n";
	$header .= "From: =?EUC-KR?B?".base64_encode($admin_name)."?= <".$admin_email.">\n";
	$header .= "MIME-Version: 1.0\n";
	$header .= "X-Priority: 3\n";
	$header .= "X-MSMail-Priority: Normal\n";
	$header .= "X-Mailer: FormMailer\n";
	$header .= "Content-Transfer-Encoding: base64\n";
	$header .= "Content-Type: text/html;\n \tcharset=euc-kr\n";

	$subject = "=?EUC-KR?B?".base64_encode($SUBJECT)."?=\n";
	$contents = $CONTENT;

	$message = base64_encode($contents);
	flush();
	return mail($mailto, $subject, $message, $header);
}


echo "query()함수를 이용한 테이블 생성 0007<br />";
// 24시간제
echo date("Y-m-d H:i:s") . "<br />\n";


//sendMail('neo1seok@gmail.com','신원석','wsshin@ictk.com','test','test');
$config=array(
		'host'=>'ssl://smtp.ictk.com:587',
		'smtp_id'=>'wsshin@ictk.com',
		'smtp_pw'=>'sws79700',
		'debug'=>1,
		'charset'=>'utf-8',
		'ctype'=>'text/plain'
);
$sendmail = new Sendmail($config);

$to="wsshin@ictk.com	";
$from="Master";
$subject="메일 제목입니다.";
$body="메일 내용입니다.";
//$cc_mail="cc@example.com";
//$bcc_mail="bcc@example.com";

/* 메일 보내기 */
$sendmail->send_mail($to, $from, $subject, $body,$cc_mail,$bcc_mail)

?>	