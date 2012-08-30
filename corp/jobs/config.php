<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'ss2';
$con = mysql_connect($dbhost, $dbuser) or die                      ('Error connecting to mysql');
mysql_select_db($dbname);
?>