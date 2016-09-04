<meta charset="utf-8" />
<h1>update ok </h1>

<?php
include("library.php");  // library.php ���� ����
defMeta();
checkSession(); 



	
	
	$site = $_REQUEST['site'];
	$ptail = $_REQUEST['ptail'];
	$id = $_REQUEST['id'];
	$etc = $_REQUEST['etc'];
	$phd_uid = $_REQUEST['phd_uid'];
	$pwd_uid = $_REQUEST['pwd_uid'];
	$option = $_REQUEST['option'];
	
	if($option == "insert"){
		echo 'insert';
		$values = array();
		array_push($values, $phd_uid  ,$site  ,$ptail  ,$id  ,$etc);
		
		foreach ($values as &$v) {
			$v = "'".$v."'";
		
		}
		$strvalue = join(',', $values);
		
		$sql = "INSERT INTO passwd (seq,pwd_uid,phd_uid  ,site  ,ptail  ,id  ,etc ,reg_date,updt_date) select COALESCE(max(seq),0)+1, concat('pwd_',COALESCE(max(seq),0)+1),$strvalue,now(),now() from passwd";
		echo $sql ;
		QueryString($sql);
		
		pagego("showlist.php");
		
	
		exit;
	}
	
	
	echo "confirm ok";
	echo $phd_uid;
	echo $pwd_uid;
	
	$sql = "UPDATE passwd set site='$site',ptail='$ptail',id='$id',etc='$etc',phd_uid='$phd_uid' where pwd_uid='$pwd_uid';";
	//echo $sql;
	
	QueryString($sql);
	$url = "showlist.php?uids=$pwd_uid";
	echo $url;
	pagego($url);

	//echo "<meta http-equiv='refresh' content='0;url=showlist.php?uids=$pwd_uid'>";
 
?>


