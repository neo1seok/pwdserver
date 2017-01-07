<?php
include("library.php");  // library.php 파일 포함
defMeta();

setHome("");

checkSession();

vewSessionState();
/*echo "
 <SCRIPT language='JavaScript'>
 setTimeout('history.go(0);', 20000);
 </SCRIPT>


 ";
*/
$option = $_REQUEST['option'];





$sql = "";

echo "<h1>IMAGE LIST</h1>";
if($option == 'all'||$option == 'today'||$option == 'profile'){

	$maplist = getPrevHistory();

	// 	$sqlhistory = "SELECT updt_date FROM history order by seq desc limit 1;";
	// 	$maplist = QueryString2Map($sqlhistory);
	$date = $maplist[0]['reg_date'];
	$update_date = $maplist[0]['updt_date'];

// 	$maplist = QueryString2Map("SELECT updt_date FROM history order by seq desc limit 1;");

// 	$date = $maplist[0]['updt_date'];

	if($option == 'all')
		$sql = "SELECT imgid, nickname,nck_uid,stamp FROM nickname where stamp != 'TITLE' and comment != 'REMOVED'" ;
	else if($option == 'profile')
		$sql = "SELECT imgid_profile as imgid, nickname,nck_uid,stamp FROM nickname where imgid_profile is not null";
	else
		$sql = "SELECT imgid, nickname,nck_uid,stamp FROM nickname where todayin = 'TRUE' order by `order`";
	$maplist =  QueryString2Map($sql);
}
else if($option=="prev"){
	$index = $_REQUEST['index'];


	$mapPrevInfo = getPrevList($index);

	$date = $mapPrevInfo['reg_date'];
	$update_date = $mapPrevInfo['updt_date'];
	$maplist =  $mapPrevInfo['maplist'];

}



listTitle('LIST',$date,$update_date);


foreach ($maplist as $v){
	echo "\n";
	$imgid = $v['imgid'];
	$nickname = $v['nickname'];
	$nck_uid= $v['nck_uid'];
	$stamp = $v['stamp'];

	$input = "inputname.php?id=$nck_uid";
	#$imglink = "http://369am.diskn.com/$imgid";
	$imglink = getimglink($imgid);
	$classname = 'normal';
	if($stamp == 'TRUE') {
		$msg = "##########";
		$classname = 'stamp';


		//continue;
	}


	echo "<p class='$classname' >$nickname($imgid)</p>";
	echo "<p><a href='$input'><img src='$imglink' width = '300'/></a></p>";
		//echo "<img src='http://369am.diskn.com/$imgid' width = '300'/> <br />\n";



}

prevLink('imglist.php','',4);
// echo "\n";

// for($i = 1 ; $i <4 ;$i++){
// 	echo "<p><a><a href='imglist.php?option=prev&index=$i'>이미지리스트  $i</a></p>";
// 	echo "\n";
// }

echo "\n";

defLink();

vewSessionState();
