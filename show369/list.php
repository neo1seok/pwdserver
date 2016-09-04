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

if($option==""){
	
	$maplist = getPrevHistory();
	
// 	$sqlhistory = "SELECT updt_date FROM history order by seq desc limit 1;";
// 	$maplist = QueryString2Map($sqlhistory);
	$date = $maplist[0]['reg_date'];
	$update_date = $maplist[0]['updt_date'];
	
	$sql = "SELECT imgid, nickname,nck_uid,stamp FROM nickname where todayin = 'TRUE' order by comment";
	$maplist =  QueryString2Map($sql);
	
}
else if($option=="prev"){
	$index = $_REQUEST['index'];
	
	
	$mapPrevInfo = getPrevList($index);
	
	$date = $mapPrevInfo['reg_date'];
	$update_date = $mapPrevInfo['updt_date'];
	$maplist =  $mapPrevInfo['maplist'];
	
	
// 	$sqlhistory = "SELECT uids,updt_date,reg_date FROM history where uids != '' order by seq desc limit 10;";
// 	$maplist = QueryString2Map($sqlhistory);
// 	$count = count($maplist);
// 	if($index >=$count) $index = $count-1;
	   
// 	$date = $maplist[$index]['updt_date'];
// 	$uids = $maplist[$index]['uids'];
	
// 	$uidarray = explode (",", $uids);
	
// 	$scommaarrayform = makeSingleCommaArrayFrom($uidarray);
// // 	$i = 0;
// // 	foreach ($uidarray as $v){
// // 		if($v == '') continue;
// // 		if($i > 0) $scommaarrayform .= ","; 
// // 		$scommaarrayform .= "'$v'";
// // 		$i++;
// // 	}
// 	//
// 	//echo $scommaarrayform;
// 	//exit;
	
// 	$sql = "SELECT imgid, nickname,nck_uid,stamp FROM nickname where nck_uid in ($scommaarrayform) and stamp !='TITLE'";
// 	$maplist =  QueryString2Map($sql);
	
	
}


listTitle('LIST',$date,$update_date);



foreach ($maplist as $v){
	echo "\n";
	$imgid = $v['imgid'];
	$nickname = $v['nickname'];
	$nck_uid= $v['nck_uid'];
	$stamp = $v['stamp'];
		
	$input = "inputname.php?id=$nck_uid";
	$imglink = "http://369am.diskn.com/$imgid";
	$classname = 'normal';
	
	$msg = '';
	if($stamp == 'TITLE') {
		$msg = "##########";
		echo "<p>=========$nickname=========</p>";
		continue;
	}
	if($stamp == 'TRUE') {
		$msg = "##########"; 
		$classname = 'stamp';
		
		
		//continue;
	}
	echo "<p><a class='$classname' href='$input'>$imgid:$nickname $msg</a></p>";

		//echo "<p><a href='$input'>$imgid:$nickname $msg</a></p>";
		


	
	
}

prevLink('list.php','',4);
// echo "\n";

// for($i = 1 ; $i <4 ;$i++){
// 	echo "<p><a><a href='list.php?option=prev&index=$i'>리스트  $i</a></p>";
// 	echo "\n";	
// }



defLink();

vewSessionState();
