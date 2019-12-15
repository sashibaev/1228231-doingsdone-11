<?php
session_start();
if (!empty($_SESSION["user"])) {
    var_dump($_SESSION["user"]);
    
    }    

   echo "<br>Вы перенаправлены на тестовую страницу <br>"; 

?>