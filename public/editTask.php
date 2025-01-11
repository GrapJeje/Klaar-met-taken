<?php
require_once(__DIR__ . '/../app/Models/Tasks.php');

class editTask
{
    public $task;

    public function set($id)
    {
        if (isset($_GET['task_id'])) {
            $id = $_GET['task_id'];
        }

        $task = new Tasks($id);
        $this->task = $task;
    }

    public function getTask()
    {
        return $this->task;
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taak Bewerken</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/editTask.css">
</head>

<body>
    <?php echo realpath(__DIR__ . '/../../../config/php/config.php'); ?>
    <header>
        <h1>Taak Bewerken</h1>
    </header>

    <?php
    $editTask = new editTask();
    $taskFound = false;
    if (isset($_GET['task_id'])) {
        $editTask->set($_GET['task_id']);

        if (
            $editTask->getTask()->task == null && $editTask->getTask()->description == null
            && $editTask->getTask()->deadline == null && $editTask->getTask()->status == null
        ) {
            $taskFound = false;
        } else {
            $taskFound = true;
        }
    }
    ?>

    <main class="container">
        <?php if ($taskFound) { ?>
            <!-- Formulier om taak te bewerken -->
            <div class="form-section">
                <h2>Taak Bewerken</h2>
                <form action="../app/Https/Controllers/saveEditTaskController.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="task_id" id="task_id" value="<?php echo $editTask->getTask()->id; ?>" placeholder="ID">
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="task_status" id="task_status" value="<?php echo $editTask->getTask()->status; ?>" placeholder="Status">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="task_name">Naam van de taak</label>
                            <input type="text" name="task_name" id="task_name" value="<?php echo $editTask->getTask()->task; ?>" placeholder="Naam van de taak" required>
                        </div>

                        <div class="form-group">
                            <label for="task_description">Beschrijving</label>
                            <input type="text" name="task_description" id="task_description" value="<?php echo $editTask->getTask()->description; ?>" placeholder="Beschrijving" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="task_deadline">Deadline</label>
                            <input type="date" name="task_deadline" id="task_deadline" value="<?php echo $editTask->getTask()->deadline; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="task_status">Status</label>
                            <select name="task_status" id="task_status" required>
                                <option value="NotStarted" <?php echo ($editTask->getTask()->status === 'NotStarted' ? 'selected' : ''); ?>>Niet gestart</option>
                                <option value="InProgress" <?php echo ($editTask->getTask()->status === 'InProgress' ? 'selected' : ''); ?>>In uitvoering</option>
                                <option value="Completed" <?php echo ($editTask->getTask()->status === 'Completed' ? 'selected' : ''); ?>>Voltooid</option>
                                <option value="OnHold" <?php echo ($editTask->getTask()->status === 'OnHold' ? 'selected' : ''); ?>>In de wacht</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" name="action" value="edit">Bewerken</button>
                </form>
            </div>

            <div class="back-button">
                <a href="../public/index.php"><button type="button">Terug naar Overzicht</button></a>
            </div>

        <?php } else { ?>
            <div class="task-not-found">
                <p><strong>Taak niet gevonden</strong></p>
                <p>De taak die je probeert te bewerken bestaat niet. Controleer de gegevens en probeer het opnieuw.</p>
                <div class="back-button">
                    <a href="../public/index.php"><button type="button">Terug naar Overzicht</button></a>
                </div>
            </div>
        <?php } ?>
    </main>

    <?php echo realpath(__DIR__ . '/../../../config/php/footer.php'); ?>
</body>

</html>