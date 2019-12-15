<?php
session_start();

include_once("helpers.php");
include_once("functions.php");

$con = getDatabaseConnection();

$users = getUsers($con);

?>