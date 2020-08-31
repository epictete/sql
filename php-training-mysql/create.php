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

// DATA Handling
$name = $difficulty = $distance = $height_difference = "";
$duration = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $name = test_input($_POST["name"]);
  $difficulty = test_input($_POST["difficulty"]);
  $distance = test_input($_POST["distance"]);
  $duration = test_input($_POST["time"]);
  $height_difference = test_input($_POST["height_difference"]);

  // INSERT Data
  if ($name != "")
  {
    $sql = 'INSERT INTO hiking(name, difficulty, distance, duration, height_difference) VALUES(?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $difficulty, $distance, $duration, $height_difference]);
    $stmt->closeCursor();
  }
  echo 'La randonnée a été ajoutée avec succès.';
}

// INPUT Validation
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="./read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>

		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
