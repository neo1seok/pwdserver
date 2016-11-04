<?php
include("library.php");  // library.php 파일 포함
defMeta();
//setHome("");

checkSession();

$uid = $_REQUEST['id'];
$option = $_REQUEST['option'];

$maplist = QueryString2Map("SELECT nck_uid,imgid,imgid_profile,imgid_ext,nickname,stamp FROM nickname where nck_uid = '$uid';");
$imgid = $maplist[0]['imgid'];
$nickname = $maplist[0]['nickname'];
$stamp = $maplist[0]['stamp'];
$imgid_profile = $maplist[0]['imgid_profile'];
$imgid_ext = $maplist[0]['imgid_ext'];
$map = getProfileMap();

function inputForm($uid,$imgid,$nickname,$stamp){

	echo "
	

	
	
	<form name = 'input' method='post' action='update_nickname.php'>
	<input type='hidden' name='option'  readonly value='' />
	<input type='hidden' name='id' tabindex='1' value='$uid' />
	
	
	<table>
	
	<tr>
	<td>IMGID</td>
	<td><input type='text' name='imgid' readonly tabindex='1' value='$imgid' /></td>
	</tr>
	<tr>
	<td>NICK NAME</td>
	<td><input type='text' name='nickname' tabindex='2' value='$nickname' /></td>
	</tr>
	<td>STAMP</td>
	<td>
		<select name="stamp">
			<option value="TRUE">TRUE</option>
			<option value="FALSE">TITLE</option>
			<option value="TITLE">TITLE</option>
		</select>
	</td>
	</tr>
	</table>
	
	<input type='submit' tabindex='3' value='UPDATE' style='height:50px'/>
	</form>
	";
	
	
}

function inputLink($uid){

	$maparray = array(
			"일반"=>"inputname.php?id=$uid&option=shrink",
			"자세히"=>"inputname.php?id=$uid&option=profile",
			"입력(로그인필요)"=>"inputname.php?id=$uid&option=inputform",
			
				
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
function viewImg($imgid){
	if($imgid == NULL || $imgid == ""){
		return ;
	}
	
	$imglink = getimglink($imgid);
	echo "<img src='$imglink' width = '300'/> <br />\n";

}
if($stamp == 'TITLE'){
	
	echo "<script>alert('$nickname아이디 는 고칠수 있는 ID 가 아닙니다.');history.back();</script>";
	exit();
}
$imglink = getimglink($imgid);
echo "<img src='$imglink' width = '300'/> <br />\n";

if($option == 'inputform'){
	$user_id = $_SESSION['user_id'];
	$ret = strpos($user_id, 'VISIT');
	if (0 === $ret) {
		pagego('login.php');
		exit;
	}
	
	inputForm($uid,$imgid,$nickname,$stamp);	
	
}
else if($option == 'profile') {
	//echo $option;
	
	
	//echo $imgid_profile;
	
	viewImg($imgid_profile);
	viewImg($imgid_ext);

	
	
	
/*	
	if (array_key_exists($nickname, $map)) {
		foreach ($map[$nickname] as $id){
			$imglink = getimglink($id);
			echo "<img src='$imglink' width = '300'/> <br />\n";
		}
	
	}
*/
}
 
inputLink($uid);

defLink(); 
?>;