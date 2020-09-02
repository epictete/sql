<?php

include 'connect.php';
session_start ();
session_check();

?>

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

// READ Data
$sql = 'SELECT * FROM hiking';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll();
$stmt->closeCursor();

foreach($rows as $row)
{
  echo
  "<tr>" .
    "<td><a href='./update.php?id=" . $row->id . "'>" . $row->name . "</a></td>" .
    "<td>" . $row->difficulty . "</td>" .
    "<td>" . $row->distance . "</td>" .
    "<td>" . $row->duration . "</td>" .
    "<td>" . $row->height_difference . "</td>" .
    "<td>" . $row->available . "</td>" .
    "<td><a href='./delete.php?id=" . $row->id . "'><button type='button'>Delete</button></a></td>" .
  "</tr>";
}

?>

    </table>
    <br>
    <p><a href="./create.php">Ajouter une randonnée</a></p>

  </body>
</html>
