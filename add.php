<?php
    include_once("helpers.php");
    include_once("functions.php");

    $con = getDatabaseConnection();

    $projects  = getProjects($con);

    $users = getUsers($con);

    $user_name = username($users);

    $projects_ids = array_column($projects, "id");
    
    $name = $project_id = $date = "0";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $required_fields = ["name", "project_id"]; // Список обязательных полей
        $errors = []; // массив ошибок
       
        $rules = [
            "project_id" => function($value) use ($projects_ids) {
                return validateProject($value, $projects_ids); 
            },   
            
            "date" => function($value) {
                return is_date_valid("date");               
            },

            "date" => function($value) {
                return checkCurrentDate("date");
            },
                        
            "name" => function($name) {
                return checkNameTask("name");               
            }
        ];

        $task = filter_input_array(INPUT_POST, 
            [
                "name" => FILTER_DEFAULT,
                "project_id" => FILTER_DEFAULT, 
                "date" => FILTER_DEFAULT
            ], true);


        foreach ($task as $key => $value) {
            if (isset($rules[$key])) {
                $rule = $rules[$key];
                $errors[$key] = $rule($value);
            }elseif (in_array($key, $required_fields) && empty($value)) {
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

            if (!empty($_FILES["file"]["name"])) {
                $file_name = $_FILES["file"]["name"];
                $tmp_name = $_FILES["file"]["tmp_name"];
                $link = "uploads\ . $file_name";
            
                move_uploaded_file($tmp_name, $link);
                //var_dump($task);
            }
            else{ 
                $link = "";
                 //var_dump($task);
            }
            $task["link"] = $link; 
            $task["project_id"] = (int) $task["project_id"]; 
             var_dump($task);
            
            $sqli = "INSERT INTO tasks (date_created, status, name, link, dt_term, user_id, project_id) VALUES (NOW(), 0, ?, ?, ?, 3, ?)";
            $stmt = db_get_prepare_stmt($con, $sqli, $task);
            $res = mysqli_stmt_execute($stmt);
           
            if (!$res) {
                $error = mysqli_error($con);
                print("Ошибка MySQL: " . $error);

                $page_content = include_template("form_task.php", [
                   "projects" => $projects
                ]); 

            } else {
                header("Location: index.php");
            }                
        }
    }
    else {
    $page_content = include_template("form_task.php", [
        "projects" => $projects
    ]);
    }
    
   /* $page_content = include_template("form_task.php", [
        "projects" => $projects
    ]);*/

    $layout_content = include_template("layout.php", [
        "content" => $page_content,
        "user_name" => $user_name,
        "title" => "Добавление задачи"
    ]);


    print($layout_content); 

?>  
