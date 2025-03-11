<?php 
 include_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="name">
    <input type="hidden" name="id" value="1">
    <input type="submit" value="Submit" name="submit">
</form>

<?php 
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    if(!$name) {
        echo "Please enter a task title";
        return;
    }
    // insert into database
    $SQL = "INSERT INTO tasks (title, done) VALUES (?,?)";
    $stmt = $db->prepare($SQL);
    $done = false; // true or false
    $stmt->bind_param("si", $name, $done);
    $stmt->execute();
    $stmt->close();
    echo "Task added successfully";

}

$SQL = "SELECT * FROM tasks ORDER BY title ASC";
$result = $db->query($SQL);
if ($result->num_rows > 0) {
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>". 
                    $row['id'] . " - " . $row['title'] . 
                   "| <a href='delete.php?id=" . $row['id'] . "'>x</a>". 
             "</li>";
    }
    echo "</ul>";
}

?>

</body>
</html>