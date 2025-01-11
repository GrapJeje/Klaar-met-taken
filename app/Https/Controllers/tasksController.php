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

        if (!empty($tasks)) {
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
                                <select name=\"task_status\" class=\"status-dropdown\">
                                    <option value=\"NotStarted\" " . ($task['status'] === 'NotStarted' ? 'selected' : '') . ">Niet gestart</option>
                                    <option value=\"InProgress\" " . ($task['status'] === 'InProgress' ? 'selected' : '') . ">In uitvoering</option>
                                    <option value=\"Completed\" " . ($task['status'] === 'Completed' ? 'selected' : '') . ">Voltooid</option>
                                    <option value=\"OnHold\" " . ($task['status'] === 'OnHold' ? 'selected' : '') . ">In de wacht</option>
                                </select>
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

    public static function newTask() {}
}
