<?php
include("library.php");  // library.php 파일 포함

$maplist =  QueryString2Map("SELECT imgid, nickname FROM nickname");


$mapresult = getMapFromResultDB('imgid','nickname',$maplist);


echo json_encode($mapresult); 