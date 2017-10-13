<?php
include("library.php");  // library.php ���� ����
checkSession();
header("Content-Type:application/json");

$phd_uid = getsaftyReq('phd_uid');
$title = getsaftyReq('title');
$hint = getsaftyReq('hint');
$special_letter = getsaftyReq('special_letter');
$etc = getsaftyReq('etc');

$option = getsaftyReq('option');


	if($phd_uid == ""){
		$values = array();
		array_push($values,$title,$hint,$special_letter,$etc);

		foreach ($values as &$v) {
			$v = "'".$v."'";

		}
		$strvalue = join(',', $values);

		$sql = "INSERT INTO pheader(   seq  ,phd_uid  ,title  ,hint  ,special_letter  ,etc  ,updt_date  ,reg_date ) select COALESCE(max(seq),0)+1, concat('phd_',COALESCE(max(seq),0)+1),$strvalue,now(),now() from pheader";
	}
  else{
    $sql = "UPDATE pheader set  title='$title' , hint='$hint' , special_letter='$special_letter' , etc='$etc' where phd_uid='$phd_uid';";

  }

//	echo $sql;

	QueryString($sql,$def_die_string);

  $result['result']='ok';
  echo json_encode($result);


?>
