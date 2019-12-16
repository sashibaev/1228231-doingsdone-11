<?php

include_once("init.php");

$show_complete_tasks = rand(0, 1);

$projects = $tasks = "0";

$search_error = "";
         
if (!empty($_SESSION)) {    
    foreach ($_SESSION as $session) {
        $user_id = $session["id"];   
    } 
    
    $projects = getProjects($con, $user_id);

    if (isset($_GET["id"])) {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $sql = "SELECT id, date_created, status, `name`, link, dt_term, user_id, project_id FROM tasks WHERE project_id = ? AND user_id = '$user_id'";

        if ($statement = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($statement, "i", $id);
        } 
        else {
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
    }
    else {
        $sql = "SELECT id, date_created, status, name, link, dt_term, user_id, project_id FROM tasks WHERE user_id = '$user_id'";
        $statement = mysqli_prepare($con, $sql);        
    }

    if ($statement !== false) {
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } 
    else {
        gotSqliError($con);
    }
}

if (isset($_GET["search"])) {
    $search = [];
    //Получим содержимое поискового запроса. Если поисковый запрос не задан, то присвоим пустую строку
    $search = $_GET["search"] ?? '';

    $search = trim($search);
    //поиск задач, если был задан поисковый запрос
    if ($search) {
        $sql = "SELECT status, name, link, dt_term FROM tasks WHERE MATCH (`name`) AGAINST('$search')";

        //$stmt = db_get_prepare_stmt($con, $sql [$search]);
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (!$tasks) {
            $search_error = "Ничего не найдено по вашему запросу";
        }  
    }
    else {
        gotSqliError($con);
    }
} 

$auth_user_header = include_template("auth_user_header.php", []);

$form_search = include_template("form_search.php", []);

$content_auth = include_template("main.php", [
        "form_search" => $form_search,
        "projects" => $projects,
        "tasks" => $tasks,
        "show_complete_tasks" => $show_complete_tasks,
        "search_error" => $search_error
    ]);       

$anonym_header = include_template("anonym_header.php", []);

$header = include_template("header.php", [
    "anonym_header" => $anonym_header,
    "auth_user_header" => $auth_user_header
]);

$content_guest = include_template("guest.php", []);
   
$add_task_footer = include_template("add_task_footer.php", []);

$footer = include_template("footer.php", [
    "add_task_footer" => $add_task_footer
]);

$layout_content = include_template("layout.php", [
    "header" => $header,
    "content_guest" => $content_guest,
    "content_auth" => $content_auth,
    "footer" => $footer,
    "title" => "Дела в порядке"
]);

print($layout_content);

?>
