<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<h1>test 5 </h1>
<?php



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

function QueryString($dbname,$strQuery){

	//Connect DB
	$connect = @mysql_connect("localhost:3306","neo1seok","tofhdna1pi") or die("DB접속에러");

	//Select DB
	@mysql_select_db($dbname,$connect) or die("DB선택에러");
	

	//Print Query Result
	$result = @mysql_query($strQuery) or die("SQL error");
	
	$data=@mysql_fetch_row($result);
	return $data;

} 
	$id = $_REQUEST['id'];
	$pwd = $_REQUEST['password'];

   
   

echo date("Y-m-d H:i:s") . " 3<br />\n";
echo $id."<br />";


$sql = sprintf("SELECT rn,pwd FROM user where id='%s';",$id);
echo $sql;
echo "<br />\n";		


$res = QueryString("neo_pwinfo",$sql);

echo "<br />\n";		
echo $res;
echo "<br />\n";		

$cmppwdhash = strtoupper(hash('sha256', $pwd . $res[0]));
echo $cmppwdhash;
echo "<br />\n";		
echo $res[1];
echo "<br />\n";		
if($cmppwdhash != $res[1]){
	
	
	echo "NOT OK";
	echo "<br />\n";		
	return;
	
}

echo "OK";
echo "<br />\n";		


viewQueryResult("neo_pwinfo","SELECT site, B.title,ptail, id, A.etc
FROM neo_pwinfo.passwd A,neo_pwinfo.pheader B where A.phd_uid = B.phd_uid;");



?>	


