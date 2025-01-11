<?php 

require_once(__DIR__ . '/tasksController.php');

$id = $_POST["task_id"];
$name = $_POST["task_name"];
$description = $_POST["task_description"];
$deadline = $_POST["task_deadline"];
$status = $_POST["task_status"];

TasksController::saveEditTask($id, $name, $description, $deadline, $status);
exit;
