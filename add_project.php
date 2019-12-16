<?php

include_once("init.php");

foreach ($_SESSION as $session) {
    $user_id = $session["id"];  
}

$projects = getProjects($con, $user_id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $required_fields = ["name"]; // Список обязательных полей
    $errors = []; // массив ошибок

    $form = filter_input_array(INPUT_POST,
            [
                "name" => FILTER_DEFAULT,
            ], true);

    if (isset($_SESSION["user"])) {
		
	    foreach ($required_fields as $field) {

	        if (empty($form[$field])) {
	        	$errors[$field] = "Не заполнено поле " . $field;
	        }
		}        

	    if (empty($errors)) {
	    	$name = mysqli_real_escape_string($con, $form["name"]);
	    	$sql = "SELECT id FROM projects WHERE name = '$name'";
	    	$res = mysqli_query($con, $sql);

	    	if (mysqli_num_rows($res) > 0) {
	    		$errors["name"] = "Проект с таким именем уже существует";
	    	}	
    	}
    }	
    
    if (!empty($errors)) {
    	$content_project = include_template("content_project.php", [
           "projects" => $projects
        ]);
        
        $content_auth = include_template("form_project.php", [
           "content_project" => $content_project,
           "errors" => $errors
        ]); 
    }
    else {
        //добавление нового проекта в базу
        $sqli = "INSERT INTO projects (`name`, user_id) VALUES (?, ?)";
        $stmt = db_get_prepare_stmt($con, $sqli, [$form["name"], $user_id]);
        $res = mysqli_stmt_execute($stmt);
           
	    if ($res && empty($errors)) {
	        header("Location:/index.php");
	        exit();
	    }
    }                     
}
else {
	$content_project = include_template("content_project.php", [
        "projects" => $projects
    ]);
        
	$content_auth = include_template("form_project.php", [
	    "content_project" => $content_project
	]); 
}

$auth_user_header = include_template("auth_user_header.php", []); 

$header = include_template("header.php", [
    "auth_user_header" => $auth_user_header
]);

$add_task_footer = include_template("add_task_footer.php", []);

$footer = include_template("footer.php", [
    "add_task_footer" => $add_task_footer
]);

$layout_content = include_template("layout.php", [
    "header" => $header,
    "content_auth" => $content_auth,
    "footer" => $footer,
    "title" => "Добавление задачи"
]);

print($layout_content);

?>
