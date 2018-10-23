<?php
session_start();

$connect = @new mysqli("localhost", "root", "", "db_test");
if($connect->connect_errno)
{
	die("[ERROR #".$connect->connect_errno."] ".$connect->connect_error);
}
$connect->set_charset("utf8");


require "User.php";
$user = new User($connect);
?>