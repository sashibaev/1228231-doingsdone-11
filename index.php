 <?php
    include("helpers.php");


    $show_complete_tasks = rand(0, 1);

    $con = get_database_connection();

    $projects  = get_projects($con);

    if (isset($_GET["id"])) {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $sql = "SELECT id, date_created, status, `name`, link, dt_term, user_id, project_id FROM tasks WHERE project_id = ?";
        if ($statement = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($statement, 'i', $id);
        } else {
            got_sql_error($con);
        }

        $is_project_exists = false;

        foreach ($projects as $project) {
            if ($project['id'] === $id) {
                $is_project_exists = true;
                break;
            }
        }

        if (!$is_project_exists) {
            header("HTTP/1.0 404 Not Found");
            print 'Проект не найден';
            die();
        }

    } else {
        $sql = "SELECT id, date_created, status, name, link, dt_term, user_id, project_id FROM tasks";
        $statement = mysqli_prepare($con, $sql);
    }

    if ($statement !== false) {
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        got_sql_error($con);
    }

    function got_sql_error($connection) {
        $error = mysqli_error($connection);
        printf("Ошибка MySQL: ". $error);
        exit();
    }

    // задание 3 урок 2  работаем с датой
    function hours_before_data_task(?string $val): int {
        $sec_in_hour = 3600;
        $end_ts = strtotime($val);
        $ts_diff = $end_ts - time();
        $hours = floor($ts_diff / $sec_in_hour);
        return $hours;
    }

    $page_content = include_template("main.php", [
        "projects" => $projects,
        "tasks" => $tasks,
        "show_complete_tasks" => $show_complete_tasks,
    ]);

    $layout_content = include_template("layout.php", [
        "content" => $page_content,
        "user_name" => "Sergey",
        "title" => "Дела в порядке"
    ]);


    print($layout_content);

?>
