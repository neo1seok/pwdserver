<?php
include("library.php");  // library.php ���� ����
header("Content-Type:application/json");
checkSession();



$site = getsaftyReq('site');
$ptail = getsaftyReq('ptail');
$id = getsaftyReq('id');
$etc = getsaftyReq('etc');
$phd_uid = getsaftyReq('phd_uid');
$pwd_uid = getsaftyReq('pwd_uid');
$option = getsaftyReq('option');


	if($pwd_uid == ""){
		$values = array();
		array_push($values, $phd_uid  ,$site  ,$ptail  ,$id  ,$etc);

		foreach ($values as &$v) {
			$v = "'".$v."'";

		}
		$strvalue = join(',', $values);

		$sql = "INSERT INTO passwd (seq,pwd_uid,phd_uid  ,site  ,ptail  ,id  ,etc ,reg_date,updt_date) select COALESCE(max(seq),0)+1, concat('pwd_',COALESCE(max(seq),0)+1),$strvalue,now(),now() from passwd";
	}
  else{
    $sql = "UPDATE passwd set site='$site',ptail='$ptail',id='$id',etc='$etc',phd_uid='$phd_uid' where pwd_uid='$pwd_uid';";

  }



	QueryString($sql,$def_die_string);

  $result['result']='ok';
  echo json_encode($result);


?>
