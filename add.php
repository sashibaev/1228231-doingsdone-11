<?php
    include_once("helpers.php");
    include_once("functions.php");
    include_once("init.php");

    $projects  = getProjects($con);

    $users = getUsers($con);

    foreach ($users as $user) {
        $user_name = $user["name"];
    }

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
            } elseif (in_array($key, $required_fields) && empty($value)) {
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

        } else {
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
            
            $sqli = "INSERT INTO tasks (date_created, status, name, dt_term, user_id, project_id, link) VALUES (NOW(), 0, '$title', '$dt_term', 3, '$project_id', '$link')";

            $result = mysqli_query($con, $sqli);

            if (!$result) {
                $error = mysqli_error($con);
                print("Ошибка MySQL: " . $error);

            } else {
                header("Location: http://1228231-doingsdone-11/");
                exit();
            }

            $page_content = include_template("form_task.php", [
                   "projects" => $projects
            ]); 
        }

    } else {
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
