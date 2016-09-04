<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">

<?php
echo "query()함수를 이용한 테이블 생성 0006<br />";
// 24시간제
echo date("Y-m-d H:i:s") . "<br />\n";


$output = shell_exec('python3');
echo "<pre>$output</pre>";





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
	

?>	