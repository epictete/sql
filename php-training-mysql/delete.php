<?php

include 'connect.php';
session_start ();
session_check();

$id = $_GET['id'];

// DELETE Data
$sql = 'DELETE FROM hiking WHERE id=?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$stmt->closeCursor();

// Redirect 
header("Location: ./read.php");

?>
