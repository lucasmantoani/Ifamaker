<?php session_start();
require_once "class.php";

$user = new User();
$user->displayUserPage();

?>