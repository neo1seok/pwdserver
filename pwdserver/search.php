<meta charset="utf-8" />

<?php
 include("library.php");  // library.php ���� ����
  checkSession();


$keyword = $_REQUEST['keyword'];
echo "006";

session_start();
$rebackurl = sprintf("login.php?rebackurl=%s",$_SERVER['REQUEST_URI']);
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
	//echo "<script>alert($rebackurl);history.back();</script>";
	echo "<meta http-equiv='refresh' content='0;url=login.php?rebackurl=".$_SERVER['REQUEST_URI']."'>";
	//echo "content='0;url=login.php?rebackurl=\"".$rebackurl."\"";
	exit;
}
echo '$sql';
$sql = "SELECT pwd_uid FROM passwd where site regexp '$keyword';";
echo $sql;
pnl() ;
$mapresult = QueryString2Map($sql);
$uids = array();

foreach ($mapresult as $k => $v){
	echo $v["pwd_uid"];
	array_push($uids, $v["pwd_uid"]);
}

$strarrays = join(',', $uids);
echo $strarrays;
$url = "showlist.php?uids=$strarrays";
echo $url;
pagego($url);





?>
