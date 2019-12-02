 <?php
    include_once("helpers.php");
    include_once("functions.php");

    $show_complete_tasks = rand(0, 1);

    $con = getDatabaseConnection();

    $projects  = getProjects($con);

    $users = getUsers($con);

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

    $layout_content = include_template("layout.php", [
        "content" => $page_content,
        "user_name" => $user_name,
        "title" => "Дела в порядке"
    ]);

    print($layout_content);

?>
