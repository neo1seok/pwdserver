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





	<script language='JavaScript' type='text/JavaScript'>
	function fn_selTest( val ) 	{
		var ele = document.getElementById('stamp');

		for( i=0 ; i<ele.length; i++ ) 	{
			if( ele.options[i].value == val ) 		{
				ele.options[i].selected = true;
				break;
			}
		}
	}
	</script>

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
		<select name='stamp' id='stamp'>
			<option value='TRUE'>TRUE</option>
			<option value='FALSE'>FALSE</option>
			<option value='TITLE'>TITLE</option>
		</select>
	</td>
	</tr>
	</table>

	<input type='submit' tabindex='3' value='UPDATE' style='height:50px'/>
	</form>
	<script language='JavaScript' type='text/JavaScript'>
	fn_selTest( '$stamp' ); // <--- 3이라는 값을 선택할때
	</script>
	";


}
function deleteImgID($uid,$nickname){
	$sql = "delete from nickname where nck_uid='$uid'";
	QueryString($sql);
	// echo "<meta http-equiv='refresh' content='0;url=list.php?optjion=image'>";
	commBackHome();
	echo "TEST";
}
function inputLink($uid){

	$maparray = array(
			"일반"=>"inputname.php?id=$uid&option=shrink",
			"이전출근부"=>"inputname.php?id=$uid&option=timestamp",
			"자세히"=>"inputname.php?id=$uid&option=profile",
			"입력(로그인필요)"=>"inputname.php?id=$uid&option=inputform",
			"삭제(로그인필요)"=>"inputname.php?id=$uid&option=delete_confirm",


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

if($option == 'inputform' || $option == 'delete_confirm' ||$option == 'delete'){
	$user_id = $_SESSION['user_id'];
	$ret = strpos($user_id, 'VISIT');
	if (0 === $ret) {
		pagego('login.php');
		exit;
	}

	if($option == 'inputform')
		inputForm($uid,$imgid,$nickname,$stamp);
	else if($option == 'delete_confirm'){
		echo "<script> var val = confirm('$uid + $nickname');//history.back();\n";
		echo "
		console.log(val);

		if ( val == false){
			window.location.href = 'inputname.php?id=$uid&option=shrink';
			//echo val;
			console.log('false');

		}
		else{
			window.location.href = 'inputname.php?id=$uid&option=delete';
			console.log('true');
		}

		";
		echo "</script>";
	}
	else if($option == 'delete') {
		deleteImgID($uid,$nickname);
	}



}

else if($option == 'timestamp') {
	$maphistory = QueryString2Map("SELECT seq, hst_uid, uids, updt_date, reg_date, comment FROM neo_pwinfo.history where uids like '%$uid,%' order by reg_date desc limit 10;");
	foreach ($maphistory as $v){
		echo "\n";
		$reg_date = $v['reg_date'];
		$comment = $v['comment'];
		echo "등록일:$reg_date";
		pnl();

	}



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
