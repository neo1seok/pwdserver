

<?php
include("library.php");  // library.php 파일 포함
defMeta();
checkSession();

$uids = $_REQUEST['uids'];


$rebackurl = sprintf("login.php?rebackurl=%s",$_SERVER['REQUEST_URI']);


$incondition = '';


if($uids != 'all')
{
	
	$uidarray = explode (",", $uids);
	$i = 0;
	foreach ($uidarray as &$v) {
		$v = "'".$v."'";
	
	}
	$strarrays = join(',', $uidarray);
	$incondition = 'and pwd_uid in ('.$strarrays.')';
}

		
$mapresult = QueryString2Map("SELECT pwd_uid,site, B.title,ptail,B.phd_uid FROM passwd A,pheader B where A.phd_uid = B.phd_uid $incondition;");

viewQueryResult($mapresult);
defLink();
?>	


<!--
<p><a href='main.php'>매인화면</a></p>
<p><a href='logout.php'>로그아웃</a></p>
-->





