<?php

include 'connect.php';
session_start ();
session_check();

// DATA Handling
$name = $difficulty = $distance = $duration = $height_difference = $available = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $name = test_input($_POST["name"]);
  $name = filter_var($name, FILTER_SANITIZE_STRING);

  $difficulty = test_input($_POST["difficulty"]);
  $difficulty = filter_var($difficulty, FILTER_SANITIZE_STRING);

  $distance = test_input($_POST["distance"]);
  $distance = filter_var($distance, FILTER_SANITIZE_NUMBER_INT);

  $duration = test_input($_POST["duration"]);
  $duration = filter_var($duration, FILTER_SANITIZE_NUMBER_INT);

  $height_difference = test_input($_POST["height_difference"]);
  $height_difference = filter_var($height_difference, FILTER_SANITIZE_NUMBER_INT);

  $available = test_input($_POST["available"]);
  $available = filter_var($available, FILTER_SANITIZE_STRING);

  // INSERT Data
  if ($name != "")
  {
    $sql = '
	INSERT INTO
		hiking(name, difficulty, distance, duration, height_difference, available)
	VALUES(?, ?, ?, ?, ?, ?)
	';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $difficulty, $distance, $duration, $height_difference, $available]);
    $stmt->closeCursor();
  }
  $message = 'La randonnée a été ajoutée avec succès.';
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
		<div>
			<label for="available">Praticable</label>
			<select name="available">
				<option value="1">Oui</option>
				<option value="0">Non</option>
			</select>
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
	<div>
		<p><?php echo $message ?></p>
	</div>
</body>
</html>
