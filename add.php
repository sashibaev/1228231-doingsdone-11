<?php
    include_once("helpers.php");
    include_once("functions.php");

    $con = getDatabaseConnection();

    $projects  = getProjects($con);
    $projects_ids = array_column($projects, "id");

    
  
    $page_content = include_template("form-task.php", [
        "projects" => $projects
    ]);

    $layout_content = include_template("layout.php", [
        "content" => $page_content,
        "user_name" => "Sergey",
        "title" => "Добавление задачи"
    ]);


    print($layout_content); 

?>  
