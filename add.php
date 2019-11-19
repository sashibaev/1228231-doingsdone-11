<?php
    include_once("helpers.php");

    $con = get_database_connection();

    $projects  = get_projects($con);


    

    $form_content = include_template("form-task.php", [
        "projects" => $projects,  
        "user_name" => "Sergey",
        "title" => "Добавление задачи"
    ]);


    print($form_content);
?>  
