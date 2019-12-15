<?php	

include_once("init.php");

foreach ($_SESSION as $session) {
        $user_id = $session["id"];   
} 

$sql = "SELECT `id`, status, `name`, link, dt_term, user_id, project_id FROM tasks WHERE user_id = '$user_id'";
$res = mysqli_query($con, $sql)
 
if ($res) {
    $tasks = mysqli_fetch_all($res, MYSQLI_ASSOC);
}
else {
	gotSqliError($con);
}
 $name_task = [];

//mysqli_query($link, 'CREATE FULLTEXT INDEX gif_ft_search ON gifs(title, description)');

$search = $_GET["q"] ?? '';
$search = htmlspecialchars($search);
$search = trim($search);

if ($search) {
	$sql = "SELECT name, link, dt_term FROM tasks
	WHERE MATCH(name) AGAINST(?)";



	
}

?>	