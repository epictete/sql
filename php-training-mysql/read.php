<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
    <table>
      <!-- Afficher la liste des randonnées -->

<?php
// DSN Variables
require 'external.php';
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

// READ Data
$sql = 'SELECT * FROM hiking';
$stmt = $pdo->query($sql);
$stmt->execute();
$rows = $stmt->fetchAll();

foreach($rows as $row)
{
  echo
  "<tr>" .
  "<td>" . $row->name . "</td>" .
  "<td>" . $row->difficulty . "</td>" .
  "<td>" . $row->distance . "</td>" .
  "<td>" . $row->duration . "</td>" .
  "<td>" . $row->height_difference . "</td>" .
  "</tr>";
}

$stmt->closeCursor();
?>

    </table>
  </body>
</html>
