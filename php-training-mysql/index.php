<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <h2>Nouvel utilisateur</h2>
    <h4>Créer un compte</h4>
    <form action="signin.php" method="post">
        <label for="usr">Nom d'utilisateur : </label>
        <input type="text" name="usr"><br>
        <label for="pwd">Mot de passe : </label>
        <input type="text" name="pwd"><br>
        <input type="submit" value="Créer">
    </form>

    <h2>Utilisateur existant</h2>
    <h4>Connexion</h4>
    <form action="login.php" method="post">
        <label for="usr">Nom d'utilisateur : </label>
        <input type="text" name="usr"><br>
        <label for="pwd">Mot de passe : </label>
        <input type="text" name="pwd"><br>
        <input type="submit" value="Connexion">
    </form>
    
</body>
</html>