<?php
require "includes/config.php";

if(isset($_POST["login"]))
{
	$login = $_POST["username"];
	$password = $_POST["password"];
	$user->logIn($login, $password);
	$_POST = array();
}

if(isset($_POST["signUp"]))
{
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $birth = $_POST["birthDate"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user->signUp($name, $surname, $email, $birth, $username, $password);
    $_POST = array();
}
?>