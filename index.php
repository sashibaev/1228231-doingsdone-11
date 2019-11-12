 <?php
    include("helpers.php");

    $show_complete_tasks = rand(0, 1);

    $con = mysqli_connect("localhost", "root", "", "affairs_ok" );
     if($con === false) {
        printf("Соединение не установлено",mysqli_connect_error());
        exit();
    }
    mysqli_set_charset($con, "utf8");

    $sql = "SELECT id, name FROM projects";
    $res = mysqli_query($con, $sql);

    if (!$res) {
        $error = mysqli_error($con);
        printf("Ошибка MySQL: ". $error);
    }

    $projects = mysqli_fetch_all($res, MYSQLI_ASSOC);

    //Для каждого пункта с названием проекта сформировать адрес ссылки, имя сценария и параметр запроса равного идентификатору проекта
    $params = $_GET;
    $scriptname = pathinfo(__FILE__, PATHINFO_BASENAME);
    $query = http_build_query($params);
    $url = "/" . $scriptname . "?";


    $sql = "SELECT id, date_created, status, name, link, dt_term, user_id, project_id FROM tasks";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        $error = mysqli_error($con);
        printf("Ошибка MySQL: ". $error);
    }

    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);


    function get_count_of_task(array $tasks, $project_name): int {
        $count = 0;
        foreach ($tasks as $task) {
            if ($task["project_id"] === $project_name["id"]) {
                $count++;
            }
        }
        return $count;
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
        "url" => $url
    ]);

    $layout_content = include_template("layout.php", [
        "content" => $page_content,
        "user_name" => "Sergey",
        "title" => "Дела в порядке"
    ]);



    print($layout_content);

?>


