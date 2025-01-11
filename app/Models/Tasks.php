<?php

use League\Csv\Writer;

class Tasks
{
    public $id;
    public $task;
    public $description;
    public $deadline;
    public $status;

    public function __construct($id)
    {
        $this->id = $id;
        $task = self::getTaskById($id);

        if ($task) {
            $this->task = $task['task'];
            $this->description = $task['description'];
            $this->deadline = $task['deadline'];
            $this->status = $task['status'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDeadline()
    {
        return $this->deadline;
    }

    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function save()
    {
        require_once __DIR__ . '/../../vendor/autoload.php';

        $newTask = [
            "{$this->getId()}",
            "{$this->getTask()}",
            "{$this->getDescription()}",
            "{$this->getDeadline()}",
            "{$this->getStatus()->name}"
        ];

        $csvFilePath = __DIR__ . '/../../data/Tasks.csv';

        $csv = Writer::createFromPath($csvFilePath, 'a');
        $csv->insertOne($newTask);
    }


    public static function getNewId()
    {
        $tasks = self::getTasks();
        $id = 0;

        foreach ($tasks as $task) {
            if ($task['id'] > $id) {
                $id = $task['id'];
            }
        }

        return $id + 1;
    }

    public static function getTaskById($id)
    {
        $tasks = self::getTasks();

        foreach ($tasks as $task) {
            if ($task['id'] == $id) {
                return $task;
            }
        }

        return null;
    }

    public static function deleteTask($id)
    {
        $task = new Tasks($id);
        $task->setId(null);
        $task->setTask(null);
        $task->setDescription(null);
        $task->setDeadline(null);
        $task->setStatus(null);

        $task->save();
    }

    public static function getTasks()
    {
        $tasks = [];
        $file = fopen(__DIR__ . "/../../data/Tasks.csv", "r");

        if ($file !== false) {
            fgetcsv($file);

            while (($row = fgetcsv($file)) !== false) {
                $tasks[] = [
                    'id' => $row[0],
                    'task' => $row[1],
                    'description' => $row[2],
                    'deadline' => $row[3],
                    'status' => $row[4],
                ];
            }

            fclose($file);
        } else {
            echo "<script>console.error('Het bestand \"tasks.csv\" kon niet worden geopend.');</script>";
        }
        return $tasks;
    }
}
