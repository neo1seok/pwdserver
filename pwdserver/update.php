

<?php
 include("library.php");  // library.php 파일 포함
 defMeta();
 checkSession();
 
$uid = $_REQUEST['uid'];
$option = $_REQUEST['option'];

if($option == ""){
	$option = "update";
	
}

$phd_uid="phd_1";
$site = "";
$ptail="";
$id="";
$etc="";

$title="";
$hint="";

//$res = QueryString("SELECT phd_uid,site,ptail,id,etc FROM passwd where pwd_uid='$uid';");
if($option == "update"){
	$map= QueryString2Map("SELECT A.phd_uid,site, ptail, id, A.etc,B.title, B.hint FROM passwd A,pheader B where A.phd_uid = B.phd_uid and pwd_uid='$uid';");
	if(count($map)==0){
		echo "No Result";
		echo "<br />\n";
		
		echo '<a href="javascript:history.back()">back</a>';
		
		exit;
	}
	$res = $map[0];
	
	$phd_uid=$res['phd_uid'];
	$site = $res['site'];
	$ptail=$res['ptail'];
	$id=$res['id'];
	$etc=$res['etc'];
	
	$title=$res['title'];
	$hint=$res['hint'];
	
}

$map = QueryString2Map("SELECT phd_uid, title FROM pheader;");

$dbcompare = $phd_uid."".$site."".$ptail."".$id."".$etc."".$title."".$hint;
$mapPhdUid2Title = array();
foreach ($map as $value) {

	$k = $value['phd_uid'];
	$v = $value['title'];
	$mapPhdUid2Title[$k] = $v;

}

$jsonString = json_encode($mapPhdUid2Title);

 
?>

<script type="text/javascript">

function onloadpage(){

	console.log('onloadpage');
	var jsonString = '<?php echo $jsonString; ?>'
	phd_uid = '<?php echo $phd_uid; ?>'
		
	
	mapValue = JSON.parse(jsonString);
	
	UpdateProductDropInfo();

}

function UpdateProductDropInfo(){
	console.log(phd_uid);
	for (var key in mapValue) {
		addOption(key, mapValue[key]);
	}
	

}
function addOption(value,txt){
    var frm = document.input;
    var op = new Option();
    op.value = value; // 값 설정
    op.text = txt; // 텍스트 설정

    if(phd_uid == value)
	    op.selected = true; // 선택된 상태 설정 (기본값은 false이며 선택된 상태로 만들 경우에만 사용)

    frm.phd_uid.options.add(op); // 옵션 추가
    
	
	
}

function onInputSubmit(item) {
	console.log("onsubmit");
	//$dbcompare = $phd_uid."".$site."".$ptail."".$id."".$etc."".$title."".$hint;
	var dbcompare = '<?php echo $dbcompare; ?>'
	var compare = item.phd_uid.value+
		item.site.value +
		item.ptail.value +
		item.id.value+
		item.etc.value+
		mapValue[item.phd_uid.value]+
		item.hint.value;
	console.log(dbcompare);
	console.log(compare);

	
	

	if (dbcompare == compare) {
		alert("변경된 내용이 없습니다.");
		return false;
	}
	var ret = confirm("변경하시겠습니까?");
	if(ret != "OK"){
		return false;
	}
	return true;
}

	
</script>

<body onload="onloadpage()">

<form name = 'input' method='post' action='update_ok.php' onsubmit="return onInputSubmit(this);">

<input type='hidden' name='option'  readonly value='<?php echo $option; ?>' />
<table>
<tr>
	<td>pwd_uid</td>
	<td><input type='text' name='pwd_uid'  readonly value='<?php echo $uid; ?>' /></td>
</tr>

<tr>
	<td>site</td>
	<td><input type='text' name='site' tabindex='1' value='<?php echo $site; ?>' /></td>
</tr>
<tr>
	<td>헤더</td>
	<td><select id="phd_uid" name="phd_uid"></select></td>
</tr>

<tr>
	<td>ptail</td>
	<td><input type='text' name='ptail' tabindex='2' value='<?php echo $ptail; ?>' /></td>
</tr>
<tr>
	<td>id</td>
	<td><input type='text' name='id' tabindex='3' value='<?php echo $id; ?>' /></td>
</tr>
<tr>
	<td>etc</td>
	<td><TEXTAREA NAME=etc ROWS=3 COLS=100>
<?php echo $etc; ?>
</TEXTAREA></td>
	</tr>

</table>

<input type='submit' tabindex='3' value='UPDATE' style='height:50px'/>
</form>
</body>


<?php defLink();?>