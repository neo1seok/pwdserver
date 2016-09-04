<?php 
// PHP 4.1.0부터 사용 가능
	echo date("Y-m-d H:i:s") . "<br />\n";	
	
	echo 'Current PHP version: ' . phpversion() ."<br />";

// prints e.g. '2.0' or nothing if the extension isn't enabled
echo phpversion('tidy') ."<br />";

   
   echo $_REQUEST['username']."<br />";
   echo $_REQUEST['email']."<br />";
   

?>