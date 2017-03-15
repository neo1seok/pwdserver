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
$maphistory = QueryString2Map("SELECT seq, hst_uid, uids, updt_date, reg_date, comment FROM neo_pwinfo.history where uids like '%$uid,%' order by reg_date desc limit 10;");
$str_timestamp="";
foreach ($maphistory as $v){
	$reg_date = $v['reg_date'];
	$comment = $v['comment'];
	$str_timestamp .= "등록일:$reg_date\n";
	//echo"$str_timestamp";
}

function inputForm($uid,$imgid,$nickname,$stamp){

	echo "




	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js'></script>
	<script language='JavaScript' type='text/JavaScript'>

	$(window).load(function(){

			$('#stamp').val('$stamp').attr('selected', 'selected');
			//UpdateProductDropInfo();
	});


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

	";

	/*
	<script language='JavaScript' type='text/JavaScript'>
	fn_selTest( '$stamp' ); // <--- 3이라는 값을 선택할때
	</script>

	*/



}
function inputLink($uid){

	$maparray = array(
			"일반"=>"inputname.php?id=$uid&option=shrink",
			"이전출근부"=>"inputname.php?id=$uid&option=timestamp",
			"자세히"=>"inputname.php?id=$uid&option=profile",
			"입력(로그인필요)"=>"inputname.php?id=$uid&option=inputform",
			"삭제(로그인필요)"=>"deletename.php?id=$uid&option=confirm",


	);

	MakeLink($maparray);


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
//echo "<img src='$imglink' width = '300'/> <br />\n";

if($option == 'inputform' ){
	$user_id = $_SESSION['user_id'];
	$ret = strpos($user_id, 'VISIT');
	if (0 === $ret) {
		pagego('login.php');
		exit;
	}

	inputForm($uid,$imgid,$nickname,$stamp);


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
?>;

<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js'></script>
<script language='JavaScript' type='text/JavaScript'>
function hide_all() 	{
	$('#form').hide();
	$('#img_profile').hide();
	$('#img_ext').hide();
	$('#p_timestamp').hide();

}
$(window).load(function(){

		$('#stamp').val('<?php echo $stamp; ?>').attr('selected', 'selected');
		hide_all() ;

		$('#shrink').click(function(){
			console.log('shrink');
			hide_all() ;

		});
		$('#timestamp').click(function(){
			console.log('timestamp');
			hide_all() ;
			$('#p_timestamp').show();

		});
		$('#profile').click(function(){
			console.log('profile');
			hide_all() ;
			$('#img_profile').show();
			$('#img_ext').show();

		});
		$('#inputform').click(function(){
			console.log('inputform');
			hide_all() ;
			$('#form').show();
		});


		//UpdateProductDropInfo();
});


</script>

<img src='<?php echo $imglink; ?>' width = '300'/> <br />
<img id='img_profile' src='<?php echo getimglink($imgid_profile); ?>' width = '300'/> <br />
<img id='img_ext' src='<?php echo getimglink($imgid_ext); ?>' width = '300'/> <br />
<p id='p_timestamp'><?php echo $str_timestamp; ?></p>

<form name = 'input' id='form'  method='post' action='update_nickname.php'>
<input type='hidden' name='option'  readonly value='' />
<input type='hidden' name='id' tabindex='1' value='$uid' />


<table>

<tr>
<td>IMGID</td>
<td><input type='text' name='imgid' readonly tabindex='1' value='<?php echo $imgid; ?>' /></td>
</tr>
<tr>
<td>NICK NAME</td>
<td><input type='text' name='nickname' tabindex='2' value='<?php echo $nickname; ?>' /></td>
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


<ul id="navigation">
	<li id='shrink'><a href=#>일반</a></li>
	<li id='timestamp'><a href=#>이전출근부</a></li>
	<li id='profile'><a href=#>자세히</a></li>
	<li id='inputform'><a href=#>입력(로그인필요)</a></li>
	<li id='delete'><a href="deletename.php?id=$uid&option=confirm">삭제(로그인필요)</a></li>
</ul>

<?php
//inputLink($uid);

defLink();
?>;
