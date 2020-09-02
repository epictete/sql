<?php

include 'connect.php';

$usr = $_POST['usr'];
$pwd = sha1($_POST['pwd']);

$sql = 'SELECT * FROM users WHERE username=? AND password=?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$usr, $pwd]);
$valid = $stmt->fetch();
echo $valid->username . '<br>';
echo $usr . '<br>';
echo $valid->password . '<br>';
echo $pwd . '<br>';

if (isset($usr) && isset($pwd))
{
    if ($valid->username == $usr && $valid->password == $pwd)
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