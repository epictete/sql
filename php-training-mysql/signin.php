<?php

include 'connect.php';

$usr = $_POST['usr'];
$pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

$sql = 'INSERT INTO users(username, password) VALUES(?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->execute([$usr, $pwd]);
$stmt->closeCursor();

echo 'Utilisateur créé avec succès.';
echo '<meta http-equiv="refresh" content="0;URL=index.php">';

?>