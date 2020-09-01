<?php

require 'external.php';

// DSN Variables
$host = "localhost";
$username = $user;
$password = $pass;
$dbname = "becode";

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

?>