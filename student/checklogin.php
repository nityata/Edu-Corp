<?php
include 'config.php';
$myusername=$_POST['uname']; 
$mypassword=$_POST['passwd'];
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM users WHERE uname='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("myusername");
session_register("mypassword"); 
while($row = mysql_fetch_array($result))
  {
    $utype=$row['utype'];
    $uid=$row['uid'];
  }
session_register("uid");
session_register("utype");
if($utype=="s")
 {
  header("location:./index.php?sid=".$uid);
 }
else if($utype=="t")
 {
  header("location:./faculty/home.php");
 }
else if($utype=="c")
 {
  header("location:http://localhost/corp/jobs/index.php?cid=".$uid);
 }
else
{
  echo "Sorry some problem";
}
}
else {
echo $myusername." ".$mypassword;
echo "Wrong Username or Password";
echo $count;
}
mysql_close($con);
?>