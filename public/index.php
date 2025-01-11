<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klaar met taken</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <?php 
        require_once('../../../../config/php/config.php');
        require_once __DIR__ . '/../vendor/autoload.php';
    ?>

    <header>
        <h1>Klaar met taken</h1>
        <p>Beheer je taken moeiteloos!</p>
    </header>
    <main>
        <section class="task-list">
            <h2>Mijn Taken</h2>
            <?php
                require_once('../app/Models/Tasks.php');
                require_once('../app/Https/Controllers/tasksController.php');

                TasksController::showTasks();
            ?>
        </section>

        <section class="add-task">
            <h2>Nieuwe taak toevoegen</h2>
            <form action="../app/Https/Controllers/newTaskController.php" method="POST">
                <input type="text" name="task_name" placeholder="Taaknaam" required>
                <textarea name="task_description" placeholder="Beschrijving" rows="4"></textarea>
                <input type="date" name="task_deadline" required>
                <button type="submit">Taak toevoegen</button>
            </form>
        </section>
    </main>

    <?php require_once('../../../../config/php/footer.php'); ?>
</body>

</html>