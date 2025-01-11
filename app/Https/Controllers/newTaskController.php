<?php
require_once(__DIR__ . '/../../Models/Tasks.php');
require_once(__DIR__ . '/../../Models/Status.php');

$taskName = $_POST['task_name'];
$description = $_POST['task_description'];
$deadline = $_POST['task_deadline'];

$task = new Tasks(Tasks::getNewId());

$task->setTask($taskName);
$task->setDescription($description);
$task->setDeadline($deadline);
$task->setStatus(Status::NotStarted);

$task->save();
header("Location: ../../../public/index.php");

exit();
