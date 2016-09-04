<?php
include("library.php");  // library.php 파일 포함
defMeta();

setHome("");

checkSession();

$infoday = array('1RWbHAyiXm','26nC8w0W3q','2m2sw7pXSW','2RQ2W3cJjC','36gBX2t9BW','0mIJcqKUdg','36gEP9yoe8','26nylzXMBW','2m2sw8fY58','1mALiqZss4','2m2sw96HLG','1mALir5Z9u','0mHoYRsRyq','1mALipUxb8','0mHoYTMMbA','26nMto6Nfy','1mALkJgEfW','1RXVKFYcay','1RXVLhjR0K','36fjJJbMeu','26nC8uHQpC','1mALiq8cvu','0RfEyRdiMg','1RXw4TuOqC','26nC8vR9eK','2RQ2W5CK6C','36fjKloLEe','1mALis3bF8','16uex4XBco','2m2sugH3bm','36gBX2kBM0','26ncri0KeS','1RXVLgxwjS','16uevcyfou','1mALkJrrFe','16uevdqi4W','16vpzSpRCm','16vpzUaSIM','26nC8ttOGy','0Rey8NtdNQ','26nC8tv610');
$info = array('1m9RfmwuNy','1mALkNfdWS','26nC7XskiO','36fjKqWuzO','2m2sumcwEe','1RXVLlRPE4','0Rey8TpLCR','2m2swC52ee','16uex8KTUW','1mALiuXSoa','1RXVLjsbGm','1RXVKIC4ji','16uexBMVFU','1RXVLnTumW','1mAWVApTX4','0mHoYXuUF6','1RXVKK33za','1mALkOscWW','1RXVKLBOLe','0mHoYZ8Yzq','2RQAyXpDHm','0mHoYXJF3a','1mALivDAwe','1RXVLk5M28','26nC7WKRpW','16uex8msgg','26nC7Wriqu','1mALkMys4u','36fjJMxXEm','36fjKqGMtO','36fjJOEBx0','1RXVLmTwG0','0mHoX6brDu','16uexA814e','26nC90cXJ0','0mHoX6xde4','0Rey9wkoVl','36fjJOvtVW','26nC8zrgqG','16ueviCy00','1mBwDcfq2u','1mBEu0CErG','36ggngodzO','1RXVQK5Gm4','16uevhdcCc');

foreach ($info as $imgid){
	echo "\n";
	$imglink = "http://369am.diskn.com/$imgid";
	echo "<p><img src='$imglink' width = '300'/></p>";
	//echo "<img src='http://369am.diskn.com/$imgid' width = '300'/> <br />\n";



}


defLink();