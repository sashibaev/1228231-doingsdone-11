<?php

include_once("init.php");

foreach ($_SESSION as $session) {
    $user_id = $session["id"];  
}

$projects = getProjects($con, $user_id);
        
$projects_ids = array_column($projects, "id");

$name = $project_id = $dt_term = "0";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $required_fields = ["name", "project_id"]; // Список обязательных полей
    $errors = []; // массив ошибок

    $rules = [
        "project_id" => function($value) use ($projects_ids) {
            return validateProject($value, $projects_ids);
        },

        "date" => function($date) {
            return is_date_valid("date"); 
        },
            
        "date" => function($date) {
            return checkCurrentDate("value");
        },    

        "name" => function($name) {
            return checkNameTask("name");
        }
    ];

    $task = filter_input_array(INPUT_POST,
        [
            "name" => FILTER_DEFAULT,
            "project_id" => FILTER_DEFAULT,
            "date" => FILTER_DEFAULT,
            "link" => FILTER_DEFAULT
        ], true);

    foreach ($task as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key] = $rule($value);
        } 
        elseif (in_array($key, $required_fields) && empty($value)) {
            $errors[$key] = "Поле" . $key ."надо заполнить";
        }
    }
    //Удаление пустых значений,оставили только значения об ошибках
    $errors = array_filter($errors);

    if (count($errors)) {
        $page_content = include_template("form_task.php",
             [
                "projects" => $projects,
                "errors" => $errors,
                "task" =>$task
            ]);
    } 
    else {
        $link = NULL;

        if (!empty($_FILES["file"]["name"])) {
            $file_name = $_FILES["file"]["name"];
            $tmp_name = $_FILES["file"]["tmp_name"];
            $link = "uploads/" . $file_name;

            move_uploaded_file($tmp_name, "uploads/" . $file_name);
        }
           
        $project_id = $_POST["project_id"];
        $title = $_POST["name"];
        $dt_term = $_POST["date"];
        $user_id = $_SESSION["id"];
            
        $sqli = "INSERT INTO tasks (date_created, status, name, dt_term, user_id, project_id, link) VALUES (NOW(), 0, '$title', '$dt_term', '$user_id', '$project_id', '$link')";

        $result = mysqli_query($con, $sqli);

        if (!$result) {
            $error = mysqli_error($con);
            print("Ошибка MySQL: " . $error);
        } 
        else {
            header("Location:/index.php");
            exit();
        }

        $content_auth = include_template("form_task.php", [
            "projects" => $projects
        ]); 
    }
} 
else {
    $content_auth = include_template("form_task.php", [
    "projects" => $projects
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
