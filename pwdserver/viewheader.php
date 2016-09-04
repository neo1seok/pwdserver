

<?php
include ("library.php"); // library.php 파일 포함
defMeta();
checkSession ();
$uid = $_REQUEST ['uid'];
$option = $_REQUEST ['option'];

$mapresult = QueryString2Map ( "SELECT title, hint, special_letter FROM pheader where phd_uid = '$uid';" );

if (count ( $mapresult ) == 0) {
	
	processNoresult ();
	
	exit ();
}
echo "<table border>";
foreach ( $mapresult [0] as $k => $v ) {
	
	// 머릿글 출력
	echo "<tr>";
	
	echo "<th>";
	echo $k;
	echo "</th>";
	
	echo "<th>";
	echo $v;
	echo "</th>";
	
	
	// echo "<td>수정</td>";
	echo "</tr>";
	
	// 테이블 끝
}
echo "</table>";


defLink();
?>

