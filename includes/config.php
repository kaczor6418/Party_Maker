<?php

$connect = @new mysqli("localhost", "root", "", "db_test");

if($connect->connect_errno)
{
	die("[ERROR #".$connect->connect_errno."] ".$connect->connect_error);
}
$connect->set_charset("utf8");

session_start();

require "user.php";

$user = new User($connect);
?>