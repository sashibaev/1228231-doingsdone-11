<?php
    include_once("helpers.php");
    include_once("functions.php");

    $con = getDatabaseConnection();

    $projects  = getProjects($con);

    $users = getUsers($con);

    $user_name = username($users);

    $projects_ids = array_column($projects, "id");
    
    $name = $project_id = $dt_term = $date = "0";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $required_fields = ["name", "project_id"]; // Список обязательных полей
        $errors = []; // массив ошибок
       
         // echo($_POST["name"] . $_POST["project"] . $_POST["date"]);
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
                        
            "name" => function($value) {
                return isCorrectLength("name", 5, 200);               
            }
        ];

        $tasks = filter_input_array(INPUT_POST, 
            [
                "name" => FILTER_DEFAULT,
                "project_id" => FILTER_DEFAULT, 
                "date" => FILTER_DEFAULT,
            ], true);


        foreach ($tasks as $key => $value) {
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
                    "errors" => $errors                    
                ]);
        }
        /*else {

            if (!empty($_FILES["file"])) {
            $file_name = $_FILES["file"]["name"];
            $file_path = __DIR__ . "/uploads/";
            $file_url = "uploads/" . $file_name;
            
            move_uploaded_file($_FILES["file"]["tmp_name"], $file_path . $file_name);
            $tasks["file"] = $file_name;
            }
        
            $sql = "INSERT INTO task (status, name, link, dt_term, user_id,project_id, ) VALUES (NOW(), 0, ?, ?, ?, 3, ?)";
            $stmt = db_get_prepare_stmt($con, $sql, $task);
            $res = mysqli_stmt_execute($stmt);

            if ($res) {
                $task_id = mysqli_insert_id($con);

                $header("Location: index.php");
                //$header("Location:/index.php?success=true");
            }    
        }*/
    }
    
    else {
        $page_content = include_template("form_task.php", [
        "projects" => $projects
        ]);
    }
    

    $layout_content = include_template("layout.php", [
        "content" => $page_content,
        "user_name" => $user_name,
        "title" => "Добавление задачи"
    ]);


    print($layout_content); 

?>  
