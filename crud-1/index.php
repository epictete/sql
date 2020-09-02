<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CRUD1</title>
</head>
<body>
    <h2>Clients</h2>
    <table>

<?php

include 'connect.php';

// CLIENTS
$sql = 'SELECT * FROM clients';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll();

foreach ($rows as $row)
{
    echo
    "<tr>" .
      "<td>" . $row->id . "</td>" .
      "<td>" . $row->lastName . "</td>" .
      "<td>" . $row->firstName . "</td>" .
      "<td>" . $row->birthDate . "</td>" .
      "<td>" . $row->card . "</td>" .
      "<td>" . $row->cardNumber . "</td>" .
    "</tr>";
}

?>

    </table>

    <h2>Types de spectacles</h2>
    <table>

<?php

// SPECTACLES
$sql = 'SELECT * FROM showTypes';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll();

foreach ($rows as $row)
{
    echo
    "<tr>" .
      "<td>" . $row->id . "</td>" .
      "<td>" . $row->type . "</td>" .
    "</tr>";
}

?>

    </table>

</body>
</html>