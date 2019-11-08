 <?php
    include("helpers.php");
 
    $show_complete_tasks = rand(0, 1);
  
    $project_categories = ["Входящие" , "Учеба" , "Работа" , "Домашние дела" , "Авто"];     
                     
    $tasks = [
        [
            "task" => "Собеседование в IT компании",
            "completion_date" => "01.12.2019",
            "category" => "Работа",
            "is_completed" => false
        ],
        [
                                        
            "task" => "Выполнить тестовое задание",
            "completion_date" => "25.12.2019",
            "category" => "Работа",
            "is_completed" => false
        ],
        [

            "task" => "Сделать задание первого раздела",
            "completion_date" => "21.12.2019",
            "category" => "Учеба",
            "is_completed" => true
        ],
        [

            "task" => "Встреча с другом",
            "completion_date" => "22.12.2019",
            "category" => "Входящие",
            "is_completed" => false
        ],
        [ 

            "task" => "Купить корм для кота",
            "completion_date" => null,
            "category" => "Домашние дела",
            "is_completed" => false
        ],
        [

            "task" => "Заказать пиццу",
            "completion_date" => null,
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
                 
    // задание 3 урок 2  работаем с датой
    function hours_before_data_task(?string $val): int {      
        $sec_in_hour = 3600;         
        $end_ts = strtotime($val);       
        $ts_diff = $end_ts - time();
        $hours = floor($ts_diff / $sec_in_hour);                       
        return $hours; 
    }
    
    
    $page_content = include_template("main.php", [
        "project_categories" => $project_categories, 
        "tasks" => $tasks,
        "show_complete_tasks" => $show_complete_tasks
    ]);
    
    $layout_content = include_template("layout.php", [
        "content" => $page_content,
        "user_name" => "Константин",
        "title" => "Дела в порядке"
    ]);

    print($layout_content);  

?>                      

                        
                    