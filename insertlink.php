<?php
require_once("library.php");  // library.php 파일 포함

$title = $_REQUEST['title'];
$link = $_REQUEST['link'];
if($title =="" || $link==""){
	echo "<script>alert('값을 입력해야 합니다.');history.back();</script>";
	exit();
}
			
$seq = getNextSeq('fav_link');

$sql = "INSERT INTO neo_pwinfo.fav_link
(seq, fnk_uid, title, link, updt_date, reg_date, comment) 
VALUES ($seq, 'fnk_$seq', '$title', '$link', now(), now(), '');";

QueryString($sql);




commBackHome();