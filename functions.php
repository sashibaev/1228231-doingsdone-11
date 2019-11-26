<?php

	function getDatabaseConnection() {
	    $connection = mysqli_connect("localhost", "root", "", "affairs_ok" );
	    if($connection === false) {
	        printf("Соединение не установлено",mysqli_connect_error());

	        die();
	    }
	    mysqli_set_charset($connection, "utf8");
	    
	    return $connection;
	}


    function gotSqlError($connection) {
        $error = mysqli_error($connection);
        printf("Ошибка MySQL: ". $error);

        die();
    }
    

	function getProjects($connection) {
	    $sqli = "SELECT p.id, p.`name`, (SELECT count(id) FROM tasks WHERE tasks.project_id = p.id) as `count` FROM projects p WHERE p.user_id = 3 ";
	    $res = mysqli_query($connection, $sqli);

	    if (!$res) {
	        got_sqli_error($connection);
	    }

	    return mysqli_fetch_all($res, MYSQLI_ASSOC);
	}

    
    function getUsers($connection) {
    	$sqli = "SELECT u.id, u.`name`, u.password, `email` FROM users u WHERE u.id = 3";
    	$res = mysqli_query($connection, $sqli);

    	if (!$res) {
    		got_sqli_error($connection);
    	}

    	return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }


    // задание 3 урок 2  работаем с датой 
    function hoursBeforeDataTask(?string $val): int {
        $sec_in_hour = 3600;
        $end_ts = strtotime($val);
        $ts_diff = $end_ts - time();
        $hours = floor($ts_diff / $sec_in_hour);

        return $hours;
    }
     

	//после отправки формы, заполненные поля не должны очищаться
	function getPostVal($name) {

	    return filter_input(INPUT_POST, $name);
	}


    //проверка заполненности поля
	function checkNameTask($name) {
	    if (empty($_POST[$name])) {

	        return "Заполните имя задачи";
	    }
	
        //return $name;
	}   


	// функция валидации проектов
	function validateProject($id, $allowed_list) {
	    if (!in_array($id, $allowed_list)) {
	    	
	        return "Указан несуществующий проект";
	    }

	    return null;
	}


    //дата выполнения задачи должна быть больше или равна текущей дате.
    function checkCurrentDate($date) {
        $current_date = date(Y.m.d);
        $dt_term = $_POST("date");
        if ($current_date > $dt_term) {

            return "Дата должна быть больше или равна текущей";	
        } 

        return NULL;
    }

    