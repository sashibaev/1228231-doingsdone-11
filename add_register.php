<?php
   
    session_start();

    include_once("helpers.php");
    include_once("functions.php");

    $con = getDatabaseConnection();
    
    $email = $password = $name = "0";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $required_fields = ["email", "password", "name"];
        $errors = []; 

        $fields = filter_input_array(INPUT_POST,
            [
                "email" => FILTER_DEFAULT,
                "password" => FILTER_DEFAULT,
                "name" => FILTER_DEFAULT,
            ], true);  

        foreach ($required_fields as $field) {
        	if (empty($fields[$field])) {
        		$errors[$field] = "Не заполнено поле " . $field;
        	}
        	
        	if ($field == "email") {
        	    if (!filter_var($fields[$field], FILTER_VALIDATE_EMAIL)) {
        		    $errors[$field] = "Email должен быть корректным";
        		}
        	}

        	if ($field == "password") {
                $len = strlen($fields[$field]);

                if ($len < 8 or $len > 20) {
                    $errors[$field] = "Длина пароля должна быть от 8 до 20 символов";
                }
            }
        }
        
        //проверка существования пользователя с email из формы
    	if (empty($errors)) {
    		$email = mysqli_real_escape_string($con, $fields["email"]);
    		$sqli = "SELECT id FROM users WHERE email = '$email'";
    		$res = mysqli_query($con, $sqli);

    		if (mysqli_num_rows($res) > 0) {
    			$errors["email"] = "Пользователь с этим email уже зарегистрирован";
    		}
            else {

            	//преобразование пароля в хеш
            	$password = password_hash($fields["password"], PASSWORD_DEFAULT);

                //добавление нового пользователя в базу
            	$sqli = "INSERT INTO users (dt_add, email, name, password) VALUES (NOW(), ?, ?, ?)";
            	$stmt = db_get_prepare_stmt($con, $sqli, [$fields["email"], $fields["name"], $password]);
            	$result = mysqli_stmt_execute($stmt);

            	if ($result && empty($errors)) {
                    header("Location: http://1228231-doingsdone-11/");
                    exit();
                }
            }

    	} else {
        
	        //передаем в шаблон список ошибок и данные из формы
	    	$form_register = include_template("form_register.php", [	
	    	    "errors" => $errors,
	    	    "fields" => $fields,
	            "title" => "Регистрация пользователя"
	        ]);
        }

    } else {
        $form_register = include_template("form_register.php", [
            "title" => "Регистрация пользователя"
        ]);
    }

    print($form_register);

?>