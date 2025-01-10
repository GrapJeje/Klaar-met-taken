<?php

class TasksController
{
    public static function showTasks()
    {
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

        if (!empty($products)) {
            foreach ($tasks as $task) {
                echo "
                    <tr>
                        <td>{$task['task']}</td>
                        <td>{$task['description']}</td>
                        <td>{$task['deadline']}</td>
                        <td>{$task['status']}</td>
                        <td>
                            <form method=\"POST\" action=\"../app/Http/Controllers/editProductController.php\" class=\"action-buttons-form\">
                                <input type=\"hidden\" name=\"product_id\" value=\"{$task['id']}\">
                                <button type=\"submit\" name=\"action\" value=\"complete\" class=\"complete-btn\">Voltooien</button>
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

    public static function newTask()
    {
        
    }
}
