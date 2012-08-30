<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'ss';
$con = mysql_connect($dbhost, $dbuser) or die                      ('Error connecting to mysql');
mysql_select_db($dbname);
?>