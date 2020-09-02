<?php

require 'external.php';

// DSN Variables
$host = "localhost";
$username = $user;
$password = $pass;
$dbname = "colyseum";

// Set DSN
$dsn = "mysql:host=". $host. ";dbname=". $dbname;

// Create PDO instance
try
{
  $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

function session_check()
{
  if (isset($_SESSION['usr']) && isset($_SESSION['pwd']))
  {
    echo 'Bienvenue ' . $_SESSION['usr'] . '.<br>';
    echo '<a href="./logout.php">Déconnection</a><br>';
  }
  else {
    exit("Vous devez être connecté pour accéder à cette page.");
  }
}

?>