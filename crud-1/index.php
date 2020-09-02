<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CRUD1</title>
</head>
<body>

    <h2>Afficher tous les clients de manière structurée</h2>
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
    if ($row->card)
    {
        $card = 'Oui';
        $cardNumber = "Numéro de carte : " . $row->cardNumber . "<br>";
    }
    else{
        $card = 'Non';
        $cardNumber = '';
    }

    echo
    "<tr>" .
      "<td>" .
        "Nom : " . $row->lastName . "<br>" .
        "Prénom : " . $row->firstName . "<br>" .
        "Date de naissance : " . $row->birthDate . "<br>" .
        "Carte de fidélité : " . $card . "<br>" .
        $cardNumber .
      "</td>" .
    "</tr>";
}

?>

    </table>

    <h2>Clients</h2>
    <table>

<?php

// CLIENTS
$sql = 'SELECT * FROM clients WHERE card=?';
$stmt = $pdo->prepare($sql);
$stmt->execute([true]);
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

    <h2>Clients dont le nom de famille commence par M triés alphabétiquement</h2>
    <table>
<?php

// CLIENTS
$sql = 'SELECT firstName, lastName FROM clients WHERE lastName LIKE ? ORDER BY lastName ASC';
$stmt = $pdo->prepare($sql);
$stmt->execute(['M%']);
$rows = $stmt->fetchAll();

foreach ($rows as $row)
{
    echo
    "<tr>" .
      "<td><Prénom: >" . $row->firstName . "</td>" .
      "<td><Nom: >" . $row->lastName . "</td>" .
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

    <h2>Liste de tous els spectacles triés par ordre alphabétique</h2>
    <table>
<?php

// CLIENTS
$sql = '
    SELECT title, performer, date, startTime
    FROM shows
    ORDER BY title ASC
';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll();

foreach ($rows as $row)
{
    echo $row->title . " par " . $row->performer . ", le " . $row->date . " à " . $row->startTime . "<br>";
}

?>

    </table>

</body>
</html>