<?php
require_once(__DIR__ . '/../../Models/Tasks.php');
require_once(__DIR__ . '/tasksController.php');

$taskName = $_POST['task_name'];
$description = $_POST['task_description'];
$deadline = $_POST['task_deadline'];

TasksController::newTask($taskName, $description, $deadline);
exit();
