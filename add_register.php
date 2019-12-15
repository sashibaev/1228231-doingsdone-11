<?php

include_once("init.php");
    
$errors = [];
$form = $_POST;
   
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $required_fields = ["email", "password", "name"];

    $form = filter_input_array(INPUT_POST,
        [
            "email" => FILTER_DEFAULT,
            "password" => FILTER_DEFAULT,
            "name" => FILTER_DEFAULT,
        ], true);  

    foreach ($required_fields as $field) {

        if (empty($form[$field])) {
        	$errors[$field] = "Не заполнено поле " . $field;
        }
        else {        
            foreach ($form as $field => $value) {
                //Проверка корректности email	
                if ($field == "email") {

                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    	$errors["email"] = "Email должен быть корректным";
                    }
                }
                //Проверка длины пароля, от 8 символов до 20 символов 
                if ($field == "password") {
                    $len = strlen($value);

                    if ($len < 8 or $len > 20) {
                        $errors["password"] = "Длина пароля должна быть от 8 до 20 символов";
                    }
                }
            }   
        } 
    }
    //проверка существования пользователя с email из формы
    if (empty($errors)) {
    	$email = mysqli_real_escape_string($con, $form["email"]);
    	$sql = "SELECT id FROM users WHERE email = '$email'";
    	$res = mysqli_query($con, $sql);

    	if (mysqli_num_rows($res) > 0) {
    		$errors["email"] = "Пользователь с этим email уже зарегистрирован";
    	}
        else {
            //преобразование пароля в хеш
            $password = password_hash($form["password"], PASSWORD_DEFAULT);
            //добавление нового пользователя в базу
            $sqli = "INSERT INTO users (dt_add, email, name, password) VALUES (NOW(), ?, ?, ?)";
            $stmt = db_get_prepare_stmt($con, $sqli, [$form["email"], $form["name"], $password]);
            $result = mysqli_stmt_execute($stmt);
        }

        if ($result && empty($errors)) {
            header("Location:/index.php");
            exit();
        }
    }
} 
    
$content_side = include_template("content_side.php", []);

$content_guest = include_template("form_register.php", [
    "content_side" => $content_side,
    "errors" => $errors,
    "form" => $form,
]);    

$anonym_header = include_template("anonym_header.php", []);

$header = include_template("header.php", [
    "anonym_header" => $anonym_header
]);

$footer = include_template("footer.php", [
    "add_task_footer" => ""
]);

$layout_content = include_template("layout.php", [
    "header" => $header,
    "content_guest" => $content_guest,
    "footer" => $footer,
    "title" => "Регистрация пользователя"
]);
    
print($layout_content);

?>