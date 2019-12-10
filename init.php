<?php

   // session_start();

   include_once("helpers.php");
   include_once("functions.php");

   $con = getDatabaseConnection();

   $projects  = getProjects($con);

   $users = getUsers($con);

?>