<?php

include_once("init.php");

$errors = [];
$form = $_POST;
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   	$required_fields = ["email", "password"];
    
    $form = filter_input_array(INPUT_POST,
            [
                "email" => FILTER_DEFAULT,
                "password" => FILTER_DEFAULT,
            ], true);  

    foreach ($required_fields as $field) {
        if (empty($form[$field])) {
        	$errors[$field] = "Не заполнено поле " . $field;
        }
    }  
            $email = mysqli_real_escape_string($con, $form["email"]);
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $res = mysqli_query($con, $sql);

            $user =$res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

            if (!count($errors) and $user) {
                if (password_verify($form["password"], $user["password"])) 
                {
                	$_SESSION["user"] = $user;
                }
                else {
                	$errors["password"] = "Неверный пароль";
                }
            }
            else {
                $errors["email"] = "Такой пользователь не найден";
            }
        
        if (empty($errors)) {
            //var_dump($_SESSION);
    	    header("Location: /index.php");
    	    exit();
        }
}  
else {
    
	if (isset($_SESSION["user"])) {
		header("Location: /index.php");
		exit();
	}
}
$content_side = include_template("content_side.php", []);

$content_guest = include_template("form_auth.php", [
    "form" => $form,
    "errors" => $errors,
    "content_side" => $content_side
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
    "title" => "Авторизация пользователя"
]);
    

print($layout_content);

?> 