<?php
if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;

include("library.php");  // library.php 파일 포함


$id = $_POST['user_id'];
$pwd = $_POST['user_pw'];


$sql = sprintf("SELECT rn,pwd,name FROM user where id='%s';",$id);


echo $sql;
echo "2 <br />\n";		


$res = QueryString($sql);

if(!isset($res)){
        echo "<script>alert('아이디 가 잘못되었습니다.');history.back();</script>";
        exit;
	
}

$cmppwdhash = strtoupper(hash('sha256', $pwd . $res[0]));

if( $cmppwdhash != $res[1]){
        echo "<script>alert('아이디 또는 패스워드가 잘못되었습니다.');history.back();</script>";
        exit;
	
}

startSession();
appendLn("로그인 성공");
$_SESSION['user_id'] = $id;
$_SESSION['user_name'] = $res[2];

commBackHome();
//echo "<meta http-equiv='refresh' content='0;url=main.php'>";
?>
