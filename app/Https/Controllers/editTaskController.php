<?php
require_once(__DIR__ . '../../../../../../../config/php/config.php');
require_once(__DIR__ . '/tasksController.php');
require_once(__DIR__ . '/../../Models/Tasks.php');

$action = $_POST['action'];
$id = $_POST['task_id'];
$task_status = $_POST['task_status'];

switch ($action) {
    case "edit":
        TasksController::editTask($id);
        break;
    case "delete":
        Tasks::deleteTask($id);
        header("Location " . __DIR__ . "/../../../public/index.php");
        break;
    case "NotStarted":
        //code block
        break;
    case "InProgress":
        //code block
        break;
    case "Completed":
        //code block
        break;
    case "OnHold":
        //code block
        break;
    default:
        header("Location " . __DIR__ . "/../../../public/index.php");
}

exit();
