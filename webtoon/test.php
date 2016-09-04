<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<h1>test </h1>
<?php
include("library.php");  // library.php 파일 포함
defMeta();
sampleTable();


$array = [
		"foo" => "bar",
		"bar" => "foo",
];

echo "17";
exit;
echo json_encode($array);

$stack = array("orange", "banana");
array_push($stack, "apple", "raspberry");
print_r($stack);

echo "query()함수를 이용한 테이블 생성 1119<br />";
// 24시간제
echo date("Y-m-d H:i:s") . "<br />\n";



echo hash('sha256', 'The quick brown fox jumped over the lazy dog.');

$res = QueryString("SELECT rn,pwd FROM user where id='neo1seok';");

echo 'QueryString';

$map = QueryString2Map("SELECT phd_uid, title FROM pheader;");
echo "<br />\n";
echo 'QueryString2Map';
echo "<br />\n";
echo $map;
echo "<br />\n";
echo json_encode($map);
echo "<br />\n";		
echo $res;
echo "<br />\n";		

$cmppwdhash = strtoupper(hash('sha256', "tofhdna1pwd" . $res[0]));
echo "<br />\n";		
echo $res[1];
echo "<br />\n";		

?>	


