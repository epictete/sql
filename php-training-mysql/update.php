<?php

include 'connect.php';
session_start ();
session_check();

$id = $_GET['id'];

// UPDATE Data
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
	UPDATE hiking
	SET name=?, difficulty=?, distance=?, duration=?, height_difference=?, available=?
	WHERE id=?';
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$name, $difficulty, $distance, $duration, $height_difference, $available, $id]);
    $stmt->closeCursor();
  }
  $message = 'La randonnée a été modifiée avec succès.';
}

// READ Data
$sql = 'SELECT * FROM hiking WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$post = $stmt->fetch();
$stmt->closeCursor();

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
	<title>Modifier une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="./read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" size=200 value="<?php echo $post->name ?>">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option <?php if ($post->difficulty == "très facile") echo "selected";?> value="très facile">Très facile</option>
				<option <?php if ($post->difficulty == "facile") echo "selected";?> value="facile">Facile</option>
				<option <?php if ($post->difficulty == "moyen") echo "selected";?> value="moyen">Moyen</option>
				<option <?php if ($post->difficulty == "difficile") echo "selected";?> value="difficile">Difficile</option>
				<option <?php if ($post->difficulty == "très difficile") echo "selected";?> value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?php echo $post->distance ?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?php echo $post->duration ?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?php echo $post->height_difference ?>">
		</div>
		<div>
			<label for="available">Praticable</label>
			<select name="available">
				<option <?php if ($post->available == "1") echo "selected";?> value="1">Oui</option>
				<option <?php if ($post->available == "0") echo "selected";?> value="0">Non</option>
			</select>
		</div>
		<button type="submit" name="button">Modifier</button>
	</form>
	<div>
		<p><?php echo $message ?></p>
	</div>
</body>
</html>
