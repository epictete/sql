<?php

include 'connect.php';

$usr = $_POST['usr'];
$pwd = $_POST['pwd'];

$sql = 'SELECT * FROM users WHERE username=?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$usr]);
$row = $stmt->fetch();
$stmt->closeCursor();

if (isset($usr) && isset($pwd))
{
    if ($row->username == $usr && password_verify($pwd, $row->password ))
    {
        session_start();
        $_SESSION['usr'] = $usr;
        $_SESSION['pwd'] = $pwd;
        header ('location: read.php');
    }
    else
    {
        echo '<body onLoad="alert(\'Membre non reconnu...\')">';
		echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    }
}
else{
    echo 'Les variables du formulaire ne sont pas déclarées.';
}

?>