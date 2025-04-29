<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "task"; // Change to your actual database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["insert"])) {
        insertTask($conn, $_POST["title"], isset($_POST["done"]));
    } elseif (isset($_POST["update"])) {
        updateTask($conn, $_POST["id"], $_POST["title"], isset($_POST["done"]));
    } elseif (isset($_POST["delete"])) {
        deleteTask($conn, $_POST["id"]);
    }
}

// Function to insert a new task
function insertTask($conn, $title, $done) {
    $sql = "INSERT INTO tasks (title, done) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $doneInt = $done ? 1 : 0;
    $stmt->bind_param("si", $title, $doneInt);

    if ($stmt->execute()) {
        echo "New task added successfully.<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

// Function to update a task
function updateTask($conn, $id, $title, $done) {
    $sql = "UPDATE tasks SET title = ?, done = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $doneInt = $done ? 1 : 0;
    $stmt->bind_param("sii", $title, $doneInt, $id);

    if ($stmt->execute()) {
        echo "Task updated successfully.<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

// Function to delete a task
function deleteTask($conn, $id) {
    $sql = "DELETE FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Task deleted successfully.<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

// Fetch tasks
$result = $conn->query("SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <style>
        body { font-family: Arial, sans-serif; }
        form { margin-bottom: 20px; }
        input, button { padding: 5px; margin: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    </style>
</head>
<body>
    <h2>Task Manager</h2>

    <!-- Insert Task Form -->
    <h3>Add Task</h3>
    <form method="POST">
        <input type="text" name="title" placeholder="Task Title" required>
        <label><input type="checkbox" name="done"> Done</label>
        <button type="submit" name="insert">Add Task</button>
    </form>

    <!-- Update/Delete Task Form -->
    <h3>Update/Delete Task</h3>
    <form method="POST">
        <select name="id" required>
            <option value="">Select Task</option>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <option value="<?= $row['id'] ?>">
                    <?= htmlspecialchars($row['title']) ?> (<?= $row['done'] ? "Done" : "Pending" ?>)
                </option>
            <?php } ?>
        </select>
        <input type="text" name="title" placeholder="New Title">
        <label><input type="checkbox" name="done"> Done</label>
        <button type="submit" name="update">Update Task</button>
        <button type="submit" name="delete">Delete Task</button>
    </form>

    <!-- Task List -->
    <h3>Task List</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Status</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM tasks");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>" . htmlspecialchars($row['title']) . "</td>
                    <td>" . ($row['done'] ? "Done ✅" : "Pending ❌") . "</td>
                  </tr>";
        }
        ?>
    </table>

    <?php $conn->close(); ?>
</body>
</html>
