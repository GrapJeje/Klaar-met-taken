<?php

class TasksController
{
    public static function showTasks()
    {
        require_once(__DIR__ . '/../../Models/Tasks.php');
        require_once(__DIR__ . '/../../Models/Status.php');
        $tasks = Tasks::getTasks();

        echo "
            <table>
                <thead>
                    <tr>
                        <th>Taak</th>
                        <th>Beschrijving</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
        ";

        if (!empty($tasks)) {
            foreach ($tasks as $task) {
                $deadline = date("d-m-Y", strtotime($task['deadline']));

                $status = $task['status'];
                $statusEnum = status::tryFrom($status);

                if ($statusEnum === null) {
                    $statusEnum = status::NotStarted;
                }

                echo "
                    <tr>
                        <td>{$task['task']}</td>
                        <td>{$task['description']}</td>
                        <td>{$deadline}</td>
                        <td>{$statusEnum->value}</td>
                        <td>
                            <form method=\"POST\" action=\"../app/Https/Controllers/editTaskController.php\" class=\"action-buttons-form\">
                                <input type=\"hidden\" name=\"task_id\" value=\"{$task['id']}\">
                                <button type=\"submit\" name=\"action\" value=\"edit\" class=\"edit-btn\">Bewerken</button>
                                <button type=\"submit\" name=\"action\" value=\"delete\" class=\"delete-btn\">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                    ";
            }
            echo "</tbody>";
        } else {
            echo "
                </tbody>
                    <tr><td colspan='5'>Geen tasks gevonden!</td></tr>
            ";
        }

        echo "
            </table>
        ";
    }

    public static function newTask($taskName, $description, $deadline)
    {
        require_once(__DIR__ . '/../../Models/Tasks.php');
        require_once(__DIR__ . '/../../Models/Status.php');
        $task = new Tasks(Tasks::getNewId());

        $task->setTask($taskName);
        $task->setDescription($description);
        $task->setDeadline($deadline);
        $task->setStatus(Status::NotStarted);

        $task->save();
        header("Location: ../../../public/index.php");
        exit;
    }

    public static function editTask($id)
    {
        require_once(__DIR__ . '/../../../public/editTask.php');
        $editTask = new editTask();
        $editTask->set($id);
    
        header("Location: ../../../public/editTask.php?task_id=" . urlencode($id));
        exit;
    }

    public static function saveEditTask($id, $task, $description, $deadline, $status) 
    {
        require_once(__DIR__ . '/../../Models/Tasks.php');
        $tasks = new Tasks($id);

        $tasks->setTask($task);
        $tasks->setDescription($description);
        $tasks->setDeadline($deadline);
        $tasks->setStatus($status);

        $tasks->save();
        header("Location: ../../../public/index.php");
        exit;
    }
}
