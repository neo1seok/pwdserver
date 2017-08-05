<?php
require_once("../comm/library.php");  // library.php 파일 포함




function checkSession(){
	checkSessionCatagory('PWD');
}
function defLink_OLD(){
	echo "\n";
	echo "<ul>";
	echo "\n";
	echo "<lis class='st'><a href='main.php'>매인화면</a></lis>";
	echo "\n";
	echo "<li><a href='javascript:history.back()'>back</a></li>";
	echo "\n";
	echo "<li><a href='login.php?option=logout'>로그아웃</a></li>";
	echo "\n";
	echo "</ul>";
	echo "\n";

}


function defLink(){

	$maparray = array(
			"매인화면"=>"main.php",
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


function processNoresult($title){
	echo "No Result";
	echo "<br />\n";

	echo '<a href="javascript:history.back()">back</a>';

	exit;

}

?>
