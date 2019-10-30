 <?php

    $project_categories = ["Входящие" , "Учеба" , "Работа" , "Домашние дела" , "Авто"];     

                        
    $tasks = [
        [
            "task" => "Собеседование в IT компании",
            "complition_date" => "01.12.2019",
            "category" => "Работа",
            "is_completed" => false
        ],
        [
                                        
            "task" => "Выполнить тестовое задание",
            "complition_date" => "25.12.2019",
            "category" => "Работа",
            "is_completed" => false
        ],
        [

            "task" => "Сделать задание первого раздела",
            "complition_date" => "21.12.2019",
            "category" => "Учеба",
            "is_completed" => true
        ],
        [

            "task" => "Встреча с другом",
            "complition_date" => "22.12.2019",
            "category" => "Входящие",
            "is_completed" => false
        ],
        [ 

            "task" => "Купить корм для кота",
            "complition_date" => null,
            "category" => "Домашние дела",
            "is_completed" => false
        ],
        [

            "task" => "Заказать пиццу",
            "complition_date" => null,
            "category" => "Домашние дела",
            "is_completed" => false
        ]  
    ];                        

                         
    function get_count_of_task(array $tasks, string $project_name): int { 
        $count = 0;  
            foreach ($tasks as $task) {
                if ($task["category"] === $project_name) {
                    $count++;
                }                                                                                       
            } 
        return $count;                                        
    } 
                 
 

    $page_content = include_template("templates/main.php", [
        "project_name" => $project_name, 
        "task" => $task
    ]);
    
    $layout_content = include_template("templates/layout.php", [
        "content" => $page_content,
        "Константин" => "Константин",
        "title" => "Дела в порядке"
    ]);

    print($layout_content);  

?>                      

                        
                    