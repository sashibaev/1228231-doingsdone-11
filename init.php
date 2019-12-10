<?php

    function getDatabaseConnection() {
	    $connection = mysqli_connect("localhost", "root", "", "affairs_ok" );
	    if($connection === false) {
	        print("Соединение не установлено" . mysqli_connect_error());

	        die();
	    }
	    mysqli_set_charset($connection, "utf8");

	    return $connection;
	}


    function gotSqliError($connection) {
        $error = mysqli_error($connection);
        print("Ошибка MySQL: " . $error);

        die();
    }

    $con = getDatabaseConnection();
?>