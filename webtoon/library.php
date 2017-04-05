<?php
require_once("../comm/library.php");  // library.php 파일 포함

function getnaverWebtoollink($id,$title){
	return "<a href='http://comic.naver.com/webtoon/list.nhn?titleId=$id'>$title</a>";
}
function getnaverWebtoonlinkDetail($id,$no,$title){
	//$list = getnaverWebtoollink($id,"리스트");
	return "<a href='http://comic.naver.com/webtoon/detail.nhn?titleId=$id&no=$no'>$title</a>";// $list";
}

?>	