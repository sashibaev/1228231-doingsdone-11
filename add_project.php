<?php

include_once("init.php");

foreach ($_SESSION as $session) {
    $user_id = $session["id"];  
}

$projects = getProjects($con, $user_id);




$content_project = include_template("content_project.php", [
    "projects" => $projects
]);
        
$content_auth = include_template("form_project.php", [
    "content_project" => $content_project
]); 

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
