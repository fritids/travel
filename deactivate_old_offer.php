<?php

$hostname = 'localhost';
$username = 'rjtravel_trav35a';
$password = 's!uNEevObFpW';
$database = 'rjtravel_trav45a43';

$linkID = mysql_connect($hostname,$username,$password);
mysql_select_db($database,$linkID);

$query = "update trv_offers set offer_status='0' where offer_finish_date < CURDATE(); ";
$result = mysql_query($query);

?>