<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="PHP weather application using PDO Prepared Statements">
  <title>Weather App</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table>
  <tr>
    <th>Ville</th>
    <th>Haut</th>
    <th>Bas</th>
    <th>Delete</th>
  </tr>

<?php

// DSN Variables
require 'external.php';
$host = "localhost";
$username = $user;
$password = $pass;
$dbname = "weatherapp";

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

// DATA Handling
$ville = "";
$haut = $bas = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $ville = test_input($_POST["ville"]);
  $haut = test_input($_POST["haut"]);
  $bas = test_input($_POST["bas"]);

  // INSERT Data
  if ($ville != "")
  {
    $sql = 'INSERT INTO Météo(ville, haut, bas) VALUES(?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ville, $haut, $bas]);
    $stmt->closeCursor();
  }

  // DELETE Data 
  foreach($_POST['check'] as $check)
  {
    $sql = 'DELETE FROM Météo WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$check]);
    $stmt->closeCursor();
  }

}

// READ Data
$sql = 'SELECT * FROM Météo';
$stmt = $pdo->query($sql);
$stmt->execute();
$rows = $stmt->fetchAll();

foreach($rows as $row)
{
  echo
  "<tr>" .
  "<td>" . $row->ville . "</td>" .
  "<td>" . $row->haut . "</td>" .
  "<td>" . $row->bas . "</td>" .
  "<td>" . '<input type="checkbox" name="check[]" value="' . $row->id . '">' . "</td>" .
  "</tr>";
}

$stmt->closeCursor();

// INPUT Validation
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

</table><br>


  <label for="ville">Ville:</label><br>
  <input type="text" id="ville" name="ville"><br>
  <label for="haut">Haut:</label><br>
  <input type="text" id="haut" name="haut"><br>
  <label for="bas">Bas:</label><br>
  <input type="text" id="bas" name="bas"><br>
  <br>
  <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>