<?php
require_once("../comm/library.php");  // library.php 파일 포함
function checkSession(){
	checkSessionCatagory('369');
}
function getProfileMap(){
	$map = array();
	
	
	$map['홍도'] = array('26nC8w0W3q','');
	$map['마리'] = array('2m2sw7pXSW','2RQ2W3cJjC');
	$map['하나'] = array('36gBX2t9BW','0mIJcqKUdg');
	$map['하루'] = array('36gEP9yoe8','26nylzXMBW');
	$map['에일리'] = array('2m2sw8fY58','1mALiqZss4');
	$map['은율'] = array('2m2sw96HLG','1mALir5Z9u');
	$map['도화'] = array('0mHoYRsRyq','1mALipUxb8');
	$map['제시'] = array('0mHoYTMMbA','26nMto6Nfy');
	$map['콩'] = array('1mALkJgEfW','1RXVKFYcay');
	$map['티파니'] = array('1RXVLhjR0K','36fjJJbMeu');
	$map['신비'] = array('26nC8uHQpC','1mALiq8cvu');
	$map['소이'] = array('0RfEyRdiMg','1RXw4TuOqC');
	$map['중독'] = array('26nC8vR9eK','2RQ2W5CK6C');
	$map['하영'] = array('36fjKloLEe','1mALis3bF8');
	$map['아방'] = array('16uex4XBco','2m2sugH3bm');
	$map['엘루'] = array('36gBX2kBM0','26ncri0KeS');
	$map['요코'] = array('1RXVLgxwjS','16uevcyfou');
	$map['하얀'] = array('1mALkJrrFe','16uevdqi4W');
	$map['준교수'] = array('16vpzSpRCm','16vpzUaSIM');
	$map['메이'] = array('26nC8ttOGy','0Rey8NtdNQ');
	$map['보영'] = array('26nC8tv610','1m9RfmwuNy');
	
	
	$map['수'] = array('1mALkNfdWS','26nC7XskiO');
	$map['이슬'] = array('36fjKqWuzO','2m2sumcwEe');
	$map['소피아'] = array('1RXVLlRPE4','0Rey8TpLCR');
	$map['나비'] = array('2m2swC52ee','');
	$map['니꼬'] = array('16uex8KTUW','1mALiuXSoa');
	$map['개똥'] = array('1RXVLjsbGm','1RXVKIC4ji');
	$map['허니'] = array('16uexBMVFU','');
	$map['희진'] = array('1RXVLnTumW','1mAWVApTX4');
	$map['시가'] = array('0mHoYXuUF6','1RXVKK33za');
	$map['칸쵸'] = array('1mALkOscWW','1RXVKLBOLe');
	$map['하진'] = array('0mHoYZ8Yzq','2RQAyXpDHm');
	$map['비'] = array('0mHoYXJF3a','1mALivDAwe');
	$map['꼭지'] = array('1RXVLk5M28','26nC7WKRpW');
	$map['보아'] = array('16uex8msgg','26nC7Wriqu');
	$map['봉선'] = array('1mALkMys4u','36fjJMxXEm');
	$map['안나'] = array('36fjKqGMtO','36fjJOEBx0');
	$map['우리'] = array('1RXVLmTwG0','0mHoX6brDu');
	$map['써니'] = array('16uexA814e','');
	$map['재낌'] = array('26nC90cXJ0','0mHoX6xde4');
	$map['주원'] = array('0Rey9wkoVl','36fjJOvtVW');
	$map['시원'] = array('26nC8zrgqG','16ueviCy00');
	$map['소연'] = array('1mBwDcfq2u','');
	$map['아침'] = array('1mBEu0CErG','');
	$map['비누'] = array('36ggngodzO','');
	$map['삼팔실장'] = array('1RXVQK5Gm4','16uevhdcCc');
	
	return $map;
}
function defLink(){
	
	$maparray = array(
	    "리스트"=>"list.php",
		"오늘이미지리스트"=> "imglist.php?option=today",
		"전체이미지리스트"=> "imglist.php?option=all",
		"프로파일이미지리스트"=> "imglist.php?option=all",
			"TMP"=> "tmp.php",
		
			"BACK"=> "javascript:history.back()",
			"로그아웃"=> "login.php?option=logout",
			
 	);
	
	MakeLink($maparray);
// 	echo "\n";
// 	echo "<ul>";
// 	echo "\n";
// 	echo "<lis class='st'><a href='list.php'>매인화면</a></lis>";
// 	echo "\n";
// 	echo "<lis class='st'><a href='list.php?option=image'>매인화면</a></lis>";
// 	echo "\n";
// 	echo "<li><a href='javascript:history.back()'>back</a></li>";
// 	echo "\n";
// 	echo "<li><a href='login.php?option=logout'>로그아웃</a></li>";
// 	echo "\n";
// 	echo "</ul>";
// 	echo "\n";

}

function getPrevHistory(){
	$sqlhistory = "SELECT seq, hst_uid, uids, updt_date, reg_date, comment  FROM history where uids != '' order by seq desc limit 10;";
	$maplist = QueryString2Map($sqlhistory);
	return $maplist; 
}
function getPrevList($index){
	$mapPrevInfo = array();
	
	$maplist = getPrevHistory();

// 	$sqlhistory = "SELECT uids,updt_date,reg_date FROM history where uids != '' order by seq desc limit 10;";
// 	$maplist = QueryString2Map($sqlhistory);
	$count = count($maplist);
	if($index >=$count) $index = $count-1;

	$updt_date = $maplist[$index]['updt_date'];
	$reg_date = $maplist[$index]['reg_date'];
	$uids = $maplist[$index]['uids'];



	$uidarray = explode (",", $uids);

	$scommaarrayform = makeSingleCommaArrayFrom($uidarray);
	// 	$i = 0;
	// 	foreach ($uidarray as $v){
	// 		if($v == '') continue;
	// 		if($i > 0) $scommaarrayform .= ",";
	// 		$scommaarrayform .= "'$v'";
	// 		$i++;
	// 	}
	//
	//echo $scommaarrayform;
	//exit;

	//$sql = "SELECT imgid, nickname,nck_uid,stamp FROM nickname where nck_uid in ($scommaarrayform) and stamp !='TITLE'";
	$sql = "SELECT imgid, nickname,nck_uid,stamp FROM nickname where nck_uid in ($scommaarrayform) ";
	$maplist =  QueryString2Map($sql);
	$newmap = array();
	foreach ($maplist as $v){
		$nck_uid = $v['nck_uid'];
		$newmapp[$nck_uid] = $v;
		
	
	}
	$newlist = array();
	foreach ($uidarray as $uid){
		if($uid == '') continue;
		if(!array_key_exists($uid,$newmapp)) continue; 
		array_push ($newlist,$newmapp[$uid]);
		
//		echo $uid;
//		pnl();
	}

	$mapPrevInfo['updt_date'] =$updt_date;
	$mapPrevInfo['reg_date'] =$reg_date;
	$mapPrevInfo['maplist'] =$newlist;
	//$mapPrevInfo['maplist'] =$maplist;
	

	return  $mapPrevInfo;

}
function listTitle($title,$date,$update_date){
	echo "<h1>$title</h1>";
	
	
	echo "<h2>$date</h2>";
	echo "\n";
	echo "<h3>update $update_date</h3>";
	echo "\n";
	
}
function prevLink($pagename,$title,$maxprev){
	echo "\n";
	$maparray = array();
	for($i = 1 ; $i <$maxprev ;$i++){
		$maparray["$title  $i"] = "$pagename?option=prev&index=$i";
// 		echo "<p><a><a href='$pagename?option=prev&index=$i'>$title  $i</a></p>";
// 		echo "\n";
	}
// 	$maparray = array(
// 			"리스트"=>"list.php",
// 			"오늘이미지리스트"=> "imglist.php?option=today",
// 			"전체이미지리스트"=> "imglist.php?option=all",
// 			"TMP"=> "tmp.php",
	
// 			"BACK"=> "javascript:history.back()",
// 			"로그아웃"=> "login.php?option=logout",
				
// 	);
	
	MakeLink($maparray);
	
	echo "\n";
}
function getimglink($imgid){
	$imglink = "http://369am.diskn.com/$imgid";
	if(getsaftySession('debug') == 'true') return $imgid;
	return $imglink;
	
}
?>	