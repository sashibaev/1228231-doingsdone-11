 <?php
        
    include_once("init.php");

    $show_complete_tasks = rand(0, 1);

    foreach ($users as $user) {
        $user_name = $user["name"];
    }

    if (isset($_GET["id"])) {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $sql = "SELECT id, date_created, status, `name`, link, dt_term, user_id, project_id FROM tasks WHERE project_id = ?";
        if ($statement = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($statement, "i", $id);
        } else {
            gotSqliError($con);
        }

        $is_project_exists = false;

        foreach ($projects as $project) {
            if ($project["id"] === $id) {
                $is_project_exists = true;
                break;
            }
        }

        if (!$is_project_exists) {
            header("HTTP/1.0 404 Not Found");
            print "Проект не найден";
            die();
        }

    } else {
        $sql = "SELECT id, date_created, status, name, link, dt_term, user_id, project_id FROM tasks WHERE user_id = 3";
        $statement = mysqli_prepare($con, $sql);
    }

    if ($statement !== false) {
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        gotSqliError($con);
    }

    $page_content = include_template("main.php", [
        "projects" => $projects,
        "tasks" => $tasks,
        "show_complete_tasks" => $show_complete_tasks,
    ]);

    $anonym_header = include_template("anonym_header.php", []);

    $auth_user_header = include_template("auth_user_header.php", [
        "user_name" => $user_name
    ]); 

    $header = include_template("header.php", [
        "anonym_header" => $anonym_header,
        "auth_user_header" => $auth_user_header
    ]);

    $add_task_footer = include_template("add_task_footer.php", []);

    $footer = include_template("footer.php", [
        "add_task_footer" => $add_task_footer
    ]);

    $layout_content = include_template("layout.php", [
        "header" => $header,
        "content" => $page_content,
        "footer" => $footer,
        "user_name" => $user_name,
        "title" => "Дела в порядке"
    ]);

    print($layout_content);

?>
