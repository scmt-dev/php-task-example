<?php
include_once 'db.php';
$id = $_GET['id'];
$SQL = "DELETE FROM tasks WHERE id = ?";
$stmt = $db->prepare($SQL);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();
header("Location: index.php");
?>