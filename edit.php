<?php 
 include_once 'db.php';

 // update
 if (isset($_POST['id'])) {
    $SQL = "UPDATE tasks SET title = ?, done = ? WHERE id = ?";
    $stmt = $db->prepare($SQL);
    
    $task = $_POST['name'];
    $done = isset($_POST['done']) ? 1 : 0;
    $id = $_POST['id'];
   
    $stmt->bind_param("sii", $task, $done, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
 }
// get data to form
 $id = $_GET['id'];
 $SQL = "SELECT * FROM tasks WHERE id = ?";
 $stmt = $db->prepare($SQL);
 $stmt->bind_param("i", $id);
 $stmt->execute();

 $result = $stmt->get_result();
 $task = $result->fetch_assoc();
 $stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="name"
     value="<?php echo $task['title']; ?>">
    <input type="checkbox" name="done" 
     <?php echo $task['done'] ? 'checked' : ''; ?>>
    <input type="hidden"
     value="<?php echo $task['id']; ?>" name="id">
    <input type="submit" value="save" name="submit">
</form>

</body>
</html>